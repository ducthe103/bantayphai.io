<?php

namespace ThemeHouse\Spotify\Pub\View\Spotify;

class UpdateCurrentPlayback extends \XF\Mvc\View
{
    public function renderJson()
    {
        $playback = null;
        $playbackArray = null;
        $song = null;
        if (!empty($this->params['playback'])) {
            $playback = $this->params['playback'];
            $song = $playback->SpotifySong;
            $playbackArray = $playback->toArray();
        }

        return [
            'playback' => $playbackArray,
            'song' => $song ? $song->serializedForJson() : false,
        ];
    }
}