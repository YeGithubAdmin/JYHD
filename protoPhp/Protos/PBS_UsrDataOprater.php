<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2017-11-29 17:29:43
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_UsrDataOprater message
 */
class PBS_UsrDataOprater extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const OPT = 2;
    const SRC = 3;
    const ACCOUNT_DATA = 4;
    const PLAYER_DATA = 5;
    const ITEM_OPT = 6;
    const SEND_EMAIL = 7;
    const REASON = 8;
    const USE_ITEM = 9;
    const PLAYER_NUMERICAL_SET = 11;
    const PLAYER_NUMERICAL_INCR = 12;
    const NOTIFY = 13;
    const EXCHANGE_RMB = 14;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OPT => array(
            'name' => 'opt',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SRC => array(
            'name' => 'src',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ACCOUNT_DATA => array(
            'name' => 'account_data',
            'required' => false,
            'type' => '\RedisProto\RPB_AccountData'
        ),
        self::PLAYER_DATA => array(
            'name' => 'player_data',
            'required' => false,
            'type' => '\RedisProto\RPB_PlayerData'
        ),
        self::ITEM_OPT => array(
            'name' => 'item_opt',
            'repeated' => true,
            'type' => '\PB_Item'
        ),
        self::SEND_EMAIL => array(
            'name' => 'send_email',
            'required' => false,
            'type' => '\PB_Email'
        ),
        self::REASON => array(
            'default' => \OptReason::OptReason_None,
            'name' => 'reason',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::USE_ITEM => array(
            'name' => 'use_item',
            'required' => false,
            'type' => '\PB_Item'
        ),
        self::PLAYER_NUMERICAL_SET => array(
            'name' => 'player_numerical_set',
            'required' => false,
            'type' => '\RPB_PlayerNumerical'
        ),
        self::PLAYER_NUMERICAL_INCR => array(
            'name' => 'player_numerical_incr',
            'required' => false,
            'type' => '\RPB_PlayerNumerical'
        ),
        self::NOTIFY => array(
            'name' => 'notify',
            'required' => false,
            'type' => '\PB_HallNotify'
        ),
        self::EXCHANGE_RMB => array(
            'name' => 'exchange_rmb',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::OPT] = null;
        $this->values[self::SRC] = null;
        $this->values[self::ACCOUNT_DATA] = null;
        $this->values[self::PLAYER_DATA] = null;
        $this->values[self::ITEM_OPT] = array();
        $this->values[self::SEND_EMAIL] = null;
        $this->values[self::REASON] = self::$fields[self::REASON]['default'];
        $this->values[self::USE_ITEM] = null;
        $this->values[self::PLAYER_NUMERICAL_SET] = null;
        $this->values[self::PLAYER_NUMERICAL_INCR] = null;
        $this->values[self::NOTIFY] = null;
        $this->values[self::EXCHANGE_RMB] = null;
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
     * Sets value of 'opt' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOpt($value)
    {
        return $this->set(self::OPT, $value);
    }

    /**
     * Returns value of 'opt' property
     *
     * @return integer
     */
    public function getOpt()
    {
        $value = $this->get(self::OPT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'src' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSrc($value)
    {
        return $this->set(self::SRC, $value);
    }

    /**
     * Returns value of 'src' property
     *
     * @return integer
     */
    public function getSrc()
    {
        $value = $this->get(self::SRC);
        return $value === null ? (integer)$value : $value;
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
     * Sets value of 'player_data' property
     *
     * @param \RedisProto\RPB_PlayerData $value Property value
     *
     * @return null
     */
    public function setPlayerData(\RedisProto\RPB_PlayerData $value=null)
    {
        return $this->set(self::PLAYER_DATA, $value);
    }

    /**
     * Returns value of 'player_data' property
     *
     * @return \RedisProto\RPB_PlayerData
     */
    public function getPlayerData()
    {
        return $this->get(self::PLAYER_DATA);
    }

    /**
     * Appends value to 'item_opt' list
     *
     * @param \PB_Item $value Value to append
     *
     * @return null
     */
    public function appendItemOpt(\PB_Item $value)
    {
        return $this->append(self::ITEM_OPT, $value);
    }

    /**
     * Clears 'item_opt' list
     *
     * @return null
     */
    public function clearItemOpt()
    {
        return $this->clear(self::ITEM_OPT);
    }

    /**
     * Returns 'item_opt' list
     *
     * @return \PB_Item[]
     */
    public function getItemOpt()
    {
        return $this->get(self::ITEM_OPT);
    }

    /**
     * Returns 'item_opt' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemOptIterator()
    {
        return new \ArrayIterator($this->get(self::ITEM_OPT));
    }

    /**
     * Returns element from 'item_opt' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_Item
     */
    public function getItemOptAt($offset)
    {
        return $this->get(self::ITEM_OPT, $offset);
    }

    /**
     * Returns count of 'item_opt' list
     *
     * @return int
     */
    public function getItemOptCount()
    {
        return $this->count(self::ITEM_OPT);
    }

    /**
     * Sets value of 'send_email' property
     *
     * @param \PB_Email $value Property value
     *
     * @return null
     */
    public function setSendEmail(\PB_Email $value=null)
    {
        return $this->set(self::SEND_EMAIL, $value);
    }

    /**
     * Returns value of 'send_email' property
     *
     * @return \PB_Email
     */
    public function getSendEmail()
    {
        return $this->get(self::SEND_EMAIL);
    }

    /**
     * Sets value of 'reason' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReason($value)
    {
        return $this->set(self::REASON, $value);
    }

    /**
     * Returns value of 'reason' property
     *
     * @return integer
     */
    public function getReason()
    {
        $value = $this->get(self::REASON);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'use_item' property
     *
     * @param \PB_Item $value Property value
     *
     * @return null
     */
    public function setUseItem(\PB_Item $value=null)
    {
        return $this->set(self::USE_ITEM, $value);
    }

    /**
     * Returns value of 'use_item' property
     *
     * @return \PB_Item
     */
    public function getUseItem()
    {
        return $this->get(self::USE_ITEM);
    }

    /**
     * Sets value of 'player_numerical_set' property
     *
     * @param \RPB_PlayerNumerical $value Property value
     *
     * @return null
     */
    public function setPlayerNumericalSet(\RPB_PlayerNumerical $value=null)
    {
        return $this->set(self::PLAYER_NUMERICAL_SET, $value);
    }

    /**
     * Returns value of 'player_numerical_set' property
     *
     * @return \RPB_PlayerNumerical
     */
    public function getPlayerNumericalSet()
    {
        return $this->get(self::PLAYER_NUMERICAL_SET);
    }

    /**
     * Sets value of 'player_numerical_incr' property
     *
     * @param \RPB_PlayerNumerical $value Property value
     *
     * @return null
     */
    public function setPlayerNumericalIncr(\RPB_PlayerNumerical $value=null)
    {
        return $this->set(self::PLAYER_NUMERICAL_INCR, $value);
    }

    /**
     * Returns value of 'player_numerical_incr' property
     *
     * @return \RPB_PlayerNumerical
     */
    public function getPlayerNumericalIncr()
    {
        return $this->get(self::PLAYER_NUMERICAL_INCR);
    }

    /**
     * Sets value of 'notify' property
     *
     * @param \PB_HallNotify $value Property value
     *
     * @return null
     */
    public function setNotify(\PB_HallNotify $value=null)
    {
        return $this->set(self::NOTIFY, $value);
    }

    /**
     * Returns value of 'notify' property
     *
     * @return \PB_HallNotify
     */
    public function getNotify()
    {
        return $this->get(self::NOTIFY);
    }

    /**
     * Sets value of 'exchange_rmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExchangeRmb($value)
    {
        return $this->set(self::EXCHANGE_RMB, $value);
    }

    /**
     * Returns value of 'exchange_rmb' property
     *
     * @return integer
     */
    public function getExchangeRmb()
    {
        $value = $this->get(self::EXCHANGE_RMB);
        return $value === null ? (integer)$value : $value;
    }
}
}