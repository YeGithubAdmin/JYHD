<?php
/**
 * Auto generated from PB_event.proto at 2018-01-02 15:38:42
 */

namespace {
/**
 * MidShellUpdate message
 */
class MidShellUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_NUM = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_NUM => array(
            'name' => 'cur_num',
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