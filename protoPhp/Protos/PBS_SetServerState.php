<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-10-25 14:57:35
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
}
}