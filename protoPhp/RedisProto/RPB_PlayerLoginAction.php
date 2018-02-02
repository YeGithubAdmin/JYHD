<?php
/**
 * Auto generated from PB_usr_data.proto at 2018-02-01 10:24:00
 *
 * RedisProto package
 */

namespace RedisProto {
/**
 * RPB_PlayerLoginAction message
 */
class RPB_PlayerLoginAction extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const ACCOUNT_TYPE = 2;
    const OS_TYPE = 3;
    const LOGIN_CHANNEL = 4;
    const REG_CHANNEL = 5;
    const GAME_VER = 6;
    const NAME = 7;
    const VIP = 8;
    const VIP_EXP = 9;
    const GLEVEL = 10;
    const GEXP = 11;
    const GOLD = 12;
    const DIAMOND = 13;
    const DEPOSIT = 14;
    const LOGIN_TIME = 15;
    const REGTIME = 16;
    const MAC = 17;
    const IMEI = 18;
    const IMSI = 19;
    const UUID = 20;

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
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::VIP => array(
            'name' => 'vip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIP_EXP => array(
            'name' => 'vip_exp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GLEVEL => array(
            'name' => 'glevel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GEXP => array(
            'name' => 'gexp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND => array(
            'name' => 'diamond',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DEPOSIT => array(
            'name' => 'deposit',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_TIME => array(
            'name' => 'login_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::REGTIME => array(
            'name' => 'regtime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MAC => array(
            'name' => 'mac',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMEI => array(
            'name' => 'imei',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IMSI => array(
            'name' => 'imsi',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::UUID => array(
            'name' => 'uuid',
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
        $this->values[self::NAME] = null;
        $this->values[self::VIP] = null;
        $this->values[self::VIP_EXP] = null;
        $this->values[self::GLEVEL] = null;
        $this->values[self::GEXP] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::DIAMOND] = null;
        $this->values[self::DEPOSIT] = null;
        $this->values[self::LOGIN_TIME] = null;
        $this->values[self::REGTIME] = null;
        $this->values[self::MAC] = null;
        $this->values[self::IMEI] = null;
        $this->values[self::IMSI] = null;
        $this->values[self::UUID] = null;
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
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'vip' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVip($value)
    {
        return $this->set(self::VIP, $value);
    }

    /**
     * Returns value of 'vip' property
     *
     * @return integer
     */
    public function getVip()
    {
        $value = $this->get(self::VIP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'vip_exp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVipExp($value)
    {
        return $this->set(self::VIP_EXP, $value);
    }

    /**
     * Returns value of 'vip_exp' property
     *
     * @return integer
     */
    public function getVipExp()
    {
        $value = $this->get(self::VIP_EXP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'glevel' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGlevel($value)
    {
        return $this->set(self::GLEVEL, $value);
    }

    /**
     * Returns value of 'glevel' property
     *
     * @return integer
     */
    public function getGlevel()
    {
        $value = $this->get(self::GLEVEL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gexp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGexp($value)
    {
        return $this->set(self::GEXP, $value);
    }

    /**
     * Returns value of 'gexp' property
     *
     * @return integer
     */
    public function getGexp()
    {
        $value = $this->get(self::GEXP);
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

    /**
     * Sets value of 'diamond' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamond($value)
    {
        return $this->set(self::DIAMOND, $value);
    }

    /**
     * Returns value of 'diamond' property
     *
     * @return integer
     */
    public function getDiamond()
    {
        $value = $this->get(self::DIAMOND);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'deposit' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDeposit($value)
    {
        return $this->set(self::DEPOSIT, $value);
    }

    /**
     * Returns value of 'deposit' property
     *
     * @return integer
     */
    public function getDeposit()
    {
        $value = $this->get(self::DEPOSIT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'login_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLoginTime($value)
    {
        return $this->set(self::LOGIN_TIME, $value);
    }

    /**
     * Returns value of 'login_time' property
     *
     * @return string
     */
    public function getLoginTime()
    {
        $value = $this->get(self::LOGIN_TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'regtime' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRegtime($value)
    {
        return $this->set(self::REGTIME, $value);
    }

    /**
     * Returns value of 'regtime' property
     *
     * @return string
     */
    public function getRegtime()
    {
        $value = $this->get(self::REGTIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'mac' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMac($value)
    {
        return $this->set(self::MAC, $value);
    }

    /**
     * Returns value of 'mac' property
     *
     * @return string
     */
    public function getMac()
    {
        $value = $this->get(self::MAC);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'imei' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImei($value)
    {
        return $this->set(self::IMEI, $value);
    }

    /**
     * Returns value of 'imei' property
     *
     * @return string
     */
    public function getImei()
    {
        $value = $this->get(self::IMEI);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'imsi' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setImsi($value)
    {
        return $this->set(self::IMSI, $value);
    }

    /**
     * Returns value of 'imsi' property
     *
     * @return string
     */
    public function getImsi()
    {
        $value = $this->get(self::IMSI);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'uuid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUuid($value)
    {
        return $this->set(self::UUID, $value);
    }

    /**
     * Returns value of 'uuid' property
     *
     * @return string
     */
    public function getUuid()
    {
        $value = $this->get(self::UUID);
        return $value === null ? (string)$value : $value;
    }
}
}