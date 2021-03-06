<?php
// FROM HASH: 58aa5ee2a57d35421aaca8fa8ac17ce3
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ############################ Line numbers ############################

pre[class*="language-"].line-numbers {
	position: relative;
	padding-left: 2.8em;
	counter-reset: linenumber;
}

pre[class*="language-"].line-numbers > code {
	position: relative;
	white-space: inherit;
}

.line-numbers .line-numbers-rows {
	position: absolute;
	pointer-events: none;
	top: 0;
	font-size: 100%;
	left: -3.8em;
	width: 3em; /* works for line-numbers below 1000 lines */
	letter-spacing: -1px;
	border-right: 1px solid @xf-borderColor;

	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;

}

	.line-numbers-rows > span {
		pointer-events: none;
		display: block;
		counter-increment: linenumber;
	}

		.line-numbers-rows > span:before {
			content: counter(linenumber);
			color: @xf-textColorMuted;
			display: block;
			padding-right: 0.8em;
			text-align: right;
		}

// ############################ Line highlight ############################

pre[data-line] {
	position: relative;
	//padding: 1em 0 1em 3em;
}

.line-highlight {
	position: absolute;
	left: 0;
	right: 0;
	padding: inherit 0;
	//margin-top: 1em; /* Same as .prism’s padding-top */

	background: fade(@xf-paletteAccent2, 8%);
	//background: linear-gradient(to right, fade(@xf-paletteAccent2, 10%) 70%, fade(@xf-paletteAccent2, 0%));

	pointer-events: none;

	line-height: inherit;
	white-space: pre;
}

.line-numbers .line-highlight:before,
.line-numbers .line-highlight:after {
	content: none;
}';
	return $__finalCompiled;
});