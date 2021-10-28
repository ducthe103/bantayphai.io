<?php
// FROM HASH: 5aac7ab70e416781bfd3b90ab280c7c6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="pre-footer">
	<div class="pre-footer-inner">
		<div class="pre-footer--container">
			<div class="pre-footer--column">
				';
	if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option1') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_members_online', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option2') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_forum_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option3') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_share_page', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option4') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('online_list_online_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option5') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_profile_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option6') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option7') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('member_wrapper_newest_members', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option8') {
		$__finalCompiled .= '
					<div class="pre-footer--content -social">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_social_title', ), true) . '</h3>
						<ul class="social__icons">
							';
		if ($__templater->fn('property', array('dt_extra_footer_facebook', ), false)) {
			$__finalCompiled .= '<li><a href="https://www.facebook.com/' . $__templater->fn('property', array('dt_extra_footer_facebook', ), true) . '" class="-facebook"><i class="fab fa-facebook"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_twitter', ), false)) {
			$__finalCompiled .= '<li><a href="https://twitter.com/' . $__templater->fn('property', array('dt_extra_footer_twitter', ), true) . '" class="-twitter"><i class="fab fa-twitter"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_instagram', ), false)) {
			$__finalCompiled .= '<li><a href="https://instagram.com/' . $__templater->fn('property', array('dt_extra_footer_instagram', ), true) . '" class="-instagram"><i class="fab fa-instagram"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_youtube', ), false)) {
			$__finalCompiled .= '<li><a href="http://www.youtube.com/user/' . $__templater->fn('property', array('dt_extra_footer_youtube', ), true) . '" class="-youtube"><i class="fab fa-youtube"></i></a></li>';
		}
		$__finalCompiled .= '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option9') {
		$__finalCompiled .= '
					<div class="pre-footer--content">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_custom_html_title', ), true) . '</h3>
						<div class="pre-footer-html--content">
							' . $__templater->fn('property', array('dt_extra_footer_custom_html', ), true) . '
						</div>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option10') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_1_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_1', ), true) . '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_first_column', ), false) == 'option11') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_2_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_2', ), true) . '
						</ul>
					</div>
				';
	}
	$__finalCompiled .= '
			</div>
			<div class="pre-footer--column">
				';
	if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option1') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_members_online', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option2') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_forum_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option3') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_share_page', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option4') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('online_list_online_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option5') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_profile_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option6') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option7') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('member_wrapper_newest_members', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option8') {
		$__finalCompiled .= '
					<div class="pre-footer--content -social">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_social_title', ), true) . '</h3>
						<ul class="social__icons">
							';
		if ($__templater->fn('property', array('dt_extra_footer_facebook', ), false)) {
			$__finalCompiled .= '<li><a href="https://www.facebook.com/' . $__templater->fn('property', array('dt_extra_footer_facebook', ), true) . '" class="-facebook"><i class="fab fa-facebook"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_twitter', ), false)) {
			$__finalCompiled .= '<li><a href="https://twitter.com/' . $__templater->fn('property', array('dt_extra_footer_twitter', ), true) . '" class="-twitter"><i class="fab fa-twitter"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_instagram', ), false)) {
			$__finalCompiled .= '<li><a href="https://instagram.com/' . $__templater->fn('property', array('dt_extra_footer_instagram', ), true) . '" class="-instagram"><i class="fab fa-instagram"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_youtube', ), false)) {
			$__finalCompiled .= '<li><a href="http://www.youtube.com/user/' . $__templater->fn('property', array('dt_extra_footer_youtube', ), true) . '" class="-youtube"><i class="fab fa-youtube"></i></a></li>';
		}
		$__finalCompiled .= '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option9') {
		$__finalCompiled .= '
					<div class="pre-footer--content">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_custom_html_title', ), true) . '</h3>
						<div class="pre-footer-html--content">
							' . $__templater->fn('property', array('dt_extra_footer_custom_html', ), true) . '
						</div>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option10') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_1_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_1', ), true) . '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_second_column', ), false) == 'option11') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_2_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_2', ), true) . '
						</ul>
					</div>
				';
	}
	$__finalCompiled .= '
			</div>
			<div class="pre-footer--column">
				';
	if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option1') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_members_online', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option2') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_forum_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option3') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_share_page', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option4') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('online_list_online_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option5') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_profile_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option6') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option7') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('member_wrapper_newest_members', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option8') {
		$__finalCompiled .= '
					<div class="pre-footer--content -social">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_social_title', ), true) . '</h3>
						<ul class="social__icons">
							';
		if ($__templater->fn('property', array('dt_extra_footer_facebook', ), false)) {
			$__finalCompiled .= '<li><a href="https://www.facebook.com/' . $__templater->fn('property', array('dt_extra_footer_facebook', ), true) . '" class="-facebook"><i class="fab fa-facebook"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_twitter', ), false)) {
			$__finalCompiled .= '<li><a href="https://twitter.com/' . $__templater->fn('property', array('dt_extra_footer_twitter', ), true) . '" class="-twitter"><i class="fab fa-twitter"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_instagram', ), false)) {
			$__finalCompiled .= '<li><a href="https://instagram.com/' . $__templater->fn('property', array('dt_extra_footer_instagram', ), true) . '" class="-instagram"><i class="fab fa-instagram"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_youtube', ), false)) {
			$__finalCompiled .= '<li><a href="http://www.youtube.com/user/' . $__templater->fn('property', array('dt_extra_footer_youtube', ), true) . '" class="-youtube"><i class="fab fa-youtube"></i></a></li>';
		}
		$__finalCompiled .= '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option9') {
		$__finalCompiled .= '
					<div class="pre-footer--content">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_custom_html_title', ), true) . '</h3>
						<div class="pre-footer-html--content">
							' . $__templater->fn('property', array('dt_extra_footer_custom_html', ), true) . '
						</div>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option10') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_1_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_1', ), true) . '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_third_column', ), false) == 'option11') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_2_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_2', ), true) . '
						</ul>
					</div>
				';
	}
	$__finalCompiled .= '
			</div>
			<div class="pre-footer--column">
				';
	if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option1') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_members_online', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option2') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_forum_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option3') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_share_page', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option4') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('online_list_online_statistics', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option5') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_profile_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option6') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('forum_overview_new_posts', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option7') {
		$__finalCompiled .= '
					' . $__templater->renderWidget('member_wrapper_newest_members', array(), array()) . '

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option8') {
		$__finalCompiled .= '
					<div class="pre-footer--content -social">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_social_title', ), true) . '</h3>
						<ul class="social__icons">
							';
		if ($__templater->fn('property', array('dt_extra_footer_facebook', ), false)) {
			$__finalCompiled .= '<li><a href="https://www.facebook.com/' . $__templater->fn('property', array('dt_extra_footer_facebook', ), true) . '" class="-facebook"><i class="fab fa-facebook"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_twitter', ), false)) {
			$__finalCompiled .= '<li><a href="https://twitter.com/' . $__templater->fn('property', array('dt_extra_footer_twitter', ), true) . '" class="-twitter"><i class="fab fa-twitter"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_instagram', ), false)) {
			$__finalCompiled .= '<li><a href="https://instagram.com/' . $__templater->fn('property', array('dt_extra_footer_instagram', ), true) . '" class="-instagram"><i class="fab fa-instagram"></i></a></li>';
		}
		$__finalCompiled .= '
							';
		if ($__templater->fn('property', array('dt_extra_footer_youtube', ), false)) {
			$__finalCompiled .= '<li><a href="http://www.youtube.com/user/' . $__templater->fn('property', array('dt_extra_footer_youtube', ), true) . '" class="-youtube"><i class="fab fa-youtube"></i></a></li>';
		}
		$__finalCompiled .= '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option9') {
		$__finalCompiled .= '
					<div class="pre-footer--content">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_custom_html_title', ), true) . '</h3>
						<div class="pre-footer-html--content">
							' . $__templater->fn('property', array('dt_extra_footer_custom_html', ), true) . '
						</div>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option10') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_1_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_1', ), true) . '
						</ul>
					</div>

				';
	} else if ($__templater->fn('property', array('dt_extra_footer_fourth_column', ), false) == 'option11') {
		$__finalCompiled .= '
					<div class="pre-footer--content -links">
						<h3>' . $__templater->fn('property', array('dt_extra_footer_link_2_title', ), true) . '</h3>
						<ul class="pre-footer--links">
							' . $__templater->fn('property', array('dt_extra_footer_link_2', ), true) . '
						</ul>
					</div>
				';
	}
	$__finalCompiled .= '
			</div>
		</div>
	</div>
</div>';
	return $__finalCompiled;
});