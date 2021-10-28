<?php

namespace ThemeHouse\Spotify\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class Spotify extends AbstractController
{
    public function actionIndex()
    {
        return $this->rerouteController(__CLASS__, 'most-played');
    }

    public function actionMostPlayed()
    {
        $finder = $this->getSongRepository()->getTopSongs();
        $finder->limit(20);

        $songs = $finder->fetch();

        $viewParams = [
            'songs' => $songs,
        ];

        return $this->view('ThemeHouse\Spotify:Spotify\MostPlayed', 'th_most_played_spotify', $viewParams);
    }

    public function actionUpdateCurrentPlayback()
    {
        $this->setResponseType('json');

        if (!\XF::visitor()->user_id) {
            $viewParams = [
                'playback' => false,
            ];

            return $this->view('ThemeHouse\Spotify:Spotify\UpdateCurrentPlayback', 'th_updateCurrentPlayback_spotify', $viewParams);
        }
        /** @var \ThemeHouse\Spotify\Service\Player\UpdatePlayback $service */
        $service = $this->service('ThemeHouse\Spotify:Player\UpdatePlayback');
        $return = $service->updateCurrentPlayback();

        $playback = \XF::visitor()->SpotifyUserPlayback;

        $viewParams = [
            'playback' => $playback,
        ];
        return $this->view('ThemeHouse\Spotify:Spotify\UpdateCurrentPlayback', 'th_updateCurrentPlayback_spotify', $viewParams);
    }

    /**
     * @return \ThemeHouse\Spotify\Repository\SpotifySong
     */
    protected function getSongRepository()
    {
        return $this->repository('ThemeHouse\Spotify:SpotifySong');
    }
}