<?php

namespace DBTech\Credits\EventTrigger;

use DBTech\Credits\Entity\Transaction;

/**
 * Class Tag
 *
 * @package DBTech\Credits\EventTrigger
 */
class Tag extends AbstractHandler
{
	/**
	 *
	 */
	protected function setupOptions()
	{
		$this->options = array_replace($this->options, [
			'canRevert' => true,
			'canCancel' => true,
			'useOwner' => true,
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
		// For the benefit of the template
		$which = $transaction->amount < 0 ? 'spent' : 'earned';
		
		if ($transaction->negate)
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_tag_negate', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_tag_negate', $transaction);
			}
			
		}
		else
		{
			if ($which == 'spent')
			{
				return $this->getAlertPhrase('dbtech_credits_lost_x_y_via_tag', $transaction);
			}
			else
			{
				return $this->getAlertPhrase('dbtech_credits_gained_x_y_via_tag', $transaction);
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
		
		$labels['owner_explain'] = \XF::phrase('dbtech_credits_event_owner_explain_thread');
		$labels['owner_only_others'] = \XF::phrase('dbtech_credits_event_owner_only_others_thread');
		$labels['owner_only_own'] = \XF::phrase('dbtech_credits_event_owner_only_own_thread');
		
		return $labels;
	}
	
	/**
	 * @param $entity
	 *
	 * @throws \XF\PrintableException
	 */
	public function rebuild($entity)
	{
		/** @var \DBTech\Credits\XF\Entity\TagContent $entity */
		
		$contentInfo = $entity->getContent();
		if ($contentInfo !== NULL)
		{
			$nodeId = 0;
			switch ($entity->content_type)
			{
				case 'tl_group':
					return;
					break;
				
				case 'thread':
					$nodeId = $contentInfo->node_id;
					break;
			}
			
			$this->apply($entity->tag_content_id, [
				'node_id' => $nodeId,
				'owner_id' => $contentInfo->user_id,
				
				'content_type' => $entity->content_type,
				'content_id' => $entity->content_id,
				
				'timestamp' => $entity->add_date,
				'enableAlert' => false,
				'runPostSave' => false
			], $entity->AddUser);
		}
	}
	
	/**
	 * @param bool $forView
	 *
	 * @return array
	 */
	public function getEntityWith($forView = false)
	{
		return ['AddUser'];
	}
}