<?php
/**
 * Auto generated from PB_event.proto at 2017-09-22 17:44:52
 */

namespace {
/**
 * GoldUpdate message
 */
class GoldUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_GOLD = 1;
    const PLAYERID = 2;
    const INC_GOLD = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_GOLD => array(
            'name' => 'cur_gold',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::INC_GOLD => array(
            'name' => 'inc_gold',
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
        $this->values[self::CUR_GOLD] = null;
        $this->values[self::PLAYERID] = null;
        $this->values[self::INC_GOLD] = null;
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
     * Sets value of 'cur_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurGold($value)
    {
        return $this->set(self::CUR_GOLD, $value);
    }

    /**
     * Returns value of 'cur_gold' property
     *
     * @return integer
     */
    public function getCurGold()
    {
        $value = $this->get(self::CUR_GOLD);
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

    /**
     * Sets value of 'inc_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIncGold($value)
    {
        return $this->set(self::INC_GOLD, $value);
    }

    /**
     * Returns value of 'inc_gold' property
     *
     * @return integer
     */
    public function getIncGold()
    {
        $value = $this->get(self::INC_GOLD);
        return $value === null ? (integer)$value : $value;
    }
}
}