<?php
/**
 * Auto generated from PB_base_data.proto at 2017-10-30 16:45:18
 */

namespace {
/**
 * PB_Attr message
 */
class PB_Attr extends \ProtobufMessage
{
    /* Field index constants */
    const ATTR_TYPE = 1;
    const ATTR_ADD = 2;
    const ATTR_CUR = 3;
    const ATTR_STR = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ATTR_TYPE => array(
            'name' => 'attr_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ATTR_ADD => array(
            'name' => 'attr_add',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ATTR_CUR => array(
            'name' => 'attr_cur',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ATTR_STR => array(
            'name' => 'attr_str',
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
        $this->values[self::ATTR_TYPE] = null;
        $this->values[self::ATTR_ADD] = null;
        $this->values[self::ATTR_CUR] = null;
        $this->values[self::ATTR_STR] = null;
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
     * Sets value of 'attr_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAttrType($value)
    {
        return $this->set(self::ATTR_TYPE, $value);
    }

    /**
     * Returns value of 'attr_type' property
     *
     * @return integer
     */
    public function getAttrType()
    {
        $value = $this->get(self::ATTR_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'attr_add' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAttrAdd($value)
    {
        return $this->set(self::ATTR_ADD, $value);
    }

    /**
     * Returns value of 'attr_add' property
     *
     * @return integer
     */
    public function getAttrAdd()
    {
        $value = $this->get(self::ATTR_ADD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'attr_cur' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAttrCur($value)
    {
        return $this->set(self::ATTR_CUR, $value);
    }

    /**
     * Returns value of 'attr_cur' property
     *
     * @return integer
     */
    public function getAttrCur()
    {
        $value = $this->get(self::ATTR_CUR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'attr_str' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAttrStr($value)
    {
        return $this->set(self::ATTR_STR, $value);
    }

    /**
     * Returns value of 'attr_str' property
     *
     * @return string
     */
    public function getAttrStr()
    {
        $value = $this->get(self::ATTR_STR);
        return $value === null ? (string)$value : $value;
    }
}
}