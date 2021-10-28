<?php
// FROM HASH: 412732d1064567222c4e4d720125e5cf
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['modernStatistic']['tab_data'] AND $__vars['modernStatistic']['active']) {
		$__finalCompiled .= '
	';
		$__compilerTemp1 = '';
		$__compilerTemp1 .= '
				';
		if ($__templater->isTraversable($__vars['modernStatistic']['tabData'])) {
			foreach ($__vars['modernStatistic']['tabData'] AS $__vars['key'] => $__vars['tab']) {
				$__compilerTemp1 .= '
					';
				if ($__vars['tab']['active'] AND ((($__vars['tab']['type'] != 'my_threads') AND ($__vars['tab']['type'] != 'your_profile_posts')) OR $__vars['xf']['visitor']['user_id'])) {
					$__compilerTemp1 .= '
						<li class="brmlShow"><a class="brmsTabHandler_' . $__templater->escape($__vars['key']) . '" href="javascript:;" data-content="brmsTabContent_' . $__templater->escape($__vars['key']) . '" data-tabid="' . $__templater->escape($__vars['key']) . '"><span>' . ($__vars['tab']['defaultTitle'] ? $__templater->escape($__vars['tab']['defaultTitle']) : $__templater->escape($__vars['tab']['title'])) . '</span></a></li>
					';
				}
				$__compilerTemp1 .= '
				';
			}
		}
		$__compilerTemp1 .= '
				';
		if (strlen(trim($__compilerTemp1)) > 0) {
			$__finalCompiled .= '
	';
			$__templater->includeCss('brms_modern_statistic.less');
			$__finalCompiled .= '
	';
			$__templater->includeJs(array(
				'src' => 'br/brms/modern-statistic.js',
				'min' => '1',
			));
			$__finalCompiled .= '
	<div class="BRMSContainer ' . $__templater->escape($__vars['modernStatistic']['displayStyle']) . ' ' . ($__vars['modernStatistic']['control_position'] ? $__templater->escape($__vars['modernStatistic']['control_position']) : ' brmsLeftTabs') . ' u-clearFix"
		data-xf-init="brms-container"
		data-previewType="' . $__templater->escape($__vars['modernStatistic']['preview_tooltip']) . '"
		data-allowCusItemLimit="' . ($__vars['modernStatistic']['item_limit']['enabled'] AND ((!$__vars['modernStatistic']['enable_cache']) ? 1 : 0)) . '"
		data-allowCusLayout="' . ($__vars['modernStatistic']['allow_change_layout'] ? 1 : 0) . '"
		data-modernStatisticId="' . ($__vars['modernStatistic']['modern_statistic_id'] ? $__templater->escape($__vars['modernStatistic']['modern_statistic_id']) : 0) . '"
		data-navPosition="' . ($__vars['modernStatistic']['control_position'] ? $__templater->escape($__vars['modernStatistic']['control_position']) : 'brmsLeftTabs') . '"
		data-useLimit="' . ($__vars['cachedStatistic']['item_limit'] AND ((!$__vars['modernStatistic']['enable_cache']) ? $__vars['cachedStatistic']['item_limit'] : '')) . '"
		data-updateInterval="' . (($__vars['modernStatistic']['auto_update'] AND (!$__vars['modernStatistic']['enable_cache'])) ? $__templater->escape($__vars['modernStatistic']['auto_update']) : 0) . '">
		<div class="brmsStatisticHeader u-clearFix">
			<div class="brmsConfigList">
				';
			if ($__vars['modernStatistic']['item_limit']['enabled'] AND (!$__vars['modernStatistic']['enable_cache'])) {
				$__finalCompiled .= '
				<div class="brmsConfigBtn brmsDropdownToggle brmsLimitList">
					<a href="javascript:;" class="brmsIco brmsIcoConfig"></a>
					<ul class="brmsDropdownMenu">
						';
				if ($__vars['modernStatistic']['item_limit']['value']) {
					$__finalCompiled .= '
							';
					if ($__templater->isTraversable($__vars['modernStatistic']['item_limit']['value'])) {
						foreach ($__vars['modernStatistic']['item_limit']['value'] AS $__vars['key'] => $__vars['numberLimit']) {
							$__finalCompiled .= '
								<li ' . (($__vars['key'] == 0) ? 'class="first"' : '') . '><a href="#" class="brmsNumberEntry" data-limit="' . $__templater->escape($__vars['numberLimit']) . '">' . $__templater->escape($__vars['numberLimit']) . ' ' . 'Entries' . '</a></li>
							';
						}
					}
					$__finalCompiled .= '
						';
				}
				$__finalCompiled .= '
					</ul>
				</div>
				';
			}
			$__finalCompiled .= '
				';
			if ($__vars['modernStatistic']['allow_manual_refresh']) {
				$__finalCompiled .= '
				<div class="brmsConfigBtn brmsRefresh"><a href="javascript:;" class="brmsIco brmsIcoRefresh"></a></div>
				';
			}
			$__finalCompiled .= '
				';
			if ($__vars['modernStatistic']['allow_change_layout']) {
				$__finalCompiled .= '
				<div class="brmsConfigBtn brmsDropdownToggle brmsLayoutList last">
					<a href="javascript:;" class="brmsIco brmsIcoLayout"></a>
					<ul class="brmsDropdownMenu">
						<li class="first"><a href="#" class="brmsLayoutChange" data-layout="brmsTopTabs">' . 'Top' . '</a></li>
						<li><a href="#" class="brmsLayoutChange" data-layout="brmsLeftTabs">' . 'Left' . '</a></li>
						<li><a href="#" class="brmsLayoutChange" data-layout="brmsRightTabs">' . 'Right' . '</a></li>
					</ul>
				</div>
				';
			}
			$__finalCompiled .= '
			</div>
			<ul class="brmsTabNav u-clearFix">
				' . $__compilerTemp1 . '
				<li class="brmsTabNavHiddenMenu last">
					<div class="brmsTabNavHidden brmsDropdownToggle">
						<a href="javascript:;" class="brmsIco brmsIcoList"></a>
						<ul class="brmsDropdownMenu">
							';
			if ($__templater->isTraversable($__vars['modernStatistic']['tabData'])) {
				foreach ($__vars['modernStatistic']['tabData'] AS $__vars['key'] => $__vars['tab']) {
					$__finalCompiled .= '
								';
					if ($__vars['tab']['active'] AND (($__vars['tab']['type'] != 'my_threads') OR $__vars['xf']['visitor']['user_id'])) {
						$__finalCompiled .= '
									<li class="brmlShow"><a class="brmsTabHandler_' . $__templater->escape($__vars['key']) . '" href="javascript:;" data-content="brmsTabContent_' . $__templater->escape($__vars['key']) . '" data-tabid="' . $__templater->escape($__vars['key']) . '"><span>' . ($__vars['tab']['defaultTitle'] ? $__templater->escape($__vars['tab']['defaultTitle']) : $__templater->escape($__vars['tab']['title'])) . '</span></a></li>
								';
					}
					$__finalCompiled .= '
							';
				}
			}
			$__finalCompiled .= '
						</ul>
					</div>
				</li>
			</ul>
		</div>

		';
			if ($__templater->isTraversable($__vars['modernStatistic']['tabData'])) {
				foreach ($__vars['modernStatistic']['tabData'] AS $__vars['key'] => $__vars['tab']) {
					$__finalCompiled .= '
			';
					if ($__vars['tab']['active'] AND ((($__vars['tab']['type'] != 'my_threads') AND ($__vars['tab']['type'] != 'your_profile_posts')) OR $__vars['xf']['visitor']['user_id'])) {
						$__finalCompiled .= '
			<div class="brmsTabContent brmsTabContent_' . $__templater->escape($__vars['key']) . ' u-clearFix" data-content="brmsTabContent_' . $__templater->escape($__vars['key']) . '">
				';
						if ($__vars['key'] == 0) {
							$__finalCompiled .= '
					';
							if ($__vars['firstTabHtml']) {
								$__finalCompiled .= $__templater->filter($__vars['firstTabHtml'], array(array('raw', array()),), true);
							} else {
								$__finalCompiled .= '<div class="brmsIcoLoader brmsIcoRefresh"></div><div class="clear"></div>';
							}
							$__finalCompiled .= '
				';
						} else {
							$__finalCompiled .= '
					<div class="brmsIcoLoader brmsIcoRefresh"></div><div class="clear"></div>
				';
						}
						$__finalCompiled .= '
			</div>
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
		$__finalCompiled .= '
';
	}
	return $__finalCompiled;
});