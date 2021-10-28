<?php

namespace DBTech\Credits\Cron;

/**
 * Class Event
 *
 * @package DBTech\Credits\Cron
 */
class Event
{
	/**
	 * @throws \Exception
	 */
	public static function birthday()
	{
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = \XF::repository('DBTech\Credits:EventTrigger');
		$eventTriggerRepo->cronBirthday();
	}
}