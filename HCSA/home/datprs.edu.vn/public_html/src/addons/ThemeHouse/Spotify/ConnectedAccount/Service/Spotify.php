<?php

namespace ThemeHouse\Spotify\ConnectedAccount\Service;

class Spotify extends \OAuth\OAuth2\Service\Spotify
{
    const SCOPE_USER_READ_CURRENTLY_PLAYING = 'user-read-currently-playing';
    const SCOPE_USER_READ_RECENTLY_PLAYED = 'user-read-recently-played';
    const SCOPE_USER_READ_PLAYBACK_STATE = 'user-read-playback-state';
}