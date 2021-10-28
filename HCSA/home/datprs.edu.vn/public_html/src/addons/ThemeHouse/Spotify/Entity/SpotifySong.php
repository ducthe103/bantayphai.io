<?php

namespace ThemeHouse\Spotify\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class SpotifySong extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_thspotify_song';
        $structure->shortName = 'ThemeHouse\Spotify:SpotifySong';
        $structure->primaryKey = 'song_id';
        $structure->columns = [
            'song_id' => ['type' => self::STR, 'required' => true],
            'song_name' => ['type' => self::STR, 'required' => true],
            'duration_ms' => ['type' => self::UINT, 'required' => true],
            'explicit' => ['type' => self::BOOL, 'required' => true],
            'album_name' => ['type' => self::STR, 'required' => true],
            'album_thumbnail' => ['type' => self::STR, 'required' => true],
            'artists' => ['type' => self::STR, 'required' => true],
            'spotify_url' => ['type' => self::STR, 'required' => true],
            'spotify_uri' => ['type' => self::STR, 'required' => true],
            'spotify_album_url' => ['type' => self::STR, 'required' => true],
            'spotify_album_uri' => ['type' => self::STR, 'required' => true],
            'last_play' => ['type' => self::UINT, 'default' => \XF::$time],
            'last_play_user_id' => ['type' => self::UINT, 'required' => true],
            'plays' => ['type' => self::UINT, 'default' => 1],

        ];
        $structure->getters = [];
        $structure->relations = [
            'SpotifyUserPlayback' => [
                'entity' => 'ThemeHouse\Spotify:SpotifyUserPlayback',
                'type' => self::TO_MANY,
                'conditions' => 'song_id',
            ],
        ];
        $structure->options = [];

        return $structure;
    }

    public function getDuration($ms = false)
    {
        if ($ms) {
            return $this->duration_ms;
        }

        return (int) floor($this->duration_ms / 1000);
    }

    public function serializedForJson($stringify = false)
    {
        $data = [
            'song_id' => $this->song_id,
            'song_name' => $this->song_name,
            'duration_ms' => $this->duration_ms,
            'explicit' => $this->explicit,
            'album_name' => $this->album_name,
            'album_thumbnail' => $this->album_thumbnail,
            'artists' => $this->artists,
            'spotify_url' => $this->spotify_url,
            'spotify_uri' => $this->spotify_uri,
            'spotify_album_url' => $this->spotify_album_url,
            'spotify_album_uri' => $this->spotify_album_uri
        ];

        if ($stringify) {
            return json_encode($data);
        }

        return $data;
    }
}