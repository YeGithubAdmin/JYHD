<?php
/**
 * Auto generated from PB_numerical.proto at 2017-11-22 14:55:06
 */

namespace {
/**
 * PB_g2m_fish_card_update message
 */
class PB_g2m_fish_card_update extends \ProtobufMessage
{
    /* Field index constants */
    const POOL = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::POOL => array(
            'name' => 'pool',
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
        $this->values[self::POOL] = null;
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
     * Sets value of 'pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPool($value)
    {
        return $this->set(self::POOL, $value);
    }

    /**
     * Returns value of 'pool' property
     *
     * @return integer
     */
    public function getPool()
    {
        $value = $this->get(self::POOL);
        return $value === null ? (integer)$value : $value;
    }
}
}