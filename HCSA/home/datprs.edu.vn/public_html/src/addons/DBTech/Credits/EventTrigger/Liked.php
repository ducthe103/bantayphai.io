<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Liked
 *
 * @package DBTech\Credits\EventTrigger
 */
class Liked extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'canRevert' => true,
			'canCancel' => true,
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
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_liked_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_liked_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_liked', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_liked', $transaction);
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
}