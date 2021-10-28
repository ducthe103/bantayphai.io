<?php
// FROM HASH: cc099ad6a66a3a420e21b527f30c949a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// #### Touch Enhancements ####
a:link {
	-webkit-tap-highlight-color: fade(@xf-paletteColor1, 30%);
}

// #### Text Selection ####
::selection { background-color: @xf-paletteColor1;color: #fff; }
::-moz-selection { background-color: @xf-paletteColor1;color: #fff; }

// #### Color Select in Redactor ####
.fr-popup .fr-color-set > span:hover {
	transform: scale(1.7,1.7);
}

.editorSmilies .smilie {
	opacity: 0.5;
	.m-transition(all, 0.2s);
}
.editorSmilies .smilie:hover {
	opacity: 1.0;
	transform: scale(1.3);
}
.p-breadcrumbs > li:last-child::after {
	display: none;
}
.animate-pulse {
    -webkit-animation: pulse 2s infinite linear;
    animation: pulse 2s infinite linear;
}
@keyframes pulse {
  0% {transform: scale(1);}
  15% {transform: scale(1.3);}
  30% {transform: scale(1);}
  45% {transform: scale(1.3);}
  60% {transform: scale(1);} 
}

.p-breadcrumbs--container,
.p-breadcrumbs.p-breadcrumbs--bottom {
	.xf-contentBase();
	.xf-blockBorder();
}
.p-breadcrumbs--container {
	margin-bottom: @xf-elementSpacer;
	
	.p-breadcrumbs {
		margin-bottom: 0;
	}
}
.p-breadcrumbs--container--inner {
	display: flex;
	align-items: center;
	width: 100%;
	max-width: @xf-pageWidthMax;
	padding: @xf-paddingLargest;
	margin: 0 auto;
}
.block.block--treeEntryChooser {
	.block-container {
		margin: @xf-paddingLarge @xf-paddingLargest;
	}
}';
	return $__finalCompiled;
});