<?php
/**
 * Auto generated from PB_server_common.proto at 2017-11-07 17:09:46
 *
 * protos package
 */

namespace Protos {
/**
 * ClientInfo message embedded in PBS_ServerRegisterReturn message
 */
class PBS_ServerRegisterReturn_ClientInfo extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const COMMUNIID = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::COMMUNIID => array(
            'name' => 'communiid',
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
        $this->values[self::COMMUNIID] = null;
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
     * Sets value of 'communiid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCommuniid($value)
    {
        return $this->set(self::COMMUNIID, $value);
    }

    /**
     * Returns value of 'communiid' property
     *
     * @return integer
     */
    public function getCommuniid()
    {
        $value = $this->get(self::COMMUNIID);
        return $value === null ? (integer)$value : $value;
    }
}
}