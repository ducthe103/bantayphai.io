<?php
// FROM HASH: 78d5b020fab376545c78820a4f298f15
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<hr class="formRowSep" />
' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'mvb_verified',
		'selected' => $__vars['user']['mvb_verified'],
		'label' => '
		' . 'Verified' . '
	',
		'_type' => 'option',
	)), array(
		'label' => 'Verified',
	));
	return $__finalCompiled;
});