<?php
/**
 * Auto generated from PB_numerical.proto at 2018-02-06 16:55:50
 */

namespace {
/**
 * room_data message embedded in PB_m2g_refresh message
 */
class PB_m2g_refresh_room_data extends \ProtobufMessage
{
    /* Field index constants */
    const ROOM_LEVEL = 1;
    const GOLD_POOL = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_POOL => array(
            'name' => 'gold_pool',
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
        $this->values[self::GOLD_POOL] = null;
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
     * Sets value of 'gold_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPool($value)
    {
        return $this->set(self::GOLD_POOL, $value);
    }

    /**
     * Returns value of 'gold_pool' property
     *
     * @return integer
     */
    public function getGoldPool()
    {
        $value = $this->get(self::GOLD_POOL);
        return $value === null ? (integer)$value : $value;
    }
}
}