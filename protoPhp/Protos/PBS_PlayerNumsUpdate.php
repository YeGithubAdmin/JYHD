<?php
/**
 * Auto generated from PB_server_common.proto at 2017-09-22 17:45:11
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_PlayerNumsUpdate message
 */
class PBS_PlayerNumsUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const SERVERID = 1;
    const PLAYERS = 2;
    const ROBOTS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SERVERID => array(
            'name' => 'serverid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERS => array(
            'name' => 'players',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROBOTS => array(
            'name' => 'robots',
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
        $this->values[self::SERVERID] = null;
        $this->values[self::PLAYERS] = null;
        $this->values[self::ROBOTS] = null;
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

    /**
     * Sets value of 'players' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayers($value)
    {
        return $this->set(self::PLAYERS, $value);
    }

    /**
     * Returns value of 'players' property
     *
     * @return integer
     */
    public function getPlayers()
    {
        $value = $this->get(self::PLAYERS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'robots' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRobots($value)
    {
        return $this->set(self::ROBOTS, $value);
    }

    /**
     * Returns value of 'robots' property
     *
     * @return integer
     */
    public function getRobots()
    {
        $value = $this->get(self::ROBOTS);
        return $value === null ? (integer)$value : $value;
    }
}
}