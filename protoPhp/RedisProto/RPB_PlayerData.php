<?php
/**
 * Auto generated from PB_usr_data.proto at 2017-09-28 20:15:01
 *
 * RedisProto package
 */

namespace RedisProto {
/**
 * RPB_PlayerData message
 */
class RPB_PlayerData extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const NAME = 2;
    const SEX = 3;
    const VIP = 4;
    const VIP_EXP = 5;
    const STATUS = 6;
    const SERVERID = 7;
    const GAME_TYPE = 8;
    const ROOM_TYPE = 9;
    const LEVEL_TYPE = 10;
    const ROOMID = 11;
    const GOLD = 12;
    const DIAMOND = 13;
    const DEPOSIT = 14;
    const PROFIT = 15;
    const GLEVEL = 16;
    const GEXP = 17;
    const GUN_LV = 18;
    const SIGN_DAY = 19;
    const SIGN_TIME = 20;
    const GUNID = 21;
    const ICON_URL = 22;
    const IS_MC = 23;
    const MC_OVERTIME = 24;
    const BK_COUNT = 25;
    const RMB = 26;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::SEX => array(
            'name' => 'sex',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        self::STATUS => array(
            'name' => 'status',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SERVERID => array(
            'name' => 'serverid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAME_TYPE => array(
            'name' => 'game_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOM_TYPE => array(
            'name' => 'room_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVEL_TYPE => array(
            'name' => 'level_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOMID => array(
            'name' => 'roomid',
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
        self::PROFIT => array(
            'name' => 'profit',
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
        self::GUN_LV => array(
            'name' => 'gun_lv',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SIGN_DAY => array(
            'name' => 'sign_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SIGN_TIME => array(
            'name' => 'sign_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GUNID => array(
            'name' => 'gunid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ICON_URL => array(
            'name' => 'icon_url',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IS_MC => array(
            'name' => 'is_mc',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::MC_OVERTIME => array(
            'name' => 'mc_overtime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BK_COUNT => array(
            'name' => 'bk_count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RMB => array(
            'name' => 'rmb',
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
        $this->values[self::NAME] = null;
        $this->values[self::SEX] = null;
        $this->values[self::VIP] = null;
        $this->values[self::VIP_EXP] = null;
        $this->values[self::STATUS] = null;
        $this->values[self::SERVERID] = null;
        $this->values[self::GAME_TYPE] = null;
        $this->values[self::ROOM_TYPE] = null;
        $this->values[self::LEVEL_TYPE] = null;
        $this->values[self::ROOMID] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::DIAMOND] = null;
        $this->values[self::DEPOSIT] = null;
        $this->values[self::PROFIT] = null;
        $this->values[self::GLEVEL] = null;
        $this->values[self::GEXP] = null;
        $this->values[self::GUN_LV] = null;
        $this->values[self::SIGN_DAY] = null;
        $this->values[self::SIGN_TIME] = null;
        $this->values[self::GUNID] = null;
        $this->values[self::ICON_URL] = null;
        $this->values[self::IS_MC] = null;
        $this->values[self::MC_OVERTIME] = null;
        $this->values[self::BK_COUNT] = null;
        $this->values[self::RMB] = null;
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
     * Sets value of 'sex' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSex($value)
    {
        return $this->set(self::SEX, $value);
    }

    /**
     * Returns value of 'sex' property
     *
     * @return integer
     */
    public function getSex()
    {
        $value = $this->get(self::SEX);
        return $value === null ? (integer)$value : $value;
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
     * Sets value of 'status' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStatus($value)
    {
        return $this->set(self::STATUS, $value);
    }

    /**
     * Returns value of 'status' property
     *
     * @return integer
     */
    public function getStatus()
    {
        $value = $this->get(self::STATUS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'serverid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setServerid($value)
    {
        return $this->set(self::SERVERID, $value);
    }

    /**
     * Returns value of 'serverid' property
     *
     * @return integer
     */
    public function getServerid()
    {
        $value = $this->get(self::SERVERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'game_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameType($value)
    {
        return $this->set(self::GAME_TYPE, $value);
    }

    /**
     * Returns value of 'game_type' property
     *
     * @return integer
     */
    public function getGameType()
    {
        $value = $this->get(self::GAME_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'room_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRoomType($value)
    {
        return $this->set(self::ROOM_TYPE, $value);
    }

    /**
     * Returns value of 'room_type' property
     *
     * @return integer
     */
    public function getRoomType()
    {
        $value = $this->get(self::ROOM_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'level_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelType($value)
    {
        return $this->set(self::LEVEL_TYPE, $value);
    }

    /**
     * Returns value of 'level_type' property
     *
     * @return integer
     */
    public function getLevelType()
    {
        $value = $this->get(self::LEVEL_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'roomid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRoomid($value)
    {
        return $this->set(self::ROOMID, $value);
    }

    /**
     * Returns value of 'roomid' property
     *
     * @return integer
     */
    public function getRoomid()
    {
        $value = $this->get(self::ROOMID);
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
     * Sets value of 'profit' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProfit($value)
    {
        return $this->set(self::PROFIT, $value);
    }

    /**
     * Returns value of 'profit' property
     *
     * @return integer
     */
    public function getProfit()
    {
        $value = $this->get(self::PROFIT);
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
     * Sets value of 'gun_lv' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGunLv($value)
    {
        return $this->set(self::GUN_LV, $value);
    }

    /**
     * Returns value of 'gun_lv' property
     *
     * @return integer
     */
    public function getGunLv()
    {
        $value = $this->get(self::GUN_LV);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sign_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSignDay($value)
    {
        return $this->set(self::SIGN_DAY, $value);
    }

    /**
     * Returns value of 'sign_day' property
     *
     * @return integer
     */
    public function getSignDay()
    {
        $value = $this->get(self::SIGN_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sign_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSignTime($value)
    {
        return $this->set(self::SIGN_TIME, $value);
    }

    /**
     * Returns value of 'sign_time' property
     *
     * @return integer
     */
    public function getSignTime()
    {
        $value = $this->get(self::SIGN_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gunid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGunid($value)
    {
        return $this->set(self::GUNID, $value);
    }

    /**
     * Returns value of 'gunid' property
     *
     * @return integer
     */
    public function getGunid()
    {
        $value = $this->get(self::GUNID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'icon_url' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setIconUrl($value)
    {
        return $this->set(self::ICON_URL, $value);
    }

    /**
     * Returns value of 'icon_url' property
     *
     * @return string
     */
    public function getIconUrl()
    {
        $value = $this->get(self::ICON_URL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'is_mc' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsMc($value)
    {
        return $this->set(self::IS_MC, $value);
    }

    /**
     * Returns value of 'is_mc' property
     *
     * @return boolean
     */
    public function getIsMc()
    {
        $value = $this->get(self::IS_MC);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'mc_overtime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMcOvertime($value)
    {
        return $this->set(self::MC_OVERTIME, $value);
    }

    /**
     * Returns value of 'mc_overtime' property
     *
     * @return integer
     */
    public function getMcOvertime()
    {
        $value = $this->get(self::MC_OVERTIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bk_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBkCount($value)
    {
        return $this->set(self::BK_COUNT, $value);
    }

    /**
     * Returns value of 'bk_count' property
     *
     * @return integer
     */
    public function getBkCount()
    {
        $value = $this->get(self::BK_COUNT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'rmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmb($value)
    {
        return $this->set(self::RMB, $value);
    }

    /**
     * Returns value of 'rmb' property
     *
     * @return integer
     */
    public function getRmb()
    {
        $value = $this->get(self::RMB);
        return $value === null ? (integer)$value : $value;
    }
}
}