<?php

namespace MMO\VerifiedBadge\XF\Admin\Controller;

class User extends XFCP_User
{
    protected function userSaveProcess(\XF\Entity\User $user)
    {
        $form = parent::userSaveProcess($user);

        $input = $this->filter([
            'mvb_verified' => 'uint',
        ]);

        $form->setup(function () use ($user, $input)
        {
            $user->bulkSet($input);
        });

        return $form;
    }
}