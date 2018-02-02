<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-02-01 10:23:59
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_gm_set_shuihu_numerical message
 */
class PBS_gm_set_shuihu_numerical extends \ProtobufMessage
{
    /* Field index constants */
    const DATA = 1;
    const SERVERID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATA => array(
            'name' => 'data',
            'required' => true,
            'type' => '\Protos\cfg_shuihu_numerical'
        ),
        self::SERVERID => array(
            'name' => 'serverid',
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
        $this->values[self::DATA] = null;
        $this->values[self::SERVERID] = null;
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
     * Sets value of 'serverid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setServerid($value)
    {
        return $this->set(self::SERVERID, $value);
    }

    /**
     * Returns value of 'serverid' property
     *
     * @return integer
     */
    public function getServerid()
    {
        $value = $this->get(self::SERVERID);
        return $value === null ? (integer)$value : $value;
    }
}
}