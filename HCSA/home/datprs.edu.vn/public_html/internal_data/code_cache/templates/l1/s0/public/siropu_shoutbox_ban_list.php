<?php
// FROM HASH: 72a231aaa091b169fbbf90cf9edeb496
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Banned users');
	$__finalCompiled .= '

<div clas="block">
	<div class="block-container">
		<ol class="block-body">
			';
	$__compilerTemp1 = true;
	if ($__templater->isTraversable($__vars['banned'])) {
		foreach ($__vars['banned'] AS $__vars['ban']) {
			$__compilerTemp1 = false;
			$__finalCompiled .= '
				';
			$__vars['extraData'] = $__templater->preEscaped('
					<b>' . 'Ban ends' . $__vars['xf']['language']['label_separator'] . '</b> ' . (($__vars['ban']['siropu_shoutbox_ban'] > 0) ? $__templater->fn('date_time', array($__vars['ban']['siropu_shoutbox_ban'], ), true) : 'Never') . '
					' . $__templater->button('Lift ban', array(
				'href' => $__templater->fn('link', array('shoutbox/unban', '', array('user_id' => $__vars['ban']['user_id'], ), ), false),
				'overlay' => 'true',
			), '', array(
			)) . '
				');
			$__finalCompiled .= '
				<li class="block-row block-row--separated">
					' . $__templater->callMacro('member_list_macros', 'item', array(
				'user' => $__vars['ban'],
				'extraData' => $__vars['extraData'],
			), $__vars) . '
				</li>
				';
		}
	}
	if ($__compilerTemp1) {
		$__finalCompiled .= '
				<li class="block-row">' . 'There are no banned users.' . '</li>
			';
	}
	$__finalCompiled .= '
		</ol>
	</div>
</div>';
	return $__finalCompiled;
});