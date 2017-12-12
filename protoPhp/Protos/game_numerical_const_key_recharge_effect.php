<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-12-06 14:11:23
 *
 * protos package
 */

namespace Protos {
/**
 * const_key_recharge_effect message embedded in game_numerical message
 */
class game_numerical_const_key_recharge_effect extends \ProtobufMessage
{
    /* Field index constants */
    const PAY_TYPE = 1;
    const ADD_RATE = 2;
    const PLAN_RECHARGE = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PAY_TYPE => array(
            'name' => 'pay_type',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ADD_RATE => array(
            'name' => 'add_rate',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::PLAN_RECHARGE => array(
            'name' => 'plan_recharge',
            'required' => true,
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
        $this->values[self::PAY_TYPE] = null;
        $this->values[self::ADD_RATE] = null;
        $this->values[self::PLAN_RECHARGE] = null;
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
     * Sets value of 'pay_type' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPayType($value)
    {
        return $this->set(self::PAY_TYPE, $value);
    }

    /**
     * Returns value of 'pay_type' property
     *
     * @return string
     */
    public function getPayType()
    {
        $value = $this->get(self::PAY_TYPE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'add_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setAddRate($value)
    {
        return $this->set(self::ADD_RATE, $value);
    }

    /**
     * Returns value of 'add_rate' property
     *
     * @return double
     */
    public function getAddRate()
    {
        $value = $this->get(self::ADD_RATE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'plan_recharge' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlanRecharge($value)
    {
        return $this->set(self::PLAN_RECHARGE, $value);
    }

    /**
     * Returns value of 'plan_recharge' property
     *
     * @return integer
     */
    public function getPlanRecharge()
    {
        $value = $this->get(self::PLAN_RECHARGE);
        return $value === null ? (integer)$value : $value;
    }
}
}