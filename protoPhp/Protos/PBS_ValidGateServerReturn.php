<?php
/**
 * Auto generated from PB_server_common.proto at 2017-12-06 14:11:24
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ValidGateServerReturn message
 */
class PBS_ValidGateServerReturn extends \ProtobufMessage
{
    /* Field index constants */
    const INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INFO => array(
            'name' => 'info',
            'required' => false,
            'type' => '\Protos\PBS_GateServerInfo'
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
        $this->values[self::INFO] = null;
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
     * Sets value of 'info' property
     *
     * @param \Protos\PBS_GateServerInfo $value Property value
     *
     * @return null
     */
    public function setInfo(\Protos\PBS_GateServerInfo $value=null)
    {
        return $this->set(self::INFO, $value);
    }

    /**
     * Returns value of 'info' property
     *
     * @return \Protos\PBS_GateServerInfo
     */
    public function getInfo()
    {
        return $this->get(self::INFO);
    }
}
}