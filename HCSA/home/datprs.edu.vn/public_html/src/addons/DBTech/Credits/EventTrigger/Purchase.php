<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Event;
use DBTech\Credits\Entity\Transaction;

/**
 * Class Purchase
 *
 * @package DBTech\Credits\EventTrigger
 */
class Purchase extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			'canRevert' => true,
			'useOwner' => true,
			'canRebuild' => true,
			
			'multiplier' => self::MULTIPLIER_CURRENCY
		]);
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @throws \Exception
	 */
	protected function postSave(Transaction $transaction)
	{
		/** @var \DBTech\Credits\Entity\PurchaseTransaction $log */
		$log = $this->em()->create('DBTech\Credits:PurchaseTransaction');
		$log->event_id = $transaction->event_id;
		$log->user_id = $transaction->user_id;
		$log->from_user_id = $transaction->source_user_id;
		$log->transaction_date = $transaction->dateline;
		$log->currency_id = $transaction->currency_id;
		$log->amount = $transaction->amount;
		$log->message = $transaction->message;
		$log->save();
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
			!$event->getSetting('purchase_amount')
			|| $event->getSetting('purchase_amount') != abs($extraParams->multiplier)
		)
		{
			return false;
		}
		
		return parent::assertEvent($event, $user, $extraParams);
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @return mixed
	 */
	public function alertTemplate(Transaction $transaction)
	{
		if ($transaction->source_user_id == $transaction->user_id)
		{
			if ($transaction->negate)
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_purchase_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_purchased_x_y_via_purchase', $transaction);
			}
			
		}
		else
		{
			if ($transaction->negate)
			{
				return $this->getAlertPhrase('dbtech_credits_x_took_y_z_via_purchase_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_x_gifted_y_z_via_purchase', $transaction);
			}
		}
	}
	
	/**
	 * @return array
	 */
	public function getLabels()
	{
		$labels = parent::getLabels();
		
		$labels['owner_explain'] = \XF::phrase('dbtech_credits_event_owner_explain_account');
		$labels['owner_only_others'] = \XF::phrase('dbtech_credits_event_owner_only_others_account');
		$labels['owner_only_own'] = \XF::phrase('dbtech_credits_event_owner_only_own_account');
		
		return $labels;
	}
	
	/**
	 * @param array $input
	 *
	 * @return array
	 */
	public function filterOptions(array $input = [])
	{
		return $this->app()->inputFilterer()->filterArray($input, [
			'purchase_description' => 'str',
			'purchase_cost' => 'unum',
			'purchase_amount' => 'unum',
			'payment_profile_ids' => 'array-uint',
		]);
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\Entity\PurchaseTransaction $entity */
		
		$this->apply($entity->transaction_id, [
			'currency_id' => $entity->currency_id,
			'multiplier' => $entity->amount,
			'message' => $entity->message,
			
			'timestamp' => $entity->transaction_date,
			'enableAlert' => false,
			'runPostSave' => false
		], $entity->User);
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return ['User'];
	}
}