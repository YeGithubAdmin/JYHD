<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-12-26 10:53:15
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_SysBroadcast message
 */
class PBS_SysBroadcast extends \ProtobufMessage
{
    /* Field index constants */
    const PHP_BC = 1;
    const CHANNEL = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PHP_BC => array(
            'name' => 'php_bc',
            'required' => false,
            'type' => '\PB_PhpBroadcast'
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
        $this->values[self::PHP_BC] = null;
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
     * Sets value of 'php_bc' property
     *
     * @param \PB_PhpBroadcast $value Property value
     *
     * @return null
     */
    public function setPhpBc(\PB_PhpBroadcast $value=null)
    {
        return $this->set(self::PHP_BC, $value);
    }

    /**
     * Returns value of 'php_bc' property
     *
     * @return \PB_PhpBroadcast
     */
    public function getPhpBc()
    {
        return $this->get(self::PHP_BC);
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