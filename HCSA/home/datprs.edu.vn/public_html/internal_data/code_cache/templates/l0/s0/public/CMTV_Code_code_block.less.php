<?php
// FROM HASH: b6e9cf7f43fbc0603166f431ea4f6211
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= 'body.CMTV_Code_resizing *
{
	cursor: ns-resize !important;
}

.bbCodeBlock--code.bbCodeBlock--screenLimited
{
	.bbCodeBlock-header
	{
		display: flex;
		justify-content: center;
		align-items: center;
		
		flex-wrap: wrap;
	
		background: xf-diminish(@xf-contentAltBg, 2%);
		border-bottom: 1px solid @xf-borderColorFaint;		

		.bbCodeBlock-title
		{
			flex: 1;
		}
		
		.bbCodeBlock-actions
		{
			display: flex;
			padding-right: @xf-paddingLarge - @xf-paddingMedium;
			
			.action
			{
				color: @xf-textColorMuted;
				padding: @xf-paddingMedium;
				
				transition: color .2s;
				
				&:hover, &:focus
				{
					cursor: pointer;
					color: @xf-textColor;
				}
				
				&:active
				{
					transition: color 0s;
					color: @xf-textColorAttention;
				}
				
				&.action--hidden
				{
					display: none;
				}
			}
		}
	}
	
	.bbCodeBlock-content
	{
		max-height: @xf-CMTV_Code_code_block_max_height;
		
		&::-webkit-scrollbar
		{
			width: 0.9em;
			height: 0.9em;
		}

		&::-webkit-scrollbar-track {
			background: transparent;
		}

		&::-webkit-scrollbar-thumb
		{		
			background-color: fade(@xf-borderColor, 60%);
		}

		&::-webkit-scrollbar-corner
		{
			background-color: fade(@xf-borderColor, 60%);
		}
	}

	.bbCodeBlock-grip
	{
		display: flex;
		align-items: center;
		justify-content: center;
		
		height: 20px;
		border-top: 1px solid @xf-borderColorFaint;
		background: xf-diminish(@xf-contentAltBg, 2%);
		
		color: @xf-textColorMuted;
		transition: color .2s;
		
		&:hover
		{
			cursor: ns-resize;
			color: @xf-textColorDimmed;
		}
		
		&.resizer--hidden
		{
			display: none;
		}
	}
}';
	return $__finalCompiled;
});