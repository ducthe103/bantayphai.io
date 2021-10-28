<?php
// FROM HASH: ad35080cddaa9bcdfe2de281cea27a09
return array('macros' => array('thread_title' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'showPrefix' => '!',
		'modernStatistic' => '!',
		'thread' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="listBlock counter counter_' . $__templater->escape($__vars['counter']) . '">
		<span class="countNumber">' . $__templater->escape($__vars['counter']) . '</span>
		<span class="arrow"><span></span></span>
	</div>
	<div class="listBlock itemTitle">
		';
	$__vars['canPreview'] = ($__templater->method($__vars['thread'], 'canPreview', array()) AND ($__vars['modernStatistic']['preview_tooltip'] == 'thread_preview'));
	$__finalCompiled .= '
		<a href="' . $__templater->fn('link', array('threads' . (($__templater->method($__vars['thread'], 'isUnread', array()) AND (!$__vars['forceRead'])) ? '/unread' : ''), $__vars['thread'], ), true) . '" class=""
			data-tp-primary="on" data-xf-init="' . ($__vars['canPreview'] ? 'preview-tooltip' : (($__vars['modernStatistic']['preview_tooltip'] == 'custom_preview') ? 'brms-tooltip' : '')) . '"
			';
	if ($__vars['modernStatistic']['preview_tooltip'] == 'custom_preview') {
		$__finalCompiled .= '
			data-kind="thread"
			data-box="' . $__templater->escape($__vars['thread']['Forum']['title']) . '"
			data-view="' . $__templater->escape($__vars['thread']['view_count']) . '"
			data-rep="' . $__templater->escape($__vars['thread']['reply_count']) . '"
			data-like="' . (($__vars['xf']['options']['currentVersionId'] < 2010000) ? $__templater->escape($__vars['thread']['first_post_likes']) : $__templater->escape($__vars['thread']['first_post_reaction_score'])) . '"
			';
	}
	$__finalCompiled .= '
			data-preview-url="' . ($__vars['canPreview'] ? $__templater->fn('link', array('threads/preview', $__vars['thread'], ), true) : '') . '">';
	if ($__vars['showPrefix']) {
		$__finalCompiled .= $__templater->fn('prefix', array('thread', $__vars['thread'], ), true) . ' ';
	}
	$__finalCompiled .= $__templater->escape($__vars['thread']['title']) . '</a>
	</div>
';
	return $__finalCompiled;
},
'username' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="listBlock counter counter_' . $__templater->escape($__vars['counter']) . '">
		<span class="countNumber">' . $__templater->escape($__vars['counter']) . '</span>
		<span class="arrow"><span></span></span>
	</div>
	<div class="listBlock itemTitle">
		' . $__templater->fn('username_link', array($__vars['user'], true, array(
	))) . '
	</div>
';
	return $__finalCompiled;
},
'thread_tab' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'thread' => '!',
		'showPrefix' => '!',
		'modernStatistic' => '!',
		'extraData' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="itemStast BRMSToolTip itemThread' . ($__vars['thread']['sticky'] ? ' brmsSticky' : '') . ($__templater->method($__vars['thread'], 'isUnread', array()) ? ' brmsNewItem' : '') . (($__vars['counter'] == 1) ? ' first' : '') . '">
		<div class="itemContent">
			' . $__templater->callMacro('brms_tab_macros', 'thread_title', array(
		'counter' => $__vars['counter'],
		'showPrefix' => $__vars['showPrefix'],
		'modernStatistic' => $__vars['modernStatistic'],
		'thread' => $__vars['thread'],
	), $__vars) . '
			' . $__templater->escape($__vars['extraData']) . '
		</div>
	</li>
';
	return $__finalCompiled;
},
'user_tab' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'user' => '!',
		'modernStatistic' => '!',
		'extraData' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="itemStast BRMSToolTip itemUser' . (($__vars['counter'] == 1) ? ' first' : '') . '">
		<div class="itemContent">
			' . $__templater->callMacro(null, 'username', array(
		'counter' => $__vars['counter'],
		'user' => $__vars['user'],
	), $__vars) . '
			' . $__templater->escape($__vars['extraData']) . '
		</div>
	</li>
';
	return $__finalCompiled;
},
'resource_tab' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'resource' => '!',
		'modernStatistic' => '!',
		'extraData' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="itemStast BRMSToolTip itemResource' . ($__vars['resource']['Featured'] ? ' brmsSticky' : '') . (($__vars['counter'] == 1) ? ' first' : '') . '">
		<div class="itemContent">
			' . $__templater->callMacro(null, 'resource_title', array(
		'counter' => $__vars['counter'],
		'showPrefix' => $__vars['modernStatistic']['show_resource_prefix'],
		'modernStatistic' => $__vars['modernStatistic'],
		'resource' => $__vars['resource'],
	), $__vars) . '
			' . $__templater->escape($__vars['extraData']) . '
		</div>
	</li>
';
	return $__finalCompiled;
},
'resource_title' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'showPrefix' => '!',
		'modernStatistic' => '!',
		'resource' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="listBlock counter counter_' . $__templater->escape($__vars['counter']) . '">
		<span class="countNumber">' . $__templater->escape($__vars['counter']) . '</span>
		<span class="arrow"><span></span></span>
	</div>
	<div class="listBlock itemTitle">
		<a href="' . $__templater->fn('link', array('resources', $__vars['resource'], ), true) . '" class="" title="' . $__templater->escape($__vars['resource']['title']) . '"
			';
	if ($__vars['modernStatistic']['preview_tooltip'] == 'custom_preview') {
		$__finalCompiled .= '
			data-xf-init="brms-tooltip"
			data-box="' . $__templater->escape($__vars['resource']['Category']['title']) . '"
			data-kind="resource"
			data-download="' . $__templater->escape($__vars['resource']['download_count']) . '"
			data-update="' . $__templater->escape($__vars['resource']['update_count']) . '"
			data-review="' . $__templater->escape($__vars['resource']['review_count']) . '"
			data-vote="' . $__templater->filter($__vars['resource']['rating_count'], array(array('number', array()),), true) . '"
			';
	}
	$__finalCompiled .= '>';
	if ($__vars['showPrefix']) {
		$__finalCompiled .= $__templater->fn('prefix', array('resource', $__vars['resource'], ), true) . ' ';
	}
	$__finalCompiled .= $__templater->escape($__vars['resource']['title']) . '</a>
	</div>
';
	return $__finalCompiled;
},
'profile_post_tab' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'profilePost' => '!',
		'modernStatistic' => '!',
		'extraData' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="itemStast BRMSToolTip itemProfilePost' . (($__vars['counter'] == 1) ? ' first' : '') . '">
		<div class="itemContent">
			' . $__templater->callMacro(null, 'profile_post', array(
		'counter' => $__vars['counter'],
		'profilePost' => $__vars['profilePost'],
	), $__vars) . '
			' . $__templater->escape($__vars['extraData']) . '
		</div>
	</li>
';
	return $__finalCompiled;
},
'profile_post' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'counter' => '!',
		'profilePost' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="listBlock itemTitle">
		';
	if ($__vars['profilePost']['user_id'] != $__vars['profilePost']['profile_user_id']) {
		$__finalCompiled .= '
			' . $__templater->fn('username_link', array($__vars['profilePost']['User'], true, array(
			'defaultname' => $__vars['profilePost']['username'],
			'aria-hidden' => 'true',
		))) . '
			<i class="fa ' . ($__vars['xf']['isRtl'] ? 'fa-caret-left' : 'fa-caret-right') . ' u-muted" aria-hidden="true"></i>
			' . $__templater->fn('username_link', array($__vars['profilePost']['ProfileUser'], true, array(
			'defaultname' => 'Unknown',
			'aria-hidden' => 'true',
		))) . '
			<span class="u-srOnly">' . '' . ($__templater->escape($__vars['profilePost']['User']['username']) ?: $__templater->escape($__vars['profilePost']['username'])) . ' wrote on ' . ($__templater->escape($__vars['profilePost']['ProfileUser']['username']) ?: 'Unknown') . '\'s profile.' . '</span>
		';
	} else {
		$__finalCompiled .= '
			' . $__templater->fn('username_link', array($__vars['profilePost']['User'], true, array(
			'defaultname' => $__vars['profilePost']['username'],
		))) . '
		';
	}
	$__finalCompiled .= '
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

' . '

' . '

' . '

';
	return $__finalCompiled;
});