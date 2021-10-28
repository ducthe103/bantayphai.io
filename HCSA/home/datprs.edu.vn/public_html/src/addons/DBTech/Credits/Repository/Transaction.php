<?php

namespace DBTech\Credits\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

/**
 * Class Transaction
 * @package DBTech\Credits\Repository
 */
class Transaction extends Repository
{
	/**
	 * @param array $limits
	 *
	 * @return \DBTech\Credits\Finder\Transaction
	 * @throws \InvalidArgumentException
	 */
	public function findTransactionsForOverviewList(array $limits = [])
	{
		$limits = array_replace([
			'visibility' => true,
			'allowOwnPending' => false
		], $limits);
		
		/** @var \DBTech\Credits\Finder\Transaction $transactionFinder */
		$transactionFinder = $this->finder('DBTech\Credits:Transaction');
		
		$transactionFinder
			->forFullView()
			->useDefaultOrder()
			->indexHint('FORCE', 'transaction_date');
		
		if ($limits['visibility'])
		{
			$transactionFinder->applyGlobalVisibilityChecks($limits['allowOwnPending']);
		}
		
		return $transactionFinder;
	}
	
	/**
	 * @param \XF\Entity\User $receiver
	 * @param \XF\Entity\User $sender
	 * @param \DBTech\Credits\Entity\Transaction $transaction
	 * @param array $extra
	 *
	 * @return bool
	 */
	public function sendTransactionAlert(
		\XF\Entity\User $receiver, \XF\Entity\User $sender,
		\DBTech\Credits\Entity\Transaction $transaction, array $extra = []
	)
	{
		/** @var \XF\Repository\UserAlert $alertRepo */
		$alertRepo = $this->repository('XF:UserAlert');
		
		if ($receiver->user_id == $sender->user_id || !$sender->user_id)
		{
			$alertRepo->alert(
				$receiver, 0, '',
				'dbtech_credits', $transaction->transaction_id,
				$transaction->event_trigger_id, $extra
			);
		}
		else
		{
			// Sent from another user
			$alertRepo->alertFromUser(
				$receiver, $sender,
				'dbtech_credits', $transaction->transaction_id,
				$transaction->event_trigger_id, $extra
			);
		}
		
		return true;
	}
	
	/**
	 * @return Finder
	 */
	public function findTransactionsForList()
	{
		return $this->finder('DBTech\Credits:Transaction')->order('transaction_id', 'DESC');
	}
}