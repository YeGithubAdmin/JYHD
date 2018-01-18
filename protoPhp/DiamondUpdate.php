<?php
/**
 * Auto generated from PB_event.proto at 2018-01-18 17:53:24
 */

namespace {
/**
 * DiamondUpdate message
 */
class DiamondUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_DIAMOND = 1;
    const PLAYERID = 2;
    const INC_DIAMOND = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_DIAMOND => array(
            'name' => 'cur_diamond',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::INC_DIAMOND => array(
            'name' => 'inc_diamond',
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
        $this->values[self::CUR_DIAMOND] = null;
        $this->values[self::PLAYERID] = null;
        $this->values[self::INC_DIAMOND] = null;
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
     * Sets value of 'cur_diamond' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurDiamond($value)
    {
        return $this->set(self::CUR_DIAMOND, $value);
    }

    /**
     * Returns value of 'cur_diamond' property
     *
     * @return integer
     */
    public function getCurDiamond()
    {
        $value = $this->get(self::CUR_DIAMOND);
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
     * Sets value of 'inc_diamond' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIncDiamond($value)
    {
        return $this->set(self::INC_DIAMOND, $value);
    }

    /**
     * Returns value of 'inc_diamond' property
     *
     * @return integer
     */
    public function getIncDiamond()
    {
        $value = $this->get(self::INC_DIAMOND);
        return $value === null ? (integer)$value : $value;
    }
}
}