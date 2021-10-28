<?php
// FROM HASH: 3f738af2ff92ab956f8ea705f2a478ff
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
				$__compilerTemp1 = '';
				if ($__templater->method($__vars['thread'], 'isUnread', array())) {
					$__compilerTemp1 .= '
						<a class="paint" href="' . $__templater->fn('link', array('threads/unread', $__vars['thread'], ), true) . '" title="">' . $__templater->fn('date_dynamic', array($__vars['thread']['last_post_date'], array(
					))) . '</a>
					';
				} else {
					$__compilerTemp1 .= '
						<a class="paint" href="' . $__templater->fn('link', array('threads/post', $__vars['thread'], array('post_id' => $__vars['thread']['last_post_id'], ), ), true) . '" title="">' . $__templater->fn('date_dynamic', array($__vars['thread']['last_post_date'], array(
					))) . '</a>
					';
				}
				$__vars['extraData'] = $__templater->preEscaped('
				<div class="listBlock itemDetail itemDetailDate">
					' . $__compilerTemp1 . '
				</div>
				<div class="listBlock itemDetail itemDetailName">
					<a class="paint" href="' . $__templater->fn('link', array('threads', $__vars['thread'], ), true) . '" title="">' . 'Trả lời' . ': ' . $__templater->filter($__vars['thread']['reply_count'], array(array('number', array()),), true) . '</a>
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