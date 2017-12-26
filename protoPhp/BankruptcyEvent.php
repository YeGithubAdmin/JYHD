<?php
/**
 * Auto generated from PB_event.proto at 2017-12-26 10:53:15
 */

namespace {
/**
 * BankruptcyEvent message
 */
class BankruptcyEvent extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const CHANNEL = 2;
    const GAME_VER = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
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
        $this->values[self::CHANNEL] = null;
        $this->values[self::GAME_VER] = null;
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
}
}