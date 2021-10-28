<?php

namespace MMO\VerifiedBadge\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class Verification extends AbstractController
{
    public function actionIndex(ParameterBag $params)
    {
        $finder = \XF::finder('XF:User')
            ->where('mvb_verified', '=',1);

        $total = $finder->total();
        $page = $this->filterPage();
        $perPage = $this->options()->membersPerPage;

        $this->assertValidPage($page, $perPage, $total, 'verification', $finder);

        $verification = $finder->limitByPage($page, $perPage)->fetch();

        $viewParams = [
            'verification' => $verification,

            'page' => $page,
            'perPage' => $perPage,
            'total' => $total
        ];

        return $this->view('MMO\VerifiedBadge:Verification', 'mvb_overview', $viewParams);
    }
}