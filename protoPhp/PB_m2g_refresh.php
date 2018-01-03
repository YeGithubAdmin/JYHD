<?php
/**
 * Auto generated from PB_numerical.proto at 2018-01-02 15:38:42
 */

namespace {
/**
 * PB_m2g_refresh message
 */
class PB_m2g_refresh extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_AWARD_POOL = 1;
    const ROOM_DATAS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOM_DATAS => array(
            'name' => 'room_datas',
            'repeated' => true,
            'type' => '\PB_m2g_refresh_room_data'
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
        $this->values[self::BOSS_AWARD_POOL] = null;
        $this->values[self::ROOM_DATAS] = array();
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
     * Sets value of 'boss_award_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossAwardPool($value)
    {
        return $this->set(self::BOSS_AWARD_POOL, $value);
    }

    /**
     * Returns value of 'boss_award_pool' property
     *
     * @return integer
     */
    public function getBossAwardPool()
    {
        $value = $this->get(self::BOSS_AWARD_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'room_datas' list
     *
     * @param \PB_m2g_refresh_room_data $value Value to append
     *
     * @return null
     */
    public function appendRoomDatas(\PB_m2g_refresh_room_data $value)
    {
        return $this->append(self::ROOM_DATAS, $value);
    }

    /**
     * Clears 'room_datas' list
     *
     * @return null
     */
    public function clearRoomDatas()
    {
        return $this->clear(self::ROOM_DATAS);
    }

    /**
     * Returns 'room_datas' list
     *
     * @return \PB_m2g_refresh_room_data[]
     */
    public function getRoomDatas()
    {
        return $this->get(self::ROOM_DATAS);
    }

    /**
     * Returns 'room_datas' iterator
     *
     * @return \ArrayIterator
     */
    public function getRoomDatasIterator()
    {
        return new \ArrayIterator($this->get(self::ROOM_DATAS));
    }

    /**
     * Returns element from 'room_datas' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_m2g_refresh_room_data
     */
    public function getRoomDatasAt($offset)
    {
        return $this->get(self::ROOM_DATAS, $offset);
    }

    /**
     * Returns count of 'room_datas' list
     *
     * @return int
     */
    public function getRoomDatasCount()
    {
        return $this->count(self::ROOM_DATAS);
    }
}
}