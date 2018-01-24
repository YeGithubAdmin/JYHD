<?php
/**
 * Auto generated from PB_numerical.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * PB_m2g_dump message
 */
class PB_m2g_dump extends \ProtobufMessage
{
    /* Field index constants */
    const INFO = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INFO => array(
            'name' => 'info',
            'required' => true,
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
        $this->values[self::INFO] = null;
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
     * Sets value of 'info' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setInfo($value)
    {
        return $this->set(self::INFO, $value);
    }

    /**
     * Returns value of 'info' property
     *
     * @return string
     */
    public function getInfo()
    {
        $value = $this->get(self::INFO);
        return $value === null ? (string)$value : $value;
    }
}
}