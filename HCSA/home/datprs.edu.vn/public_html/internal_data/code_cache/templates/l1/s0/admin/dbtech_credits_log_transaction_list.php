<?php
// FROM HASH: 04dcfae0bcb6a60b86723091b099232d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Transaction Log');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	' . $__templater->button('Search logs', array(
		'href' => $__templater->fn('link', array('dbtech-credits/logs/transactions/search', ), false),
		'icon' => 'search',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['entries'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block">
		<div class="block-container">
			<div class="block-body">
				';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['entries'])) {
			foreach ($__vars['entries'] AS $__vars['entry']) {
				$__compilerTemp1 .= '
						';
				$__vars['event'] = $__vars['entry']['Event'];
				$__compilerTemp1 .= '
						';
				$__vars['currency'] = $__vars['entry']['Currency'];
				$__compilerTemp1 .= '
						' . $__templater->dataRow(array(
					'rowclass' => ($__vars['entry']['negate'] ? 'dataList-row--deleted' : ''),
				), array(array(
					'href' => $__templater->fn('link', array('dbtech-credits/logs/transactions', $__vars['entry'], ), false),
					'overlay' => 'true',
					'label' => '
									' . ($__templater->escape($__vars['event']['title']) ?: 'Unknown event') . '
								',
					'hint' => '
									' . $__templater->escape($__vars['currency']['prefix']) . $__templater->filter($__vars['entry']['amount'], array(array('number', array($__vars['currency']['decimals'], )),), true) . $__templater->escape($__vars['currency']['suffix']) . ' ' . $__templater->escape($__vars['currency']['title']) . '
								',
					'explain' => '
									<ul class="listInline listInline--bullet">
										<li>' . $__templater->fn('date_dynamic', array($__vars['entry']['dateline'], array(
					'data-full-date' => 'true',
				))) . '</li>
										<li>' . ($__vars['entry']['TargetUser'] ? $__templater->escape($__vars['entry']['TargetUser']['username']) : ($__vars['entry']['SourceUser'] ? $__templater->escape($__vars['entry']['SourceUser']['username']) : 'Unknown user')) . '</li>
									</ul>
								',
					'_type' => 'main',
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
			<div class="block-footer">
				<span class="block-footer-counter">' . $__templater->fn('display_totals', array($__vars['entries'], $__vars['total'], ), true) . '</span>
			</div>
		</div>
		' . $__templater->fn('page_nav', array(array(
			'page' => $__vars['page'],
			'total' => $__vars['total'],
			'link' => 'dbtech-credits/logs/transactions',
			'params' => array('criteria' => $__vars['criteria'], 'order' => $__vars['order'], 'direction' => $__vars['direction'], ),
			'wrapperclass' => 'block-outer block-outer--after',
			'perPage' => $__vars['perPage'],
		))) . '
	</div>
';
	} else {
		$__finalCompiled .= '
	<div class="blockMessage">' . ($__vars['criteria'] ? 'No records matched.' : 'No entries have been logged.') . '</div>
';
	}
	return $__finalCompiled;
});