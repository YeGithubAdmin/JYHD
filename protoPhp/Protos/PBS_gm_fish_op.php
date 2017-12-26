<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-12-26 10:53:15
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_gm_fish_op message
 */
class PBS_gm_fish_op extends \ProtobufMessage
{
    /* Field index constants */
    const KEY = 1;
    const VALUE = 2;
    const SERVERID = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::KEY => array(
            'name' => 'key',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::VALUE => array(
            'name' => 'value',
            'required' => true,
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
        $this->values[self::KEY] = null;
        $this->values[self::VALUE] = null;
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
     * Sets value of 'key' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setKey($value)
    {
        return $this->set(self::KEY, $value);
    }

    /**
     * Returns value of 'key' property
     *
     * @return string
     */
    public function getKey()
    {
        $value = $this->get(self::KEY);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'value' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setValue($value)
    {
        return $this->set(self::VALUE, $value);
    }

    /**
     * Returns value of 'value' property
     *
     * @return integer
     */
    public function getValue()
    {
        $value = $this->get(self::VALUE);
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