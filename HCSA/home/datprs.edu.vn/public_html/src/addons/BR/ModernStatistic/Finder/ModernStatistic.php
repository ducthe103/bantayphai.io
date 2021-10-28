<?php

namespace BR\ModernStatistic\Finder;

use XF\Mvc\Entity\Finder;

class ModernStatistic extends Finder
{
	public function indexPage($visibilityLimit = true)
	{
		if ($visibilityLimit)
		{
			$conditions = [
				['product_state', ['visible']]
			];
			$this->whereOr($conditions);
		}
		return $this;
	}
}
