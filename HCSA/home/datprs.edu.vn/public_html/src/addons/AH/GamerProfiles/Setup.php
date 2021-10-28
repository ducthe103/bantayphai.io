<?php

namespace AH\GamerProfiles;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
    use StepRunnerUpgradeTrait;

    public function install(array $stepParams = [])
    {
        $this->db()->insertBulk('xf_user_field', [
            [
                'field_id' => 'ah_playstation',
                'display_group' => 'contact',
                'display_order' => 900,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_xbox',
                'display_group' => 'contact',
                'display_order' => 910,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_steam',
                'display_group' => 'contact',
                'display_order' => 920,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_origin',
                'display_group' => 'contact',
                'display_order' => 930,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_battlenet',
                'display_group' => 'contact',
                'display_order' => 940,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_epicgames',
                'display_group' => 'contact',
                'display_order' => 950,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_oculus',
                'display_group' => 'contact',
                'display_order' => 960,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_secondlife',
                'display_group' => 'contact',
                'display_order' => 970,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 1,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_discord',
                'display_group' => 'contact',
                'display_order' => 980,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 1,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_twitch',
                'display_group' => 'contact',
                'display_order' => 990,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 1,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_mixer',
                'display_group' => 'contact',
                'display_order' => 1000,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 1,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_youtube',
                'display_group' => 'contact',
                'display_order' => 1010,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 1,
                'viewable_message' => 0,
                'display_template' => ''
            ],
        ], 'field_id');

        \XF::repository('XF:UserField')->rebuildFieldCache();
    }

    // ################################ UPGRADE TO 2.1.0 ##################

    public function upgrade210Step1()
    {
        $this->db()->insertBulk('xf_user_field', [
            [
                'field_id' => 'ah_origin',
                'display_group' => 'contact',
                'display_order' => 921,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_battlenet',
                'display_group' => 'contact',
                'display_order' => 922,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
            [
                'field_id' => 'ah_epicgames',
                'display_group' => 'contact',
                'display_order' => 923,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
        ], 'field_id');

        \XF::repository('XF:UserField')->rebuildFieldCache();
    }

    // ################################ UPGRADE TO 2.1.2 ##################

    public function upgrade212Step1()
    {
        $this->db()->insertBulk('xf_user_field', [
            [
                'field_id' => 'ah_secondlife',
                'display_group' => 'contact',
                'display_order' => 924,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
        ], 'field_id');

        \XF::repository('XF:UserField')->rebuildFieldCache();
    }

    // ################################ UPGRADE TO 2.1.4 ##################

    public function upgrade214Step1()
    {
        $this->db()->insertBulk('xf_user_field', [
            [
                'field_id' => 'ah_oculus',
                'display_group' => 'contact',
                'display_order' => 923,
                'field_type' => 'textbox',
                'field_choices' => '',
                'match_type' => 'none',
                'match_params' => '',
                'max_length' => 0,
                'viewable_profile' => 0,
                'viewable_message' => 0,
                'display_template' => ''
            ],
        ], 'field_id');

        \XF::repository('XF:UserField')->rebuildFieldCache();
    }

    public function uninstall(array $stepParams = [])
    {
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_playstation');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_xbox');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_steam');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_origin');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_battlenet');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_epicgames');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_oculus');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_discord');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_twitch');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_mixer');
       $this->db()->delete('xf_user_field','field_id = ?', 'ah_youtube');
    }
}