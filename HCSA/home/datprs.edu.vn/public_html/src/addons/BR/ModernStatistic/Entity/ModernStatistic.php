<?php

namespace BR\ModernStatistic\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class ModernStatistic extends Entity
{
	protected function _postSave()
	{
		if ($this->getOption('rebuild_cache'))
		{
			$this->repository('BR\ModernStatistic:ModernStatistic')->rebuildModernStatisticCache();
		}
		$this->_cleanCaches();
	}

	protected function _postDelete()
	{
		if ($this->getOption('rebuild_cache'))
		{
			$this->repository('BR\ModernStatistic:ModernStatistic')->rebuildModernStatisticCache();
		}
		$this->_cleanCaches();
	}

	protected function _cleanCaches()
	{
		$updateData = array(
			'cache_html'       =>	'',
			'cache_params'     =>	'',
			'tab_cache_htmls'  =>	'',
			'tab_cache_params' =>	'',
			'last_update'      =>	0,
		);
		$this->db()->update('xf_brms_modern_cache', $updateData, 'modern_statistic_id = ?', $this->get('modern_statistic_id'));
	}

	protected function _setupDefaults()
	{
		$this->preview_tooltip      = 'custom_preview';
		$this->control_position     = 'brmsLeftTabs';
		$this->usename_marke_up     = 1;
		$this->show_thread_prefix   = 1;
		$this->show_resource_prefix = 1;
		$this->allow_change_layout  = 1;
		$this->allow_manual_refresh = 1;
		$this->auto_update          = 60;
		$this->active               = 1;
		$this->enable_cache         = 1;
		$this->allow_user_setting   = 1;
		$this->cache_time           = 5;
	}

	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_brms_modern_statistic';
		$structure->shortName = 'BR\ModernStatistic:ModernStatistic';
		$structure->primaryKey = 'modern_statistic_id';
		$structure->columns = [
			'modern_statistic_id'  => ['type' => self::UINT, 'autoIncrement' => true],
			'title'                => ['type' => self::STR, 'required' => 'please_enter_valid_title'],
			'tab_data'             => ['type' => self::SERIALIZED_ARRAY, 'required' => 'brms_please_select_at_least_one_tab'],
			'position'             => ['type' => self::STR, 'required' => true],
			'control_position'     => ['type' => self::STR, 'default' => 'brmsLeftTabs'],
			'item_limit'           => ['type' => self::SERIALIZED_ARRAY, 'required' => true],
			'auto_update'          => ['type' => self::UINT, 'default' => 0],
			'style_display'        => ['type' => self::STR, 'default' => ''],
			'preview_tooltip'      => ['type' => self::STR, 'default' => 'custom_preview'],
			'enable_cache'         => ['type' => self::BOOL, 'default' => 0],
			'cache_time'           => ['type' => self::UINT, 'default' => 1],
			'thread_cutoff'        => ['type' => self::UINT, 'default' => 30],
			'usename_marke_up'     => ['type' => self::BOOL, 'default' => 1],
			'show_thread_prefix'   => ['type' => self::BOOL, 'default' => 1],
			'show_resource_prefix' => ['type' => self::BOOL, 'default' => 1],
			'allow_change_layout'  => ['type' => self::BOOL, 'default' => 1],
			'allow_manual_refresh' => ['type' => self::BOOL, 'default' => 1],
			'load_fisrt_tab'       => ['type' => self::BOOL, 'default' => 0],
			'modern_criteria'      => ['type' => self::SERIALIZED_ARRAY, 'required' => true],
			'style_settings'       => ['type' => self::SERIALIZED_ARRAY, 'default' => []],
			'allow_user_setting'   => ['type' => self::BOOL, 'default' => 1],
			'active'               => ['type' => self::BOOL, 'default' => 1],
		];
		$structure->getters = [];
		$structure->relations = [];
		$structure->options = [
			'rebuild_cache' => true
		];

		return $structure;
	}
}
