<?php

namespace MMO\VerifiedBadge\XF\Entity;

use XF\Mvc\Entity\Structure;

class User extends XFCP_User
{
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns = array_merge(
            $structure->columns,
            [
                'mvb_verified' => [
                    'type' => self::BOOL, 'default' => 0
                ]
            ]
        );

        return $structure;
    }
}