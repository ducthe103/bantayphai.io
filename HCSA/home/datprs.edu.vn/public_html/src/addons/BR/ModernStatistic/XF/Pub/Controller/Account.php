<?php

namespace BR\ModernStatistic\XF\Pub\Controller;

use XF\Entity\User;

class Account extends XFCP_Account
{

	protected function preferencesSaveProcess(User $visitor)
	{
		$form = parent::preferencesSaveProcess($visitor);
		$statistics = $this->filter('brms_statistic_perferences', 'array-bool');
		$visitor->brms_statistic_perferences = $statistics;
		return $form;
	}
}
