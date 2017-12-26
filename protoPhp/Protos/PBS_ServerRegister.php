<?php
/**
 * Auto generated from PB_server_common.proto at 2017-12-26 10:53:15
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ServerRegister message
 */
class PBS_ServerRegister extends \ProtobufMessage
{
    /* Field index constants */
    const SERVERID = 1;
    const TYPE = 2;
    const GAMETYPE = 3;
    const MSGID_LOWER_BOUND = 4;
    const MSGID_UPPER_BOUND = 5;
    const RP = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SERVERID => array(
            'name' => 'serverid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAMETYPE => array(
            'name' => 'gametype',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MSGID_LOWER_BOUND => array(
            'name' => 'msgid_lower_bound',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MSGID_UPPER_BOUND => array(
            'name' => 'msgid_upper_bound',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RP => array(
            'name' => 'rp',
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
        $this->values[self::TYPE] = null;
        $this->values[self::GAMETYPE] = null;
        $this->values[self::MSGID_LOWER_BOUND] = null;
        $this->values[self::MSGID_UPPER_BOUND] = null;
        $this->values[self::RP] = null;
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
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gametype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGametype($value)
    {
        return $this->set(self::GAMETYPE, $value);
    }

    /**
     * Returns value of 'gametype' property
     *
     * @return integer
     */
    public function getGametype()
    {
        $value = $this->get(self::GAMETYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'msgid_lower_bound' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMsgidLowerBound($value)
    {
        return $this->set(self::MSGID_LOWER_BOUND, $value);
    }

    /**
     * Returns value of 'msgid_lower_bound' property
     *
     * @return integer
     */
    public function getMsgidLowerBound()
    {
        $value = $this->get(self::MSGID_LOWER_BOUND);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'msgid_upper_bound' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMsgidUpperBound($value)
    {
        return $this->set(self::MSGID_UPPER_BOUND, $value);
    }

    /**
     * Returns value of 'msgid_upper_bound' property
     *
     * @return integer
     */
    public function getMsgidUpperBound()
    {
        $value = $this->get(self::MSGID_UPPER_BOUND);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'rp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRp($value)
    {
        return $this->set(self::RP, $value);
    }

    /**
     * Returns value of 'rp' property
     *
     * @return integer
     */
    public function getRp()
    {
        $value = $this->get(self::RP);
        return $value === null ? (integer)$value : $value;
    }
}
}