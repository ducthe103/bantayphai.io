<?php
// FROM HASH: e544837cbbd10aeee1a7949dd2340755
return array('macros' => array('option_form_block' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'group' => '',
		'options' => '!',
		'containerBeforeHtml' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if (!$__templater->test($__vars['options'], 'empty', array())) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp1 .= '
						';
				if ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 2000) {
					$__compilerTemp1 .= '

							';
					if ($__vars['group']) {
						$__compilerTemp1 .= '
								';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp1 .= '
								';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp1 .= '
									';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp1 .= '
									<hr class="formRowSep" />
								';
						}
						$__compilerTemp1 .= '
							';
					}
					$__compilerTemp1 .= '

							' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
						';
				}
				$__compilerTemp1 .= '
					';
			}
		}
		$__compilerTemp2 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp2 .= '
						';
				if (($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] >= 2000) AND ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 3000)) {
					$__compilerTemp2 .= '

							';
					if ($__vars['group']) {
						$__compilerTemp2 .= '
								';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp2 .= '
								';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp2 .= '
									';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp2 .= '
									<hr class="formRowSep" />
								';
						}
						$__compilerTemp2 .= '
							';
					}
					$__compilerTemp2 .= '

							' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
						';
				}
				$__compilerTemp2 .= '
					';
			}
		}
		$__compilerTemp3 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp3 .= '
						';
				if (($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] >= 3000) AND ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 4000)) {
					$__compilerTemp3 .= '

							';
					if ($__vars['group']) {
						$__compilerTemp3 .= '
								';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp3 .= '
								';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp3 .= '
									';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp3 .= '
									<hr class="formRowSep" />
								';
						}
						$__compilerTemp3 .= '
							';
					}
					$__compilerTemp3 .= '

							' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
						';
				}
				$__compilerTemp3 .= '
					';
			}
		}
		$__finalCompiled .= $__templater->form('
			' . $__templater->filter($__vars['containerBeforeHtml'], array(array('raw', array()),), true) . '
			<div class="block-container">
				<h3 class="block-formSectionHeader">
					' . 'General options' . '
				</h3>
				<div class="block-body">
					' . $__compilerTemp1 . '
				</div>

				<h3 class="block-formSectionHeader">
					' . 'Event Options' . '
				</h3>
				<div class="block-body">
					' . $__compilerTemp2 . '
				</div>

				<h3 class="block-formSectionHeader">
					' . 'Event Trigger Options' . '
				</h3>
				<div class="block-body">
					' . $__compilerTemp3 . '
				</div>

				' . $__templater->formSubmitRow(array(
			'sticky' => 'true',
			'icon' => 'save',
		), array(
		)) . '
			</div>
		', array(
			'action' => $__templater->fn('link', array('options/update', ), false),
			'ajax' => 'true',
			'class' => 'block',
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'option_form_block_tabs' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'group' => '',
		'options' => '!',
		'containerBeforeHtml' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if (!$__templater->test($__vars['options'], 'empty', array())) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp1 .= '
								';
				if ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 2000) {
					$__compilerTemp1 .= '

									';
					if ($__vars['group']) {
						$__compilerTemp1 .= '
										';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp1 .= '
										';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp1 .= '
											';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp1 .= '
											<hr class="formRowSep" />
										';
						}
						$__compilerTemp1 .= '
									';
					}
					$__compilerTemp1 .= '

									' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
								';
				}
				$__compilerTemp1 .= '
							';
			}
		}
		$__compilerTemp2 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp2 .= '
								';
				if (($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] >= 2000) AND ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 3000)) {
					$__compilerTemp2 .= '

									';
					if ($__vars['group']) {
						$__compilerTemp2 .= '
										';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp2 .= '
										';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp2 .= '
											';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp2 .= '
											<hr class="formRowSep" />
										';
						}
						$__compilerTemp2 .= '
									';
					}
					$__compilerTemp2 .= '

									' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
								';
				}
				$__compilerTemp2 .= '
							';
			}
		}
		$__compilerTemp3 = '';
		if ($__templater->isTraversable($__vars['options'])) {
			foreach ($__vars['options'] AS $__vars['option']) {
				$__compilerTemp3 .= '
								';
				if (($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] >= 3000) AND ($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] < 4000)) {
					$__compilerTemp3 .= '

									';
					if ($__vars['group']) {
						$__compilerTemp3 .= '
										';
						$__vars['curHundred'] = $__templater->fn('floor', array($__vars['option']['Relations'][$__vars['group']['group_id']]['display_order'] / 100, ), false);
						$__compilerTemp3 .= '
										';
						if (($__vars['curHundred'] > $__vars['hundred'])) {
							$__compilerTemp3 .= '
											';
							$__vars['hundred'] = $__vars['curHundred'];
							$__compilerTemp3 .= '
											<hr class="formRowSep" />
										';
						}
						$__compilerTemp3 .= '
									';
					}
					$__compilerTemp3 .= '

									' . $__templater->callMacro('option_macros', 'option_row', array(
						'group' => $__vars['group'],
						'option' => $__vars['option'],
					), $__vars) . '
								';
				}
				$__compilerTemp3 .= '
							';
			}
		}
		$__finalCompiled .= $__templater->form('
			' . $__templater->filter($__vars['containerBeforeHtml'], array(array('raw', array()),), true) . '
			<div class="block-container">
				<h2 class="block-tabHeader tabs" data-xf-init="tabs" role="tablist">
					<a class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="generalOptions">' . 'General options' . '</a>
					<a class="tabs-tab" role="tab" tabindex="0" aria-controls="eventOptions">' . 'Event Options' . '</a>
					<a class="tabs-tab" role="tab" tabindex="0" aria-controls="eventTriggerOptions">' . 'Event Trigger Options' . '</a>
				</h2>
				<ul class="tabPanes">
					<li class="is-active" role="tabpanel" id="generalOptions">
						<div class="block-body">
							' . $__compilerTemp1 . '
						</div>
					</li>
					<li role="tabpanel" id="eventOptions">
						<div class="block-body">
							' . $__compilerTemp2 . '
						</div>
					</li>
					<li role="tabpanel" id="eventTriggerOptions">
						<div class="block-body">
							' . $__compilerTemp3 . '
						</div>
					</li>
				</ul>
				' . $__templater->formSubmitRow(array(
			'sticky' => 'true',
			'icon' => 'save',
		), array(
		)) . '
			</div>
		', array(
			'action' => $__templater->fn('link', array('options/update', ), false),
			'ajax' => 'true',
			'class' => 'block',
		)) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});