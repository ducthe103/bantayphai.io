<?php

namespace ThemeHouse\Spotify\ConnectedAccount\ProviderData;

use XF\ConnectedAccount\ProviderData\AbstractProviderData;

class Spotify extends AbstractProviderData
{
    public function getDefaultEndpoint()
    {
        return 'https://api.spotify.com/v1/me';
    }

    public function getProviderKey()
    {
        return $this->requestFromEndpoint('id');
    }

    public function getUsername()
    {
        return $this->requestFromEndpoint('id');
    }

    public function getEmail()
    {
        return $this->requestFromEndpoint('email');
    }

    public function getDob()
    {
        $birthday = $this->requestFromEndpoint('birthdate');
        if ($birthday) {
            return $this->prepareBirthday($birthday, 'y-m-d');
        }
        return null;
    }

    public function getProfileLink()
    {
        return 'https://open.spotify.com/user/' . $this->getUsername();
    }

    public function getAvatarUrl()
    {
        $images = $this->requestFromEndpoint('images');

        if (!empty($images[0])) {
            return $images[0]['url'];
        }

        return false;
    }

    public function getExtraData()
    {
        $token = $this->storageState->getProviderToken();

        $extraData = parent::getExtraData();

        $extraData['token_date'] = \XF::$time;
        $extraData['refresh_token'] = $token->getRefreshToken();

        return $extraData;
    }
}