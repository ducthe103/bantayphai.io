<?php

namespace ThemeHouse\Spotify\Listener;

use XF\Mvc\Entity\Entity;

class EntityStructure
{
    public static function xfUser(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->relations['SpotifyUserPlayback'] = [
            'type' => Entity::TO_ONE,
            'entity' => 'ThemeHouse\Spotify:SpotifyUserPlayback',
            'conditions' => 'user_id',
        ];
    }

    public static function xfUserPrivacy(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->columns['th_spotify_allow_view_playing'] = [
            'type' => Entity::STR,
            'default' => 'everyone',
            'allowedValues' => ['everyone', 'members', 'followed', 'none'],
            'verify' => 'verifyPrivacyChoice'
        ];
    }
}