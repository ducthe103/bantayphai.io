<?php
// FROM HASH: c1eafb3384558e44cf4a3b670f0c2917
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__vars['providerData']['profile_link']) {
		$__finalCompiled .= '
	';
		if ($__vars['providerData']['avatar_url']) {
			$__finalCompiled .= '
		<a href="' . $__templater->escape($__vars['providerData']['profile_link']) . '" target="_blank">
			<img src="' . $__templater->escape($__vars['providerData']['avatar_url']) . '" width="48" alt="" />
		</a>
	';
		}
		$__finalCompiled .= '
	<div><a href="' . $__templater->escape($__vars['providerData']['profile_link']) . '" target="_blank">' . ($__templater->escape($__vars['providerData']['username']) ?: 'Tài khoản không xác định') . '</a></div>
	';
	} else {
		$__finalCompiled .= '
	';
		if ($__vars['providerData']['avatar_url']) {
			$__finalCompiled .= '
		<img src="' . $__templater->escape($__vars['providerData']['avatar_url']) . '" width="48" alt="" />
	';
		}
		$__finalCompiled .= '
	<div>' . ($__templater->escape($__vars['providerData']['username']) ?: 'Tài khoản không xác định') . '</div>
';
	}
	return $__finalCompiled;
});