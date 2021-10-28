<?php

namespace ThemeHouse\Spotify\Service\Player;

use ThemeHouse\Spotify\Util\Spotify\Player;
use XF\Service\AbstractService;

class UpdatePlayback extends AbstractService
{
    /** @var \XF\Entity\User */
    protected $user;

    public function __construct(\XF\App $app, \XF\Entity\User $user = null)
    {
        parent::__construct($app);

        if ($user === null) {
            $user = \XF::visitor();
        }

        $this->user = $user;
    }

    public function updateCurrentPlayback()
    {
        if (!$this->user->user_id) {
            return false;
        }

        $userPlayback = $this->user->SpotifyUserPlayback;
        $playbackTTL = 3;
        if ($userPlayback && $userPlayback->last_update > \XF::$time - $playbackTTL) {
            return $userPlayback;
        }
        $player = new Player($this->app, $this->user);
        $playback = $player->getCurrentPlayback();

        if ($playback) {
            $this->getSpotifySongRepository()->insertOrUpdateSongFromSpotifyAPI($playback['song'], $this->user);
        }
        $this->getSpotifyUserPlaybackRepository()->updateUserPlayback($playback, $this->user);

        return $this->user->SpotifyUserPlayback;
    }

    /**
     * @return \ThemeHouse\Spotify\Repository\SpotifySong
     */
    protected function getSpotifySongRepository()
    {
        return $this->repository('ThemeHouse\Spotify:SpotifySong');
    }

    /**
     * @return \ThemeHouse\Spotify\Repository\SpotifyUserPlayback
     */
    protected function getSpotifyUserPlaybackRepository()
    {
        return $this->repository('ThemeHouse\Spotify:SpotifyUserPlayback');
    }
}