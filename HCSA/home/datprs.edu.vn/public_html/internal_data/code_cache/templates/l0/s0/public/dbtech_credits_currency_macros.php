<?php
// FROM HASH: 7c960e94f74085f8bf2ff02c4ea09363
return array('macros' => array('wallet' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'currency' => '!',
		'overlay' => true,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<dl class="pairs pairs--justified">
		<dt>' . $__templater->escape($__vars['currency']['title']) . '</dt>
		<dd>
			';
	if ($__vars['overlay']) {
		$__finalCompiled .= '
				<a href="' . $__templater->fn('link', array('dbtech-credits/currency', $__vars['currency'], ), true) . '" data-xf-click="overlay">' . $__templater->escape($__vars['currency']['prefix']) . $__templater->escape($__templater->method($__vars['currency'], 'getValueFromUser', array($__vars['xf']['visitor'], ))) . $__templater->escape($__vars['currency']['suffix']) . '</a>
			';
	} else {
		$__finalCompiled .= '
				' . $__templater->escape($__vars['currency']['prefix']) . $__templater->escape($__templater->method($__vars['currency'], 'getValueFromUser', array($__vars['xf']['visitor'], ))) . $__templater->escape($__vars['currency']['suffix']) . '
			';
	}
	$__finalCompiled .= '
		</dd>
	</dl>
';
	return $__finalCompiled;
},
'richest' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'currency' => '!',
		'limit' => '5',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<h3 class="block-row block-textHeader block-textHeader--scaled">' . 'Most ' . $__templater->escape($__vars['currency']['title']) . '' . '</h3>
	';
	$__compilerTemp1 = $__templater->method($__vars['currency'], 'getRichestUsers', array($__vars['limit'], ));
	if ($__templater->isTraversable($__compilerTemp1)) {
		foreach ($__compilerTemp1 AS $__vars['user']) {
			$__finalCompiled .= '
		' . $__templater->callMacro(null, 'richest_user', array(
				'user' => $__vars['user'],
				'currency' => $__vars['currency'],
			), $__vars) . '
	';
		}
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'richest_user' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'currency' => '!',
		'overlay' => true,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="block-row">
		<div class="contentRow">
			<div class="contentRow-figure">
				';
	if ($__templater->method($__vars['xf']['visitor'], 'isIgnoring', array($__vars['user']['user_id'], ))) {
		$__finalCompiled .= '
					' . $__templater->fn('avatar', array(null, 'xxs', false, array(
		))) . '
				';
	} else {
		$__finalCompiled .= '
					' . $__templater->fn('avatar', array($__vars['user'], 'xxs', false, array(
		))) . '
				';
	}
	$__finalCompiled .= '
			</div>
			<div class="contentRow-main contentRow-main--close">
				<div class="contentRow-lesser">
					';
	if ($__templater->method($__vars['xf']['visitor'], 'isIgnoring', array($__vars['user']['user_id'], ))) {
		$__finalCompiled .= '
						' . 'Ignored member' . '
					';
	} else {
		$__finalCompiled .= '
						' . $__templater->fn('username_link', array($__vars['user'], true, array(
		))) . '
					';
	}
	$__finalCompiled .= '
				</div>

				';
	if ($__vars['overlay']) {
		$__finalCompiled .= '
					<a href="' . $__templater->fn('link', array('dbtech-credits/currency', $__vars['currency'], array('user_id' => $__vars['user']['user_id'], ), ), true) . '" data-xf-click="overlay">' . $__templater->escape($__vars['currency']['prefix']) . $__templater->escape($__templater->method($__vars['currency'], 'getValueFromUser', array($__vars['user'], true, ))) . $__templater->escape($__vars['currency']['suffix']) . ' ' . $__templater->escape($__vars['currency']['title']) . '</a>
				';
	} else {
		$__finalCompiled .= '
					' . $__templater->escape($__vars['currency']['prefix']) . $__templater->escape($__templater->method($__vars['currency'], 'getValueFromUser', array($__vars['user'], ))) . $__templater->escape($__vars['currency']['suffix']) . ' ' . $__templater->escape($__vars['currency']['title']) . '
				';
	}
	$__finalCompiled .= '
			</div>
		</div>
	</div>
';
	return $__finalCompiled;
},
'purchase_option' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'event' => '!',
		'profiles' => '!',
		'currency' => '!',
		'isGift' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li>
		<div data-xf-init="payment-provider-container">
			';
	$__vars['currencyData'] = $__templater->method($__vars['xf']['app'], 'data', array('XF:Currency', ));
	$__compilerTemp1 = '';
	if ($__vars['isGift']) {
		$__compilerTemp1 .= '
					' . $__templater->formTextBoxRow(array(
			'name' => 'recipient',
			'ac' => 'single',
			'placeholder' => 'User name',
		), array(
			'label' => 'Recipient',
		)) . '
				';
	}
	$__compilerTemp2 = '';
	if (($__templater->fn('count', array($__vars['event']['settings']['payment_profile_ids'], ), false) > 1)) {
		$__compilerTemp2 .= '
							';
		$__compilerTemp3 = array(array(
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'Choose a payment method' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['event']['settings']['payment_profile_ids'])) {
			foreach ($__vars['event']['settings']['payment_profile_ids'] AS $__vars['profileId']) {
				$__compilerTemp3[] = array(
					'value' => $__vars['profileId'],
					'label' => $__templater->escape($__vars['profiles'][$__vars['profileId']]),
					'_type' => 'option',
				);
			}
		}
		$__compilerTemp2 .= $__templater->formSelect(array(
			'name' => 'payment_profile_id',
		), $__compilerTemp3) . '

							<span class="inputGroup-splitter"></span>

							';
		if ($__vars['isGift']) {
			$__compilerTemp2 .= '
								' . $__templater->button('Gift', array(
				'type' => 'submit',
				'icon' => 'purchase',
			), '', array(
			)) . '
							';
		} else {
			$__compilerTemp2 .= '
								' . $__templater->button('', array(
				'type' => 'submit',
				'icon' => 'purchase',
			), '', array(
			)) . '
								&nbsp;
								' . $__templater->button('Gift', array(
				'href' => $__templater->fn('link', array('dbtech-credits/currency/gift-purchase', $__vars['currency'], array('event_id' => $__vars['event']['event_id'], ), ), false),
				'icon' => 'gift',
				'overlay' => 'true',
			), '', array(
			)) . '
							';
		}
		$__compilerTemp2 .= '
						';
	} else {
		$__compilerTemp2 .= '
							';
		if ($__vars['isGift']) {
			$__compilerTemp2 .= '
								' . $__templater->button('Gift', array(
				'type' => 'submit',
				'icon' => 'purchase',
			), '', array(
			)) . '
							';
		} else {
			$__compilerTemp2 .= '
								' . $__templater->button('', array(
				'type' => 'submit',
				'icon' => 'purchase',
			), '', array(
			)) . '
								&nbsp;
								' . $__templater->button('Gift', array(
				'href' => $__templater->fn('link', array('dbtech-credits/currency/gift-purchase', $__vars['currency'], array('event_id' => $__vars['event']['event_id'], ), ), false),
				'icon' => 'gift',
				'overlay' => 'true',
			), '', array(
			)) . '
							';
		}
		$__compilerTemp2 .= '

							' . $__templater->formHiddenVal('payment_profile_id', $__templater->filter($__vars['event']['settings']['payment_profile_ids'], array(array('first', array()),), false), array(
		)) . '
						';
	}
	$__finalCompiled .= $__templater->form('
				' . '' . '

				' . $__compilerTemp1 . '

				' . $__templater->formRow('

					<div class="inputGroup">

						' . $__compilerTemp2 . '
					</div>
				', array(
		'label' => $__templater->escape($__vars['event']['settings']['purchase_amount']) . ' ' . $__templater->escape($__vars['currency']['title']),
		'explain' => $__templater->escape($__vars['event']['settings']['purchase_description']),
		'hint' => $__templater->escape($__vars['event']['cost_phrase']),
		'rowtype' => 'input',
	)) . '
			', array(
		'action' => $__templater->fn('link', array('purchase', array('purchasable_type_id' => 'dbtech_credits_currency', ), array('event_id' => $__vars['event']['event_id'], 'is_gift' => $__vars['isGift'], ), ), false),
		'ajax' => 'true',
	)) . '
			<div class="js-paymentProviderReply-dbtech_credits_currency' . $__templater->escape($__vars['event']['event_id']) . '"></div>
		</div>
	</li>
';
	return $__finalCompiled;
},
'currency_select' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'currencyId' => '!',
		'row' => true,
		'class' => '',
		'currencies' => null,
		'includeBlank' => true,
		'includeAny' => false,
		'includeNone' => false,
		'inputName' => 'currency_id',
		'phrase' => 'Currency',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->test($__vars['currencies'], 'empty', array())) {
		$__finalCompiled .= '
		';
		$__vars['currencies'] = $__templater->method($__templater->method($__vars['xf']['app']['em'], 'getRepository', array('DBTech\\Credits:Currency', )), 'getCurrencyTitlePairs', array());
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	$__compilerTemp1 = array();
	if ($__vars['includeBlank']) {
		$__compilerTemp1[] = array(
			'value' => '',
			'_type' => 'option',
		);
	}
	if ($__vars['includeAny']) {
		$__compilerTemp1[] = array(
			'value' => '_any',
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'Any' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		);
	}
	if ($__vars['includeNone']) {
		$__compilerTemp1[] = array(
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		);
	}
	$__compilerTemp1 = $__templater->mergeChoiceOptions($__compilerTemp1, $__vars['currencies']);
	$__vars['select'] = $__templater->preEscaped('
		' . $__templater->formSelect(array(
		'name' => $__vars['inputName'],
		'value' => $__vars['currencyId'],
		'class' => $__vars['class'],
	), $__compilerTemp1) . '
	');
	$__finalCompiled .= '
	';
	if ($__vars['row']) {
		$__finalCompiled .= '
		' . $__templater->formRow('

			' . $__templater->filter($__vars['select'], array(array('raw', array()),), true) . '
		', array(
			'rowtype' => 'input',
			'label' => $__templater->escape($__vars['phrase']),
		)) . '
		';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['select'], array(array('raw', array()),), true) . '
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

';
	return $__finalCompiled;
});