<?php
/**
 * Auto generated from PB_task_rpc.proto at 2018-02-01 10:24:00
 */

namespace {
/**
 * PB_TaskA message
 */
class PB_TaskA extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const UNLOCK_GUN = 2;
    const UNLOCK_TIME = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UNLOCK_GUN => array(
            'name' => 'unlock_gun',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UNLOCK_TIME => array(
            'name' => 'unlock_time',
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
        $this->values[self::UNLOCK_GUN] = null;
        $this->values[self::UNLOCK_TIME] = null;
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
     * Sets value of 'unlock_gun' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUnlockGun($value)
    {
        return $this->set(self::UNLOCK_GUN, $value);
    }

    /**
     * Returns value of 'unlock_gun' property
     *
     * @return integer
     */
    public function getUnlockGun()
    {
        $value = $this->get(self::UNLOCK_GUN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'unlock_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUnlockTime($value)
    {
        return $this->set(self::UNLOCK_TIME, $value);
    }

    /**
     * Returns value of 'unlock_time' property
     *
     * @return integer
     */
    public function getUnlockTime()
    {
        $value = $this->get(self::UNLOCK_TIME);
        return $value === null ? (integer)$value : $value;
    }
}
}