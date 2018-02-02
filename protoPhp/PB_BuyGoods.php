<?php
/**
 * Auto generated from PB_base_data.proto at 2018-02-01 10:24:00
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
}
}