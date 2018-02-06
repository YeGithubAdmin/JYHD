<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-02-06 16:55:50
 *
 * protos package
 */

namespace Protos {
/**
 * cfg_shuiguoji_rand_2 message
 */
class cfg_shuiguoji_rand_2 extends \ProtobufMessage
{
    /* Field index constants */
    const MIN = 1;
    const MAX = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MIN => array(
            'name' => 'min',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MAX => array(
            'name' => 'max',
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
        $this->values[self::MIN] = null;
        $this->values[self::MAX] = null;
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
     * Sets value of 'min' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMin($value)
    {
        return $this->set(self::MIN, $value);
    }

    /**
     * Returns value of 'min' property
     *
     * @return integer
     */
    public function getMin()
    {
        $value = $this->get(self::MIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'max' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMax($value)
    {
        return $this->set(self::MAX, $value);
    }

    /**
     * Returns value of 'max' property
     *
     * @return integer
     */
    public function getMax()
    {
        $value = $this->get(self::MAX);
        return $value === null ? (integer)$value : $value;
    }
}
}