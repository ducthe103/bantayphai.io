<?php
// FROM HASH: dfb97efcd5d71791bc576a9131a2dcc9
return array('macros' => array('list_filter_bar' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'filters' => '!',
		'baseLinkPath' => '!',
		'sourceFilter' => null,
		'targetFilter' => null,
		'currencyFilter' => null,
		'eventFilter' => null,
		'eventTriggerFilter' => null,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['sortOrders'] = array('dateline' => 'Ngày', 'amount' => 'Amount', );
	$__finalCompiled .= '

	<div class="block-filterBar">
		<div class="filterBar">
			';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['source_id'] AND $__vars['sourceFilter']) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array('source_id', null, )),), false), ), true) . '"
								   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Source User' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__vars['sourceFilter']['username']) . '</a></li>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['target_id'] AND $__vars['targetFilter']) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array('target_id', null, )),), false), ), true) . '"
								   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Target User' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__vars['targetFilter']['username']) . '</a></li>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['currency_id'] AND $__vars['currencyFilter']) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array('currency_id', null, )),), false), ), true) . '"
								   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Currency' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__vars['currencyFilter']['title']) . '</a></li>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['event_id'] AND $__vars['eventFilter']) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array('event_id', null, )),), false), ), true) . '"
								   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Event' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__vars['eventFilter']['title']) . '</a></li>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['event_trigger_id'] AND $__vars['eventTriggerFilter']) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array('event_trigger_id', null, )),), false), ), true) . '"
								   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Event Trigger' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__templater->method($__vars['eventTriggerFilter'], 'getTitle', array())) . '</a></li>
						';
	}
	$__compilerTemp1 .= '
						';
	if ($__vars['filters']['order'] AND $__vars['sortOrders'][$__vars['filters']['order']]) {
		$__compilerTemp1 .= '
							<li><a href="' . $__templater->fn('link', array($__vars['baseLinkPath'], null, $__templater->filter($__vars['filters'], array(array('replace', array(array('order' => null, 'direction' => null, ), )),), false), ), true) . '"
								class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Return to the default order', array(array('for_attr', array()),), true) . '">
								<span class="filterBar-filterToggle-label">' . 'Phân loại' . $__vars['xf']['language']['label_separator'] . '</span>
								' . $__templater->escape($__vars['sortOrders'][$__vars['filters']['order']]) . '
								<i class="fa ' . (($__vars['filters']['direction'] == 'asc') ? 'fa-angle-up' : 'fa-angle-down') . '" aria-hidden="true"></i>
								<span class="u-srOnly">';
		if ($__vars['filters']['direction'] == 'asc') {
			$__compilerTemp1 .= 'Tăng dần';
		} else {
			$__compilerTemp1 .= 'Giảm dần';
		}
		$__compilerTemp1 .= '</span>
							</a></li>
						';
	}
	$__compilerTemp1 .= '
					';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
				<ul class="filterBar-filters">
					' . $__compilerTemp1 . '
				</ul>
			';
	}
	$__finalCompiled .= '

			<a class="filterBar-menuTrigger" data-xf-click="menu" role="button" tabindex="0" aria-expanded="false" aria-haspopup="true">' . 'Bộ lọc' . '</a>
			<div class="menu menu--wide" data-menu="menu" aria-hidden="true"
				data-href="' . $__templater->fn('link', array($__vars['baseLinkPath'] . '/filters', null, $__vars['filters'], ), true) . '"
				data-load-target=".js-filterMenuBody">
				<div class="menu-content">
					<h4 class="menu-header">' . 'Chỉ hiển thị' . $__vars['xf']['language']['label_separator'] . '</h4>
					<div class="js-filterMenuBody">
						<div class="menu-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
					</div>
				</div>
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});