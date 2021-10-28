<?php

namespace DBTech\Credits\Finder;

use XF\Mvc\Entity\ArrayCollection;
use XF\Mvc\Entity\Finder;

/**
 * Class Transaction
 * @package DBTech\Credits\Finder
 */
class Transaction extends Finder
{
	/**
	 * @param bool $allowOwnPending
	 *
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function applyGlobalVisibilityChecks($allowOwnPending = false)
	{
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		$conditions = [];
		$viewableStates = [1];
		
		if ($visitor->canViewModeratedDbtechCreditsTransactions())
		{
			$viewableStates[] = 2;
		}
		else if ($visitor->user_id && $allowOwnPending)
		{
			$conditions[] = [
				'status' => 2,
				'user_id' => $visitor->user_id
			];
		}
		
		$conditions[] = ['status', $viewableStates];
		$this->whereOr($conditions);
		
		if (!$visitor->canViewAnyDbtechCreditsTransaction())
		{
			$this->whereOr([
				['user_id', $visitor->user_id],
				['source_user_id', $visitor->user_id]
			]);
		}
		
		$this->where([
			['Event.active', true],
			['Event.display', true],
		]);
		
		if (!$visitor->canBypassDbtechCreditsCurrencyPrivacy())
		{
			$this->where([
				['Currency.active', true],
				['Currency.privacy', '>=', 1],
			]);
		}
		else
		{
			$this->where('Currency.active', true);
		}
		
		return $this;
	}
	
	/**
	 * @return $this
	 */
	public function forFullView()
	{
		$this->with(['Event', 'Currency', 'TargetUser', 'SourceUser', 'Owner']);
		
		return $this;
	}
	
	/**
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function useDefaultOrder()
	{
//		$defaultOrder = $this->app()->options()->dbtechCreditsListDefaultOrder ?: 'last_update';
		$defaultOrder = 'dateline';
		$defaultDir = $defaultOrder == 'title' ? 'asc' : 'desc';
		
		$this->setDefaultOrder([
			[$defaultOrder, $defaultDir],
			['transaction_id', 'desc']
		]);
		
		return $this;
	}
}