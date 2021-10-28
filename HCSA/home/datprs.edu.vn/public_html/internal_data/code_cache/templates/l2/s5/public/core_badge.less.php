<?php
// FROM HASH: badc8e3deb3398dcf3ff2eeb514a8511
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// #################################################### BADGES ###########################

.badge,
.badgeContainer:after
{
	display: inline-block;
	min-width: 12px;
	height: 16px;
	line-height: 16px;
	font-size: 80%;
	text-align: center;
	white-space: nowrap;
	word-wrap: normal;
	font-weight: @xf-fontWeightNormal;
	padding: 0 2px;
	margin: -2px 0;
	.xf-badge();
}

.badgeContainer
{
	&:after
	{
		content: attr(data-badge);
		display: none;
	}

	&.badgeContainer--visible:after
	{
		display: inline-block;
	}
}

.badge.badge--highlighted,
.badgeContainer.badgeContainer--highlighted:after
{
	display: inline-block;
	.xf-badgeHighlighted();
}';
	return $__finalCompiled;
});