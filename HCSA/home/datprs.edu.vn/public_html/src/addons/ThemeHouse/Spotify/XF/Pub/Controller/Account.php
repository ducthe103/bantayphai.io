<?php

namespace ThemeHouse\Spotify\XF\Pub\Controller;

class Account extends XFCP_Account
{
    protected function savePrivacyProcess(\XF\Entity\User $visitor)
    {
        $input = $this->filter([
            'privacy' => [
                'th_spotify_allow_view_playing' => 'str',
            ],
        ]);
        $form = parent::savePrivacyProcess($visitor);

        $userPrivacy = $visitor->getRelationOrDefault('Privacy');
        $form->setupEntityInput($userPrivacy, $input['privacy']);

        return $form;
    }
}
