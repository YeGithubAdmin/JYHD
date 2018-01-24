<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * RPB_GameNumerical message
 */
class RPB_GameNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const GOLD_POOL = 1;
    const GOLD_PUMP = 2;
    const PRODUCE_GOLD = 3;
    const CONSUME_GOLD = 4;
    const PRODUCE_FISH_CARD = 5;
    const PRODUCE_SCORE = 6;
    const PRODUCE_BOMB_CU = 7;
    const PRODUCE_BOMB_AG = 8;
    const PRODUCE_BOMB_AU = 9;
    const MDATE = 20;
    const UPDATE_TIME = 21;
    const ROOM_LEVEL = 22;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GOLD_POOL => array(
            'name' => 'gold_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_PUMP => array(
            'name' => 'gold_pump',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD => array(
            'name' => 'produce_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD => array(
            'name' => 'consume_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_FISH_CARD => array(
            'name' => 'produce_fish_card',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_SCORE => array(
            'name' => 'produce_score',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_BOMB_CU => array(
            'name' => 'produce_bomb_cu',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_BOMB_AG => array(
            'name' => 'produce_bomb_ag',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_BOMB_AU => array(
            'name' => 'produce_bomb_au',
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
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
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
        $this->values[self::GOLD_POOL] = null;
        $this->values[self::GOLD_PUMP] = null;
        $this->values[self::PRODUCE_GOLD] = null;
        $this->values[self::CONSUME_GOLD] = null;
        $this->values[self::PRODUCE_FISH_CARD] = null;
        $this->values[self::PRODUCE_SCORE] = null;
        $this->values[self::PRODUCE_BOMB_CU] = null;
        $this->values[self::PRODUCE_BOMB_AG] = null;
        $this->values[self::PRODUCE_BOMB_AU] = null;
        $this->values[self::MDATE] = null;
        $this->values[self::UPDATE_TIME] = null;
        $this->values[self::ROOM_LEVEL] = null;
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
     * Sets value of 'gold_pump' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPump($value)
    {
        return $this->set(self::GOLD_PUMP, $value);
    }

    /**
     * Returns value of 'gold_pump' property
     *
     * @return integer
     */
    public function getGoldPump()
    {
        $value = $this->get(self::GOLD_PUMP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold($value)
    {
        return $this->set(self::PRODUCE_GOLD, $value);
    }

    /**
     * Returns value of 'produce_gold' property
     *
     * @return integer
     */
    public function getProduceGold()
    {
        $value = $this->get(self::PRODUCE_GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold($value)
    {
        return $this->set(self::CONSUME_GOLD, $value);
    }

    /**
     * Returns value of 'consume_gold' property
     *
     * @return integer
     */
    public function getConsumeGold()
    {
        $value = $this->get(self::CONSUME_GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_fish_card' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceFishCard($value)
    {
        return $this->set(self::PRODUCE_FISH_CARD, $value);
    }

    /**
     * Returns value of 'produce_fish_card' property
     *
     * @return integer
     */
    public function getProduceFishCard()
    {
        $value = $this->get(self::PRODUCE_FISH_CARD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_score' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceScore($value)
    {
        return $this->set(self::PRODUCE_SCORE, $value);
    }

    /**
     * Returns value of 'produce_score' property
     *
     * @return integer
     */
    public function getProduceScore()
    {
        $value = $this->get(self::PRODUCE_SCORE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_bomb_cu' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceBombCu($value)
    {
        return $this->set(self::PRODUCE_BOMB_CU, $value);
    }

    /**
     * Returns value of 'produce_bomb_cu' property
     *
     * @return integer
     */
    public function getProduceBombCu()
    {
        $value = $this->get(self::PRODUCE_BOMB_CU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_bomb_ag' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceBombAg($value)
    {
        return $this->set(self::PRODUCE_BOMB_AG, $value);
    }

    /**
     * Returns value of 'produce_bomb_ag' property
     *
     * @return integer
     */
    public function getProduceBombAg()
    {
        $value = $this->get(self::PRODUCE_BOMB_AG);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_bomb_au' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceBombAu($value)
    {
        return $this->set(self::PRODUCE_BOMB_AU, $value);
    }

    /**
     * Returns value of 'produce_bomb_au' property
     *
     * @return integer
     */
    public function getProduceBombAu()
    {
        $value = $this->get(self::PRODUCE_BOMB_AU);
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
}
}