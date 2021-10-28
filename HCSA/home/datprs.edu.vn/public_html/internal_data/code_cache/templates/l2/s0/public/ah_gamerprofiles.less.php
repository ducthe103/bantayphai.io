<?php
// FROM HASH: 334fd94638175e0535496e6dceee1931
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.ah-gp-icons-container {
	.xf-ahGPIconsContainer()
	
	a:hover {
		text-decoration: none;
	}
	
	span {
		cursor: pointer;
	}
}

.ah-gp-icon {
	font-size: @xf-ahGPIconFontSize;
	
	.fa-playstation { color: @xf-ahGPColorPlayStation }
	.fa-xbox { color: @xf-ahGPColorXbox }
	.fa-steam { color: @xf-ahGPColorSteam }
	.fa-twitch { color: @xf-ahGPColorTwitch }
	.fa-youtube { color: @xf-ahGPColorYouTube }
	.fa-discord { color: @xf-ahGPColorDiscord }
	.fa-facebook { color: @xf-ahGPColorFacebook }
	.fa-twitter { color: @xf-ahGPColorTwitter }
	.fa-skype { color: @xf-ahGPColorSkype }
	
	&--origin svg { 
		width: @xf-ahGPOriginWidth;
		height: @xf-ahGPOriginHeight;
		fill: @xf-ahGPColorOrigin;
		
		/* This aligns the icon to fit with the others. You may have to change this. */
		margin-bottom: -2px;
	}
	
	&--battlenet svg { 
		width: @xf-ahGPBattlenetWidth;
		height: @xf-ahGPBattlenetHeight;
		fill: @xf-ahGPColorBattlenet;
		
		/* This aligns the icon to fit with the others. You may have to change this. */
		margin-bottom: -3px;
	}
	
	&--epicgames svg { 
		width: @xf-ahGPEpicGamesWidth;
		height: @xf-ahGPEpicGamesHeight;
		fill: @xf-ahGPColorEpicGames;
		
		/* This aligns the icon to fit with the others. You may have to change this. */
		margin-bottom: -1px;
	}
	
	&--oculus svg { 
		width: @xf-ahGPOculusWidth;
		height: @xf-ahGPOculusHeight;
		fill: @xf-ahGPColorOculus;
		
		/* This aligns the icon to fit with the others. You may have to change this. */
		margin-bottom: -1px;
	}
	
	&--secondlife svg { 
		width: @xf-ahGPSecondLifeWidth;
		height: @xf-ahGPSecondLifeHeight;
		fill: @xf-ahGPColorSecondLife;
		
		/* This aligns the icon to fit with the others. You may have to change this. */
		margin-bottom: -1px;
	}
	
	&--mixer svg { 
		width: @xf-ahGPMixerWidth;
		height: @xf-ahGPMixerHeight;
		fill: @xf-ahGPColorMixer;
	}
}

.ah-gp-message .ah-gp-icons-container {
	.xf-ahGPMessage()
}

.ah-gp-memberTooltip {
	.xf-ahGPMemberTooltip()
}

.ah-gp-profile {
	display: none;
  	position: absolute;
  	z-index: 9999;
	min-width: 425px;
	left: 20px;
	margin-top: @xf-ahGPGamerCardMargin !important;
}

.ah-gp-code-image {
	padding-top: 10px;
}';
	return $__finalCompiled;
});