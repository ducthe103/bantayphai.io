<?php

namespace Siropu\Shoutbox\Repository;

use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Repository;

class Shout extends Repository
{
     public function findShouts($limit = 0)
     {
          return $this->finder('Siropu\Shoutbox:Shout')
               ->order('shout_date', 'DESC')
               ->limit($limit ?: \XF::options()->siropuShoutboxDisplayLimit);
     }
     public function deleteShoutsOlderThan($date)
     {
          $this->db()->delete('xf_siropu_shoutbox_shout', 'shout_date <= ?', $date);
     }
     public function prune()
     {
          $this->db()->emptyTable('xf_siropu_shoutbox_shout');
     }
}
