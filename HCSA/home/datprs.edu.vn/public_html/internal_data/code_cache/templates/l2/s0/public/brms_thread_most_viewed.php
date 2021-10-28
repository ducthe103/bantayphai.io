<?php
// FROM HASH: 6fd72a2c602f0c99447e073ba9612561
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['items']) {
		$__finalCompiled .= '
	<ol class="brmsContentList u-clearFix">
		';
		$__vars['i'] = 0;
		if ($__templater->isTraversable($__vars['items'])) {
			foreach ($__vars['items'] AS $__vars['thread']) {
				$__vars['i']++;
				$__finalCompiled .= '
			';
				$__vars['extraData'] = $__templater->preEscaped('
				<div class="listBlock itemDetail itemDetailDate">
					<a class="paint" href="' . $__templater->fn('link', array('threads', $__vars['thread'], ), true) . '" title="">' . 'Lượt xem' . ': ' . $__templater->filter($__vars['thread']['view_count'], array(array('number', array()),), true) . '</a>
				</div>
				<div class="listBlock itemDetail itemDetailName">
					' . $__templater->fn('username_link', array($__vars['thread']['User'], true, array(
					'defaultname' => $__vars['thread']['username'],
				))) . '
				</div>
			');
				$__finalCompiled .= '
			' . $__templater->callMacro('brms_tab_macros', 'thread_tab', array(
					'counter' => $__vars['i'],
					'modernStatistic' => $__vars['modernStatistic'],
					'showPrefix' => $__vars['modernStatistic']['show_thread_prefix'],
					'thread' => $__vars['thread'],
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