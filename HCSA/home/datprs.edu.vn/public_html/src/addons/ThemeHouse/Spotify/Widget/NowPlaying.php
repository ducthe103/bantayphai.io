<?php

namespace ThemeHouse\Spotify\Widget;

use XF\Widget\AbstractWidget;

class NowPlaying extends AbstractWidget
{
    protected $defaultOptions = [
        'limit' => 5
    ];

    public function render()
    {
        $options = $this->options;
        $limit = $options['limit'];

        $finder = $this->getUserPlaybackRepository()->getNowPlaying();
        $finder->limit($limit);

        $userPlaybacks = $finder->fetch();

        $viewParams = [
            'userPlaybacks' => $userPlaybacks,
        ];
        return $this->renderer('th_widget_now_playing_spotify', $viewParams);
    }

    /**
     * @return \ThemeHouse\Spotify\Repository\SpotifyUserPlayback
     */
    protected function getUserPlaybackRepository()
    {
        return $this->repository('ThemeHouse\Spotify:SpotifyUserPlayback');
    }
}
