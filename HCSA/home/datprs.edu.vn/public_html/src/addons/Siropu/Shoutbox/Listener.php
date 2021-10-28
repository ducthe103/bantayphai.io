<?php

namespace Siropu\Shoutbox;

use XF\Mvc\Entity\Entity;

class Listener
{
     public static function userEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
     {
          $structure->columns['siropu_shoutbox_ban'] = ['type' => Entity::INT, 'default' => -1, 'changeLog' => false];
     }
}
