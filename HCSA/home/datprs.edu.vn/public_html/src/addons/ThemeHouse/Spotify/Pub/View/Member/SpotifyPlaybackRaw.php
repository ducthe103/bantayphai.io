<?php

namespace ThemeHouse\Spotify\Pub\View\Member;

class SpotifyPlaybackRaw extends \XF\Mvc\View
{
    public function renderJson()
    {
        $playback = null;
        $playbackArray = null;
        $song = null;
        $data = null;
        if (!empty($this->params['playback'])) {
            $playback = $this->params['playback'];
            $song = $playback->SpotifySong;

            $data = [
                'song' => $song->serializedForJson(),
                'playback' => $playback->serializedForJson(),
            ];
        }

        return [
            'data' => $data,
        ];
    }
}