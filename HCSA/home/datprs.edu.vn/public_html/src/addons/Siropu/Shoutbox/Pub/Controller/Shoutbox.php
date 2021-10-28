<?php

namespace Siropu\Shoutbox\Pub\Controller;

use XF\Pub\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Shoutbox extends AbstractController
{
     use \Siropu\Shoutbox\Shoutbox;

     protected $lastId;

     protected function preDispatchController($action, ParameterBag $params)
	{
          $visitor = \XF::visitor();

          if (!$visitor->canViewSiropuShoutbox() && !$visitor->isBannedSiropuShoutbox())
          {
               throw $this->exception($this->noPermission());
          }

          $this->lastId = $this->filter('last_id', 'uint');
     }
     public function actionFullPage()
     {
          return $this->rerouteController(__CLASS__, 'index', ['fullPage' => true]);
     }
     public function actionIndex(ParameterBag $params)
     {
          $visitor = \XF::visitor();

          if (!$visitor->hasRequiredAge())
          {
               return $this->noPermission();
          }

          $extraParams = [
               'showTitle'  => true,
               'isFullPage' => $params->fullPage
          ];

          $viewParams = [
               'shoutbox' => $this->getShoutboxParams($extraParams)
          ];

          return $this->view('Siropu\Shoutbox:Shoutbox', 'siropu_shoutbox', $viewParams);
     }
     public function actionArchive(ParameterBag $params)
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if (!$visitor->canViewSiropuShoutboxArchive())
          {
               return $this->noPermission();
          }

          $page    = $this->filterPage();
          $perPage = $options->siropuShoutboxArhiveMessagesPerPage;
          $params  = [];

          $finder = $this->getShoutRepo()
               ->findShouts($perPage)
               ->notIgnored()
               ->limitByPage($page, $perPage);

          $username = $this->filter('username', 'str');

          if ($username)
          {
               $user = $this->em()->findOne('XF:User', ['username' => $username]);

               if ($user)
               {
                    $finder->fromUser($user->user_id);
                    $params['username'] = $username;
               }
          }

          $keywords = $this->filter('keywords', 'str');

          if ($keywords)
          {
               $finder->havingText($keywords);
               $params['keywords'] = $keywords;
          }

          $viewParams = [
               'shoutbox' => [
                    'shouts'  => $finder->fetch()
               ],
               'total'   => $finder->total(),
               'page'    => $page,
               'perPage' => $perPage,
               'params'  => $params
          ];

          return $this->view('Siropu\Shoutbox:Shoutbox\Archive', 'siropu_shoutbox_archive', $viewParams);
     }
     public function actionSubmit()
     {
          $visitor = \XF::visitor();
          $options = \XF::options();

          if (!($visitor->canUseSiropuShoutbox() && $visitor->hasRequiredAge()))
          {
               return $this->noPermission();
          }

          $floodCheckLength = $options->siropuShoutboxFloodCheckLength;

          if ($floodCheckLength)
          {
               $lastShout = \XF::app()->request()->getCookie('shoutbox_last_shout');

               if ($lastShout >= \XF::$time - $floodCheckLength)
               {
                    return $this->message(\XF::phrase('siropu_shoutbox_please_wait_x_seconds', ['length' => $floodCheckLength]));
               }
          }

          $message    = $this->filter('shout', 'str');
          $viewParams = ['action' => 'submit'];

          if (preg_match('/^\/prune/i', $message) && $visitor->canPruneSiropuShoutbox())
          {
               $this->getShoutRepo()->prune();

               $message = \XF::phrase('siropu_shoutbox_has_been_pruned');
               $viewParams['prune'] = true;
          }

          $shoutService = $this->service('Siropu\Shoutbox:Shout\Preparer');
          $shoutService->prepare($message);

          if ($shoutService->isValid())
          {
               $message = $shoutService->getMessage();
          }
          else
          {
               return $this->message($shoutService->getErrors());
          }

          $shout = $this->em()->create('Siropu\Shoutbox:Shout');
          $shout->shout_message = $message;
          $shout->save();

          if ($floodCheckLength && !$visitor->canBypassFloodCheckSiropuShoutbox())
          {
               \XF::app()->response()->setCookie('shoutbox_last_shout', \XF::$time, 0, null, false);
          }

          return $this->rerouteController(__CLASS__, 'refresh', $viewParams);
     }
     public function actionRefresh(ParameterBag $params)
     {
          $reverse = $this->getReverseState();

          $shouts = $this->getShoutRepo()
               ->findShouts()
               ->notIgnored()
               ->where('shout_id', '>', $params->prune ? 0 : $this->lastId)
               ->fetch();

          if ($reverse)
          {
               $shouts = $shouts->reverse();
          }

          $viewParams = [
               'shoutbox' => [
                    'shouts' => $shouts
               ]
          ];

          $reply = $this->view('Siropu\Shoutbox:Shoutbox', 'siropu_shoutbox_shout_list', $viewParams);

          if ($shouts->count())
          {
               $reply->setJsonParams([
                    'lastId' => $reverse ? $shouts->last()->shout_id : $shouts->first()->shout_id,
                    'prune'  => $params->prune ? true : false
               ]);
          }

          return $reply;
     }
     public function actionLoadMore()
     {
          $lastId = $this->filter('last_id', 'uint');

          if (!\XF::visitor()->canUseSiropuShoutbox())
          {
               return $this->noPermission();
          }

          $shouts = $this->getShoutRepo()
               ->findShouts()
               ->notIgnored()
               ->where('shout_id', '<', $lastId)
               ->fetch();

          if ($this->getReverseState())
          {
               $shouts = $shouts->reverse();
          }

          $viewParams = [
               'shoutbox' => [
                    'shouts' => $shouts
               ]
          ];

          return $this->view('Siropu\Shoutbox:Shoutbox', 'siropu_shoutbox_shout_list', $viewParams);
     }
     public function actionEdit(ParameterBag $params)
     {
          $shout = $this->assertShoutExists($params->shout_id);

          if (!$shout->canEdit())
          {
               return $this->noPermission();
          }

          if ($this->isPost())
          {
               $shoutService = $this->service('Siropu\Shoutbox:Shout\Preparer');
               $shoutService->prepare($this->filter('message', 'str'));

               if ($shoutService->isValid())
               {
                    $message = $shoutService->getMessage();
               }
               else
               {
                    return $this->message($shoutService->getErrors());
               }

               $shout->shout_message = $message;
               $shout->save();

               $reply = $this->view();
               $reply->setJsonParams([
                    'shout_id'      => $shout->shout_id,
                    'shout_message' => $this->app->bbCode()->render($message, 'html', 'siropu_shoutbox', $shout)
               ]);

               return $reply;
          }

          $viewParams = [
               'shout' => $shout
          ];

          return $this->view('Siropu\Shoutbox:ShoutEdit', 'siropu_shoutbox_shout_edit', $viewParams);
     }
     public function actionDelete(ParameterBag $params)
     {
          $shout = $this->assertShoutExists($params->shout_id);

          if (!$shout->canDelete())
          {
               return $this->noPermission();
          }

          if ($this->isPost())
          {
               $shout->delete();

               $reply = $this->view();
               $reply->setJsonParams([
                    'shout_id' => $shout->shout_id
               ]);

               return $reply;
          }

          $viewParams = [
               'shout' => $shout
          ];

          return $this->view('Siropu\Shoutbox:ShoutDelete', 'siropu_shoutbox_shout_delete', $viewParams);
     }
     public function actionBan()
     {
          $visitor = \XF::visitor();

          if (!$visitor->canBanSiropuShoutbox())
          {
               return $this->noPermission();
          }

          $user = $this->assertUserExists($this->filter('user_id', 'uint'));

          if ($this->isPost())
          {
               $banLength   = $this->filter('ban_length', 'str');
               $endDate     = $this->filter('end_date', 'datetime');
               $lengthValue = $this->filter('length_value', 'uint');
               $lengthUnit  = $this->filter('length_unit', 'str');

     		if ($banLength == 'perm')
     		{
     			$endDate = 0;
     		}
     		else if (!$endDate)
     		{
     			$dateTime = new \DateTime('now', new \DateTimeZone(\XF::options()->guestTimeZone));
     			$dateTime->modify("+$lengthValue $lengthUnit");

     			$endDate = $dateTime->format('U');
     		}

               $user->siropu_shoutbox_ban = $endDate;
               $user->save();

               return $this->message(\XF::phrase('siropu_shoutbox_user_x_has_banned_banned', ['username' => $user->username]));
          }

          $viewParams = [
               'user' => $user
          ];

          return $this->view('Siropu\Shoutbox:Ban', 'siropu_shoutbox_ban', $viewParams);
     }
     public function actionUnban()
     {
          $visitor = \XF::visitor();

          if (!$visitor->canBanSiropuShoutbox())
          {
               return $this->noPermission();
          }

          $user = $this->assertUserExists($this->filter('user_id', 'uint'));

          if ($this->isPost())
          {
               $user->siropu_shoutbox_ban = -1;
               $user->save();

               return $this->message(\XF::phrase('siropu_shoutbox_user_x_has_banned_unbanned', ['username' => $user->username]));
          }

          $viewParams = [
               'user' => $user
          ];

          return $this->view('Siropu\Shoutbox:Ban', 'siropu_shoutbox_unban', $viewParams);
     }
     public function actionBanned()
     {
          $visitor = \XF::visitor();

          if (!$visitor->canViewBannedSiropuShoutbox())
          {
               return $this->noPermission();
          }

          $banned = $this->finder('XF:User')
               ->where('siropu_shoutbox_ban', '>=', 0)
               ->fetch();

          $viewParams = [
               'banned' => $banned
          ];

          return $this->view('Siropu\Shoutbox:Ban', 'siropu_shoutbox_ban_list', $viewParams);
     }
     protected function assertShoutExists($id, $with = null)
	{
		return $this->assertRecordExists('Siropu\Shoutbox:Shout', $id, $with, 'siropu_shoutbox_requested_shout_not_found');
	}
     protected function assertUserExists($id = null, $with = null)
     {
          return $this->assertRecordExists('XF:User', $id, $with, 'requested_user_not_found');
     }
}
