<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-22 14:55:06
 *
 * protos package
 */

namespace Protos {
/**
 * const_fish_card_rate message embedded in game_numerical message
 */
class game_numerical_const_fish_card_rate extends \ProtobufMessage
{
    /* Field index constants */
    const FC_MAX = 1;
    const RATE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FC_MAX => array(
            'name' => 'fc_max',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RATE => array(
            'name' => 'rate',
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
        $this->values[self::FC_MAX] = null;
        $this->values[self::RATE] = null;
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
     * Sets value of 'fc_max' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFcMax($value)
    {
        return $this->set(self::FC_MAX, $value);
    }

    /**
     * Returns value of 'fc_max' property
     *
     * @return integer
     */
    public function getFcMax()
    {
        $value = $this->get(self::FC_MAX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setRate($value)
    {
        return $this->set(self::RATE, $value);
    }

    /**
     * Returns value of 'rate' property
     *
     * @return double
     */
    public function getRate()
    {
        $value = $this->get(self::RATE);
        return $value === null ? (double)$value : $value;
    }
}
}