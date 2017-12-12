<?php
/**
 * Auto generated from PB_base_data.proto at 2017-12-06 14:11:24
 */

namespace {
/**
 * PB_RankingData message
 */
class PB_RankingData extends \ProtobufMessage
{
    /* Field index constants */
    const RANKING = 1;
    const NAME = 2;
    const GOLD = 3;
    const BIG_NUM = 4;
    const MID_NUM = 5;
    const SMALL_NUM = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RANKING => array(
            'name' => 'ranking',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BIG_NUM => array(
            'name' => 'big_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MID_NUM => array(
            'name' => 'mid_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SMALL_NUM => array(
            'name' => 'small_num',
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
        $this->values[self::RANKING] = null;
        $this->values[self::NAME] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::BIG_NUM] = null;
        $this->values[self::MID_NUM] = null;
        $this->values[self::SMALL_NUM] = null;
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
     * Sets value of 'ranking' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRanking($value)
    {
        return $this->set(self::RANKING, $value);
    }

    /**
     * Returns value of 'ranking' property
     *
     * @return integer
     */
    public function getRanking()
    {
        $value = $this->get(self::RANKING);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGold($value)
    {
        return $this->set(self::GOLD, $value);
    }

    /**
     * Returns value of 'gold' property
     *
     * @return integer
     */
    public function getGold()
    {
        $value = $this->get(self::GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'big_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBigNum($value)
    {
        return $this->set(self::BIG_NUM, $value);
    }

    /**
     * Returns value of 'big_num' property
     *
     * @return integer
     */
    public function getBigNum()
    {
        $value = $this->get(self::BIG_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'mid_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMidNum($value)
    {
        return $this->set(self::MID_NUM, $value);
    }

    /**
     * Returns value of 'mid_num' property
     *
     * @return integer
     */
    public function getMidNum()
    {
        $value = $this->get(self::MID_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'small_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSmallNum($value)
    {
        return $this->set(self::SMALL_NUM, $value);
    }

    /**
     * Returns value of 'small_num' property
     *
     * @return integer
     */
    public function getSmallNum()
    {
        $value = $this->get(self::SMALL_NUM);
        return $value === null ? (integer)$value : $value;
    }
}
}