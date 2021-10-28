<?php
// FROM HASH: 64e8b2320e62ef814c2c3510b993063e
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.BRMSContainer
{
	color: #333;
	margin: auto auto 10px;
	width: 100%;
	ul, ol{
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.brmsStatisticHeader
	{
		display: block;
		margin: auto 0 !important;
	}

	&.brmsLeftTabs .brmsStatisticHeader,
	&.brmsRightTabs .brmsStatisticHeader{
		float: left;
		width: 151px;
		position: relative;
		top: 0;
		z-index: 10;
	}
	&.brmsRightTabs .brmsStatisticHeader{
		float: right;
	}
	&.brmsTopTabs .brmsStatisticHeader{
		height: 39px;
		padding: 0 13px;
	}

	.brmlShow{
		display:block;
	}
	.brmlHide{
		display:none;
	}

	.brmsConfigList{
		text-align: center;
	}

	&.brmsLeftTabs .brmsConfigList,
	&.brmsRightTabs .brmsConfigList{
		margin-bottom:10px;
	}
	&.brmsTopTabs .brmsConfigList{
		float:right;
	}

	.brmsConfigList .brmsConfigBtn
	{
		background-color: #FAFAFA;
		padding: 8px 13px 7px;
		margin: 2px 0;
		border: 1px solid #D5D5D5;
		border-radius: 2px;
		display: inline-block;
		cursor: pointer;
		font-weight: bold;
		line-height: 13px;
		color: #686868;
		box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.2);
		background: -moz-linear-gradient(top, #FFF 0%, #F5F5F5 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFF), color-stop(100%,#F5F5F5));
		background: -webkit-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
		background: -o-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
		background: -ms-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
		background: linear-gradient(top, #FFF 0%,#F5F5F5 100%);
	}

	.brmsConfigBtn:hover
	{
		background: #f6f6f6;
	}
	&.brmsRightTabs .brmsConfigList .brmsConfigBtn
	{
		margin-right:0px;
		margin-left:5px;
	}
	.brmsConfigList .brmsConfigBtn.last
	{
		margin-right:0;
	}

	ul.brmsTabNav
	{

	}

	&.brmsLeftTabs ul.brmsTabNav{
		border-bottom-left-radius: 12px;
		border-top-left-radius: 12px;
		border: 1px solid #DDD;
		border-right-width: 0;
	}
	&.brmsRightTabs ul.brmsTabNav{
		border-bottom-right-radius: 12px;
		border-top-right-radius: 12px;
		border: 1px solid #DDD;
		border-left-width: 0;
	}
	&.brmsTopTabs ul.brmsTabNav{
		height: 39px;
	}
	ul.brmsTabNav > li
	{
		font-size: 1.11em;
		background-color: whitesmoke;
		margin: auto;
		border: 0px solid #DDD;
		list-style-type: none;
		display: block;
		text-shadow: 0 0 0 transparent, 0px 1px 1px #F2F1F0;
		background: -moz-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #f2f2f2));
		background: -webkit-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
		background: -o-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
		background: -ms-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
		background: linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
	}
	&.brmsRightTabs ul.brmsTabNav > li{
		border-bottom-width: 1px;
		border-left-width: 1px;
	}
	&.brmsLeftTabs ul.brmsTabNav > li{
		border-right-width: 1px;
		border-bottom-width: 1px;
	}
	&.brmsTopTabs ul.brmsTabNav > li{
		border-bottom: none;
		float:left;
		border-left-width: 1px;
		border-top-width: 1px;
		position: relative;
	}
	ul.brmsTabNav > li.current
	{
		color: black;
		border-right-width: 0px;
		background: white !important;
		box-shadow: inset 0 0 35px 5px #fafbfd;
	}
	&.brmsLeftTabs ul.brmsTabNav > li.current
	{
		border-right: none;
		z-index: 10;
	}
	&.brmsRightTabs ul.brmsTabNav > li.current
	{
		border-left: none;
		z-index: 10;
	}
	&.brmsLeftTabs ul.brmsTabNav > li.first{
		border-top-left-radius: 10px;
	}
	&.brmsRightTabs ul.brmsTabNav > li.first{
		border-top-right-radius: 10px;
	}

	&.brmsLeftTabs ul.brmsTabNav > li.last
	{
		border-bottom-left-radius: 10px;
		border-bottom: none;
	}
	&.brmsRightTabs ul.brmsTabNav > li.last
	{
		border-bottom-right-radius: 10px;
		border-bottom: none;
	}
	&.brmsTopTabs ul.brmsTabNav > li.first{

	}
	&.brmsTopTabs ul.brmsTabNav > li.last
	{
		border-right-width:1px;
	}
	&.brmsTopTabs ul.brmsTabNav > li.current
	{
		height: 40px;
	}
	&.brmsLeftTabs ul.brmsTabNav > li.first.current,
	&.brmsRightTabs ul.brmsTabNav > li.first.current
	{
		border-bottom-width: 1px;
	}

	&.brmsTopTabs ul.brmsTabNav > li.first.current
	{
		border-bottom: none;
	}

	ul.brmsTabNav > li a
	{
		font-weight: bold;
		font-size: 11px;
		color: #5C5C5C;
		text-decoration: none;
		margin: 0px;
		outline: none;
		display: block;
		text-align: left;
	}
	ul.brmsTabNav > li a span{
		display:block;
	}
	ul.brmsTabNav > li a span.description
	{
		float:left;
		display:block;
		font-weight:normal;
	}
	&.brmsLeftTabs ul.brmsTabNav > li a,
	&.brmsRightTabs ul.brmsTabNav > li a
	{
		padding: 15px 10px;
	}

	&.brmsTopTabs ul.brmsTabNav > li a
	{
		line-height: 38px;
		padding:0 10px;
	}
	&.brmsTopTabs ul.brmsTabNav > li a span.description{
		display:none;
	}



	.brmsTabContent
	{
		background-color: #FFF;
		padding: 10px;
		border: 1px solid #ddd;
		display: none;
		box-shadow: inset 0 0 35px 5px #fafbfd;
	}
	&.brmsLeftTabs .brmsTabContent,
	&.brmsRightTabs .brmsTabContent{
		margin-left: 150px;
		position: relative;
		z-index: 9;
		min-height:247px;
	}
	&.brmsRightTabs .brmsTabContent{
		margin-right: 150px;
		margin-left: 0;
	}
	.brmsTabContent ol.brmsContentList{
		counter-reset: numList;
	}
	.brmsTabContent ol.brmsContentList > li{
		padding: 1px 0;
		border-top: 1px dashed #CCC;
		float: left;
		width: 100%;
	}

	.brmsTabContent ol.brmsContentList > li.first{
		border-top: 1px none black;
	}

	.brmsIcoRefresh,
	.brmsIcoConfig,
	.brmsIcoList,
	.brmsIcoLayout{
		background-image: url(\'styles/br/brms/light-sprite.png\');
	}

	.itemContent{
		padding: 0px;
		-moz-transition: all .3s ease-out;
		-ms-transition: all .3s ease-out;
		-o-transition: all .3s ease-out;
		transition: all .3s ease-out;
		display: table;
		table-layout: fixed;
		word-wrap: normal;
		width: 100%;
		&:hover{
			background-color: #eee;
		}
		.listBlock {
			display: table-cell;
			vertical-align: middle;
		}
		.counter{
			font-size: 11px;
			color: #f00;
			background-position: 0px -192px;
			padding-right: 5px;
			margin-top: 1px;
			margin-right: 1px;
			text-align: center;
			position: relative;
			width: 20px;
			.countNumber{
				background-color: #eee;
				border-radius: 3px;
				line-height: 15px;
				min-width: 15px;
				display: block;
				height: 15px;
			}
			.arrow{
				border: 3px solid transparent;
				border-right: 1px none black;
				border-left-color: #eee;
				position: absolute;
				top: 6px;
				right: 2px;
				display: block;
				width: 0px;
				height: 0px;
			}
			&.counter_1 .countNumber,
			&.counter_2 .countNumber,
			&.counter_3 .countNumber{
				font-size:12px;
				color:#fff;
			}
			&.counter_1 .countNumber{
				background-color: #FF0000;
			}
			&.counter_2 .countNumber{
				background-color: #FF4040;
			}
			&.counter_3 .countNumber{
				background-color: #FF7373;
			}
			&.counter_1 .arrow{
				border-left-color: #ff0000;
			}
			&.counter_2 .arrow{
				border-left-color: #FF4040;
			}
			&.counter_3 .arrow{
				border-left-color: #FF7373;
			}
		}


		&:hover .counter .countNumber{
			background-color: #fff;
		}
		&:hover .counter .arrow{
			border-left-color: #fff;
		}
		&:hover .counter.counter_1 .countNumber,
		&:hover .counter.counter_2 .countNumber,
		&:hover .counter.counter_3 .countNumber{
			color: #FF0000;
		}

		.itemTitle{
			width: auto;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			max-width: 65%;
		}
	}



	.itemUser .itemContent .itemTitle{
		width: auto;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		max-width: 35%;
	}
	.itemContent .itemDetail {
		width: 150px;
		max-width: 150px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.itemContent .itemDetail.itemDate {
		width: 200px;
		max-width: 200px;
	}

	.itemContent .itemDetail,
	.itemContent .itemDetail a{
		font-size: 11px;
		text-align: right;
	}
	.itemUser .itemContent .itemDetail,
	.itemUser .itemContent .itemDetail a{
		font-size: 11px;
	}
	.itemContent .itemDetailDate a.paint {
		color: @xf-paletteNeutral2;
	}
	.itemContent .itemDetailDate > span {
		font-size: 0.8em;
		color: @xf-paletteNeutral2;
	}

	.itemUser .itemContent .itemDetailMain{
		text-align:right;
	}
	.itemUser .itemContent .itemDetailMain strong{
		font-weight: bold;
	}
	.itemContent .itemDetailName{
		text-align:right;
	}
	.itemContent .itemDetailName a.username span {
		font-weight: bold;
		font-size: 11px;
	}
	.itemContent .itemSubDetail.alleft{
		text-align: left;
	}

	.newItemCounter {
		font-weight: bold;
		font-size: 10px;
		color: white;
		background-color: #e03030;
		padding: 0 3px;
		border-radius: 2px;
		position: absolute;
		line-height: 16px;
		min-width: 12px;
		text-align: center;
		white-space: nowrap;
		word-wrap: normal;
		right: 2px;
		top: -10px;
		z-index: 100;
		box-shadow: 2px 2px 5px rgba(0,0,0, 0.25);
		height: 16px;
		.totalNumber {

		}

		.arrow {
			border: 5px solid transparent;
			border-top-color: #e03030;
			border-bottom: 1px none black;
			position: absolute;
			right: 3px;
			line-height: 0px;
			_display: none;
			bottom: -4px;
			z-index: 100;
			width: 0px;
			height: 0px;
		}
	}

	.brmsNewItem .itemContent{
		border-radius: 5px;
		background: #FFEAE7 !important;
	}

	.brmsSticky .itemContent{
		border-radius: 5px;
		background: #fff1ba !important;
	}
	.clear{
		clear:both;
	}
	.tooltip{
		position: absolute;
		margin: -50px 0px 0px 60px;
		z-index:999;
	}
	.tooltip.show{
		display: block;
	}


	.brmsRefresh{

	}

	.brmsIco{
		height:14px;
		width:14px;
		display:block;
	}
	.brmsDropdownToggle{
		position:relative;

	}
	.brmsDropdownMenu{
		font-size: 11px;
		background-color: #FFF;
		margin: 0px 0 0;
		border: 1px solid #DADADA;
		border-top: 1px none black;
		display: none;
		position: absolute;
		z-index: 999;
		text-align: left;
		top: 100%;
		left: -1px;
		float: left;
		min-width: 160px;
		background-clip: padding-box;
		box-shadow: 0 2px 2px -2px #CCC;
		li{
			color: #686868;
			background-color: #FAFAFA;
			border: 1px none black;
			border-top: 1px solid #E4E4E4;
			box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.2);
			background: -moz-linear-gradient(top, #FFF 0%, #F5F5F5 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FFF), color-stop(100%,#F5F5F5));
			background: -webkit-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
			background: -o-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
			background: -ms-linear-gradient(top, #FFF 0%,#F5F5F5 100%);
			background: linear-gradient(top, #FFF 0%,#F5F5F5 100%);
		}
		li.current,
		li:hover{
			background-color: #f6f6f6;
		}

		&.left{
			left: 99%;
			top: -1px;
		}
		&.right{
			right: 99%;
			top: -1px;
			left: -160px;
		}
		&.edge{
			right: -1px;
			left: -160px;
		}

		li.first {
		}
		a {
			font-size: 12px;
			color: #6A6A6A;
			padding: 8px 10px;
			display: block;
			clear: both;
			font-weight: normal;
			white-space: nowrap;
		}
	}

	&.brmsLeftTabs .brmsTabNavHidden .brmsDropdownMenu{
		top: -1px;
		left: 99%;
	}
	&.brmsRightTabs .brmsTabNavHidden .brmsDropdownMenu{
		right: 99%;
		top: -1px;
		left: -160px;
	}
	ul.brmsTabNav > li.brmsTabNavHiddenMenu {
		display:none;
	}

	.brmsTabNavHidden li{
		display:none;
	}
	.brmsTabNavHidden{
		text-align: center;
	}
	ul.brmsTabNav > li .brmsTabNavHidden > a{
		display: inline-block;
		text-align:center;
		width: 34px;
	}
	&.brmsTopTabs .brmsTabNavHidden {
		height:38px;
		text-align:center;
	}
	&.brmsTopTabs .brmsTabNavHidden > a {
		height: 100%;
		text-align:center;
	}


	.brmsDropdownToggle:hover .brmsDropdownMenu{
		display:block;
	}

	.brmsIcoRefresh{
		background-position: -10px -44px;
	}

	.brmsConfigBtn:hover .brmsIcoRefresh{
		background:url(\'styles/br/brms/refresh.gif\') no-repeat center center;
	}
	.brmsIcoConfig{
		background-position: -10px -10px;
	}
	.brmsIcoList{
		background-position: 0px -102px;
	}
	.brmsIcoLayout{
		background-position: -10px -78px;
	}
	.brmsIcoLoader{
		background:url(\'styles/br/brms/loader7.gif\') no-repeat center center;
		width:220px;
		height:19px;
		display:block;
		margin: auto;
	}


	&.BRMSContainerDark
	{
		color: #d5d5d5;
		.brmsConfigList .brmsConfigBtn
		{
			color: #fafafa;
			border: 1px solid #2e3234;
			background: #313639;
			background: -moz-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3e4649), color-stop(100%, #313639));
			background: -webkit-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -o-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -ms-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: linear-gradient(top, #3e4649 0%, #313639 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#3e4649\', endColorstr=\'#313639\',GradientType=0 );
			box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset;
		}
		.brmsConfigList .brmsConfigBtn:hover
		{
			border: 1px solid #252a31;
			background: #272c30 !important;
			box-shadow: inset 0 0 35px 5px #262b2e;
		}
		&.brmsLeftTabs ul.brmsTabNav{
			border: 1px solid #272c30;
			border-right-width: 0;
		}
		&.brmsRightTabs ul.brmsTabNav{
			border: 1px solid #272c30;
			border-left-width: 0;
		}
		ul.brmsTabNav > li
		{
			background: #313639;
			border-color:#272c30;
			background: -moz-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3e4649), color-stop(100%, #313639));
			background: -webkit-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -o-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -ms-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: linear-gradient(top, #3e4649 0%, #313639 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#3e4649\', endColorstr=\'#313639\',GradientType=0 );
			box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset;
			text-shadow: none;
		}
		ul.brmsTabNav > li.current
		{
			background: #272c30 !important;
			box-shadow: inset 0 0 35px 5px #262b2e;
		}
		&.brmsLeftTabs ul.brmsTabNav > li.first.current,
		&.brmsRightTabs ul.brmsTabNav > li.first.current
		{
			border-bottom-width: 1px;
		}

		&.brmsTopTabs ul.brmsTabNav > li.last
		{
			border-right-width: 1px;
		}
		ul.brmsTabNav > li a
		{
			color: #fafafa;
		}
		.brmsTabContent
		{
			border: 1px solid #272c30;
			background-color: #2c3032;
			box-shadow: inset 0 0 35px 5px #262b2e;
		}
		.brmsTabContent >h4
		{
			color: Black;
			text-shadow: 0px 1px 1px #F2F1F0;
			border-bottom: 1px dotted #EEEDED;
		}
		.brmsTabContent ol li{
			padding-top:1px;
			background: url(\'styles/br/brms/dark/linesSep.png\') repeat-x 0 0;
		}
		.brmsTabContent ol li.first{
			background: none;
		}

		.itemContent:hover{
			background: #222;
		}
		.brmsIcoRefresh,
		.brmsIcoConfig,
		.brmsIcoList,
		.brmsIcoLayout{
			background-image: url(\'styles/br/brms/dark-sprite.png\');
		}
		.itemContent .counter{
			background-position: 0px -147px;
			color:#f00;
		}
		.itemContent .counter .countNumber{
			background-color: #eee;
		}
		.itemContent .counter .arrow{
			border-left-color: #eee;
		}
		.itemContent .counter.counter_1 .countNumber,
		.itemContent .counter.counter_2 .countNumber,
		.itemContent .counter.counter_3 .countNumber{
			color:#fff;
		}
		.itemContent .counter.counter_1 .countNumber{
			background-color: #FF0000;
		}
		.itemContent .counter.counter_2 .countNumber{
			background-color: #FF4040;
		}
		.itemContent .counter.counter_3 .countNumber{
			background-color: #FF7373;
		}
		.itemContent .counter.counter_1 .arrow{
			border-left-color: #FF0000;
		}
		.itemContent .counter.counter_2 .arrow{
			border-left-color: #FF4040;
		}
		.itemContent .counter.counter_3 .arrow{
			border-left-color: #FF7373;
		}
		.itemContent:hover .counter .countNumber{
			background-color: #fff;
		}
		.itemContent:hover .counter .arrow{
			border-left-color: #fff;
		}
		.itemContent:hover .counter.counter_1 .countNumber,
		.itemContent:hover .counter.counter_2 .countNumber,
		.itemContent:hover .counter.counter_3 .countNumber{
			color: #FF0000;
		}

		.itemContent .itemDetailDate a.paint {
			color: #d5d5d5;
		}

		.itemContent .itemDetailDate > span {
			color: #d5d5d5;
		}

		.brmsNewItem .itemContent{
			background-color: #3e5d6d !important;
		}

		.brmsSticky .itemContent{
			background-color: #B55D5C !important;
		}
		.itemContent .itemTitle,
		.itemContent .itemTitle a{
			color:#fff;
		}

		.brmsDropdownMenu{
			background-color: #FFF;
			border: 1px solid #24272b;
			box-shadow: 0 2px 2px -2px #CCC;
		}
		.brmsDropdownMenu li{
			color: #fafafa;
			background: #313639;
			background: -moz-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3e4649), color-stop(100%, #313639));
			background: -webkit-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -o-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: -ms-linear-gradient(top, #3e4649 0%, #313639 100%);
			background: linear-gradient(top, #3e4649 0%, #313639 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#3e4649\', endColorstr=\'#313639\',GradientType=0 );
			box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset;

			border-top: 1px solid #24272b;
		}
		.brmsDropdownMenu li.current,
		.brmsDropdownMenu li:hover{
			border: 1px solid #252a31;
			background: #272c30 !important;
			box-shadow: inset 0 0 35px 5px #262b2e;
		}

		.brmsDropdownMenu li.first {
			border-top: none;
		}

		.brmsDropdownMenu a {
			color: #fafafa;
		}
		.brmsDropdownMenu a:hover {
			text-decoration:none;
		}
		.brmsIcoRefresh{
			background-position: -10px -44px;
		}
		.brmsConfigBtn:hover .brmsIcoRefresh{
			background:url(\'styles/br/brms/dark/refresh.gif\') no-repeat center center;
		}
		.brmsIcoLoader{
			background:url(\'styles/br/brms/dark/loader7.gif\') no-repeat center center;
		}

		.xenTooltip{
			background:#000;
		}
	}

}


';
	return $__finalCompiled;
});