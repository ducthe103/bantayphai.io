<?php
// FROM HASH: 6f583f7d318b0e7f8ba41c19307595ae
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Archive');
	$__finalCompiled .= '

';
	$__templater->includeCss('siropu_shoutbox.less');
	$__templater->inlineCss('
	.siropuShoutboxShouts
	{
		height: auto;
	}
	.siropuShoutboxTag
	{
		display: none;
	}
');
	$__finalCompiled .= '

';
	$__templater->inlineJs('
	$(function()
	{
		$(\'.siropuShoutboxShouts > li\').on(\'mouseover mouseout\', function()
		{
			$(this).find(\'.siropuShoutboxActions\').toggle();
		});
	});
');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body block-row">
			' . $__templater->formTextBox(array(
		'name' => 'keywords',
		'placeholder' => 'Keywords' . $__vars['xf']['language']['ellipsis'],
		'type' => 'search',
		'class' => 'input--inline',
	)) . '
			' . $__templater->formTextBox(array(
		'name' => 'username',
		'placeholder' => 'User name' . $__vars['xf']['language']['ellipsis'],
		'type' => 'search',
		'data-xf-init' => 'auto-complete',
		'data-single' => 'true',
		'class' => 'input--inline',
	)) . '
			' . $__templater->button('', array(
		'type' => 'submit',
		'icon' => 'search',
	), '', array(
	)) . '
		</div>
	</div>
', array(
		'action' => $__templater->fn('link', array('shoutbox/archive', ), false),
		'class' => 'block',
	)) . '

<div id="siropuShoutboxArchive" class="siropuShoutbox block">
    <div class="block-container">
		<div class="block-body">
			<ol class="siropuShoutboxShouts">
				' . $__templater->includeTemplate('siropu_shoutbox_shout_list', $__vars) . '
			</ol>
		</div>
	</div>
	 ' . $__templater->fn('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'shoutbox/archive',
		'params' => $__vars['params'],
		'wrapperclass' => 'block-outer block-outer--after',
		'perPage' => $__vars['perPage'],
	))) . '
</div>';
	return $__finalCompiled;
});