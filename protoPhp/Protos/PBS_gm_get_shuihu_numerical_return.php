<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-24 16:26:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_gm_get_shuihu_numerical_return message
 */
class PBS_gm_get_shuihu_numerical_return extends \ProtobufMessage
{
    /* Field index constants */
    const DATA = 1;
    const CODE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATA => array(
            'name' => 'data',
            'required' => true,
            'type' => '\Protos\cfg_shuihu_numerical'
        ),
        self::CODE => array(
            'name' => 'code',
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
        $this->values[self::DATA] = null;
        $this->values[self::CODE] = null;
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
     * Sets value of 'data' property
     *
     * @param \Protos\cfg_shuihu_numerical $value Property value
     *
     * @return null
     */
    public function setData(\Protos\cfg_shuihu_numerical $value=null)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return \Protos\cfg_shuihu_numerical
     */
    public function getData()
    {
        return $this->get(self::DATA);
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
}
}