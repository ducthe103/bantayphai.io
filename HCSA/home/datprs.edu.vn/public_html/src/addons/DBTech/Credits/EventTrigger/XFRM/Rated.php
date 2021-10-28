<?php

namespace DBTech\Credits\EventTrigger\XFRM;

use DBTech\Credits\EventTrigger\AbstractHandler;
use DBTech\Credits\Entity\Event;
use DBTech\Credits\Entity\Transaction;

/**
 * Class Rated
 *
 * @package DBTech\Credits\EventTrigger\XFRM
 */
class Rated extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			'canRevert' => true,
			'canRebuild' => true,
			
			'multiplier' => self::MULTIPLIER_LABEL
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
			'apply_guest' => false,
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
			!$event->getSetting('apply_guest')
			&& !$user->user_id
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
		// For the benefit of the template
		$which = $transaction->amount < 0 ? 'spent' : 'earned';
		
		if ($transaction->negate)
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_resourcerated_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_resourcerated_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_resourcerated', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_resourcerated', $transaction);
			}
		}
	}
	
	/**
	 * @return array
	 */
	public function getLabels()
	{
		$labels = parent::getLabels();
		
		$labels['minimum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_star_minimum_amount');
		$labels['maximum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_star_maximum_amount');
		$labels['minimum_action'] = \XF::phrase('dbtech_credits_eventtrigger_star_minimum_action');
		$labels['minimum_action_explain'] = \XF::phrase('dbtech_credits_eventtrigger_star_minimum_action_explain');
		$labels['multiplier_addition'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_star_addition');
		$labels['multiplier_addition_explain'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_star_addition_explain');
		$labels['multiplier_negation'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_star_negation');
		$labels['multiplier_negation_explain'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_star_negation_explain');
		
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
			'apply_guest' => 'bool',
		]);
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \XFRM\Entity\ResourceRating $entity */
		
		if ($entity->user_id != $entity->Resource->user_id)
		{
			$this->apply($entity->resource_rating_id, [
				'multiplier'     => $entity->rating,
				'source_user_id' => $entity->user_id,
				
				'content_type' => 'resource_rating',
				'content_id'   => $entity->resource_rating_id,
				
				'timestamp'   => $entity->rating_date,
				'enableAlert' => false,
				'runPostSave' => false
			], $entity->Resource->User);
		}
	}
}