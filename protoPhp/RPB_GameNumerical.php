<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-12-06 14:11:24
 */

namespace {
/**
 * RPB_GameNumerical message
 */
class RPB_GameNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const PRODUCE_GOLD_1 = 50;
    const CONSUME_GOLD_1 = 51;
    const FISH_CARD_1 = 52;
    const BOMB_1 = 53;
    const SCORE_1 = 54;
    const GOLD_POOL_1 = 55;
    const GOLD_PUMP_1 = 56;
    const PRODUCE_GOLD_2 = 60;
    const CONSUME_GOLD_2 = 61;
    const FISH_CARD_2 = 62;
    const BOMB_2 = 63;
    const SCORE_2 = 64;
    const GOLD_POOL_2 = 65;
    const GOLD_PUMP_2 = 66;
    const PRODUCE_GOLD_3 = 70;
    const CONSUME_GOLD_3 = 71;
    const FISH_CARD_3 = 72;
    const BOMB_3 = 73;
    const SCORE_3 = 74;
    const GOLD_POOL_3 = 75;
    const GOLD_PUMP_3 = 76;
    const PRODUCE_GOLD_4 = 80;
    const CONSUME_GOLD_4 = 81;
    const FISH_CARD_4 = 82;
    const BOMB_4 = 83;
    const SCORE_4 = 84;
    const GOLD_POOL_4 = 85;
    const GOLD_PUMP_4 = 86;
    const BOSS_AWARD_POOL = 90;
    const MDATE = 100;

    /* @var array Field descriptors */
    protected static $fields = array(
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
        self::GOLD_POOL_1 => array(
            'name' => 'gold_pool_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_1 => array(
            'name' => 'gold_pump_1',
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
        self::GOLD_POOL_2 => array(
            'name' => 'gold_pool_2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_2 => array(
            'name' => 'gold_pump_2',
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
        self::GOLD_POOL_3 => array(
            'name' => 'gold_pool_3',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_3 => array(
            'name' => 'gold_pump_3',
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
        self::GOLD_POOL_4 => array(
            'name' => 'gold_pool_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP_4 => array(
            'name' => 'gold_pump_4',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MDATE => array(
            'name' => 'mdate',
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
        $this->values[self::PRODUCE_GOLD_1] = null;
        $this->values[self::CONSUME_GOLD_1] = null;
        $this->values[self::FISH_CARD_1] = null;
        $this->values[self::BOMB_1] = null;
        $this->values[self::SCORE_1] = null;
        $this->values[self::GOLD_POOL_1] = null;
        $this->values[self::GOLD_PUMP_1] = null;
        $this->values[self::PRODUCE_GOLD_2] = null;
        $this->values[self::CONSUME_GOLD_2] = null;
        $this->values[self::FISH_CARD_2] = null;
        $this->values[self::BOMB_2] = null;
        $this->values[self::SCORE_2] = null;
        $this->values[self::GOLD_POOL_2] = null;
        $this->values[self::GOLD_PUMP_2] = null;
        $this->values[self::PRODUCE_GOLD_3] = null;
        $this->values[self::CONSUME_GOLD_3] = null;
        $this->values[self::FISH_CARD_3] = null;
        $this->values[self::BOMB_3] = null;
        $this->values[self::SCORE_3] = null;
        $this->values[self::GOLD_POOL_3] = null;
        $this->values[self::GOLD_PUMP_3] = null;
        $this->values[self::PRODUCE_GOLD_4] = null;
        $this->values[self::CONSUME_GOLD_4] = null;
        $this->values[self::FISH_CARD_4] = null;
        $this->values[self::BOMB_4] = null;
        $this->values[self::SCORE_4] = null;
        $this->values[self::GOLD_POOL_4] = null;
        $this->values[self::GOLD_PUMP_4] = null;
        $this->values[self::BOSS_AWARD_POOL] = null;
        $this->values[self::MDATE] = null;
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
}
}