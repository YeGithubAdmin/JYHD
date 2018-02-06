<?php
/**
 * Auto generated from PB_numerical.proto at 2018-02-06 16:55:50
 */

namespace {
/**
 * PB_m2g_gold_refresh message
 */
class PB_m2g_gold_refresh extends \ProtobufMessage
{
    /* Field index constants */
    const PAY_PERIOD = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PAY_PERIOD => array(
            'name' => 'pay_period',
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
        $this->values[self::PAY_PERIOD] = null;
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
     * Sets value of 'pay_period' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPayPeriod($value)
    {
        return $this->set(self::PAY_PERIOD, $value);
    }

    /**
     * Returns value of 'pay_period' property
     *
     * @return integer
     */
    public function getPayPeriod()
    {
        $value = $this->get(self::PAY_PERIOD);
        return $value === null ? (integer)$value : $value;
    }
}
}