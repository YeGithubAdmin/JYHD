<?php
/**
 * Auto generated from PB_event.proto at 2017-09-28 20:15:00
 */

namespace {
/**
 * PayGoldUpdate message
 */
class PayGoldUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const INC_GOLD = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::INC_GOLD => array(
            'name' => 'inc_gold',
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
        $this->values[self::INC_GOLD] = null;
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
     * Sets value of 'inc_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIncGold($value)
    {
        return $this->set(self::INC_GOLD, $value);
    }

    /**
     * Returns value of 'inc_gold' property
     *
     * @return integer
     */
    public function getIncGold()
    {
        $value = $this->get(self::INC_GOLD);
        return $value === null ? (integer)$value : $value;
    }
}
}