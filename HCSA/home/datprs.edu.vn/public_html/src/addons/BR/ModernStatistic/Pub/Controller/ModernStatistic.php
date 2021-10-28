<?php

namespace BR\ModernStatistic\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class ModernStatistic extends AbstractController
{
	public function actionLoadTab(ParameterBag $params)
	{
		$statisticId = $this->filter('modern_statistic_id', 'uint');

		if($statisticId){
			$limit = $this->filter('limit', 'uint');
			$tabId = $this->filter('tab_id', 'uint');
			$hardReload = $this->filter('hard_reload', 'bool');

			$userId = \XF::visitor()->user_id;
			$brmsModernStatistics = $this->app->container('brmsModernStatistics');
			$modernStatistics = !empty($brmsModernStatistics['modernStatistics']) ? $brmsModernStatistics['modernStatistics'] : [];

			$viewParams = [];
			if(!empty($modernStatistics[$statisticId])){
				$statistic = $modernStatistics[$statisticId];
				$GLOBALS['test_load_tab'] = true;
				$viewParams = $this->repository('BR\ModernStatistic:ModernStatistic')
									->getStatisticTabParams($statistic, $tabId, $userId, $limit, $hardReload?false:true);
				$viewParams['tabId'] = $tabId;
				$viewParams['userId'] = $userId;
				$viewParams['modernStatisticId'] = $statisticId;
			}

			return $this->view(
				'BR\ModernStatistic:ModernStatistic\LoadTab',
				!empty($viewParams['template'])?$viewParams['template']:'',
				$viewParams
			);
		}else{
			return $this->view('BR\ModernStatistic:ModernStatistic\LoadTab', '', []);
		}
	}
}
