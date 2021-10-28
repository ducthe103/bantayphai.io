<?php
// FROM HASH: 7a7e86c009c0985763361c36c2b038c8
return array('macros' => array('ah_gamerprofiles_icons' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeCss('ah_gamerprofiles.less');
	$__finalCompiled .= '

	';
	$__vars['ahGPStatus'] = $__templater->fn('property', array('ahGPStatus', ), false);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_playstation'] AND $__vars['ahGPStatus']['ah_playstation']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/psn/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--playstation" target="_blank">
					' . $__templater->fontAwesome('fab fa-playstation', array(
		)) . '

					<img src="//card.exophase.com/psn/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '.png" class="ah-gp-profile" />
				</a>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_xbox'] AND $__vars['ahGPStatus']['ah_xbox']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/xbox/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--xbox" target="_blank">
					' . $__templater->fontAwesome('fab fa-xbox', array(
		)) . '

					<img src="//card.exophase.com/xbox/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '.png" class="ah-gp-profile" />
				</a>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_steam'] AND $__vars['ahGPStatus']['ah_steam']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/steam/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--steam" target="_blank">
					' . $__templater->fontAwesome('fab fa-steam', array(
		)) . '

					<img src="//card.exophase.com/steam/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '.png" class="ah-gp-profile" />
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_origin'] AND $__vars['ahGPStatus']['ah_origin']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--origin" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_origin']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 192 192"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ff6e40"><g id="surface1"><path d="M160,96.01562c0,0 0,0 0,-0.01562c0,-0.01562 0,-0.01562 0,-0.01562c0,-0.28125 -0.04688,-0.57812 -0.04688,-0.875c-0.48437,-34.92188 -28.90625,-63.10938 -63.95312,-63.10938c-2.59375,0 -5.14062,0.20312 -7.64062,0.5c0.65625,-8.75 7.45312,-18.15625 7.45312,-18.15625c0.75,-1.53125 -0.95312,-2.96875 -2.42188,-2.09375c-11.64062,6.84375 -61.39062,28.07812 -61.39062,83.73438c0,0 0,0 0,0.01562c0,35.34375 28.65625,64 64,64c2.59375,0 5.125,-0.20312 7.64062,-0.5c-0.67187,8.75 -7.45312,18.14062 -7.45312,18.14062c-0.76562,1.51563 0.95312,2.95313 2.42188,2.07813c11.625,-6.82813 61.39062,-27.39063 61.39062,-83.70313zM120,96c0,13.25 -10.75,24 -24,24c-13.25,0 -24,-10.75 -24,-24c0,-13.25 10.75,-24 24,-24c13.25,0 24,10.75 24,24z"></path></g></g></g></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_battlenet'] AND $__vars['ahGPStatus']['ah_battlenet']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--battlenet" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_battlenet']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50"><g id="surface1"><path style=" " d="M 43.113281 22.152344 C 43.113281 22.152344 47.058594 22.351563 47.058594 20.03125 C 47.058594 16.996094 41.804688 14.261719 41.804688 14.261719 C 41.804688 14.261719 42.628906 12.515625 43.140625 11.539063 C 43.65625 10.5625 45.101563 6.753906 45.230469 5.886719 C 45.394531 4.792969 45.144531 4.449219 45.144531 4.449219 C 44.789063 6.792969 40.972656 13.539063 40.671875 13.769531 C 36.949219 12.023438 31.835938 11.539063 31.835938 11.539063 C 31.835938 11.539063 26.832031 1 22.125 1 C 17.457031 1 17.480469 10.023438 17.480469 10.023438 C 17.480469 10.023438 16.160156 7.464844 14.507813 7.464844 C 12.085938 7.464844 11.292969 11.128906 11.292969 15.097656 C 6.511719 15.097656 2.492188 16.164063 2.132813 16.265625 C 1.773438 16.371094 0.644531 17.191406 1.15625 17.089844 C 2.203125 16.753906 7.113281 15.992188 11.410156 16.367188 C 11.648438 20.140625 13.851563 25.054688 13.851563 25.054688 C 13.851563 25.054688 9.128906 31.894531 9.128906 36.78125 C 9.128906 38.066406 9.6875 40.417969 13.078125 40.417969 C 15.917969 40.417969 19.105469 38.710938 19.707031 38.363281 C 19.183594 39.113281 18.796875 40.535156 18.796875 41.191406 C 18.796875 41.726563 19.113281 43.246094 21.304688 43.246094 C 24.117188 43.246094 27.257813 41.089844 27.257813 41.089844 C 27.257813 41.089844 30.222656 46.019531 32.761719 48.28125 C 33.445313 48.890625 34.097656 49 34.097656 49 C 34.097656 49 31.578125 46.574219 28.257813 40.324219 C 31.34375 38.417969 34.554688 33.921875 34.554688 33.921875 C 34.554688 33.921875 34.933594 33.933594 37.863281 33.933594 C 42.453125 33.933594 48.972656 32.96875 48.972656 29.320313 C 48.972656 25.554688 43.113281 22.152344 43.113281 22.152344 Z M 43.625 19.886719 C 43.625 21.21875 42.359375 21.199219 42.359375 21.199219 L 41.394531 21.265625 C 41.394531 21.265625 39.566406 20.304688 38.460938 19.855469 C 38.460938 19.855469 40.175781 17.207031 40.578125 16.46875 C 40.882813 16.644531 43.625 18.363281 43.625 19.886719 Z M 24.421875 6.308594 C 26.578125 6.308594 29.65625 11.402344 29.65625 11.402344 C 29.65625 11.402344 24.851563 10.972656 20.898438 13.296875 C 21.003906 9.628906 22.238281 6.308594 24.421875 6.308594 Z M 15.871094 10.4375 C 16.558594 10.4375 17.230469 11.269531 17.507813 11.976563 C 17.507813 12.445313 17.75 15.171875 17.75 15.171875 L 13.789063 15.023438 C 13.789063 11.449219 15.1875 10.4375 15.871094 10.4375 Z M 15.464844 35.246094 C 13.300781 35.246094 12.851563 34.039063 12.851563 32.953125 C 12.851563 30.496094 14.8125 27.058594 14.8125 27.058594 C 14.8125 27.058594 17.011719 31.683594 20.851563 33.636719 C 18.945313 34.753906 17.375 35.246094 15.464844 35.246094 Z M 22.492188 40.089844 C 20.972656 40.089844 20.789063 39.105469 20.789063 38.878906 C 20.789063 38.171875 21.339844 37.335938 21.339844 37.335938 C 21.339844 37.335938 23.890625 35.613281 24.054688 35.429688 L 25.9375 38.945313 C 25.9375 38.945313 24.007813 40.089844 22.492188 40.089844 Z M 27.226563 38.171875 C 26.300781 36.554688 25.621094 34.867188 25.621094 34.867188 C 25.621094 34.867188 29.414063 35.113281 31.453125 33.007813 C 30.183594 33.578125 28.15625 34.300781 25.800781 34.082031 C 30.726563 29.742188 33.601563 26.597656 36.03125 23.34375 C 35.824219 23.09375 34.710938 22.316406 34.4375 22.1875 C 32.972656 23.953125 27.265625 30.054688 21.984375 33.074219 C 15.292969 29.425781 13.890625 18.691406 13.746094 16.460938 L 17.402344 16.8125 C 17.402344 16.8125 16.027344 19.246094 16.027344 21.039063 C 16.027344 22.828125 16.242188 22.925781 16.242188 22.925781 C 16.242188 22.925781 16.195313 19.800781 18.125 17.390625 C 19.59375 25.210938 21.125 29.21875 22.320313 31.605469 C 22.925781 31.355469 24.058594 30.851563 24.058594 30.851563 C 24.058594 30.851563 20.683594 21.121094 20.871094 14.535156 C 22.402344 13.71875 24.667969 12.875 27.226563 12.875 C 33.957031 12.875 39.367188 15.773438 39.367188 15.773438 L 37.25 18.730469 C 37.25 18.730469 35.363281 15.3125 32.699219 14.703125 C 34.105469 15.753906 35.679688 17.136719 36.496094 19.128906 C 30.917969 16.949219 24.1875 15.796875 22.027344 15.542969 C 21.839844 16.339844 21.863281 17.480469 21.863281 17.480469 C 21.863281 17.480469 30.890625 19.144531 37.460938 22.90625 C 37.414063 31.125 28.460938 37.4375 27.226563 38.171875 Z M 35.777344 32.027344 C 35.777344 32.027344 38.578125 28.347656 38.535156 23.476563 C 38.535156 23.476563 43.0625 26.28125 43.0625 29.015625 C 43.0625 32.074219 35.777344 32.027344 35.777344 32.027344 Z "></path></g></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_epicgames'] AND $__vars['ahGPStatus']['ah_epicgames']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--epicgames" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_epicgames']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50"><path d="M 10 3 C 6.69 3 4 5.69 4 9 L 4 41.240234 L 25 47.539062 L 46 41.240234 L 46 9 C 46 5.69 43.31 3 40 3 L 10 3 z M 11 8 L 15 8 L 15 11 L 11 11 L 11 18 L 14 18 L 14 21 L 11 21 L 11 28 L 15 28 L 15 31 L 11 31 C 9.34 31 8 29.66 8 28 L 8 11 C 8 9.34 9.34 8 11 8 z M 17 8 L 23 8 C 24.66 8 26 9.34 26 11 L 26 18 C 26 19.66 24.66 21 23 21 L 20 21 L 20 31 L 17 31 L 17 8 z M 28 8 L 31 8 L 31 31 L 28 31 L 28 8 z M 36 8 L 39 8 C 40.66 8 42 9.34 42 11 L 42 15 L 39 15 L 39 11 L 36 11 L 36 28 L 39 28 L 39 24 L 42 24 L 42 28 C 42 29.66 40.66 31 39 31 L 36 31 C 34.34 31 33 29.66 33 28 L 33 11 C 33 9.34 34.34 8 36 8 z M 20 11 L 20 18 L 23 18 L 23 11 L 20 11 z M 9 34 L 13 34 C 13.55 34 14 34.45 14 35 L 14 36 L 13 36 L 13 35.25 C 13 35.11 12.89 35 12.75 35 L 9.25 35 C 9.11 35 9 35.11 9 35.25 L 9 38.75 C 9 38.89 9.11 39 9.25 39 L 12.75 39 C 12.89 39 13 38.89 13 38.75 L 13 38 L 12 38 L 12 37 L 14 37 L 14 39 C 14 39.55 13.55 40 13 40 L 9 40 C 8.45 40 8 39.55 8 39 L 8 35 C 8 34.45 8.45 34 9 34 z M 18 34 L 19 34 L 22 40 L 21 40 L 20.5 39 L 16.5 39 L 16 40 L 15 40 L 18 34 z M 23 34 L 24 34 L 26 38 L 28 34 L 29 34 L 29 40 L 28 40 L 28 36 L 26.5 39 L 25.5 39 L 24 36 L 24 40 L 23 40 L 23 34 z M 30 34 L 35 34 L 35 35 L 31 35 L 31 36.5 L 33 36.5 L 33 37.5 L 31 37.5 L 31 39 L 35 39 L 35 40 L 30 40 L 30 34 z M 37 34 L 41 34 C 41.55 34 42 34.45 42 35 L 42 35.5 L 41 35.5 L 41 35.25 C 41 35.11 40.89 35 40.75 35 L 37.25 35 C 37.11 35 37 35.11 37 35.25 L 37 36.25 C 37 36.39 37.11 36.5 37.25 36.5 L 41 36.5 C 41.55 36.5 42 36.95 42 37.5 L 42 39 C 42 39.55 41.55 40 41 40 L 37 40 C 36.45 40 36 39.55 36 39 L 36 38.5 L 37 38.5 L 37 38.75 C 37 38.89 37.11 39 37.25 39 L 40.75 39 C 40.89 39 41 38.89 41 38.75 L 41 37.75 C 41 37.61 40.89 37.5 40.75 37.5 L 37 37.5 C 36.45 37.5 36 37.05 36 36.5 L 36 35 C 36 34.45 36.45 34 37 34 z M 18.5 35 L 17 38 L 20 38 L 18.5 35 z"></path></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_oculus'] AND $__vars['ahGPStatus']['ah_oculus']) {
		$__compilerTemp1 .= '
				<a href="https://forums.oculusvr.com/community/profile/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_oculus']) . '" target="_blank">
					<span class="ah-gp-icon ah-gp-icon--oculus" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_oculus']) . '">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M12.09 9.3c-.213.147-.45.236-.704.277-.255.04-.508.033-.762.033H5.376c-.255 0-.508.008-.763-.033-.254-.042-.49-.13-.705-.278-.428-.3-.685-.78-.685-1.3 0-.53.258-1.01.686-1.3.21-.15.45-.24.7-.28.25-.04.5-.04.76-.04h5.25c.25 0 .51-.01.76.03s.49.13.7.27c.43.29.68.78.68 1.3s-.26 1-.69 1.3zm2.116-5.037c-.563-.452-1.208-.764-1.91-.933-.4-.097-.803-.14-1.215-.153-.3-.01-.6-.007-.91-.007H5.84c-.305 0-.61-.003-.915.007-.412.014-.814.056-1.216.153-.7.17-1.35.482-1.91.934C.66 5.174 0 6.547 0 8c0 1.454.66 2.827 1.793 3.737.564.452 1.21.764 1.91.933.402.097.804.14 1.216.153.3.01.6.007.91.007h4.33c.3 0 .61.003.91-.007.41-.013.81-.056 1.21-.153.7-.17 1.34-.482 1.91-.934C15.34 10.826 16 9.453 16 8c0-1.454-.66-2.827-1.794-3.737z" fill-rule="nonzero"/></svg>
					</span>
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_secondlife'] AND $__vars['ahGPStatus']['ah_secondlife']) {
		$__compilerTemp1 .= '
				<a href="https://my.secondlife.com/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_secondlife']) . '" class="ah-gp-icon ah-gp-icon--secondlife" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_secondlife']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 192 192"><path d="M86.115,11.58c-3.765,0.3 -5.91,2.475 -6.885,5.91c-0.81,2.85 -0.99,5.745 -0.705,8.7c1.455,14.835 2.76,29.685 4.35,44.505c0.825,7.56 1.65,15.135 3.54,22.515c0.915,3.54 3.63,4.77 7.17,4.575c3.39,-0.18 4.95,-2.04 5.535,-5.22c0.885,-4.665 0.375,-9.345 0.72,-15.66c-0.9,-16.485 -1.845,-34.59 -2.94,-52.695c-0.18,-2.88 -0.675,-5.79 -2.16,-8.445c-1.905,-3.405 -4.905,-4.5 -8.625,-4.185zM122.175,21.36c-3.21,0.27 -5.655,2.7 -6.72,7.2c-0.855,3.705 -1.26,7.5 -1.695,11.28c-1.86,16.575 -4.275,33.105 -4.875,50.565c0,0.27 0.03,1.29 0,2.31c-0.15,3.78 1.53,6.135 5.415,6.885c4.41,0.84 5.925,-2.025 6.735,-5.34c3.525,-14.085 5.31,-28.47 7.365,-42.81c1.005,-6.945 2.67,-13.815 2.745,-20.865c0.06,-5.49 -2.73,-8.745 -7.545,-9.225c-0.48,-0.045 -0.96,-0.045 -1.425,0zM53.49,23.16c-0.51,0.015 -1.035,0.075 -1.575,0.18c-4.755,0.975 -6.855,3.825 -6.855,10.56c0.105,0.675 0.3,2.58 0.72,4.41c2.505,10.695 4.98,21.405 7.605,32.07c2.235,9.09 5.01,18.06 8.235,26.88c1.38,3.795 4.74,5.535 8.46,4.695c3.855,-0.855 4.755,-3.585 4.56,-6.99c-0.075,-1.32 -0.21,-2.625 -0.375,-3.93c-1.725,-12.765 -4.26,-25.395 -6.9,-37.995c-1.65,-7.86 -2.43,-15.945 -5.385,-23.52c-1.62,-4.185 -4.875,-6.435 -8.49,-6.36zM150.225,45.21c-3.12,-0.21 -4.98,1.95 -6.36,4.59c-0.96,1.815 -1.725,3.765 -2.16,5.745c-3.18,14.13 -7.095,28.095 -9.885,42.315c-0.765,3.825 0,6.42 3.75,7.68c4.08,1.365 5.565,-1.53 6.885,-4.485c4.5,-10.095 7.59,-20.625 10.305,-31.275c1.41,-5.505 3.885,-10.755 4.5,-16.455c0.315,-4.17 -1.59,-6.795 -5.625,-7.86c-0.495,-0.135 -0.96,-0.225 -1.41,-0.255zM32.76,83.265c-2.01,0.24 -2.49,1.74 -2.04,4.515c2.385,14.805 2.37,29.76 2.745,44.7c0.51,20.295 11.955,35.955 31.44,42.645c15.51,5.31 31.515,6.54 47.7,4.275c11.19,-1.575 22.125,-7.275 29.865,-15.81c17.715,-19.515 10.11,-48.645 -14.97,-57.03c-8.265,-2.775 -18.12,-3.33 -28.155,-3.42c-3.525,0 -7.02,0.375 -11.145,0.945c-11.925,1.62 -22.77,5.97 -31.23,15c-2.985,3.18 -2.925,6.66 -0.15,9.345c3.135,3.045 5.85,1.74 8.58,-0.675c3.225,-2.835 7.185,-5.28 11.475,-6.51c0.99,-0.3 2.115,-0.705 3.015,0c1.155,0.9 0.12,1.92 -0.21,2.775c-1.83,4.68 -1.935,9.39 -0.705,14.22c3.195,12.42 13.335,19.245 27.03,17.22c10.47,-1.545 18.63,-12.72 17.97,-23.88c-0.165,-2.94 -1.23,-5.43 -3.405,-7.41c-1.2,-1.095 -2.7,-1.335 -4.17,-0.69c-1.32,0.585 -1.29,1.74 -1.065,3.015c0.585,3.45 -0.975,4.71 -4.44,4.71c-3.42,0 -5.085,-2.295 -4.695,-5.58c0.375,-3.105 2.55,-4.845 5.46,-5.775c11.175,-3.54 24.315,5.265 25.02,16.725c0.795,13.275 -8.22,24.435 -22.86,28.035c-10.215,2.505 -20.535,1.725 -30.66,-0.15c-20.37,-3.765 -34.155,-13.905 -33.615,-38.82c0.225,-10.11 -0.045,-20.235 -1.77,-30.24c-1.17,-6.765 -5.55,-10.65 -12.495,-11.955c-1.02,-0.21 -1.86,-0.255 -2.52,-0.18z"></path></svg>
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_discord'] AND $__vars['ahGPStatus']['ah_discord']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--discord" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_discord']) . '">
					' . $__templater->fontAwesome('fab fa-discord', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_twitch'] AND $__vars['ahGPStatus']['ah_twitch']) {
		$__compilerTemp1 .= '
				<a href="https://www.twitch.tv/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_twitch']) . '" class="ah-gp-icon ah-gp-icon--twitch" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_twitch']) . '" target="_blank">
					' . $__templater->fontAwesome('fab fa-twitch', array(
		)) . '
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_mixer'] AND $__vars['ahGPStatus']['ah_mixer']) {
		$__compilerTemp1 .= '
				<a href="https://www.mixer.com/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_mixer']) . '" class="ah-gp-icon ah-gp-icon--mixer" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_mixer']) . '" target="_blank">
					<svg viewBox="0 0 24 20">
    					<path d="M5.68,3.96L11.41,11.65C11.55,11.84 11.55,12.1 11.41,12.29L5.65,20L5.5,20.18C4.76,21 3.47,21.07 2.64,20.31C1.85,19.59 1.79,18.37 2.43,17.5L6.56,11.97L2.46,6.47C1.83,5.62 1.88,4.39 2.67,3.67L2.82,3.54C3.73,2.87 5,3.05 5.68,3.96M18.32,3.96C19,3.05 20.27,2.87 21.18,3.54L21.33,3.67C22.12,4.39 22.17,5.61 21.54,6.47L17.44,11.97L21.57,17.5C22.21,18.36 22.15,19.59 21.36,20.31C20.53,21.07 19.24,21 18.5,20.18L18.35,20L12.59,12.29C12.45,12.1 12.45,11.84 12.59,11.65L18.32,3.96Z" />
					</svg>
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_youtube'] AND $__vars['ahGPStatus']['ah_youtube']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--youtube" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_youtube']) . '">
					' . $__templater->fontAwesome('fab fa-youtube', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['facebook'] AND $__vars['ahGPStatus']['facebook']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--facebook" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['facebook']) . '">
					' . $__templater->fontAwesome('fab fa-facebook', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['twitter'] AND $__vars['ahGPStatus']['twitter']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--twitter" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['twitter']) . '">
					' . $__templater->fontAwesome('fab fa-twitter', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['skype'] AND $__vars['ahGPStatus']['skype']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--skype" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['skype']) . '">
					' . $__templater->fontAwesome('fab fa-skype', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
		';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
		<div class="ah-gp-icons-container">
		' . $__compilerTemp1 . '
		</div>
	';
	}
	$__finalCompiled .= '
	
';
	return $__finalCompiled;
},
'ah_gamerprofiles_tooltip_icons' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeCss('ah_gamerprofiles.less');
	$__finalCompiled .= '

	';
	$__vars['ahGPStatus'] = $__templater->fn('property', array('ahGPStatus', ), false);
	$__finalCompiled .= '
	';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_playstation'] AND $__vars['ahGPStatus']['ah_playstation']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/psn/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--playstation" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_playstation']) . '" target="_blank">
					' . $__templater->fontAwesome('fab fa-playstation', array(
		)) . '
				</a>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_xbox'] AND $__vars['ahGPStatus']['ah_xbox']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/xbox/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--xbox" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_xbox']) . '" target="_blank">
					' . $__templater->fontAwesome('fab fa-xbox', array(
		)) . '
				</a>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_steam'] AND $__vars['ahGPStatus']['ah_steam']) {
		$__compilerTemp1 .= '
				<a href="https://gamercards.exophase.com/steam/user/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '" class="ah-gp-trigger ah-gp-icon ah-gp-icon--steam" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_steam']) . '" target="_blank">
					' . $__templater->fontAwesome('fab fa-steam', array(
		)) . '
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_origin'] AND $__vars['ahGPStatus']['ah_origin']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--origin" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_origin']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 192 192"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ff6e40"><g id="surface1"><path d="M160,96.01562c0,0 0,0 0,-0.01562c0,-0.01562 0,-0.01562 0,-0.01562c0,-0.28125 -0.04688,-0.57812 -0.04688,-0.875c-0.48437,-34.92188 -28.90625,-63.10938 -63.95312,-63.10938c-2.59375,0 -5.14062,0.20312 -7.64062,0.5c0.65625,-8.75 7.45312,-18.15625 7.45312,-18.15625c0.75,-1.53125 -0.95312,-2.96875 -2.42188,-2.09375c-11.64062,6.84375 -61.39062,28.07812 -61.39062,83.73438c0,0 0,0 0,0.01562c0,35.34375 28.65625,64 64,64c2.59375,0 5.125,-0.20312 7.64062,-0.5c-0.67187,8.75 -7.45312,18.14062 -7.45312,18.14062c-0.76562,1.51563 0.95312,2.95313 2.42188,2.07813c11.625,-6.82813 61.39062,-27.39063 61.39062,-83.70313zM120,96c0,13.25 -10.75,24 -24,24c-13.25,0 -24,-10.75 -24,-24c0,-13.25 10.75,-24 24,-24c13.25,0 24,10.75 24,24z"></path></g></g></g></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_battlenet'] AND $__vars['ahGPStatus']['ah_battlenet']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--battlenet" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_battlenet']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50"><g id="surface1"><path style=" " d="M 43.113281 22.152344 C 43.113281 22.152344 47.058594 22.351563 47.058594 20.03125 C 47.058594 16.996094 41.804688 14.261719 41.804688 14.261719 C 41.804688 14.261719 42.628906 12.515625 43.140625 11.539063 C 43.65625 10.5625 45.101563 6.753906 45.230469 5.886719 C 45.394531 4.792969 45.144531 4.449219 45.144531 4.449219 C 44.789063 6.792969 40.972656 13.539063 40.671875 13.769531 C 36.949219 12.023438 31.835938 11.539063 31.835938 11.539063 C 31.835938 11.539063 26.832031 1 22.125 1 C 17.457031 1 17.480469 10.023438 17.480469 10.023438 C 17.480469 10.023438 16.160156 7.464844 14.507813 7.464844 C 12.085938 7.464844 11.292969 11.128906 11.292969 15.097656 C 6.511719 15.097656 2.492188 16.164063 2.132813 16.265625 C 1.773438 16.371094 0.644531 17.191406 1.15625 17.089844 C 2.203125 16.753906 7.113281 15.992188 11.410156 16.367188 C 11.648438 20.140625 13.851563 25.054688 13.851563 25.054688 C 13.851563 25.054688 9.128906 31.894531 9.128906 36.78125 C 9.128906 38.066406 9.6875 40.417969 13.078125 40.417969 C 15.917969 40.417969 19.105469 38.710938 19.707031 38.363281 C 19.183594 39.113281 18.796875 40.535156 18.796875 41.191406 C 18.796875 41.726563 19.113281 43.246094 21.304688 43.246094 C 24.117188 43.246094 27.257813 41.089844 27.257813 41.089844 C 27.257813 41.089844 30.222656 46.019531 32.761719 48.28125 C 33.445313 48.890625 34.097656 49 34.097656 49 C 34.097656 49 31.578125 46.574219 28.257813 40.324219 C 31.34375 38.417969 34.554688 33.921875 34.554688 33.921875 C 34.554688 33.921875 34.933594 33.933594 37.863281 33.933594 C 42.453125 33.933594 48.972656 32.96875 48.972656 29.320313 C 48.972656 25.554688 43.113281 22.152344 43.113281 22.152344 Z M 43.625 19.886719 C 43.625 21.21875 42.359375 21.199219 42.359375 21.199219 L 41.394531 21.265625 C 41.394531 21.265625 39.566406 20.304688 38.460938 19.855469 C 38.460938 19.855469 40.175781 17.207031 40.578125 16.46875 C 40.882813 16.644531 43.625 18.363281 43.625 19.886719 Z M 24.421875 6.308594 C 26.578125 6.308594 29.65625 11.402344 29.65625 11.402344 C 29.65625 11.402344 24.851563 10.972656 20.898438 13.296875 C 21.003906 9.628906 22.238281 6.308594 24.421875 6.308594 Z M 15.871094 10.4375 C 16.558594 10.4375 17.230469 11.269531 17.507813 11.976563 C 17.507813 12.445313 17.75 15.171875 17.75 15.171875 L 13.789063 15.023438 C 13.789063 11.449219 15.1875 10.4375 15.871094 10.4375 Z M 15.464844 35.246094 C 13.300781 35.246094 12.851563 34.039063 12.851563 32.953125 C 12.851563 30.496094 14.8125 27.058594 14.8125 27.058594 C 14.8125 27.058594 17.011719 31.683594 20.851563 33.636719 C 18.945313 34.753906 17.375 35.246094 15.464844 35.246094 Z M 22.492188 40.089844 C 20.972656 40.089844 20.789063 39.105469 20.789063 38.878906 C 20.789063 38.171875 21.339844 37.335938 21.339844 37.335938 C 21.339844 37.335938 23.890625 35.613281 24.054688 35.429688 L 25.9375 38.945313 C 25.9375 38.945313 24.007813 40.089844 22.492188 40.089844 Z M 27.226563 38.171875 C 26.300781 36.554688 25.621094 34.867188 25.621094 34.867188 C 25.621094 34.867188 29.414063 35.113281 31.453125 33.007813 C 30.183594 33.578125 28.15625 34.300781 25.800781 34.082031 C 30.726563 29.742188 33.601563 26.597656 36.03125 23.34375 C 35.824219 23.09375 34.710938 22.316406 34.4375 22.1875 C 32.972656 23.953125 27.265625 30.054688 21.984375 33.074219 C 15.292969 29.425781 13.890625 18.691406 13.746094 16.460938 L 17.402344 16.8125 C 17.402344 16.8125 16.027344 19.246094 16.027344 21.039063 C 16.027344 22.828125 16.242188 22.925781 16.242188 22.925781 C 16.242188 22.925781 16.195313 19.800781 18.125 17.390625 C 19.59375 25.210938 21.125 29.21875 22.320313 31.605469 C 22.925781 31.355469 24.058594 30.851563 24.058594 30.851563 C 24.058594 30.851563 20.683594 21.121094 20.871094 14.535156 C 22.402344 13.71875 24.667969 12.875 27.226563 12.875 C 33.957031 12.875 39.367188 15.773438 39.367188 15.773438 L 37.25 18.730469 C 37.25 18.730469 35.363281 15.3125 32.699219 14.703125 C 34.105469 15.753906 35.679688 17.136719 36.496094 19.128906 C 30.917969 16.949219 24.1875 15.796875 22.027344 15.542969 C 21.839844 16.339844 21.863281 17.480469 21.863281 17.480469 C 21.863281 17.480469 30.890625 19.144531 37.460938 22.90625 C 37.414063 31.125 28.460938 37.4375 27.226563 38.171875 Z M 35.777344 32.027344 C 35.777344 32.027344 38.578125 28.347656 38.535156 23.476563 C 38.535156 23.476563 43.0625 26.28125 43.0625 29.015625 C 43.0625 32.074219 35.777344 32.027344 35.777344 32.027344 Z "></path></g></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_epicgames'] AND $__vars['ahGPStatus']['ah_epicgames']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--epicgames" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_epicgames']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50"><path d="M 10 3 C 6.69 3 4 5.69 4 9 L 4 41.240234 L 25 47.539062 L 46 41.240234 L 46 9 C 46 5.69 43.31 3 40 3 L 10 3 z M 11 8 L 15 8 L 15 11 L 11 11 L 11 18 L 14 18 L 14 21 L 11 21 L 11 28 L 15 28 L 15 31 L 11 31 C 9.34 31 8 29.66 8 28 L 8 11 C 8 9.34 9.34 8 11 8 z M 17 8 L 23 8 C 24.66 8 26 9.34 26 11 L 26 18 C 26 19.66 24.66 21 23 21 L 20 21 L 20 31 L 17 31 L 17 8 z M 28 8 L 31 8 L 31 31 L 28 31 L 28 8 z M 36 8 L 39 8 C 40.66 8 42 9.34 42 11 L 42 15 L 39 15 L 39 11 L 36 11 L 36 28 L 39 28 L 39 24 L 42 24 L 42 28 C 42 29.66 40.66 31 39 31 L 36 31 C 34.34 31 33 29.66 33 28 L 33 11 C 33 9.34 34.34 8 36 8 z M 20 11 L 20 18 L 23 18 L 23 11 L 20 11 z M 9 34 L 13 34 C 13.55 34 14 34.45 14 35 L 14 36 L 13 36 L 13 35.25 C 13 35.11 12.89 35 12.75 35 L 9.25 35 C 9.11 35 9 35.11 9 35.25 L 9 38.75 C 9 38.89 9.11 39 9.25 39 L 12.75 39 C 12.89 39 13 38.89 13 38.75 L 13 38 L 12 38 L 12 37 L 14 37 L 14 39 C 14 39.55 13.55 40 13 40 L 9 40 C 8.45 40 8 39.55 8 39 L 8 35 C 8 34.45 8.45 34 9 34 z M 18 34 L 19 34 L 22 40 L 21 40 L 20.5 39 L 16.5 39 L 16 40 L 15 40 L 18 34 z M 23 34 L 24 34 L 26 38 L 28 34 L 29 34 L 29 40 L 28 40 L 28 36 L 26.5 39 L 25.5 39 L 24 36 L 24 40 L 23 40 L 23 34 z M 30 34 L 35 34 L 35 35 L 31 35 L 31 36.5 L 33 36.5 L 33 37.5 L 31 37.5 L 31 39 L 35 39 L 35 40 L 30 40 L 30 34 z M 37 34 L 41 34 C 41.55 34 42 34.45 42 35 L 42 35.5 L 41 35.5 L 41 35.25 C 41 35.11 40.89 35 40.75 35 L 37.25 35 C 37.11 35 37 35.11 37 35.25 L 37 36.25 C 37 36.39 37.11 36.5 37.25 36.5 L 41 36.5 C 41.55 36.5 42 36.95 42 37.5 L 42 39 C 42 39.55 41.55 40 41 40 L 37 40 C 36.45 40 36 39.55 36 39 L 36 38.5 L 37 38.5 L 37 38.75 C 37 38.89 37.11 39 37.25 39 L 40.75 39 C 40.89 39 41 38.89 41 38.75 L 41 37.75 C 41 37.61 40.89 37.5 40.75 37.5 L 37 37.5 C 36.45 37.5 36 37.05 36 36.5 L 36 35 C 36 34.45 36.45 34 37 34 z M 18.5 35 L 17 38 L 20 38 L 18.5 35 z"></path></svg>
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_oculus'] AND $__vars['ahGPStatus']['ah_oculus']) {
		$__compilerTemp1 .= '
				<a href="https://forums.oculusvr.com/community/profile/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_oculus']) . '" target="_blank">
					<span class="ah-gp-icon ah-gp-icon--oculus" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_oculus']) . '">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M12.09 9.3c-.213.147-.45.236-.704.277-.255.04-.508.033-.762.033H5.376c-.255 0-.508.008-.763-.033-.254-.042-.49-.13-.705-.278-.428-.3-.685-.78-.685-1.3 0-.53.258-1.01.686-1.3.21-.15.45-.24.7-.28.25-.04.5-.04.76-.04h5.25c.25 0 .51-.01.76.03s.49.13.7.27c.43.29.68.78.68 1.3s-.26 1-.69 1.3zm2.116-5.037c-.563-.452-1.208-.764-1.91-.933-.4-.097-.803-.14-1.215-.153-.3-.01-.6-.007-.91-.007H5.84c-.305 0-.61-.003-.915.007-.412.014-.814.056-1.216.153-.7.17-1.35.482-1.91.934C.66 5.174 0 6.547 0 8c0 1.454.66 2.827 1.793 3.737.564.452 1.21.764 1.91.933.402.097.804.14 1.216.153.3.01.6.007.91.007h4.33c.3 0 .61.003.91-.007.41-.013.81-.056 1.21-.153.7-.17 1.34-.482 1.91-.934C15.34 10.826 16 9.453 16 8c0-1.454-.66-2.827-1.794-3.737z" fill-rule="nonzero"/></svg>
					</span>
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_secondlife'] AND $__vars['ahGPStatus']['ah_secondlife']) {
		$__compilerTemp1 .= '
				<a href="https://my.secondlife.com/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_secondlife']) . '" class="ah-gp-icon ah-gp-icon--secondlife" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_secondlife']) . '">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 192 192"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#000000"><g id="surface1"><path d="M86.115,11.58c-3.765,0.3 -5.91,2.475 -6.885,5.91c-0.81,2.85 -0.99,5.745 -0.705,8.7c1.455,14.835 2.76,29.685 4.35,44.505c0.825,7.56 1.65,15.135 3.54,22.515c0.915,3.54 3.63,4.77 7.17,4.575c3.39,-0.18 4.95,-2.04 5.535,-5.22c0.885,-4.665 0.375,-9.345 0.72,-15.66c-0.9,-16.485 -1.845,-34.59 -2.94,-52.695c-0.18,-2.88 -0.675,-5.79 -2.16,-8.445c-1.905,-3.405 -4.905,-4.5 -8.625,-4.185zM122.175,21.36c-3.21,0.27 -5.655,2.7 -6.72,7.2c-0.855,3.705 -1.26,7.5 -1.695,11.28c-1.86,16.575 -4.275,33.105 -4.875,50.565c0,0.27 0.03,1.29 0,2.31c-0.15,3.78 1.53,6.135 5.415,6.885c4.41,0.84 5.925,-2.025 6.735,-5.34c3.525,-14.085 5.31,-28.47 7.365,-42.81c1.005,-6.945 2.67,-13.815 2.745,-20.865c0.06,-5.49 -2.73,-8.745 -7.545,-9.225c-0.48,-0.045 -0.96,-0.045 -1.425,0zM53.49,23.16c-0.51,0.015 -1.035,0.075 -1.575,0.18c-4.755,0.975 -6.855,3.825 -6.855,10.56c0.105,0.675 0.3,2.58 0.72,4.41c2.505,10.695 4.98,21.405 7.605,32.07c2.235,9.09 5.01,18.06 8.235,26.88c1.38,3.795 4.74,5.535 8.46,4.695c3.855,-0.855 4.755,-3.585 4.56,-6.99c-0.075,-1.32 -0.21,-2.625 -0.375,-3.93c-1.725,-12.765 -4.26,-25.395 -6.9,-37.995c-1.65,-7.86 -2.43,-15.945 -5.385,-23.52c-1.62,-4.185 -4.875,-6.435 -8.49,-6.36zM150.225,45.21c-3.12,-0.21 -4.98,1.95 -6.36,4.59c-0.96,1.815 -1.725,3.765 -2.16,5.745c-3.18,14.13 -7.095,28.095 -9.885,42.315c-0.765,3.825 0,6.42 3.75,7.68c4.08,1.365 5.565,-1.53 6.885,-4.485c4.5,-10.095 7.59,-20.625 10.305,-31.275c1.41,-5.505 3.885,-10.755 4.5,-16.455c0.315,-4.17 -1.59,-6.795 -5.625,-7.86c-0.495,-0.135 -0.96,-0.225 -1.41,-0.255zM32.76,83.265c-2.01,0.24 -2.49,1.74 -2.04,4.515c2.385,14.805 2.37,29.76 2.745,44.7c0.51,20.295 11.955,35.955 31.44,42.645c15.51,5.31 31.515,6.54 47.7,4.275c11.19,-1.575 22.125,-7.275 29.865,-15.81c17.715,-19.515 10.11,-48.645 -14.97,-57.03c-8.265,-2.775 -18.12,-3.33 -28.155,-3.42c-3.525,0 -7.02,0.375 -11.145,0.945c-11.925,1.62 -22.77,5.97 -31.23,15c-2.985,3.18 -2.925,6.66 -0.15,9.345c3.135,3.045 5.85,1.74 8.58,-0.675c3.225,-2.835 7.185,-5.28 11.475,-6.51c0.99,-0.3 2.115,-0.705 3.015,0c1.155,0.9 0.12,1.92 -0.21,2.775c-1.83,4.68 -1.935,9.39 -0.705,14.22c3.195,12.42 13.335,19.245 27.03,17.22c10.47,-1.545 18.63,-12.72 17.97,-23.88c-0.165,-2.94 -1.23,-5.43 -3.405,-7.41c-1.2,-1.095 -2.7,-1.335 -4.17,-0.69c-1.32,0.585 -1.29,1.74 -1.065,3.015c0.585,3.45 -0.975,4.71 -4.44,4.71c-3.42,0 -5.085,-2.295 -4.695,-5.58c0.375,-3.105 2.55,-4.845 5.46,-5.775c11.175,-3.54 24.315,5.265 25.02,16.725c0.795,13.275 -8.22,24.435 -22.86,28.035c-10.215,2.505 -20.535,1.725 -30.66,-0.15c-20.37,-3.765 -34.155,-13.905 -33.615,-38.82c0.225,-10.11 -0.045,-20.235 -1.77,-30.24c-1.17,-6.765 -5.55,-10.65 -12.495,-11.955c-1.02,-0.21 -1.86,-0.255 -2.52,-0.18z"></path></g></g></g></svg>
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_discord'] AND $__vars['ahGPStatus']['ah_discord']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--discord" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_discord']) . '">
					' . $__templater->fontAwesome('fab fa-discord', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_twitch'] AND $__vars['ahGPStatus']['ah_twitch']) {
		$__compilerTemp1 .= '
				<a href="https://www.twitch.tv/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_twitch']) . '" class="ah-gp-icon ah-gp-icon--twitch" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_twitch']) . '" target="_blank">
					' . $__templater->fontAwesome('fab fa-twitch', array(
		)) . '
				</a>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_mixer'] AND $__vars['ahGPStatus']['ah_mixer']) {
		$__compilerTemp1 .= '
				<a href="https://www.mixer.com/' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_mixer']) . '" class="ah-gp-icon ah-gp-icon--mixer" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_mixer']) . '" target="_blank">
					<svg viewBox="0 0 24 20">
    					<path d="M5.68,3.96L11.41,11.65C11.55,11.84 11.55,12.1 11.41,12.29L5.65,20L5.5,20.18C4.76,21 3.47,21.07 2.64,20.31C1.85,19.59 1.79,18.37 2.43,17.5L6.56,11.97L2.46,6.47C1.83,5.62 1.88,4.39 2.67,3.67L2.82,3.54C3.73,2.87 5,3.05 5.68,3.96M18.32,3.96C19,3.05 20.27,2.87 21.18,3.54L21.33,3.67C22.12,4.39 22.17,5.61 21.54,6.47L17.44,11.97L21.57,17.5C22.21,18.36 22.15,19.59 21.36,20.31C20.53,21.07 19.24,21 18.5,20.18L18.35,20L12.59,12.29C12.45,12.1 12.45,11.84 12.59,11.65L18.32,3.96Z" />
					</svg>
				</a>
			';
	}
	$__compilerTemp1 .= '

			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['ah_youtube'] AND $__vars['ahGPStatus']['ah_youtube']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--youtube" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['ah_youtube']) . '">
					' . $__templater->fontAwesome('fab fa-youtube', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['facebook'] AND $__vars['ahGPStatus']['facebook']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--facebook" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['facebook']) . '">
					' . $__templater->fontAwesome('fab fa-facebook', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['twitter'] AND $__vars['ahGPStatus']['twitter']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--twitter" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['twitter']) . '">
					' . $__templater->fontAwesome('fab fa-twitter', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
			' . '
			';
	if ($__vars['user']['Profile']['custom_fields']['skype'] AND $__vars['ahGPStatus']['skype']) {
		$__compilerTemp1 .= '
				<span class="ah-gp-icon ah-gp-icon--skype" data-xf-init="tooltip" title="' . $__templater->escape($__vars['user']['Profile']['custom_fields']['skype']) . '">
					' . $__templater->fontAwesome('fab fa-skype', array(
		)) . '
				</span>
			';
	}
	$__compilerTemp1 .= '
			
		';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
		<div class="ah-gp-icons-container">
		' . $__compilerTemp1 . '
		</div>
	';
	}
	$__finalCompiled .= '
	
';
	return $__finalCompiled;
},
'ah_gamerprofiles_message' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIcons', array())) {
		$__finalCompiled .= '
		';
		if ((((((((($__vars['user']['Profile']['custom_fields']['ah_playstation'] OR $__vars['user']['Profile']['custom_fields']['ah_xbox']) OR $__vars['user']['Profile']['custom_fields']['ah_steam']) OR $__vars['user']['Profile']['custom_fields']['ah_discord']) OR $__vars['user']['Profile']['custom_fields']['ah_twitch']) OR $__vars['user']['Profile']['custom_fields']['ah_mixer']) OR $__vars['user']['Profile']['custom_fields']['ah_youtube']) OR $__vars['user']['Profile']['custom_fields']['facebook']) OR $__vars['user']['Profile']['custom_fields']['twitter']) OR $__vars['user']['Profile']['custom_fields']['skype']) {
			$__finalCompiled .= '
			<div class="ah-gp-message">
				' . $__templater->callMacro('ah_gamerprofiles_macros', 'ah_gamerprofiles_icons', array(
				'user' => $__vars['user'],
			), $__vars) . '
			</div>
		';
		}
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'ah_gamerprofiles_member_tooltip' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewIcons', array())) {
		$__finalCompiled .= '
		';
		if ($__templater->fn('property', array('ahGPTooltip', ), false)) {
			$__finalCompiled .= '
			';
			if (((((((((((($__vars['user']['Profile']['custom_fields']['ah_playstation'] OR $__vars['user']['Profile']['custom_fields']['ah_xbox']) OR $__vars['user']['Profile']['custom_fields']['ah_steam']) OR $__vars['user']['Profile']['custom_fields']['ah_origin']) OR $__vars['user']['Profile']['custom_fields']['ah_battlenet']) OR $__vars['user']['Profile']['custom_fields']['ah_epicgames']) OR $__vars['user']['Profile']['custom_fields']['ah_discord']) OR $__vars['user']['Profile']['custom_fields']['ah_twitch']) OR $__vars['user']['Profile']['custom_fields']['ah_mixer']) OR $__vars['user']['Profile']['custom_fields']['ah_youtube']) OR $__vars['user']['Profile']['custom_fields']['facebook']) OR $__vars['user']['Profile']['custom_fields']['twitter']) OR $__vars['user']['Profile']['custom_fields']['skype']) {
				$__finalCompiled .= '
				<div class="ah-gamerprofiles-memberTooltip">
					' . $__templater->callMacro('ah_gamerprofiles_macros', 'ah_gamerprofiles_tooltip_icons', array(
					'user' => $__vars['user'],
				), $__vars) . '
				</div>
			';
			}
			$__finalCompiled .= '
		';
		}
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