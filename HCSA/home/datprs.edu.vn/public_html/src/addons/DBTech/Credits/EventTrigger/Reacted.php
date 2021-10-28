<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Event;
use DBTech\Credits\Entity\Transaction;

/**
 * Class Reacted
 *
 * @package DBTech\Credits\EventTrigger
 */
class Reacted extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'canRevert' => true,
			'canCancel' => true,
			'canRebuild' => true,
		]);
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
		if ($extraParams->reaction_id)
		{
			$reactionIds = $event->getSetting('reaction_ids');
			
			if (
				$reactionIds
				&& !in_array(-1, $reactionIds)
				&& !in_array($extraParams->reaction_id, $reactionIds)
			)
			{
				// This reaction didn't count
				return false;
			}
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
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_reacted_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_reacted_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_reacted', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_reacted', $transaction);
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
			'reaction_ids' => 'array-uint',
		]);
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\ReactionContent $entity */
		
		$contentInfo = $entity->getContent();
		if ($contentInfo !== NULL)
		{
			$nodeId = 0;
			
			switch ($entity->content_type)
			{
				case 'post':
					/** @var \XF\Entity\Post $contentInfo */
					$nodeId = $contentInfo->Thread->node_id;
					break;
			}
			
			if ($entity->reaction_user_id != $entity->content_user_id)
			{
				$this->apply($entity->reaction_content_id, [
					'node_id'        => $nodeId,
					'source_user_id' => $entity->reaction_user_id,
					'reaction_id'    => $entity->reaction_id,
					
					'content_type' => $entity->content_type,
					'content_id'   => $entity->content_id,
					
					'timestamp'   => $entity->reaction_date,
					'enableAlert' => false,
					'runPostSave' => false
				], $entity->Owner);
			}
		}
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return ['Owner'];
	}
}