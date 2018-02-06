<?php
/**
 * Auto generated from PB_event.proto at 2018-02-06 16:55:49
 */

namespace {
/**
 * GunUnlockEvent message
 */
class GunUnlockEvent extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_GUN = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_GUN => array(
            'name' => 'cur_gun',
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
        $this->values[self::CUR_GUN] = null;
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
     * Sets value of 'cur_gun' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurGun($value)
    {
        return $this->set(self::CUR_GUN, $value);
    }

    /**
     * Returns value of 'cur_gun' property
     *
     * @return integer
     */
    public function getCurGun()
    {
        $value = $this->get(self::CUR_GUN);
        return $value === null ? (integer)$value : $value;
    }
}
}