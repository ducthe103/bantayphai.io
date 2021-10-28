<?php
// FROM HASH: af332c85572ff28f3f2a8e2a17734957
return array('macros' => array('usable_checkboxes' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'label' => 'Không thể sử dụng bởi nhóm thành viên',
		'explain' => '',
		'id' => 'usable_user_group',
		'userGroups' => '',
		'selectedUserGroups' => '!',
		'withRow' => '1',
	), $__arguments, $__vars);
	$__finalCompiled .= '


	';
	if (!$__vars['userGroups']) {
		$__finalCompiled .= '
		';
		$__vars['userGroupRepo'] = $__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:UserGroup', ));
		$__finalCompiled .= '
		';
		$__vars['userGroups'] = $__templater->method($__vars['userGroupRepo'], 'getUserGroupTitlePairs', array());
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
	';
	$__vars['allUserGroups'] = (($__templater->fn('array_keys', array($__vars['userGroups'], ), false) == $__vars['selectedUserGroups']) OR $__templater->fn('in_array', array('-1', $__vars['selectedUserGroups'], ), false));
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['userGroups'])) {
		foreach ($__vars['userGroups'] AS $__vars['userGroupId'] => $__vars['userGroupTitle']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['userGroupId'],
				'selected' => ($__templater->fn('in_array', array($__vars['userGroupId'], $__vars['selectedUserGroups'], ), false) OR $__vars['allUserGroups']),
				'label' => '
								' . $__templater->escape($__vars['userGroupTitle']) . '
							',
				'_type' => 'option',
			);
		}
	}
	$__vars['inner'] = $__templater->preEscaped('
		' . $__templater->formRadio(array(
		'name' => $__vars['id'],
		'id' => $__vars['id'],
	), array(array(
		'value' => 'all',
		'selected' => $__vars['allUserGroups'],
		'label' => 'Tất cả Nhóm thành viên',
		'_type' => 'option',
	),
	array(
		'value' => 'sel',
		'selected' => !$__vars['allUserGroups'],
		'label' => 'Selected User Groups' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array('
					' . $__templater->formCheckBox(array(
		'name' => ($__vars['id'] . '_ids'),
		'listclass' => 'listColumns',
	), $__compilerTemp1) . '

					' . $__templater->formCheckBox(array(
	), array(array(
		'data-xf-init' => 'check-all',
		'data-container' => ('#' . $__vars['id']),
		'label' => 'Chọn tất cả',
		'_type' => 'option',
	))) . '
				'),
		'_type' => 'option',
	))) . '
	');
	$__finalCompiled .= '

	';
	if ($__vars['withRow']) {
		$__finalCompiled .= '
		' . $__templater->formRow('
			' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
		', array(
			'label' => $__templater->escape($__vars['label']),
			'explain' => $__templater->escape($__vars['explain']),
			'name' => $__vars['id'],
			'id' => $__vars['id'],
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'additional_checkboxes' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'label' => 'Nhóm thành viên bổ sung',
		'explain' => '',
		'id' => 'extra_group_ids',
		'userGroups' => '',
		'selectedUserGroups' => '!',
		'withRow' => '1',
	), $__arguments, $__vars);
	$__finalCompiled .= '

	';
	if (!$__vars['userGroups']) {
		$__finalCompiled .= '
		';
		$__vars['userGroupRepo'] = $__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:UserGroup', ));
		$__finalCompiled .= '
		';
		$__vars['userGroups'] = $__templater->method($__vars['userGroupRepo'], 'getUserGroupTitlePairs', array());
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['userGroups'])) {
		foreach ($__vars['userGroups'] AS $__vars['userGroupId'] => $__vars['userGroupTitle']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['userGroupId'],
				'selected' => $__templater->fn('in_array', array($__vars['userGroupId'], $__vars['selectedUserGroups'], ), false),
				'label' => '
						' . $__templater->escape($__vars['userGroupTitle']) . '
					',
				'_type' => 'option',
			);
		}
	}
	$__vars['inner'] = $__templater->preEscaped('
		<div id="' . $__templater->escape($__vars['id']) . '">
			' . $__templater->formCheckBox(array(
		'name' => ($__vars['id'] . '[]'),
		'listclass' => 'listColumns',
	), $__compilerTemp1) . '
			' . $__templater->formCheckBox(array(
	), array(array(
		'data-xf-init' => 'check-all',
		'data-container' => ('#' . $__vars['id']),
		'label' => 'Chọn tất cả',
		'_type' => 'option',
	))) . '
		</div>
	');
	$__finalCompiled .= '

	';
	if ($__vars['withRow']) {
		$__finalCompiled .= '
		' . $__templater->formRow('
			' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
		', array(
			'label' => $__templater->escape($__vars['label']),
			'explain' => $__templater->escape($__vars['explain']),
			'name' => $__vars['id'],
			'id' => $__vars['id'],
		)) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['inner'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});