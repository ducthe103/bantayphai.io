<?php

namespace DBTech\Credits\Admin\Controller;

use XF\Admin\Controller\AbstractController;

/**
 * Class Index
 * @package DBTech\Credits\Admin\Controller
 */
class Index extends AbstractController
{
	/**
	 * @return \XF\Mvc\Reply\View
	 */
	public function actionIndex()
	{
		return $this->view('DBTech\Credits:Index', 'dbtech_credits');
	}
}