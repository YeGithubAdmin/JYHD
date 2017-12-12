<?php
/**
 * Auto generated from PB_event.proto at 2017-12-06 14:11:23
 */

namespace {
/**
 * ActionInfo message embedded in KillFishAction message
 */
class KillFishAction_ActionInfo extends \ProtobufMessage
{
    /* Field index constants */
    const FISHID = 1;
    const ISBOSS = 2;
    const GUN_COIN = 3;
    const GOLD = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FISHID => array(
            'name' => 'fishid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ISBOSS => array(
            'name' => 'isboss',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::GUN_COIN => array(
            'name' => 'gun_coin',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD => array(
            'name' => 'gold',
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
        $this->values[self::FISHID] = null;
        $this->values[self::ISBOSS] = null;
        $this->values[self::GUN_COIN] = null;
        $this->values[self::GOLD] = null;
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
     * Sets value of 'fishid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishid($value)
    {
        return $this->set(self::FISHID, $value);
    }

    /**
     * Returns value of 'fishid' property
     *
     * @return integer
     */
    public function getFishid()
    {
        $value = $this->get(self::FISHID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'isboss' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsboss($value)
    {
        return $this->set(self::ISBOSS, $value);
    }

    /**
     * Returns value of 'isboss' property
     *
     * @return boolean
     */
    public function getIsboss()
    {
        $value = $this->get(self::ISBOSS);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'gun_coin' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGunCoin($value)
    {
        return $this->set(self::GUN_COIN, $value);
    }

    /**
     * Returns value of 'gun_coin' property
     *
     * @return integer
     */
    public function getGunCoin()
    {
        $value = $this->get(self::GUN_COIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGold($value)
    {
        return $this->set(self::GOLD, $value);
    }

    /**
     * Returns value of 'gold' property
     *
     * @return integer
     */
    public function getGold()
    {
        $value = $this->get(self::GOLD);
        return $value === null ? (integer)$value : $value;
    }
}
}