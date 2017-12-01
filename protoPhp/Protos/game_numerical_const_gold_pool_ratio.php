<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-29 17:29:42
 *
 * protos package
 */

namespace Protos {
/**
 * const_gold_pool_ratio message embedded in game_numerical message
 */
class game_numerical_const_gold_pool_ratio extends \ProtobufMessage
{
    /* Field index constants */
    const LOW = 1;
    const MID = 2;
    const HIGH = 3;

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
}
}