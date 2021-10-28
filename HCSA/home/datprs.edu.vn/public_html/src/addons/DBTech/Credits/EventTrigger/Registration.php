<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Registration
 *
 * @package DBTech\Credits\EventTrigger
 */
class Registration extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			'canCharge' => false,
			'useUserGroups' => false,
			'canRebuild' => true,
		]);
	}
	
	/**
	 * @param Transaction $transaction
	 *
	 * @return mixed
	 */
	public function alertTemplate(Transaction $transaction)
	{
		return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_registration', $transaction);
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
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\User $entity */
		
		$this->apply($entity->user_id, [
			'source_user_id' => $entity->user_id,
			
			'content_type' => 'user',
			'content_id' => $entity->user_id,
			
			'timestamp' => $entity->register_date,
			'enableAlert' => false,
			'runPostSave' => false
		], $entity);
	}
}