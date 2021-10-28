<?php
// FROM HASH: 119d070d4697f1735d3090261e2ae295
return array('macros' => array('spotify_playback_mini' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'location' => '!',
		'user' => '!',
		'showDetails' => false,
		'detailsWrapperClass' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['user'], 'canViewSpotifyPlayback', array()) AND ($__vars['user']['SpotifyUserPlayback'] AND $__templater->method($__vars['user']['SpotifyUserPlayback'], 'isPlaying', array()))) {
		$__finalCompiled .= '
		';
		$__templater->includeCss('thspotify.less');
		$__finalCompiled .= '
		';
		$__vars['song'] = $__vars['user']['SpotifyUserPlayback']['SpotifySong'];
		$__finalCompiled .= '

		';
		if ($__vars['showDetails']) {
			$__finalCompiled .= '
			<div class="' . $__templater->escape($__vars['detailsWrapperClass']) . '">
				<dl class="pairs pairs--inline">
					<dt>' . 'Listening to' . '</dt>
					<dd><a href="' . $__templater->escape($__vars['song']['spotify_url']) . '" target="_blank">' . $__templater->escape($__vars['song']['song_name']) . '</a> by ' . $__templater->escape($__vars['song']['artists']) . '</dd>
				</dl>
			</div>
		';
		}
		$__finalCompiled .= '

		<div><a href="' . $__templater->fn('link', array('members/spotify-playback', $__vars['user'], ), true) . '" data-xf-click="overlay" data-cache="0" class="button--spotifyModal button--provider button--provider--thspotify button"><span class="button-text">' . 'Listening to Spotify' . '</span></a></div>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'message_user_info' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'extras' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['extras']['thspotify']) {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'spotify_playback_mini', array(
			'location' => 'message_user_info',
			'user' => $__vars['user'],
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'member_tooltip' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->fn('property', array('th_spotify_showPlaybackMemberTooltip', ), false)) {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'spotify_playback_mini', array(
			'location' => 'member_tooltip',
			'user' => $__vars['user'],
			'showDetails' => $__templater->fn('property', array('th_spotify_showPlaybackDetailsMemberTooltip', ), false),
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'member_view' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->fn('property', array('th_spotify_showPlaybackMemberView', ), false)) {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'spotify_playback_mini', array(
			'location' => 'member_view',
			'user' => $__vars['user'],
			'showDetails' => $__templater->fn('property', array('th_spotify_showPlaybackDetailsMemberView', ), false),
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'global_js' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__vars['xf']['visitor']['user_id'] AND $__vars['xf']['visitor']['ConnectedAccounts']['thspotify']) {
		$__finalCompiled .= '
		';
		$__templater->inlineJs('
			themehouse.spotify.updateUserPlaybackTimeout = ' . $__vars['xf']['options']['thspotify_pollRate'] . ';
		');
		$__finalCompiled .= '
		';
		$__templater->includeJs(array(
			'src' => 'themehouse/spotify/spotify.js',
			'min' => 'themehouse/spotify/spotify.min.js',
			'addon' => 'ThemeHouse/Spotify',
		));
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '


' . '

' . '

' . '

' . '
';
	return $__finalCompiled;
});