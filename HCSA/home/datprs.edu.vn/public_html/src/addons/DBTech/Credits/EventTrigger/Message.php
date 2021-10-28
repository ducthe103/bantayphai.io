<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Message
 *
 * @package DBTech\Credits\EventTrigger
 */
class Message extends AbstractHandler
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
			
			'multiplier' => self::MULTIPLIER_SIZE,
		]);
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
			return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_message', $transaction);
		}
		else
		{
			return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_message', $transaction);
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
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\ConversationMessage $entity */

		$this->apply($entity->message_id, [
			'multiplier' => $entity->message,
			
			'content_type' => 'conversation_message',
			'content_id' => $entity->message_id,
			
			'timestamp' => $entity->message_date,
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