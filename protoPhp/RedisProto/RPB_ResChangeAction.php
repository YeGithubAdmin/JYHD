<?php
/**
 * Auto generated from PB_usr_data.proto at 2017-11-07 17:09:46
 *
 * RedisProto package
 */

namespace RedisProto {
/**
 * RPB_ResChangeAction message
 */
class RPB_ResChangeAction extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const ACCOUNT_TYPE = 2;
    const OS_TYPE = 3;
    const LOGIN_CHANNEL = 4;
    const REG_CHANNEL = 5;
    const GAME_VER = 6;
    const ITEMID = 7;
    const ADD_NUM = 8;
    const CUR_NUM = 9;
    const REASON = 10;
    const OPT_TIME = 11;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ACCOUNT_TYPE => array(
            'name' => 'account_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OS_TYPE => array(
            'name' => 'os_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_CHANNEL => array(
            'name' => 'login_channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::REG_CHANNEL => array(
            'name' => 'reg_channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GAME_VER => array(
            'name' => 'game_ver',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ITEMID => array(
            'name' => 'itemid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ADD_NUM => array(
            'name' => 'add_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CUR_NUM => array(
            'name' => 'cur_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::REASON => array(
            'name' => 'reason',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OPT_TIME => array(
            'name' => 'opt_time',
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
        $this->values[self::ACCOUNT_TYPE] = null;
        $this->values[self::OS_TYPE] = null;
        $this->values[self::LOGIN_CHANNEL] = null;
        $this->values[self::REG_CHANNEL] = null;
        $this->values[self::GAME_VER] = null;
        $this->values[self::ITEMID] = null;
        $this->values[self::ADD_NUM] = null;
        $this->values[self::CUR_NUM] = null;
        $this->values[self::REASON] = null;
        $this->values[self::OPT_TIME] = null;
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
     * Sets value of 'account_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAccountType($value)
    {
        return $this->set(self::ACCOUNT_TYPE, $value);
    }

    /**
     * Returns value of 'account_type' property
     *
     * @return integer
     */
    public function getAccountType()
    {
        $value = $this->get(self::ACCOUNT_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'os_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOsType($value)
    {
        return $this->set(self::OS_TYPE, $value);
    }

    /**
     * Returns value of 'os_type' property
     *
     * @return integer
     */
    public function getOsType()
    {
        $value = $this->get(self::OS_TYPE);
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
     * Sets value of 'reg_channel' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRegChannel($value)
    {
        return $this->set(self::REG_CHANNEL, $value);
    }

    /**
     * Returns value of 'reg_channel' property
     *
     * @return string
     */
    public function getRegChannel()
    {
        $value = $this->get(self::REG_CHANNEL);
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
     * Sets value of 'itemid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItemid($value)
    {
        return $this->set(self::ITEMID, $value);
    }

    /**
     * Returns value of 'itemid' property
     *
     * @return integer
     */
    public function getItemid()
    {
        $value = $this->get(self::ITEMID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'add_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAddNum($value)
    {
        return $this->set(self::ADD_NUM, $value);
    }

    /**
     * Returns value of 'add_num' property
     *
     * @return integer
     */
    public function getAddNum()
    {
        $value = $this->get(self::ADD_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'cur_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurNum($value)
    {
        return $this->set(self::CUR_NUM, $value);
    }

    /**
     * Returns value of 'cur_num' property
     *
     * @return integer
     */
    public function getCurNum()
    {
        $value = $this->get(self::CUR_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'reason' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReason($value)
    {
        return $this->set(self::REASON, $value);
    }

    /**
     * Returns value of 'reason' property
     *
     * @return integer
     */
    public function getReason()
    {
        $value = $this->get(self::REASON);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'opt_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOptTime($value)
    {
        return $this->set(self::OPT_TIME, $value);
    }

    /**
     * Returns value of 'opt_time' property
     *
     * @return string
     */
    public function getOptTime()
    {
        $value = $this->get(self::OPT_TIME);
        return $value === null ? (string)$value : $value;
    }
}
}