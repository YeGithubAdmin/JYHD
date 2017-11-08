<?php
/**
 * Auto generated from PB_base_data.proto at 2017-11-07 17:09:46
 */

namespace {
/**
 * PB_Item message
 */
class PB_Item extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const NUM = 2;
    const CUR_NUM = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NUM => array(
            'name' => 'num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CUR_NUM => array(
            'name' => 'cur_num',
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
        $this->values[self::ID] = null;
        $this->values[self::NUM] = null;
        $this->values[self::CUR_NUM] = null;
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
     * Sets value of 'num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNum($value)
    {
        return $this->set(self::NUM, $value);
    }

    /**
     * Returns value of 'num' property
     *
     * @return integer
     */
    public function getNum()
    {
        $value = $this->get(self::NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'cur_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurNum($value)
    {
        return $this->set(self::CUR_NUM, $value);
    }

    /**
     * Returns value of 'cur_num' property
     *
     * @return integer
     */
    public function getCurNum()
    {
        $value = $this->get(self::CUR_NUM);
        return $value === null ? (integer)$value : $value;
    }
}
}