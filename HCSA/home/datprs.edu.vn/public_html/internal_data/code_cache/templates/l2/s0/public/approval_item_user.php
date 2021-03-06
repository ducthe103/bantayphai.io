<?php
// FROM HASH: d4b21474431ef045b49378b154175e51
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__vars['userIp'] = $__templater->method($__vars['user'], 'getIp', array('register', ));
	$__finalCompiled .= '
';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIps', array()) AND $__vars['userIp']) {
		$__compilerTemp1 .= '
		<a href="' . $__templater->fn('link', array('misc/ip-info', null, array('ip' => $__templater->filter($__vars['userIp'], array(array('ip', array()),), false), ), ), true) . '" target="_blank">' . $__templater->filter($__vars['userIp'], array(array('ip', array()),), true) . '</a>
	';
	}
	$__compilerTemp2 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canBypassUserPrivacy', array()) AND $__vars['user']['email']) {
		$__compilerTemp2 .= '
		' . $__templater->escape($__vars['user']['email']) . '
	';
	}
	$__vars['headerPhraseHtml'] = $__templater->preEscaped(trim('
	' . $__compilerTemp1 . '
	' . $__compilerTemp2 . '
'));
	$__finalCompiled .= '

';
	$__compilerTemp3 = '';
	if ($__vars['changesGrouped']) {
		$__compilerTemp3 .= '
		<br />
		';
		$__compilerTemp4 = '';
		if ($__templater->isTraversable($__vars['changesGrouped'])) {
			foreach ($__vars['changesGrouped'] AS $__vars['group']) {
				$__compilerTemp4 .= '
				<tbody class="dataList-rowGroup">
				';
				if ($__templater->isTraversable($__vars['group']['changes'])) {
					foreach ($__vars['group']['changes'] AS $__vars['change']) {
						$__compilerTemp4 .= '
					' . $__templater->dataRow(array(
						), array(array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['label']),
						),
						array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['old']),
						),
						array(
							'_type' => 'cell',
							'html' => $__templater->escape($__vars['change']['new']),
						))) . '
				';
					}
				}
				$__compilerTemp4 .= '
				</tbody>
			';
			}
		}
		$__compilerTemp3 .= $__templater->dataList('
			<thead>
			' . $__templater->dataRow(array(
			'rowtype' => 'subSection',
		), array(array(
			'colspan' => '3',
			'_type' => 'cell',
			'html' => 'L???ch s??? thay ?????i',
		))) . '
			' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => 'T??n tr?????ng',
		),
		array(
			'_type' => 'cell',
			'html' => 'Gi?? tr??? c??',
		),
		array(
			'_type' => 'cell',
			'html' => 'Gi?? tr??? m???i',
		))) . '
			</thead>
			' . $__compilerTemp4 . '
		', array(
			'data-xf-init' => 'responsive-data-list',
			'class' => 'dataList--separated',
		)) . '
	';
	}
	$__vars['messageHtml'] = $__templater->preEscaped(trim('

	' . $__templater->callMacro('custom_fields_macros', 'custom_fields_view', array(
		'type' => 'users',
		'group' => null,
		'set' => $__vars['user']['Profile']['custom_fields'],
		'additionalFilters' => array('registration', ),
	), $__vars) . '

	' . $__compilerTemp3 . '

'));
	$__finalCompiled .= '

';
	$__compilerTemp5 = array(array(
		'value' => '',
		'checked' => 'checked',
		'label' => 'Kh??ng l??m g??',
		'data-xf-click' => 'approval-control',
		'_type' => 'option',
	)
,array(
		'value' => 'approve',
		'label' => 'Duy???t b??i',
		'data-xf-click' => 'approval-control',
		'_type' => 'option',
	));
	if ($__templater->method($__vars['unapprovedItem']['Content'], 'isPossibleSpammer', array())) {
		$__compilerTemp5[] = array(
			'value' => 'spam_clean',
			'label' => 'Spam clean',
			'data-xf-click' => 'approval-control',
			'_type' => 'option',
		);
	}
	$__compilerTemp5[] = array(
		'value' => 'reject',
		'label' => 'Reject with reason' . $__vars['xf']['language']['label_separator'],
		'title' => 'Th??nh vi??n b??? t??? ch???i s??? kh??ng b??? x??a nh??ng tr???ng th??i th??nh vi??n c???a h??? s??? ???????c ?????t l?? \'b??? t??? ch???i\'. N???u m???t l?? do ???????c cung c???p ??? tr??n, n?? s??? ???????c hi???n th??? khi h??? ????ng nh???p l???n sau.',
		'data-xf-init' => 'tooltip',
		'data-xf-click' => 'approval-control',
		'_dependent' => array($__templater->formTextBox(array(
		'name' => 'reason[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
		'maxlength' => $__templater->fn('max_length', array('XF:UserReject', 'reject_reason', ), false),
		'placeholder' => 'T??y ch???n (kh??ng b???t bu???c)',
	))),
		'html' => '
				<div class="formRow-explain"></div>
			',
		'_type' => 'option',
	);
	$__vars['actionsHtml'] = $__templater->preEscaped('

	' . $__templater->formRadio(array(
		'name' => 'queue[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
	), $__compilerTemp5) . '

	' . $__templater->formCheckBox(array(
	), array(array(
		'name' => 'notify[' . $__vars['unapprovedItem']['content_type'] . '][' . $__vars['unapprovedItem']['content_id'] . ']',
		'value' => '1',
		'checked' => (!$__vars['spamDetails']),
		'label' => '
			' . 'Th??ng b??o ?????n th??nh vi??n khi h??nh ?????ng ?????n' . '
		',
		'_type' => 'option',
	))) . '

');
	$__finalCompiled .= '

' . $__templater->callMacro('approval_queue_macros', 'item_message_type', array(
		'content' => $__vars['content'],
		'contentDate' => $__vars['user']['register_date'],
		'user' => $__vars['user'],
		'messageHtml' => $__vars['messageHtml'],
		'typePhraseHtml' => 'Th??nh vi??n',
		'actionsHtml' => $__vars['actionsHtml'],
		'spamDetails' => $__vars['spamDetails'],
		'headerPhraseHtml' => $__vars['headerPhraseHtml'],
	), $__vars);
	return $__finalCompiled;
});