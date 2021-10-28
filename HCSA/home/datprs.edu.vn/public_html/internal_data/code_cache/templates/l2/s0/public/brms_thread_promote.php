<?php
// FROM HASH: 7cdda372595f236afd5e7d41949c0ff3
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Promote Thread' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->fn('prefix', array('thread', $__vars['thread'], 'escaped', ), true) . $__templater->escape($__vars['thread']['title']));
	$__finalCompiled .= '
';
	$__templater->pageParams['pageH1'] = $__templater->preEscaped('Promote Thread' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->fn('prefix', array('thread', $__vars['thread'], ), true) . $__templater->escape($__vars['thread']['title']));
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__templater->method($__vars['thread'], 'getBreadcrumbs', array()));
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['hours'])) {
		foreach ($__vars['hours'] AS $__vars['hour']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['hour'],
				'label' => $__templater->escape($__vars['hour']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = array();
	if ($__templater->isTraversable($__vars['minutes'])) {
		foreach ($__vars['minutes'] AS $__vars['minute']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['minute'],
				'label' => $__templater->escape($__vars['minute']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp3 = '';
	if ($__vars['thread']['brms_promote_date']) {
		$__compilerTemp3 .= '
					' . $__templater->button('Delete Promote', array(
			'type' => 'submit',
			'icon' => 'delete',
			'name' => 'delete',
			'accesskey' => 'e',
		), '', array(
		)) . '
				';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body js-prefixListenContainer">
			' . $__templater->formRow('
				<div class="inputGroup">
					' . $__templater->formDateInput(array(
		'name' => 'promote_time_ymd',
		'value' => $__vars['promoteTime']['ymd'],
	)) . '
					<span class="inputGroup-text">
						' . 'Time' . $__vars['xf']['language']['label_separator'] . '
					</span>
					<span class="inputGroup" dir="ltr">
						' . $__templater->formSelect(array(
		'name' => 'promote_time_hh',
		'value' => $__vars['promoteTime']['hh'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp1) . '
						<span class="inputGroup-text">:</span>
						' . $__templater->formSelect(array(
		'name' => 'promote_time_mm',
		'value' => $__vars['promoteTime']['mm'],
		'class' => 'input--inline input--autoSize',
	), $__compilerTemp2) . '
					</span>
				</div>
			', array(
		'label' => 'Promote Date',
		'explain' => 'Promotion threads are ordered by promotion date.',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
		'html' => '
				' . $__compilerTemp3 . '
			',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('threads/brms-promote', $__vars['thread'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});