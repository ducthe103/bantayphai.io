<?php
// FROM HASH: 15d24e25fa402c9ce39c04abd7de8671
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('thspotify.less');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['songs'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block"' . $__templater->fn('widget_data', array($__vars['widget'], ), true) . '>
		<div class="block-container">
			<h3 class="block-minorHeader">' . $__templater->escape($__vars['title']) . '</h3>
			<ul class="block-body">
				';
		if ($__templater->isTraversable($__vars['songs'])) {
			foreach ($__vars['songs'] AS $__vars['song']) {
				$__finalCompiled .= '
					<li class="block-row">
						<div class="contentRow">
							<div class="contentRow-figure">
								<img class="spotify__albumThumbnail" src="' . $__templater->escape($__vars['song']['album_thumbnail']) . '" alt="' . $__templater->escape($__vars['song']['album_name']) . '" />
							</div>
							<div class="contentRow-main contentRow-main--close">
								' . $__templater->escape($__vars['song']['song_name']) . '
								<div class="contentRow-minor">
									' . $__templater->escape($__vars['song']['artists']) . '
								</div>
								<div class="contentRow-minor">
									' . $__templater->escape($__vars['song']['album_name']) . '
								</div>
							</div>
						</div>
					</li>
				';
			}
		}
		$__finalCompiled .= '
			</ul>
		</div>
	</div>
';
	}
	return $__finalCompiled;
});