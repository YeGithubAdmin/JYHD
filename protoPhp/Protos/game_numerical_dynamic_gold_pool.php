<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-12-06 14:11:23
 *
 * protos package
 */

namespace Protos {
/**
 * dynamic_gold_pool message embedded in game_numerical message
 */
class game_numerical_dynamic_gold_pool extends \ProtobufMessage
{
    /* Field index constants */
    const ROOM_LEVEL = 1;
    const POOL_RATIO = 2;
    const POOL = 3;
    const PUMP = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POOL_RATIO => array(
            'name' => 'pool_ratio',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::POOL => array(
            'name' => 'pool',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PUMP => array(
            'name' => 'pump',
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
        $this->values[self::ROOM_LEVEL] = null;
        $this->values[self::POOL_RATIO] = null;
        $this->values[self::POOL] = null;
        $this->values[self::PUMP] = null;
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
     * Sets value of 'pool_ratio' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setPoolRatio($value)
    {
        return $this->set(self::POOL_RATIO, $value);
    }

    /**
     * Returns value of 'pool_ratio' property
     *
     * @return double
     */
    public function getPoolRatio()
    {
        $value = $this->get(self::POOL_RATIO);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPool($value)
    {
        return $this->set(self::POOL, $value);
    }

    /**
     * Returns value of 'pool' property
     *
     * @return integer
     */
    public function getPool()
    {
        $value = $this->get(self::POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pump' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPump($value)
    {
        return $this->set(self::PUMP, $value);
    }

    /**
     * Returns value of 'pump' property
     *
     * @return integer
     */
    public function getPump()
    {
        $value = $this->get(self::PUMP);
        return $value === null ? (integer)$value : $value;
    }
}
}