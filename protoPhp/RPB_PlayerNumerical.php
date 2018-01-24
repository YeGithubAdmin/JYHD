<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * RPB_PlayerNumerical message
 */
class RPB_PlayerNumerical extends \ProtobufMessage
{
    /* Field index constants */
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
    const CHANNEL = 22;
    const GAME_VER = 23;
    const APP_VER = 24;
    const DRAW_COUNT = 25;
    const DIAMOND_DAY = 26;
    const ITEM_DAY = 27;

    /* @var array Field descriptors */
    protected static $fields = array(
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
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GAME_VER => array(
            'name' => 'game_ver',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::APP_VER => array(
            'name' => 'app_ver',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DRAW_COUNT => array(
            'name' => 'draw_count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_DAY => array(
            'name' => 'diamond_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM_DAY => array(
            'name' => 'item_day',
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
        $this->values[self::CHANNEL] = null;
        $this->values[self::GAME_VER] = null;
        $this->values[self::APP_VER] = null;
        $this->values[self::DRAW_COUNT] = null;
        $this->values[self::DIAMOND_DAY] = null;
        $this->values[self::ITEM_DAY] = null;
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

    /**
     * Sets value of 'channel' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setChannel($value)
    {
        return $this->set(self::CHANNEL, $value);
    }

    /**
     * Returns value of 'channel' property
     *
     * @return string
     */
    public function getChannel()
    {
        $value = $this->get(self::CHANNEL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'game_ver' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGameVer($value)
    {
        return $this->set(self::GAME_VER, $value);
    }

    /**
     * Returns value of 'game_ver' property
     *
     * @return string
     */
    public function getGameVer()
    {
        $value = $this->get(self::GAME_VER);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'app_ver' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAppVer($value)
    {
        return $this->set(self::APP_VER, $value);
    }

    /**
     * Returns value of 'app_ver' property
     *
     * @return string
     */
    public function getAppVer()
    {
        $value = $this->get(self::APP_VER);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'draw_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDrawCount($value)
    {
        return $this->set(self::DRAW_COUNT, $value);
    }

    /**
     * Returns value of 'draw_count' property
     *
     * @return integer
     */
    public function getDrawCount()
    {
        $value = $this->get(self::DRAW_COUNT);
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
}
}