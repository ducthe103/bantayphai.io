<?php

namespace ThemeHouse\Spotify\Widget;

use XF\Widget\AbstractWidget;

class MostPlayed extends AbstractWidget
{
    protected $defaultOptions = [
		'limit' => 5
	];

    public function render()
    {
		$options = $this->options;
        $limit = $options['limit'];

        $finder = $this->getSongRepository()->getTopSongs();
        $finder->limit($limit);

        $songs = $finder->fetch();

        $viewParams = [
            'songs' => $songs,
        ];
        return $this->renderer('th_widget_most_played_spotify', $viewParams);
    }

    /**
     * @return \ThemeHouse\Spotify\Repository\SpotifySong
     */
    protected function getSongRepository()
    {
        return $this->repository('ThemeHouse\Spotify:SpotifySong');
    }
}