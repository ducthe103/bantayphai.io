<?php

namespace DBTech\Credits\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int post_id
 * @property string content_hash
 * @property float cost
 *
 * GETTERS
 * @property Currency Currency
 *
 * RELATIONS
 * @property \DBTech\Credits\Entity\ChargePurchase[] Purchases
 * @property \XF\Entity\Post Post
 */
class Charge extends Entity
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
		
		return $this->getEventTriggerRepo()->getHandler('content');
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
	
	/**
	 * @param Structure $structure
	 *
	 * @return Structure
	 */
	public static function getStructure(Structure $structure)
	{
		$structure->table = 'xf_dbtech_credits_charge';
		$structure->shortName = 'DBTech\Credits:Charge';
		$structure->primaryKey = ['post_id', 'content_hash'];
		$structure->columns = [
			'post_id' => ['type' => self::UINT, 'required' => true],
			'content_hash' => ['type' => self::STR, 'required' => true],
			'cost' => ['type' => self::FLOAT, 'required' => true, 'default' => 0.0],
		];
		$structure->getters = [
			'Currency' => true,
		];
		$structure->relations = [
			'Purchases' => [
				'entity' => 'DBTech\Credits:ChargePurchase',
				'type' => self::TO_MANY,
				'conditions' => [
					['post_id', '=', '$post_id'],
					['content_hash', '=', '$content_hash']
				],
				'with' => ['User'],
				'key' => 'user_id'
			],
			'Post' => [
				'entity' => 'XF:Post',
				'type' => self::TO_ONE,
				'conditions' => 'post_id',
				'with' => ['Thread']
			],
		];
		$structure->defaultWith = ['Post'];

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