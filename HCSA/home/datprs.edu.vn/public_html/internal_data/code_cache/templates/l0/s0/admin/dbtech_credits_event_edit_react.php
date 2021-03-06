<?php
// FROM HASH: c9caafac7b076bd9ea6d5e4f81a9f4bb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__vars['reactions'] = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('XF:Reaction', )), 'findReactionsForList', array());
	$__finalCompiled .= '

';
	$__compilerTemp1 = array(array(
		'value' => '-1',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'Any' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['reactions'])) {
		foreach ($__vars['reactions'] AS $__vars['reaction']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['reaction']['reaction_id'],
				'label' => $__templater->escape($__vars['reaction']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formSelectRow(array(
		'name' => 'settings[reaction_ids]',
		'multiple' => 'true',
		'size' => '8',
		'value' => $__vars['event']['settings']['reaction_ids'],
	), $__compilerTemp1, array(
		'label' => 'Reactions',
		'explain' => 'If you want to restrict this event to a certain reaction, or sub-set of reactions, you can select them here.<br />
If you choose "Any", or don\'t make a selection, every reaction will be allowed for this event.',
	));
	return $__finalCompiled;
});