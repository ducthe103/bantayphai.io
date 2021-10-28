<?php
// FROM HASH: f7aa71db69652fe948bac7d66e958f7a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// MAIN HEADER ROW

.p-header
{
	.xf-publicHeader();

	a
	{
		color: inherit;
	}
}

.p-header-inner
{
	.m-pageWidth();
	.m-pageInset();
}

.p-header-content
{
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	max-width: 100%;
}

.p-header-logo
{
	vertical-align: middle;
	margin-right: @xf-elementSpacer;

	a
	{
		color: inherit;
		text-decoration: none;
	}

	&.p-header-logo--text
	{
		.xf-dt_text_logo_css();
	}

	&.p-header-logo--image
	{
		img
		{
			vertical-align: bottom;
			max-width: ' . $__templater->fn('property', array('dt_logo_max_width', ), true) . ';
			max-height: ' . $__templater->fn('property', array('dt_logo_max_height', ), true) . ';
		}
	}
}

@media (max-width: @xf-publicNavCollapseWidth)
{
	.has-js .p-header-logo
	{
		display: none;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.p-header-logo
	{
		max-width: 100px;

		&.p-header-logo--text
		{
			font-size: @xf-fontSizeLarge;
			font-weight: @xf-fontWeightNormal;
			.m-overflowEllipsis();
		}
	}
}';
	return $__finalCompiled;
});