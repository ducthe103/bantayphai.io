<?php

namespace DBTech\Credits\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;
use XF\Db\Schema\Alter;

/**
 * COLUMNS
 * @property int currency_id
 * @property string title
 * @property string description
 * @property bool active
 * @property int display_order
 * @property string table
 * @property bool use_table_prefix
 * @property string column
 * @property bool use_user_id
 * @property string user_id_column
 * @property int decimals
 * @property int privacy
 * @property bool blacklist
 * @property string prefix
 * @property string suffix
 * @property bool is_display_currency
 * @property bool sidebar
 * @property bool member_dropdown
 * @property bool postbit
 * @property int negative
 * @property int maxtime
 * @property float earnmax
 * @property float value
 * @property bool inbound
 * @property bool outbound
 *
 * GETTERS
 * @property \DBTech\Credits\XF\Entity\User[]|\XF\Mvc\Entity\ArrayCollection RichestUsers
 *
 * RELATIONS
 * @property \DBTech\Credits\Entity\Event[] Events
 * @property \DBTech\Credits\Entity\Transaction[] Transactions
 */
class Currency extends Entity
{
	/**
	 * @return bool
	 */
	public function isActive()
	{
		return $this->active;
	}
	
	/**
	 * @param \XF\Entity\User|null $user
	 *
	 * @return bool
	 */
	public function canView(\XF\Entity\User $user = null)
	{
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		$user = $user ?: $visitor;
		
		if (
			(
				!$this->privacy
				&& !$visitor->canBypassDbtechCreditsCurrencyPrivacy()
			)
			||
			(
				$this->privacy == 1
				&& $user->user_id != $visitor->user_id
			)
		)
		{
			// private currency
			return false;
		}

		return $this->isActive();
	}
	
	/**
	 * @param \XF\Entity\User|null $userInfo
	 * @param bool $format
	 *
	 * @return bool|mixed|null
	 */
	public function getValueFromUser(\XF\Entity\User $userInfo = null, $format = true)
	{
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		$userInfo = $userInfo ?: $visitor;

		$value = $userInfo->{$this->column};

		if ($format)
		{
			// We need to format the value
			$value = $this->getFormattedValue($value);
		}

		return $value;
	}
	
	/**
	 * @param int $value
	 *
	 * @return mixed
	 */
	public function getFormattedValue($value = 0)
	{
		if ($value < 0 && $this->negative == 1)
		{
			// Make sure this is displaying correctly
			$value = 0;
		}

		return \XF::language()->numberFormat($value, $this->decimals);
	}
	
	/**
	 * @param int $limit
	 *
	 * @return \DBTech\Credits\XF\Entity\User[]|\XF\Mvc\Entity\ArrayCollection
	 */
	public function getRichestUsers($limit = 5)
	{
		return $this->getCurrencyRepo()
			->getRichestUsers($this, $limit)
			->fetch()
		;
	}
	
	/**
	 * @param $criteria
	 * @param $key
	 *
	 * @return bool
	 */
	public function isCriteriaSelected($criteria, $key)
	{
		return (!is_array($criteria) || !isset($criteria['dbtech_credits_currency_' . $this->currency_id .'_' . $key]))
			? false
			: true;
	}
	
	/**
	 * @param $criteria
	 * @param $key
	 *
	 * @return int
	 */
	public function getCriteriaValue($criteria, $key)
	{
		return (!is_array($criteria) || !isset($criteria['dbtech_credits_currency_' . $this->currency_id .'_' . $key]))
			? 0
			: $criteria['dbtech_credits_currency_' . $this->currency_id .'_' . $key]['amount'];
	}
	
	/**
	 * @return bool
	 * @throws \XF\PrintableException
	 */
	public function verifyAdjustEvent()
	{
		if (!$this->exists())
		{
			return false;
		}

		// Whether we need to add an adjust event
		$foundEvent = false;

		/** @var \DBTech\Credits\Entity\Event $event */
		foreach ($this->Events as $eventId => $event)
		{
			if ($event->event_trigger_id == 'adjust')
			{
				$foundEvent = true;

				if ($event->curtarget == 0)
				{
					// We need to correct this
					$event->curtarget = 1;
					$event->save();
				}
			}
		}

		if (!$foundEvent)
		{
			/** @var \DBTech\Credits\Entity\Event $event */
			$event = $this->_em->create('DBTech\Credits:Event');
				$event->bulkSet([
					'event_trigger_id' => 'adjust',
					'curtarget' => 1,
					'currency_id' => $this->currency_id
				]);
			$event->save();
		}

		return true;
	}
	
	/**
	 * @return bool
	 * @throws \XF\PrintableException
	 */
	public function verifyChargeEvent()
	{
		if (!$this->exists())
		{
			return false;
		}

		// Whether we need to add a charge event
		$foundEvent = false;

		/** @var \DBTech\Credits\Entity\Event $event */
		foreach ($this->Events as $eventId => $event)
		{
			if ($event->event_trigger_id == 'content')
			{
				$foundEvent = true;
				break;
			}
		}

		if (!$foundEvent)
		{
			/** @var \DBTech\Credits\Entity\Event $event */
			$event = $this->_em->create('DBTech\Credits:Event');
				$event->bulkSet([
					'event_trigger_id' => 'content',
					'currency_id' => $this->currency_id
				]);
			$event->save();
		}

		return true;
	}
	
	/**
	 * @param $column
	 *
	 * @return bool
	 */
	protected function verifySqlSafe(&$column)
	{
		$column = strval($column);
		if ($column === '')
		{
			// Invalid
			return false;
		}
		
		// Ensure this is valid
		$column = preg_replace('/[^a-zA-Z0-9_]/i', '_', preg_quote($column));
		
		return true;
	}
	
	/**
	 * @return bool
	 */
	protected function _preSave()
	{
		$db = $this->db();
		$sm = $db->getSchemaManager();

		$tableName = ($this->use_table_prefix ? 'xf_' : '') . $this->table;
		
		if (!$sm->tableExists($tableName))
		{
			// Invalid
			$this->error(\XF::phrase('dbtech_credits_missing_table'), 'table');
			return false;
		}
		
		$columns = $sm->getTableColumnDefinitions($tableName);
		
		if (!array_key_exists($this->user_id_column, $columns))
		{
			// Invalid
			$this->error(\XF::phrase('dbtech_credits_missing_user_column'), 'table');
			return false;
		}

		if (
			$this->isInsert()
			|| $this->isChanged('column')
		)
		{
			// deal with desired table column
			$this->blacklist = isset($columns[$this->column]);

			if (!$this->blacklist)
			{
				// create or switch custom columns
				if (
					$this->isUpdate()
					&& $this->isChanged('column')
					&& !$this->getPreviousValue('blacklist')
				)
				{
					$sm->alterTable($tableName, function(Alter $table)
					{
						// Column was changed but not blacklisted so rename the column
						$table->changeColumn($this->getPreviousValue('column'), 'double')
							->unsigned(false)
							->setDefault('0')
							->renameTo($this->column)
						;
					});
				}
				else
				{
					$sm->alterTable($tableName, function(Alter $table)
					{
						// Column was either not changed
						$table->addColumn($this->column, 'double')
							->unsigned(false)
							->setDefault('0')
						;
					});
				}
			}
			else if (
				$this->isChanged('column')
				&& $this->isUpdate()
				&& !$this->getExistingValue('blacklist')
			)
			{
				$sm->alterTable($tableName, function(Alter $table)
				{
					$table->dropColumns([$this->getPreviousValue('column')]);
				});
			}
		}

		/** @var \DBTech\Credits\Entity\Currency $existing */
		if (
			$this->is_display_currency
			&& $existing = $this->finder('DBTech\Credits:Currency')
				->where('is_display_currency', 1)
				->where('currency_id', '!=', $this->currency_id)
				->fetchOne()
		)
		{
			// We're changing display currency
			$existing->fastUpdate('is_display_currency', 0);
		}
		
		return true;
	}
	
	/**
	 * @throws \XF\PrintableException
	 */
	protected function _postSave()
	{
		// Make sure we have an adjust event
		$this->verifyAdjustEvent();
	}
	
	/**
	 *
	 */
	protected function _postDelete()
	{
		$db = $this->db();
		$sm = $db->getSchemaManager();

		$tableName = ($this->use_table_prefix ? 'xf_' : '') . $this->table;
		
		if (!$this->blacklist)
		{
			$sm->alterTable($tableName, function(Alter $table)
			{
				$table->dropColumns([$this->column]);
			});
		}

		if ($sm->tableExists('xf_dbtech_shop_currency'))
		{
			$db->update(
				'xf_dbtech_shop_currency',
				['credits_currency_id' => 0],
				'credits_currency_id = ?',
				[$this->currency_id]
			);
		}
	}
	
	/**
	 * @param Structure $structure
	 *
	 * @return Structure
	 */
	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_dbtech_credits_currency';
		$structure->shortName = 'DBTech\Credits:Currency';
		$structure->primaryKey = 'currency_id';
		$structure->columns = [
			'currency_id'			=> ['type' => self::UINT, 'autoIncrement' => true],
			'title' 				=> ['type' => self::STR, 'required' => true],
			'description' 			=> ['type' => self::STR, 'default' => ''],
			'active' 				=> ['type' => self::BOOL, 'default' => true],
			'display_order' 		=> ['type' => self::UINT, 'default' => 10],
			'table' 				=> ['type' => self::STR,
								   'verify' => 'verifySqlSafe', 'default' => 'user'
			],
			'use_table_prefix' 		=> ['type' => self::BOOL, 'default' => true],
			'column' 				=> ['type' => self::STR, 'required' => true],
			'use_user_id' 			=> ['type' => self::BOOL, 'default' => true],
			'user_id_column' 		=> ['type' => self::STR,
									 'verify' => 'verifySqlSafe', 'default' => 'user_id'
			],
			'decimals' 				=> ['type' => self::UINT, 'default' => 0],
			'privacy' 				=> ['type' => self::UINT, 'max' => 2, 'default' => 2],
			'blacklist' 			=> ['type' => self::BOOL, 'default' => false],
			'prefix' 				=> ['type' => self::STR, 'default' => ''],
			'suffix' 				=> ['type' => self::STR, 'default' => ''],
			'is_display_currency' 	=> ['type' => self::BOOL, 'default' => false],
			'sidebar' 				=> ['type' => self::BOOL, 'default' => true],
			'member_dropdown' 		=> ['type' => self::BOOL, 'default' => false],
			'postbit' 				=> ['type' => self::BOOL, 'default' => true],
			'negative' 				=> ['type' => self::UINT, 'max' => 2, 'default' => 2],
			'maxtime' 				=> ['type' => self::UINT, 'default' => 0],
			'earnmax' 				=> ['type' => self::FLOAT, 'default' => 0.0],
			'value' 				=> ['type' => self::FLOAT, 'default' => 1.0],
			'inbound' 				=> ['type' => self::BOOL, 'default' => true],
			'outbound' 				=> ['type' => self::BOOL, 'default' => true]
		];
		$structure->behaviors = [
			'DBTech\Credits:Cacheable' => []
		];
		$structure->getters = [
			'RichestUsers' => true
		];
		$structure->relations = [
			'Events' => [
				'entity' => 'DBTech\Credits:Event',
				'type' => self::TO_MANY,
				'conditions' => 'currency_id',
				'cascadeDelete' => true
			],
			'Transactions' => [
				'entity' => 'DBTech\Credits:Transaction',
				'type' => self::TO_MANY,
				'conditions' => 'currency_id',
				'cascadeDelete' => true
			]
		];

		return $structure;
	}
	
	/**
	 *
	 */
	protected function _setupDefaults()
	{
		$this->active = true;
		$this->display_order = 10;
		$this->table = 'user';
		$this->use_table_prefix = true;
		$this->use_user_id = true;
		$this->user_id_column = 'user_id';
		$this->decimals = 0;
		$this->privacy = 2;
		$this->is_display_currency = false;
		$this->sidebar = true;
		$this->member_dropdown = false;
		$this->postbit = true;
		$this->blacklist = false;
		$this->negative = 2;
		$this->maxtime = 0;
		$this->earnmax = 0.0;
		$this->value =  1;
		$this->inbound = true;
		$this->outbound = true;
	}
	
	/**
	 * @return \DBTech\Credits\Repository\Currency|\XF\Mvc\Entity\Repository
	 */
	protected function getCurrencyRepo()
	{
		return $this->repository('DBTech\Credits:Currency');
	}
}