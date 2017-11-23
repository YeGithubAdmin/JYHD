<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-11-22 14:55:06
 */

namespace {
/**
 * RPB_GameNumerical message
 */
class RPB_GameNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const PAY_PERIOD = 1;
    const POSITIVE_CONSUME = 2;
    const POSITIVE_PRODUCE = 3;
    const POSITIVE_POOL = 4;
    const NEGATIVE_SETTLEMENT_POOL = 5;
    const NEGATIVE_CONSUME = 6;
    const NEGATIVE_PRODUCE = 7;
    const NEGATIVE_POOL = 8;
    const BOMB_GOLD_POOL = 9;
    const BOMB_CU_POOL = 10;
    const BOMB_AG_POOL = 11;
    const BOMB_AU_POOL = 12;
    const BOMB_CU_HISTORY_POOL = 13;
    const BOMB_AG_HISTORY_POOL = 14;
    const BOMB_AU_HISTORY_POOL = 15;
    const FISH_CARD_GOLD_POOL = 16;
    const FISH_CARD_POOL = 17;
    const FISH_CARD_HISTORY_POOL = 18;
    const PUMP_GOLD_HISTORY_POOL = 19;
    const PRODUCE_GOLD_1 = 50;
    const CONSUME_GOLD_1 = 51;
    const FISH_CARD_1 = 52;
    const BOMB_1 = 53;
    const SCORE_1 = 54;
    const PRODUCE_GOLD_2 = 60;
    const CONSUME_GOLD_2 = 61;
    const FISH_CARD_2 = 62;
    const BOMB_2 = 63;
    const SCORE_2 = 64;
    const PRODUCE_GOLD_3 = 70;
    const CONSUME_GOLD_3 = 71;
    const FISH_CARD_3 = 72;
    const BOMB_3 = 73;
    const SCORE_3 = 74;
    const PRODUCE_GOLD_4 = 80;
    const CONSUME_GOLD_4 = 81;
    const FISH_CARD_4 = 82;
    const BOMB_4 = 83;
    const SCORE_4 = 84;
    const BOSS_AWARD_POOL = 90;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PAY_PERIOD => array(
            'name' => 'pay_period',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POSITIVE_CONSUME => array(
            'name' => 'positive_consume',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POSITIVE_PRODUCE => array(
            'name' => 'positive_produce',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POSITIVE_POOL => array(
            'name' => 'positive_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NEGATIVE_SETTLEMENT_POOL => array(
            'name' => 'negative_settlement_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NEGATIVE_CONSUME => array(
            'name' => 'negative_consume',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NEGATIVE_PRODUCE => array(
            'name' => 'negative_produce',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NEGATIVE_POOL => array(
            'name' => 'negative_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_GOLD_POOL => array(
            'name' => 'bomb_gold_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_CU_POOL => array(
            'name' => 'bomb_cu_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_AG_POOL => array(
            'name' => 'bomb_ag_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_AU_POOL => array(
            'name' => 'bomb_au_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_CU_HISTORY_POOL => array(
            'name' => 'bomb_cu_history_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_AG_HISTORY_POOL => array(
            'name' => 'bomb_ag_history_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_AU_HISTORY_POOL => array(
            'name' => 'bomb_au_history_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_GOLD_POOL => array(
            'name' => 'fish_card_gold_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_POOL => array(
            'name' => 'fish_card_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_HISTORY_POOL => array(
            'name' => 'fish_card_history_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PUMP_GOLD_HISTORY_POOL => array(
            'name' => 'pump_gold_history_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD_1 => array(
            'name' => 'produce_gold_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD_1 => array(
            'name' => 'consume_gold_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_1 => array(
            'name' => 'fish_card_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_1 => array(
            'name' => 'bomb_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE_1 => array(
            'name' => 'score_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD_2 => array(
            'name' => 'produce_gold_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD_2 => array(
            'name' => 'consume_gold_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_2 => array(
            'name' => 'fish_card_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_2 => array(
            'name' => 'bomb_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE_2 => array(
            'name' => 'score_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD_3 => array(
            'name' => 'produce_gold_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD_3 => array(
            'name' => 'consume_gold_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_3 => array(
            'name' => 'fish_card_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_3 => array(
            'name' => 'bomb_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE_3 => array(
            'name' => 'score_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD_4 => array(
            'name' => 'produce_gold_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD_4 => array(
            'name' => 'consume_gold_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_4 => array(
            'name' => 'fish_card_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOMB_4 => array(
            'name' => 'bomb_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE_4 => array(
            'name' => 'score_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
            'required' => false,
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
        $this->values[self::PAY_PERIOD] = null;
        $this->values[self::POSITIVE_CONSUME] = null;
        $this->values[self::POSITIVE_PRODUCE] = null;
        $this->values[self::POSITIVE_POOL] = null;
        $this->values[self::NEGATIVE_SETTLEMENT_POOL] = null;
        $this->values[self::NEGATIVE_CONSUME] = null;
        $this->values[self::NEGATIVE_PRODUCE] = null;
        $this->values[self::NEGATIVE_POOL] = null;
        $this->values[self::BOMB_GOLD_POOL] = null;
        $this->values[self::BOMB_CU_POOL] = null;
        $this->values[self::BOMB_AG_POOL] = null;
        $this->values[self::BOMB_AU_POOL] = null;
        $this->values[self::BOMB_CU_HISTORY_POOL] = null;
        $this->values[self::BOMB_AG_HISTORY_POOL] = null;
        $this->values[self::BOMB_AU_HISTORY_POOL] = null;
        $this->values[self::FISH_CARD_GOLD_POOL] = null;
        $this->values[self::FISH_CARD_POOL] = null;
        $this->values[self::FISH_CARD_HISTORY_POOL] = null;
        $this->values[self::PUMP_GOLD_HISTORY_POOL] = null;
        $this->values[self::PRODUCE_GOLD_1] = null;
        $this->values[self::CONSUME_GOLD_1] = null;
        $this->values[self::FISH_CARD_1] = null;
        $this->values[self::BOMB_1] = null;
        $this->values[self::SCORE_1] = null;
        $this->values[self::PRODUCE_GOLD_2] = null;
        $this->values[self::CONSUME_GOLD_2] = null;
        $this->values[self::FISH_CARD_2] = null;
        $this->values[self::BOMB_2] = null;
        $this->values[self::SCORE_2] = null;
        $this->values[self::PRODUCE_GOLD_3] = null;
        $this->values[self::CONSUME_GOLD_3] = null;
        $this->values[self::FISH_CARD_3] = null;
        $this->values[self::BOMB_3] = null;
        $this->values[self::SCORE_3] = null;
        $this->values[self::PRODUCE_GOLD_4] = null;
        $this->values[self::CONSUME_GOLD_4] = null;
        $this->values[self::FISH_CARD_4] = null;
        $this->values[self::BOMB_4] = null;
        $this->values[self::SCORE_4] = null;
        $this->values[self::BOSS_AWARD_POOL] = null;
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
     * Sets value of 'pay_period' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPayPeriod($value)
    {
        return $this->set(self::PAY_PERIOD, $value);
    }

    /**
     * Returns value of 'pay_period' property
     *
     * @return integer
     */
    public function getPayPeriod()
    {
        $value = $this->get(self::PAY_PERIOD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'positive_consume' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPositiveConsume($value)
    {
        return $this->set(self::POSITIVE_CONSUME, $value);
    }

    /**
     * Returns value of 'positive_consume' property
     *
     * @return integer
     */
    public function getPositiveConsume()
    {
        $value = $this->get(self::POSITIVE_CONSUME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'positive_produce' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPositiveProduce($value)
    {
        return $this->set(self::POSITIVE_PRODUCE, $value);
    }

    /**
     * Returns value of 'positive_produce' property
     *
     * @return integer
     */
    public function getPositiveProduce()
    {
        $value = $this->get(self::POSITIVE_PRODUCE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'positive_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPositivePool($value)
    {
        return $this->set(self::POSITIVE_POOL, $value);
    }

    /**
     * Returns value of 'positive_pool' property
     *
     * @return integer
     */
    public function getPositivePool()
    {
        $value = $this->get(self::POSITIVE_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'negative_settlement_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNegativeSettlementPool($value)
    {
        return $this->set(self::NEGATIVE_SETTLEMENT_POOL, $value);
    }

    /**
     * Returns value of 'negative_settlement_pool' property
     *
     * @return integer
     */
    public function getNegativeSettlementPool()
    {
        $value = $this->get(self::NEGATIVE_SETTLEMENT_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'negative_consume' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNegativeConsume($value)
    {
        return $this->set(self::NEGATIVE_CONSUME, $value);
    }

    /**
     * Returns value of 'negative_consume' property
     *
     * @return integer
     */
    public function getNegativeConsume()
    {
        $value = $this->get(self::NEGATIVE_CONSUME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'negative_produce' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNegativeProduce($value)
    {
        return $this->set(self::NEGATIVE_PRODUCE, $value);
    }

    /**
     * Returns value of 'negative_produce' property
     *
     * @return integer
     */
    public function getNegativeProduce()
    {
        $value = $this->get(self::NEGATIVE_PRODUCE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'negative_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNegativePool($value)
    {
        return $this->set(self::NEGATIVE_POOL, $value);
    }

    /**
     * Returns value of 'negative_pool' property
     *
     * @return integer
     */
    public function getNegativePool()
    {
        $value = $this->get(self::NEGATIVE_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_gold_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombGoldPool($value)
    {
        return $this->set(self::BOMB_GOLD_POOL, $value);
    }

    /**
     * Returns value of 'bomb_gold_pool' property
     *
     * @return integer
     */
    public function getBombGoldPool()
    {
        $value = $this->get(self::BOMB_GOLD_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_cu_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombCuPool($value)
    {
        return $this->set(self::BOMB_CU_POOL, $value);
    }

    /**
     * Returns value of 'bomb_cu_pool' property
     *
     * @return integer
     */
    public function getBombCuPool()
    {
        $value = $this->get(self::BOMB_CU_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_ag_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombAgPool($value)
    {
        return $this->set(self::BOMB_AG_POOL, $value);
    }

    /**
     * Returns value of 'bomb_ag_pool' property
     *
     * @return integer
     */
    public function getBombAgPool()
    {
        $value = $this->get(self::BOMB_AG_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_au_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombAuPool($value)
    {
        return $this->set(self::BOMB_AU_POOL, $value);
    }

    /**
     * Returns value of 'bomb_au_pool' property
     *
     * @return integer
     */
    public function getBombAuPool()
    {
        $value = $this->get(self::BOMB_AU_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_cu_history_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombCuHistoryPool($value)
    {
        return $this->set(self::BOMB_CU_HISTORY_POOL, $value);
    }

    /**
     * Returns value of 'bomb_cu_history_pool' property
     *
     * @return integer
     */
    public function getBombCuHistoryPool()
    {
        $value = $this->get(self::BOMB_CU_HISTORY_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_ag_history_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombAgHistoryPool($value)
    {
        return $this->set(self::BOMB_AG_HISTORY_POOL, $value);
    }

    /**
     * Returns value of 'bomb_ag_history_pool' property
     *
     * @return integer
     */
    public function getBombAgHistoryPool()
    {
        $value = $this->get(self::BOMB_AG_HISTORY_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_au_history_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBombAuHistoryPool($value)
    {
        return $this->set(self::BOMB_AU_HISTORY_POOL, $value);
    }

    /**
     * Returns value of 'bomb_au_history_pool' property
     *
     * @return integer
     */
    public function getBombAuHistoryPool()
    {
        $value = $this->get(self::BOMB_AU_HISTORY_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_gold_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardGoldPool($value)
    {
        return $this->set(self::FISH_CARD_GOLD_POOL, $value);
    }

    /**
     * Returns value of 'fish_card_gold_pool' property
     *
     * @return integer
     */
    public function getFishCardGoldPool()
    {
        $value = $this->get(self::FISH_CARD_GOLD_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardPool($value)
    {
        return $this->set(self::FISH_CARD_POOL, $value);
    }

    /**
     * Returns value of 'fish_card_pool' property
     *
     * @return integer
     */
    public function getFishCardPool()
    {
        $value = $this->get(self::FISH_CARD_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_history_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardHistoryPool($value)
    {
        return $this->set(self::FISH_CARD_HISTORY_POOL, $value);
    }

    /**
     * Returns value of 'fish_card_history_pool' property
     *
     * @return integer
     */
    public function getFishCardHistoryPool()
    {
        $value = $this->get(self::FISH_CARD_HISTORY_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'pump_gold_history_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPumpGoldHistoryPool($value)
    {
        return $this->set(self::PUMP_GOLD_HISTORY_POOL, $value);
    }

    /**
     * Returns value of 'pump_gold_history_pool' property
     *
     * @return integer
     */
    public function getPumpGoldHistoryPool()
    {
        $value = $this->get(self::PUMP_GOLD_HISTORY_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold1($value)
    {
        return $this->set(self::PRODUCE_GOLD_1, $value);
    }

    /**
     * Returns value of 'produce_gold_1' property
     *
     * @return integer
     */
    public function getProduceGold1()
    {
        $value = $this->get(self::PRODUCE_GOLD_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold1($value)
    {
        return $this->set(self::CONSUME_GOLD_1, $value);
    }

    /**
     * Returns value of 'consume_gold_1' property
     *
     * @return integer
     */
    public function getConsumeGold1()
    {
        $value = $this->get(self::CONSUME_GOLD_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCard1($value)
    {
        return $this->set(self::FISH_CARD_1, $value);
    }

    /**
     * Returns value of 'fish_card_1' property
     *
     * @return integer
     */
    public function getFishCard1()
    {
        $value = $this->get(self::FISH_CARD_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBomb1($value)
    {
        return $this->set(self::BOMB_1, $value);
    }

    /**
     * Returns value of 'bomb_1' property
     *
     * @return integer
     */
    public function getBomb1()
    {
        $value = $this->get(self::BOMB_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'score_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore1($value)
    {
        return $this->set(self::SCORE_1, $value);
    }

    /**
     * Returns value of 'score_1' property
     *
     * @return integer
     */
    public function getScore1()
    {
        $value = $this->get(self::SCORE_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold2($value)
    {
        return $this->set(self::PRODUCE_GOLD_2, $value);
    }

    /**
     * Returns value of 'produce_gold_2' property
     *
     * @return integer
     */
    public function getProduceGold2()
    {
        $value = $this->get(self::PRODUCE_GOLD_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold2($value)
    {
        return $this->set(self::CONSUME_GOLD_2, $value);
    }

    /**
     * Returns value of 'consume_gold_2' property
     *
     * @return integer
     */
    public function getConsumeGold2()
    {
        $value = $this->get(self::CONSUME_GOLD_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCard2($value)
    {
        return $this->set(self::FISH_CARD_2, $value);
    }

    /**
     * Returns value of 'fish_card_2' property
     *
     * @return integer
     */
    public function getFishCard2()
    {
        $value = $this->get(self::FISH_CARD_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBomb2($value)
    {
        return $this->set(self::BOMB_2, $value);
    }

    /**
     * Returns value of 'bomb_2' property
     *
     * @return integer
     */
    public function getBomb2()
    {
        $value = $this->get(self::BOMB_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'score_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore2($value)
    {
        return $this->set(self::SCORE_2, $value);
    }

    /**
     * Returns value of 'score_2' property
     *
     * @return integer
     */
    public function getScore2()
    {
        $value = $this->get(self::SCORE_2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold3($value)
    {
        return $this->set(self::PRODUCE_GOLD_3, $value);
    }

    /**
     * Returns value of 'produce_gold_3' property
     *
     * @return integer
     */
    public function getProduceGold3()
    {
        $value = $this->get(self::PRODUCE_GOLD_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold3($value)
    {
        return $this->set(self::CONSUME_GOLD_3, $value);
    }

    /**
     * Returns value of 'consume_gold_3' property
     *
     * @return integer
     */
    public function getConsumeGold3()
    {
        $value = $this->get(self::CONSUME_GOLD_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCard3($value)
    {
        return $this->set(self::FISH_CARD_3, $value);
    }

    /**
     * Returns value of 'fish_card_3' property
     *
     * @return integer
     */
    public function getFishCard3()
    {
        $value = $this->get(self::FISH_CARD_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBomb3($value)
    {
        return $this->set(self::BOMB_3, $value);
    }

    /**
     * Returns value of 'bomb_3' property
     *
     * @return integer
     */
    public function getBomb3()
    {
        $value = $this->get(self::BOMB_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'score_3' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore3($value)
    {
        return $this->set(self::SCORE_3, $value);
    }

    /**
     * Returns value of 'score_3' property
     *
     * @return integer
     */
    public function getScore3()
    {
        $value = $this->get(self::SCORE_3);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold4($value)
    {
        return $this->set(self::PRODUCE_GOLD_4, $value);
    }

    /**
     * Returns value of 'produce_gold_4' property
     *
     * @return integer
     */
    public function getProduceGold4()
    {
        $value = $this->get(self::PRODUCE_GOLD_4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold4($value)
    {
        return $this->set(self::CONSUME_GOLD_4, $value);
    }

    /**
     * Returns value of 'consume_gold_4' property
     *
     * @return integer
     */
    public function getConsumeGold4()
    {
        $value = $this->get(self::CONSUME_GOLD_4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCard4($value)
    {
        return $this->set(self::FISH_CARD_4, $value);
    }

    /**
     * Returns value of 'fish_card_4' property
     *
     * @return integer
     */
    public function getFishCard4()
    {
        $value = $this->get(self::FISH_CARD_4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bomb_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBomb4($value)
    {
        return $this->set(self::BOMB_4, $value);
    }

    /**
     * Returns value of 'bomb_4' property
     *
     * @return integer
     */
    public function getBomb4()
    {
        $value = $this->get(self::BOMB_4);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'score_4' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore4($value)
    {
        return $this->set(self::SCORE_4, $value);
    }

    /**
     * Returns value of 'score_4' property
     *
     * @return integer
     */
    public function getScore4()
    {
        $value = $this->get(self::SCORE_4);
        return $value === null ? (integer)$value : $value;
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
}
}