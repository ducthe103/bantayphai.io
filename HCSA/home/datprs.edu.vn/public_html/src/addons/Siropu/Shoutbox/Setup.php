<?php

namespace Siropu\Shoutbox;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
	{
		$this->schemaManager()->createTable('xf_siropu_shoutbox_shout', function(Create $table)
		{
			$table->addColumn('shout_id', 'int')->autoIncrement();
			$table->addColumn('shout_user_id', 'int');
			$table->addColumn('shout_message', 'text');
			$table->addColumn('shout_date', 'int');
			$table->addKey('shout_user_id');
			$table->addKey('shout_date');
		});
	}
	public function installStep2()
	{
		$this->createWidget('siropu_shoutbox', 'siropu_shoutbox', [
			'positions' => [
				'forum_list_above_nodes' => 10
			]
		]);
	}
     public function installStep3()
	{
		$this->addBanUserField();
	}
     public function upgrade1040070Step1()
     {
          $this->addBanUserField();
     }
	public function uninstallStep1()
	{
		$this->schemaManager()->dropTable('xf_siropu_shoutbox_shout');
	}
     public function uninstallStep2()
	{
		$this->deleteWidget('siropu_shoutbox');
	}
     public function uninstallStep3()
	{
		$this->schemaManager()->alterTable('xf_user', function(Alter $table)
		{
			$table->dropColumns(['siropu_shoutbox_ban']);
		});
	}
     private function addBanUserField()
     {
          $this->schemaManager()->alterTable('xf_user', function(Alter $table)
		{
			$table->addColumn('siropu_shoutbox_ban', 'int')->unsigned(false)->setDefault(-1);
			$table->addKey('siropu_shoutbox_ban', 'siropu_shoutbox_ban');
		});
     }
}
