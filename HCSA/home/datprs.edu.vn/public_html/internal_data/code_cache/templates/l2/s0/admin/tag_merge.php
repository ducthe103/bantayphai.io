<?php
// FROM HASH: ca05ae84e4bfefced9aecf67488d2552
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Gộp từ khóa');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formRow('
				' . $__templater->escape($__vars['tag']['tag']) . '
			', array(
		'explain' => 'Từ khóa này sẽ bị xóa.',
		'label' => 'Từ khóa nguồn',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'target',
		'ac' => 'single',
		'data-acurl' => $__templater->fn('link_type', array('public', 'misc/tag-auto-complete', ), false),
	), array(
		'label' => 'Từ khóa đích',
		'explain' => 'Tất cả nội dung được gắn với từ khóa ' . $__templater->escape($__vars['tag']['tag']) . ' bây giờ sẽ được gắn với từ khóa này.',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Gộp',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('tags/merge', $__vars['tag'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});