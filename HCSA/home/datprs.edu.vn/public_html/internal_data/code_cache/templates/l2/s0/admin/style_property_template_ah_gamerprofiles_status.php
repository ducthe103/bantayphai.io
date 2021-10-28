<?php
// FROM HASH: 2ff1fb019124403b7c44d8c9501587c2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => $__vars['formBaseKey'] . '[ah_playstation]',
		'selected' => $__vars['property']['property_value']['ah_playstation'],
		'label' => '
		' . 'PlayStation' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_xbox]',
		'selected' => $__vars['property']['property_value']['ah_xbox'],
		'label' => '
		' . 'Xbox' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_steam]',
		'selected' => $__vars['property']['property_value']['ah_steam'],
		'label' => '
		' . 'Steam' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_origin]',
		'selected' => $__vars['property']['property_value']['ah_origin'],
		'label' => '
		' . 'Origin' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_battlenet]',
		'selected' => $__vars['property']['property_value']['ah_battlenet'],
		'label' => '
		' . 'Battle.net' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_epicgames]',
		'selected' => $__vars['property']['property_value']['ah_epicgames'],
		'label' => '
		' . 'Epic Games' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_oculus]',
		'selected' => $__vars['property']['property_value']['ah_oculus'],
		'label' => '
		' . 'Oculus' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_secondlife]',
		'selected' => $__vars['property']['property_value']['ah_secondlife'],
		'label' => '
		' . 'Second Life' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_discord]',
		'selected' => $__vars['property']['property_value']['ah_discord'],
		'label' => '
		' . 'Discord' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_twitch]',
		'selected' => $__vars['property']['property_value']['ah_twitch'],
		'label' => '
		' . 'Twitch' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_mixer]',
		'selected' => $__vars['property']['property_value']['ah_mixer'],
		'label' => '
		' . 'Mixer' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[ah_youtube]',
		'selected' => $__vars['property']['property_value']['ah_youtube'],
		'label' => '
		' . 'YouTube' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[facebook]',
		'selected' => $__vars['property']['property_value']['facebook'],
		'label' => '
		' . 'Facebook' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[twitter]',
		'selected' => $__vars['property']['property_value']['twitter'],
		'label' => '
		' . 'Twitter' . '
	',
		'_type' => 'option',
	),
	array(
		'name' => $__vars['formBaseKey'] . '[skype]',
		'selected' => $__vars['property']['property_value']['skype'],
		'label' => '
		' . 'Skype' . '
	',
		'_type' => 'option',
	)), array(
		'rowclass' => $__vars['rowClass'],
		'label' => $__templater->escape($__vars['titleHtml']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['property']['description']),
	));
	return $__finalCompiled;
});