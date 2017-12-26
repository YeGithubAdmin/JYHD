<?php
/**
 * Auto generated from PB_event.proto at 2017-12-26 10:10:52
 */

namespace {
/**
 * ExchangeRmbEvent message
 */
class ExchangeRmbEvent extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const INCR_EXCHANGE = 2;
    const DAY30_EXCHANGE = 3;
    const SERVERID = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::INCR_EXCHANGE => array(
            'name' => 'incr_exchange',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAY30_EXCHANGE => array(
            'name' => 'day30_exchange',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::INCR_EXCHANGE] = null;
        $this->values[self::DAY30_EXCHANGE] = null;
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
     * Sets value of 'incr_exchange' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIncrExchange($value)
    {
        return $this->set(self::INCR_EXCHANGE, $value);
    }

    /**
     * Returns value of 'incr_exchange' property
     *
     * @return integer
     */
    public function getIncrExchange()
    {
        $value = $this->get(self::INCR_EXCHANGE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'day30_exchange' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay30Exchange($value)
    {
        return $this->set(self::DAY30_EXCHANGE, $value);
    }

    /**
     * Returns value of 'day30_exchange' property
     *
     * @return integer
     */
    public function getDay30Exchange()
    {
        $value = $this->get(self::DAY30_EXCHANGE);
        return $value === null ? (integer)$value : $value;
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