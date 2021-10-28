<?php

namespace ThemeHouse\Spotify\XF\Entity;

use XF\Entity\UserBan;

class User extends XFCP_User
{
    public function canViewSpotifyPlayback(&$error = null)
    {
        $visitor = \XF::visitor();
        if ($visitor->user_id == $this->user_id) {
            return true;
        }

        if (!$this->isPrivacyCheckMet('th_spotify_allow_view_playing', $visitor)) {
            $error = \XF::phraseDeferred('th_spotify_member_limits_viewing_playback');
            return false;
        }

        if (
            ($this->user_state == 'moderated' || $this->user_state == 'email_confirm' || $this->user_state == 'rejected')
            && !$visitor->canBypassUserPrivacy()
        ) {
            $error = \XF::phraseDeferred('this_users_profile_is_not_available');
            return false;
        }

        if ($this->is_banned) {
            /** @var UserBan|null $ban */
            $ban = $this->Ban;
            if ($ban && !$ban->end_date && !$visitor->canBypassUserPrivacy())
            {
                $error = \XF::phraseDeferred('this_users_profile_is_not_available');
                return false;
            }
        }

        return true;
    }
}
