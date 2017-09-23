<?php
/**
 * Auto generated from PB_event.proto at 2017-09-22 17:44:52
 */

namespace {
/**
 * RmbUpdate message
 */
class RmbUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const RMB_INCR = 1;
    const RMB_CUR = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RMB_INCR => array(
            'name' => 'rmb_incr',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RMB_CUR => array(
            'name' => 'rmb_cur',
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
        $this->values[self::RMB_INCR] = null;
        $this->values[self::RMB_CUR] = null;
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
     * Sets value of 'rmb_incr' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmbIncr($value)
    {
        return $this->set(self::RMB_INCR, $value);
    }

    /**
     * Returns value of 'rmb_incr' property
     *
     * @return integer
     */
    public function getRmbIncr()
    {
        $value = $this->get(self::RMB_INCR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'rmb_cur' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmbCur($value)
    {
        return $this->set(self::RMB_CUR, $value);
    }

    /**
     * Returns value of 'rmb_cur' property
     *
     * @return integer
     */
    public function getRmbCur()
    {
        $value = $this->get(self::RMB_CUR);
        return $value === null ? (integer)$value : $value;
    }
}
}