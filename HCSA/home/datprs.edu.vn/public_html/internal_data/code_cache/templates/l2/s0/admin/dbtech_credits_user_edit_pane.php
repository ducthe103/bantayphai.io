<?php
// FROM HASH: 9e06426b6a0843ee8c18846ab958b03d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__vars['currencies'] = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('DBTech\\Credits:Currency', )), 'getCurrencies', array());
	$__finalCompiled .= '

<li role="tabpanel" id="dbtech-credits">
	<div class="block-body">
		';
	if ($__templater->isTraversable($__vars['currencies'])) {
		foreach ($__vars['currencies'] AS $__vars['currency']) {
			$__finalCompiled .= '
			' . $__templater->formTextBoxRow(array(
				'name' => 'credits[' . $__vars['currency']['currency_id'] . ']',
				'value' => $__templater->method($__vars['user'], 'getDbtechCreditsCurrency', array($__vars['currency'], )),
				'type' => 'number',
			), array(
				'label' => $__templater->escape($__vars['currency']['title']),
			)) . '
		';
		}
	}
	$__finalCompiled .= '
	</div>
</li>';
	return $__finalCompiled;
});