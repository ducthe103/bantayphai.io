<?php
// FROM HASH: 8bf18e65be12eba9816b6436b03f33d0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('' . $__templater->escape($__vars['user']['username']) . '\'s gamer cards');
	$__finalCompiled .= '
';
	$__templater->includeCss('ah_gamerprofiles.less');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['user']['username'])), $__templater->fn('link', array('members', $__vars['user'], ), false), array(
	));
	$__finalCompiled .= '

';
	if (($__vars['user']['Profile']['custom_fields']['ah_playstation'] OR $__vars['user']['Profile']['custom_fields']['ah_xbox']) OR $__vars['user']['Profile']['custom_fields']['ah_steam']) {
		$__finalCompiled .= '
	<div class="block-container">
		<div class="block-body">

			';
		if ($__vars['user']['Profile']['custom_fields']['ah_playstation']) {
			$__finalCompiled .= '
				' . $__templater->formTextBoxRow(array(
				'name' => 'ah_playstation',
				'type' => 'text',
				'style' => 'display:none;',
				'disabled' => 'disabled',
			), array(
				'label' => 'PSN: ' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']),
				'html' => '
						<a href="https://gamercards.exophase.com/psn/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '" target="_blank">
							<img src="//card.exophase.com/psn/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '.png" class="ah-gp-code-image" />
						</a>

						' . $__templater->callMacro('share_page_macros', 'share_clipboard_input', array(
				'label' => 'Signature code',
				'text' => '[URL=\'https://gamercards.exophase.com/psn/user/' . $__vars['user']['Profile']['custom_fields']['ah_playstation'] . '\'][IMG]https://card.exophase.com/psn/' . $__vars['user']['Profile']['custom_fields']['ah_playstation'] . '.png[/IMG][/URL]',
			), $__vars) . '
					',
			)) . '
			';
		}
		$__finalCompiled .= '

			';
		if ($__vars['user']['Profile']['custom_fields']['ah_xbox']) {
			$__finalCompiled .= '
				' . $__templater->formTextBoxRow(array(
				'name' => 'ah_xbox',
				'type' => 'text',
				'style' => 'display:none;',
				'disabled' => 'disabled',
			), array(
				'label' => 'XBL: ' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']),
				'html' => '
						<a href="https://gamercards.exophase.com/xbox/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '" target="_blank">
							<img src="//card.exophase.com/xbox/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '.png" class="ah-gp-code-image" />
						</a>

						' . $__templater->callMacro('share_page_macros', 'share_clipboard_input', array(
				'label' => 'Signature code',
				'text' => '[URL=\'https://gamercards.exophase.com/xbox/user/' . $__vars['user']['Profile']['custom_fields']['ah_xbox'] . '\'][IMG]https://card.exophase.com/xbox/' . $__vars['user']['Profile']['custom_fields']['ah_xbox'] . '.png[/IMG][/URL]',
			), $__vars) . '
					',
			)) . '
			';
		}
		$__finalCompiled .= '

			';
		if ($__vars['user']['Profile']['custom_fields']['ah_steam']) {
			$__finalCompiled .= '
				' . $__templater->formTextBoxRow(array(
				'name' => 'ah_steam',
				'type' => 'text',
				'style' => 'display:none;',
				'disabled' => 'disabled',
				'target' => '_blank',
			), array(
				'label' => 'Steam: ' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']),
				'html' => '
						<a href="https://gamercards.exophase.com/steam/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '">
							<img src="//card.exophase.com/steam/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '.png" class="ah-gp-code-image" />
						</a>

						' . $__templater->callMacro('share_page_macros', 'share_clipboard_input', array(
				'label' => 'Signature code',
				'text' => '[URL=\'https://gamercards.exophase.com/steam/user/' . $__vars['user']['Profile']['custom_fields']['ah_steam'] . '\'][IMG]https://card.exophase.com/steam/' . $__vars['user']['Profile']['custom_fields']['ah_steam'] . '.png[/IMG][/URL]',
			), $__vars) . '
					',
			)) . '
			';
		}
		$__finalCompiled .= '

		</div>
	</div>
';
	}
	return $__finalCompiled;
});