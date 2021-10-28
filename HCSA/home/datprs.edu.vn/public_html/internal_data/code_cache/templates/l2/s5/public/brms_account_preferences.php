<?php
// FROM HASH: 3e65986bbdf2d548ed23c1c25c41377c
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['xf']['visitor'], 'hasPermission', array('BR_ModernStatistics', 'BRMS_allowPreference', ))) {
		$__finalCompiled .= '
	<h2 class="block-formSectionHeader"><span class="block-formSectionHeader-aligner">' . 'Modern Statistics Preferences' . '</span></h2>
	<div class="block-body">
		';
		$__vars['statisticRepo'] = $__templater->method($__vars['xf']['app']['em'], 'getRepository', array('BR\\ModernStatistic:ModernStatistic', ));
		$__finalCompiled .= '
		';
		$__compilerTemp1 = $__templater->method($__templater->method($__vars['statisticRepo'], 'findModernStatisticsForList', array(true, )), 'fetch', array());
		if ($__templater->isTraversable($__compilerTemp1)) {
			foreach ($__compilerTemp1 AS $__vars['modernStatistic']) {
				$__finalCompiled .= '
			';
				if ($__vars['modernStatistic']['allow_user_setting']) {
					$__finalCompiled .= '
				' . $__templater->formSelectRow(array(
						'name' => 'brms_statistic_perferences[' . $__vars['modernStatistic']['modern_statistic_id'] . ']',
						'value' => $__vars['xf']['visitor']['brms_statistic_perferences'][$__vars['modernStatistic']['modern_statistic_id']],
					), array(array(
						'value' => '0',
						'label' => 'Kích hoạt',
						'_type' => 'option',
					),
					array(
						'value' => '1',
						'label' => 'Vô hiệu hóa',
						'_type' => 'option',
					)), array(
						'label' => $__templater->escape($__vars['modernStatistic']['title']),
					)) . '
			';
				}
				$__finalCompiled .= '
		';
			}
		}
		$__finalCompiled .= '
	</div>
';
	}
	return $__finalCompiled;
});