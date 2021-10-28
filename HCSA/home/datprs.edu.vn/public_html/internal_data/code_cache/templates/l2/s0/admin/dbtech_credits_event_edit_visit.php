<?php
// FROM HASH: b7f8d4a49ed61566872b403a4bff486e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'settings[apply_guest]',
		'value' => '1',
		'selected' => $__vars['event']['settings']['apply_guest'],
		'label' => 'Include guest event triggers',
		'_type' => 'option',
	)), array(
	));
	return $__finalCompiled;
});