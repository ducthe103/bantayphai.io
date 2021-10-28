<?php
// FROM HASH: 8fcb57b63e4933b3c12da162d8eec52a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Transactions');
	$__finalCompiled .= '
';
	$__templater->pageParams['pageH1'] = $__templater->preEscaped('Transactions');
	$__finalCompiled .= '

';
	$__templater->includeCss('structured_list.less');
	$__finalCompiled .= '
';
	$__templater->includeCss('dbtech_credits_transaction_list.less');
	$__finalCompiled .= '

<div class="block block--messages">

	';
	$__compilerTemp1 = '';
	$__compilerTemp1 .= '
				' . $__templater->fn('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'dbtech-credits',
		'params' => $__vars['filters'],
		'wrapperclass' => 'block-outer-main',
		'perPage' => $__vars['perPage'],
	))) . '
			';
	if (strlen(trim($__compilerTemp1)) > 0) {
		$__finalCompiled .= '
		<div class="block-outer">
			' . $__compilerTemp1 . '
		</div>
	';
	}
	$__finalCompiled .= '

	';
	$__vars['sortOrders'] = array('dateline' => 'Date', 'amount' => 'Amount', );
	$__finalCompiled .= '

	<div class="block-container">
		' . $__templater->callMacro('dbtech_credits_transaction_macros', 'list_filter_bar', array(
		'filters' => $__vars['filters'],
		'baseLinkPath' => 'dbtech-credits',
		'targetFilter' => $__vars['targetFilter'],
		'sourceFilter' => $__vars['sourceFilter'],
		'currencyFilter' => $__vars['currencyFilter'],
		'eventFilter' => $__vars['eventFilter'],
		'eventTriggerFilter' => $__vars['eventTriggerFilter'],
	), $__vars) . '

		<div class="block-body">
			';
	if (!$__templater->test($__vars['transactions'], 'empty', array())) {
		$__finalCompiled .= '
				<div class="structItemContainer">
					<div class="structItemContainer-group">
						';
		if ($__templater->isTraversable($__vars['transactions'])) {
			foreach ($__vars['transactions'] AS $__vars['transaction']) {
				$__finalCompiled .= '
							';
				$__vars['currency'] = $__vars['transaction']['Currency'];
				$__finalCompiled .= '
							';
				$__vars['event'] = $__vars['transaction']['Event'];
				$__finalCompiled .= '

							<div class="structItem ' . ($__vars['transaction']['negate'] ? 'is-deleted' : '') . '">
								<div class="structItem-cell structItem-cell--icon">
									<div class="structItem-iconContainer">
										' . $__templater->fn('avatar', array($__vars['transaction']['TargetUser'], 's', false, array(
				))) . '
										';
				if ($__vars['transaction']['user_id'] != $__vars['transaction']['source_user_id']) {
					$__finalCompiled .= '
											' . $__templater->fn('avatar', array($__vars['transaction']['SourceUser'], 's', false, array(
						'class' => 'avatar--separated structItem-secondaryIcon',
					))) . '
										';
				}
				$__finalCompiled .= '
									</div>
								</div>
								<div class="structItem-cell structItem-cell--main">
									<div class="structItem-title">
										' . $__templater->escape($__vars['event']['title']) . '
									</div>

									<div class="structItem-minor">
										<ul class="structItem-parts">
											';
				if ($__vars['transaction']['user_id'] != $__vars['transaction']['source_user_id']) {
					$__finalCompiled .= '
												<li>
													' . 'Target' . ': ' . $__templater->fn('username_link', array($__vars['transaction']['TargetUser'], true, array(
					))) . ',
													' . 'Source' . ': ' . $__templater->fn('username_link', array($__vars['transaction']['SourceUser'], true, array(
					))) . '
												</li>
												';
				} else {
					$__finalCompiled .= '
												<li>' . $__templater->fn('username_link', array($__vars['transaction']['TargetUser'], true, array(
					))) . '</li>
											';
				}
				$__finalCompiled .= '
											<li class="structItem-startDate">' . $__templater->fn('date_dynamic', array($__vars['transaction']['dateline'], array(
				))) . '</li>
											';
				if (!$__templater->test($__vars['transaction']['message'], 'empty', array())) {
					$__finalCompiled .= '
												<li>' . $__templater->escape($__vars['transaction']['message']) . '</li>
											';
				}
				$__finalCompiled .= '
										</ul>
									</div>
								</div>
								<div class="structItem-cell structItem-cell--meta structItem-cell--transaction-meta">
									<dl class="pairs pairs--justified">
										<dt>' . 'Amount' . '</dt>
										<dd><a href="' . $__templater->fn('link', array('dbtech-credits/currency', $__vars['currency'], array('user_id' => $__vars['transaction']['user_id'], ), ), true) . '" data-xf-click="overlay">
											';
				$__vars['amount'] = $__vars['transaction']['amount'];
				$__finalCompiled .= '

											';
				if (($__vars['transaction']['amount'] < 0) OR ($__vars['transaction']['negate'] AND ($__vars['transaction']['amount'] == 0))) {
					$__finalCompiled .= '
												';
					$__vars['amount'] = (($__vars['transaction']['amount'] < 0) ? ($__vars['transaction']['amount'] * -1) : $__vars['transaction']['amount']);
					$__finalCompiled .= '

												' . 'Spent ' . $__templater->filter($__vars['amount'], array(array('number', array($__vars['currency']['decimals'], )),), true) . ' ' . $__templater->escape($__vars['currency']['title']) . '' . '
											';
				} else {
					$__finalCompiled .= '
												' . 'Earned ' . $__templater->filter($__vars['transaction']['amount'], array(array('number', array($__vars['currency']['decimals'], )),), true) . ' ' . $__templater->escape($__vars['currency']['title']) . '' . '
											';
				}
				$__finalCompiled .= '
										</a></dd>
									</dl>
									<dl class="pairs pairs--justified">
										<dt>' . 'Balance' . '</dt>
										<dd><a href="' . $__templater->fn('link', array('dbtech-credits/currency', $__vars['currency'], array('user_id' => $__vars['transaction']['user_id'], ), ), true) . '" data-xf-click="overlay">' . $__templater->escape($__vars['currency']['prefix']) . $__templater->filter($__vars['transaction']['balance'], array(array('number', array($__vars['currency']['decimals'], )),), true) . $__templater->escape($__vars['currency']['suffix']) . ' ' . $__templater->escape($__vars['currency']['title']) . '</a></dd>
									</dl>
								</div>
							</div>
						';
			}
		}
		$__finalCompiled .= '
					</div>
				</div>
			';
	} else if ($__vars['filters']) {
		$__finalCompiled .= '
				<div class="block-row">' . 'There are no transactions matching your filters.' . '</div>
			';
	} else {
		$__finalCompiled .= '
				<div class="block-row">' . 'There are currently no transactions to display.' . '</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>

	';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
				' . $__templater->fn('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'dbtech-credits',
		'params' => $__vars['filters'],
		'wrapperclass' => 'block-outer-main',
		'perPage' => $__vars['perPage'],
	))) . '
			';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__finalCompiled .= '
		<div class="block-outer block-outer--after">
			' . $__compilerTemp2 . '
		</div>
	';
	}
	$__finalCompiled .= '
</div>

';
	$__templater->modifySidebarHtml('_xfWidgetPositionSidebarDbtechCreditsTransactionsSidebar', $__templater->widgetPosition('dbtech_credits_transactions_sidebar', array()), 'replace');
	return $__finalCompiled;
});