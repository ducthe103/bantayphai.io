<?php

namespace BR\ModernStatistic\Service\ModernStatistic;

use BR\ModernStatistic\Entity\ModernStatistic;

class Render extends \XF\Service\AbstractService
{
	/**
	 * @var Currency
	 */
	protected $currency;

	protected $statistics;
	protected $_modernStatistics;
	protected $_positions;
	protected $loadedTemplates;
	protected $statsRepo = null;

	/**
	 * @var \XF\Entity\AddOn|null
	 */
	protected $addOn;

	public function __construct(\XF\App $app, $position)
	{
		parent::__construct($app);

		$brmsModernStatistics = $this->app->container('brmsModernStatistics');
		$this->_modernStatistics = !empty($brmsModernStatistics['modernStatistics']) ? $brmsModernStatistics['modernStatistics'] : [];
		$this->_positions = !empty($brmsModernStatistics['positions']) ? $brmsModernStatistics['positions'] : [];
		$this->setStatistics($position);
		$this->statsRepo = $this->app->repository('BR\ModernStatistic:ModernStatistic');
	}

	public function setStatistics($position)
	{
		if(!empty($this->_positions[$position])){
			$statsIds = $this->_positions[$position];
			foreach($statsIds as $statsId){
				if(!empty($this->_modernStatistics[$statsId])){
					$this->statistics[$statsId] = $this->_modernStatistics[$statsId];
				}
			}
		}
	}

	public function setLoadedTemplates($loadedTemplates)
	{
		$this->loadedTemplates = $loadedTemplates;
	}

	protected $templateParams;
	public function setTemplateParams($templateParams)
	{
		$this->templateParams = $templateParams;
	}

	public function validateCriteria($criteria)
	{
		if(!$criteria){
			return true;
		}
		if(!empty($criteria['template_name'])){
			if(!$this->loadedTemplates || !is_array($this->loadedTemplates)){
				return false;
			}
			$templateNames = preg_split('/\s+/', trim($criteria['template_name']));
			if($templateNames && !array_intersect($templateNames, $this->loadedTemplates)){
				return false;
			}
		}

		$visitor = \XF::visitor();
		if(!empty($criteria['user_group_ids']) &&
			is_array($criteria['user_group_ids']) &&
			$visitor->isMemberOf($criteria['user_group_ids'])){
			return false;
		}
		$templateParams = $this->templateParams;
		if(!empty($criteria['node_ids']) && $criteria['node_ids'] != [0 => ''] && !empty($templateParams)){
			$nodeId = 0;
			if(!empty($templateParams['forum'])){
				$nodeId = $templateParams['forum']->node_id;
			}else if(!empty($templateParams['category'])){
				$nodeId = $templateParams['category']->node_id;
			}else if(!empty($templateParams['page'])){
				$nodeId = $templateParams['page']->node_id;
			}
			if($nodeId && !in_array($nodeId, $criteria['node_ids'])){
				return false;
			}
		}

		if(!empty($criteria['language_ids']) && is_array($criteria['language_ids'])){
			if(!in_array($visitor->language_id, $criteria['language_ids'])){
				return false;
			}
		}
		return true;
	}

	public function render()
	{
		$content = '';
		if(!empty($this->statistics)){
			$visitor = \XF::visitor();
			$visitorPerferences = $visitor->brms_statistic_perferences;
			foreach($this->statistics as $statisticId => $statistic){
				if(!empty($statistic['active'])){
					if(!empty($statistic['allow_user_setting']) && !empty($visitorPerferences[$statisticId])){
						continue;
					}
					if(!empty($statistic['modern_criteria']) && !$this->validateCriteria($statistic['modern_criteria'])){
						continue;
					}
					$rendered = false;
					$cached = $this->statsRepo->getCacheDataForUser($statisticId, $userId);

					$visitor = \XF::visitor();

					if(!empty($statistic['enable_cache']) && !empty($statistic['cache_time']) && $cached){
						$cacheTime = max(1, $statistic['cache_time']);
						$lastUpdate =  XenForo_Application::$time - $cacheTime*60;
						if(!empty($cached['last_update']) &&
							$cached['last_update'] >= $lastUpdate &&
							!empty($cached['cache_html'])){
							if(isset($visitor->style_id)){
								$styleId = $visitor->style_id;
								if(!empty($statistic['style_settings']) && !empty($statistic['style_settings'][$styleId])){
									if($statistic['style_settings'][$styleId] =='dark'){
										if(!strpos($cached['cache_html'], 'BRMSContainerDark')){
											$cached['cache_html'] = str_replace(
												'BRMSContainer',
												'BRMSContainer BRMSContainerDark',
												$cached['cache_html']
											);
										}
									}else{
										$cached['cache_html'] = str_replace('BRMSContainerDark', '', $cached['cache_html']);
									}
								}
							}
							$renderedContents .= $cached['cache_html'];
							$rendered = true;
						}
					}
					if(!$rendered){
						$templater = $this->app->templater();
						//$newTemplate = $templater->renderTemplate($template, []);
						$templateParams = [];
						$tabCacheHtmls = [];
						$tabCacheParams = [];

						if(!empty($statistic['load_fisrt_tab']) && !empty($statistic['tab_data'])){
							$tabId = -1;
							foreach($statistic['tab_data'] as $key => $tab){
								if(($tab['type']!='my_threads' && $tab['type']!='your_profile_posts') || !empty($userId)){
									$tabId = $key;
									break;
								}
							}
							if($tabId!=-1){
								$limit = 0;
								if(!empty($statistic['itemLimit']['enabled'])){
									if(!empty($cached['item_limit'])){
										$limit = $cached['item_limit'];
									}else{
										$limit = $request->getCookie('brmsNumberEntry' . $statisticId);
									}
								}
								$firstTabParams = $this->statsRepo->getStatisticTabParams(
									$statistic, $tabId, $userId, $limit, false, $cached
								);
								if(!empty($firstTabParams['tabParams'])){
									$tabParams = $firstTabParams['tabParams'];
									$tabParams['modernStatistic'] = $statistic;
									$firstTabHtml = $templater->renderTemplate('public:' . $firstTabParams['template'], $tabParams);

									$tabCacheHtmls[$tabId] = $firstTabHtml;
									$tabCacheParams[$tabId] = $tabParams;
									$templateParams['firstTabHtml'] = $firstTabHtml;
								}
							}
						}

						if(!empty($statistic['style_display']) && $statistic['style_display']=='dark'){
							$statistic['displayStyle'] = 'BRMSContainerDark';
						}

						if(isset($visitor->style_id)){
							$styleId = $visitor->style_id;
							if(!empty($statistic['style_settings']) && !empty($statistic['style_settings'][$styleId])){
								if($statistic['style_settings'][$styleId] =='dark'){
									$statistic['displayStyle'] = 'BRMSContainerDark';
								}else{
									$statistic['displayStyle'] = '';
								}
							}
						}
						$templateParams['modernStatistic'] = $statistic;
						$templateParams['cached'] = $cached;

						$modernHtml = $templater->renderTemplate('public:brms_modern_statistic', $templateParams);
						if(!empty($statistic['enable_cache'])){
							$saveData = [
								'cache_html' => $modernHtml,
								'cache_params' => $statistic,
								'tab_cache_htmls' => $tabCacheHtmls,
								'tab_cache_params' => $tabCacheParams
							];
							$this->statsRepo->saveCacheForStatistic($statisticId, $userId, $saveData);
						}
						$content .= $modernHtml;
					}
				}
			}
		}
		return $content;
	}
}
