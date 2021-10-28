<?php
// FROM HASH: 017b3d02ae8b004fee5c7cb7a18e5a16
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['shoutbox']['showTitle']) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Shoutbox');
		$__finalCompiled .= '
	';
		$__templater->pageParams['noH1'] = true;
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__vars['shoutbox']['isFullPage']) {
		$__finalCompiled .= '
	';
		$__templater->setPageParam('template', 'SIROPU_SHOUTBOX_CONTAINER');
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	$__templater->includeCss('siropu_shoutbox.less');
	$__compilerTemp1 = '';
	if ($__vars['shoutbox']['height']) {
		$__compilerTemp1 .= '
		.siropuShoutboxShouts
		{
			height: ' . $__vars['shoutbox']['height'] . 'px;
		}
	';
	}
	$__compilerTemp2 = '';
	if ($__vars['shoutbox']['collapsed']) {
		$__compilerTemp2 .= '
		.siropuShoutbox .block-body
		{
			display: none;
		}
	';
	}
	$__templater->inlineCss('
	' . $__compilerTemp1 . '
	' . $__compilerTemp2 . '
');
	$__finalCompiled .= '

';
	$__templater->includeJs(array(
		'src' => 'siropu/shoutbox/core.js',
		'min' => '1',
	));
	$__templater->inlineJs('
	jQuery.extend(XF.phrases, {
		siropu_shoutbox_loading_more_shouts: "' . $__templater->filter('Loading more shouts...', array(array('escape', array('js', )),), false) . '",
		siropu_shoutbox_shout_delete_confirm: "' . $__templater->filter('Are you sure you want to delete this shout?', array(array('escape', array('js', )),), false) . '",
		siropu_shoutbox_placeholder: "' . $__templater->filter('What\'s on your mind?', array(array('escape', array('js', )),), false) . '",
		siropu_shoutbox_please_wait: "' . $__templater->filter('Please wait...', array(array('escape', array('js', )),), false) . '",
		siropu_shoutbox_please_wait_x_seconds: "' . $__templater->filter('Please wait ' . $__vars['xf']['options']['siropuShoutboxFloodCheckLength'] . ' seconds...', array(array('escape', array('js', )),), false) . '"
	});
');
	$__finalCompiled .= '

<div class="siropuShoutbox block" data-refresh-interval="' . ($__vars['xf']['options']['siropuShoutboxRefreshInterval'] * 1000) . '" data-refresh-timeout="' . ($__vars['xf']['options']['siropuShoutboxRefreshTimeout'] * 60) . '" data-last-id="' . $__templater->escape($__vars['shoutbox']['lastId']) . '" data-load-more="' . (($__templater->method($__vars['xf']['visitor'], 'canUseSiropuShoutbox', array()) AND ($__templater->fn('count', array($__vars['shoutbox']['shouts'], ), false) == $__vars['xf']['options']['siropuShoutboxDisplayLimit'])) ? 1 : 0) . '" data-last-active="' . $__templater->escape($__vars['xf']['time']) . '" data-sound="' . ($__vars['shoutbox']['sound'] ? 'on' : 'off') . '" data-reverse="' . ($__vars['shoutbox']['reverse'] ? 'true' : 'false') . '" data-collapsed="' . ($__vars['shoutbox']['collapsed'] ? 'true' : 'false') . '" data-timeout="' . ($__templater->method($__vars['xf']['visitor'], 'canBypassFloodCheckSiropuShoutbox', array()) ? 0 : ($__vars['xf']['options']['siropuShoutboxFloodCheckLength'] * 1000)) . '" data-xf-init="siropu-shoutbox">
	<div class="block-container">
		<div class="' . ($__vars['options']['sidebarStyle'] ? 'block-minorHeader' : 'block-header') . '">
			' . $__templater->fontAwesome('fal fa-bullhorn', array(
	)) . ' ' . ($__templater->escape($__vars['title']) ?: 'Shoutbox') . '
			<span>
				';
	if ($__vars['xf']['options']['siropuShoutboxPopup'] AND (!$__vars['shoutbox']['isFullPage'])) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('shoutbox/fullpage', ), true) . '" title="' . $__templater->filter('Open in popup', array(array('for_attr', array()),), true) . '" data-xf-click="siropu-shoutbox-popup" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-external-link', array(
		)) . '</a>
				';
	}
	$__finalCompiled .= '
				';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewSiropuShoutboxArchive', array())) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('shoutbox/archive', ), true) . '" title="' . $__templater->filter('Archive', array(array('for_attr', array()),), true) . '" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-archive', array(
		)) . '</a>
				';
	}
	$__finalCompiled .= '
				';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewBannedSiropuShoutbox', array())) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('shoutbox/banned', ), true) . '" title="' . $__templater->filter('Banned users', array(array('for_attr', array()),), true) . '" data-xf-click="overlay" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-user-times', array(
		)) . '</a>
				';
	}
	$__finalCompiled .= '
				';
	if ($__vars['xf']['options']['siropuShoutboxSound']) {
		$__finalCompiled .= '
					<a role="button" title="' . $__templater->filter('Toggle sound', array(array('for_attr', array()),), true) . '" data-xf-click="siropu-shoutbox-toggle-sound" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-volume-' . ($__vars['shoutbox']['sound'] ? 'up' : 'off'), array(
		)) . '</a>
				';
	}
	$__finalCompiled .= '
				<a role="button" title="' . $__templater->filter('Toggle direction', array(array('for_attr', array()),), true) . '" data-xf-click="siropu-shoutbox-toggle-direction" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-arrow-' . ($__vars['shoutbox']['reverse'] ? 'up' : 'down'), array(
	)) . '</a>
				<a role="button" title="' . $__templater->filter('Toggle visibility', array(array('for_attr', array()),), true) . '" data-xf-click="siropu-shoutbox-toggle-visibility" data-xf-init="tooltip">' . $__templater->fontAwesome('fal fa-' . ($__vars['shoutbox']['collapsed'] ? 'plus' : 'minus'), array(
	)) . '</a>
			</span>
		</div>
		<div class="block-body">
			';
	if ($__vars['xf']['options']['siropuShoutboxHeader']) {
		$__finalCompiled .= '
				<div class="siropuShoutboxHeader">
					' . $__templater->filter($__vars['xf']['options']['siropuShoutboxHeader'], array(array('raw', array()),), true) . '
				</div>
			';
	}
	$__finalCompiled .= '
			';
	if ($__vars['shoutbox']['reverse'] == false) {
		$__finalCompiled .= '
				' . $__templater->callMacro('siropu_shoutbox_form', 'submit', array(), $__vars) . '
			';
	}
	$__finalCompiled .= '
			<ol class="siropuShoutboxShouts" data-autoscroll="1">
				';
	if (!$__templater->test($__vars['shoutbox']['shouts'], 'empty', array())) {
		$__finalCompiled .= '
					' . $__templater->includeTemplate('siropu_shoutbox_shout_list', $__vars) . '
				';
	} else {
		$__finalCompiled .= '
					<li>' . 'No shouts have been posted yet.' . '</li>
				';
	}
	$__finalCompiled .= '
			</ol>
			';
	if ($__vars['shoutbox']['reverse'] == true) {
		$__finalCompiled .= '
				' . $__templater->callMacro('siropu_shoutbox_form', 'submit', array(
			'class' => 'siropuShoutboxReverse',
		), $__vars) . '
			';
	}
	$__finalCompiled .= '
			';
	if ($__vars['xf']['options']['siropuShoutboxFooter']) {
		$__finalCompiled .= '
				<div class="siropuShoutboxFooter">
					' . $__templater->filter($__vars['xf']['options']['siropuShoutboxFooter'], array(array('raw', array()),), true) . '
				</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>';
	return $__finalCompiled;
});