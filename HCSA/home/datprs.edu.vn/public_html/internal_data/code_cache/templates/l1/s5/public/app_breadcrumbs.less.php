<?php
// FROM HASH: 83f301227326048e3bcab766a1925837
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.p-breadcrumbs
{
	.m-listPlain();
	.m-clearFix();

	margin-bottom: 5px;
	line-height: 1.5;

	&.p-breadcrumbs--bottom
	{
		margin-top: @xf-elementSpacer;
		margin-bottom: 0;
	}

	> li
	{
		float: left;
		margin-right: .5em;
		font-size: @xf-fontSizeSmall;

		a
		{
			display: inline-block;
			vertical-align: bottom;
			max-width: 300px;
			.m-overflowEllipsis();
		}

		&:after,
		&:before
		{
			.m-faBase();
			font-size: 90%;
			color: @xf-textColorMuted;
		}

		&:after
		{
			.m-faContent(@fa-var-angle-right, false ltr);
			.m-faContent(@fa-var-angle-left, false, rtl);
			margin-left: .5em;
		}
		
		&:first-child {
			&:before {
				.m-faContent(@fa-var-home);
				font-size: 14px;
				margin-right: .5em;
			}
		}

		&:last-child
		{
			margin-right: 0;

			a
			{
				font-weight: 600;
			}
		}
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.p-breadcrumbs > li a
	{
		max-width: 200px;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.p-breadcrumbs
	{
		> li
		{
			display: none;

			&:last-child
			{
				display: block;
			}

			a
			{
				max-width: 90vw;
			}

			&:after
			{
				display: none;
			}

			&:before
			{
				.m-faContent(@fa-var-chevron-left, false, ltr);
				.m-faContent(@fa-var-chevron-right, false, rtl);
				margin-right: .5em;
			}
		}
	}
}';
	return $__finalCompiled;
});