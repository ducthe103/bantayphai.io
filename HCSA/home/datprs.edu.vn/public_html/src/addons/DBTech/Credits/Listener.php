<?php

namespace DBTech\Credits;

use XF\Container;
use DBTech\Credits\Entity\Currency;

class Listener
{
	/**
	 * The product ID (in the DBTech store)
	 * @var integer
	 */
	protected static $_productId = 339;
	
	
	/**
	 * @param \XF\Pub\App $app
	 */
	public static function appPubSetup(
		\XF\Pub\App $app
	)
	{
		
	}
	
	/**
	 * @param \XF\App $app
	 *
	 * @throws \XF\Db\Exception
	 */
	public static function appSetup(\XF\App $app)
	{
		$container = $app->container();
		
		$container['dbtechCredits.currencies'] = $app->fromRegistry('dbtCreditsCurrencies',
			function(Container $c) { return $c['em']->getRepository('DBTech\Credits:Currency')->rebuildCache(); },
			function(array $currencies)
			{
				$em = \XF::em();
				
				$entities = [];
				foreach ($currencies as $currencyId => $currency)
				{
					$entities[$currencyId] = $em->instantiateEntity('DBTech\Credits:Currency', $currency);
				}
				
				return $em->getBasicCollection($entities);
			}
		);
	}
	
	/**
	 * @param \XF\Template\Templater $templater
	 * @param $type
	 * @param $template
	 * @param $name
	 * @param array $arguments
	 * @param array $globalVars
	 */
	public static function templaterMacroPreRender(\XF\Template\Templater $templater, &$type, &$template, &$name, array &$arguments, array &$globalVars)
	{
		if ($arguments['group']->group_id == 'dbtech_credits')
		{
			// Override template name
			$template = 'dbtech_credits_option_macros';
		}
	}
	
	/**
	 * @param \XF\Pub\App $app
	 * @param \XF\Http\Response $response
	 *
	 * @throws \Exception
	 */
	public static function appPubComplete(\XF\Pub\App $app, \XF\Http\Response &$response)
	{
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		$options = \XF::options();
		
		/** @var \XF\Mvc\Entity\ArrayCollection $currencies */
		$container = \XF::app()->container();
		if ($visitor->user_id && isset($container['dbtechCredits.currencies']) && $currencies = $container['dbtechCredits.currencies'])
		{
			$currencies = $currencies->filter(function(Currency $currency)
			{
				if (!$currency->isActive())
				{
					return null;
				}
				
				return $currency;
			});
			
			// Get today's timestamp
			$dt = new \DateTime('today', new \DateTimeZone($options->guestTimeZone));
			$today = $dt->getTimestamp();
			
			/** @var \DBTech\Credits\Repository\EventTrigger $eventTriggerRepo */
			$eventTriggerRepo = \XF::repository('DBTech\Credits:EventTrigger');
			
			$daily = $eventTriggerRepo->getHandler('daily');
			$interest = $eventTriggerRepo->getHandler('interest');
			$taxation = $eventTriggerRepo->getHandler('taxation');
			$paycheck = $eventTriggerRepo->getHandler('paycheck');
			
			$interestInterval = ($options->dbtech_credits_eventtrigger_interest_interval * 86400);
			$taxationInterval = ($options->dbtech_credits_eventtrigger_taxation_interval * 86400);
			$paycheckInterval = ($options->dbtech_credits_eventtrigger_paycheck_interval * 86400);
			
			foreach ($currencies as $currencyId => $currency)
			{
				if (
					$daily->isActive()
					&& $today > $visitor->dbtech_credits_lastdaily
				)
				{
					$daily->apply('', [
						'timestamp' => $today,
						'currency_id' => $currencyId
					]);
				}
				
				if (
					$interest->isActive()
					&& $visitor->dbtech_credits_lastinterest < (\XF::$time - $interestInterval)
				)
				{
					
					// If we have never received interest before, kick it
					$maxTimes = !$visitor->dbtech_credits_lastinterest ? 1 : floor(($today - $visitor->dbtech_credits_lastinterest) / $interestInterval);
					
					for ($i = 1; $i <= $maxTimes; $i++)
					{
						// Shorthand
						$timeStamp = !$visitor->dbtech_credits_lastinterest ? $today : ($visitor->dbtech_credits_lastinterest + ($interestInterval * $i));
						
						$interest->apply('', [
							'multiplier' => $visitor->{$currency['column']},
							'timestamp' => $timeStamp,
							'currency_id' => $currencyId
						]);
					}
				}
				
				if (
					$taxation->isActive()
					&& $visitor->dbtech_credits_lasttaxation < (\XF::$time - $taxationInterval)
				)
				{
					// If we have never received taxation before, kick it
					$maxTimes = !$visitor->dbtech_credits_lasttaxation ? 1 : floor(($today - $visitor->dbtech_credits_lasttaxation) / $taxationInterval);
					
					for ($i = 1; $i <= $maxTimes; $i++)
					{
						// Shorthand
						$timeStamp = !$visitor->dbtech_credits_lasttaxation ? $today : ($visitor->dbtech_credits_lasttaxation + ($taxationInterval * $i));
						
						$taxation->apply('', [
							'multiplier' => (-1 * $visitor->{$currency['column']}),
							'timestamp' => $timeStamp,
							'currency_id' => $currencyId
						]);
					}
				}
				
				if (
					$paycheck->isActive()
					&& $visitor->dbtech_credits_lastpaycheck < (\XF::$time - $paycheckInterval)
				)
				{
					// If we have never received paycheck before, kick it
					$maxTimes = !$visitor->dbtech_credits_lastpaycheck ? 1 : floor(($today - $visitor->dbtech_credits_lastpaycheck) / $paycheckInterval);
					
					for ($i = 1; $i <= $maxTimes; $i++)
					{
						// Shorthand
						$timeStamp = !$visitor->dbtech_credits_lastpaycheck ? $today : ($visitor->dbtech_credits_lastpaycheck + ($paycheckInterval * $i));
						
						$paycheck->apply('', [
							'timestamp' => $timeStamp,
							'currency_id' => $currencyId
						]);
					}
				}
			}
		}
	}
	
	/**
	 * @param \XF\Pub\App $app
	 * @param array $params
	 * @param \XF\Mvc\Reply\AbstractReply $reply
	 * @param \XF\Mvc\Renderer\AbstractRenderer $renderer
	 */
	public static function appPubRenderPage(\XF\Pub\App $app, array &$params, \XF\Mvc\Reply\AbstractReply $reply, \XF\Mvc\Renderer\AbstractRenderer $renderer)
	{
		if (
			\XF::options()->dbtech_credits_navbar['enabled'] == 3
			&& isset($params['pageSection'])
			&& $params['pageSection'] == 'dbtechCredits'
		)
		{
			// Override this and reset the nav
			$params['pageSection'] = 'dbtechShop';
			
			// note that this intentionally only selects a top level entry
			$selectedNavEntry = isset($params['navTree'][$params['pageSection']]) ? $params['navTree'][$params['pageSection']] : null;
			$params['selectedNavEntry'] = $selectedNavEntry;
			$params['selectedNavChildren'] = !empty($selectedNavEntry['children']) ? $selectedNavEntry['children'] : [];
		}
	}
	
	/**
	 * @param $rule
	 * @param array $data
	 * @param \XF\Entity\User $user
	 * @param $returnValue
	 */
	public static function criteriaUser($rule, array $data, \XF\Entity\User $user, &$returnValue)
	{
		$container = \XF::app()->container();
		if (isset($container['dbtechCredits.currencies']) && $currencies = $container['dbtechCredits.currencies'])
		{
			$currencies = $currencies->filter(function(Currency $currency)
			{
				if (!$currency->isActive())
				{
					return null;
				}
				
				return $currency;
			});
			
			foreach ($currencies as $currencyId => $currency)
			{
				if ($rule == 'dbtech_credits_currency_' . $currencyId . '_less')
				{
					if ($user->{$currency['column']} < $data['amount'])
					{
						$returnValue = true;
						break;
					}
				}
				else if ($rule == 'dbtech_credits_currency_' . $currencyId . '_more')
				{
					if ($user->{$currency['column']} > $data['amount'])
					{
						$returnValue = true;
						break;
					}
				}
			}
		}
	}
	
	/**
	 * @param \XF\Pub\App $app
	 * @param array $navigationFlat
	 * @param array $navigationTree
	 */
	public static function navigationSetup(\XF\Pub\App $app, array &$navigationFlat, array &$navigationTree)
	{
		if (!isset($navigationFlat['dbtechCredits']) OR !isset($navigationTree['dbtechCredits']))
		{
			return;
		}
		
		/** @var \DBTech\Credits\XF\Entity\User $visitor */
		$visitor = \XF::visitor();
		
		/** @var \XF\Mvc\Entity\ArrayCollection $currencies */
		$container = $app->container();
		if (isset($container['dbtechCredits.currencies']) && $currencies = $container['dbtechCredits.currencies'])
		{
			/** @var \DBTech\Credits\Entity\Currency[]|\XF\Mvc\Entity\ArrayCollection $currencies */
			$currencies = $currencies->filterViewable();
			
			$children = [];
			
			foreach ($currencies as $currency)
			{
				// Set the child element
				$children['dbtechCreditsCurrency' . $currency->currency_id] = [
					'title' => \XF::phrase('dbtech_credits_footer_currency_phrase', [
						'currency' => $currency->title,
						'prefix' => $currency->prefix,
						'amount' => $currency->getValueFromUser(),
						'suffix' => $currency->suffix
					]),
					'href' => $app->router('public')->buildLink('dbtech-credits/currency', $currency),
					'attributes' => [
						'rel' => 'nofollow',
						'data-xf-click' => 'overlay',
						'class' => 'menu-footer'
					],
				];
				
				if ($visitor->user_id && $currency->is_display_currency)
				{
					$navigationFlat['dbtechCredits']['title'] = \XF::phrase('dbtech_credits_display_currency_phrase', [
						'currency' => $currency->title,
						'prefix' => $currency->prefix,
						'amount' => $currency->getValueFromUser(),
						'suffix' => $currency->suffix
					]);
				}
			}
			
			// Add the child elements
			$navigationFlat['dbtechCredits']['children'] = array_merge($navigationFlat['dbtechCredits']['children'], $children);
			
			$addOns = $container['addon.cache'];
			
			if (
				array_key_exists('DBTech/Shop', $addOns)
				&& \XF::options()->dbtech_credits_navbar['enabled'] == 3
				&& $visitor->hasPermission('dbtech_shop', 'view')
				&& !empty($navigationFlat['dbtechShop'])
			)
			{
				// Add the child elements
				$navigationFlat['dbtechShop']['children'] = array_merge($navigationFlat['dbtechShop']['children'], $navigationFlat['dbtechCredits']['children']);
			}
		}
	}
	
	/**
	 * @param array $data
	 * @param \XF\Mvc\Controller $controller
	 */
	public static function editorDialog(array &$data, \XF\Mvc\Controller $controller)
	{
		$data['template'] = 'dbtech_credits_editor_dialog_charge';
		$data['params']['currency'] = \XF::repository('DBTech\Credits:Currency')->getChargeCurrency();
	}
}