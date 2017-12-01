<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-29 17:29:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_GetGameNumericalReturn message
 */
class PBS_GetGameNumericalReturn extends \ProtobufMessage
{
    /* Field index constants */
    const CODE = 1;
    const DATA = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CODE => array(
            'name' => 'code',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DATA => array(
            'name' => 'data',
            'required' => false,
            'type' => '\RPB_GameNumerical'
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
        $this->values[self::CODE] = null;
        $this->values[self::DATA] = null;
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
     * Sets value of 'code' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCode($value)
    {
        return $this->set(self::CODE, $value);
    }

    /**
     * Returns value of 'code' property
     *
     * @return integer
     */
    public function getCode()
    {
        $value = $this->get(self::CODE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'data' property
     *
     * @param \RPB_GameNumerical $value Property value
     *
     * @return null
     */
    public function setData(\RPB_GameNumerical $value=null)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return \RPB_GameNumerical
     */
    public function getData()
    {
        return $this->get(self::DATA);
    }
}
}