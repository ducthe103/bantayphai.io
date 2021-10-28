<?php

namespace BR\ModernStatistic\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class ModernStatistic extends Repository
{
	public function findModernStatisticsForList($active = null)
	{
		$finder = $this->finder('BR\ModernStatistic:ModernStatistic')
			->order('modern_statistic_id', 'desc');

		if($active){
			$finder->where('active', true);
		}

		return $finder;
	}

	public function checkBriviumCreditsAddon()
	{
		$addOns = \XF::app()->container('addon.cache');
		if(!empty($addOns['MJ/Credits'])){
			return $addOns['MJ/Credits'];
		}
		return false;
	}

	public function checkXenForoResourceAddon()
	{
		$addOns = \XF::app()->container('addon.cache');
		if(!empty($addOns['XFRM'])){
			return $addOns['XFRM'];
		}
		return false;
	}

	public function prepareTabData($tabData, $edit = false)
	{
		if(!$tabData || !is_array($tabData)){
			return [];
		}

		$tabDataOrder = [];
		$newTabData = [];
		foreach($tabData as $key => $tab){
			$tabDataOrder[$key] = !empty($tab['display_order'])?$tab['display_order']:0;
		}
		asort($tabDataOrder);
		foreach($tabDataOrder as $key => $order){
			if(!empty($tabData[$key])){
				$newTabData[$key] = $tabData[$key];
			}
		}
		$tabData = $newTabData;
		unset($newTabData);
		foreach($tabData as $key => &$tab){
			if(!$edit){
				if(!empty($tab['active']) &&
					(($tab['kind']!='resource' && $tab['type']!='user_most_resources') || $this->checkXenForoResourceAddon())){
				}else{
					unset($tabData[$key]);
					continue;
				}
			}
			$tab['defaultTitle'] = $tab['title'];
			if(empty($tab['title']) && !empty($tab['type'])){
				switch($tab['type']){
					case 'thread_latest':
						$tab['defaultTitle'] = \XF::phrase('brms_latest_threads');
						break;
					case 'thread_hotest':
						$tab['defaultTitle'] = \XF::phrase('brms_most_viewed_threads');
						break;
					case 'post_latest':
						$tab['defaultTitle'] = \XF::phrase('brms_latest_replies');
						break;
					case 'most_reply':
						$tab['defaultTitle'] = \XF::phrase('brms_most_replied_threads');
						break;
					case 'sticky_threads':
					case 'promoted_threads':
					case 'my_threads':
						$tab['defaultTitle'] = \XF::phrase('brms_' . $tab['type']);
						break;
					case 'resource_last_update':
						$tab['defaultTitle'] = \XF::phrase('xfrm_latest_updates');
						break;
					case 'resource_resource_date':
						$tab['defaultTitle'] = \XF::phrase('brms_newest_resources');
						break;
					case 'resource_rating_weighted':
						$tab['defaultTitle'] = \XF::phrase('xfrm_top_resources');
						break;
					case 'resource_download_count':
						$tab['defaultTitle'] = \XF::phrase('brms_most_downloaded');
						break;
					case 'user_most_messages':
						$tab['defaultTitle'] = \XF::phrase('brms_most_messages');
						break;
					case 'user_most_likes':
						$tab['defaultTitle'] = \XF::phrase('brms_most_likes');
						break;
					case 'user_most_points':
						$tab['defaultTitle'] = \XF::phrase('brms_most_points');
						break;
					case 'user_staff_members':
						$tab['defaultTitle'] = \XF::phrase('brms_staff_members');
						break;
					case 'user_most_resources':
						$tab['defaultTitle'] = \XF::phrase('brms_most_resources');
						break;
					case 'user_latest_members':
						$tab['defaultTitle'] = \XF::phrase('brms_latest_members');
						break;
					case 'user_latest_banned':
						$tab['defaultTitle'] = \XF::phrase('brms_latest_banned_members');
						break;
					case 'user_richest':
						$tab['defaultTitle'] = \XF::phrase('brc_top_richest');
						break;
					case 'user_poorest':
						$tab['defaultTitle'] = \XF::phrase('brc_top_poorest');
						break;
					case 'latest_profile_posts':
						$tab['defaultTitle'] = \XF::phrase('new_profile_posts');
						break;
					case 'your_profile_posts':
						$tab['defaultTitle'] = \XF::phrase('brms_your_profile_posts');
						break;
				}
				if($tab['defaultTitle']){
					$tab['defaultTitle'] = $tab['defaultTitle']->render();
				}
			}
		}
		return $tabData;
	}

	public function getItemCache()
	{
		$output = [];

		$statistics = $this->finder('BR\ModernStatistic:ModernStatistic')
							->where('active', 1);

		foreach ($statistics->fetch() as $key => $item)
		{
			$output[$key] = $item->toArray();
		}

		return $output;
	}

	public function rebuildModernStatisticCache()
	{
		$modernStatistics = $this->getItemCache();
		$positions = [];

		foreach($modernStatistics as &$modernStatistic){
			if(!empty($modernStatistic['position'])){
				$positionMap =	preg_split('/\s+/', trim($modernStatistic['position']));
				foreach($positionMap as $position){
					if(empty($positions[$position])) {
						$positions[$position] = [];
					}
					$positions[$position][] = $modernStatistic['modern_statistic_id'];
				}
				$modernStatistic['tabData'] = $this->prepareTabData($modernStatistic['tab_data']);
			}
		}
		$cache = array(
			'modernStatistics' => $modernStatistics,
			'positions'        => $positions,
		);
		\XF::registry()->set('brmsModernStatistics', $cache);
		return $cache;
	}

	public function getCacheDataForUser($statsId, $userId)
	{
		$cache = $this->db()->fetchRow('
			SELECT *
				FROM xf_brms_modern_cache
			WHERE modern_statistic_id = ? AND user_id = ?
			ORDER BY last_update DESC
			LIMIT 0,1
		', [$statsId, $userId]);
		if(!empty($cache['item_limit'])){
			$cache['userSetting'] = @unserialize($cache['item_limit']);
		}
		if(!empty($cache['cache_params'])){
			$cache['hintData'] = @unserialize($cache['cache_params']);
		}
		if(!empty($cache['tab_cache_htmls'])){
			$cache['tabCacheHtmls'] = @unserialize($cache['tab_cache_htmls']);
		}
		if(!empty($cache['tab_cache_params'])){
			$cache['tabCacheParams'] = @unserialize($cache['tab_cache_params']);
		}
		return $cache;
	}

	public function getStatisticTabParams($modernStatistic, $tabId, $userId, $limit = 0, $useCache = true, $cachedStatistic = [])
	{
		$statisticParams = [];

		$viewParams = array(
			'items'           => [],
			'useCacheParam'   => false,
			'cachedStatistic' => [],
			'statisticParams' => [],
			'modernStatistic' => $modernStatistic,
		);

		if(!empty($modernStatistic) && !empty($modernStatistic['tabData'][$tabId])){
			$itemLimit = 0;
			if(!$limit){
				$itemLimit = $this->getItemLimitByCache($modernStatistic, $userId);
				if(empty($itemLimit))
				{
					$itemLimit = !empty($modernStatistic['item_limit']['default'])?$modernStatistic['item_limit']['default']:15;
				}
			}else{
				$this->setItemLimitToCache($modernStatistic, $userId, $limit);
				$itemLimit = $limit;
			}

			$tabParam = $modernStatistic['tabData'][$tabId];
			if(!$cachedStatistic){
				$cachedStatistic = $this->getModernCacheDataForUserId($modernStatistic['modern_statistic_id'], $userId);
			}
			$viewParams['cachedStatistic'] = $cachedStatistic;
			if($useCache
				&& !empty($modernStatistic['enable_cache'])
				&& !empty($modernStatistic['cache_time'])
				&& !empty($cachedStatistic['last_update'])

			){
				$cacheTime = max(1, $modernStatistic['cache_time']);
				$lastUpdate =  XenForo_Application::$time - $cacheTime*60;
				if($cachedStatistic['last_update'] >= $lastUpdate){
					if(!empty($cachedStatistic['tabCacheHtmls'])){
						if(!empty($cachedStatistic['tabCacheHtmls'][$tabId])){
							$statisticParams['renderedHtml'] = $cachedStatistic['tabCacheHtmls'][$tabId];
							$viewParams['useCacheParam'] = true;
						}
					}else if(!empty($cachedStatistic['tabCacheParams'])){
						if(!empty($cachedStatistic['tabCacheParams'][$tabId])){
							$statisticParams = $cachedStatistic['tabCacheParams'][$tabId];
							$viewParams['useCacheParam'] = true;
						}
					}
				}
			}

			if(empty($viewParams['useCacheParam'])){
				$tabParam['kind'] = !empty($tabParam['kind'])?$tabParam['kind']:'thread';
				switch($tabParam['kind']){
					case 'resource':
						$statisticParams = $this->getResourceStatistics($tabParam, $itemLimit, $modernStatistic);
						break;
					case 'user':
						$statisticParams = $this->getUserStatistics($tabParam, $itemLimit, $modernStatistic);
						break;
					case 'profile_post':
						$statisticParams = $this->getProfilePostStatistics($tabParam, $itemLimit, $modernStatistic);
						break;
					case 'thread':
					default:
						$statisticParams = $this->getThreadStatistics($tabParam, $itemLimit, $modernStatistic);
						break;
				}
			}
			if($userId && $limit && (empty($cachedStatistic['item_limit']) || $cachedStatistic['item_limit'] != $limit)){
				$data = array(
					'item_limit'	=>	$limit
				);
				$this->saveCacheForStatistic($modernStatistic['modern_statistic_id'], $userId, $data);
				if(is_array($viewParams['cachedStatistic'])){
					$viewParams['cachedStatistic']['item_limit'] = $limit;
				}else{
					$viewParams['cachedStatistic'] = $data;
				}
			}
			$viewParams['tabParams'] = $statisticParams;
			$viewParams = array_merge($statisticParams, $viewParams);
		}
		return $viewParams;
	}

	protected function setItemLimitToCache($modernStatistic, $userId, $limit)
	{
		if(empty($modernStatistic['modern_statistic_id']) ||  empty($limit))
		{
			return;
		}
		$id = $modernStatistic['modern_statistic_id'];
		$limitCache = [];
		if(!empty($userId))
		{
			$user = $this->em->find('XF:User', $userId);
			$limitCache = $user->brms_limit_cache;
		}
		$limitCache +=  $this->getCookieCache();
		$limitCache[$id] = $limit;
		if(!empty($user))
		{
			$user->fastUpdate('brms_limit_cache', $limitCache);
		}
		$this->app()->response()->setCookie('brmsLimitCache', json_encode($limitCache));
	}

	protected function getCookieCache()
	{
		$cookieCache = $this->app()->request()->getCookie('brmsLimitCache');
		if(empty($cookieCache))
		{
			return [];
		}
		if(!is_array($cookieCache))
		{
			$cookieCache = json_decode($cookieCache, true);
		}
		return $cookieCache;
	}

	protected function getItemLimitByCache($modernStatistic, $userId)
	{
		if(empty($modernStatistic['modern_statistic_id']))
		{
			return;
		}
		$id = $modernStatistic['modern_statistic_id'];
		$limitCache = [];
		if(!empty($userId))
		{
			$user = $this->em->find('XF:User', $userId);
			$limitCache = $user->brms_limit_cache;
		}

		$limitCache += $this->getCookieCache();
		if(!empty($limitCache[$id]))
		{
			return $limitCache[$id];
		}
		return;
	}

	public function getModernCacheDataForUserId($modernStatisticId, $userId)
	{
		return [];

		$cache = $this->db()->fetchRow('
			SELECT *
				FROM xf_brms_modern_cache
			WHERE modern_statistic_id = ? AND user_id = ?
			ORDER BY last_update DESC
		', array($modernStatisticId, $userId));

		if(!empty($cache['item_limit'])){
			$cache['userSetting'] = @unserialize($cache['item_limit']);
		}
		if(!empty($cache['cache_params'])){
			$cache['hintData'] = @unserialize($cache['cache_params']);
		}
		if(!empty($cache['tab_cache_htmls'])){
			$cache['tabCacheHtmls'] = @unserialize($cache['tab_cache_htmls']);
		}
		if(!empty($cache['tab_cache_params'])){
			$cache['tabCacheParams'] = @unserialize($cache['tab_cache_params']);
		}
		return $cache;
	}

	public function saveCacheForStatistic($modernStatisticId, $userId, $data)
	{
		return;
		$db = $this->db();
		if(!$this->getModernCacheDataForUserId($modernStatisticId, $userId)){
			$db->query('
				INSERT INTO xf_brms_modern_cache
					(modern_statistic_id, user_id, last_update, item_limit, cache_html, cache_params, tab_cache_htmls, tab_cache_params)
				VALUES
					(?, ?, ?, ?, ?, ?, ?, ?)
				ON DUPLICATE KEY UPDATE
					last_update      = VALUES(last_update),
					item_limit       = VALUES(item_limit),
					cache_html       = VALUES(cache_html),
					cache_params     = VALUES(cache_params),
					tab_cache_htmls  = VALUES(tab_cache_htmls),
					tab_cache_params = VALUES(tab_cache_params)
			', array(
				$modernStatisticId,
				$userId,
				\XF::$time,
				!empty($data['item_limit'])?$data['item_limit']:0,
				!empty($data['cache_html'])?$data['cache_html']:'',
				!empty($data['cache_params'])?serialize($data['cache_params']):'',
				!empty($data['tab_cache_htmls'])?serialize($data['tab_cache_htmls']):'',
				!empty($data['tab_cache_params'])?serialize($data['tab_cache_params']):'',
			));
		}else{
			$this->updateCacheSettingForStatistic($modernStatisticId, $userId, $data);
		}
	}

	public function getThreadStatistics($tab, $limit, $modernStatistic)
	{
		/** @var \XF\Finder\Thread $finder */
		$finder = $this->finder('XF:Thread');
		$finder
			->with('Forum')
			->forFullView();
		$now = \XF::$time;

		$visitor = \XF::visitor();
		$template = '';
		switch ($tab['type'])
		{
			case 'thread_latest':
				$finder->order('post_date', 'DESC');
				$template = 'brms_thread_latest';
				break;
			case 'thread_hotest':
				$finder->order('view_count', 'DESC');
				$template = 'brms_thread_most_viewed';

				if (!empty($tab['cut_off']) && $tab['cut_off'] > 0) {
					$finder->where('post_date', '>', $now - $tab['cut_off'] * 86400);
				}else if($modernStatistic['thread_cutoff'] > 0){
					$finder->where('post_date', '>', $now - $modernStatistic['thread_cutoff'] * 86400);
				}
				break;
			case 'post_latest':
				$finder->order('last_post_date', 'DESC');
				$template = 'brms_thread_post_latest';
				break;
			case 'most_reply':
				$finder->order('reply_count', 'DESC');
				$template = 'brms_thread_most_reply';

				if (!empty($tab['cut_off']) && $tab['cut_off'] > 0) {
					$finder->where('post_date', '>', $now - $tab['cut_off'] * 86400);
				}else if($modernStatistic['thread_cutoff'] > 0){
					$finder->where('post_date', '>', $now - $modernStatistic['thread_cutoff'] * 86400);
				}
				break;
			case 'my_threads':
				if(!empty($tab['order_type']) && !empty($tab['order_direction'])){
					$finder->order($tab['order_type'], $tab['order_direction']);
				}
				$finder->where('user_id', $visitor->user_id);
				$template = 'brms_thread_my_threads';
				break;
			case 'sticky_threads':
				if(!empty($tab['order_type']) && !empty($tab['order_direction'])){
					$finder->order($tab['order_type'], $tab['order_direction']);
				}
				$finder->where('sticky', 1);
				$template = 'brms_thread_my_threads';
				break;
			case 'promoted_threads':
				$finder->order('brms_promote_date', 'DESC');
				$finder->where('brms_promote_date', '>', 0);
				$finder->where('brms_promote_date', '<', \XF::$time);
				$template = 'brms_thread_my_threads';
				break;
		}

		if(!empty($tab['discussion_open']) && count($tab['discussion_open']) < 2){
			if(!empty($tab['discussion_open']['unlocked'])){
				$finder->where('discussion_open', 1);
			}else if(!empty($tab['discussion_open']['locked'])){
				$finder->where('discussion_open', 0);
			}
		}
		if(!empty($tab['prefix_id']) && $tab['prefix_id'] != array(0)){
			$finder->where('prefix_id', $tab['prefix_id']);
		}
		if(!empty($tab['discussion_state'])){
			$finder->where('discussion_state', $tab['discussion_state']);
		}else{
			$finder->where('discussion_state', 'visible');
		}
		$finder->where('discussion_type', '<>', 'redirect');


		$nodes = \XF::finder('XF:Forum')
			->fetch();

		$viewableNodes = $nodes->filterViewable();
		$viewableNodeIds = $viewableNodes->pluckNamed('node_id');

		if(!empty($tab['forums']) && $tab['forums'] != [0 => 0]){
			$viewableNodeIds = array_intersect($tab['forums'], $viewableNodeIds);
		}else{
			$nodeIds = $nodes->pluckNamed('node_id');
			$unviewableNodeIds = array_diff($nodeIds, $viewableNodeIds);
			$finder->where('node_id', '<>', $unviewableNodeIds);
		}

		$finder->where('node_id', $viewableNodeIds)
			->limit($limit);
		$items = $finder->fetch($limit)->filterViewable();

		$viewParams = [
			'template'  => $template,
			'items'     => $items,
			'totalItem' => $items->count(),
			'limit'     => $limit,
		];
		return $viewParams;
	}

	public function getUserStatistics($tab, $limit, $modernStatistic)
	{
		/** @var \XF\Finder\User $finder */
		$finder = $this->finder('XF:User');

		$template = '';

		if(empty($tab['type']) && !empty($tab['user_type'])) {
			$tab['type'] = $tab['user_type'];
		}

		if(in_array($tab['type'], ['user_most_likes', 'user_most_reaction_scores']))
		{
			if(\XF::$versionId < 2010000)
			{
				$tab['type'] = 'user_most_likes';
			}else
			{
				$tab['type'] = 'user_most_reaction_scores';
			}
		}
		switch ($tab['type'])
		{
			case 'user_most_messages':
				$finder->order('message_count', 'DESC');
				$template = 'brms_user_most_messages';
				break;
			case 'user_most_likes':
				$finder->order('like_count', 'DESC');
				$template = 'brms_user_most_likes';
				break;
			case 'user_most_reaction_scores':
				$finder->order('reaction_score', 'DESC');
				$template = 'brms_user_most_reaction_scores';
				break;
			case 'user_most_points':
				$finder->order('trophy_points', 'DESC');
				$template = 'brms_user_most_points';
				break;
			case 'user_staff_members':
				$finder->where('is_staff', true);
				$finder->order('username', 'ASC');
				$template = 'brms_user_staff_members';
				break;
			case 'user_most_resources':
				$finder->order('xfrm_resource_count', 'DESC');
				$template = 'brms_user_most_resources';
				break;
			case 'user_latest_members':
				$finder->order('register_date', 'DESC');
				$template = 'brms_user_latest_members';
				break;
			case 'user_latest_banned':
				$finder->with('Ban');
				$finder->order('Ban.ban_date', 'DESC');
				$finder->where('is_banned', true);
				$template = 'brms_user_latest_banned';
				break;
			case 'user_richest':
			case 'user_poorest':
				/*$creditVersion = $this->checkBriviumCreditsAddon();
				$column = '';
				if($creditVersion >= 1000000 && !empty($tab['currency_id'])){
					$currency = XenForo_Application::get('brcCurrencies')->$tab['currency_id'];
					if(!empty($currency['column'])){
						$column = $currency['column'];
					}
				}else{
					$column = 'credits';
				}
				if($column){
					$fetchOptions['order'] = $column;
					$viewParams['currency'] = $currency;
					$viewParams['currencyId'] = $tab['currency_id'];
					$viewParams['column'] = $currency['column'];
					if($tab['type']=='user_poorest'){
						$fetchOptions['direction'] = 'asc';
					}
					$template = 'brms_user_richest';
				}*/
				break;
		}

		$userGroupsIds = [];
		if(!empty($tab['user_groups']) && $tab['user_groups'] != [0 => 0]){
			$userGroupsIds = $tab['user_groups'];
		}
		if($userGroupsIds){
			$finder->where('user_group_id', $userGroupsIds);
		}

		if(!empty($tab['user_state'])){
			$finder->where('user_state', $tab['user_state']);
		}else{
			$finder->where('user_state', 'valid');
		}

		$finder->limit($limit);
		$items = $finder->fetch($limit);
		$viewParams = [
			'template'  => $template,
			'items'     => $items,
			'totalItem' => $items->count(),
			'limit'     => $limit,
		];
		return $viewParams;
	}

	public function getResourceStatistics($tab, $limit, $modernStatistic)
	{
		/** @var \XFRM\Finder\ResourceItem $finder */
		$finder = $this->finder('XFRM:ResourceItem');
		$finder
			->forFullView(true);

		$template = '';
		switch ($tab['type'])
		{
			case 'resource_last_update':
				$finder->order('last_update', 'DESC');
				$template = 'brms_resource_last_update';
				break;
			case 'resource_resource_date':
				$finder->order('resource_date', 'DESC');
				$template = 'brms_resource_resource_date';
				break;
			case 'resource_rating_weighted':
				$finder->order('rating_weighted', 'DESC');
				$template = 'brms_resource_rating_weighted';
				break;
			case 'resource_download_count':
				$finder->order('download_count', 'DESC');
				$template = 'brms_resource_download_count';
				break;
		}

		$categoryRepo = $this->repository('XFRM:Category');
		$categories = $categoryRepo->getViewableCategories();
		$viewableCategoryIds = $categories->keys();

		if(!empty($tab['categories']) && $tab['categories'] != [0 => 0]){
			$tab['categories'] = array_filter($tab['categories']);
			$viewableCategoryIds = array_intersect($viewableCategoryIds, $tab['categories']);
		}

		if($viewableCategoryIds){
			$finder->where('resource_category_id', $viewableCategoryIds);
		}

		if (!empty($tab['resource_prefix_id']))
		{
			$tab['resource_prefix_id'] = array_filter($tab['resource_prefix_id']);
			if($tab['resource_prefix_id']){
				$finder->where('prefix_id', $tab['resource_prefix_id']);
			}
		}

		$resourceState = $this->getViewableResourceStates(!empty($tab['resource_state'])?$tab['resource_state']:[]);
		if($resourceState){
			$finder->where('resource_state', $resourceState);
		}

		$items = $finder->fetch($limit)->filterViewable();

		$viewParams = [
			'template'  => $template,
			'items'     => $items,
			'totalItem' => $items->count(),
			'limit'     => $limit,
		];
		return $viewParams;
	}

	public function getViewableResourceStates($resourceState = [])
	{
		$visitor = \XF::visitor();
		$viewableStates = [];
		if(isset($resourceState['visible'])){
			$viewableStates[] = 'visible';
		}

		if (isset($resourceState['deleted']) && $visitor->hasPermission('resource', 'viewDeleted'))
		{
			$viewableStates[] = 'deleted';
		}

		if (isset($resourceState['moderated']) && $visitor->hasPermission('resource', 'viewModerated'))
		{
			$viewableStates[] = 'moderated';
		}
		return $viewableStates;
	}

	public function getViewableThreadStates($threadState = [])
	{
		$visitor = \XF::visitor();
		$viewableStates = [];
		if(isset($threadState['visible'])){
			$viewableStates[] = 'visible';
		}

		if (isset($threadState['deleted']) && $visitor->hasPermission('forum', 'viewDeleted'))
		{
			$viewableStates[] = 'deleted';
		}

		if (isset($threadState['moderated']) && $visitor->hasPermission('forum', 'viewModerated'))
		{
			$viewableStates[] = 'moderated';
		}
		return $viewableStates;
	}

	public function getProfilePostStatistics($tab, $limit, $modernStatistic)
	{
		/** @var \XF\Finder\ProfilePost $finder */
		$finder = $this->finder('XF:ProfilePost');
		$finder
			->limit($limit)
			->order('post_date', 'DESC');

		$visitor = \XF::visitor();
		$template = '';

		if(empty($tab['type']) && !empty($tab['user_type'])) {
			$tab['type'] = $tab['user_type'];
		}
		switch ($tab['type'])
		{
			case 'latest_profile_posts':
				$finder->forFullView();
				$template = 'brms_latest_profile_posts';
				break;
			case 'your_profile_posts':
				$finder->onProfile($visitor);
				$template = 'brms_your_profile_posts';
				break;
		}

		$finder->limit($limit);
		$items = $finder->fetch($limit);
		$viewParams = [
			'template'  => $template,
			'items'     => $items,
			'totalItem' => $items->count(),
			'limit'     => $limit,
		];
		return $viewParams;
	}
}
