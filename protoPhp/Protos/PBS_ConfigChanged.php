<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-24 16:26:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ConfigChanged message
 */
class PBS_ConfigChanged extends \ProtobufMessage
{
    /* Field index constants */
    const CHANNEL = 1;
    const CFG_TYPE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CFG_TYPE => array(
            'name' => 'cfg_type',
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
        $this->values[self::CHANNEL] = null;
        $this->values[self::CFG_TYPE] = null;
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
     * Sets value of 'cfg_type' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCfgType($value)
    {
        return $this->set(self::CFG_TYPE, $value);
    }

    /**
     * Returns value of 'cfg_type' property
     *
     * @return string
     */
    public function getCfgType()
    {
        $value = $this->get(self::CFG_TYPE);
        return $value === null ? (string)$value : $value;
    }
}
}