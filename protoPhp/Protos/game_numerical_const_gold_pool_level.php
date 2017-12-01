<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-29 17:29:42
 *
 * protos package
 */

namespace Protos {
/**
 * const_gold_pool_level message embedded in game_numerical message
 */
class game_numerical_const_gold_pool_level extends \ProtobufMessage
{
    /* Field index constants */
    const LOW = 1;
    const HIGH = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LOW => array(
            'name' => 'low',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HIGH => array(
            'name' => 'high',
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
     * @param integer $value Property value
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
     * @return integer
     */
    public function getLow()
    {
        $value = $this->get(self::LOW);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'high' property
     *
     * @param integer $value Property value
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
     * @return integer
     */
    public function getHigh()
    {
        $value = $this->get(self::HIGH);
        return $value === null ? (integer)$value : $value;
    }
}
}