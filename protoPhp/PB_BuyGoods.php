<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-07 01:23:17
 */

namespace {
/**
 * PB_BuyGoods message
 */
class PB_BuyGoods extends \ProtobufMessage
{
    /* Field index constants */
    const ERR = 1;
    const GOODSID = 2;
    const ITEMS = 3;
    const GOLD = 4;
    const DIAMOND = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ERR => array(
            'name' => 'err',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOODSID => array(
            'name' => 'goodsid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEMS => array(
            'name' => 'items',
            'repeated' => true,
            'type' => '\PB_Item'
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
        $this->values[self::ERR] = null;
        $this->values[self::GOODSID] = null;
        $this->values[self::ITEMS] = array();
        $this->values[self::GOLD] = null;
        $this->values[self::DIAMOND] = null;
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
     * Sets value of 'err' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setErr($value)
    {
        return $this->set(self::ERR, $value);
    }

    /**
     * Returns value of 'err' property
     *
     * @return integer
     */
    public function getErr()
    {
        $value = $this->get(self::ERR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'goodsid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoodsid($value)
    {
        return $this->set(self::GOODSID, $value);
    }

    /**
     * Returns value of 'goodsid' property
     *
     * @return integer
     */
    public function getGoodsid()
    {
        $value = $this->get(self::GOODSID);
        return $value === null ? (integer)$value : $value;
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
}
}