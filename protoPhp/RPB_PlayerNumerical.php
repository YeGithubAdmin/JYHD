<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-11-22 14:55:06
 */

namespace {
/**
 * RPB_PlayerNumerical message
 */
class RPB_PlayerNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const GOLD_PAY = 1;
    const GOLD_NEWP_INDEX = 2;
    const DIAMOND_DAY = 3;
    const DIAMOND_NEWP = 4;
    const DIAMOND_NEWP_INDEX = 5;
    const FISH_CARD_NEWP = 6;
    const CATCH_FISH_NUM = 7;
    const ITEM_DAY = 8;
    const GOLD_NEWP = 9;
    const LICENCE = 10;
    const PLAYERID = 11;
    const PAY1 = 12;
    const PAY3 = 13;
    const PAY7 = 14;
    const PAY30 = 15;
    const EXCHANGE_RMB30 = 16;
    const BASE_CATCH_FISH_RATE_ADD = 17;
    const KEY_CATCH_FISH_RATE_ADD = 18;
    const FISH_CARD_RATE = 19;
    const KEY_FISH_RATE = 20;
    const SCORE = 21;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GOLD_PAY => array(
            'name' => 'gold_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_NEWP_INDEX => array(
            'name' => 'gold_newp_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_DAY => array(
            'name' => 'diamond_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_NEWP => array(
            'name' => 'diamond_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_NEWP_INDEX => array(
            'name' => 'diamond_newp_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_NEWP => array(
            'name' => 'fish_card_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CATCH_FISH_NUM => array(
            'name' => 'catch_fish_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM_DAY => array(
            'name' => 'item_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_NEWP => array(
            'name' => 'gold_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LICENCE => array(
            'name' => 'licence',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAY1 => array(
            'name' => 'pay1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAY3 => array(
            'name' => 'pay3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAY7 => array(
            'name' => 'pay7',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PAY30 => array(
            'name' => 'pay30',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EXCHANGE_RMB30 => array(
            'name' => 'exchange_rmb30',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BASE_CATCH_FISH_RATE_ADD => array(
            'name' => 'base_catch_fish_rate_add',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::KEY_CATCH_FISH_RATE_ADD => array(
            'name' => 'key_catch_fish_rate_add',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::FISH_CARD_RATE => array(
            'name' => 'fish_card_rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::KEY_FISH_RATE => array(
            'name' => 'key_fish_rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::SCORE => array(
            'name' => 'score',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::GOLD_PAY] = null;
        $this->values[self::GOLD_NEWP_INDEX] = null;
        $this->values[self::DIAMOND_DAY] = null;
        $this->values[self::DIAMOND_NEWP] = null;
        $this->values[self::DIAMOND_NEWP_INDEX] = null;
        $this->values[self::FISH_CARD_NEWP] = null;
        $this->values[self::CATCH_FISH_NUM] = null;
        $this->values[self::ITEM_DAY] = null;
        $this->values[self::GOLD_NEWP] = null;
        $this->values[self::LICENCE] = null;
        $this->values[self::PLAYERID] = null;
        $this->values[self::PAY1] = null;
        $this->values[self::PAY3] = null;
        $this->values[self::PAY7] = null;
        $this->values[self::PAY30] = null;
        $this->values[self::EXCHANGE_RMB30] = null;
        $this->values[self::BASE_CATCH_FISH_RATE_ADD] = null;
        $this->values[self::KEY_CATCH_FISH_RATE_ADD] = null;
        $this->values[self::FISH_CARD_RATE] = null;
        $this->values[self::KEY_FISH_RATE] = null;
        $this->values[self::SCORE] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'gold_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPay($value)
    {
        return $this->set(self::GOLD_PAY, $value);
    }

    /**
     * Returns value of 'gold_pay' property
     *
     * @return integer
     */
    public function getGoldPay()
    {
        $value = $this->get(self::GOLD_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_newp_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldNewpIndex($value)
    {
        return $this->set(self::GOLD_NEWP_INDEX, $value);
    }

    /**
     * Returns value of 'gold_newp_index' property
     *
     * @return integer
     */
    public function getGoldNewpIndex()
    {
        $value = $this->get(self::GOLD_NEWP_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondDay($value)
    {
        return $this->set(self::DIAMOND_DAY, $value);
    }

    /**
     * Returns value of 'diamond_day' property
     *
     * @return integer
     */
    public function getDiamondDay()
    {
        $value = $this->get(self::DIAMOND_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondNewp($value)
    {
        return $this->set(self::DIAMOND_NEWP, $value);
    }

    /**
     * Returns value of 'diamond_newp' property
     *
     * @return integer
     */
    public function getDiamondNewp()
    {
        $value = $this->get(self::DIAMOND_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_newp_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondNewpIndex($value)
    {
        return $this->set(self::DIAMOND_NEWP_INDEX, $value);
    }

    /**
     * Returns value of 'diamond_newp_index' property
     *
     * @return integer
     */
    public function getDiamondNewpIndex()
    {
        $value = $this->get(self::DIAMOND_NEWP_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardNewp($value)
    {
        return $this->set(self::FISH_CARD_NEWP, $value);
    }

    /**
     * Returns value of 'fish_card_newp' property
     *
     * @return integer
     */
    public function getFishCardNewp()
    {
        $value = $this->get(self::FISH_CARD_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'catch_fish_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCatchFishNum($value)
    {
        return $this->set(self::CATCH_FISH_NUM, $value);
    }

    /**
     * Returns value of 'catch_fish_num' property
     *
     * @return integer
     */
    public function getCatchFishNum()
    {
        $value = $this->get(self::CATCH_FISH_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItemDay($value)
    {
        return $this->set(self::ITEM_DAY, $value);
    }

    /**
     * Returns value of 'item_day' property
     *
     * @return integer
     */
    public function getItemDay()
    {
        $value = $this->get(self::ITEM_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldNewp($value)
    {
        return $this->set(self::GOLD_NEWP, $value);
    }

    /**
     * Returns value of 'gold_newp' property
     *
     * @return integer
     */
    public function getGoldNewp()
    {
        $value = $this->get(self::GOLD_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'licence' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setLicence($value)
    {
        return $this->set(self::LICENCE, $value);
    }

    /**
     * Returns value of 'licence' property
     *
     * @return boolean
     */
    public function getLicence()
    {
        $value = $this->get(self::LICENCE);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'playerid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerid($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerid' property
     *
     * @return integer
     */
    public function getPlayerid()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pay1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPay1($value)
    {
        return $this->set(self::PAY1, $value);
    }

    /**
     * Returns value of 'pay1' property
     *
     * @return integer
     */
    public function getPay1()
    {
        $value = $this->get(self::PAY1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pay3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPay3($value)
    {
        return $this->set(self::PAY3, $value);
    }

    /**
     * Returns value of 'pay3' property
     *
     * @return integer
     */
    public function getPay3()
    {
        $value = $this->get(self::PAY3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pay7' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPay7($value)
    {
        return $this->set(self::PAY7, $value);
    }

    /**
     * Returns value of 'pay7' property
     *
     * @return integer
     */
    public function getPay7()
    {
        $value = $this->get(self::PAY7);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pay30' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPay30($value)
    {
        return $this->set(self::PAY30, $value);
    }

    /**
     * Returns value of 'pay30' property
     *
     * @return integer
     */
    public function getPay30()
    {
        $value = $this->get(self::PAY30);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'exchange_rmb30' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExchangeRmb30($value)
    {
        return $this->set(self::EXCHANGE_RMB30, $value);
    }

    /**
     * Returns value of 'exchange_rmb30' property
     *
     * @return integer
     */
    public function getExchangeRmb30()
    {
        $value = $this->get(self::EXCHANGE_RMB30);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'base_catch_fish_rate_add' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setBaseCatchFishRateAdd($value)
    {
        return $this->set(self::BASE_CATCH_FISH_RATE_ADD, $value);
    }

    /**
     * Returns value of 'base_catch_fish_rate_add' property
     *
     * @return double
     */
    public function getBaseCatchFishRateAdd()
    {
        $value = $this->get(self::BASE_CATCH_FISH_RATE_ADD);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'key_catch_fish_rate_add' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setKeyCatchFishRateAdd($value)
    {
        return $this->set(self::KEY_CATCH_FISH_RATE_ADD, $value);
    }

    /**
     * Returns value of 'key_catch_fish_rate_add' property
     *
     * @return double
     */
    public function getKeyCatchFishRateAdd()
    {
        $value = $this->get(self::KEY_CATCH_FISH_RATE_ADD);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'fish_card_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setFishCardRate($value)
    {
        return $this->set(self::FISH_CARD_RATE, $value);
    }

    /**
     * Returns value of 'fish_card_rate' property
     *
     * @return double
     */
    public function getFishCardRate()
    {
        $value = $this->get(self::FISH_CARD_RATE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'key_fish_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setKeyFishRate($value)
    {
        return $this->set(self::KEY_FISH_RATE, $value);
    }

    /**
     * Returns value of 'key_fish_rate' property
     *
     * @return double
     */
    public function getKeyFishRate()
    {
        $value = $this->get(self::KEY_FISH_RATE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'score' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore($value)
    {
        return $this->set(self::SCORE, $value);
    }

    /**
     * Returns value of 'score' property
     *
     * @return integer
     */
    public function getScore()
    {
        $value = $this->get(self::SCORE);
        return $value === null ? (integer)$value : $value;
    }
}
}