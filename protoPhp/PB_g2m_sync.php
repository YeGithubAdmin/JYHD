<?php
/**
 * Auto generated from PB_numerical.proto at 2018-01-02 15:38:42
 */

namespace {
/**
 * PB_g2m_sync message
 */
class PB_g2m_sync extends \ProtobufMessage
{
    /* Field index constants */
    const ROOM_LEVEL = 1;
    const GOLD_POOL = 2;
    const BOSS_CONSUME = 3;
    const BOSS_PRODUCE_GOLD = 4;
    const BOSS_PRODUCE_BOMB_GOLD = 5;

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
        self::BOSS_CONSUME => array(
            'name' => 'boss_consume',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_PRODUCE_GOLD => array(
            'name' => 'boss_produce_gold',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_PRODUCE_BOMB_GOLD => array(
            'name' => 'boss_produce_bomb_gold',
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
        $this->values[self::BOSS_CONSUME] = null;
        $this->values[self::BOSS_PRODUCE_GOLD] = null;
        $this->values[self::BOSS_PRODUCE_BOMB_GOLD] = null;
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

    /**
     * Sets value of 'boss_consume' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossConsume($value)
    {
        return $this->set(self::BOSS_CONSUME, $value);
    }

    /**
     * Returns value of 'boss_consume' property
     *
     * @return integer
     */
    public function getBossConsume()
    {
        $value = $this->get(self::BOSS_CONSUME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'boss_produce_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossProduceGold($value)
    {
        return $this->set(self::BOSS_PRODUCE_GOLD, $value);
    }

    /**
     * Returns value of 'boss_produce_gold' property
     *
     * @return integer
     */
    public function getBossProduceGold()
    {
        $value = $this->get(self::BOSS_PRODUCE_GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'boss_produce_bomb_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossProduceBombGold($value)
    {
        return $this->set(self::BOSS_PRODUCE_BOMB_GOLD, $value);
    }

    /**
     * Returns value of 'boss_produce_bomb_gold' property
     *
     * @return integer
     */
    public function getBossProduceBombGold()
    {
        $value = $this->get(self::BOSS_PRODUCE_BOMB_GOLD);
        return $value === null ? (integer)$value : $value;
    }
}
}