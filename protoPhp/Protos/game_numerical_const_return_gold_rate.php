<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-02 15:38:42
 *
 * protos package
 */

namespace Protos {
/**
 * const_return_gold_rate message embedded in game_numerical message
 */
class game_numerical_const_return_gold_rate extends \ProtobufMessage
{
    /* Field index constants */
    const ROOM_LEVEL = 1;
    const RATE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
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
        $this->values[self::ROOM_LEVEL] = null;
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
     * Sets value of 'room_level' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRoomLevel($value)
    {
        return $this->set(self::ROOM_LEVEL, $value);
    }

    /**
     * Returns value of 'room_level' property
     *
     * @return integer
     */
    public function getRoomLevel()
    {
        $value = $this->get(self::ROOM_LEVEL);
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