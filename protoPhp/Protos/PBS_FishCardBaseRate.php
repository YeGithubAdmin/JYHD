<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2018-01-24 16:26:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_FishCardBaseRate message
 */
class PBS_FishCardBaseRate extends \ProtobufMessage
{
    /* Field index constants */
    const FISH_CARD = 1;
    const PAY30 = 2;
    const EXCHANGE_RMB30 = 3;
    const PLAYERID = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FISH_CARD => array(
            'name' => 'fish_card',
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
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => true,
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
        $this->values[self::FISH_CARD] = null;
        $this->values[self::PAY30] = null;
        $this->values[self::EXCHANGE_RMB30] = null;
        $this->values[self::PLAYERID] = null;
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
     * Sets value of 'fish_card' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCard($value)
    {
        return $this->set(self::FISH_CARD, $value);
    }

    /**
     * Returns value of 'fish_card' property
     *
     * @return integer
     */
    public function getFishCard()
    {
        $value = $this->get(self::FISH_CARD);
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
}
}