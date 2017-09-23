<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-09-22 17:44:56
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

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STATE => array(
            'name' => 'state',
            'required' => true,
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
}
}