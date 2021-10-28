<?php
// FROM HASH: 75c9ba0a58622d79fed04d1cc4ddaceb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formInfoRow('Một email đã được gửi tới <b>' . $__templater->escape($__vars['email']) . '</b> với một mã xác minh chỉ sử dụng được một lần. Vui lòng nhập mã đó để tiếp tục.', array(
	)) . '

' . $__templater->formTextBoxRow(array(
		'name' => 'code',
		'autofocus' => 'autofocus',
		'inputmode' => 'numeric',
		'pattern' => '[0-9]*',
	), array(
		'label' => 'Mã xác nhận',
	));
	return $__finalCompiled;
});