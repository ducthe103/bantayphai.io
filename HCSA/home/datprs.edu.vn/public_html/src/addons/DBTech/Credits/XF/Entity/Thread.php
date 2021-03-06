<?php

namespace DBTech\Credits\XF\Entity;

class Thread extends XFCP_Thread
{
	/**
	 * @throws \Exception
	 */
	protected function _preSave()
	{
		// Do parent stuff
		$previous = parent::_preSave();

		if (!$this->user_id OR $this->discussion_type == 'redirect')
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		// Init the event
		$threadEvent = $eventTriggerRepo->getHandler('thread');
		$stickyEvent = $eventTriggerRepo->getHandler('sticky');

		if ($this->isUpdate())
		{
			$visibilityChange = $this->isStateChanged('discussion_state', 'visible');

			if ($visibilityChange == 'leave')
			{
				if ($this->getExistingValue('sticky'))
				{
					// Undo the sticky event
					$stickyEvent->testUndo([
						'node_id' => $this->getExistingValue('node_id')
					], $this->User);
				}

				// Undo the thread event
				$threadEvent->testUndo([
					'node_id' => $this->getExistingValue('node_id'),
					'multiplier' => $this->FirstPost->message
				], $this->User);
			}
			else if ($visibilityChange == 'enter')
			{
				if ($this->get('sticky'))
				{
					// Apply the sticky event
					$stickyEvent->testApply([
						'node_id' => $this->node_id
					], $this->User);
				}

				// Apply the thread event
				$threadEvent->testApply([
					'node_id' => $this->node_id,
					'multiplier' => $this->FirstPost->message
				], $this->User);
			}
			else if ($this->isChanged('sticky'))
			{
				if ($this->getExistingValue('sticky'))
				{
					// Undo previous sticky event
					$stickyEvent->testUndo([
						'node_id' => $this->getExistingValue('node_id')
					], $this->User);
				}
				else if ($this->get('sticky'))
				{
					// Apply the sticky event
					$stickyEvent->testApply([
						'node_id' => $this->node_id
					], $this->User);
				}
			}
		}
		else if ($this->get('sticky'))
		{
			// Apply the sticky event
			$stickyEvent->testApply([
				'node_id' => $this->node_id
			], $this->User);
		}

		return $previous;
	}
	
	/**
	 * @throws \Exception
	 */
	protected function _postSave()
	{
		// Do parent stuff
		$previous = parent::_postSave();

		if (!$this->user_id OR $this->discussion_type == 'redirect')
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		// Init the event
		$threadEvent = $eventTriggerRepo->getHandler('thread');
		$stickyEvent = $eventTriggerRepo->getHandler('sticky');

		if ($this->isUpdate())
		{
			$visibilityChange = $this->isStateChanged('discussion_state', 'visible');

			if ($visibilityChange == 'leave')
			{
				if ($this->getExistingValue('sticky'))
				{
					// Undo the sticky event
					$stickyEvent->undo($this->thread_id, [
						'node_id' => $this->getExistingValue('node_id'),
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}

				// Undo the thread event
				$threadEvent->undo($this->thread_id, [
					'node_id' => $this->getExistingValue('node_id'),
					'multiplier' => $this->FirstPost->message,
					'content_type' => 'thread',
					'content_id' => $this->thread_id
				], $this->User);
			}
			else if ($visibilityChange == 'enter')
			{
				if ($this->get('sticky'))
				{
					// Apply the sticky event
					$stickyEvent->apply($this->thread_id, [
						'node_id' => $this->node_id,
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}

				// Apply the thread event
				$threadEvent->apply($this->thread_id, [
					'node_id' => $this->node_id,
					'multiplier' => $this->FirstPost->message,
					'content_type' => 'thread',
					'content_id' => $this->thread_id
				], $this->User);
			}
			else if ($this->isChanged('sticky'))
			{
				if ($this->getExistingValue('sticky'))
				{
					// Undo previous sticky event
					$stickyEvent->undo($this->thread_id, [
						'node_id' => $this->getExistingValue('node_id'),
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}
				else if ($this->get('sticky'))
				{
					// Apply the sticky event
					$stickyEvent->apply($this->thread_id, [
						'node_id' => $this->node_id,
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}
			}
		}
		else if ($this->get('sticky'))
		{
			// Apply the sticky event
			$stickyEvent->apply($this->thread_id, [
				'node_id' => $this->node_id,
				'content_type' => 'thread',
				'content_id' => $this->thread_id
			], $this->User);
		}

		return $previous;
	}
	
	/**
	 * @throws \Exception
	 */
	protected function _preDelete()
	{
		// Do parent stuff
		$previous = parent::_preDelete();

		if (!$this->user_id OR $this->discussion_type == 'redirect')
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		// Init the event
		$threadEvent = $eventTriggerRepo->getHandler('thread');
		$stickyEvent = $eventTriggerRepo->getHandler('sticky');

		if ($this->sticky)
		{
			// Undo the sticky event
			$stickyEvent->testUndo([
				'node_id' => $this->node_id
			], $this->User);
		}

		// Undo the thread event
		$threadEvent->testUndo([
			'node_id' => $this->node_id,
			'multiplier' => $this->FirstPost->message
		], $this->User);

		return $previous;
	}
	
	/**
	 * @throws \Exception
	 */
	protected function _postDelete()
	{
		// Do parent stuff
		$previous = parent::_postDelete();

		if (!$this->user_id OR $this->discussion_type == 'redirect')
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		// Init the event
		$threadEvent = $eventTriggerRepo->getHandler('thread');
		$stickyEvent = $eventTriggerRepo->getHandler('sticky');

		if ($this->sticky)
		{
			// Apply the sticky event
			$stickyEvent->undo($this->thread_id, [
				'node_id' => $this->node_id,
				'content_type' => 'thread',
				'content_id' => $this->thread_id
			], $this->User);
		}

		// Undo the thread event
		$threadEvent->undo($this->thread_id, [
			'node_id' => $this->node_id,
			'multiplier' => $this->FirstPost->message,
			'content_type' => 'thread',
			'content_id' => $this->thread_id
		], $this->User);

		return $previous;
	}
}