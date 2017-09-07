<?php
/**
 * Auto generated from PB_module_rpc.proto at 2017-09-07 01:23:07
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ModuleDataReturn message
 */
class PBS_ModuleDataReturn extends \ProtobufMessage
{
    /* Field index constants */
    const MODULE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MODULE => array(
            'name' => 'module',
            'required' => false,
            'type' => '\RedisProto\RPB_ModuleData'
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
        $this->values[self::MODULE] = null;
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
     * Sets value of 'module' property
     *
     * @param \RedisProto\RPB_ModuleData $value Property value
     *
     * @return null
     */
    public function setModule(\RedisProto\RPB_ModuleData $value=null)
    {
        return $this->set(self::MODULE, $value);
    }

    /**
     * Returns value of 'module' property
     *
     * @return \RedisProto\RPB_ModuleData
     */
    public function getModule()
    {
        return $this->get(self::MODULE);
    }
}
}