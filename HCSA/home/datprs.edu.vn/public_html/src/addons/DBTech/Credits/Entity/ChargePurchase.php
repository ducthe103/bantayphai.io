<?php

namespace DBTech\Credits\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int post_id
 * @property string content_hash
 * @property int user_id
 *
 * GETTERS
 * @property Currency Currency
 *
 * RELATIONS
 * @property \DBTech\Credits\Entity\Charge Charge
 * @property \XF\Entity\Post Post
 * @property \XF\Entity\User User
 */
class ChargePurchase extends Entity
{
	/**
	 * @return \DBTech\Credits\EventTrigger\AbstractHandler|null
	 * @throws \XF\PrintableException
	 * @throws \Exception
	 */
	public function getHandler()
	{
		$currency = $this->Currency;
		$currency->verifyChargeEvent();
		
		return $this->getEventTriggerRepo()->getHandler('charge');
	}
	
	/**
	 * @return Currency
	 */
	public function getCurrency()
	{
		return $this->repository('DBTech\Credits:Currency')
			->getChargeCurrency()
		;
	}
	
	/**
	 * @param Currency|null $currency
	 */
	public function setCurrency(Currency $currency = null)
	{
		$this->_getterCache['Currency'] = $currency;
	}
	
	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_dbtech_credits_charge_purchase';
		$structure->shortName = 'DBTech\Credits:ChargePurchase';
		$structure->primaryKey = ['post_id', 'content_hash', 'user_id'];
		$structure->columns = [
			'post_id'			=> ['type' => self::UINT, 'required' => true],
			'content_hash' 		=> ['type' => self::STR, 'required' => true],
			'user_id' 			=> ['type' => self::UINT, 'required' => true],
		];
		$structure->getters = [
			'Currency' => true,
		];
		$structure->relations = [
			'Charge' => [
				'entity' => 'DBTech\Credits:Charge',
				'type' => self::TO_ONE,
				'conditions' => [
					['post_id', '=', '$post_id'],
					['content_hash', '=', '$content_hash']
				],
			],
			'Post' => [
				'entity' => 'XF:Post',
				'type' => self::TO_ONE,
				'conditions' => 'post_id',
				'primary' => true,
				'with' => ['Thread']
			],
			'User' => [
				'entity' => 'XF:User',
				'type' => self::TO_ONE,
				'conditions' => 'user_id',
				'primary' => true
			],
		];
		return $structure;
	}
	
	/**
	 * @return \DBTech\Credits\Repository\EventTrigger|\XF\Mvc\Entity\Repository
	 */
	protected function getEventTriggerRepo()
	{
		return $this->repository('DBTech\Credits:EventTrigger');
	}
}