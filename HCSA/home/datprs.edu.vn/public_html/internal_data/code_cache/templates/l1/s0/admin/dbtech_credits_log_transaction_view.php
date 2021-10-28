<?php
// FROM HASH: f20bbee11420dc192116d11a871f46d0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Transaction #' . $__templater->escape($__vars['entry']['transaction_id']) . '');
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			';
	$__vars['currency'] = $__vars['entry']['Currency'];
	$__finalCompiled .= '

			' . $__templater->formRow('
				<a href="' . $__templater->fn('link', array('users/edit', $__vars['entry']['SourceUser'], ), true) . '">' . $__templater->escape($__vars['entry']['SourceUser']['username']) . '</a>
			', array(
		'label' => 'Source User',
	)) . '
			' . $__templater->formRow('
				<a href="' . $__templater->fn('link', array('users/edit', $__vars['entry']['TargetUser'], ), true) . '">' . $__templater->escape($__vars['entry']['TargetUser']['username']) . '</a>
			', array(
		'label' => 'Target User',
	)) . '

			' . $__templater->formRow('
				' . $__templater->escape($__vars['currency']['prefix']) . $__templater->filter($__vars['entry']['amount'], array(array('number', array($__vars['currency']['decimals'], )),), true) . $__templater->escape($__vars['currency']['suffix']) . ' ' . $__templater->escape($__vars['currency']['title']) . '
			', array(
		'label' => 'Amount',
	)) . '

			' . $__templater->formRow('
				' . $__templater->fn('date_dynamic', array($__vars['entry']['dateline'], array(
		'data-full-date' => 'true',
	))) . '
			', array(
		'label' => 'Date',
	)) . '
			' . $__templater->formRow('
				<a href="' . $__templater->fn('link', array('dbtech-credits/events/edit', $__vars['entry']['Event'], ), true) . '">' . $__templater->escape($__vars['entry']['Event']['title']) . '</a>
			', array(
		'label' => 'Event',
	)) . '
			' . $__templater->formRow('
				' . $__templater->escape($__templater->method($__vars['eventTrigger'], 'getTitle', array())) . '
			', array(
		'label' => 'Event Trigger',
	)) . '

			';
	if ($__vars['entry']['message']) {
		$__finalCompiled .= '
				<hr class="formRowSep" />

				' . $__templater->formRow('
					' . $__templater->escape($__vars['entry']['message']) . '
				', array(
			'label' => 'Optional message',
		)) . '
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>';
	return $__finalCompiled;
});