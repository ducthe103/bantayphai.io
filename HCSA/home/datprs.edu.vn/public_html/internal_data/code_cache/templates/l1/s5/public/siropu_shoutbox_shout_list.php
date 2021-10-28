<?php
// FROM HASH: 816b4a8f1a745923572fa8996331f038
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->isTraversable($__vars['shoutbox']['shouts'])) {
		foreach ($__vars['shoutbox']['shouts'] AS $__vars['shout']) {
			$__finalCompiled .= '
	';
			$__vars['isBanned'] = ($__vars['shout']['User'] ? $__templater->method($__vars['shout']['User'], 'isBannedSiropuShoutbox', array()) : false);
			$__finalCompiled .= '
	';
			$__vars['rowClass'] = ($__vars['isBanned'] ? 'siropuShoutboxBanned' : ($__templater->method($__vars['shout'], 'isTagged', array()) ? 'siropuShoutboxTagged' : ''));
			$__finalCompiled .= '
	<li data-id="' . $__templater->escape($__vars['shout']['shout_id']) . '"' . ($__vars['rowClass'] ? ((' class="' . $__templater->escape($__vars['rowClass'])) . '"') : '') . '>
		';
			if ($__vars['xf']['options']['siropuShoutboxUserAvatar']) {
				$__finalCompiled .= '
			' . $__templater->fn('avatar', array($__vars['shout']['User'], 'xxs', false, array(
					'defaultname' => 'Guest',
					'itemprop' => 'image',
				))) . '
		';
			}
			$__finalCompiled .= '
		';
			if ($__vars['xf']['options']['siropuShoutboxUserTag'] AND (($__vars['xf']['visitor']['user_id'] != $__vars['shout']['shout_user_id']) AND (!$__vars['isBanned']))) {
				$__finalCompiled .= '
			<a role="button" class="siropuShoutboxTag" title="' . $__templater->filter('Tag user', array(array('for_attr', array()),), true) . '" data-xf-click="siropu-shoutbox-user-tag">@</a>
		';
			}
			$__finalCompiled .= '
		' . $__templater->fn('username_link', array($__vars['shout']['User'], true, array(
				'defaultname' => 'Guest',
			))) . ':
		<span class="siropuShoutboxMessage">' . ($__vars['xf']['options']['siropuShoutboxAllowBBCodes'] ? $__templater->fn('bb_code', array($__templater->filter($__vars['shout']['shout_message'], array(array('censor', array()),), false), 'shoutbox_message', $__vars['shout']['User'], ), true) : $__templater->filter($__vars['shout']['shout_message'], array(array('censor', array()),), true)) . '</span>
		';
			if ($__vars['options']['hideTimestamp'] == false) {
				$__finalCompiled .= '
			' . $__templater->fn('date_dynamic', array($__vars['shout']['shout_date'], array(
				))) . '
		';
			}
			$__finalCompiled .= '
		';
			$__compilerTemp1 = '';
			$__compilerTemp1 .= '
					';
			if ($__templater->method($__vars['shout'], 'canEdit', array())) {
				$__compilerTemp1 .= '
						<a href="' . $__templater->fn('link', array('shoutbox/edit', $__vars['shout'], ), true) . '" data-xf-click="overlay" title="' . $__templater->filter('Edit', array(array('for_attr', array()),), true) . '">' . $__templater->fontAwesome('fa-edit', array(
				)) . '</a>
					';
			}
			$__compilerTemp1 .= '
					';
			if ($__templater->method($__vars['shout'], 'canDelete', array())) {
				$__compilerTemp1 .= '
						<a href="' . $__templater->fn('link', array('shoutbox/delete', $__vars['shout'], ), true) . '" data-xf-click="overlay" title="' . $__templater->filter('Delete', array(array('for_attr', array()),), true) . '">' . $__templater->fontAwesome('fa-trash', array(
				)) . '</a>
					';
			}
			$__compilerTemp1 .= '
					';
			if ($__templater->method($__vars['shout'], 'canBan', array())) {
				$__compilerTemp1 .= '
						';
				if ($__vars['isBanned']) {
					$__compilerTemp1 .= '
							<a href="' . $__templater->fn('link', array('shoutbox/unban', null, array('user_id' => $__vars['shout']['shout_user_id'], ), ), true) . '" data-xf-click="overlay" title="' . $__templater->filter('Lift ban', array(array('for_attr', array()),), true) . '">' . $__templater->fontAwesome('fa-user-minus', array(
					)) . '</a>
						';
				} else {
					$__compilerTemp1 .= '
							<a href="' . $__templater->fn('link', array('shoutbox/ban', null, array('user_id' => $__vars['shout']['shout_user_id'], ), ), true) . '" data-xf-click="overlay" title="' . $__templater->filter('Ban', array(array('for_attr', array()),), true) . '">' . $__templater->fontAwesome('fa-user-times', array(
					)) . '</a>
						';
				}
				$__compilerTemp1 .= '
					';
			}
			$__compilerTemp1 .= '
				';
			if (strlen(trim($__compilerTemp1)) > 0) {
				$__finalCompiled .= '
			<span class="siropuShoutboxActions">
				' . $__compilerTemp1 . '
			</span>
		';
			}
			$__finalCompiled .= '
	</li>
';
		}
	}
	return $__finalCompiled;
});