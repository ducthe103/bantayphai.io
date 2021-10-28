<?php
// FROM HASH: f2180bdeca588e11b6bc6f8be75d8bd1
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['content']['source_user_id'] == $__vars['content']['user_id']) {
		$__finalCompiled .= '
	';
		if ($__vars['content']['amount'] < 0) {
			$__finalCompiled .= '
		' . 'You removed ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' from your account.' . '
	';
		} else {
			$__finalCompiled .= '
		' . 'You added ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' to your account.' . '
	';
		}
		$__finalCompiled .= '
';
	} else {
		$__finalCompiled .= '	
	';
		if ($__vars['content']['amount'] < 0) {
			$__finalCompiled .= '
		' . '' . ($__templater->escape($__vars['content']['SourceUser']['username']) ?: 'N/A') . ' removed ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' from your account.' . '
	';
		} else {
			$__finalCompiled .= '
		' . '' . ($__templater->escape($__vars['content']['SourceUser']['username']) ?: 'N/A') . ' added ' . (((($__templater->escape($__vars['content']['Currency']['prefix']) . $__templater->escape($__templater->method($__vars['content']['Currency'], 'getFormattedValue', array($__vars['amount'], )))) . $__templater->escape($__vars['content']['Currency']['suffix'])) . ' ') . $__templater->escape($__vars['content']['Currency']['title'])) . ' to your account.' . '
	';
		}
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '
<push:url>' . $__templater->fn('link', array('canonical:dbtech-credits/currency', $__vars['content']['Currency'], ), true) . '</push:url>';
	return $__finalCompiled;
});