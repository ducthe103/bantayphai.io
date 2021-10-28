<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Birthday
 *
 * @package DBTech\Credits\EventTrigger
 */
class Birthday extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'isGlobal' => true,
			
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
		
		if ($which == 'spent')
		{
			return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_birthday', $transaction);
		}
		else
		{
			return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_birthday', $transaction);
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
		
		$labels['minimum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_year_minimum_amount');
		$labels['maximum_amount'] = \XF::phrase('dbtech_credits_eventtrigger_year_maximum_amount');
		$labels['minimum_action'] = \XF::phrase('dbtech_credits_eventtrigger_year_minimum_action');
		$labels['minimum_action_explain'] = \XF::phrase('dbtech_credits_eventtrigger_year_minimum_action_explain');
		$labels['multiplier_addition'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_year_addition');
		$labels['multiplier_addition_explain'] = \XF::phrase('dbtech_credits_eventtrigger_multiplier_year_addition_explain');
		
		return $labels;
	}
}