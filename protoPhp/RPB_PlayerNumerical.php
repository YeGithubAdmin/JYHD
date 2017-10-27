<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-10-25 14:57:37
 */

namespace {
/**
 * RPB_PlayerNumerical message
 */
class RPB_PlayerNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const GOLD_PAY = 1;
    const GOLD_NEWP_INDEX = 2;
    const DIAMOND_DAY = 3;
    const DIAMOND_NEWP = 4;
    const DIAMOND_NEWP_INDEX = 5;
    const FISH_CARD_NEWP = 6;
    const CATCH_FISH_NUM = 7;
    const ITEM_DAY = 8;
    const GOLD_NEWP = 9;
    const LICENCE = 10;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GOLD_PAY => array(
            'name' => 'gold_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_NEWP_INDEX => array(
            'name' => 'gold_newp_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_DAY => array(
            'name' => 'diamond_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_NEWP => array(
            'name' => 'diamond_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND_NEWP_INDEX => array(
            'name' => 'diamond_newp_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_NEWP => array(
            'name' => 'fish_card_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CATCH_FISH_NUM => array(
            'name' => 'catch_fish_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM_DAY => array(
            'name' => 'item_day',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOLD_NEWP => array(
            'name' => 'gold_newp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LICENCE => array(
            'name' => 'licence',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::GOLD_PAY] = null;
        $this->values[self::GOLD_NEWP_INDEX] = null;
        $this->values[self::DIAMOND_DAY] = null;
        $this->values[self::DIAMOND_NEWP] = null;
        $this->values[self::DIAMOND_NEWP_INDEX] = null;
        $this->values[self::FISH_CARD_NEWP] = null;
        $this->values[self::CATCH_FISH_NUM] = null;
        $this->values[self::ITEM_DAY] = null;
        $this->values[self::GOLD_NEWP] = null;
        $this->values[self::LICENCE] = null;
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
     * Sets value of 'gold_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldPay($value)
    {
        return $this->set(self::GOLD_PAY, $value);
    }

    /**
     * Returns value of 'gold_pay' property
     *
     * @return integer
     */
    public function getGoldPay()
    {
        $value = $this->get(self::GOLD_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_newp_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldNewpIndex($value)
    {
        return $this->set(self::GOLD_NEWP_INDEX, $value);
    }

    /**
     * Returns value of 'gold_newp_index' property
     *
     * @return integer
     */
    public function getGoldNewpIndex()
    {
        $value = $this->get(self::GOLD_NEWP_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondDay($value)
    {
        return $this->set(self::DIAMOND_DAY, $value);
    }

    /**
     * Returns value of 'diamond_day' property
     *
     * @return integer
     */
    public function getDiamondDay()
    {
        $value = $this->get(self::DIAMOND_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondNewp($value)
    {
        return $this->set(self::DIAMOND_NEWP, $value);
    }

    /**
     * Returns value of 'diamond_newp' property
     *
     * @return integer
     */
    public function getDiamondNewp()
    {
        $value = $this->get(self::DIAMOND_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'diamond_newp_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamondNewpIndex($value)
    {
        return $this->set(self::DIAMOND_NEWP_INDEX, $value);
    }

    /**
     * Returns value of 'diamond_newp_index' property
     *
     * @return integer
     */
    public function getDiamondNewpIndex()
    {
        $value = $this->get(self::DIAMOND_NEWP_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardNewp($value)
    {
        return $this->set(self::FISH_CARD_NEWP, $value);
    }

    /**
     * Returns value of 'fish_card_newp' property
     *
     * @return integer
     */
    public function getFishCardNewp()
    {
        $value = $this->get(self::FISH_CARD_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'catch_fish_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCatchFishNum($value)
    {
        return $this->set(self::CATCH_FISH_NUM, $value);
    }

    /**
     * Returns value of 'catch_fish_num' property
     *
     * @return integer
     */
    public function getCatchFishNum()
    {
        $value = $this->get(self::CATCH_FISH_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item_day' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItemDay($value)
    {
        return $this->set(self::ITEM_DAY, $value);
    }

    /**
     * Returns value of 'item_day' property
     *
     * @return integer
     */
    public function getItemDay()
    {
        $value = $this->get(self::ITEM_DAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gold_newp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoldNewp($value)
    {
        return $this->set(self::GOLD_NEWP, $value);
    }

    /**
     * Returns value of 'gold_newp' property
     *
     * @return integer
     */
    public function getGoldNewp()
    {
        $value = $this->get(self::GOLD_NEWP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'licence' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setLicence($value)
    {
        return $this->set(self::LICENCE, $value);
    }

    /**
     * Returns value of 'licence' property
     *
     * @return boolean
     */
    public function getLicence()
    {
        $value = $this->get(self::LICENCE);
        return $value === null ? (boolean)$value : $value;
    }
}
}