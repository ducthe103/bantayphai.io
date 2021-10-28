<?php

namespace MMO\VerifiedBadge;

use XF\Mvc\Entity\Entity;

class Listener
{
    public static function userEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->columns['mvb_verified'] = ['type' => Entity::BOOL, 'default' => 0];
    }
}