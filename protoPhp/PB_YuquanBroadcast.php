<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-22 17:45:22
 */

namespace {
/**
 * PB_YuquanBroadcast message
 */
class PB_YuquanBroadcast extends \ProtobufMessage
{
    /* Field index constants */
    const VIP = 1;
    const PLAYER_NAME = 2;
    const BOSS_NAME = 3;
    const YUQUAN = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::VIP => array(
            'name' => 'vip',
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
        self::YUQUAN => array(
            'name' => 'yuquan',
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
        $this->values[self::VIP] = null;
        $this->values[self::PLAYER_NAME] = null;
        $this->values[self::BOSS_NAME] = null;
        $this->values[self::YUQUAN] = null;
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
}
}