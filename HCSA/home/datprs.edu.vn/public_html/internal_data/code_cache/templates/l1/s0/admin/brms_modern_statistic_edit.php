<?php
// FROM HASH: 70d1c7e6da008309d762e99b59c71062
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['modernStatistic'], 'isInsert', array())) {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add modern statistic');
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '
	';
		$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit Modern Statistic' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['modernStatistic']['title']));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__templater->method($__vars['modernStatistic'], 'isUpdate', array())) {
		$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('', array(
			'href' => $__templater->fn('link', array('brms-statistics/delete', $__vars['modernStatistic'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
');
	}
	$__finalCompiled .= '
';
	$__templater->includeCss('brms_modern_statistic_edit.less');
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'br/brms/options-tab.js',
		'min' => '1',
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['advertisingPositions'])) {
		foreach ($__vars['advertisingPositions'] AS $__vars['positionId'] => $__vars['advertisingPosition']) {
			$__compilerTemp1[] = array(
				'value' => 'ads:' . $__vars['positionId'],
				'label' => $__templater->escape($__vars['advertisingPosition']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = '';
	if ($__templater->isTraversable($__vars['itemLimit']['value'])) {
		foreach ($__vars['itemLimit']['value'] AS $__vars['counter'] => $__vars['item']) {
			$__compilerTemp2 .= '
										<li class="u-inputSpacer">
											' . $__templater->formTextBox(array(
				'name' => 'item_limit[value][]',
				'value' => $__vars['item'],
				'placeholder' => 'Number',
				'size' => '20',
			)) . '
										</li>
									';
		}
	}
	$__compilerTemp3 = '';
	if ($__vars['styleTree']) {
		$__compilerTemp3 .= '
						';
		$__compilerTemp4 = '';
		$__compilerTemp5 = $__templater->method($__vars['styleTree'], 'getFlattened', array(0, ));
		if ($__templater->isTraversable($__compilerTemp5)) {
			foreach ($__compilerTemp5 AS $__vars['treeEntry']) {
				$__compilerTemp4 .= '
								<dl class="inputLabelPair">
									<dt><label for="brms_style_' . $__templater->escape($__vars['treeEntry']['record']['style_id']) . '">' . $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . ' ' . $__templater->escape($__vars['treeEntry']['record']['title']) . '</label></dt>
									<dd>
										' . $__templater->formSelect(array(
					'id' => 'brms_style_' . $__vars['treeEntry']['record']['style_id'],
					'name' => 'style_settings[' . $__vars['treeEntry']['record']['style_id'] . ']',
					'value' => $__vars['modernStatistic']['style_settings'][$__vars['treeEntry']['record']['style_id']],
				), array(array(
					'value' => '',
					'label' => 'Default',
					'_type' => 'option',
				),
				array(
					'value' => 'dark',
					'label' => 'Dark',
					'_type' => 'option',
				),
				array(
					'value' => 'light',
					'label' => 'Light',
					'_type' => 'option',
				))) . '
									</dd>
								</dl>
							';
			}
		}
		$__compilerTemp3 .= $__templater->formRow('
							' . $__compilerTemp4 . '
						', array(
			'rowtype' => 'input',
			'label' => 'Style for Board Style',
		)) . '
					';
	}
	$__compilerTemp6 = array(array(
		'value' => '',
		'label' => '(' . 'All' . ')',
		'_type' => 'option',
	));
	$__compilerTemp7 = $__templater->method($__vars['languageTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp7)) {
		foreach ($__compilerTemp7 AS $__vars['treeEntry']) {
			$__compilerTemp6[] = array(
				'value' => $__vars['treeEntry']['record']['language_id'],
				'label' => $__templater->fn('repeat', array('--', $__vars['treeEntry']['depth'], ), true) . '
								' . $__templater->escape($__vars['treeEntry']['record']['title']) . '
							',
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp8 = array(array(
		'value' => '',
		'label' => '(' . 'All' . ')',
		'_type' => 'option',
	));
	$__compilerTemp8[] = array(
		'label' => '',
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp8); $__compilerTemp9 = key($__compilerTemp8);
	if ($__templater->isTraversable($__vars['nodes'])) {
		foreach ($__vars['nodes'] AS $__vars['node']) {
			$__compilerTemp8[$__compilerTemp9]['options'][] = array(
				'value' => $__vars['node']['value'],
				'label' => $__templater->escape($__vars['node']['label']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp10 = array(array(
		'value' => '',
		'label' => '(' . 'None' . ')',
		'_type' => 'option',
	));
	$__compilerTemp10[] = array(
		'label' => '',
		'_type' => 'optgroup',
		'options' => array(),
	);
	end($__compilerTemp10); $__compilerTemp11 = key($__compilerTemp10);
	$__compilerTemp10[$__compilerTemp11]['options'] = $__templater->mergeChoiceOptions($__compilerTemp10[$__compilerTemp11]['options'], $__vars['userGroups']);
	$__compilerTemp12 = '';
	if ($__vars['tabData']) {
		$__compilerTemp12 .= '
					';
		$__vars['counter'] = 0;
		if ($__templater->isTraversable($__vars['tabData'])) {
			foreach ($__vars['tabData'] AS $__vars['key'] => $__vars['tab']) {
				$__vars['counter']++;
				$__compilerTemp12 .= '
						';
				$__compilerTemp13 = $__vars;
				$__compilerTemp13['counter'] = $__vars['counter'];
				$__compilerTemp12 .= $__templater->includeTemplate('brms_modern_statistic_edit_tab', $__compilerTemp13) . '
					';
			}
		}
		$__compilerTemp12 .= '
					';
		$__vars['tabData'] = '0';
		$__compilerTemp12 .= '
					';
	}
	$__compilerTemp14 = $__vars;
	$__compilerTemp14['brmsListener'] = '1';
	$__compilerTemp14['tab'] = $__vars['defaultTabData'];
	$__compilerTemp14['counter'] = $__vars['nextCounter'];
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<h2 class="block-tabHeader tabs hScroller" data-xf-init="tabs h-scroller"
			role="tablist"
			data-state="replace"
			data-panes=".js-statisticTabPanes">
			<span class="hScroller-scroll">
				' . '
				<a class="tabs-tab is-active" role="tab" tabindex="0" data-controls="statistic-information" id="statistic-information-tab">' . 'Modern Statistic Information' . '</a>
				<a class="tabs-tab" role="tab" tabindex="0" data-controls="statistic-condition" id="statistic-condition-tab">' . 'Display This Statistic While...' . '</a>
				<a class="tabs-tab" role="tab" tabindex="0" data-controls="statistic-tabs" id="statistic-tabs-tab">' . 'Tabs Data' . '</a>
				' . '
			</span>
		</h2>

		<ul class="tabPanes js-statisticTabPanes">
			<li class="is-active" role="tabpanel" id="statistic-information">
				<div class="block-body">
					' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => $__vars['modernStatistic']['title'],
		'class' => 'input-productTitle',
	), array(
		'label' => 'Title',
	)) . '
					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'active',
		'value' => '1',
		'selected' => $__vars['modernStatistic']['active'],
		'label' => '
							' . 'Active' . '
						',
		'_type' => 'option',
	)), array(
	)) . '

					' . $__templater->formSelectRow(array(
		'name' => 'position',
		'value' => $__vars['modernStatistic']['position'],
	), $__compilerTemp1, array(
		'label' => 'Position',
	)) . '

					<hr class="formRowSep" />
					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'usename_marke_up',
		'label' => 'Username Make Up',
		'selected' => $__vars['modernStatistic']['usename_marke_up'],
		'hint' => 'Display username with user group\'s css.',
		'_type' => 'option',
	),
	array(
		'name' => 'show_thread_prefix',
		'label' => 'Show Thread prefix',
		'selected' => $__vars['modernStatistic']['show_thread_prefix'],
		'hint' => 'Enable this option will use more server resources',
		'_type' => 'option',
	),
	array(
		'name' => 'show_resource_prefix',
		'label' => 'Show Resource prefix',
		'selected' => $__vars['modernStatistic']['show_resource_prefix'],
		'hint' => 'Enable this option will use more server resources',
		'_type' => 'option',
	),
	array(
		'name' => 'load_fisrt_tab',
		'label' => 'Load First Tab Promptly',
		'selected' => $__vars['modernStatistic']['load_fisrt_tab'],
		'hint' => 'If enabled the first tab will load with template on the first time. Otherwise this will load with AJAX.',
		'_type' => 'option',
	)), array(
		'label' => '',
	)) . '

					' . $__templater->formRadioRow(array(
		'name' => 'preview_tooltip',
		'value' => ($__vars['modernStatistic']['preview_tooltip'] ? $__vars['modernStatistic']['preview_tooltip'] : 'custom_preview'),
	), array(array(
		'value' => 'disable',
		'label' => 'Disable',
		'_type' => 'option',
	),
	array(
		'value' => 'thread_preview',
		'label' => 'Thread Preview',
		'_type' => 'option',
	),
	array(
		'value' => 'custom_preview',
		'label' => 'Custom Preview',
		'_type' => 'option',
	)), array(
		'label' => 'Use Preview Tooltip',
		'explain' => 'Show thread preview tooltips',
	)) . '

					<hr class="formRowSep" />
					' . $__templater->formNumberBoxRow(array(
		'name' => 'thread_cutoff',
		'value' => $__vars['modernStatistic']['thread_cutoff'],
		'min' => '0',
	), array(
		'label' => 'Thread Date Cut Off Default',
		'explain' => 'Enter the number of days to cut off the list of most view and most reply threads. Enter 0 If you want to include all threads from beginning.',
	)) . '

					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'label' => 'Tabs Cache Time',
		'name' => 'enable_cache',
		'selected' => $__vars['modernStatistic']['enable_cache'],
		'_dependent' => array('
								' . $__templater->formNumberBox(array(
		'name' => 'cache_time',
		'value' => ($__vars['modernStatistic']['cache_time'] ? $__vars['modernStatistic']['cache_time'] : 1),
		'min' => '1',
		'step' => '1',
	)) . '
							'),
		'_type' => 'option',
	)), array(
		'label' => '',
		'explain' => 'Tabs will cache with specify user. Enter number of minutes of caching time. If enabled, Update Time and Custom Item Limit will be disabled. Tabs will load with default value for item limit.',
	)) . '

					' . $__templater->formNumberBoxRow(array(
		'name' => 'auto_update',
		'value' => $__vars['modernStatistic']['auto_update'],
		'min' => '0',
	), array(
		'label' => 'Update Time',
		'explain' => 'Specify time to update statistic content.',
	)) . '

					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'item_limit[enabled]',
		'value' => '1',
		'selected' => $__vars['itemLimit']['enabled'],
		'label' => 'Enabled',
		'hint' => 'Allow member change item limit',
		'_dependent' => array('
								<ul class="inputList">
									' . $__compilerTemp2 . '
									<li data-xf-init="brms-field-adder">
										' . $__templater->formTextBox(array(
		'name' => 'item_limit[value][]',
		'value' => '',
		'placeholder' => 'Number',
		'size' => '20',
	)) . '
									</li>
								</ul>
							'),
		'_type' => 'option',
	)), array(
		'label' => 'Item Limits',
		'hint' => 'Number of threads that will be displayed. Choosing this value higher will use more server resources.',
		'html' => '
							<ul class="inputChoices inputChoices--noChoice">
								<li class="inputChoices-choice">
									<div>' . 'Default' . $__vars['xf']['language']['label_separator'] . '</div>
									' . $__templater->formNumberBox(array(
		'name' => 'item_limit[default]',
		'value' => $__vars['itemLimit']['default'],
		'min' => '1',
		'size' => '20',
	)) . '
								</li>
							</ul>
						',
	)) . '
				</div>
				<h3 class="block-formSectionHeader">
					<span class="block-formSectionHeader-aligner">' . 'Style' . '</span>
				</h3>
				<div class="block-body">
					' . $__templater->formRadioRow(array(
		'name' => 'control_position',
		'value' => ($__vars['modernStatistic']['control_position'] ? $__vars['modernStatistic']['control_position'] : 'brmsLeftTabs'),
	), array(array(
		'value' => 'brmsLeftTabs',
		'label' => 'Left',
		'_type' => 'option',
	),
	array(
		'value' => 'brmsTopTabs',
		'label' => 'Top',
		'_type' => 'option',
	),
	array(
		'value' => 'brmsRightTabs',
		'label' => 'Right',
		'_type' => 'option',
	)), array(
		'label' => 'Control Navigation Position',
		'explain' => 'Position for control navigation',
	)) . '

					' . $__templater->formRadioRow(array(
		'name' => 'style_display',
		'value' => $__vars['modernStatistic']['style_display'],
	), array(array(
		'value' => '',
		'label' => 'Light',
		'_type' => 'option',
	),
	array(
		'value' => 'dark',
		'label' => 'Dark',
		'_type' => 'option',
	)), array(
		'label' => 'Style Display',
		'explain' => 'For compatible with other forum color',
	)) . '
					' . $__compilerTemp3 . '
				</div>
				<h3 class="block-formSectionHeader">
					<span class="block-formSectionHeader-aligner">' . 'Extra' . '</span>
				</h3>
				<div class="block-body">
					' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'allow_user_setting',
		'label' => 'Allow Member Setting',
		'selected' => $__vars['modernStatistic']['allow_user_setting'],
		'hint' => 'Allow member to show or hide this modern statistic',
		'_type' => 'option',
	),
	array(
		'name' => 'allow_change_layout',
		'label' => 'Allow Member Change Layout',
		'selected' => $__vars['modernStatistic']['allow_change_layout'],
		'hint' => 'Allow member to change layout of statistics',
		'_type' => 'option',
	),
	array(
		'name' => 'allow_manual_refresh',
		'label' => 'Allow Member Refresh Statistic Manual',
		'selected' => $__vars['modernStatistic']['allow_manual_refresh'],
		'hint' => 'Allow member to refresh statistics manual',
		'_type' => 'option',
	)), array(
		'label' => '',
	)) . '
				</div>
			</li>
			<li role="tabpanel" id="statistic-condition">
				<div class="block-body">
					' . $__templater->formTextAreaRow(array(
		'name' => 'modern_criteria[template_name]',
		'value' => $__vars['modernStatistic']['modern_criteria']['template_name'],
		'autosize' => 'true',
	), array(
		'label' => 'Template title',
		'explain' => 'Input list of templates that you want to display in with statistic\'s positions. <br/>
You can leave it blank to display in all templates that contain position. <br/>
Use spaces or line break between templates. <br/>
For example: <br/>
- forum_list (the index page)<br/>
- forum_view (the individual forum page)<br/>
- thread_view (the thread page)<br/>
- member_view (the individual member page)<br/>',
	)) . '
					' . $__templater->formSelectRow(array(
		'name' => 'modern_criteria[language_ids]',
		'value' => $__vars['modernStatistic']['modern_criteria']['language_ids'],
		'multiple' => 'true',
	), $__compilerTemp6, array(
		'label' => 'Language',
		'explain' => 'Select languages you want to display this. If not it will display with all languages.',
	)) . '
					' . $__templater->formSelectRow(array(
		'name' => 'modern_criteria[node_ids]',
		'value' => $__vars['modernStatistic']['modern_criteria']['node_ids'],
		'size' => '15',
		'multiple' => 'true',
	), $__compilerTemp8, array(
		'label' => 'Include Nodes',
		'explain' => 'If hook and template is node content like Forum list page, Forum view page, Thread view page, Category view page.... Select node you want to display this. If not it will display with all node.
=> Select the forums you want to display statistics while hooks and templates are node content (forum_list, forum_view, thread_view, category_view...). <br/>Leave nothing selected to include all forums.',
	)) . '
					' . $__templater->formSelectRow(array(
		'name' => 'modern_criteria[user_group_ids]',
		'value' => $__vars['modernStatistic']['modern_criteria']['user_group_ids'],
		'size' => '10',
		'multiple' => 'true',
	), $__compilerTemp10, array(
		'label' => 'Exclude Groups',
		'explain' => 'Which groups would you like to be hide this statistic.',
	)) . '
				</div>
			</li>
			<li role="tabpanel" id="statistic-tabs">
				<h3 class="block-formSectionHeader">
					' . 'Tabs Selector
' . '

					' . $__templater->button('
						' . 'Toggle Collapse' . '
					', array(
		'class' => 'button--link collapse',
		'data-xf-click' => 'brms-collapse',
	), '', array(
	)) . '
				</h3>
				<div class="listTabs">
					' . $__compilerTemp12 . '
					' . $__templater->includeTemplate('brms_modern_statistic_edit_tab', $__compilerTemp14) . '
				</div>
				' . $__templater->formRow('
					' . $__templater->button('
						<i class="fa fa-plus" aria-hidden="true"></i> ' . 'Add more tab' . '
					', array(
		'class' => 'button--link',
		'data-xf-click' => 'brms-add-tab',
	), '', array(
	)) . '
				', array(
	)) . '
			</li>
		</ul>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->fn('link', array('brms-statistics/save', $__vars['modernStatistic'], ), false),
		'ajax' => 'true',
		'class' => 'block',
	));
	return $__finalCompiled;
});