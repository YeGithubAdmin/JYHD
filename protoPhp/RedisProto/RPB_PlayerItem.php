<?php
/**
 * Auto generated from PB_usr_data.proto at 2017-12-26 10:10:52
 *
 * RedisProto package
 */

namespace RedisProto {
/**
 * RPB_PlayerItem message
 */
class RPB_PlayerItem extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const ITEM1_NUM = 2;
    const ITEM2_NUM = 3;
    const ITEM3_NUM = 4;
    const ITEM4_NUM = 5;
    const ITEM5_NUM = 6;
    const ITEM6_NUM = 7;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM1_NUM => array(
            'name' => 'item1_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM2_NUM => array(
            'name' => 'item2_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM3_NUM => array(
            'name' => 'item3_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM4_NUM => array(
            'name' => 'item4_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM5_NUM => array(
            'name' => 'item5_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEM6_NUM => array(
            'name' => 'item6_num',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::ITEM1_NUM] = null;
        $this->values[self::ITEM2_NUM] = null;
        $this->values[self::ITEM3_NUM] = null;
        $this->values[self::ITEM4_NUM] = null;
        $this->values[self::ITEM5_NUM] = null;
        $this->values[self::ITEM6_NUM] = null;
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
     * Sets value of 'playerid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerid($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerid' property
     *
     * @return integer
     */
    public function getPlayerid()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item1_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem1Num($value)
    {
        return $this->set(self::ITEM1_NUM, $value);
    }

    /**
     * Returns value of 'item1_num' property
     *
     * @return integer
     */
    public function getItem1Num()
    {
        $value = $this->get(self::ITEM1_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item2_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem2Num($value)
    {
        return $this->set(self::ITEM2_NUM, $value);
    }

    /**
     * Returns value of 'item2_num' property
     *
     * @return integer
     */
    public function getItem2Num()
    {
        $value = $this->get(self::ITEM2_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item3_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem3Num($value)
    {
        return $this->set(self::ITEM3_NUM, $value);
    }

    /**
     * Returns value of 'item3_num' property
     *
     * @return integer
     */
    public function getItem3Num()
    {
        $value = $this->get(self::ITEM3_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item4_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem4Num($value)
    {
        return $this->set(self::ITEM4_NUM, $value);
    }

    /**
     * Returns value of 'item4_num' property
     *
     * @return integer
     */
    public function getItem4Num()
    {
        $value = $this->get(self::ITEM4_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item5_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem5Num($value)
    {
        return $this->set(self::ITEM5_NUM, $value);
    }

    /**
     * Returns value of 'item5_num' property
     *
     * @return integer
     */
    public function getItem5Num()
    {
        $value = $this->get(self::ITEM5_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'item6_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setItem6Num($value)
    {
        return $this->set(self::ITEM6_NUM, $value);
    }

    /**
     * Returns value of 'item6_num' property
     *
     * @return integer
     */
    public function getItem6Num()
    {
        $value = $this->get(self::ITEM6_NUM);
        return $value === null ? (integer)$value : $value;
    }
}
}