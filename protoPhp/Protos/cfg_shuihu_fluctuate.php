<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-18 17:53:25
 *
 * protos package
 */

namespace Protos {
/**
 * cfg_shuihu_fluctuate message
 */
class cfg_shuihu_fluctuate extends \ProtobufMessage
{
    /* Field index constants */
    const INDEX = 1;
    const VALUE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INDEX => array(
            'name' => 'index',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        $this->values[self::INDEX] = null;
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
     * Sets value of 'index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIndex($value)
    {
        return $this->set(self::INDEX, $value);
    }

    /**
     * Returns value of 'index' property
     *
     * @return integer
     */
    public function getIndex()
    {
        $value = $this->get(self::INDEX);
        return $value === null ? (integer)$value : $value;
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