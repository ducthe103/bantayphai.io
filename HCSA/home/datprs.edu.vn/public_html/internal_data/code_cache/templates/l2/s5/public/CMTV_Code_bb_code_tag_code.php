<?php
// FROM HASH: dd058f34f6012655c13cafe2a8e611e2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->callMacro('prism_macros', 'setup', array(), $__vars) . '

';
	$__templater->includeCss('CMTV_Code_code_block.less');
	$__finalCompiled .= '

';
	$__templater->includeJs(array(
		'src' => 'CMTV/Code/code-block.js',
		'min' => '1',
		'addon' => 'CMTV/Code',
	));
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'CMTV/Code/code-block-actions.js',
		'min' => '1',
		'addon' => 'CMTV/Code',
	));
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'CMTV/Code/code-block-resizer.js',
		'min' => '1',
		'addon' => 'CMTV/Code',
	));
	$__finalCompiled .= '

<div class="bbCodeBlock bbCodeBlock--screenLimited bbCodeBlock--code ' . ($__vars['language'] ? ('language-' . $__templater->escape($__vars['language'])) : 'noLang') . ' ' . $__templater->escape($__vars['options']['class']) . '"
	 data-xf-init="CMTV-code-block">
	
	<div class="bbCodeBlock-header">
		<div class="bbCodeBlock-title">
			<span title="' . ($__vars['options']['title'] ? ($__templater->escape($__vars['config']['phrase']) ?: 'Mã') : '') . '">
				' . (($__templater->escape($__vars['options']['title']) ?: $__templater->escape($__vars['config']['phrase'])) ?: 'Mã') . $__templater->escape($__vars['xf']['language']['label_separator']) . '
			</span>
		</div>
		
		<div class="bbCodeBlock-actions">
			' . $__templater->fontAwesome('fa-expand-alt', array(
		'title' => 'Expand',
		'class' => 'action action--expand action--hidden',
		'data-xf-init' => 'tooltip',
		'data-xf-click' => 'CMTV-code-block-expand',
	)) . '
			
			' . $__templater->fontAwesome('fa-compress-alt', array(
		'title' => 'Collapse',
		'class' => 'action action--collapse action--hidden',
		'data-xf-init' => 'tooltip',
		'data-xf-click' => 'CMTV-code-block-collapse',
	)) . '
			
			' . $__templater->fontAwesome('fa-paste', array(
		'title' => 'Copy',
		'class' => 'action action--copy',
		'data-xf-init' => 'tooltip',
	)) . '
		</div>
	</div>
	
	<div class="bbCodeBlock-content" dir="ltr">
		<pre class="bbCodeCode ' . ($__vars['xf']['options']['CMTV_Code_lineNumbers_enabled'] ? ('line-numbers' . ((!$__vars['language']) ? ' language-none' : '')) : '') . '" dir="ltr" data-line="' . $__templater->escape($__vars['options']['highlight']) . '" data-xf-init="CMTV-code-block-extend" data-lang="' . ($__templater->escape($__vars['language']) ?: '') . '"><code>' . $__templater->escape($__vars['content']) . '</code></pre>
	</div>
	
	<div class="bbCodeBlock-grip resizer--hidden" data-xf-init="CMTV-code-block-resizer">
		' . $__templater->fontAwesome('fa-grip-horizontal', array(
	)) . '
	</div>
</div>';
	return $__finalCompiled;
});