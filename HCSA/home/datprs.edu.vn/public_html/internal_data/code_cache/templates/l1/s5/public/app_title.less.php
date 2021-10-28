<?php
// FROM HASH: 327228608b59cea4c8e66054df89f227
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.p-title
{
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	max-width: 100%;
	margin-bottom: -5px;

	&.p-title--noH1
	{
		flex-direction: row-reverse;
	}
}

.p-title-value
{
	padding: 0;
	margin: 0 0 2px 0;
	font-size: @xf-fontSizeLargest;
	font-weight: 600;
	color: @xf-linkColor;
	text-transform: uppercase;
	min-width: 0;
	margin-right: auto;
}

.p-title-pageAction
{
	margin-bottom: 5px;
}

.p-description
{
	margin: 5px 0 0;
	padding: 0;
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorMuted;
}

@media (max-width: @xf-responsiveNarrow)
{
	.p-title-value
	{
		font-size: @xf-fontSizeLarger;
	}
}';
	return $__finalCompiled;
});