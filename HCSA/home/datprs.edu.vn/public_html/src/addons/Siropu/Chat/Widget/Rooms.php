<?php

namespace Siropu\Chat\Widget;

class Rooms extends \XF\Widget\AbstractWidget
{
	protected $defaultOptions = [
		'search' => 10
	];

	public function render()
	{
		$options  = $this->options;
		$userRepo = $this->app->repository('Siropu\Chat:User');

		$users = $userRepo
               ->findActiveUsers()
               ->fetch()
               ->filter(function(\XF\Entity\User $user)
               {
                    return ($user->isVisibleSiropuChat());
               });

		return $this->renderer('siropu_chat_widget_rooms', [
			'rooms'   => $this->app->repository('Siropu\Chat:Room')->findRoomsForList()->fetch(),
			'users'   => $userRepo->groupUsersByRoom($users),
			'title'   => $this->getTitle() ?: \XF::phrase('siropu_chat_widget_rooms'),
			'options' => $options
		]);
	}
	public function verifyOptions(\XF\Http\Request $request, array &$options, &$error = null)
	{
		$options = $request->filter([
			'search'  => 'uint'
		]);

		return true;
	}
}
