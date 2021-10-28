<?php

namespace BR\ModernStatistic\XF\Entity;

use XF\Mvc\Entity\Structure;

class Thread extends XFCP_Thread
{
	public function canPromoteThread(&$error = null)
	{
		$visitor = \XF::visitor();
		return ($visitor->user_id && $visitor->hasNodePermission($this->node_id, 'BRMS_promoteThread'));
	}

	public static function getStructure(Structure $structure)
	{
		$structure = parent::getStructure($structure);

		$structure->columns['brms_promote_date'] = ['type' => self::UINT, 'default' => 0];

		return $structure;
	}
}
