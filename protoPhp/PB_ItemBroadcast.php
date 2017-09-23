<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-22 17:45:22
 */

namespace {
/**
 * PB_ItemBroadcast message
 */
class PB_ItemBroadcast extends \ProtobufMessage
{
    /* Field index constants */
    const VIP = 1;
    const PLAYER_NAME = 2;
    const BOSS_NAME = 3;
    const ITEM_NAME = 4;

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
        self::ITEM_NAME => array(
            'name' => 'item_name',
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
        $this->values[self::VIP] = null;
        $this->values[self::PLAYER_NAME] = null;
        $this->values[self::BOSS_NAME] = null;
        $this->values[self::ITEM_NAME] = null;
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
}
}