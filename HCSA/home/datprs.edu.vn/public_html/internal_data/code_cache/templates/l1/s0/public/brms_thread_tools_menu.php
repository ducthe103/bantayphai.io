<?php
// FROM HASH: e7b62a00beee858a1a4e48406faf3a72
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['thread'], 'canPromoteThread', array())) {
		$__finalCompiled .= '
	<a href="' . $__templater->fn('link', array('threads/brms-promote', $__vars['thread'], ), true) . '" data-xf-click="overlay" class="menu-linkRow">' . 'Promote Thread' . '</a>
';
	}
	return $__finalCompiled;
});