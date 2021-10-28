<?php

namespace BR\ModernStatistic\Pub\View\ModernStatistic;

use XF\Mvc\View;

class LoadTab extends View
{
	public function renderJson()
	{
		$output = [];
		$userId = !empty($this->params['userId'])?$this->params['userId']:0;

		if(!empty($this->params['tabParams']) && !empty($this->params['modernStatistic']) && isset($this->params['tabId'])){
			$tabParams = $this->params['tabParams'];
			$tabParams['modernStatistic'] = $this->params['modernStatistic'];
			$modernStatistic = $this->params['modernStatistic'];
			$tabId = $this->params['tabId'];
			$tabHtml = '';
			if(!empty($tabParams['renderedHtml'])){
				$tabHtml = $tabParams['renderedHtml'];
				unset($tabParams['renderedHtml']);
			}else if(!empty($tabParams['items']) && !empty($tabParams['template'])){
				$tabHtml = $this->renderTemplate('public:' . $tabParams['template'], $tabParams);
			}

			$cachedStatistic = [
				'cache_html'	=> '',
				'cacheparams'	=> [],
				'tabCacheHtmls'	=> [],
				'tabCacheParams'=> [],
			];
			if(!empty($this->params['cachedStatistic'])){
				$cachedStatistic = $this->params['cachedStatistic'];
				$cachedStatistic = array_merge(array(
					'cache_html'	=> '',
					'cacheparams'	=> [],
					'tabCacheHtmls'	=> [],
					'tabCacheParams'=> [],
				), $cachedStatistic);
			}

			if(!empty($modernStatistic['enable_cache']) && !empty($modernStatistic['cache_time'])){
				unset($tabParams['cachedStatistic']);
				$cachedStatistic['tabCacheHtmls'][$tabId] = $tabHtml;
				$cachedStatistic['tabCacheParams'][$tabId] = $tabParams;

				$statsRepo = \XF::app()->repository('BR\ModernStatistic:ModernStatistic');
				$saveData = array(
					'cache_html' => $cachedStatistic['cache_html'],
					'cacheparams' => $cachedStatistic['cacheparams'],
					'tab_cache_htmls' => $cachedStatistic['tabCacheHtmls'],
					'tab_cacheparams' => $cachedStatistic['tabCacheParams']
				);
				//$statsRepo->saveCacheForStatistic($modernStatistic['modern_statistic_id'], $userId, $saveData);
			}
			$output['tabContentHtml'] = $tabHtml;

			if (!empty($this->params['limit'])) {
				$output['limit'] = $this->params['limit'];
			}
			if (isset($this->params['tabId'])) {
				$output['tabId'] = $this->params['tabId'];
			}
		}
		return $output;
	}
}
