<?php
// FROM HASH: f993cdf81aab081cecbda19b6f4f4047
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
					<a class="paint" href="' . $__templater->fn('link', array('resources', $__vars['resources'], ), true) . '" title="">' . 'Rating' . ': ' . $__templater->callMacro('rating_macros', 'stars_text', array(
					'rating' => $__vars['resource']['rating_avg'],
					'count' => $__vars['resource']['rating_count'],
					'rowClass' => 'ratingStarsRow--textBlock',
				), $__vars) . '</a>
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
					'showPrefix' => $__vars['modernStatistic']['show_thread_prefix'],
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