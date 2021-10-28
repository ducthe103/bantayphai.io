<?php

namespace ThemeHouse\Spotify\ConnectedAccount\Provider;

use XF\ConnectedAccount\Provider\AbstractProvider;
use XF\Entity\ConnectedAccountProvider;
use XF\ConnectedAccount\Http\HttpResponseException;

class Spotify extends AbstractProvider
{
    public function getOAuthServiceName()
    {
        return 'Spotify';
    }

    public function getProviderDataClass()
    {
        return 'ThemeHouse\Spotify:ProviderData\\' . $this->getOAuthServiceName();
    }

    public function getDefaultOptions()
    {
        return [
            'client_id' => '',
            'client_secret' => ''
        ];
    }

    public function getOAuthConfig(ConnectedAccountProvider $provider, $redirectUri = null)
    {
        return [
            'key' => $provider->options['client_id'],
            'secret' => $provider->options['client_secret'],
            'scopes' => [
                'user-read-email',
                'user-read-birthdate',
                'user-read-currently-playing',
                'user-read-recently-played',
                'user-read-playback-state',
            ],
            'redirect' => $redirectUri ?: $this->getRedirectUri($provider)
        ];
    }

    public function getOAuth(array $config)
    {
        $config = array_replace([
            'storageType' => null
        ], $config);

        $provider = \XF::app()->oAuth()->provider('ThemeHouse\Spotify\ConnectedAccount\Service\Spotify', $config);
        if (!$provider)
        {
            throw new \InvalidArgumentException(
                "Cannot find a valid OAuth Service for provider '{$this->getOAuthServiceName()}'"
            );
        }
        return $provider;
    }

    public function parseProviderError(HttpResponseException $e, &$error = null)
    {
        $errorDetails = json_decode($e->getResponseContent(), true);
        if (isset($errorDetails['error_description'])) {
            $e->setMessage($errorDetails['error_description']);
        }
        parent::parseProviderError($e, $error);
    }
}