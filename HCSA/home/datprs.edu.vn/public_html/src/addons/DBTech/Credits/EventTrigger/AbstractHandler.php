<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Event;
use DBTech\Credits\Entity\Transaction;
use DBTech\Credits\Exception\SkipEventException;
use DBTech\Credits\Exception\StopEventTriggerException;
use XF\Mvc\Entity\ArrayCollection;

/**
 * Class AbstractHandler
 *
 * @package DBTech\Credits\EventTrigger
 */
abstract class AbstractHandler
{
	const MULTIPLIER_NONE          =  0x0000;
	const MULTIPLIER_LABEL         =  0x0001;
	const MULTIPLIER_SIZE          =  0x0002;
	const MULTIPLIER_CURRENCY      =  0x0003;
	
	protected $options = [
		'multiplier' => self::MULTIPLIER_NONE,
		'isGlobal' => false,
		'canRevert' => false,
		'canCancel' => false,
		'canRebuild' => false,
		'canCharge' => true,
		'useUserGroups' => true,
		'useOwner' => false
	];
	
	/**
	 * @var string
	 */
	protected $contentType;
	
	/**
	 * @var ArrayCollection
	 */
	protected $events;
	
	
	/**
	 * AbstractHandler constructor.
	 *
	 * @param $contentType
	 */
	public function __construct($contentType)
	{
		$this->contentType = $contentType;
		
		$this->setupOptions();
	}
	
	/**
	 * Designed to be overridden if need be
	 */
	protected function setupOptions()
	{
	
	}
	
	/**
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}
	
	/**
	 * @param $key
	 *
	 * @return mixed|null
	 */
	public function getOption($key)
	{
		return isset($this->options[$key]) ? $this->options[$key] : NULL;
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return [];
	}
	
	/**
	 * @param $id
	 *
	 * @return null|\XF\Mvc\Entity\ArrayCollection|\XF\Mvc\Entity\Entity
	 */
	public function getContent($id)
	{
		return $this->findByContentType($this->contentType, $id, $this->getEntityWith());
	}
	
	/**
	 * @return string
	 */
	public function getContentType()
	{
		return $this->contentType;
	}
	
	/**
	 * @param ArrayCollection|null $events
	 */
	public function setEvents(ArrayCollection $events = null)
	{
		$this->events = $events;
	}
	
	/**
	 * @param bool $force
	 *
	 * @return Event[]|ArrayCollection
	 */
	public function getEvents($force = false)
	{
		if ($this->events === NULL || $force)
		{
			/** @var \DBTech\Credits\Entity\Event[]|ArrayCollection $events */
			$events = \XF::finder('DBTech\Credits:Event')
				->where('event_trigger_id', $this->getContentType())
				->fetch()
			;
			
			$this->events = $events;
		}
		
		return $this->events;
	}
	
	/**
	 * @param string $contentType
	 * @param int|array $contentId
	 * @param string|array $with
	 *
	 * @return null|\XF\Mvc\Entity\ArrayCollection|\XF\Mvc\Entity\Entity
	 */
	public function findByContentType($contentType, $contentId, $with = [])
	{
		$entity = $this->getContentTypeEntity($contentType);
		
		if (is_array($contentId))
		{
			return \XF::em()->findByIds($entity, $contentId, $with);
		}
		else
		{
			return \XF::em()->find($entity, $contentId, $with);
		}
	}
	
	/**
	 * @param string $contentType
	 * @param bool $throw
	 *
	 * @return string|null
	 */
	public function getContentTypeEntity($contentType, $throw = true)
	{
		$entityId = \XF::app()->getContentTypeFieldValue($contentType, 'dbtech_credits_entity');
		if (!$entityId && $throw)
		{
			throw new \LogicException("Content type $contentType must define a 'dbtech_credits_entity' value");
		}
		
		return $entityId;
	}
	
	/**
	 * @return \XF\Phrase
	 */
	public function getTitle()
	{
		return \XF::phrase('dbtech_credits_eventtrigger_title.' . $this->contentType);
	}
	
	/**
	 * @return \XF\Phrase
	 */
	public function getDescription()
	{
		return \XF::phrase('dbtech_credits_eventtrigger_description.' . $this->contentType);
	}
	
	/**
	 * @return bool
	 */
	public function isActive()
	{
		return true;
	}
	
	/**
	 * @return int
	 */
	public function getMultiplier()
	{
		return $this->options['multiplier'];
	}
	
	
	public function getLabels()
	{
		$labels = [];
		
		if ($this->getMultiplier() == self::MULTIPLIER_SIZE)
		{
			if ($this->options()->dbtech_credits_size_words)
			{
				$labels['minimum_amount'] = \XF::phrase('dbtech_credits_minimum_words');
				$labels['maximum_amount'] = \XF::phrase('dbtech_credits_maximum_words');
				$labels['minimum_action'] = \XF::phrase('dbtech_credits_below_minimum_words');
				$labels['minimum_action_explain'] = \XF::phrase('dbtech_credits_below_minimum_words_explain');
				$labels['multiplier_addition'] = \XF::phrase('dbtech_credits_amount_per_word');
				$labels['multiplier_addition_explain'] = \XF::phrase('dbtech_credits_amount_per_word_explain');
				$labels['multiplier_negation'] = \XF::phrase('dbtech_credits_negation_amount_per_word');
				$labels['multiplier_negation_explain'] = \XF::phrase('dbtech_credits_negation_amount_per_word_explain');
			}
			else
			{
				$labels['minimum_amount'] = \XF::phrase('dbtech_credits_minimum_characters');
				$labels['maximum_amount'] = \XF::phrase('dbtech_credits_maximum_characters');
				$labels['minimum_action'] = \XF::phrase('dbtech_credits_below_minimum_characters');
				$labels['minimum_action_explain'] = \XF::phrase('dbtech_credits_below_minimum_characters_explain');
				$labels['multiplier_addition'] = \XF::phrase('dbtech_credits_amount_per_character');
				$labels['multiplier_addition_explain'] = \XF::phrase('dbtech_credits_amount_per_character_explain');
				$labels['multiplier_negation'] = \XF::phrase('dbtech_credits_negation_amount_per_character');
				$labels['multiplier_negation_explain'] = \XF::phrase('dbtech_credits_negation_amount_per_character_explain');
			}
		}
		
		return $labels;
	}
	
	/**
	 * @param $refId
	 * @param array $extraParams
	 * @param \XF\Entity\User|null $user
	 *
	 * @return Transaction[]
	 * @throws \XF\PrintableException
	 */
	public function apply($refId, array $extraParams = [], \XF\Entity\User $user = null)
	{
		/** @var \DBTech\Credits\XF\Entity\User $user */
		$user = $user ?: \XF::visitor();
		
		return $this->trigger($user, $refId, false, $extraParams);
	}
	
	/**
	 * @param $refId
	 * @param array $extraParams
	 * @param \XF\Entity\User|null $user
	 *
	 * @return Transaction[]
	 * @throws \XF\PrintableException
	 */
	public function undo($refId, array $extraParams = [], \XF\Entity\User $user = null)
	{
		/** @var \DBTech\Credits\XF\Entity\User $user */
		$user = $user ?: \XF::visitor();
		
		return $this->trigger($user, $refId, true, $extraParams);
	}
	
	/**
	 * @param array $extraParams
	 * @param \XF\Entity\User|null $user
	 *
	 * @return Transaction[]
	 * @throws \XF\PrintableException
	 */
	public function testApply(array $extraParams = [], \XF\Entity\User $user = null)
	{
		return $this->apply(null, $extraParams, $user);
	}
	
	/**
	 * @param array $extraParams
	 * @param \XF\Entity\User|null $user
	 *
	 * @return Transaction[]
	 * @throws \XF\PrintableException
	 */
	public function testUndo(array $extraParams = [], \XF\Entity\User $user = null)
	{
		return $this->undo(null, $extraParams, $user);
	}
	
	/**
	 * @param \XF\Entity\User $user
	 * @param $refId
	 * @param bool $negate
	 * @param array $extraParams
	 *
	 * @return Transaction[]
	 * @throws \XF\PrintableException
	 */
	protected function trigger(\XF\Entity\User $user, $refId, $negate = false, array $extraParams = [])
	{
		$extraParams = array_replace([
			'multiplier' => 1,
			'message' => '',
			'timestamp' => \XF::$time,
			'source_user_id' => $user->user_id,
			'owner_id' => 0,
			'content_type' => '',
			'content_id' => 0,
			'node_id' => 0,
			'currency_id' => 0,
			'event_id' => 0,
			'alwaysCheck' => false,
			'enableAlert' => true,
			'runPostSave' => true,
			'negate' => $negate
		], $extraParams);
		$extraParams = new \ArrayObject($extraParams, \ArrayObject::ARRAY_AS_PROPS);
		
		$options = $this->app()->options();
		
		if (!$user)
		{
			throw new \XF\PrintableException(\XF::phrase('dbtech_credits_invalid_user'));
		}
		
		// Override multiplier if needed
		if ($this->getOption('multiplier') == self::MULTIPLIER_SIZE)
		{
			$extraParams->multiplier = $this->contentSize($extraParams->multiplier);
		}
		
		// Used by our own extensions like DB Donate and DB Shop
		$this->assertEventExists($extraParams->currency_id);
		
		/** @var \DBTech\Credits\Entity\Transaction[] $queue */
		$queue = [];
		
		/** @var \DBTech\Credits\Entity\Event[]|\XF\Mvc\Entity\ArrayCollection $events */
		$events = $this->getEvents()
			->filter(function(Event $event) use ($extraParams, $user)
			{
				if (!$event->isActive())
				{
					return false;
				}
				
				if (!$event->isValidForUser($user))
				{
					return false;
				}
				
				if ($extraParams->event_id && $event->event_id != $extraParams->event_id)
				{
					return false;
				}
				
				if ($extraParams->currency_id && $event->currency_id != $extraParams->currency_id)
				{
					return false;
				}
				
				if (!$event->Currency->isActive())
				{
					return false;
				}
				
				if (!$this->assertEvent($event, $user, $extraParams))
				{
					// Skip this
					return false;
				}
				
				return true;
			})
		;
		
		foreach ($events as $event)
		{
			try
			{
				$amount = $event->getCalculatedAmount($this, $user, $extraParams);
			}
			catch (SkipEventException $e)
			{
				$events->offsetUnset($event->event_id);
				continue;
			}
			catch (StopEventTriggerException $e)
			{
				return $queue;
			}
			
			if ($amount == 0)
			{
				$events->offsetUnset($event->event_id);
				continue;
			}
		}
		
		if ($options->dbtech_credits_best_event)
		{
			$eventAmountsByCurrency = [];
			foreach ($events as $event)
			{
				if (!isset($eventAmountsByCurrency[$event->currency_id]))
				{
					$eventAmountsByCurrency[$event->currency_id] = [];
				}
				
				$eventAmountsByCurrency[$event->currency_id][$event->event_id] = $event->getOption('calculated_amount');
			}
			
			$bestEvents = [];
			foreach ($eventAmountsByCurrency as $currencyId => $eventAmounts)
			{
				if ($extraParams->negate)
				{
					// pick worst one
					asort($eventAmounts, SORT_NUMERIC);
				}
				else
				{
					// pick best one
					arsort($eventAmounts, SORT_NUMERIC);
				}
				
				$bestEvents[] = key($eventAmounts);
			}
			
			// Filter out the events that were not the best
			$events = $events->filter(function(Event $event) use ($bestEvents, $user)
			{
				if (!in_array($event->event_id, $bestEvents))
				{
					return false;
				}
				
				return true;
			});
		}
		
		if (!$user->user_id)
		{
			return $queue;
		}
		
		foreach ($events as $event)
		{
			/** @var \DBTech\Credits\Entity\Transaction $transaction */
			$transaction = $this->em()->create('DBTech\Credits:Transaction');
			$transaction->event_id = $event->event_id;
			$transaction->event_trigger_id = $event->event_trigger_id;
			$transaction->currency_id = $event->currency_id;
			$transaction->user_id = $user->user_id;
			$transaction->source_user_id = $extraParams->source_user_id;
			$transaction->owner_id = $extraParams->owner_id;
			$transaction->dateline = $extraParams->timestamp;
			$transaction->amount = $event->getOption('calculated_amount');
			$transaction->reference_id = ((!is_bool($refId) && !is_null($refId)) ? $refId : '');
			$transaction->negate = $extraParams->negate;
			$transaction->node_id = $extraParams->node_id;
			$transaction->multiplier = $extraParams->multiplier;
			$transaction->message = $extraParams->message;
			$transaction->content_type = $extraParams->content_type;
			$transaction->content_id = $extraParams->content_id;
			
			if ($event->moderate)
			{
				// Immediately set status to 2 so we don't need pro checks
				$transaction->status = 2;
			}
			else if (!$extraParams->negate)
			{
				$transaction->status = 1;
				
				// Init this
				$SQL = [];
				
				// Whether we need to check frequency
				$doFrequencyCheck = $event->frequency > 1;
				$doCurrencyCheck = $event->Currency->earnmax > 0;
				$doEventCheck = $event->applymax > 0;
				
				if ($doFrequencyCheck)
				{
					// We need to check for event frequency
					$SQL[] = 'SUM(event_id = ' . $event->event_id . ' AND status = 3 AND dateline >= (SELECT MAX(dateline) FROM xf_dbtech_credits_transaction WHERE event_id = ' . $event->event_id . ' AND user_id = ' . $user->user_id . ' AND status IN (1, 2) AND negate = 0)) AS skipped';
				}
				
				if ($doCurrencyCheck)
				{
					// We need to check for maximum
					$SQL[] = 'SUM(IF(currency_id = ' . $event->Currency->currency_id . ' AND status IN (1, 2)' . ($event->Currency->maxtime ? '' : ' AND dateline >= ' . (\XF::$time - $event->Currency->maxtime)) . ', amount, 0)) AS earned';
				}
				
				if ($doEventCheck)
				{
					// We need to check for maximum event applications
					$SQL[] = 'SUM(event_id = ' . $event->event_id . ' AND status IN (1, 2) AND negate = 0' . ($event->maxtime ? ' AND dateline >= ' . (\XF::$time - $event->maxtime) : '') . ') AS times';
				}
				
				if (count($SQL))
				{
					$stats = $this->app()->db()->fetchRow('
						SELECT ' . implode(', ', $SQL) . '
						FROM xf_dbtech_credits_transaction
						WHERE negate = 0
							AND user_id = ?
					', $user->user_id);
					
					if (
						(!$doCurrencyCheck || ($stats['earned'] + $transaction->amount) <= $event->Currency->earnmax)
						&& (!$doEventCheck || $stats['times'] < $event->applymax)
					)
					{
						// within maximums
						if ($doFrequencyCheck && ($stats['skipped'] + 1) < $event->frequency)
						{
							// The event has not been skipped enough times just yet
							$transaction->status = 3;
						}
					}
					else
					{
						// exceeded maximums
						$transaction->status = 4;
					}
				}
			}
			else
			{
				$transaction->status = 1;
			}
			
			$queue[] = $transaction;
		}
		
		if ($queue && $refId !== NULL)
		{
			// Only commit if we have a refId
			
			$db = $this->app()->db();
			$db->beginTransaction();
			
			foreach ($queue as $i => $transaction)
			{
				// Make sure we toggle alerts when needed
				$transaction->setOption('enableAlert', $extraParams->enableAlert);
				
				if (!$transaction->save(true, false))
				{
					$db->rollback();
					return $queue;
				}
				
				if ($extraParams->runPostSave)
				{
					// Handle postSave
					$this->postSave($transaction);
				}
				
				unset($queue[$i]);
			}
			
			$db->commit();
			
			return $queue;
		}
		
		// Return all the transactions we otherwise would have committed
		return $queue;
	}
	
	/**
	 * @param int $currencyId
	 */
	protected function assertEventExists($currencyId = 0)
	{
		// This will be overridden by child events
		return;
	}
	
	/**
	 * @param Event $event
	 * @param \XF\Entity\User $user
	 * @param \ArrayObject $extraParams
	 *
	 * @return bool
	 */
	protected function assertEvent(Event $event, \XF\Entity\User $user, \ArrayObject $extraParams)
	{
		if (
			!$this->getOption('isGlobal')
			&& count($event->node_ids)
			&& !in_array(-1, $event->node_ids)
			&& !in_array($extraParams->node_id, $event->node_ids)
		)
		{
			return false;
		}
		
		if (
			$this->getOption('useUserGroups')
			&& count($event->user_group_ids)
			&& !in_array(-1, $event->user_group_ids)
			&& !$user->isMemberOf($event->user_group_ids)
		)
		{
			return false;
		}
		
		if (
			$this->getOption('useOwner')
			&& (
				($event->owner == 1 && $user->user_id == $extraParams->owner_id)
				|| ($event->owner == 2 && $user->user_id != $extraParams->owner_id)
			)
		)
		{
			return false;
		}
		
		return true;
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @return bool
	 */
	protected function postSave(Transaction $transaction)
	{
		return true;
	}
	
	/**
	 * @param $lastId
	 * @param $amount
	 *
	 * @return bool|mixed
	 */
	public function rebuildRange($lastId, $amount)
	{
		$entities = $this->getContentInRange($lastId, $amount);
		if (!$entities->count())
		{
			return false;
		}
		
		$this->rebuildEntities($entities);
		
		$keys = $entities->keys();
		return $keys ? max($keys) : false;
	}
	
	/**
	 * @param $lastId
	 * @param $amount
	 * @param bool $forView
	 *
	 * @return ArrayCollection
	 */
	public function getContentInRange($lastId, $amount, $forView = false)
	{
		$entityId = $this->getContentTypeEntity($this->contentType);
		
		$em = \XF::em();
		try
		{
			$key = $em->getEntityStructure($entityId)->primaryKey;
		}
		catch (\LogicException $e)
		{
			return $em->getEmptyCollection();
		}
		
		if (is_array($key))
		{
			if (count($key) > 1)
			{
				throw new \LogicException("Entity $entityId must only have a single primary key");
			}
			$key = reset($key);
		}
		
		$finder = $em->getFinder($entityId)->where($key, '>', $lastId)
			->order($key)
			->with($this->getEntityWith($forView));
		
		return $finder->fetch($amount);
	}
	
	/**
	 * @param $entities
	 */
	public function rebuildEntities($entities)
	{
		foreach ($entities AS $entity)
		{
			$this->rebuild($entity);
		}
	}
	
	/**
	 * @param $entity
	 */
	public function rebuild($entity)
	{
	}
	
	/**
	 * @param $string
	 *
	 * @return int
	 */
	protected function contentSize($string)
	{
		$stringFormatter = $this->app()->stringFormatter();
		
		$string = preg_replace(
			'#\[(code|icode)[^\]]*\].*\[/\\1\]#siU',
			'',
			$string
		);
		$string = $stringFormatter->stripBbCode($string, [
			'stripQuote' => true,
		]);
		
		return count($this->options()->dbtech_credits_size_words ? $this->splitWords($string) : $this->splitChars($string));
	}
	
	/**
	 * @param $string
	 *
	 * @return string[]
	 */
	protected function splitWords($string)
	{
		return preg_split('/(\s+)/', $string, 0, PREG_SPLIT_NO_EMPTY);
	}
	
	/**
	 * @param $string
	 *
	 * @return string[]
	 */
	protected function splitChars($string)
	{
		$characters = preg_split('/(.)/', $string, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
		return array_filter($characters, function($v, $k)
		{
			if (empty(trim($v)))
			{
				return false;
			}
			
			return true;
		}, ARRAY_FILTER_USE_BOTH);
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @return string
	 */
	public function alertTemplate(Transaction $transaction)
	{
		return '';
	}
	
	/**
	 * @param Event $event
	 *
	 * @return string
	 */
	public function renderOptions(Event $event)
	{
		$templateName = $this->getOptionsTemplate();
		if (!$templateName)
		{
			return '';
		}
		return $this->app()->templater()->renderTemplate(
			$templateName, array_merge($this->getDefaultTemplateParams('options'), ['event' => $event])
		);
	}
	
	/**
	 * @return string|null
	 */
	public function getOptionsTemplate()
	{
		return 'admin:dbtech_credits_event_edit_' . $this->contentType;
	}
	
	/**
	 * @param array $input
	 *
	 * @return array
	 */
	public function filterOptions(array $input = [])
	{
		return $input;
	}
	
	/**
	 * @param $context
	 *
	 * @return array
	 */
	protected function getDefaultTemplateParams($context)
	{
		return [
			'title' => $this->getTitle(),
			'options' => $this->options
		];
	}
	
	/**
	 * @param $phraseKey
	 * @param Transaction $transaction
	 * @param array $params
	 *
	 * @return \XF\Phrase
	 */
	protected function getAlertPhrase($phraseKey, Transaction $transaction, array $params = [])
	{
		$amount = abs($transaction->amount);
		$params = array_replace($params, [
			'currency' => new \XF\PreEscaped('<a href="' .
				\XF::app()->router()->buildLink('canonical:dbtech-credits/currency', $transaction->Currency) .
				'" class="fauxBlockLink-blockLink" data-xf-click="overlay">' .
					$transaction->Currency->prefix .
					$transaction->Currency->getFormattedValue($amount) .
					$transaction->Currency['suffix'] . ' ' . $transaction->Currency->title .
				'</a>')
		]);
		
		return \XF::phrase($phraseKey, $params);
	}
	
	/**
	 * @param $type
	 * @param bool $throw
	 *
	 * @return AbstractHandler|null
	 * @throws \Exception
	 */
	protected function getHandler($type, $throw = true)
	{
		return $this->getEventTriggerRepo()->getHandler($type, $throw);
	}
	
	/**
	 * @return \DBTech\Credits\Repository\EventTrigger|\XF\Mvc\Entity\Repository
	 */
	protected function getEventTriggerRepo()
	{
		return \XF::repository('DBTech\Credits:EventTrigger');
	}
	
	/**
	 * @return \ArrayObject
	 */
	protected function options()
	{
		return \XF::app()->options();
	}
	
	/**
	 * @param string $identifier
	 *
	 * @return \XF\Mvc\Entity\Finder
	 */
	public static function finder($identifier)
	{
		return \XF::app()->finder($identifier);
	}
	
	/**
	 * @return \XF\Mvc\Entity\Manager
	 */
	protected function em()
	{
		return \XF::app()->em();
	}
	
	/**
	 * @return \XF\App
	 */
	protected function app()
	{
		return \XF::app();
	}
}