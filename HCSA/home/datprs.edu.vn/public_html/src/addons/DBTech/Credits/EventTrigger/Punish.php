<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Punish
 *
 * @package DBTech\Credits\EventTrigger
 */
class Punish extends AbstractHandler
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
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_punish_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_punish_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_punish', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_punish', $transaction);
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
	 * @return array
	 */
	public function getLabels()
	{
		$labels = parent::getLabels();
		
		$labels['minimum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_point_minimum_amount');
		$labels['maximum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_point_maximum_amount');
		$labels['minimum_action'] = \XF::phrase('dbtech_credits_eventtrigger_point_minimum_action');
		$labels['minimum_action_explain'] = \XF::phrase('dbtech_credits_eventtrigger_point_minimum_action_explain');
		$labels['multiplier_addition'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_point_addition');
		$labels['multiplier_addition_explain'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_point_addition_explain');
		$labels['multiplier_negation'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_point_negation');
		$labels['multiplier_negation_explain'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_point_negation_explain');
		
		return $labels;
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\Warning $entity */
		
		$this->apply($entity->warning_id, [
			'multiplier' => $entity->points,
			'source_user_id' => $entity->user_id,
			
			'content_type' => $entity->content_type,
			'content_id'   => $entity->content_id,
			
			'timestamp'   => $entity->warning_date,
			'enableAlert' => false,
			'runPostSave' => false
		], $entity->WarnedBy);
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return ['WarnedBy'];
	}
}