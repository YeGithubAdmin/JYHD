<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-02-06 16:55:50
 *
 * protos package
 */

namespace Protos {
/**
 * gold_pool_ratio_t message embedded in game_numerical message
 */
class game_numerical_gold_pool_ratio_t extends \ProtobufMessage
{
    /* Field index constants */
    const LOW = 1;
    const MID = 2;
    const HIGH = 3;
    const POOL_LOW = 4;
    const POOL_HIGH = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LOW => array(
            'name' => 'low',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::MID => array(
            'name' => 'mid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::HIGH => array(
            'name' => 'high',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::POOL_LOW => array(
            'name' => 'pool_low',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POOL_HIGH => array(
            'name' => 'pool_high',
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
        $this->values[self::LOW] = null;
        $this->values[self::MID] = null;
        $this->values[self::HIGH] = null;
        $this->values[self::POOL_LOW] = null;
        $this->values[self::POOL_HIGH] = null;
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
     * Sets value of 'low' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setLow($value)
    {
        return $this->set(self::LOW, $value);
    }

    /**
     * Returns value of 'low' property
     *
     * @return double
     */
    public function getLow()
    {
        $value = $this->get(self::LOW);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'mid' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setMid($value)
    {
        return $this->set(self::MID, $value);
    }

    /**
     * Returns value of 'mid' property
     *
     * @return double
     */
    public function getMid()
    {
        $value = $this->get(self::MID);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'high' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setHigh($value)
    {
        return $this->set(self::HIGH, $value);
    }

    /**
     * Returns value of 'high' property
     *
     * @return double
     */
    public function getHigh()
    {
        $value = $this->get(self::HIGH);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'pool_low' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPoolLow($value)
    {
        return $this->set(self::POOL_LOW, $value);
    }

    /**
     * Returns value of 'pool_low' property
     *
     * @return integer
     */
    public function getPoolLow()
    {
        $value = $this->get(self::POOL_LOW);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pool_high' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPoolHigh($value)
    {
        return $this->set(self::POOL_HIGH, $value);
    }

    /**
     * Returns value of 'pool_high' property
     *
     * @return integer
     */
    public function getPoolHigh()
    {
        $value = $this->get(self::POOL_HIGH);
        return $value === null ? (integer)$value : $value;
    }
}
}