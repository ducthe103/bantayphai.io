<?php
// FROM HASH: 6ac369e2fe9ee6b32f5b70e0d23292d2
return array('macros' => array('username_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'fieldName' => 'username',
		'value' => '',
		'autoFocus' => true,
	), $__arguments, $__vars);
	$__finalCompiled .= '

	' . $__templater->formTextBoxRow(array(
		'name' => $__vars['fieldName'],
		'value' => $__vars['value'],
		'autocomplete' => 'username',
		'required' => 'required',
		'autofocus' => ($__vars['autoFocus'] ? 'autofocus' : false),
		'maxlength' => ($__vars['xf']['options']['usernameLength']['max'] ?: $__templater->fn('max_length', array($__vars['xf']['visitor'], 'username', ), false)),
	), array(
		'label' => 'Tên thành viên',
		'hint' => 'Cần thiết',
		'explain' => 'Đây là tên hiển thị ở mỗi bài viết của bạn. Một khi đã đặt thì không thể đổi.',
	)) . '
';
	return $__finalCompiled;
},
'email_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'fieldName' => 'email',
		'value' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	' . $__templater->formTextBoxRow(array(
		'name' => $__vars['fieldName'],
		'value' => $__vars['value'],
		'type' => 'email',
		'autocomplete' => 'email',
		'required' => 'required',
		'maxlength' => $__templater->fn('max_length', array($__vars['xf']['visitor'], 'email', ), false),
	), array(
		'label' => 'Email',
		'hint' => 'Cần thiết',
	)) . '
';
	return $__finalCompiled;
},
'dob_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'dobData' => array(),
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['xf']['options']['registrationSetup']['requireDob']) {
		$__finalCompiled .= '
		' . $__templater->callMacro('helper_user_dob_edit', 'dob_edit', array(
			'dobData' => $__vars['dobData'],
			'required' => true,
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'location_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'fieldName' => 'location',
		'value' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	if ($__vars['xf']['options']['registrationSetup']['requireLocation']) {
		$__finalCompiled .= '
		' . $__templater->formTextBoxRow(array(
			'name' => $__vars['fieldName'],
			'value' => $__vars['value'],
			'required' => 'true',
		), array(
			'label' => 'Nơi ở',
			'hint' => 'Cần thiết',
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'email_choice_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'fieldName' => 'email_choice',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	if ($__vars['xf']['options']['registrationSetup']['requireEmailChoice']) {
		$__finalCompiled .= '
		' . $__templater->formCheckBoxRow(array(
		), array(array(
			'name' => $__vars['fieldName'],
			'selected' => $__vars['xf']['options']['registrationDefaults']['receive_admin_email'],
			'label' => 'Nhận thông báo từ diễn đàn',
			'hint' => '',
			'_type' => 'option',
		)), array(
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'custom_fields' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->callMacro('custom_fields_macros', 'custom_fields_edit', array(
		'type' => 'users',
		'group' => null,
		'set' => $__vars['xf']['visitor']['Profile']['custom_fields'],
		'additionalFilters' => array('registration', ),
	), $__vars) . '
';
	return $__finalCompiled;
},
'tos_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['xf']['tosUrl'] OR $__vars['xf']['privacyPolicyUrl']) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = array();
		if ($__vars['xf']['tosUrl'] AND $__vars['xf']['privacyPolicyUrl']) {
			$__compilerTemp1[] = array(
				'name' => 'accept',
				'required' => 'required',
				'label' => 'Khi đăng ký, bạn phải đồng ý với <a href="' . $__templater->escape($__vars['xf']['tosUrl']) . '" target="_blank">điều khoản sử dụng</a> và <a href="' . $__templater->escape($__vars['xf']['privacyPolicyUrl']) . '" target="_blank">chính sách bảo mật</a> của chúng tôi.',
				'_type' => 'option',
			);
		} else if ($__vars['xf']['tosUrl']) {
			$__compilerTemp1[] = array(
				'name' => 'accept',
				'required' => 'required',
				'label' => 'Để đăng ký, bạn phải đồng ý với <a href="' . $__templater->escape($__vars['xf']['tosUrl']) . '" target="_blank"> điều khoản và nội quy</a> của chúng tôi.',
				'_type' => 'option',
			);
		} else {
			$__compilerTemp1[] = array(
				'name' => 'accept',
				'required' => 'required',
				'label' => 'By registering, you agree to our <a href="' . $__templater->escape($__vars['xf']['privacyPolicyUrl']) . '" target="_blank">privacy policy</a>.',
				'_type' => 'option',
			);
		}
		$__finalCompiled .= $__templater->formCheckBoxRow(array(
			'standalone' => 'true',
		), $__compilerTemp1, array(
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'submit_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	if ($__vars['xf']['options']['registrationTimer']) {
		$__compilerTemp1 .= '
				<span id="js-regTimer" data-timer-complete="' . $__templater->filter('Đăng ký', array(array('for_attr', array()),), true) . '">
					' . $__vars['xf']['language']['parenthesis_open'] . 'Vui lòng đợi ' . ('<span>' . $__templater->escape($__vars['xf']['options']['registrationTimer']) . '</span>') . ' giây.' . $__vars['xf']['language']['parenthesis_close'] . '
				</span>
			';
	} else {
		$__compilerTemp1 .= '
				' . 'Đăng ký' . '
			';
	}
	$__finalCompiled .= $__templater->formSubmitRow(array(
	), array(
		'html' => '
		' . $__templater->button('
			' . $__compilerTemp1 . '
		', array(
		'type' => 'submit',
		'class' => 'button--primary',
		'id' => 'js-signUpButton',
	), '', array(
	)) . '
	',
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

' . '

' . '

' . '

' . '

' . '

';
	return $__finalCompiled;
});