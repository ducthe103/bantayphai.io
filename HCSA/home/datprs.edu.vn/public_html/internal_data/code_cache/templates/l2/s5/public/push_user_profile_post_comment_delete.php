<?php
// FROM HASH: e21c137ef4ee55c0d2c5849138c7cc92
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'Your comment on <a href="{link}">' . $__templater->escape($__vars['extra']['postUser']) . '\'s profile post</a> was deleted.' . '
';
	if ($__vars['extra']['reason']) {
		$__finalCompiled .= 'Lý do' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['extra']['reason']);
	}
	$__finalCompiled .= '
<push:url>' . $__templater->fn('base_url', array($__vars['extra']['profilePostLink'], 'canonical', ), true) . '</push:url>';
	return $__finalCompiled;
});