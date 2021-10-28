<?php

namespace DBTech\Credits\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int|null transaction_id
 * @property int event_id
 * @property string event_trigger_id
 * @property int user_id
 * @property int dateline
 * @property int source_user_id
 * @property float amount
 * @property int status
 * @property string reference_id
 * @property string content_type
 * @property int content_id
 * @property int node_id
 * @property int owner_id
 * @property int multiplier
 * @property int currency_id
 * @property bool negate
 * @property string message
 * @property bool is_disputed
 * @property float balance
 *
 * RELATIONS
 * @property \DBTech\Credits\Entity\Event Event
 * @property \DBTech\Credits\Entity\Currency Currency
 * @property \XF\Entity\User TargetUser
 * @property \XF\Entity\User SourceUser
 * @property \XF\Entity\User Owner
 * @property \XF\Entity\Forum Forum
 */
class Transaction extends Entity
{
	/**
	 * @return bool
	 */
	public function canView()
	{
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		if (
			$this->user_id != $visitor->user_id
			&& $this->source_user_id != $visitor->user_id
			&& !$visitor->canViewAnyDbtechCreditsTransaction()
		)
		{
			return false;
		}
		
		if (!$this->Event->canView())
		{
			return false;
		}
		
		if (!$this->Currency->canView($this->TargetUser))
		{
			return false;
		}
		
		return true;
	}
	
	public function _postSave()
	{
		if ($this->status == 1)
		{
			$currency = $this->Currency;
			
			// This is split into two queries for readability
			if (!$currency->negative)
			{
				// Update the currency table, but ensure it resets to 0 if needed
				$this->db()->query('
					UPDATE xf_user
					SET ' . $currency->column . ' = GREATEST(0, CAST(' . $currency->column . ' AS SIGNED) + ?)
					WHERE user_id = ?
				', [
					$this->amount,
					$this->user_id
				]);
			}
			else
			{
				// Update the currency table to whatever the real value is
				$this->db()->query('
					UPDATE xf_user
					SET ' . $currency->column . ' = ' . $currency->column . ' + ?
					WHERE user_id = ?
				', [
					$this->amount,
					$this->user_id
				]);
			}
			
			// Grab the current balance
			$balance = $this->db()->fetchOne('
				SELECT ROUND(' . $currency->column . ', ?)
				FROM xf_user
				WHERE user_id = ?
			', [
				max($currency->decimals, 2),
				$this->user_id
			]);
			
			// Update the balance column
			$this->fastUpdate('balance', $balance);
			
			/** @var \DBTech\Credits\XF\Entity\User $visitor */
			$visitor = \XF::visitor();
			
			if ($this->user_id == $visitor->user_id)
			{
				// Also set the current user's balance for consistency
				$visitor->fastUpdate($currency->column, $balance);
			}
			
			if ($this->Event->alert && $this->getOption('enableAlert'))
			{
				$source = $this->source_user_id
					? $this->SourceUser
					: $this->repository('XF:User')->getGuestUser()
				;
				
				// Send alert if needed
				$this->getTransactionRepo()
					->sendTransactionAlert($this->TargetUser, $source, $this)
				;
			}
		}
	}
	
	/**
	 * @param Structure $structure
	 *
	 * @return Structure
	 */
	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_dbtech_credits_transaction';
		$structure->shortName = 'DBTech\Credits:Transaction';
		$structure->contentType = 'dbtech_credits';
		$structure->primaryKey = 'transaction_id';
		$structure->columns = [
			'transaction_id' => ['type' => self::UINT, 'autoIncrement' => true, 'nullable' => true],
			'event_id' => ['type' => self::UINT, 'required' => true],
			'event_trigger_id' => ['type' => self::STR, 'required' => true],
			'user_id' => ['type' => self::UINT, 'required' => true],
			'dateline' => ['type' => self::UINT, 'default' => \XF::$time],
			'source_user_id' => ['type' => self::UINT, 'required' => true],
			'amount' => ['type' => self::FLOAT, 'required' => true],
			'status' => ['type' => self::UINT, 'default' => 0],
			'reference_id' => ['type' => self::STR, 'default' => ''],
			'content_type' => ['type' => self::STR, 'maxLength' => 25, 'default' => ''],
			'content_id' => ['type' => self::UINT, 'default' => 0],
			'node_id' => ['type' => self::UINT, 'default' => 0],
			'owner_id' => ['type' => self::UINT, 'default' => 0],
			'multiplier' => ['type' => self::INT, 'default' => 0],
			'currency_id' => ['type' => self::UINT, 'required' => true],
			'negate' => ['type' => self::BOOL, 'default' => false],
			'message' => ['type' => self::STR, 'default' => ''],
			'is_disputed' => ['type' => self::BOOL, 'default' => false],
			'balance' => ['type' => self::FLOAT, 'default' => 0],
		];
		$structure->getters = [];
		$structure->relations = [
			'Event' => [
				'entity' => 'DBTech\Credits:Event',
				'type' => self::TO_ONE,
				'conditions' => 'event_id',
				'primary' => true,
			],
			'Currency' => [
				'entity' => 'DBTech\Credits:Currency',
				'type' => self::TO_ONE,
				'conditions' => 'currency_id',
				'primary' => true,
			],
			'TargetUser' => [
				'entity' => 'XF:User',
				'type' => self::TO_ONE,
				'conditions' => 'user_id',
				'primary' => true
			],
			'SourceUser' => [
				'entity' => 'XF:User',
				'type' => self::TO_ONE,
				'conditions' => [
					['user_id', '=', '$source_user_id']
				],
				'primary' => true
			],
			'Owner' => [
				'entity' => 'XF:User',
				'type' => self::TO_ONE,
				'conditions' => [
					['user_id', '=', '$owner_id']
				],
				'primary' => true
			],
			'Forum' => [
				'entity' => 'XF:Forum',
				'type' => self::TO_ONE,
				'conditions' => 'node_id',
				'primary' => true
			],
		];
		$structure->options = [
			'enableAlert' => true,
		];

		return $structure;
	}
	
	/**
	 * @return \DBTech\Credits\Repository\Transaction|\XF\Mvc\Entity\Repository
	 */
	protected function getTransactionRepo()
	{
		return $this->repository('DBTech\Credits:Transaction');
	}
}