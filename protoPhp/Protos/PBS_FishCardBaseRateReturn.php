<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2017-12-26 10:53:15
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_FishCardBaseRateReturn message
 */
class PBS_FishCardBaseRateReturn extends \ProtobufMessage
{
    /* Field index constants */
    const RATE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RATE => array(
            'name' => 'rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
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
        $this->values[self::RATE] = null;
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
     * Sets value of 'rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setRate($value)
    {
        return $this->set(self::RATE, $value);
    }

    /**
     * Returns value of 'rate' property
     *
     * @return double
     */
    public function getRate()
    {
        $value = $this->get(self::RATE);
        return $value === null ? (double)$value : $value;
    }
}
}