<?php
// FROM HASH: a3fc55f08f3a0fca9aead15275eddc10
return array('macros' => array('setup' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeCss('bb_code.less');
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'prod' => 'xf/code_block-compiled.js',
		'dev' => 'vendor/prism/prism.min.js, xf/code_block.js',
	));
	$__finalCompiled .= '
';
	$__templater->includeCss('CMTV_Code_Prism_plugins.less');
	$__finalCompiled .= '

';
	if ($__vars['xf']['options']['CMTV_Code_lineNumbers_enabled']) {
		$__finalCompiled .= '
	';
		$__templater->includeJs(array(
			'src' => 'CMTV/Code/vendor/prism-plugins/line-numbers.min.js',
			'addon' => 'CMTV/Code',
		));
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	if ($__vars['xf']['options']['CMTV_Code_lineHighlight_enabled']) {
		$__finalCompiled .= '
	';
		$__templater->includeJs(array(
			'src' => 'CMTV/Code/vendor/prism-plugins/line-highlight.min.js',
			'addon' => 'CMTV/Code',
		));
		$__finalCompiled .= '
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