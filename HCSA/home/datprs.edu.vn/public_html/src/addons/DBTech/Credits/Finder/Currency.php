<?php

namespace DBTech\Credits\Finder;

use XF\Mvc\Entity\Finder;

/**
 * Class Currency
 * @package DBTech\Credits\Finder
 */
class Currency extends Finder
{
	/**
	 * @param $match
	 * @param bool $caseSensitive
	 * @param bool $prefixMatch
	 * @param bool $exactMatch
	 *
	 * @return $this
	 */
    public function searchText($match, $caseSensitive = false, $prefixMatch = false, $exactMatch = false)
	{
		if ($match)
		{
			$expression = 'title';
			if ($caseSensitive)
			{
				$expression = $this->expression('BINARY %s', $expression);
			}

			if ($exactMatch)
			{
				$this->where($expression, $match);
			}
			else
			{
				$this->where($expression, 'LIKE', $this->escapeLike($match, $prefixMatch ? '?%' : '%?%'));
			}
		}

		return $this;
	}
	
	/**
	 * @return $this
	 */
	public function orderForList()
	{
		$this->order('display_order', 'ASC');
		$this->orderTitle();
		
		return $this;
	}
	
    /**
     * @param string $direction
     * @return $this
     */
    public function orderTitle($direction = 'ASC')
	{
		$expression = $this->columnUtf8('title');
		$this->order($expression, $direction);

		return $this;
	}
	
	/**
	 * @return $this
	 * @throws \InvalidArgumentException
	 */
	public function useDefaultOrder()
	{
		$defaultOrder = 'title';
		$defaultDir = $defaultOrder == 'title' ? 'asc' : 'desc';
		
		$this->setDefaultOrder($defaultOrder, $defaultDir);
		
		return $this;
	}
}