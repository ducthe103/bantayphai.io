<?php

namespace DBTech\Credits\Searcher;

use XF\Searcher\AbstractSearcher;
use XF\Mvc\Entity\Finder;

/**
 * Class TransactionLog
 * @package DBTech\Credits\Searcher
 */
class TransactionLog extends AbstractSearcher
{
    /**
     * @var array
     */
    protected $allowedRelations = ['Event', 'Currency', 'TargetUser', 'SourceUser'];

    /**
     * @var array
     */
    protected $formats = [
		'username' => 'like',
		'dateline' => 'date',
	];

    /**
     * @var array
     */
    protected $order = [['dateline', 'desc']];

    /**
     * @return string
     */
    protected function getEntityType()
	{
		return 'DBTech\Credits:Transaction';
	}

    /**
     * @return array
     */
    protected function getDefaultOrderOptions()
	{
		$orders = [
			'dateline' => \XF::phrase('date'),
			'SourceUser.username' => \XF::phrase('dbtech_credits_source_user'),
			'TargetUser.username' => \XF::phrase('dbtech_credits_target_user'),
		];

		\XF::fire('dbtech_credits_transaction_log_searcher_orders', [$this, &$orders]);

		return $orders;
	}

	/*
	protected function validateSpecialCriteriaValue($key, &$value, $column, $format, $relation)
	{
		if ($key == 'no_secondary_group_ids' && !$value)
		{
			return false;
		}

		return null;
	}
	*/

    /**
     * @param Finder $finder
     * @param $key
     * @param $value
     * @param $column
     * @param $format
     * @param $relation
     * @return bool
     */
    protected function applySpecialCriteriaValue(Finder $finder, $key, $value, $column, $format, $relation)
	{
		if ($key == 'transaction_id')
		{
			if (!$value)
			{
				return true;
			}
		}
		
		if ($key == 'event_trigger_id')
		{
			if ($value == '_any')
			{
				return true;
			}
		}
		
		if ($key == 'event_id')
		{
			if ($value == '_any')
			{
				return true;
			}
		}
		
		return false;
	}

    /**
     * @return array
     */
    public function getFormData()
	{
		return [];
	}
}