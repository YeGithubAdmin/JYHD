<?php
/**
 * Auto generated from PB_numerical.proto at 2017-12-26 10:53:15
 */

namespace {
/**
 * PB_g2m_gold_update message
 */
class PB_g2m_gold_update extends \ProtobufMessage
{
    /* Field index constants */
    const PAY_PERIOD = 1;
    const CONSUME = 2;
    const PRODUCE = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PAY_PERIOD => array(
            'name' => 'pay_period',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME => array(
            'name' => 'consume',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE => array(
            'name' => 'produce',
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
        $this->values[self::CONSUME] = null;
        $this->values[self::PRODUCE] = null;
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

    /**
     * Sets value of 'consume' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsume($value)
    {
        return $this->set(self::CONSUME, $value);
    }

    /**
     * Returns value of 'consume' property
     *
     * @return integer
     */
    public function getConsume()
    {
        $value = $this->get(self::CONSUME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduce($value)
    {
        return $this->set(self::PRODUCE, $value);
    }

    /**
     * Returns value of 'produce' property
     *
     * @return integer
     */
    public function getProduce()
    {
        $value = $this->get(self::PRODUCE);
        return $value === null ? (integer)$value : $value;
    }
}
}