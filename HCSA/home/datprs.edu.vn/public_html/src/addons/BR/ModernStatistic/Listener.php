<?php

namespace BR\ModernStatistic;

use XF\Template\Templater;
use XF\App;
use XF\Mvc\Entity\Manager;
use XF\Mvc\Entity\Structure;
use XF\Mvc\Entity\Entity;

class Listener
{
	public static function appSetup(App $app)
	{
		$container = $app->container();
		$container['brmsModernStatistics'] = $app->fromRegistry(
			'brmsModernStatistics',
			function (\XF\Container $c) {
				return $c['em']->getRepository('BR\ModernStatistic:ModernStatistic')->rebuildModernStatisticCache();
			}
		);
	}

	public static function userEntityStructure(Manager $em, Structure &$structure)
	{
		$structure->columns += [
			'brms_statistic_perferences' => ['type' => Entity::SERIALIZED_ARRAY, 'default' => 0, 'changeLog' => false],
			'brms_limit_cache' => ['type' => Entity::JSON_ARRAY, 'default' => [], 'changeLog' => false]
		];
	}
}
