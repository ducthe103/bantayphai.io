<?php
// FROM HASH: 459f7efcf6b9cf1d0085811046cc9ee5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Information');
	$__finalCompiled .= '

';
	$__templater->includeCss('mvb_overview.less');
	$__finalCompiled .= '
';
	$__templater->includeCss('structured_list.less');
	$__finalCompiled .= '


<div class="block-rowMessage block-rowMessage--warning block-rowMessage--iconic">
	' . 'Verification - checking the profile for authenticity and compliance with the person. A distinctive sign of successful verification is a checkmark located to the right of the user name.' . ' ' . 'Verified Members' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['total']) . '
</div>


<div class="block">
	<div class="block-outer">
		' . trim('
			' . $__templater->fn('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'verification',
		'data' => $__vars['verification'],
		'wrapperclass' => 'block-outer-main',
		'perPage' => $__vars['perPage'],
	))) . '
		') . '
	</div>
	
	<div class="block-container">
		<div class="block-body">
			';
	if ($__templater->isTraversable($__vars['verification'])) {
		foreach ($__vars['verification'] AS $__vars['verifications']) {
			$__finalCompiled .= '
				<div class="block-row block-row--separated">
					' . $__templater->callMacro('member_list_macros', 'item', array(
				'user' => $__vars['verifications'],
			), $__vars) . '
				</div>
			';
		}
	}
	$__finalCompiled .= '
		</div>
	</div>
	
	<div class="block-outer block-outer--after">
		' . $__templater->fn('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'verification',
		'data' => $__vars['verification'],
		'wrapperclass' => 'block-outer-main',
		'perPage' => $__vars['perPage'],
	))) . '

		' . $__templater->fn('show_ignored', array(array(
		'wrapperclass' => 'block-outer-opposite',
	))) . '
	</div>
</div>

';
	$__templater->modifySidebarHtml(null, '
	<div class="block">
		<div class="block-container">
			<h3 class="block-minorHeader">' . 'Rules for obtaining official status for profiles' . '</h3>
			<div class="block-body block-row">
				' . '1. An important condition is the availability of unique content, community and its regular update. Links to third-party resources and the presence of any reposts, or refuse them normally. At the same time, any links and links to other social networks and services, as well as streaming resources are located in a special “Links” sidebar.<br/>
2. <b>Forbidden: the publication of spam, malicious links, mass mentioning or sending invitations and messages, artificial increase of indicators.</b><br/>
3. The profile should be updated periodically.<br/>
4. If you are sitting under a VPN, proxy, etc., then provide one of the administrators in a personal message with your real IP address. <br/>
6. Profile should not contain points of warnings, violations, complaints to arbitration. <br/>
7. The absence of multi-accounts, except for situations that were allowed by the administration. <br/>
8. There should be more than 100 messages. <br/>' . '
			</div>
		</div>
	</div>
', 'replace');
	return $__finalCompiled;
});