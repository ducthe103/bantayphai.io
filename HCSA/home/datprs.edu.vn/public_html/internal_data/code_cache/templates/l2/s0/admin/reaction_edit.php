<?php
// FROM HASH: e709c31c8cdeaf3cb9ecccd0c5fe57bb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['reaction'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add reaction');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit reaction' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['reaction']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['reaction'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('reactions/delete', $__vars['reaction'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '

';
	$__vars['explain'] = $__templater->preEscaped('Pick a text color to use when this reaction has been given. If you do not wish to associate this reaction to a specific color, leave it blank.<br /><br /><b>Note: Palette colors may appear differently depending on selected style.</b>');
	$__compilerTemp1 = $__templater->mergeChoiceOptions(array(), $__vars['reactionScores']);
	$__compilerTemp1[] = array(
		'label' => 'Custom score',
		'value' => '',
		'selected' => $__vars['reaction']['is_custom_score'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'custom_reaction_score',
		'value' => $__vars['reaction']['reaction_score'],
		'step' => '1',
	))),
		'_type' => 'option',
	);
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">

			' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => ($__vars['reaction']['reaction_id'] ? $__vars['reaction']['MasterTitle']['phrase_text'] : ''),
	), array(
		'label' => 'Tiêu đề',
	)) . '

			' . '' . '
			' . $__templater->callMacro('public:color_picker_macros', 'color_picker', array(
		'name' => 'text_color',
		'value' => $__vars['reaction']['text_color'],
		'allowPalette' => 'true',
		'colorData' => $__vars['colorData'],
		'label' => 'Màu chữ',
		'explain' => $__vars['explain'],
	), $__vars) . '

			' . $__templater->formRadioRow(array(
		'name' => 'reaction_score',
		'value' => $__vars['reaction']['reaction_score'],
	), $__compilerTemp1, array(
		'label' => 'Reaction score',
	)) . '

			<hr class="formRowSep" />

			' . $__templater->callMacro('display_order_macros', 'row', array(
		'value' => $__vars['reaction']['display_order'],
	), $__vars) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'active',
		'selected' => $__vars['reaction']['active'],
		'label' => 'Reaction is active',
		'hint' => 'Disabled reactions can no longer be used, and will no longer appear in content summaries.',
		'_type' => 'option',
	)), array(
	)) . '

			<hr class="formRowSep" />

			' . $__templater->formTextBoxRow(array(
		'name' => 'image_url',
		'value' => $__vars['reaction']['image_url'],
		'maxlength' => $__templater->fn('max_length', array($__vars['reaction'], 'image_url', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'URL hình ảnh thay thế',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'image_url_2x',
		'value' => $__vars['reaction']['image_url_2x'],
		'maxlength' => $__templater->fn('max_length', array($__vars['reaction'], 'image_url_2x', ), false),
		'dir' => 'ltr',
	), array(
		'label' => 'URL 2x hình ảnh thay thế',
		'hint' => 'Tùy chọn (không bắt buộc)',
		'explain' => 'Nếu được cung cấp, hình ảnh 2x sẽ được tự động hiển thị thay vì URL hình ảnh ở trên trên các thiết bị có khả năng hiển thị độ phân giải pixel cao hơn.<br />
<br />
<strong>Lưu ý: Tùy chọn này không có hiệu lực khi kích hoạt chế độ sprite.</strong>',
	)) . '

			' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'sprite_mode',
		'selected' => $__vars['reaction']['sprite_mode'],
		'label' => 'Bật chế độ sprite CSS với các thông số sau:',
		'_type' => 'option',
	)), array(
		'label' => 'Chế độ Sprite',
	)) . '

			' . $__templater->formRow('

				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[w]',
		'value' => $__vars['reaction']['sprite_params']['w'],
		'min' => '1',
		'title' => $__templater->filter('Width', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">x</span>
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[h]',
		'value' => $__vars['reaction']['sprite_params']['h'],
		'min' => '1',
		'title' => $__templater->filter('Height', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">' . 'Pixels' . '</span>
				</div>
			', array(
		'rowtype' => 'input',
		'label' => 'Kích thước Sprite',
	)) . '

			' . $__templater->formRow('

				<div class="inputGroup">
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[x]',
		'value' => $__vars['reaction']['sprite_params']['x'],
		'title' => $__templater->filter('Background Position X', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">x</span>
					' . $__templater->formNumberBox(array(
		'name' => 'sprite_params[y]',
		'value' => $__vars['reaction']['sprite_params']['y'],
		'title' => $__templater->filter('Background Position Y', array(array('for_attr', array()),), false),
		'data-xf-init' => 'tooltip',
	)) . '
					<span class="inputGroup-text">' . 'Pixels' . '</span>
				</div>
				<div class="formRow-explain">' . 'CSS will be generated automatically for small and medium size sprites based on the values above. Dimensions of 32px x 32px are recommended.' . '</div>
			', array(
		'rowtype' => 'input',
		'label' => 'Vị trí Sprite',
	)) . '

			' . $__templater->formTextBoxRow(array(
		'name' => 'sprite_params[bs]',
		'value' => $__vars['reaction']['sprite_params']['bs'],
		'dir' => 'ltr',
	), array(
		'label' => 'Kích thước nền',
		'explain' => 'Nếu cần, nhập giá trị cho thuộc tính <code>background-size</code> CSS cho ảnh này.',
	)) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'sticky' => 'true',
		'icon' => 'save',
	), array(
	)) . '

	</div>
', array(
		'action' => $__templater->fn('link', array('reactions/save', $__vars['reaction'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});