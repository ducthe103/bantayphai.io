<?php
// FROM HASH: e89e55ce4fcdb467ab2e7316079c3eca
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Modern Statistics');
	$__templater->pageParams['pageNumber'] = $__vars['page'];
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	<div class="buttonGroup">
		' . $__templater->button('Add modern statistic', array(
		'href' => $__templater->fn('link', array('brms-statistics/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
	</div>
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['modernStatistics'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['modernStatistics'])) {
			foreach ($__vars['modernStatistics'] AS $__vars['modernStatistic']) {
				$__compilerTemp1 .= '
						' . $__templater->dataRow(array(
				), array(array(
					'hash' => $__vars['modernStatistic']['modern_statistic_id'],
					'href' => $__templater->fn('link', array('brms-statistics/edit', $__vars['modernStatistic'], ), false),
					'label' => $__templater->escape($__vars['modernStatistic']['title']),
					'_type' => 'main',
					'html' => '',
				),
				array(
					'_type' => 'cell',
					'html' => '
								' . ($__vars['modernStatistic']['active'] ? 'Active' : 'Inactive') . '
							',
				),
				array(
					'href' => $__templater->fn('link', array('brms-statistics/delete', $__vars['modernStatistic'], ), false),
					'_type' => 'delete',
					'html' => '',
				))) . '
					';
			}
		}
		$__finalCompiled .= $__templater->dataList('
					' . $__compilerTemp1 . '
				', array(
		)) . '
			</div>
			<div class="block-footer block-footer--split">
				<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__vars['keywordTotal'], ), true) . '</span>
			</div>
		</div>
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">
		' . 'No modern statistics have been created yet.' . '
	</div>
';
	}
	return $__finalCompiled;
});