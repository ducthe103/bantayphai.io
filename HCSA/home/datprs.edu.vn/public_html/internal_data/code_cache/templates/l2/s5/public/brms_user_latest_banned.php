<?php
// FROM HASH: 4a5809b8ed4b5f00d9e611306942af78
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['items']) {
		$__finalCompiled .= '
	<ol class="brmsContentList u-clearFix">
		';
		$__vars['i'] = 0;
		if ($__templater->isTraversable($__vars['items'])) {
			foreach ($__vars['items'] AS $__vars['user']) {
				$__vars['i']++;
				$__finalCompiled .= '
			';
				$__compilerTemp1 = '';
				if ($__vars['xf']['options']['currentVersionId'] < 2010000) {
					$__compilerTemp1 .= '
					<div class="listBlock itemDetail itemSubDetail">
						<strong>' . $__templater->filter($__vars['user']['like_count'], array(array('number', array()),), true) . '</strong> <span>' . 'Thích' . '</span>
					</div>
				';
				} else {
					$__compilerTemp1 .= '
					<div class="listBlock itemDetail itemSubDetail">
						<strong>' . $__templater->filter($__vars['user']['reaction_score'], array(array('number', array()),), true) . '</strong> <span>' . 'Reaction score' . '</span>
					</div>
				';
				}
				$__vars['extraData'] = $__templater->preEscaped('
				<div class="listBlock itemDetail itemSubDetail">
					<strong>' . $__templater->filter($__vars['user']['message_count'], array(array('number', array()),), true) . '</strong> <span>' . 'Bài viết' . '</span>
				</div>
				' . $__compilerTemp1 . '

				<div class="listBlock itemDetail itemDetailMain">
					<span>' . 'Bắn đầu cấm' . '</span> <strong>' . $__templater->fn('date_dynamic', array($__vars['user']['Ban']['ban_date'], array(
				))) . '</strong>
				</div>
			');
				$__finalCompiled .= '
			' . $__templater->callMacro('brms_tab_macros', 'user_tab', array(
					'counter' => $__vars['i'],
					'user' => $__vars['user'],
					'modernStatistic' => $__vars['modernStatistic'],
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