<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2017-09-28 20:15:01
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
    const PLAYER_NUMERICAL = 5;
    const ITEMS = 6;

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
        self::PLAYER_NUMERICAL => array(
            'name' => 'player_numerical',
            'required' => false,
            'type' => '\RPB_PlayerNumerical'
        ),
        self::ITEMS => array(
            'name' => 'items',
            'repeated' => true,
            'type' => '\PB_Item'
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
        $this->values[self::PLAYER_NUMERICAL] = null;
        $this->values[self::ITEMS] = array();
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

    /**
     * Sets value of 'player_numerical' property
     *
     * @param \RPB_PlayerNumerical $value Property value
     *
     * @return null
     */
    public function setPlayerNumerical(\RPB_PlayerNumerical $value=null)
    {
        return $this->set(self::PLAYER_NUMERICAL, $value);
    }

    /**
     * Returns value of 'player_numerical' property
     *
     * @return \RPB_PlayerNumerical
     */
    public function getPlayerNumerical()
    {
        return $this->get(self::PLAYER_NUMERICAL);
    }

    /**
     * Appends value to 'items' list
     *
     * @param \PB_Item $value Value to append
     *
     * @return null
     */
    public function appendItems(\PB_Item $value)
    {
        return $this->append(self::ITEMS, $value);
    }

    /**
     * Clears 'items' list
     *
     * @return null
     */
    public function clearItems()
    {
        return $this->clear(self::ITEMS);
    }

    /**
     * Returns 'items' list
     *
     * @return \PB_Item[]
     */
    public function getItems()
    {
        return $this->get(self::ITEMS);
    }

    /**
     * Returns 'items' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemsIterator()
    {
        return new \ArrayIterator($this->get(self::ITEMS));
    }

    /**
     * Returns element from 'items' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_Item
     */
    public function getItemsAt($offset)
    {
        return $this->get(self::ITEMS, $offset);
    }

    /**
     * Returns count of 'items' list
     *
     * @return int
     */
    public function getItemsCount()
    {
        return $this->count(self::ITEMS);
    }
}
}