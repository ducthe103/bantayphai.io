<?php

namespace ThemeHouse\Spotify\Util\Spotify;

class Player extends AbstractSpotify
{
    public function getCurrentPlayback()
    {
        $response = $this->request('me/player');
        if (empty($response) || !array_key_exists('is_playing', $response) || !$response['is_playing'] || empty($response['item'])) {
            return false;
        }

        $nowPlaying = $this->prepareSong($response['item']);

        return [
            'progress_ms' => $response['progress_ms'],
            'song' => $nowPlaying,
        ];
    }
}