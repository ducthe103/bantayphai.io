<?php
// FROM HASH: 8ac711806138bc1d80b141f440b3f363
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Confirm action');
	$__finalCompiled .= '

' . $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formInfoRow('
				' . 'Are you sure you wish to unlock this content for ' . $__templater->escape($__templater->method($__vars['currency'], 'getFormattedValue', array($__vars['charge']['cost'], ))) . ' ' . $__templater->escape($__vars['currency']['title']) . '?' . '
			', array(
		'rowtype' => 'confirm',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'purchase',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('dbtech-credits/currency/buy-content', $__vars['currency'], array('post_id' => $__vars['charge']['post_id'], 'content_hash' => $__vars['charge']['content_hash'], ), ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});