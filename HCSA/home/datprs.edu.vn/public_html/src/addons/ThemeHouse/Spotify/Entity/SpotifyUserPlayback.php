<?php

namespace ThemeHouse\Spotify\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class SpotifyUserPlayback extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_thspotify_user_playback';
        $structure->shortName = 'ThemeHouse\Spotify:SpotifyUserPlayback';
        $structure->primaryKey = 'user_id';
        $structure->columns = [
            'user_id' => ['type' => self::UINT, 'required' => true],
            'song_id' => ['type' => self::STR, 'default' => ''],
            'progress_ms' => ['type' => self::UINT, 'required' => true],
            'last_update' => ['type' => self::UINT, 'default' => \XF::$time],

        ];
        $structure->getters = [];
        $structure->relations = [
            'User' => [
                'entity' => 'XF:User',
                'type' => self::TO_ONE,
                'conditions' => 'user_id',
                'primary' => true,
            ],
            'SpotifySong' => [
                'entity' => 'ThemeHouse\Spotify:SpotifySong',
                'type' => self::TO_ONE,
                'conditions' => 'song_id',
                'primary' => true,
            ],
        ];
        $structure->options = [];

        return $structure;
    }

    public function isPlaying()
    {
        if ($this->last_update < \XF::$time - 60 || empty($this->song_id) || \XF::$time > $this->getEstimatedEndTime()) {
            return false;
        }

        return true;
    }

    public function canView(&$error = null)
    {
//        return $this->
    }

    protected function _postSave()
    {
        if ($this->isInsert() || $this->isChanged('song_id')) {
            $previousSongId = $this->getPreviousValue('song_id');
            $songId = $this->get('song_id');
            if ($songId) {
                $this->repository('ThemeHouse\Spotify:SpotifySong')->logPlay($songId);
            }
        }
    }

    public function getProgressPercent($decimal=0)
    {
        if (!$this->isPlaying()) {
            return 0;
        }

        $progress = $this->getEstimatedCurrentProgress(true);
        $songDuration = $this->SpotifySong->duration_ms;

        if ($progress === 0 || $songDuration === 0) {
            return 0;
        }

        $val = ($progress / $songDuration) * 100;

        return round($val, $decimal);
    }

    public function getCurrentProgress()
    {
        $progressSeconds = $this->getEstimatedCurrentProgress();
        $durationSeconds = (int) floor($this->SpotifySong->duration_ms / 1000);

        $progressMinutes = (int) floor($progressSeconds / 60);
        $progressSeconds = $progressSeconds - ($progressMinutes * 60);

        $durationMinutes = (int) floor($durationSeconds / 60);
        $durationSeconds = $durationSeconds - ($durationMinutes * 60);

        return [
            'progress' => [
                'm' => (string) $progressMinutes,
                's' => str_pad($progressSeconds, 2, '0', STR_PAD_LEFT),
                'f' => $this->getEstimatedCurrentProgress(),
            ],
            'duration' => [
                'm' => (string) $durationMinutes,
                's' => str_pad($durationSeconds, 2, '0', STR_PAD_LEFT),
                'f' => floor($this->SpotifySong->duration_ms / 1000),
            ],
            'progress_ms' => $this->getEstimatedCurrentProgress(true),
        ];
    }

    public function getCurrentProgressStr()
    {
        $progress = $this->getCurrentProgress();

        return $progress['progress']['m'] . ':' . str_pad($progress['progress']['s'], 2, '0', STR_PAD_LEFT) . ' / ' . $progress['duration']['m'] . ':' . str_pad($progress['duration']['s'], 2, '0', STR_PAD_LEFT);
    }

    public function getEstimatedEndTime($ms = false)
    {
        $lastUpdateMs = $this->last_update * 1000;
        $startTimeMs = $lastUpdateMs - $this->progress_ms;
        $endTimeMs = $startTimeMs + $this->SpotifySong->duration_ms;
        $seconds = (int) ceil($endTimeMs / 1000);

        if ($ms) {
            return $endTimeMs;
        }

        return $seconds;
    }

    public function getEstimatedCurrentProgress($ms = false)
    {
        $nowMs = \XF::$time * 1000;
        $lastUpdateMs = $this->last_update * 1000;
        $diff = $nowMs - $lastUpdateMs;
        if ($diff < 0) {
            $diff = 0;
        }

        $estimatedProgressMs = $this->progress_ms + $diff;
        $seconds = (int) ceil($estimatedProgressMs / 1000);

        if ($ms) {
            return $estimatedProgressMs;
        }

        return $seconds;
    }

    public function serializedForJson($stringify = false)
    {
        $data = $this->getCurrentProgress();

        if ($stringify) {
            return json_encode($data);
        }

        return $data;
    }
}
