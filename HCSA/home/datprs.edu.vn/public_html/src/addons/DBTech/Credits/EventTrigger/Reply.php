<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Event;
use DBTech\Credits\Entity\Transaction;

/**
 * Class Reply
 *
 * @package DBTech\Credits\EventTrigger
 */
class Reply extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'canRevert' => true,
			'canRebuild' => true,
		]);
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
			'thread_id' => 0,
		], $extraParams);
		
		return parent::trigger($user, $refId, $negate, $extraParams);
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
			$event->getSetting('threadid')
			&& $event->getSetting('threadid') != $extraParams->thread_id
		)
		{
			// Skip this
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
		// For the benefit of the template
		$which = $transaction->amount < 0 ? 'spent' : 'earned';
		
		if ($transaction->negate)
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_reply_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_reply_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_reply', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_reply', $transaction);
			}
		}
	}
	
	/**
	 * @param array $input
	 *
	 * @return array
	 */
	public function filterOptions(array $input = [])
	{
		return $this->app()->inputFilterer()->filterArray($input, [
			'threadid' => 'uint',
		]);
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\Post $entity */
		
		if (!$entity->isFirstPost() && $entity->isVisible())
		{
			$this->apply($entity->post_id, [
				'node_id' => $entity->Thread->node_id,
				'thread_id' => $entity->thread_id,
				'source_user_id'  => $entity->user_id,
				
				'content_type' => 'post',
				'content_id'   => $entity->post_id,
				
				'timestamp'   => $entity->post_date,
				'enableAlert' => false,
				'runPostSave' => false
			], $entity->Thread->User);
		}
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return ['Thread', 'Thread.User'];
	}
}