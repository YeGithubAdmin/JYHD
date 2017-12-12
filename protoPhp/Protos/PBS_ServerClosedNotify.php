<?php
/**
 * Auto generated from PB_server_common.proto at 2017-12-06 14:11:24
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ServerClosedNotify message
 */
class PBS_ServerClosedNotify extends \ProtobufMessage
{
    /* Field index constants */
    const SERVERID = 1;
    const STYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SERVERID => array(
            'name' => 'serverid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STYPE => array(
            'name' => 'stype',
            'required' => true,
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
        $this->values[self::STYPE] = null;
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
     * Sets value of 'stype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStype($value)
    {
        return $this->set(self::STYPE, $value);
    }

    /**
     * Returns value of 'stype' property
     *
     * @return integer
     */
    public function getStype()
    {
        $value = $this->get(self::STYPE);
        return $value === null ? (integer)$value : $value;
    }
}
}