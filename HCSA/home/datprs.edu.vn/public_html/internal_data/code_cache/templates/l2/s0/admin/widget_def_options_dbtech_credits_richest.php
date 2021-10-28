<?php
// FROM HASH: 92b7e607881c716114d9bc98727b781f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<hr class="formRowSep" />

' . $__templater->formTextBoxRow(array(
		'name' => 'options[limit]',
		'value' => $__vars['options']['limit'],
		'min' => '0',
		'type' => 'number',
	), array(
		'label' => 'Users limit',
		'explain' => 'Controls the number of users that can be shown in this widget.',
	)) . '

';
	$__compilerTemp1 = array(array(
		'value' => '',
		'label' => 'All currencies',
		'_type' => 'option',
	));
	$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__vars['currencies']);
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'options[currencyIds][]',
		'value' => ($__vars['options']['currencyIds'] ?: ''),
		'multiple' => 'multiple',
		'size' => '7',
	), $__compilerTemp1, array(
		'label' => 'Currency limit',
		'explain' => 'Only the currencies selected here will be included.',
	));
	return $__finalCompiled;
});