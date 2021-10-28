<?php

namespace ThemeHouse\Spotify\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

class Member extends XFCP_Member
{
    public function actionSpotifyPlayback(ParameterBag $params)
    {
        /** @var \ThemeHouse\Spotify\XF\Entity\User $user */
        $user = $this->assertViewableUser($params['user_id']);
        if (!$user->canViewSpotifyPlayback($error)) {
            return $this->noPermission($error);
        }

        $view = 'ThemeHouse\Spotify:Member\SpotifyPlayback';
        if ($this->filter('raw', 'bool')) {
            $view = 'ThemeHouse\Spotify:Member\SpotifyPlaybackRaw';
        }

        if (!$user->SpotifyUserPlayback || !$user->SpotifyUserPlayback->isPlaying()) {
            if ($this->filter('raw', 'bool')) {
                return $this->view($view, 'thspotify_member_spotify_playback', []);
            }
            return $this->error(\XF::phrase('thspotify_name_is_not_currently_listening_to_spotify', [
                'name' => $user['username'],
            ]));
        }

        $playback = $user->SpotifyUserPlayback;
        $song = $user->SpotifyUserPlayback->SpotifySong;

        $viewParams = [
            'user' => $user,
            'playback' => $playback,
            'song' => $song,
            'songJson' => $song->serializedForJson(true),
            'playbackJson' => $playback->serializedForJson(true),
        ];
        return $this->view($view, 'thspotify_member_spotify_playback', $viewParams);
    }
}