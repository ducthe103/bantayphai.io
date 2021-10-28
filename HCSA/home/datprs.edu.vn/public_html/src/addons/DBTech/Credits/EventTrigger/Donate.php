<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Donate
 *
 * @package DBTech\Credits\EventTrigger
 */
class Donate extends AbstractHandler
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
		/** @var \DBTech\Credits\Entity\DonationLog $log */
		$log = $this->em()->create('DBTech\Credits:DonationLog');
		$log->user_id = $transaction->user_id;
		$log->donation_date = $transaction->dateline;
		$log->donation_user_id = $transaction->source_user_id;
		$log->event_id = $transaction->event_id;
		$log->currency_id = $transaction->currency_id;
		$log->amount = $transaction->amount;
		$log->message = $transaction->message;
		$log->save();
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
		/** @var \DBTech\Credits\Entity\DonationLog $entity */
		$func = $entity->amount < 0 ? 'undo' : 'apply';
		
		// Then properly add or remove credits
		$this->$func($entity->donation_user_id, [
			'currency_id' => $entity->currency_id,
			'multiplier' => $entity->amount,
			'message' => $entity->message,
			'source_user_id' => $entity->donation_user_id,
			
			'timestamp' => $entity->donation_date,
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
		return ['User', 'DonatedBy'];
	}
}