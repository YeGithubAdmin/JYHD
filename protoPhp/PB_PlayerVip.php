<?php
/**
 * Auto generated from PB_notify.proto at 2017-11-07 17:09:46
 */

namespace {
/**
 * PB_PlayerVip message
 */
class PB_PlayerVip extends \ProtobufMessage
{
    /* Field index constants */
    const VIP = 1;
    const EXP = 2;
    const IS_CAN_REWARD = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::VIP => array(
            'name' => 'vip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EXP => array(
            'name' => 'exp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::IS_CAN_REWARD => array(
            'name' => 'is_can_reward',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::EXP] = null;
        $this->values[self::IS_CAN_REWARD] = null;
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
     * Sets value of 'exp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExp($value)
    {
        return $this->set(self::EXP, $value);
    }

    /**
     * Returns value of 'exp' property
     *
     * @return integer
     */
    public function getExp()
    {
        $value = $this->get(self::EXP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'is_can_reward' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsCanReward($value)
    {
        return $this->set(self::IS_CAN_REWARD, $value);
    }

    /**
     * Returns value of 'is_can_reward' property
     *
     * @return boolean
     */
    public function getIsCanReward()
    {
        $value = $this->get(self::IS_CAN_REWARD);
        return $value === null ? (boolean)$value : $value;
    }
}
}