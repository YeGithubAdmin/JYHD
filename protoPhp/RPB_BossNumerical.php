<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * RPB_BossNumerical message
 */
class RPB_BossNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_AWARD_POOL = 1;
    const BOSS_CONSUME = 2;
    const BOSS_PRODUCE_GOLD = 3;
    const BOSS_PRODUCE_BOMB_GOLD = 4;
    const MDATE = 20;
    const UPDATE_TIME = 21;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_CONSUME => array(
            'name' => 'boss_consume',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_PRODUCE_GOLD => array(
            'name' => 'boss_produce_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_PRODUCE_BOMB_GOLD => array(
            'name' => 'boss_produce_bomb_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MDATE => array(
            'name' => 'mdate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::UPDATE_TIME => array(
            'name' => 'update_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::BOSS_CONSUME] = null;
        $this->values[self::BOSS_PRODUCE_GOLD] = null;
        $this->values[self::BOSS_PRODUCE_BOMB_GOLD] = null;
        $this->values[self::MDATE] = null;
        $this->values[self::UPDATE_TIME] = null;
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

    /**
     * Sets value of 'mdate' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMdate($value)
    {
        return $this->set(self::MDATE, $value);
    }

    /**
     * Returns value of 'mdate' property
     *
     * @return string
     */
    public function getMdate()
    {
        $value = $this->get(self::MDATE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'update_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUpdateTime($value)
    {
        return $this->set(self::UPDATE_TIME, $value);
    }

    /**
     * Returns value of 'update_time' property
     *
     * @return string
     */
    public function getUpdateTime()
    {
        $value = $this->get(self::UPDATE_TIME);
        return $value === null ? (string)$value : $value;
    }
}
}