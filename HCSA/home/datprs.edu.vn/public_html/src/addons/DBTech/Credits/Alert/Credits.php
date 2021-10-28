<?php

namespace DBTech\Credits\Alert;

use XF\Mvc\Entity\Entity;
use XF\Alert\AbstractHandler;
use XF\Entity\UserAlert;

/**
 * Class Credits
 *
 * @package DBTech\Credits\Alert
 */
class Credits extends AbstractHandler
{
	/**
	 * @return array
	 */
	public function getEntityWith()
	{
		return ['Currency', 'Event', 'TargetUser', 'SourceUser'];
	}
	
	/**
	 * @param $action
	 *
	 * @return string
	 */
	public function getTemplateName($action)
	{
		switch ($action)
		{
			case 'adjust':
			case 'donate':
				return parent::getTemplateName($action);
				break;
			
			default:
				return 'public:alert_' . $this->contentType;
				break;
		}
	}
	
	/**
	 * @param $action
	 *
	 * @return string
	 */
	public function getPushTemplateName($action)
	{
		switch ($action)
		{
			case 'adjust':
			case 'donate':
				return parent::getPushTemplateName($action);
				break;
			
			default:
				return 'public:push_' . $this->contentType;
				break;
		}
	}
	
	/**
	 * @param $action
	 * @param UserAlert $alert
	 * @param Entity|null $content
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function getTemplateData($action, UserAlert $alert, Entity $content = null)
	{
		/** @var \DBTech\Credits\Entity\Transaction $content */
		$item = parent::getTemplateData($action, $alert, $content);
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = \XF::repository('DBTech\Credits:EventTrigger');
		
		switch ($action)
		{
			case 'adjust':
			case 'donate':
				$item['amount'] = abs($content->amount);
				break;
			
			default:
				$item['phrase'] = $eventTriggerRepo->getHandler($content->event_trigger_id)
					->alertTemplate($content);
				break;
		}
		
		return $item;
	}
	
	/**
	 * @return array
	 * @throws \Exception
	 */
	public function getOptOutActions()
	{
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = \XF::repository('DBTech\Credits:EventTrigger');
		
		return $eventTriggerRepo
			->getEventTriggers(true, true)
			->pluck(function(\DBTech\Credits\EventTrigger\AbstractHandler $e, $k)
			{
				return [$k, $e->getContentType()];
			}, false)
		;
	}
	
	/**
	 * The display order of this type's alert opt outs.
	 *
	 * @return int
	 */
	public function getOptOutDisplayOrder()
	{
		return 90000;
	}
}