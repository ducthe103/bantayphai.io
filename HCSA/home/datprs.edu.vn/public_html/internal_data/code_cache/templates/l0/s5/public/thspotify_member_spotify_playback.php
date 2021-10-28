<?php
// FROM HASH: d7dd60213e5dc42d46d81059c14f5aae
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('thspotify.less');
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'themehouse/spotify/spotifyUser.js',
		'min' => 'themehouse/spotify/spotifyUser.min.js',
		'addon' => 'ThemeHouse/Spotify',
	));
	$__finalCompiled .= '
';
	$__templater->inlineJs('
	$(document).ready(function() {
		themehouse.spotifyUser.initialize(' . $__vars['user']['user_id'] . ', ' . $__vars['songJson'] . ', ' . $__vars['playbackJson'] . ');
	});
');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Spotify playback for ' . $__templater->escape($__vars['user']['username']) . '');
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<div class="block-body">
			<div class="block-row spotifyPlayback">
				<div class="spotifyPlayback__albumArt">
					<img src="' . $__templater->escape($__vars['song']['album_thumbnail']) . '" alt="' . $__templater->escape($__vars['song']['album_name']) . '">
				</div>
				<div class="spotifyPlayback__trackDetails">
					<div class="spotifyPlayback__trackDetails__title"><a href="' . $__templater->escape($__vars['song']['spotify_url']) . '" target="_BLANK">' . $__templater->escape($__vars['song']['song_name']) . '</a></div>
					<div class="spotifyPlayback__trackDetails__artists">' . 'By' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['song']['artists']) . '</div>
					<div class="spotifyPlayback__trackDetails__album"><a href="' . $__templater->escape($__vars['song']['spotify_album_url']) . '" target="_BLANK">' . $__templater->escape($__vars['song']['album_name']) . '</a></div>
					<div class="spotifyPlayback__trackDetails__playBar">
						<div class="spotifyPlayback__trackDetails__playButton">
							<a href="' . $__templater->escape($__vars['song']['spotify_url']) . '" target="_BLANK"><i class="fa fa-play-circle"></i></a>
						</div>
						<div class="spotifyPlayback__trackDetails__progressBar">
							<div class="spotifyPlayback__trackDetails__progressBar__bar" style="width: ' . $__templater->escape($__templater->method($__vars['playback'], 'getProgressPercent', array())) . '%;"></div>
						</div>
					</div>
					<div class="spotifyPlayback__trackDetails__progress">
						' . $__templater->escape($__templater->method($__vars['playback'], 'getCurrentProgressStr', array())) . '
					</div>
				</div>
			</div>

			<div class="block-row spotifyError" style="display: none">
				' . '' . $__templater->escape($__vars['user']['username']) . ' has stopped their Spotify player.' . '
			</div>
		</div>
	</div>
</div>';
	return $__finalCompiled;
});