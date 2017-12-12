<?php
/**
 * Auto generated from PB_numerical.proto at 2017-12-06 14:11:23
 */

namespace {
/**
 * PB_m2g_refresh message
 */
class PB_m2g_refresh extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_AWARD_POOL = 1;
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
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
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
        $this->values[self::BOSS_AWARD_POOL] = null;
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