<?php
// FROM HASH: ae6f2a5cabfd0e7affb3856e26ad3047
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.m-userBannerVariation(@color; @bg; @border: false)
{
	color: @color;
	background: @bg;
	border-color: xf-intensify(@bg, 10%);

	& when (iscolor(@border))
	{
		border-color: @border;
	}
}

.userBanner
{
	font-size: 75%;
	font-weight: @xf-fontWeightNormal;
	font-style: normal;
	padding: 1px @xf-paddingMedium;
	border: 1px solid transparent;
	border-radius: @xf-borderRadiusSmall;
	text-align: center;
	display: inline-block;

	strong
	{
		font-weight: inherit;
	}

	// variations
	&.userBanner--hidden
	{
		background: none;
		border: none;
		box-shadow: none;
	}

	&.userBanner--staff,
	&.userBanner--primary
	{
		.m-userBannerVariation(@xf-textColorEmphasized, @xf-paletteColor1, @xf-paletteColor1);
	}

	&.userBanner--accent
	{
		.m-userBannerVariation(@xf-textColorEmphasized, @xf-paletteAccent1, @xf-paletteAccent1);
	}

	&.userBanner--red { .m-userBannerVariation(white, #d80000); }
	&.userBanner--green { .m-userBannerVariation(white, green); }
	&.userBanner--olive { .m-userBannerVariation(white, olive); }
	&.userBanner--lightGreen { .m-userBannerVariation(black, #ccf9c8, #bee8ba); }
	&.userBanner--blue { .m-userBannerVariation(white, #0008e3); }
	&.userBanner--royalBlue { .m-userBannerVariation(white, royalblue); }
	&.userBanner--skyBlue { .m-userBannerVariation(white, #7cc3e0); }
	&.userBanner--gray { .m-userBannerVariation(white, gray); }
	&.userBanner--silver { .m-userBannerVariation(black, silver); }
	&.userBanner--yellow { .m-userBannerVariation(black, #ffff91, #e6e687); }
	&.userBanner--orange { .m-userBannerVariation(black, #ffcb00); }
}';
	return $__finalCompiled;
});