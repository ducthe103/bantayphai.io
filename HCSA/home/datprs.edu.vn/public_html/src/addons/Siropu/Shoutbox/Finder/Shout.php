<?php

namespace Siropu\Shoutbox\Finder;

use XF\Mvc\Entity\Finder;

class Shout extends Finder
{
     public function notIgnored()
     {
          $ignored = \XF::visitor()->Profile->ignored;

          if ($ignored)
          {
               $this->where('shout_user_id', '<>', array_keys($ignored));
          }

          return $this;
     }
     public function havingText($text)
     {
          $this->where('shout_message', 'LIKE', $this->escapeLike($text, '%?%'));
          return $this;
     }
     public function fromUser($userId)
     {
          $this->where('shout_user_id', $userId);
          return $this;
     }
}
