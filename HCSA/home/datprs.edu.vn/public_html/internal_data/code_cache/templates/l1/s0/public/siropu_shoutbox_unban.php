<?php
// FROM HASH: 7430c480d8cbea36b97961366ec30075
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Lift ban' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['user']['username']));
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Please confirm that you want to lift the ban on the following user' . $__vars['xf']['language']['label_separator'] . '
				<strong>' . $__templater->escape($__vars['user']['username']) . '</strong>
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Lift ban',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('shoutbox/unban', null, array('user_id' => $__vars['user']['user_id'], ), ), false),
		'class' => 'block',
		'ajax' => 'true',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
});