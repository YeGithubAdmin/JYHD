<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-12-06 14:11:23
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_SetServerState message
 */
class PBS_SetServerState extends \ProtobufMessage
{
    /* Field index constants */
    const STATE = 1;
    const CHANNEL = 2;
    const AFTER_SECOND = 3;
    const SERVERID = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STATE => array(
            'name' => 'state',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::AFTER_SECOND => array(
            'name' => 'after_second',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SERVERID => array(
            'name' => 'serverid',
            'repeated' => true,
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
        $this->values[self::STATE] = null;
        $this->values[self::CHANNEL] = null;
        $this->values[self::AFTER_SECOND] = null;
        $this->values[self::SERVERID] = array();
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
     * Sets value of 'state' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setState($value)
    {
        return $this->set(self::STATE, $value);
    }

    /**
     * Returns value of 'state' property
     *
     * @return integer
     */
    public function getState()
    {
        $value = $this->get(self::STATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'channel' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setChannel($value)
    {
        return $this->set(self::CHANNEL, $value);
    }

    /**
     * Returns value of 'channel' property
     *
     * @return string
     */
    public function getChannel()
    {
        $value = $this->get(self::CHANNEL);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'after_second' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAfterSecond($value)
    {
        return $this->set(self::AFTER_SECOND, $value);
    }

    /**
     * Returns value of 'after_second' property
     *
     * @return integer
     */
    public function getAfterSecond()
    {
        $value = $this->get(self::AFTER_SECOND);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'serverid' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendServerid($value)
    {
        return $this->append(self::SERVERID, $value);
    }

    /**
     * Clears 'serverid' list
     *
     * @return null
     */
    public function clearServerid()
    {
        return $this->clear(self::SERVERID);
    }

    /**
     * Returns 'serverid' list
     *
     * @return integer[]
     */
    public function getServerid()
    {
        return $this->get(self::SERVERID);
    }

    /**
     * Returns 'serverid' iterator
     *
     * @return \ArrayIterator
     */
    public function getServeridIterator()
    {
        return new \ArrayIterator($this->get(self::SERVERID));
    }

    /**
     * Returns element from 'serverid' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getServeridAt($offset)
    {
        return $this->get(self::SERVERID, $offset);
    }

    /**
     * Returns count of 'serverid' list
     *
     * @return int
     */
    public function getServeridCount()
    {
        return $this->count(self::SERVERID);
    }
}
}