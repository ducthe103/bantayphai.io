<?php
// FROM HASH: 759bdf36531c6690e8f28b9018c75bf4
return array('macros' => array('head' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'app' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['cssUrls'] = array('public:normalize.css', 'public:core.less', $__vars['app'] . ':app.less', );
	$__finalCompiled .= '

	' . $__templater->includeTemplate('font_awesome_setup', $__vars) . '

	<link rel="stylesheet" href="' . $__templater->fn('css_url', array($__vars['cssUrls'], ), true) . '" />

	<!--XF:CSS-->
	';
	if ($__vars['xf']['fullJs']) {
		$__finalCompiled .= '
		<script src="' . $__templater->fn('js_url', array('xf/preamble.js', ), true) . '"></script>
	';
	} else {
		$__finalCompiled .= '
		<script src="' . $__templater->fn('js_url', array('xf/preamble.min.js', ), true) . '"></script>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'body' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'app' => '!',
		'jsState' => null,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->fn('core_js') . '
';
	$__templater->inlineJs('
	$(document).ready(function() {
		$(".ah-gp-trigger").on({
			mouseover: function() {
				$(this).find(".ah-gp-profile").stop().fadeIn("fast");
			},
			mouseout: function() {
				$(this).find(".ah-gp-profile").stop().fadeOut("fast");
			}
		});
	});
');
	$__finalCompiled .= '
	<!--XF:JS-->

' . $__templater->callMacro('thspotify_spotify_macros', 'global_js', array(), $__vars) . '<script>jQuery.extend(XF.phrases, {
		brms_category:       "' . $__templater->filter('Category', array(array('escape', array('js', )),), true) . '",
		brms_download:       "' . $__templater->filter('Download', array(array('escape', array('js', )),), true) . '",
		brms_update:         "' . $__templater->filter('Cập nhật', array(array('escape', array('js', )),), true) . '",
		brms_review:         "' . $__templater->filter('Xem', array(array('escape', array('js', )),), true) . '",
		brms_rating: "' . $__templater->filter('Bình chọn', array(array('escape', array('js', )),), true) . '",
		brms_forum:          "' . $__templater->filter('Diễn đàn', array(array('escape', array('js', )),), true) . '",
		brms_views:          "' . $__templater->filter('Lượt xem', array(array('escape', array('js', )),), true) . '",
		brms_replies:        "' . $__templater->filter('Trả lời', array(array('escape', array('js', )),), true) . '",
		brms_likes:          "' . $__templater->filter('Thích', array(array('escape', array('js', )),), true) . '",
});
</script>
	<script>
		jQuery.extend(true, XF.config, {
			// ' . '
			userId: ' . $__templater->escape($__vars['xf']['visitor']['user_id']) . ',
			enablePush: ' . ($__vars['xf']['options']['enablePush'] ? 'true' : 'false') . ',
			pushAppServerKey: \'' . $__templater->escape($__vars['xf']['options']['pushKeysVAPID']['publicKey']) . '\',
			url: {
				fullBase: \'' . $__templater->filter($__templater->fn('base_url', array(null, true, ), false), array(array('escape', array('js', )),), true) . '\',
				basePath: \'' . $__templater->filter($__templater->fn('base_url', array(null, false, ), false), array(array('escape', array('js', )),), true) . '\',
				css: \'' . $__templater->filter($__templater->fn('css_url', array(array('__SENTINEL__', ), false, ), false), array(array('escape', array('js', )),), true) . '\',
				keepAlive: \'' . $__templater->filter($__templater->fn('link_type', array($__vars['app'], 'login/keep-alive', ), false), array(array('escape', array('js', )),), true) . '\'
			},
			cookie: {
				path: \'' . $__templater->filter($__vars['xf']['cookie']['path'], array(array('escape', array('js', )),), true) . '\',
				domain: \'' . $__templater->filter($__vars['xf']['cookie']['domain'], array(array('escape', array('js', )),), true) . '\',
				prefix: \'' . $__templater->filter($__vars['xf']['cookie']['prefix'], array(array('escape', array('js', )),), true) . '\',
				secure: ' . ($__vars['xf']['cookie']['secure'] ? 'true' : 'false') . '
			},
			csrf: \'' . $__templater->filter($__templater->fn('csrf_token', array(), false), array(array('escape', array('js', )),), true) . '\',
			js: {\'<!--XF:JS:JSON-->\'},
			css: {\'<!--XF:CSS:JSON-->\'},
			time: {
				now: ' . $__templater->escape($__vars['xf']['time']) . ',
				today: ' . $__templater->escape($__vars['xf']['timeDetails']['today']) . ',
				todayDow: ' . $__templater->escape($__vars['xf']['timeDetails']['todayDow']) . '
			},
			borderSizeFeature: \'' . $__templater->fn('property', array('borderSizeFeature', ), true) . '\',
			fontAwesomeWeight: \'' . $__templater->fn('fa_weight', array(), true) . '\',
			enableRtnProtect: ' . ($__vars['xf']['enableRtnProtect'] ? 'true' : 'false') . ',
			enableFormSubmitSticky: ' . ($__templater->fn('property', array('formSubmitSticky', ), false) ? 'true' : 'false') . ',
			uploadMaxFilesize: ' . $__templater->escape($__vars['xf']['uploadMaxFilesize']) . ',
			allowedVideoExtensions: ' . $__templater->filter($__vars['xf']['allowedVideoExtensions'], array(array('json', array()),array('raw', array()),), true) . ',
			shortcodeToEmoji: ' . ($__vars['xf']['options']['shortcodeToEmoji'] ? 'true' : 'false') . ',
			visitorCounts: {
				conversations_unread: \'' . $__templater->filter($__vars['xf']['visitor']['conversations_unread'], array(array('number', array()),), true) . '\',
				alerts_unread: \'' . $__templater->filter($__vars['xf']['visitor']['alerts_unread'], array(array('number', array()),), true) . '\',
				total_unread: \'' . $__templater->filter($__vars['xf']['visitor']['conversations_unread'] + $__vars['xf']['visitor']['alerts_unread'], array(array('number', array()),), true) . '\',
				title_count: ' . ($__templater->fn('in_array', array($__vars['xf']['options']['displayVisitorCount'], array('title_count', 'title_and_icon', ), ), false) ? 'true' : 'false') . ',
				icon_indicator: ' . ($__templater->fn('in_array', array($__vars['xf']['options']['displayVisitorCount'], array('icon_indicator', 'title_and_icon', ), ), false) ? 'true' : 'false') . '
			},
			jsState: ' . ($__vars['jsState'] ? $__templater->filter($__vars['jsState'], array(array('json', array()),array('raw', array()),), true) : '{}') . ',
			publicMetadataLogoUrl: \'' . ($__templater->fn('property', array('publicMetadataLogoUrl', ), false) ? $__templater->fn('base_url', array($__templater->fn('property', array('publicMetadataLogoUrl', ), false), true, ), true) : '') . '\',
			publicPushBadgeUrl: \'' . ($__templater->fn('property', array('publicPushBadgeUrl', ), false) ? $__templater->fn('base_url', array($__templater->fn('property', array('publicPushBadgeUrl', ), false), true, ), true) : '') . '\'
		});

		jQuery.extend(XF.phrases, {
			// ' . '

CMTV_Code_copied: "' . $__templater->filter('Code copied to clipboard.', array(array('escape', array('js', )),), true) . '",
			date_x_at_time_y: "' . $__templater->filter('{date} lúc {time}', array(array('escape', array('js', )),), true) . '",
			day_x_at_time_y:  "' . $__templater->filter('Lúc {time}, {day} ', array(array('escape', array('js', )),), true) . '",
			yesterday_at_x:   "' . $__templater->filter('Lúc {time} Hôm qua', array(array('escape', array('js', )),), true) . '",
			x_minutes_ago:    "' . $__templater->filter('{minutes} phút trước', array(array('escape', array('js', )),), true) . '",
			one_minute_ago:   "' . $__templater->filter('1 phút trước', array(array('escape', array('js', )),), true) . '",
			a_moment_ago:     "' . $__templater->filter('Vài giây trước', array(array('escape', array('js', )),), true) . '",
			today_at_x:       "' . $__templater->filter('Lúc {time}', array(array('escape', array('js', )),), true) . '",
			in_a_moment:      "' . $__templater->filter('In a moment', array(array('escape', array('js', )),), true) . '",
			in_a_minute:      "' . $__templater->filter('In a minute', array(array('escape', array('js', )),), true) . '",
			in_x_minutes:     "' . $__templater->filter('In {minutes} minutes', array(array('escape', array('js', )),), true) . '",
			later_today_at_x: "' . $__templater->filter('Later today at {time}', array(array('escape', array('js', )),), true) . '",
			tomorrow_at_x:    "' . $__templater->filter('Tomorrow at {time}', array(array('escape', array('js', )),), true) . '",

			day0: "' . $__templater->filter('Chủ nhật', array(array('escape', array('js', )),), true) . '",
			day1: "' . $__templater->filter('Thứ hai', array(array('escape', array('js', )),), true) . '",
			day2: "' . $__templater->filter('Thứ ba', array(array('escape', array('js', )),), true) . '",
			day3: "' . $__templater->filter('Thứ tư', array(array('escape', array('js', )),), true) . '",
			day4: "' . $__templater->filter('Thứ năm', array(array('escape', array('js', )),), true) . '",
			day5: "' . $__templater->filter('Thứ sáu', array(array('escape', array('js', )),), true) . '",
			day6: "' . $__templater->filter('Thứ bảy', array(array('escape', array('js', )),), true) . '",

			dayShort0: "' . $__templater->filter('CN', array(array('escape', array('js', )),), true) . '",
			dayShort1: "' . $__templater->filter('T2', array(array('escape', array('js', )),), true) . '",
			dayShort2: "' . $__templater->filter('T3', array(array('escape', array('js', )),), true) . '",
			dayShort3: "' . $__templater->filter('T4', array(array('escape', array('js', )),), true) . '",
			dayShort4: "' . $__templater->filter('T5', array(array('escape', array('js', )),), true) . '",
			dayShort5: "' . $__templater->filter('T6', array(array('escape', array('js', )),), true) . '",
			dayShort6: "' . $__templater->filter('T7', array(array('escape', array('js', )),), true) . '",

			month0: "' . $__templater->filter('Tháng một', array(array('escape', array('js', )),), true) . '",
			month1: "' . $__templater->filter('Tháng hai', array(array('escape', array('js', )),), true) . '",
			month2: "' . $__templater->filter('Tháng ba', array(array('escape', array('js', )),), true) . '",
			month3: "' . $__templater->filter('Tháng tư', array(array('escape', array('js', )),), true) . '",
			month4: "' . $__templater->filter('Tháng năm', array(array('escape', array('js', )),), true) . '",
			month5: "' . $__templater->filter('Tháng sáu', array(array('escape', array('js', )),), true) . '",
			month6: "' . $__templater->filter('Tháng bảy', array(array('escape', array('js', )),), true) . '",
			month7: "' . $__templater->filter('Tháng tám', array(array('escape', array('js', )),), true) . '",
			month8: "' . $__templater->filter('Tháng chín', array(array('escape', array('js', )),), true) . '",
			month9: "' . $__templater->filter('Tháng mười', array(array('escape', array('js', )),), true) . '",
			month10: "' . $__templater->filter('Tháng mười một', array(array('escape', array('js', )),), true) . '",
			month11: "' . $__templater->filter('Tháng mười hai', array(array('escape', array('js', )),), true) . '",

			active_user_changed_reload_page: "' . $__templater->filter('Thành viên đang hoạt động đã thay đổi. Tải lại trang cho phiên bản mới nhất.', array(array('escape', array('js', )),), true) . '",
			server_did_not_respond_in_time_try_again: "' . $__templater->filter('The server did not respond in time. Please try again.', array(array('escape', array('js', )),), true) . '",
			oops_we_ran_into_some_problems: "' . $__templater->filter('Rất tiếc! Chúng tôi gặp phải một số vấn đề.', array(array('escape', array('js', )),), true) . '",
			oops_we_ran_into_some_problems_more_details_console: "' . $__templater->filter('Rất tiếc! Chúng tôi gặp phải một số vấn đề. Vui lòng thử lại sau. Chi tiết lỗi c có thể có trong trình duyệt.', array(array('escape', array('js', )),), true) . '",
			file_too_large_to_upload: "' . $__templater->filter('The file is too large to be uploaded.', array(array('escape', array('js', )),), true) . '",
			uploaded_file_is_too_large_for_server_to_process: "' . $__templater->filter('The uploaded file is too large for the server to process.', array(array('escape', array('js', )),), true) . '",
			files_being_uploaded_are_you_sure: "' . $__templater->filter('Files are still being uploaded. Are you sure you want to submit this form?', array(array('escape', array('js', )),), true) . '",
			attach: "' . $__templater->filter('Đính kèm', array(array('escape', array('js', )),), true) . '",
			rich_text_box: "' . $__templater->filter('Khung soạn thảo trù phú', array(array('escape', array('js', )),), true) . '",
			close: "' . $__templater->filter('Đóng', array(array('escape', array('js', )),), true) . '",
			link_copied_to_clipboard: "' . $__templater->filter('Link copied to clipboard.', array(array('escape', array('js', )),), true) . '",
			text_copied_to_clipboard: "' . $__templater->filter('Text copied to clipboard.', array(array('escape', array('js', )),), true) . '",
			loading: "' . $__templater->filter('Đang tải' . $__vars['xf']['language']['ellipsis'], array(array('escape', array('js', )),), true) . '",

			processing: "' . $__templater->filter('Đang thực hiện', array(array('escape', array('js', )),), true) . '",
			\'processing...\': "' . $__templater->filter('Đang thực hiện' . $__vars['xf']['language']['ellipsis'], array(array('escape', array('js', )),), true) . '",

			showing_x_of_y_items: "' . $__templater->filter('Hiển thị {count} trong số {total} mục', array(array('escape', array('js', )),), true) . '",
			showing_all_items: "' . $__templater->filter('Hiển thị tất cả', array(array('escape', array('js', )),), true) . '",
			no_items_to_display: "' . $__templater->filter('No items to display', array(array('escape', array('js', )),), true) . '",

			push_enable_notification_title: "' . $__templater->filter('Push notifications enabled successfully at ' . $__vars['xf']['options']['boardTitle'] . '', array(array('escape', array('js', )),), true) . '",
			push_enable_notification_body: "' . $__templater->filter('Thank you for enabling push notifications!', array(array('escape', array('js', )),), true) . '"
		});
	</script>

	<form style="display:none" hidden="hidden">
		<input type="text" name="_xfClientLoadTime" value="" id="_xfClientLoadTime" title="_xfClientLoadTime" tabindex="-1" />
	</form>

	';
	if ($__templater->method($__vars['xf']['visitor'], 'canSearch', array()) AND ($__templater->method($__vars['xf']['request'], 'getFullRequestUri', array()) === $__templater->fn('link', array('full:index', ), false))) {
		$__finalCompiled .= '
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"url": "' . $__templater->filter($__templater->fn('link', array('canonical:index', ), false), array(array('escape', array('js', )),), true) . '",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "' . (($__templater->filter($__templater->fn('link', array('canonical:search/search', ), false), array(array('escape', array('js', )),), true) . ($__vars['xf']['options']['useFriendlyUrls'] ? '?' : '&')) . 'keywords={search_keywords}') . '",
				"query-input": "required name=search_keywords"
			}
		}
		</script>
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});