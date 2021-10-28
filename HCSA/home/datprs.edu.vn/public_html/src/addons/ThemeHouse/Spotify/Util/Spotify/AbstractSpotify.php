<?php

namespace ThemeHouse\Spotify\Util\Spotify;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use ThemeHouse\Core\Http\HttpClient;

abstract class AbstractSpotify
{
    protected $baseUri = 'https://api.spotify.com/v1/';

    /** @var \XF\App */
    protected $app;
    /** @var \XF\Entity\User */
    protected $user;

    function __construct(\XF\App $app, \XF\Entity\User $user = null)
    {
        $this->app = $app;

        if ($user === null) {
            $user = \XF::visitor();
        }

        $this->user = $user;
    }

    public function prepareSongs(array $songs)
    {
        foreach ($songs as &$song) {
            $song = $this->prepareSong($song);
        }

        return $songs;
    }

    public function prepareSong(array $song)
    {
        $songUrl = false;
        if (!empty($song['external_urls']['spotify'])) {
            $songUrl = $song['external_urls']['spotify'];
        }

        return [
            'id' => $song['id'],
            'name' => $song['name'],
            'duration' => $this->prepareSongDuration($song['duration_ms']),
            'duration_ms' => $song['duration_ms'],
            'explicit' => $song['explicit'],
            'album' => $this->prepareAlbum($song['album']),
            'artists' => $this->prepareArtists($song['artists']),
            'url' => $songUrl,
            'uri' => $song['uri'],
        ];
    }

    public function prepareSongDuration($duration)
    {
        return false;
    }

    public function prepareAlbum(array $album)
    {
        $albumUrl = false;
        if (!empty($album['external_urls']['spotify'])) {
            $albumUrl = $album['external_urls']['spotify'];
        }

        return [
            'name' => $album['name'],
            'artists' => $this->prepareArtists($album['artists']),
            'url' => $albumUrl,
            'uri' => $album['uri'],
            'images' => $album['images'],
        ];
    }

    public function prepareArtists(array $artists)
    {
        foreach ($artists as &$artist) {
            $artist = $this->prepareArtist($artist);
        }

        return $artists;
    }

    public function prepareArtist(array $artist)
    {
        $artistUrl = false;
        if (!empty($artist['external_urls']['spotify'])) {
            $artistUrl = $artist['external_urls']['spotify'];
        }

        return [
            'id' => $artist['id'],
            'name' => $artist['name'],
            'url' => $artistUrl,
            'uri' => $artist['uri'],
        ];
    }

    protected function request($endpoint)
    {
        $token = $this->getAuthorizationToken();
        if (!$token) {
            return false;
        }

        $client = new HttpClient([
            'http_errors' => false,
            'defaults' => [
                'exceptions' => false,
            ],
        ]);

        try {
            $response = $client->simpleGet($this->baseUri . $endpoint, [
                'headers' => [
                    'Authorization' => $token,
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json',
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return false;
        } catch (RequestException $e) {
            return false;
        }
    }

    protected function getAuthorizationToken($bearer = true)
    {
        if (!$bearer) {
            /** @var \XF\Entity\ConnectedAccountProvider $provider */
            $provider = $this->app->em()->find('XF:ConnectedAccountProvider', 'thspotify');
            if (!$provider) return false;
            $options = $provider->options;

            return 'Basic ' . base64_encode($options['client_id'] . ':' . $options['client_secret']);
        }
        if (!$this->user->user_id || empty($this->user->ConnectedAccounts['thspotify'])
            || empty($this->user->ConnectedAccounts['thspotify']->extra_data['token'])) {
            return false;
        }

        $extraData = $this->user->ConnectedAccounts['thspotify']->extra_data;

        $token = $extraData['token'];
        if ($extraData['token_date'] <= \XF::$time - 3600) {
            $token = $this->refreshAuthorizationToken();
        }

        return 'Bearer ' . $token;
    }

    protected function refreshAuthorizationToken()
    {
        $client = new HttpClient([
            'http_errors' => false,
            'defaults' => [
                'exceptions' => false,
            ],
        ]);

        $extraData = $this->user->ConnectedAccounts['thspotify']->extra_data;

        $response = $client->simplePost('https://accounts.spotify.com/api/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $extraData['refresh_token'],
        ], [
            'headers' => [
                'Authorization' => $this->getAuthorizationToken(false),
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody()->getContents(), true);
            $extraData['token'] = $data['access_token'];
            $extraData['token_date'] = \XF::$time;

            $this->user->ConnectedAccounts['thspotify']->extra_data = $extraData;
            $this->user->ConnectedAccounts['thspotify']->save();

            return $extraData['token'];
        } else {
            return false;
        }
    }
}