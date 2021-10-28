<?php

namespace ThemeHouse\Spotify\Repository;

use XF\Db\DuplicateKeyException;
use XF\Mvc\Entity\Repository;
use XF\PrintableException;

class SpotifySong extends Repository
{
    /**
     * @param array $song
     * @param \XF\Entity\User|null $user
     * @return bool|null|\XF\Mvc\Entity\Entity
     * @throws \XF\PrintableException
     */
    public function insertOrUpdateSongFromSpotifyAPI(array $song, \XF\Entity\User $user = null)
    {
        if ($user === null) {
            $user = \XF::visitor();
        }

        if (!$user->user_id || empty($song['id'])) {
            return false;
        }

        $existingSong = $this->em->find('ThemeHouse\Spotify:SpotifySong', $song['id']);
        if ($existingSong && $existingSong->last_play > \XF::$time - 3600) {
            return $existingSong;
        }

        if ($existingSong) {
            $songEntity = $existingSong;
        } else {
            $songEntity = $this->em->create('ThemeHouse\Spotify:SpotifySong');
        }

        $songEntity->bulkSet([
            'song_id' => $song['id'],
            'song_name' => $song['name'],
            'duration_ms' => $song['duration_ms'],
            'explicit' => $song['explicit'],
            'album_name' => $song['album']['name'],
            'album_thumbnail' => isset($song['album']['images'][0]['url']) ? $song['album']['images'][0]['url'] : '',
            'artists' => $this->prepareArtistsString($song['artists']),
            'spotify_url' => $song['url'],
            'spotify_uri' => $song['uri'],
            'spotify_album_url' => $song['album']['url'],
            'spotify_album_uri' => $song['album']['uri'],
            'last_play' => \XF::$time,
            'last_play_user_id' => \XF::visitor()->user_id
        ]);

        try {
            $songEntity->save(false);
        } catch (DuplicateKeyException $e) {

        }

        return $songEntity;
    }

    public function prepareArtistsString(array $artists)
    {
        $artistsStr = $artists[0]['name'];
        if (count($artists) > 1) {
            $artistsStr .= ' feat.';
            $artistsArr = [];
            foreach ($artists as $key=>$artist) {
                if ($key === 0) continue;
                $artistsArr[] = $artist['name'];
            }

            $artistsStr .= ' ' . implode(', ', $artistsArr);
        }

        return $artistsStr;
    }

    public function logPlay($songId)
    {
        $song = $this->em->find('ThemeHouse\Spotify:SpotifySong', $songId);
        $song->plays = $song->plays + 1;
        $song->save();
    }

    public function getTopSongs()
    {
        $songFinder = $this->finder('ThemeHouse\Spotify:SpotifySong');
        $songFinder->order('plays', 'desc');

        return $songFinder;
    }
}