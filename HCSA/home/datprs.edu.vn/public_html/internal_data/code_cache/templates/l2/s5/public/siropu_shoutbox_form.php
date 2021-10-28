<?php
// FROM HASH: 14249d5616146c15ef28c8a7b92093cd
return array('macros' => array('submit' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'class' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['xf']['visitor'], 'canUseSiropuShoutbox', array())) {
		$__finalCompiled .= '
		<form action="' . $__templater->fn('link', array('shoutbox/submit', ), true) . '"' . ($__vars['class'] ? ((' class="' . $__templater->escape($__vars['class'])) . '"') : '') . ' data-xf-init="siropu-shoutbox-submit">
			<span>
				' . $__templater->formTextBox(array(
			'name' => 'shout',
			'placeholder' => 'What\'s on your mind?',
			'maxlength' => $__vars['xf']['options']['siropuShoutboxShoutMaxLength'],
			'autocomplete' => 'off',
			'data-xf-init' => 'user-mentioner',
		)) . '
				';
		if ($__vars['xf']['options']['siropuShoutboxAllowBBCodes'] AND $__vars['xf']['options']['siropuShoutboxSmilieButton']) {
			$__finalCompiled .= '
					';
			$__templater->includeCss('editor.less');
			$__finalCompiled .= '
					';
			if ($__vars['xf']['options']['siropuShoutboxEmojiList']) {
				$__finalCompiled .= '
						' . $__templater->button('', array(
					'class' => 'button--iconOnly button--link',
					'title' => 'Mặt cười',
					'data-xf-init' => 'tooltip',
					'data-xf-click' => 'menu',
					'aria-expanded' => 'false',
					'aria-haspopup' => 'true',
					'fa' => 'fal fa-smile',
				), '', array(
				)) . '
						<div class="menu menu--emoji" data-menu="menu" aria-hidden="true"
							data-xf-init="siropu-shoutbox-smilies-emoji"
							data-href="' . $__templater->fn('link', array('editor/smilies-emoji', ), true) . '"
							data-load-target=".js-xfSmilieMenuBody">
							<div class="menu-content">
								<div class="js-xfSmilieMenuBody">
									<div class="menu-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
								</div>
							</div>
						</div>
					';
			} else {
				$__finalCompiled .= '
						' . $__templater->button('', array(
					'class' => 'button--iconOnly button--link',
					'title' => 'Mặt cười',
					'data-xf-init' => 'tooltip siropu-shoutbox-smilies',
					'fa' => 'fal fa-smile',
				), '', array(
				)) . '
					';
			}
			$__finalCompiled .= '
				';
		}
		$__finalCompiled .= '
				' . $__templater->button('', array(
			'type' => 'submit',
			'class' => 'button--iconOnly button--link',
			'title' => 'Shout!',
			'data-xf-init' => 'tooltip',
			'fa' => 'fal fa-bullhorn',
		), '', array(
		)) . '
			</span>
		</form>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});