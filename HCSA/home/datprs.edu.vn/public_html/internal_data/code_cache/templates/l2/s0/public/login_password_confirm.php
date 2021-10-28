<?php
// FROM HASH: 3f31443eda0c629ff6fcf8d43756cd02
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Xác nhận mật khẩu');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Để truy cập vào trang này , đầu tiên bạn phải xác nhận mật khẩu của bạn .' . '
			', array(
		'rowtype' => 'confirm',
	)) . '

			' . $__templater->formRow($__templater->escape($__vars['xf']['visitor']['username']), array(
		'label' => 'Tên thành viên',
	)) . '

			' . $__templater->formPasswordBoxRow(array(
		'name' => 'password',
	), array(
		'label' => 'Mật khẩu',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Xác nhận',
	), array(
	)) . '
	</div>
	' . $__templater->fn('redirect_input', array(($__vars['redirect'] ?: $__vars['xf']['uri']), null, true)) . '
', array(
		'action' => $__templater->fn('link', array('login/password-confirm', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});