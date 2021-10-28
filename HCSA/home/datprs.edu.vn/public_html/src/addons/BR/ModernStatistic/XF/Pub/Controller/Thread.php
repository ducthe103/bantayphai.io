<?php

namespace BR\ModernStatistic\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

class Thread extends XFCP_Thread
{
	public function actionBrmsPromote(ParameterBag $params)
	{
		$thread = $this->assertViewableThread($params->thread_id);
		if (!$thread->canPromoteThread($error))
		{
			return $this->noPermission($error);
		}
		$forum = $thread->Forum;

		if ($this->isPost())
		{
			$detete = $this->filter('delete', 'bool');
			if($detete){
				$thread->brms_promote_date = 0;
			}else{
				$input = $this->filter([
					'promote_time_ymd' => 'str',
					'promote_time_hh'  => 'uint',
					'promote_time_mm'  => 'uint',
				]);

				$tz = \XF::language()->getTimeZone();

				$datetime = new \DateTime("$input[promote_time_ymd] $input[promote_time_hh]:$input[promote_time_mm]", $tz);

				$thread->brms_promote_date = $datetime->format('U');
			}
			$thread->save();

			return $this->redirect($this->buildLink('threads', $thread));
		}
		else
		{
			$promoteTimestamp = $thread->brms_promote_date ?: $thread->post_date;

			$tz = \XF::language()->getTimeZone();
			$promoteTime = new \DateTime();
			$promoteTime->setTimestamp($promoteTimestamp);
			$promoteTime->setTimezone($tz);
			$promoteTime = explode('.', $promoteTime->format('Y-m-d.H.i.A.T'));

			$promoteTime = array(
				'ymd' => $promoteTime[0],
				'hh' => $promoteTime[1],
				'mm' => $promoteTime[2],
				'meri' => $promoteTime[3],
				'zone' => $promoteTime[4]
			);

			$hours = [];
			for ($i = 0; $i < 24; $i++)
			{
				$hh = str_pad($i, 2, '0', STR_PAD_LEFT);
				$hours[$hh] = $hh;
			}

			$minutes = [];
			for ($i = 0; $i < 60; $i += 1)
			{
				$mm = str_pad($i, 2, '0', STR_PAD_LEFT);
				$minutes[$mm] = $mm;
			}

			$viewParams = [
				'hours'       => $hours,
				'minutes'     => $minutes,
				'promoteTime' => $promoteTime,
				'thread'      => $thread,
				'forum'       => $forum,
			];
			return $this->view('XF:Thread\Move', 'brms_thread_promote', $viewParams);
		}
	}
}
