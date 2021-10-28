<?php

namespace MMO\VerifiedBadge;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

	public function installStep1()
	{
        $this->schemaManager()->alterTable('xf_user', function(Alter $table)
        {
            $table->addColumn('mvb_verified', 'tinyint', 3)->setDefault(0);
        });
	}

	public function upgrade2000270Step1()
	{
	    $sm = $this->schemaManager();

        $sm->alterTable('xf_user', function(Alter $table)
        {
            $table->renameColumn('mmo_verified', 'mvb_verified');
            // note that the index name is still resource_count
        });
	}

	public function uninstallStep1()
	{
        $this->schemaManager()->alterTable('xf_user', function(Alter $table)
        {
            $table->dropColumns('mvb_verified');
        });
	}
}