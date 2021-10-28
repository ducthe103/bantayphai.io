<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Adjust
 *
 * @package DBTech\Credits\EventTrigger
 */
class Adjust extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			'canRevert' => true,
			'canCancel' => true,
			'useUserGroups' => false,
			'canRebuild' => true,
			
			'multiplier' => self::MULTIPLIER_CURRENCY
		]);
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @throws \XF\PrintableException
	 */
	protected function postSave(Transaction $transaction)
	{
		/** @var \DBTech\Credits\Entity\AdjustLog $log */
		$log = $this->em()->create('DBTech\Credits:AdjustLog');
		$log->user_id = $transaction->user_id;
		$log->adjust_date = $transaction->dateline;
		$log->adjust_user_id = $transaction->source_user_id;
		$log->event_id = $transaction->event_id;
		$log->currency_id = $transaction->currency_id;
		$log->amount = $transaction->amount;
		$log->message = $transaction->message;
		$log->save();
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @return mixed
	 */
	public function alertTemplate(Transaction $transaction)
	{
		// For the benefit of the template
		$which = $transaction->amount < 0 ? 'spent' : 'earned';
		
		if ($transaction->source_user_id == $transaction->user_id)
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_removed_x_y_via_adjust', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_added_x_y_via_adjust', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_x_took_y_z_via_adjust', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_x_gave_y_z_via_adjust', $transaction);
			}
		}
	}
	
	/**
	 * @return string|null
	 */
	public function getOptionsTemplate()
	{
		return null;
	}
	
	/**
	 * @param $entity
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\Entity\AdjustLog $entity */
		$func = $entity->amount < 0 ? 'undo' : 'apply';
		
		// Then properly add or remove credits
		$this->$func($entity->adjust_user_id, [
			'currency_id' => $entity->currency_id,
			'multiplier' => $entity->amount,
			'message' => $entity->message,
			'source_user_id' => $entity->adjust_user_id,
			
			'timestamp' => $entity->adjust_date,
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
		return ['User', 'AdjustedBy'];
	}
}