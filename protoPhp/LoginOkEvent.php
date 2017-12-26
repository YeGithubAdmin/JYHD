<?php
/**
 * Auto generated from PB_event.proto at 2017-12-26 10:10:52
 */

namespace {
/**
 * LoginOkEvent message
 */
class LoginOkEvent extends \ProtobufMessage
{
    /* Field index constants */
    const RMB = 1;
    const NAME = 2;
    const CHANNEL = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RMB => array(
            'name' => 'rmb',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::RMB] = null;
        $this->values[self::NAME] = null;
        $this->values[self::CHANNEL] = null;
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
     * Sets value of 'rmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmb($value)
    {
        return $this->set(self::RMB, $value);
    }

    /**
     * Returns value of 'rmb' property
     *
     * @return integer
     */
    public function getRmb()
    {
        $value = $this->get(self::RMB);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
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
}
}