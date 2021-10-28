<?php

namespace ThemeHouse\Spotify\Repository;

use XF\Mvc\Entity\Repository;

class SpotifyUserPlayback extends Repository
{
    public function updateUserPlayback($playback, \XF\Entity\User $user = null)
    {
        if ($user === null) {
            $user = \XF::visitor();
        }

        if ($user->user_id === 0) {
            return false;
        }

        $userPlayback = $user->SpotifyUserPlayback;
        if (!$userPlayback) {
            $userPlayback = $this->em->create('ThemeHouse\Spotify:SpotifyUserPlayback');
            $userPlayback->user_id = $user->user_id;
        }
        if ($playback) {
            $userPlayback->bulkSet([
                'song_id' => $playback['song']['id'],
                'progress_ms' => $playback['progress_ms'],
                'last_update' => \XF::$time,
            ]);
        } else {
            $userPlayback->bulkSet([
                'song_id' => '',
                'progress_ms' => 0,
                'last_update' => \XF::$time,
            ]);
        }
        $userPlayback->save();

        $user->hydrateRelation('SpotifyUserPlayback', $userPlayback);

        return $userPlayback;
    }

    public function getNowPlaying()
    {
        $userPlaybackFinder = $this->finder('ThemeHouse\Spotify:SpotifyUserPlayback');
        $userPlaybackFinder->order('last_update', 'desc')
            ->with('SpotifySong')
            ->where('song_id', '!=', '');

        return $userPlaybackFinder;
    }
}