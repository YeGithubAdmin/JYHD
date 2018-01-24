<?php
/**
 * Auto generated from PB_notify.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * PB_Res message embedded in PB_ResChange message
 */
class PB_ResChange_PB_Res extends \ProtobufMessage
{
    /* Field index constants */
    const RES = 1;
    const ADD = 2;
    const CUR_NUM = 3;
    const CUR_EXP = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RES => array(
            'name' => 'res',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ADD => array(
            'name' => 'add',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CUR_NUM => array(
            'name' => 'cur_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CUR_EXP => array(
            'name' => 'cur_exp',
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
        $this->values[self::RES] = null;
        $this->values[self::ADD] = null;
        $this->values[self::CUR_NUM] = null;
        $this->values[self::CUR_EXP] = null;
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
     * Sets value of 'res' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRes($value)
    {
        return $this->set(self::RES, $value);
    }

    /**
     * Returns value of 'res' property
     *
     * @return string
     */
    public function getRes()
    {
        $value = $this->get(self::RES);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'add' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAdd($value)
    {
        return $this->set(self::ADD, $value);
    }

    /**
     * Returns value of 'add' property
     *
     * @return integer
     */
    public function getAdd()
    {
        $value = $this->get(self::ADD);
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

    /**
     * Sets value of 'cur_exp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurExp($value)
    {
        return $this->set(self::CUR_EXP, $value);
    }

    /**
     * Returns value of 'cur_exp' property
     *
     * @return integer
     */
    public function getCurExp()
    {
        $value = $this->get(self::CUR_EXP);
        return $value === null ? (integer)$value : $value;
    }
}
}