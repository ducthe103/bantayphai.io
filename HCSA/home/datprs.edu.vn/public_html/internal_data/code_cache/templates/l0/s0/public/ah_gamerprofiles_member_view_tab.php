<?php
// FROM HASH: d6c12c0cbf76c9420fa588357c49ae52
return array('macros' => array('tab' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewGamerCards', array())) {
		$__finalCompiled .= '
	';
		if (($__vars['user']['Profile']['custom_fields']['ah_playstation'] OR $__vars['user']['Profile']['custom_fields']['ah_xbox']) OR $__vars['user']['Profile']['custom_fields']['ah_steam']) {
			$__finalCompiled .= '
		<a href="' . $__templater->fn('link', array('members/gamerprofiles', $__vars['user'], ), true) . '"
		   class="tabs-tab"
		   id="ah_gamerprofiles"
		   role="tab">' . 'Gamer cards' . '</a>
	';
		}
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewGamerCards', array())) {
		$__finalCompiled .= '
';
		if (($__vars['user']['Profile']['custom_fields']['ah_playstation'] OR $__vars['user']['Profile']['custom_fields']['ah_xbox']) OR $__vars['user']['Profile']['custom_fields']['ah_steam']) {
			$__finalCompiled .= '
	<li data-href="' . $__templater->fn('link', array('members/gamerprofiles', $__vars['user'], ), true) . '" role="tabpanel" aria-labelledby="ah_gamerprofiles">
		<div class="blockMessage">' . 'Loading' . $__vars['xf']['language']['ellipsis'] . '</div>
	</li>
';
		}
		$__finalCompiled .= '
';
	}
	return $__finalCompiled;
});