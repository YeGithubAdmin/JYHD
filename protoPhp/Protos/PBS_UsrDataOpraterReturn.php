<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2017-09-07 01:23:17
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_UsrDataOpraterReturn message
 */
class PBS_UsrDataOpraterReturn extends \ProtobufMessage
{
    /* Field index constants */
    const CODE = 1;
    const BASE = 2;
    const ACCOUNT_DATA = 3;
    const MODULES = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CODE => array(
            'name' => 'code',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BASE => array(
            'name' => 'base',
            'required' => false,
            'type' => '\RedisProto\RPB_PlayerData'
        ),
        self::ACCOUNT_DATA => array(
            'name' => 'account_data',
            'required' => false,
            'type' => '\RedisProto\RPB_AccountData'
        ),
        self::MODULES => array(
            'name' => 'modules',
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
        $this->values[self::CODE] = null;
        $this->values[self::BASE] = null;
        $this->values[self::ACCOUNT_DATA] = null;
        $this->values[self::MODULES] = array();
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
     * Sets value of 'base' property
     *
     * @param \RedisProto\RPB_PlayerData $value Property value
     *
     * @return null
     */
    public function setBase(\RedisProto\RPB_PlayerData $value=null)
    {
        return $this->set(self::BASE, $value);
    }

    /**
     * Returns value of 'base' property
     *
     * @return \RedisProto\RPB_PlayerData
     */
    public function getBase()
    {
        return $this->get(self::BASE);
    }

    /**
     * Sets value of 'account_data' property
     *
     * @param \RedisProto\RPB_AccountData $value Property value
     *
     * @return null
     */
    public function setAccountData(\RedisProto\RPB_AccountData $value=null)
    {
        return $this->set(self::ACCOUNT_DATA, $value);
    }

    /**
     * Returns value of 'account_data' property
     *
     * @return \RedisProto\RPB_AccountData
     */
    public function getAccountData()
    {
        return $this->get(self::ACCOUNT_DATA);
    }

    /**
     * Appends value to 'modules' list
     *
     * @param \RedisProto\RPB_ModuleData $value Value to append
     *
     * @return null
     */
    public function appendModules(\RedisProto\RPB_ModuleData $value)
    {
        return $this->append(self::MODULES, $value);
    }

    /**
     * Clears 'modules' list
     *
     * @return null
     */
    public function clearModules()
    {
        return $this->clear(self::MODULES);
    }

    /**
     * Returns 'modules' list
     *
     * @return \RedisProto\RPB_ModuleData[]
     */
    public function getModules()
    {
        return $this->get(self::MODULES);
    }

    /**
     * Returns 'modules' iterator
     *
     * @return \ArrayIterator
     */
    public function getModulesIterator()
    {
        return new \ArrayIterator($this->get(self::MODULES));
    }

    /**
     * Returns element from 'modules' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \RedisProto\RPB_ModuleData
     */
    public function getModulesAt($offset)
    {
        return $this->get(self::MODULES, $offset);
    }

    /**
     * Returns count of 'modules' list
     *
     * @return int
     */
    public function getModulesCount()
    {
        return $this->count(self::MODULES);
    }
}
}