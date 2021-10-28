<?php
// FROM HASH: ae7cfaee1238974fb9195401a97847aa
return array('macros' => array('visitor_panel_row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
		<div class="contentRow">
			<div class="contentRow-figure">
				<span class="avatarWrapper">
					' . $__templater->fn('avatar', array($__vars['xf']['visitor'], 'm', false, array(
		'href' => '',
		'notooltip' => 'true',
	))) . '
					';
	if ($__templater->method($__vars['xf']['visitor'], 'canUploadAvatar', array())) {
		$__finalCompiled .= '
						<a class="avatarWrapper-update" href="' . $__templater->fn('link', array('account/avatar', ), true) . '" data-xf-click="overlay"><span>' . 'Sửa' . '</span></a>
					';
	}
	$__finalCompiled .= '
				</span>
			</div>
			<div class="contentRow-main">
				<h3 class="contentRow-header">' . $__templater->fn('username_link', array($__vars['xf']['visitor'], true, array(
		'notooltip' => 'true',
	))) . '</h3>
				<div class="contentRow-lesser">
					' . $__templater->fn('user_title', array($__vars['xf']['visitor'], false, array(
	))) . '
				</div>

				<div class="contentRow-minor">
					' . $__templater->includeTemplate('dbtech_credits_member_dropdown', $__vars) . '
				' . '
					<dl class="pairs pairs--justified fauxBlockLink">
						<dt>' . 'Bài viết' . '</dt>
						<dd>
							<a href="' . $__templater->fn('link', array('search/member', null, array('user_id' => $__vars['xf']['visitor']['user_id'], ), ), true) . '" class="fauxBlockLink-linkRow u-concealed">
								' . $__templater->filter($__vars['xf']['visitor']['message_count'], array(array('number', array()),), true) . '
							</a>
						</dd>
					</dl>
					' . '
					<dl class="pairs pairs--justified fauxBlockLink">
						<dt>' . 'Reaction score' . '</dt>
						<dd>
							<a href="' . $__templater->fn('link', array('account/reactions', ), true) . '" class="fauxBlockLink-linkRow u-concealed">
								' . $__templater->filter($__vars['xf']['visitor']['reaction_score'], array(array('number', array()),), true) . '
							</a>
						</dd>
					</dl>
					' . '
					';
	if ($__vars['xf']['options']['enableTrophies']) {
		$__finalCompiled .= '
						<dl class="pairs pairs--justified fauxBlockLink">
							<dt>' . 'Điểm thành tích' . '</dt>
							<dd>
								<a href="' . $__templater->fn('link', array('members/trophies', $__vars['xf']['visitor'], ), true) . '" data-xf-click="overlay" class="fauxBlockLink-linkRow u-concealed">
									' . $__templater->filter($__vars['xf']['visitor']['trophy_points'], array(array('number', array()),), true) . '
								</a>
							</dd>
						</dl>
					';
	}
	$__finalCompiled .= '
				</div>
			</div>
		</div>
	';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
				';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewBookmarks', array())) {
		$__compilerTemp1 .= '
					<a href="' . $__templater->fn('link', array('account/bookmarks', ), true) . '" class="tabs-tab" role="tab" tabindex="0" aria-controls="' . $__templater->fn('unique_id', array('accountMenuBookmarks', ), true) . '">' . 'Bookmarks' . '</a>
				';
	}
	$__compilerTemp1 .= '
				' . '
			';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
	<h4 class="menu-tabHeader tabs" data-xf-init="tabs" role="tablist">
		<span class="hScroller" data-xf-init="h-scroller">
			<span class="hScroller-scroll">
				<a href="' . $__templater->fn('link', array('account', ), true) . '" class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="' . $__templater->fn('unique_id', array('accountMenu', ), true) . '">' . 'Tài khoản của bạn' . '</a>
			' . $__compilerTemp1 . '
			</span>
		</span>
	</h4>
	';
		$__vars['hasTabs'] = true;
		$__finalCompiled .= '
';
	}
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__vars['xf']['options']['enableNewsFeed']) {
		$__compilerTemp2 .= '
			<li><a href="' . $__templater->fn('link', array('whats-new/news-feed', ), true) . '" class="menu-linkRow">' . 'Luồng tin' . '</a></li>
		';
	}
	$__compilerTemp3 = '';
	if ($__templater->fn('property', array('dt_condense_visito_tabs', ), false)) {
		$__compilerTemp3 .= '
			<li><a href="' . $__templater->fn('link', array('conversations', ), true) . '" class="menu-linkRow js-badge--conversations badgeContainer' . ($__vars['xf']['visitor']['conversations_unread'] ? ' badgeContainer--highlighted' : '') . '" data-badge="' . $__templater->filter($__vars['xf']['visitor']['conversations_unread'], array(array('number', array()),), true) . '">' . 'Trò chuyện' . '</a></li>
			<li><a href="' . $__templater->fn('link', array('account/alerts', ), true) . '" class="menu-linkRow js-badge--alerts badgeContainer' . ($__vars['xf']['visitor']['alerts_unread'] ? ' badgeContainer--highlighted' : '') . '" data-badge="' . $__templater->filter($__vars['xf']['visitor']['alerts_unread'], array(array('number', array()),), true) . '">' . 'Thông báo' . '</a></li>
		';
	}
	$__compilerTemp4 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canEditSignature', array())) {
		$__compilerTemp4 .= '
			<li><a href="' . $__templater->fn('link', array('account/signature', ), true) . '" class="menu-linkRow">' . 'Chữ ký' . '</a></li>
		';
	}
	$__compilerTemp5 = '';
	if ($__vars['xf']['app']['userUpgradeCount']) {
		$__compilerTemp5 .= '
			<li><a href="' . $__templater->fn('link', array('account/upgrades', ), true) . '" class="menu-linkRow">' . 'Nâng cấp Tài khoản' . '</a></li>
		';
	}
	$__compilerTemp6 = '';
	if ($__vars['xf']['app']['connectedAccountCount']) {
		$__compilerTemp6 .= '
			<li><a href="' . $__templater->fn('link', array('account/connected-accounts', ), true) . '" class="menu-linkRow">' . 'Tài khoản đã kết nối' . '</a></li>
		';
	}
	$__compilerTemp7 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canPostOnProfile', array())) {
		$__compilerTemp7 .= '
		' . $__templater->form('

			<span class="u-srOnly" id="ctrl_message">' . 'Cập nhật trạng thái' . $__vars['xf']['language']['label_separator'] . '</span>
			' . $__templater->formTextArea(array(
			'name' => 'message',
			'rows' => '1',
			'autosize' => 'true',
			'maxlength' => $__vars['xf']['options']['profilePostMaxLength'],
			'placeholder' => 'Cập nhật trạng thái' . $__vars['xf']['language']['ellipsis'],
			'data-xf-init' => 'focus-trigger user-mentioner emoji-completer',
			'data-display' => '< :next',
			'aria-labelledby' => 'ctrl_message',
		)) . '
			<div class="u-hidden u-hidden--transition u-inputSpacer">
				' . $__templater->button('Post', array(
			'type' => 'submit',
			'class' => 'button--primary',
			'icon' => 'reply',
		), '', array(
		)) . '
			</div>
		', array(
			'action' => $__templater->fn('link', array('members/post', $__vars['xf']['visitor'], ), false),
			'ajax' => 'true',
			'data-redirect' => 'off',
			'data-reset-complete' => 'true',
			'data-no-auto-focus' => 'true',
			'class' => 'menu-footer',
		)) . '
	';
	}
	$__vars['accountHtml'] = $__templater->preEscaped('
	<div class="menu-row menu-row--alt">
		' . $__templater->callMacro(null, 'visitor_panel_row', array(), $__vars) . '
	</div>

	' . '

	' . '
	<hr class="menu-separator menu-separator--hard" />

	<ul class="listPlain listColumns listColumns--narrow listColumns--together">
		' . '
		' . $__compilerTemp2 . '
		<li><a href="' . $__templater->fn('link', array('search/member', null, array('user_id' => $__vars['xf']['visitor']['user_id'], ), ), true) . '" class="menu-linkRow">' . 'Nội dung của bạn' . '</a></li>
		<li><a href="' . $__templater->fn('link', array('account/reactions', ), true) . '" class="menu-linkRow">' . 'Reactions received' . '</a></li>
		' . $__compilerTemp3 . '
		' . '
	</ul>

	' . '
	<hr class="menu-separator" />

	<ul class="listPlain listColumns listColumns--narrow listColumns--together">
		' . '
		<li><a href="' . $__templater->fn('link', array('account/account-details', ), true) . '" class="menu-linkRow">' . 'Thông tin tài khoản' . '</a></li>
		<li><a href="' . $__templater->fn('link', array('account/security', ), true) . '" class="menu-linkRow">' . 'Mật khẩu và bảo mật' . '</a></li>
		<li><a href="' . $__templater->fn('link', array('account/privacy', ), true) . '" class="menu-linkRow">' . 'Bảo mật cá nhân' . '</a></li>
		<li><a href="' . $__templater->fn('link', array('account/preferences', ), true) . '" class="menu-linkRow">' . 'Tùy chọn' . '</a></li>
		' . $__compilerTemp4 . '
		' . $__compilerTemp5 . '
		' . $__compilerTemp6 . '
		<li><a href="' . $__templater->fn('link', array('account/following', ), true) . '" class="menu-linkRow">' . 'Đang theo dõi' . '</a></li>
		<li><a href="' . $__templater->fn('link', array('account/ignored', ), true) . '" class="menu-linkRow">' . 'Bỏ qua' . '</a></li>
		' . '
	</ul>

	' . '
	<hr class="menu-separator" />

	<a href="' . $__templater->fn('link', array('logout', null, array('t' => $__templater->fn('csrf_token', array(), false), ), ), true) . '" class="menu-linkRow">' . 'Thoát' . '</a>

	' . $__compilerTemp7 . '
');
	$__finalCompiled .= '

';
	if ($__vars['hasTabs']) {
		$__finalCompiled .= '
	<ul class="tabPanes">
		<li class="is-active" role="tabpanel" id="' . $__templater->fn('unique_id', array('accountMenu', ), true) . '">
			' . $__templater->filter($__vars['accountHtml'], array(array('raw', array()),), true) . '
		</li>
		';
		if ($__templater->method($__vars['xf']['visitor'], 'canViewBookmarks', array())) {
			$__finalCompiled .= '
			<li role="tabpanel" id="' . $__templater->fn('unique_id', array('accountMenuBookmarks', ), true) . '"
				data-href="' . $__templater->fn('link', array('account/bookmarks-popup', ), true) . '"
				data-load-target=".js-bookmarksMenuBody">
				<div class="js-bookmarksMenuBody">
					<div class="menu-row">' . 'Đang tải' . $__vars['xf']['language']['ellipsis'] . '</div>
				</div>
				<div class="menu-footer menu-footer--close">
					<a href="' . $__templater->fn('link', array('account/bookmarks', ), true) . '">' . 'Xem tất cả' . $__vars['xf']['language']['ellipsis'] . '</a>
				</div>
			</li>
		';
		}
		$__finalCompiled .= '
		' . '
	</ul>
';
	} else {
		$__finalCompiled .= '
	' . $__templater->filter($__vars['accountHtml'], array(array('raw', array()),), true) . '
';
	}
	return $__finalCompiled;
});