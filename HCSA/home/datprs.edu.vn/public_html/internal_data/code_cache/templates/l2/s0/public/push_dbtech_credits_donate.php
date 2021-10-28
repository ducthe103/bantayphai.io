<?php
// FROM HASH: e18dec0e289ba5634a87109d69197072
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['content']['amount'] < 0) {
		$__finalCompiled .= '
	' . 'You donated ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' to ' . ($__templater->escape($__vars['user']['username']) ?: 'N/A') . '.' . '
';
	} else {
		$__finalCompiled .= '
	' . '' . ($__templater->escape($__vars['user']['username']) ?: 'N/A') . ' donated ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' to you.' . '
';
	}
	$__finalCompiled .= '
';
	if ($__vars['content']['message']) {
		$__finalCompiled .= 'Nội dung' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['content']['message']);
	}
	$__finalCompiled .= '
<push:url>' . $__templater->fn('link', array('canonical:dbtech-credits/currency', $__vars['content']['Currency'], ), true) . '</push:url>';
	return $__finalCompiled;
});