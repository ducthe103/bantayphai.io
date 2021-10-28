<?php

namespace BR\ModernStatistic\Admin\Controller;

use XF\Mvc\FormAction;
use XF\Mvc\ParameterBag;
use XF\Admin\Controller\AbstractController;

class ModernStatistic extends AbstractController
{
	protected function preDispatchController($action, ParameterBag $params)
	{
		$this->assertAdminPermission('brmsModernStatistic');
	}

	public function actionIndex()
	{
		$modernStatisticRepo = $this->getModernStatisticRepo();
		$modernStatisticFinder = $modernStatisticRepo->findModernStatisticsForList();

		$total = $modernStatisticFinder->total();

		$viewParams = [
			'modernStatistics' => $modernStatisticFinder->fetch(),
			'total'            => $total,
		];
		return $this->view('BR\ModernStatistic:ModernStatistic\Listing', 'brms_modern_statistic_list', $viewParams);
	}

	protected function modernStatisticAddEdit(\BR\ModernStatistic\Entity\ModernStatistic $modernStatistic)
	{
		$listKinds = [
			'thread' => \XF::phrase('thread'),
			'user' => \XF::phrase('user'),
			'profile_post' => \XF::phrase('profile_post'),
		];

		$modernStatisticRepo = $this->getModernStatisticRepo();
		$listTypeUsers = [
			'user_most_messages'  => \XF::phrase('brms_most_messages'),
			'user_most_points'    => \XF::phrase('brms_most_points'),
			'user_staff_members'  => \XF::phrase('brms_staff_members'),
			'user_latest_members' => \XF::phrase('brms_latest_members'),
			'user_latest_banned'  => \XF::phrase('brms_latest_banned_members'),
		];
		if(\XF::$versionId < 2010000)
		{
			$listTypeUsers += [
				'user_most_likes' => \XF::phrase('brms_most_likes')
			];
		}else
		{
			$listTypeUsers += [
				'user_most_reaction_scores' => \XF::phrase('brms_most_reaction_scores')
			];
		}

		$creditVersion = $modernStatisticRepo->checkBriviumCreditsAddon();
		$currencyOptions = [];
		if($creditVersion){
			/*$listTypeUsers[] = ['value' => 'user_richest', 	'label' => \XF::phrase('BRC_top_richest')];
			$listTypeUsers[] = ['value' => 'user_poorest', 	'label' => \XF::phrase('BRC_top_poorest')];
			$currencyOptions = $this->_getCurrencyModel()->getCurrenciesForOptionsTag();*/
		}

		$resourceVersion = $modernStatisticRepo->checkXenForoResourceAddon();
		$resourceCategoryOptions = [];
		$resourcePrefixes = [];
		if($resourceVersion){
			$listTypeUsers['user_most_resources'] = \XF::phrase('brms_most_resources');
			$listKinds['resource'] = \XF::phrase('xfrm_resource');
			$resourceCategoryOptions = $this->repository('XFRM:Category')
											->findCategoryList()
											->fetch()
											->pluckNamed('title', 'resource_category_id');

			$resourcePrefixes = $this->repository('XFRM:ResourcePrefix')
				->findPrefixesForList()
				->fetch()
				->pluckNamed('title', 'prefix_id');
		}

		$listTypeThreads = [
			'thread_latest'    => \XF::phrase('brms_latest_threads'),
			'thread_hotest'    => \XF::phrase('brms_most_viewed_threads'),
			'post_latest'      => \XF::phrase('brms_latest_replies'),
			'most_reply'       => \XF::phrase('brms_most_replied_threads'),
			'sticky_threads'   => \XF::phrase('brms_sticky_threads'),
			'my_threads'       => \XF::phrase('brms_my_threads'),
			'promoted_threads' => \XF::phrase('brms_promoted_threads'),
		];
		$listTypeProfilePosts = [
			'latest_profile_posts' => \XF::phrase('brms_latest_profile_posts'),
			'your_profile_posts'   => \XF::phrase('brms_your_profile_posts'),
		];
		$listTypeResources = [
			'resource_last_update'     => \XF::phrase('brms_latest_updates'),
			'resource_resource_date'   => \XF::phrase('newest_resources'),
			'resource_rating_weighted' => \XF::phrase('top_resources'),
			'resource_download_count'  => \XF::phrase('most_downloaded'),
		];

		/** @var \XF\Repository\Style $styleRepo */
		$styleRepo = $this->repository('XF:Style');
		$styleTree = $styleRepo->getStyleTree(false);

		$lastOrder = 1;
		if ($modernStatistic->modern_statistic_id)
		{
			$tabData = $modernStatisticRepo->prepareTabData($modernStatistic['tab_data'], true);
			if(!empty($tabData)){
				$end = end($tabData);
				$lastOrder = !empty($end['display_order']) ? $end['display_order'] + 1 : 0;
				if($lastOrder == 0){
					$lastOrder = count($tabData) + 1;
				}
			}
			$itemLimit = $modernStatistic['item_limit'];
		}else{
			$tabData = [];
			$itemLimit = [
				'default' => 15
			];
		}
		$defaultTabData = [
			'kind'					=> '',
			'title'					=> '',
			'type'					=> '',
			'order_type'			=> '',
			'order_direction'		=> '',
			'cut_off'				=> 0,
			'active'				=> 1,
			'prefix_id'				=> [],
			'forums'				=> [],
			'discussion_state'		=> [],
			'discussion_open'		=> [],
			'categories'			=> [],
			'user_groups'			=> [],
			'resource_prefix_id'	=> [],
			'resource_state'		=> [],
			'gender'				=> [],
			'user_state'			=> [],
			'currency_id'			=> 0,
			'display_order'			=> $lastOrder,
		];


		$forums = $this->repository('XF:Node')->getNodeOptionsData(false, 'Forum');
		$nodes = $this->repository('XF:Node')->getNodeOptionsData(false);


		$advertisingPositions = $this->repository('XF:Advertising')
			->findAdvertisingPositionsForList(true)
			->fetch()
			->pluckNamed('title', 'position_id');

		$viewParams = [
			'modernStatistic'         => $modernStatistic,
			'advertisingPositions'    => $advertisingPositions,

			'lastOrder'               => $lastOrder,

			'styleTree'               => $styleTree,
			'defaultTabData'          => $defaultTabData,

			'resourceVersion'         => $resourceVersion,
			'userGroups'              => $this->repository('XF:UserGroup')->getUserGroupTitlePairs(),

			'resourceCategoryOptions' => $resourceCategoryOptions,
			'resourcePrefixes'        => $resourcePrefixes,
			'currencyOptions'         => $currencyOptions,
			'forums'                  => $forums,
			'nodes'                   => $nodes,
			'threadPrefixes'          => $this->repository('XF:ThreadPrefix')
											->findPrefixesForList()
											->fetch()
											->pluckNamed('title', 'prefix_id'),

			'nextCounter'             => count($tabData)+1,
			'tabData'                 => $tabData,
			'itemLimit'               => $itemLimit,

			'listTypeThreads'         => $listTypeThreads,
			'listTypeProfilePosts'    => $listTypeProfilePosts,
			'listTypeResources'       => $listTypeResources,
			'listTypeUsers'           => $listTypeUsers,
			'languageTree'            => $this->repository('XF:Language')->getLanguageTree(false),

			'listKinds'               => $listKinds,
		];
		return $this->view('BR\ModernStatistic:ModernStatistic\Edit', 'brms_modern_statistic_edit', $viewParams);
	}

	public function actionEdit(ParameterBag $params)
	{
		$modernStatistic = $this->assertModernStatisticExists($params->modern_statistic_id);
		return $this->modernStatisticAddEdit($modernStatistic);
	}

	public function actionAdd()
	{
		$modernStatistic = $this->em()->create('BR\ModernStatistic:ModernStatistic');
		return $this->modernStatisticAddEdit($modernStatistic);
	}

	protected function modernStatisticSaveProcess(\BR\ModernStatistic\Entity\ModernStatistic $modernStatistic)
	{
		$form = $this->formAction();

		$input = $this->filter([
			'title'					=> 'str',
			'active'				=> 'uint',
			'usename_marke_up'		=> 'uint',
			'show_thread_prefix'	=> 'uint',
			'show_resource_prefix'	=> 'uint',
			'load_fisrt_tab'		=> 'uint',
			'control_position'		=> 'str',
			'preview_tooltip'		=> 'str',
			'position'				=> 'str',
			'style_display'			=> 'str',
			'thread_cutoff'			=> 'uint',
			'enable_cache'			=> 'uint',
			'cache_time'			=> 'uint',
			'auto_update'			=> 'uint',
			'allow_change_layout'	=> 'uint',
			'allow_manual_refresh'	=> 'uint',
			'allow_user_setting'	=> 'uint',
			'modern_criteria'		=> 'array',
			'style_settings'		=> 'array',
		]);
		if(!empty($input['modern_criteria']['language_ids'])){
			$input['modern_criteria']['language_ids'] = array_filter($input['modern_criteria']['language_ids']);
		}

		$form->validate(function(FormAction $form) use ($modernStatistic)
		{
			$itemLimit = $this->filter('item_limit', 'array');
			$output = array();
			if(!empty($itemLimit['value'])){
				foreach ($itemLimit['value'] as $number) {
					if (!empty($number) && $number > 0) {
						$output[] = intval($number);
					}
				}
				asort($output);
				$itemLimit['value'] = array_values(array_unique($output));
			}
			if(!empty($itemLimit['default'])){
				$itemLimit['default'] = intval($itemLimit['default']);
			}else{
				$itemLimit['default'] = 15;
			}
			if(!empty($itemLimit['enabled']) && empty($itemLimit['value'])){
				$form->logError(\XF::phrase('brms_must_have_value_for_item_limit'), 'item_limit');
			}
			$modernStatistic->item_limit = $itemLimit;
		});

		$form->validate(function(FormAction $form) use ($modernStatistic)
		{
			$tabs = $this->filter('tab_data', 'array');
			$tabList = [];
			foreach ($tabs as $key => $tab) {
				if (!empty($tab['kind'])) {
					switch($tab['kind']){
						case 'profile_post':
							if (!empty($tab['type_profile_post']) && isset($tab['kind'])) {
								$tab['type']= $tab['type_profile_post'];
								$tabList[] = $tab;
							}
							break;
						case 'resource':
							if (!empty($tab['type_resource']) && isset($tab['kind'])) {
								$tab['type']= $tab['type_resource'];
								$tabList[] = $tab;
							}
							break;
						case 'user':
							if (!empty($tab['type_user']) && isset($tab['kind'])) {
								$tab['type']= $tab['type_user'];
								if(($tab['type_user']=='user_poorest' || $tab['type_user']=='user_richest') && empty($tab['currency_id'])){
									$form->logError(\XF::phrase('brms_must_select_currency'), 'currency_id');
								}
								$tabList[] = $tab;
							}
							break;
						case 'thread':
						default:
							if (!empty($tab['type']) && !empty($tab['kind'])) {
								$tabList[] = $tab;
							}
							break;
					}
				}
			}
			if(!$tabList){
				$form->logError(\XF::phrase('brms_please_select_at_least_one_tab'), 'tab_data');
			}
			$modernStatistic->tab_data = $tabList;
		});

		$form->basicEntitySave($modernStatistic, $input);

		return $form;
	}

	public function actionSave(ParameterBag $params)
	{
		if ($params->modern_statistic_id)
		{
			$modernStatistic = $this->assertModernStatisticExists($params->modern_statistic_id);
		}
		else
		{
			$modernStatistic = $this->em()->create('BR\ModernStatistic:ModernStatistic');
		}

		$this->modernStatisticSaveProcess($modernStatistic)->run();

		return $this->redirect($this->buildLink('brms-statistics') . $this->buildLinkHash($modernStatistic->modern_statistic_id));
	}

	public function actionDelete(ParameterBag $params)
	{
		$modernStatistic = $this->assertModernStatisticExists($params->modern_statistic_id);
		if (!$modernStatistic->preDelete())
		{
			return $this->error($modernStatistic->getErrors());
		}

		if ($this->isPost())
		{
			$modernStatistic->delete();
			return $this->redirect($this->buildLink('brms-statistics'));
		}
		else
		{
			$viewParams = [
				'modernStatistic' => $modernStatistic
			];
			return $this->view('BR\ModernStatistic:ModernStatistic\Delete', 'brms_modern_statistic_delete', $viewParams);
		}
	}

	/**
	 * @param string $id
	 * @param array|string|null $with
	 * @param null|string $phraseKey
	 *
	 * @return ModernStatistic
	 */
	protected function assertModernStatisticExists($id, $with = null, $phraseKey = null)
	{
		return $this->assertRecordExists('BR\ModernStatistic:ModernStatistic', $id, $with, $phraseKey);
	}

	/**
	 * @return \BR\ModernStatistic\Repository\ModernStatistic
	 */
	protected function getModernStatisticRepo()
	{
		return $this->repository('BR\ModernStatistic:ModernStatistic');
	}
}
