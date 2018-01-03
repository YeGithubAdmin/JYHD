<?php
/**
 * Auto generated from PB_usr_data.proto at 2018-01-02 15:38:42
 *
 * RedisProto package
 */

namespace RedisProto {
/**
 * RPB_BrokeAction message
 */
class RPB_BrokeAction extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const LOGIN_CHANNEL = 2;
    const GAME_VER = 3;
    const BROKE_TIME = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_CHANNEL => array(
            'name' => 'login_channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GAME_VER => array(
            'name' => 'game_ver',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BROKE_TIME => array(
            'name' => 'broke_time',
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
        $this->values[self::LOGIN_CHANNEL] = null;
        $this->values[self::GAME_VER] = null;
        $this->values[self::BROKE_TIME] = null;
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
     * Sets value of 'login_channel' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLoginChannel($value)
    {
        return $this->set(self::LOGIN_CHANNEL, $value);
    }

    /**
     * Returns value of 'login_channel' property
     *
     * @return string
     */
    public function getLoginChannel()
    {
        $value = $this->get(self::LOGIN_CHANNEL);
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
     * Sets value of 'broke_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBrokeTime($value)
    {
        return $this->set(self::BROKE_TIME, $value);
    }

    /**
     * Returns value of 'broke_time' property
     *
     * @return string
     */
    public function getBrokeTime()
    {
        $value = $this->get(self::BROKE_TIME);
        return $value === null ? (string)$value : $value;
    }
}
}