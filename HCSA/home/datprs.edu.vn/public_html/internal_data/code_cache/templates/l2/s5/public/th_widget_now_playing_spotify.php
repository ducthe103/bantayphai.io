<?php
// FROM HASH: ae21e0821ec4e81d95da05d6e8df0df5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('thspotify.less');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['userPlaybacks'], 'empty', array())) {
		$__finalCompiled .= '
	<div class="block"' . $__templater->fn('widget_data', array($__vars['widget'], ), true) . '>
		<div class="block-container">
			<h3 class="block-minorHeader">' . $__templater->escape($__vars['title']) . '</h3>
			<ul class="block-body">
				';
		if ($__templater->isTraversable($__vars['userPlaybacks'])) {
			foreach ($__vars['userPlaybacks'] AS $__vars['userPlayback']) {
				$__finalCompiled .= '
					<li class="block-row">
						<div class="contentRow">
							<div class="contentRow-figure">
								<img class="spotify__albumThumbnail" src="' . $__templater->escape($__vars['userPlayback']['SpotifySong']['album_thumbnail']) . '" alt="' . $__templater->escape($__vars['userPlayback']['SpotifySong']['album_name']) . '" />
							</div>
							<div class="contentRow-main contentRow-main--close">
								' . $__templater->escape($__vars['userPlayback']['SpotifySong']['song_name']) . '
								<div class="contentRow-minor">
									' . $__templater->escape($__vars['userPlayback']['SpotifySong']['artists']) . '
								</div>
								<div class="contentRow-minor">
									' . $__templater->escape($__vars['userPlayback']['SpotifySong']['album_name']) . '
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