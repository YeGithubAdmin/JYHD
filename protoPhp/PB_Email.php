<?php
/**
 * Auto generated from PB_base_data.proto at 2018-01-02 15:38:42
 */

namespace {
/**
 * PB_Email message
 */
class PB_Email extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const TITLE = 2;
    const DATA = 3;
    const TIME = 4;
    const STATE = 5;
    const ITEMS = 6;
    const CARD_NUM = 7;
    const CARD_PWD = 8;
    const GOLD = 9;
    const DIAMOND = 10;
    const TYPE = 11;
    const SENDER = 12;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TITLE => array(
            'name' => 'title',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DATA => array(
            'name' => 'data',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::TIME => array(
            'name' => 'time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::STATE => array(
            'name' => 'state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::ITEMS => array(
            'name' => 'items',
            'repeated' => true,
            'type' => '\PB_Item'
        ),
        self::CARD_NUM => array(
            'name' => 'card_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CARD_PWD => array(
            'name' => 'card_pwd',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::GOLD => array(
            'name' => 'gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIAMOND => array(
            'name' => 'diamond',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SENDER => array(
            'name' => 'sender',
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
        $this->values[self::ID] = null;
        $this->values[self::TITLE] = null;
        $this->values[self::DATA] = null;
        $this->values[self::TIME] = null;
        $this->values[self::STATE] = null;
        $this->values[self::ITEMS] = array();
        $this->values[self::CARD_NUM] = null;
        $this->values[self::CARD_PWD] = null;
        $this->values[self::GOLD] = null;
        $this->values[self::DIAMOND] = null;
        $this->values[self::TYPE] = null;
        $this->values[self::SENDER] = null;
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
     * Sets value of 'id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::ID, $value);
    }

    /**
     * Returns value of 'id' property
     *
     * @return integer
     */
    public function getId()
    {
        $value = $this->get(self::ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'title' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTitle($value)
    {
        return $this->set(self::TITLE, $value);
    }

    /**
     * Returns value of 'title' property
     *
     * @return string
     */
    public function getTitle()
    {
        $value = $this->get(self::TITLE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'data' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setData($value)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return string
     */
    public function getData()
    {
        $value = $this->get(self::DATA);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTime($value)
    {
        return $this->set(self::TIME, $value);
    }

    /**
     * Returns value of 'time' property
     *
     * @return string
     */
    public function getTime()
    {
        $value = $this->get(self::TIME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'state' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setState($value)
    {
        return $this->set(self::STATE, $value);
    }

    /**
     * Returns value of 'state' property
     *
     * @return boolean
     */
    public function getState()
    {
        $value = $this->get(self::STATE);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Appends value to 'items' list
     *
     * @param \PB_Item $value Value to append
     *
     * @return null
     */
    public function appendItems(\PB_Item $value)
    {
        return $this->append(self::ITEMS, $value);
    }

    /**
     * Clears 'items' list
     *
     * @return null
     */
    public function clearItems()
    {
        return $this->clear(self::ITEMS);
    }

    /**
     * Returns 'items' list
     *
     * @return \PB_Item[]
     */
    public function getItems()
    {
        return $this->get(self::ITEMS);
    }

    /**
     * Returns 'items' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemsIterator()
    {
        return new \ArrayIterator($this->get(self::ITEMS));
    }

    /**
     * Returns element from 'items' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_Item
     */
    public function getItemsAt($offset)
    {
        return $this->get(self::ITEMS, $offset);
    }

    /**
     * Returns count of 'items' list
     *
     * @return int
     */
    public function getItemsCount()
    {
        return $this->count(self::ITEMS);
    }

    /**
     * Sets value of 'card_num' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCardNum($value)
    {
        return $this->set(self::CARD_NUM, $value);
    }

    /**
     * Returns value of 'card_num' property
     *
     * @return string
     */
    public function getCardNum()
    {
        $value = $this->get(self::CARD_NUM);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'card_pwd' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCardPwd($value)
    {
        return $this->set(self::CARD_PWD, $value);
    }

    /**
     * Returns value of 'card_pwd' property
     *
     * @return string
     */
    public function getCardPwd()
    {
        $value = $this->get(self::CARD_PWD);
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
     * Sets value of 'diamond' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiamond($value)
    {
        return $this->set(self::DIAMOND, $value);
    }

    /**
     * Returns value of 'diamond' property
     *
     * @return integer
     */
    public function getDiamond()
    {
        $value = $this->get(self::DIAMOND);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sender' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSender($value)
    {
        return $this->set(self::SENDER, $value);
    }

    /**
     * Returns value of 'sender' property
     *
     * @return string
     */
    public function getSender()
    {
        $value = $this->get(self::SENDER);
        return $value === null ? (string)$value : $value;
    }
}
}