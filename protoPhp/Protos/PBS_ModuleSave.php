<?php
/**
 * Auto generated from PB_module_rpc.proto at 2017-11-07 17:09:46
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ModuleSave message
 */
class PBS_ModuleSave extends \ProtobufMessage
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
            'repeated' => true,
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
        $this->values[self::MODULE] = array();
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
     * Appends value to 'module' list
     *
     * @param \RedisProto\RPB_ModuleData $value Value to append
     *
     * @return null
     */
    public function appendModule(\RedisProto\RPB_ModuleData $value)
    {
        return $this->append(self::MODULE, $value);
    }

    /**
     * Clears 'module' list
     *
     * @return null
     */
    public function clearModule()
    {
        return $this->clear(self::MODULE);
    }

    /**
     * Returns 'module' list
     *
     * @return \RedisProto\RPB_ModuleData[]
     */
    public function getModule()
    {
        return $this->get(self::MODULE);
    }

    /**
     * Returns 'module' iterator
     *
     * @return \ArrayIterator
     */
    public function getModuleIterator()
    {
        return new \ArrayIterator($this->get(self::MODULE));
    }

    /**
     * Returns element from 'module' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \RedisProto\RPB_ModuleData
     */
    public function getModuleAt($offset)
    {
        return $this->get(self::MODULE, $offset);
    }

    /**
     * Returns count of 'module' list
     *
     * @return int
     */
    public function getModuleCount()
    {
        return $this->count(self::MODULE);
    }
}
}