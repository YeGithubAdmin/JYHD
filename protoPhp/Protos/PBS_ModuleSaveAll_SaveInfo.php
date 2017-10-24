<?php
/**
 * Auto generated from PB_module_rpc.proto at 2017-10-20 10:32:03
 *
 * protos package
 */

namespace Protos {
/**
 * SaveInfo message embedded in PBS_ModuleSaveAll message
 */
class PBS_ModuleSaveAll_SaveInfo extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const MODULE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MODULE => array(
            'name' => 'module',
            'required' => true,
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
        $this->values[self::PLAYERID] = null;
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
     * Sets value of 'playerid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerid($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerid' property
     *
     * @return integer
     */
    public function getPlayerid()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
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