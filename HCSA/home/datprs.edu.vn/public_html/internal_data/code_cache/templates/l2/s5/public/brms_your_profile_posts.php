<?php
// FROM HASH: 8cf9c57fcdc1610b627132b2050db85e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['items']) {
		$__finalCompiled .= '
	<ol class="brmsContentList u-clearFix">
		';
		$__vars['i'] = 0;
		if ($__templater->isTraversable($__vars['items'])) {
			foreach ($__vars['items'] AS $__vars['profilePost']) {
				$__vars['i']++;
				$__finalCompiled .= '
			';
				$__compilerTemp1 = '';
				if ($__vars['xf']['options']['currentVersionId'] < 2010000) {
					$__compilerTemp1 .= '
					<div class="listBlock itemDetail itemSubDetail">
						<strong>' . $__templater->filter($__vars['profilePost']['likes'], array(array('number', array()),), true) . '</strong> <span>' . 'Thích' . '</span>
					</div>
				';
				} else {
					$__compilerTemp1 .= '
					<div class="listBlock itemDetail itemSubDetail">
						<strong>' . $__templater->filter($__vars['profilePost']['reaction_score'], array(array('number', array()),), true) . '</strong> <span>' . 'Reaction score' . '</span>
					</div>
				';
				}
				$__vars['extraData'] = $__templater->preEscaped('
				<div class="listBlock itemDetail itemDetailMain alleft">
					<strong>' . $__templater->fn('snippet', array($__templater->fn('structured_text', array($__vars['profilePost']['message'], ), false), 80, array('stripHtml' => true, ), ), true) . '</strong>
				</div>
				' . $__compilerTemp1 . '

				<div class="listBlock itemDetail itemSubDetail">
					<strong>' . $__templater->filter($__vars['profilePost']['comment_count'], array(array('number', array()),), true) . '</strong> <span>' . 'Bình luận' . '</span>
				</div>
			');
				$__finalCompiled .= '
			' . $__templater->callMacro('brms_tab_macros', 'profile_post_tab', array(
					'counter' => $__vars['i'],
					'modernStatistic' => $__vars['modernStatistic'],
					'profilePost' => $__vars['profilePost'],
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