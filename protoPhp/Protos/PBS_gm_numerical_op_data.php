<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-10-25 14:57:35
 *
 * protos package
 */

namespace Protos {
/**
 * data message embedded in PBS_gm_numerical_op message
 */
class PBS_gm_numerical_op_data extends \ProtobufMessage
{
    /* Field index constants */
    const KEY = 1;
    const VALUE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::KEY => array(
            'name' => 'key',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::VALUE => array(
            'name' => 'value',
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
        $this->values[self::KEY] = null;
        $this->values[self::VALUE] = null;
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
     * Sets value of 'key' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setKey($value)
    {
        return $this->set(self::KEY, $value);
    }

    /**
     * Returns value of 'key' property
     *
     * @return string
     */
    public function getKey()
    {
        $value = $this->get(self::KEY);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'value' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue($value)
    {
        return $this->set(self::VALUE, $value);
    }

    /**
     * Returns value of 'value' property
     *
     * @return integer
     */
    public function getValue()
    {
        $value = $this->get(self::VALUE);
        return $value === null ? (integer)$value : $value;
    }
}
}