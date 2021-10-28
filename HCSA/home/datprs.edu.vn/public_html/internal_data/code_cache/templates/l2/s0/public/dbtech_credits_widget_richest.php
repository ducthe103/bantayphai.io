<?php
// FROM HASH: 6e1d359ff5d903ebf0742b6a75740e6b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if (!$__templater->test($__vars['currencies'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block"' . $__templater->fn('widget_data', array($__vars['widget'], ), true) . '>
		<div class="block-container">
			<h3 class="block-minorHeader">
				' . $__templater->escape($__vars['title']) . '
			</h3>
			<div class="block-body">
				';
		if ($__templater->isTraversable($__vars['currencies'])) {
			foreach ($__vars['currencies'] AS $__vars['currency']) {
				$__finalCompiled .= '
					' . $__templater->callMacro('dbtech_credits_currency_macros', 'richest', array(
					'currency' => $__vars['currency'],
					'limit' => $__vars['options']['limit'],
				), $__vars) . '
				';
			}
		}
		$__finalCompiled .= '
			</div>
		</div>
	</div>
';
	}
	return $__finalCompiled;
});