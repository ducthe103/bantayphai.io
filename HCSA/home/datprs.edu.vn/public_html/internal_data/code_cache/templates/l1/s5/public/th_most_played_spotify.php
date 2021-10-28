<?php
// FROM HASH: baaa5302db4515d009c235c7c1dcd618
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Most played songs');
	$__finalCompiled .= '
';
	$__templater->includeCss('message.less');
	$__finalCompiled .= '
';
	$__templater->includeCss('thspotify.less');
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		';
	if (!$__templater->test($__vars['songs'], 'empty', array())) {
		$__finalCompiled .= '
			';
		if ($__templater->isTraversable($__vars['songs'])) {
			foreach ($__vars['songs'] AS $__vars['song']) {
				$__finalCompiled .= '
				<article class="message message--simple">
					<div class="message-inner">
						<div class="message-cell message-cell--user">
							<img src="' . $__templater->escape($__vars['song']['album_thumbnail']) . '" alt="' . $__templater->escape($__vars['song']['album_name']) . '">
						</div>
						<div class="message-cell message-cell--main">
							<div class="message-main">
								<div class="message-content">
									<div class="spotify__trackTitle">' . $__templater->escape($__vars['song']['song_name']) . '</div>
									<div>' . $__templater->escape($__vars['song']['artists']) . '</div>
									<div>' . $__templater->escape($__vars['song']['album_name']) . '</div>
								</div>
							</div>
						</div>
					</div>
				</article>
			';
			}
		}
		$__finalCompiled .= '
		';
	}
	$__finalCompiled .= '
	</div>
</div>';
	return $__finalCompiled;
});