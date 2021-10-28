<?php

namespace DBTech\Credits\XF\Entity;

class Post extends XFCP_Post
{
	public function getQuoteWrapper($inner)
	{
		return parent::getQuoteWrapper(preg_replace(
			'#\[' . preg_quote(\XF::options()->dbtech_credits_eventtrigger_content_bbcode, '#') . '=(\d+|\d+[.,](\d+))\](.*)\[\/' . preg_quote(\XF::options()->dbtech_credits_eventtrigger_content_bbcode, '#') . '\]#i',
			\XF::phrase('dbtech_credits_stripped_content'),
			$inner
		));
	}
	
	/**
	 * @throws \Exception
	 */
	protected function _preSave()
	{
		// Do parent stuff
		$previous = parent::_preSave();

		if (!$this->user_id)
		{
			return $previous;
		}

		if ($this->isUpdate())
		{
			// Get thread info
			$previousThread = $this->isChanged('thread_id')
				? \XF::em()->find('XF:Thread', $this->getPreviousValue('thread_id'))
				: $this->Thread;
		}
		else
		{
			// Will probably never hit, but best to be safe
			$previousThread = $this->Thread;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		if ($this->isFirstPost())
		{
			// Shorthand
			$visibilityChange = $this->Thread->isStateChanged('discussion_state', 'visible');
			
			// BEGIN THREAD EVENT
			// Init the event
			$threadEvent = $eventTriggerRepo->getHandler('thread');

			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$threadEvent->testUndo([
						'multiplier' => $this->getPreviousValue('message'),
						'node_id' => $previousThread->node_id
					], $this->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$threadEvent->testApply([
						'multiplier' => $this->message,
						'node_id' => $this->Thread->node_id
					], $this->User);
				}
				else if (
					$this->isChanged('thread_id')
					|| $this->isChanged('user_id')
					|| $this->isChanged('message')
				)
				{
					// Undo the previous event
					$threadEvent->testUndo([
						'multiplier' => $this->getPreviousValue('message'),
						'node_id' => $previousThread->node_id
					], $this->User);

					// Apply the new event
					$threadEvent->testApply([
						'multiplier' => $this->message,
						'node_id' => $this->Thread->node_id
					], $this->User);
				}
			}
			else if ($this->Thread->discussion_state == 'visible')
			{
				// Apply the new event
				$threadEvent->testApply([
					'multiplier' => $this->message,
					'node_id' => $this->Thread->node_id
				], $this->User);
			}
			// END THREAD EVENT
		}
		else
		{
			// Shorthand
			$visibilityChange = $this->isStateChanged('message_state', 'visible');
			
			// BEGIN POST EVENT
			// Init the event
			$postEvent = $eventTriggerRepo->getHandler('post');

			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$postEvent->testUndo([
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'multiplier' => $this->getPreviousValue('message'),
						'owner_id' => $previousThread->user_id
					], $this->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$postEvent->testApply([
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id' => $this->Thread->user_id
					], $this->User);
				}
				else if (
					$this->isChanged('thread_id')
					|| $this->isChanged('user_id')
					|| $this->isChanged('message')
				)
				{
					// Undo the previous event
					$postEvent->testUndo([
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'multiplier' => $this->getPreviousValue('message'),
						'owner_id' => $previousThread->user_id
					], $this->User);

					// Apply the new event
					$postEvent->testApply([
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id' => $this->Thread->user_id
					], $this->User);
				}
			}
			else if ($this->message_state == 'visible')
			{
				// Apply the new event
				$postEvent->testApply([
					'node_id' => $this->Thread->node_id,
					'thread_id' => $this->thread_id,
					'multiplier' => $this->message,
					'owner_id' => $this->Thread->user_id
				], $this->User);
			}
			// END POST EVENT
			
			// BEGIN REPLY EVENT
			// Init the event
			$replyEvent = $eventTriggerRepo->getHandler('reply');
			
			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$replyEvent->testUndo([
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'source_user_id'  => $this->getPreviousValue('user_id')
					], $previousThread->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$replyEvent->testApply([
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'source_user_id'  => $this->user_id
					], $this->Thread->User);
				}
			}
			else if ($this->message_state == 'visible')
			{
				// Apply the new event
				$replyEvent->testApply([
					'node_id' => $this->Thread->node_id,
					'thread_id' => $this->thread_id,
					'source_user_id'  => $this->user_id
				], $this->Thread->User);
			}
			// END REPLY EVENT
			
			// BEGIN REVIVAL EVENT
			if ($this->isInsert())
			{
				// Apply the new event
				$eventTriggerRepo->getHandler('revival')
					->testApply([
						'last_post_date' => $this->Thread->last_post_date
					], $this->User)
				;
			}
			// BEGIN REVIVAL EVENT
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

		if (!$this->user_id)
		{
			return $previous;
		}
		
		if ($this->isUpdate())
		{
			if ($this->isChanged('message'))
			{
				// Get rid of any existing charge tags, the BBCode renderer will re-process them
				$this->db()->delete('xf_dbtech_credits_charge', 'post_id = ' . $this->post_id);
			}
			
			// Get thread info
			$previousThread = $this->isChanged('thread_id')
				? \XF::em()->find('XF:Thread', $this->getPreviousValue('thread_id'))
				: $this->Thread;
		}
		else
		{
			// Will probably never hit, but best to be safe
			$previousThread = $this->Thread;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		// Shorthand
		$visibilityChange = $this->isStateChanged('message_state', 'visible');

		if ($this->isFirstPost())
		{
			// BEGIN THREAD EVENT
			// Init the event
			$threadEvent = $eventTriggerRepo->getHandler('thread');

			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$threadEvent->undo($this->getPreviousValue('thread_id'), [
						'multiplier' => $this->getPreviousValue('message'),
						'node_id' => $previousThread->node_id,
						'content_type' => 'thread',
						'content_id' => $this->getPreviousValue('thread_id')
					], $this->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$threadEvent->apply($this->thread_id, [
						'multiplier' => $this->message,
						'node_id' => $this->Thread->node_id,
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}
				else if (
					$this->isChanged('thread_id')
					|| $this->isChanged('user_id')
					|| $this->isChanged('message')
				)
				{
					// Undo the previous event
					$threadEvent->undo($this->getPreviousValue('thread_id'), [
						'multiplier' => $this->getPreviousValue('message'),
						'node_id' => $previousThread->node_id,
						'content_type' => 'thread',
						'content_id' => $this->getPreviousValue('thread_id')
					], $this->User);

					// Apply the new event
					$threadEvent->apply($this->thread_id, [
						'multiplier' => $this->message,
						'node_id' => $this->Thread->node_id,
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User);
				}
			}
			else if ($this->Thread->discussion_state == 'visible')
			{
				// Apply the new event
				$threadEvent->apply($this->thread_id, [
					'multiplier' => $this->message,
					'node_id' => $this->Thread->node_id,
					'content_type' => 'thread',
					'content_id' => $this->thread_id
				], $this->User);
			}
			// END THREAD EVENT
		}
		else
		{
			// BEGIN POST EVENT
			// Init the event
			$postEvent = $eventTriggerRepo->getHandler('post');

			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$postEvent->undo($this->getPreviousValue('post_id'), [
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'multiplier' => $this->getPreviousValue('message'),
						'owner_id' => $previousThread->user_id,
						'content_type' => 'post',
						'content_id' => $this->getPreviousValue('post_id')
					], $this->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$postEvent->apply($this->post_id, [
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id' => $this->Thread->user_id,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->User);
				}
				else if (
					$this->isChanged('thread_id')
					|| $this->isChanged('user_id')
					|| $this->isChanged('message')
				)
				{
					// Undo the previous event
					$postEvent->undo($this->getPreviousValue('post_id'), [
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'multiplier' => $this->getPreviousValue('message'),
						'owner_id' => $previousThread->user_id,
						'content_type' => 'post',
						'content_id' => $this->getPreviousValue('post_id')
					], $this->User);

					// Apply the new event
					$postEvent->apply($this->post_id, [
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id' => $this->Thread->user_id,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->User);
				}
			}
			else if ($this->message_state == 'visible')
			{
				// Apply the new event
				$postEvent->apply($this->post_id, [
					'node_id' => $this->Thread->node_id,
					'thread_id' => $this->thread_id,
					'multiplier' => $this->message,
					'owner_id' => $this->Thread->user_id,
					'content_type' => 'post',
					'content_id' => $this->post_id
				], $this->User);
			}
			// END POST EVENT

			// BEGIN REPLY EVENT
			// Init the event
			$replyEvent = $eventTriggerRepo->getHandler('reply');

			if ($this->isUpdate())
			{
				if ($visibilityChange == 'leave')
				{
					// Undo the event
					$replyEvent->undo($this->getPreviousValue('post_id'), [
						'node_id' => $previousThread->node_id,
						'thread_id' => $this->getPreviousValue('thread_id'),
						'source_user_id'  => $this->getPreviousValue('user_id'),
						'content_type' => 'post',
						'content_id' => $this->getPreviousValue('post_id')
					], $previousThread->User);
				}
				else if ($visibilityChange == 'enter')
				{
					// Reapply the event
					$replyEvent->apply($this->post_id, [
						'node_id' => $this->Thread->node_id,
						'thread_id' => $this->thread_id,
						'source_user_id'  => $this->user_id,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->Thread->User);
				}
			}
			else if ($this->message_state == 'visible')
			{
				// Apply the new event
				$replyEvent->apply($this->post_id, [
					'node_id' => $this->Thread->node_id,
					'thread_id' => $this->thread_id,
					'source_user_id'  => $this->user_id,
					'content_type' => 'post',
					'content_id' => $this->post_id
				], $this->Thread->User);
			}
			// END REPLY EVENT
			
			// BEGIN REVIVAL EVENT
			if ($this->isInsert())
			{
				// Apply the new event
				$eventTriggerRepo->getHandler('revival')
					->apply($this->post_id, [
						'last_post_date' => $this->Thread->last_post_date,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->User)
				;
			}
			// BEGIN REVIVAL EVENT
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

		if (!$this->user_id)
		{
			return $previous;
		}

		if ($this->isFirstPost())
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		if ($this->isFirstPost())
		{
			// BEGIN THREAD EVENT
			if ($this->Thread->discussion_state == 'visible')
			{
				// Undo the event
				$eventTriggerRepo->getHandler('thread')
					->testUndo([
						'multiplier' => $this->message,
						'node_id'    => $this->Thread->node_id
					
					], $this->User)
				;
			}
			// END THREAD EVENT
		}
		else
		{
			if ($this->message_state == 'visible')
			{
				// BEGIN POST EVENT
				// Undo the event
				$eventTriggerRepo->getHandler('post')
					->testUndo([
						'node_id'    => $this->Thread->node_id,
						'thread_id'  => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id'   => $this->Thread->user_id
					], $this->User)
				;
				// END POST EVENT
				
				// BEGIN REPLY EVENT
				// Undo the event
				$eventTriggerRepo->getHandler('reply')
					->testUndo([
						'node_id'        => $this->Thread->node_id,
						'thread_id'      => $this->thread_id,
						'source_user_id' => $this->user_id
					], $this->Thread->User)
				;
				// END REPLY EVENT
			}
		}


		return $previous;
	}
	
	/**
	 * @throws \Exception
	 */
	protected function _postDelete()
	{
		// Do parent stuff
		$previous = parent::_postDelete();

		if (!$this->user_id)
		{
			return $previous;
		}
		
		/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
		$eventTriggerRepo = $this->repository('DBTech\Credits:EventTrigger');
		
		if ($this->isFirstPost())
		{
			// BEGIN THREAD EVENT
			if ($this->Thread->discussion_state == 'visible')
			{
				// Undo the event
				$eventTriggerRepo->getHandler('thread')
					->undo($this->thread_id, [
						'multiplier' => $this->message,
						'node_id'    => $this->Thread->node_id,
						'content_type' => 'thread',
						'content_id' => $this->thread_id
					], $this->User)
				;
			}
			// END THREAD EVENT
		}
		else
		{
			if ($this->message_state == 'visible')
			{
				// BEGIN POST EVENT
				// Undo the event
				$eventTriggerRepo->getHandler('post')
					->undo($this->post_id, [
						'node_id'    => $this->Thread->node_id,
						'thread_id'  => $this->thread_id,
						'multiplier' => $this->message,
						'owner_id'   => $this->Thread->user_id,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->User)
				;
				// END POST EVENT
				
				// BEGIN REPLY EVENT
				// Undo the event
				$eventTriggerRepo->getHandler('reply')
					->undo($this->post_id, [
						'node_id'        => $this->Thread->node_id,
						'thread_id'      => $this->thread_id,
						'source_user_id' => $this->user_id,
						'content_type' => 'post',
						'content_id' => $this->post_id
					], $this->Thread->User)
				;
				// END REPLY EVENT
			}
		}

		return $previous;
	}
}