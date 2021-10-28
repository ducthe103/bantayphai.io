<?php
// FROM HASH: f56b48c0dd62bdc83b03ed2f3c1b7217
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['items']) {
		$__finalCompiled .= '
	<ol class="brmsContentList u-clearFix">
		';
		$__vars['i'] = 0;
		if ($__templater->isTraversable($__vars['items'])) {
			foreach ($__vars['items'] AS $__vars['resource']) {
				$__vars['i']++;
				$__finalCompiled .= '
			';
				$__vars['extraData'] = $__templater->preEscaped('
				<div class="listBlock itemDetail itemDetailDate">
					<a class="paint" href="' . $__templater->fn('link', array('resources/updates', $__vars['resource'], ), true) . '" title="">' . $__templater->fn('date_dynamic', array($__vars['resource']['last_update'], array(
				))) . '</a>
				</div>
				<div class="listBlock itemDetail itemDetailName">
					' . $__templater->fn('username_link', array($__vars['resource']['User'], true, array(
					'defaultname' => $__vars['resource']['username'],
				))) . '
				</div>
			');
				$__finalCompiled .= '
			' . $__templater->callMacro('brms_tab_macros', 'resource_tab', array(
					'counter' => $__vars['i'],
					'modernStatistic' => $__vars['modernStatistic'],
					'showPrefix' => $__vars['modernStatistic']['show_resource_prefix'],
					'resource' => $__vars['resource'],
					'extraData' => $__vars['extraData'],
				), $__vars) . '
		';
			}
		}
		$__finalCompiled .= '
	</ol>
';
	}
	return $__finalCompiled;
});