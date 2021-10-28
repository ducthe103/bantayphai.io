<?php
// FROM HASH: 740611411d704b814027777474da2240
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Ban' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['user']['username']));
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRadioRow(array(
		'name' => 'ban_length',
		'value' => 'perm',
	), array(array(
		'value' => 'perm',
		'label' => 'Permanent',
		'_type' => 'option',
	),
	array(
		'value' => 'temp',
		'label' => $__templater->filter('Temporary', array(array('for_attr', array()),), true),
		'data-hide' => 'true',
		'_dependent' => array('
						<div class="inputGroup" style="margin-bottom: 5px;">
							' . $__templater->formNumberBox(array(
		'name' => 'length_value',
		'min' => '1',
	)) . '
							<span class="inputGroup-splitter"></span>
							' . $__templater->formSelect(array(
		'name' => 'length_unit',
		'class' => 'input--autoSize',
	), array(array(
		'value' => 'hours',
		'label' => 'Hours',
		'_type' => 'option',
	),
	array(
		'value' => 'days',
		'label' => 'Days',
		'_type' => 'option',
	),
	array(
		'value' => 'months',
		'label' => 'Months',
		'_type' => 'option',
	))) . '
						</div>
						' . $__templater->formDateInput(array(
		'name' => 'end_date',
		'placeholder' => $__templater->filter('Until' . $__vars['xf']['language']['ellipsis'], array(array('for_attr', array()),), false),
		'class' => 'input--autoSize',
	)) . '
					'),
		'_type' => 'option',
	)), array(
		'label' => $__templater->filter('Ban length', array(array('for_attr', array()),), true),
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Ban',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('shoutbox/ban', '', array('user_id' => $__vars['user']['user_id'], ), ), false),
		'class' => 'block',
		'ajax' => 'true',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
});