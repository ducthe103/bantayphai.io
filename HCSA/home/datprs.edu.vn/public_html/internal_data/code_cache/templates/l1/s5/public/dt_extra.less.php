<?php
// FROM HASH: 2ec49fc4cc83ab8f82dba0f01b3cc0a8
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.overlay-content {
	.block-container {
		color: @xf-linkColor;
		border-radius: 0;
		
		a:not(.button) {
			color: inherit;
		}
	}
	.menu-linkRow.menu-linkRow--alt {
		background: @xf-paletteAccent3;
		color: @xf-textColorEmphasized !important;
		border-radius: 0;
	}
}
.p-navgroup-link--conversations,
.p-navgroup-link--alerts,
.p-navgroup-link--search
{
	.p-navgroup-linkText {
		display: none;
	}
}
.featPost {
	position: relative;
	max-height: @xf-dt_featpost__height;
	background: @xf-contentBg;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(0,0,0,.1);
	overflow: hidden;
	margin-bottom: 24px;
	
	&__content {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 90px;
		background: rgba(0, 0, 0, 0.6);
		color: @xf-textColorEmphasized;
		padding: @xf-elementSpacer;
		
		h3 {
			font-size: 20px;
			font-weight: 400;
			letter-spacing: .5px;
			line-height: 1.3em;
			text-transform: uppercase;
			margin: 0 0 5px;
			
			a {
				color: inherit;
			}
		}
		
		ul {
			font-size: @xf-fontSizeSmaller;
			font-weight: 300;
		}
		
		.listInline.listInline--bullet > li::before {
			content: "|";
			padding: 0 4px;
		}
	}
}
.featPosts {
	background: @xf-contentBg;
	border-top: 6px solid @xf-paletteAccent1;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(0,0,0,.1);
	margin-bottom: 24px;
	
	&__head {
		font-weight: 300;
		padding: @xf-paddingLargest @xf-elementSpacer;
		border-bottom: @xf-borderSize solid @xf-borderColor;

		span {
			color: @xf-paletteAccent1;
			font-size: 18px;
			font-weight: 600;
			text-transform: uppercase;
			padding-right: 6px;
		}
	}
	&__container {
		display: flex;
		flex-wrap: wrap;
		align-items: stretch;
		padding: 5px;
	}
	&__item {
		flex: 0 0 25%;
		max-width: 25%;
		padding: @xf-paddingLargest;
		
		img {
			height: 127px;
			
			@media (max-width: 800px) {
				height: 180px;
			}
		}
		
		h3 {
			font-size: @xf-fontSizeNormal;
			font-weight: @xf-fontWeightHeavy;
			letter-spacing: .5px;
			line-height: 1.3em;
			margin: 10px 0 0;
			
			a {
				color: #444651;
				
				&:hover {
					color: @xf-paletteAccent1;
				}
			}
		}
		
		ul {
			color: rgba(0,0,0,.5);
			font-size: @xf-fontSizeSmall;
		}
		
		@media (max-width: 800px) {
			flex: 0 0 50%;
			max-width: 50%;
			text-align: center;
		}
	}
}
.node-extra {
	.lastpost--avatar {
		margin-right: @xf-paddingLarge;
	}
}
.p-body-sidebar {
	.block-row {
		padding: @xf-paddingLargest @xf-elementSpacer;
		border-bottom: @xf-borderSize solid @xf-borderColor;
		
		&:last-child {
			border-bottom: none;
		}
	}
	.block-footer {
		padding: @xf-paddingLarge;
		border-top: none;
	}
}
.structItem-iconContainer .structItem-secondaryIcon {
	display: none;
}
.structItem-cell--meta {
	.pairs--justified {
		float: left;
		
		> dt {
			float: none;
			font-size: 12px;
			margin-right: 0;
			
			&::after {
				display: none;
			}
		}
		> dd {
			float: none;
			color: @xf-textColor;
			font-size: 12px;
			font-weight: 600;
			text-align: center;
		}
		&.structItem-minor {
			float: right;
			
			> dd {
				text-align: center;
			}
		}
	}
}
@media (max-width: @xf-responsiveNarrow)
{
	.featPosts
	{
		display: none;
	}
}';
	return $__finalCompiled;
});