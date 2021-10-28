<?php

namespace DBTech\Credits\XF\Entity;

use XF\Mvc\Entity\Structure;
use XF\Mvc\Entity\Entity;

class TagContent extends XFCP_TagContent
{
	/**
	 * @param Structure $structure
	 *
	 * @return Structure
	 */
	public static function getStructure(Structure $structure)
	{
		$structure = parent::getStructure($structure);
		
		if (empty($structure->relations['AddUser']))
		{
			$structure->relations['AddUser'] = [
				'entity' => 'XF:User',
				'type' => self::TO_ONE,
				'conditions' => [['user_id', '=', '$add_user_id']],
				'primary' => true
			];
		}
		
		return $structure;
	}
}