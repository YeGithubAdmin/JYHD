<?php
/**
 * Auto generated from PB_notify.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * PB_Shutdown message
 */
class PB_Shutdown extends \ProtobufMessage
{
    /* Field index constants */
    const DESC = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DESC => array(
            'name' => 'desc',
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
        $this->values[self::DESC] = null;
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
     * Sets value of 'desc' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDesc($value)
    {
        return $this->set(self::DESC, $value);
    }

    /**
     * Returns value of 'desc' property
     *
     * @return string
     */
    public function getDesc()
    {
        $value = $this->get(self::DESC);
        return $value === null ? (string)$value : $value;
    }
}
}