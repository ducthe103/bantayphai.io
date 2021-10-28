<?php

namespace MMO\VerifiedBadge\XF\Template;

class Templater extends XFCP_Templater
{
    public function fnUsernameLink($templater, &$escape, $user, $rich = false, $attributes = [])
    {
        $response = parent::fnUsernameLink($templater, $escape, $user, $rich, $attributes);

        if (isset($user['mvb_verified']) && $user['mvb_verified'] && is_string($response))
        {
            $response = str_ireplace($user['username'] . '</span>', $user['username'] . '<i class="fas fa-fw fa-check-circle" data-offsetx="-8" data-xf-init="tooltip" data-original-title="' . \XF::phrase('mvb_tooltip_description', ['username' => $user['username'], true]) . '" ></i></span>', $response);
            $response = str_ireplace($user['username'] . '</a>', $user['username'] . '<i class="fas fa-fw fa-check-circle" data-offsetx="-8" data-xf-init="tooltip" data-original-title="' . \XF::phrase('mvb_tooltip_description', ['username' => $user['username'], true]) . '" ></i></a>', $response);
        }

        return $response;
    }
}