<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-13 05:44:30
 */

namespace {
/**
 * PB_SysBroadcast message
 */
class PB_SysBroadcast extends \ProtobufMessage
{
    /* Field index constants */
    const TYPE = 1;
    const VIP = 2;
    const GOLD = 3;
    const YUQUAN = 4;
    const PLAYER_NAME = 5;
    const BOSS_NAME = 6;
    const ITEM_NAME = 7;
    const PHP = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TYPE => array(
            'name' => 'type',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIP => array(
            'name' => 'vip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::YUQUAN => array(
            'name' => 'yuquan',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYER_NAME => array(
            'name' => 'player_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BOSS_NAME => array(
            'name' => 'boss_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ITEM_NAME => array(
            'name' => 'item_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PHP => array(
            'name' => 'php',
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
        $this->values[self::TYPE] = null;
        $this->values[self::VIP] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::YUQUAN] = null;
        $this->values[self::PLAYER_NAME] = null;
        $this->values[self::BOSS_NAME] = null;
        $this->values[self::ITEM_NAME] = null;
        $this->values[self::PHP] = null;
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
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
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
     * Sets value of 'yuquan' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setYuquan($value)
    {
        return $this->set(self::YUQUAN, $value);
    }

    /**
     * Returns value of 'yuquan' property
     *
     * @return integer
     */
    public function getYuquan()
    {
        $value = $this->get(self::YUQUAN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'player_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPlayerName($value)
    {
        return $this->set(self::PLAYER_NAME, $value);
    }

    /**
     * Returns value of 'player_name' property
     *
     * @return string
     */
    public function getPlayerName()
    {
        $value = $this->get(self::PLAYER_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'boss_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBossName($value)
    {
        return $this->set(self::BOSS_NAME, $value);
    }

    /**
     * Returns value of 'boss_name' property
     *
     * @return string
     */
    public function getBossName()
    {
        $value = $this->get(self::BOSS_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'item_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setItemName($value)
    {
        return $this->set(self::ITEM_NAME, $value);
    }

    /**
     * Returns value of 'item_name' property
     *
     * @return string
     */
    public function getItemName()
    {
        $value = $this->get(self::ITEM_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'php' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhp($value)
    {
        return $this->set(self::PHP, $value);
    }

    /**
     * Returns value of 'php' property
     *
     * @return string
     */
    public function getPhp()
    {
        $value = $this->get(self::PHP);
        return $value === null ? (string)$value : $value;
    }
}
}