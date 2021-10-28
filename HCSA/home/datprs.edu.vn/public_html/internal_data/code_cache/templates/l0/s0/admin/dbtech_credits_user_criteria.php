<?php
// FROM HASH: a0c8d1f7a0e440c3fee0774f49d303ce
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__vars['currencies'] = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('DBTech\\Credits:Currency', )), 'getCurrencies', array());
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['currencies'])) {
		foreach ($__vars['currencies'] AS $__vars['currencyId'] => $__vars['currency']) {
			$__compilerTemp1[] = array(
				'label' => 'User has fewer than X ' . $__templater->escape($__vars['currency']['title']) . '' . $__vars['xf']['language']['label_separator'],
				'name' => 'user_criteria[dbtech_credits_currency_' . $__vars['currencyId'] . '_less][rule]',
				'value' => 'dbtech_credits_currency_' . $__vars['currencyId'] . '_less',
				'selected' => $__templater->method($__vars['currency'], 'isCriteriaSelected', array($__vars['criteria'], 'less', )),
				'_dependent' => array($__templater->formTextBox(array(
				'name' => 'user_criteria[dbtech_credits_currency_' . $__vars['currencyId'] . '_less][data][amount]',
				'value' => $__templater->method($__vars['currency'], 'getCriteriaValue', array($__vars['criteria'], 'less', )),
				'type' => 'number',
				'step' => '1',
			))),
				'_type' => 'option',
			);
			$__compilerTemp1[] = array(
				'label' => 'User has more than X ' . $__templater->escape($__vars['currency']['title']) . '' . $__vars['xf']['language']['label_separator'],
				'name' => 'user_criteria[dbtech_credits_currency_' . $__vars['currencyId'] . '_more][rule]',
				'value' => 'dbtech_credits_currency_' . $__vars['currencyId'] . '_more',
				'selected' => $__templater->method($__vars['currency'], 'isCriteriaSelected', array($__vars['criteria'], 'more', )),
				'_dependent' => array($__templater->formTextBox(array(
				'name' => 'user_criteria[dbtech_credits_currency_' . $__vars['currencyId'] . '_more][data][amount]',
				'value' => $__templater->method($__vars['currency'], 'getCriteriaValue', array($__vars['criteria'], 'more', )),
				'type' => 'number',
				'step' => '1',
			))),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), $__compilerTemp1, array(
		'label' => 'DragonByte Credits',
	)) . '

<hr class="formRowSep" />';
	return $__finalCompiled;
});