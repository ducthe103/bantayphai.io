<?php
// FROM HASH: deffaba3fc1db9fb6ef83f2dcad2e1aa
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '@_nodeList-statsCellBreakpoint: 1000px;

.block.block--category {
	.block-header {
		background: @xf-contentBg;
		padding: @xf-paddingLargest @xf-elementSpacer;
		border-top: 6px solid #3e5062;
		border-bottom: @xf-borderSize solid @xf-borderColor;
	}
}
.block.block--category' . $__templater->fn('property', array('dt_purpcat_color', ), true) . ' {
	.block-header {
		color: @xf-paletteColor2;
		border-top-color: @xf-paletteColor2;
	}
	.node-title a:hover {
		color: @xf-paletteColor2;
	}
	.node--newIndicator {
		background: @xf-paletteColor2;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_greencat_color', ), true) . ' {
	.block-header {
		color: @xf-paletteColor3;
		border-top-color: @xf-paletteColor3;
	}
	.node-title a:hover {
		color: @xf-paletteColor3;
	}
	.node--newIndicator {
		background: @xf-paletteColor3;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_darkbluecat_color', ), true) . ' {
	.block-header {
		color: @xf-paletteColor1;
		border-top-color: @xf-paletteColor1;
	}
	.node-title a:hover {
		color: @xf-paletteColor1;
	}
	.node--newIndicator {
		background: @xf-paletteColor1;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_orancat_color', ), true) . ' {
	.block-header {
		color: @xf-paletteAccent3;
		border-top-color: @xf-paletteAccent3;
	}
	.node-title a:hover {
		color: @xf-paletteAccent3;
	}
	.node--newIndicator {
		background: @xf-paletteAccent3;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_fuchcat_color', ), true) . ' {
	.block-header {
		color: @xf-paletteAccent2;
		border-top-color: @xf-paletteAccent2;
	}
	.node-title a:hover {
		color: @xf-paletteAccent2;
	}
	.node--newIndicator {
		background: @xf-paletteAccent2;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_jungcat_color', ), true) . ' {
	.block-header {
		color: #15d3b0;
		border-top-color: #15d3b0;
	}
	.node-title a:hover {
		color: #15d3b0;
	}
	.node--newIndicator {
		background: #15d3b0;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_pumpcat_color', ), true) . ' {
	.block-header {
		color: #f18470;
		border-top-color: #f18470;
	}
	.node-title a:hover {
		color: #f18470;
	}
	.node--newIndicator {
		background: #f18470;
	}
}

.block.block--category' . $__templater->fn('property', array('dt_jadecat_color', ), true) . ' {
	.block-header {
		color: #6dd69c;
		border-top-color: #6dd69c;
	}
	.node-title a:hover {
		color: #6dd69c;
	}
	.node--newIndicator {
		background: #6dd69c;
	}
}

.node
{
	& + .node
	{
		border-top: @xf-borderSize solid @xf-borderColor;
	}
}

.node-body
{
	display: table;
	table-layout: fixed;
	width: 100%;
}

.node-icon
{
	display: table-cell;
	vertical-align: middle;
	text-align: center;
	width: 65px;
	padding: @xf-paddingLargest 0 @xf-paddingLargest @xf-paddingLargest;

	i
	{
		display: block;
		line-height: 1.125;
		font-size: 20px;
		background: @xf-nodeIconReadColor;
		color: @xf-textColorEmphasized;
		border-radius: @xf-borderRadiusSmall;
		
		.node--unread & {
			background: @xf-nodeIconUnreadColor;
		}

		&:before
		{
			.m-faBase();

			padding: @xf-paddingLargest;
		}

		.node--forum &:before,
		.node--category &:before
		{
			.m-faContent(@fa-var-comments);
		}

		.node--page &:before
		{
			.m-faContent(@fa-var-file-alt);
		}

		.node--link &:before
		{
			.m-faContent(@fa-var-link);
		}
	}
}

.node-img--container
{
	display: table-cell;
	width: 65px;
	padding: @xf-paddingLargest 0 @xf-paddingLargest @xf-paddingLargest;
}

.node-img
{
	display: block;
    height: 50px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    padding: 15px;
    border-radius: 2px;
}

.node-main
{
	display: table-cell;
	vertical-align: middle;
	padding: @xf-paddingLargest;
}

.node-stats
{
	display: table-cell;
	width: 140px;
	vertical-align: middle;
	text-align: center;
	padding: @xf-paddingLargest 0;

	> dl.pairs.pairs--rows
	{
		width: 50%;
		float: left;
		margin: 0;
		padding: 0 @xf-paddingMedium/2;

		&:first-child
		{
			padding-left: 0;
		}

		&:last-child
		{
			padding-right: 0;
		}
	}

	&.node-stats--single
	{
		width: 100px;

		> dl.pairs.pairs--rows
		{
			width: 100%;
			float: none;
		}
	}

	&.node-stats--triple
	{
		width: 240px;

		> dl.pairs.pairs--rows
		{
			width: 33.333%;
		}
	}

	@media (max-width: @_nodeList-statsCellBreakpoint)
	{
		display: none;
	}
}

@_nodeExtra-avatarSize: 36px;

.node-extra
{
	display: table-cell;
	vertical-align: middle;
	width: 230px;
	padding: @xf-paddingLargest @xf-paddingLarge @xf-paddingLargest 0;

	font-size: @xf-fontSizeSmall;
}

.node-extra-row
{
	.m-overflowEllipsis();
	color: @xf-textColorMuted;
}

.node-extra-icon
{
	padding-right: @xf-paddingLarge;
	float: left;

	.avatar
	{
		.m-avatarSize(@_nodeExtra-avatarSize);
	}
}

.node-extra-placeholder
{
	font-style: italic;
}

.node-title
{
	margin: 0;
	padding: 0;
	font-size: @xf-fontSizeNormal;
	font-weight: 600;

	.node--unread &
	{
		font-weight: @xf-fontWeightHeavy;
	}
}

.node-description
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorDimmed;

	&.node-description--tooltip
	{
		.has-js:not(.has-touchevents) &
		{
			display: none;
		}
	}
}

.node-meta
{
	font-size: @xf-fontSizeSmall;
}

.node-statsMeta
{
	display: none;

	@media (max-width: @_nodeList-statsCellBreakpoint)
	{
		display: inline;
	}
}

.node-bonus
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorMuted;
	text-align: right;
}

.node-subNodesFlat
{
	font-size: @xf-fontSizeSmall;
	margin-top: .3em;

	.node-subNodesLabel
	{
		display: none;
	}
}

.node-subNodeMenu
{
	display: inline;

	.menuTrigger
	{
		color: @xf-textColorMuted;
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.node-img--container
	{
		vertical-align: middle;
		padding-top: @xf-paddingLarge;
		padding-bottom: @xf-paddingLarge;
	}
	
	.node-main
	{
		display: block;
		padding: @xf-paddingLarge @xf-paddingLargest;
	}

	.node-extra
	{
		display: block;
		width: auto;
		// this gives an equivalent of medium padding between main and extra, with main still having large
		margin-top: (@xf-paddingMedium - @xf-paddingLarge);
		padding-top: 0;
		padding-left: @xf-paddingLargest;
	}

	.node-extra-row
	{
		display: inline-block;
		vertical-align: top;
		max-width: 100%;
	}

	.node-extra-icon
	{
		display: none;
	}

	.node-description,
	.node-stats,
	.node-subNodesFlat
	{
		display: none;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.node-subNodeMenu
	{
		display: none;
	}
}

.subNodeLink
{
	&:before
	{
		display: inline-block;
		.m-faBase();
		width: 1em;
		padding-right: .3em;
		text-decoration: none;
	}

	&:hover:before
	{
		text-decoration: none;
	}

	&.subNodeLink--unread
	{
		font-weight: @xf-fontWeightHeavy;

		&:before
		{
			color: @xf-nodeIconUnreadColor;
		}
	}

	&.subNodeLink--forum:before,
	&.subNodeLink--category:before
	{
		.m-faContent(@fa-var-comments);
	}

	&.subNodeLink--page:before
	{
		.m-faContent(@fa-var-file-alt);
	}

	&.subNodeLink--link:before
	{
		.m-faContent(@fa-var-link);
	}
}

.node-subNodeFlatList
{
	.m-listPlain();
	.m-clearFix();

	> li
	{
		display: inline-block;
		margin-right: 1em;

		&:last-child
		{
			margin-right: 0;
		}
	}

	ol,
	ul,
	.node-subNodes
	{
		display: none;
	}
}

.subNodeMenu
{
	.m-listPlain();

	ol,
	ul
	{
		.m-listPlain();
	}

	.subNodeLink
	{
		display: block;
		padding: @xf-blockPaddingV @xf-blockPaddingH;
		color: @xf-menuLinkRow--color;
		text-decoration: none;
		cursor: pointer;

		&:hover
		{
			.xf-menuLinkRowSelected();
		}
	}

	li li .subNodeLink { padding-left: 1.5em; }
	li li li .subNodeLink { padding-left: 3em; }
	li li li li .subNodeLink { padding-left: 4.5em; }
	li li li li li .subNodeLink { padding-left: 6em; }
	li li li li li li .subNodeLink { padding-left: 7.5em; }
}';
	return $__finalCompiled;
});