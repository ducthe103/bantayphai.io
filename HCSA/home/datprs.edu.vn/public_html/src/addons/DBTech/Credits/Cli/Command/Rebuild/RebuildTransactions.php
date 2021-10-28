<?php

namespace DBTech\Credits\Cli\Command\Rebuild;

use Symfony\Component\Console\Input\InputOption;
use XF\Cli\Command\Rebuild\AbstractRebuildCommand;

/**
 * Class Transactions
 *
 * @package DBTech\Credits\Cli\Command\Rebuild
 */
class Transactions extends AbstractRebuildCommand
{
	/**
	 * @return string
	 */
	protected function getRebuildName()
	{
		return 'dbtech-credits-transactions';
	}

	/**
	 * @return string
	 */
	protected function getRebuildDescription()
	{
		return 'Rebuilds the transaction records.';
	}

	/**
	 * @return string
	 */
	protected function getRebuildClass()
	{
		return 'DBTech\Credits:TransactionRebuild';
	}
	
	protected function configureOptions()
	{
		$this
			->addOption(
				'type',
				null,
				InputOption::VALUE_REQUIRED,
				'Content type to rebuild transaction records for. Default: all'
			)
			->addOption(
				'truncate',
				null,
				InputOption::VALUE_NONE,
				'Delete the existing records before rebuilding. Default: false'
			)
			->addOption(
				'reset',
				null,
				InputOption::VALUE_NONE,
				'Reset all currencies to 0. Requires "truncate" option. Default: false'
			);
	}
}