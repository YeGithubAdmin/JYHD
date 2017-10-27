<?php
/**
 * Auto generated from PB_base_data.proto at 2017-10-25 14:57:37
 */

namespace {
/**
 * PB_VipBroadcast message
 */
class PB_VipBroadcast extends \ProtobufMessage
{
    /* Field index constants */
    const VIP = 1;
    const PLAYER_NAME = 2;

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
}
}