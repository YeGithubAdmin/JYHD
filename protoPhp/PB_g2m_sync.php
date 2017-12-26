<?php
/**
 * Auto generated from PB_numerical.proto at 2017-12-26 10:53:15
 */

namespace {
/**
 * PB_g2m_sync message
 */
class PB_g2m_sync extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_CONSUME = 1;
    const BOSS_PRODUCE_GOLD = 2;
    const BOSS_PRODUCE_BOMB_GOLD = 3;
    const GOLD_POOL_1 = 10;
    const GOLD_PUMP_1 = 11;
    const GOLD_POOL_2 = 12;
    const GOLD_PUMP_2 = 13;
    const GOLD_POOL_3 = 14;
    const GOLD_PUMP_3 = 15;
    const GOLD_POOL_4 = 16;
    const GOLD_PUMP_4 = 17;

    /* @var array Field descriptors */
    protected static $fields = array(
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
        self::GOLD_POOL_1 => array(
            'name' => 'gold_pool_1',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_1 => array(
            'name' => 'gold_pump_1',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_POOL_2 => array(
            'name' => 'gold_pool_2',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_2 => array(
            'name' => 'gold_pump_2',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_POOL_3 => array(
            'name' => 'gold_pool_3',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_3 => array(
            'name' => 'gold_pump_3',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_POOL_4 => array(
            'name' => 'gold_pool_4',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_4 => array(
            'name' => 'gold_pump_4',
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
        $this->values[self::BOSS_CONSUME] = null;
        $this->values[self::BOSS_PRODUCE_GOLD] = null;
        $this->values[self::BOSS_PRODUCE_BOMB_GOLD] = null;
        $this->values[self::GOLD_POOL_1] = null;
        $this->values[self::GOLD_PUMP_1] = null;
        $this->values[self::GOLD_POOL_2] = null;
        $this->values[self::GOLD_PUMP_2] = null;
        $this->values[self::GOLD_POOL_3] = null;
        $this->values[self::GOLD_PUMP_3] = null;
        $this->values[self::GOLD_POOL_4] = null;
        $this->values[self::GOLD_PUMP_4] = null;
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
     * Sets value of 'gold_pool_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPool1($value)
    {
        return $this->set(self::GOLD_POOL_1, $value);
    }

    /**
     * Returns value of 'gold_pool_1' property
     *
     * @return integer
     */
    public function getGoldPool1()
    {
        $value = $this->get(self::GOLD_POOL_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pump_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPump1($value)
    {
        return $this->set(self::GOLD_PUMP_1, $value);
    }

    /**
     * Returns value of 'gold_pump_1' property
     *
     * @return integer
     */
    public function getGoldPump1()
    {
        $value = $this->get(self::GOLD_PUMP_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pool_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPool2($value)
    {
        return $this->set(self::GOLD_POOL_2, $value);
    }

    /**
     * Returns value of 'gold_pool_2' property
     *
     * @return integer
     */
    public function getGoldPool2()
    {
        $value = $this->get(self::GOLD_POOL_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pump_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPump2($value)
    {
        return $this->set(self::GOLD_PUMP_2, $value);
    }

    /**
     * Returns value of 'gold_pump_2' property
     *
     * @return integer
     */
    public function getGoldPump2()
    {
        $value = $this->get(self::GOLD_PUMP_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pool_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPool3($value)
    {
        return $this->set(self::GOLD_POOL_3, $value);
    }

    /**
     * Returns value of 'gold_pool_3' property
     *
     * @return integer
     */
    public function getGoldPool3()
    {
        $value = $this->get(self::GOLD_POOL_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pump_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPump3($value)
    {
        return $this->set(self::GOLD_PUMP_3, $value);
    }

    /**
     * Returns value of 'gold_pump_3' property
     *
     * @return integer
     */
    public function getGoldPump3()
    {
        $value = $this->get(self::GOLD_PUMP_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pool_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPool4($value)
    {
        return $this->set(self::GOLD_POOL_4, $value);
    }

    /**
     * Returns value of 'gold_pool_4' property
     *
     * @return integer
     */
    public function getGoldPool4()
    {
        $value = $this->get(self::GOLD_POOL_4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_pump_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPump4($value)
    {
        return $this->set(self::GOLD_PUMP_4, $value);
    }

    /**
     * Returns value of 'gold_pump_4' property
     *
     * @return integer
     */
    public function getGoldPump4()
    {
        $value = $this->get(self::GOLD_PUMP_4);
        return $value === null ? (integer)$value : $value;
    }
}
}