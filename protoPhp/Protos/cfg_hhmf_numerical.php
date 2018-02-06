<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-02-06 16:55:50
 *
 * protos package
 */

namespace Protos {
/**
 * cfg_hhmf_numerical message
 */
class cfg_hhmf_numerical extends \ProtobufMessage
{
    /* Field index constants */
    const GOLD_RANGE_MIN = 1;
    const GOLD_RANGE_MAX = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GOLD_RANGE_MIN => array(
            'name' => 'gold_range_min',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_RANGE_MAX => array(
            'name' => 'gold_range_max',
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
        $this->values[self::GOLD_RANGE_MIN] = null;
        $this->values[self::GOLD_RANGE_MAX] = null;
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
     * Sets value of 'gold_range_min' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldRangeMin($value)
    {
        return $this->set(self::GOLD_RANGE_MIN, $value);
    }

    /**
     * Returns value of 'gold_range_min' property
     *
     * @return integer
     */
    public function getGoldRangeMin()
    {
        $value = $this->get(self::GOLD_RANGE_MIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_range_max' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldRangeMax($value)
    {
        return $this->set(self::GOLD_RANGE_MAX, $value);
    }

    /**
     * Returns value of 'gold_range_max' property
     *
     * @return integer
     */
    public function getGoldRangeMax()
    {
        $value = $this->get(self::GOLD_RANGE_MAX);
        return $value === null ? (integer)$value : $value;
    }
}
}