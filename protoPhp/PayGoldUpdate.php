<?php
/**
 * Auto generated from PB_event.proto at 2017-12-26 10:53:15
 */

namespace {
/**
 * PayGoldUpdate message
 */
class PayGoldUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const INC_GOLD = 1;
    const PLAYERID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INC_GOLD => array(
            'name' => 'inc_gold',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERID => array(
            'name' => 'playerid',
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
        $this->values[self::INC_GOLD] = null;
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