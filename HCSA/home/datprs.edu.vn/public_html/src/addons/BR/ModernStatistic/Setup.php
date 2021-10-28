<?php

namespace BR\ModernStatistic;

use MJCore\AbstractSetup;
use XF\Db\Schema\Create;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	protected function getTables()
	{
		$tables = [];

		$tables['xf_brms_modern_cache'] = function(Create $table) {
			$table->checkExists(true);
			$table->addColumn('modern_statistic_id', 'int');
			$table->addColumn('user_id', 'int');
			$table->addColumn('last_update', 'int')->setDefault(0);
			$table->addColumn('item_limit', 'int')->setDefault(0);
			$table->addColumn('cache_html', 'mediumtext')->nullable();
			$table->addColumn('cache_params', 'mediumblob')->nullable();
			$table->addColumn('tab_cache_htmls', 'mediumblob')->nullable();
			$table->addColumn('tab_cache_params', 'mediumblob')->nullable();
			$table->addUniqueKey(['modern_statistic_id', 'user_id'], 'modern_statistic_id');
			$table->addKey('user_id', 'user_id');
			$table->addKey('modern_statistic_id', 'modern_statistic');
			$table->addKey(['user_id', 'modern_statistic_id', 'last_update'], 'user_last_update');
		};

		$tables['xf_brms_modern_statistic'] = function(Create $table) {
			$table->checkExists(true);
			$table->addColumn('modern_statistic_id', 'int')->autoIncrement();
			$table->addColumn('title', 'varchar', 50);
			$table->addColumn('tab_data', 'mediumblob');
			$table->addColumn('position', 'text');
			$table->addColumn('control_position', 'varchar', 50)->setDefault('');
			$table->addColumn('item_limit', 'blob');
			$table->addColumn('auto_update', 'int', 11)->unsigned(false)->setDefault(0);
			$table->addColumn('style_display', 'varchar', 100)->setDefault('');
			$table->addColumn('preview_tooltip', 'varchar', 30)->setDefault('');
			$table->addColumn('enable_cache', 'tinyint')->setDefault(0);
			$table->addColumn('cache_time', 'int', 11)->unsigned(false)->setDefault(0);
			$table->addColumn('thread_cutoff', 'int')->setDefault(0);
			$table->addColumn('usename_marke_up', 'tinyint', 4)->unsigned(false)->setDefault(1);
			$table->addColumn('show_thread_prefix', 'tinyint', 4)->unsigned(false)->setDefault(1);
			$table->addColumn('show_resource_prefix', 'tinyint', 4)->unsigned(false)->setDefault(1);
			$table->addColumn('allow_change_layout', 'tinyint')->setDefault(1);
			$table->addColumn('allow_manual_refresh', 'tinyint')->setDefault(1);
			$table->addColumn('load_fisrt_tab', 'tinyint')->setDefault(0);
			$table->addColumn('modern_criteria', 'mediumblob');
			$table->addColumn('style_settings', 'blob');
			$table->addColumn('allow_user_setting', 'tinyint')->setDefault(1);
			$table->addColumn('active', 'tinyint')->setDefault(1);
			$table->addColumn('language_id', 'int')->setDefault(0);
			$table->addPrimaryKey('modern_statistic_id');
		};

		return $tables;
	}

	protected function getAlters()
	{
		$alters = [];

		$alters['xf_thread'] = function(Alter $table) {
			$table->addColumn('brms_promote_date', 'int')->setDefault(0);
		};

		$alters['xf_user'] = function(Alter $table) {
			$table->addColumn('brms_statistic_perferences', 'blob')->nullable();
			$table->addColumn('brms_limit_cache', 'text');
		};

		return $alters;
	}

	protected function getDropAlters()
	{
		$alters = [];

		$alters['xf_thread'] = function(Alter $table) {
			$table->dropColumns(['brms_promote_date']);
		};

		$alters['xf_user'] = function(Alter $table) {
			$table->dropColumns(['brms_statistic_perferences', 'brms_limit_cache']);
		};

		return $alters;
	}

	public function postInstall(array &$stateChanges)
	{
		\XF::repository('BR\ModernStatistic:ModernStatistic')->rebuildModernStatisticCache();
	}

	protected function upgrade3000030Step1()
	{
		$sm = $this->schemaManager();

		$renameTables = [
			'xf_brivium_modern_cache'     => 'xf_brms_modern_cache',
			'xf_brivium_modern_statistic' => 'xf_brms_modern_statistic',
		];
		foreach ($renameTables as $from => $to)
		{
			if($sm->tableExists($from) && !$sm->tableExists($to)){
				$sm->renameTable($from, $to);
			}
		}
	}
	protected function upgrade3010071Step1()
	{
		$sm = $this->schemaManager();
		$sm->alterTable('xf_user', function(Alter $table){
			$table->addColumn('brms_limit_cache', 'text');
		});
	}

	public function uninstallStep3()
	{
		try{
			\XF::registry()->delete('brmsModernStatistics');
		}catch (\Exception $e) {
		}
	}
}