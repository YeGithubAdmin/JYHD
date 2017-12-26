<?php
/**
 * Auto generated from PB_notify.proto at 2017-12-26 10:10:52
 */

namespace {
/**
 * PB_ConfigUpdate message
 */
class PB_ConfigUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const CFG_TYPE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
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