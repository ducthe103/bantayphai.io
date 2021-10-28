<?php
// FROM HASH: 181289a2a41864dae21aef9759551650
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->callMacro('account_privacy', 'privacy_option', array(
		'user' => $__vars['xf']['visitor'],
		'name' => 'th_spotify_allow_view_playing',
		'label' => 'View currently playing track',
	), $__vars);
	return $__finalCompiled;
});