<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Transfer
 *
 * @package DBTech\Credits\EventTrigger
 */
class Transfer extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			'canCancel' => true,
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
		/** @var \DBTech\Credits\Entity\TransferLog $log */
		$log = $this->em()->create('DBTech\Credits:TransferLog');
		$log->user_id = $transaction->user_id;
		$log->transfer_date = $transaction->dateline;
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
		
		if ($which == 'spent')
		{
			return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_transfer', $transaction);
		}
		else
		{
			return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_transfer', $transaction);
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
		/** @var \DBTech\Credits\Entity\TransferLog $entity */
		$func = $entity->amount < 0 ? 'undo' : 'apply';
		
		// Then properly add or remove credits
		$this->$func($entity->user_id, [
			'currency_id' => $entity->currency_id,
			'multiplier' => $entity->amount,
			'message' => $entity->message,
			
			'timestamp' => $entity->transfer_date,
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