<?php
/**
 * Auto generated from PB_numerical.proto at 2017-11-22 14:55:06
 */

namespace {
/**
 * PB_m2g_refresh message
 */
class PB_m2g_refresh extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_AWARD_POOL = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
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
        $this->values[self::BOSS_AWARD_POOL] = null;
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
     * Sets value of 'boss_award_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossAwardPool($value)
    {
        return $this->set(self::BOSS_AWARD_POOL, $value);
    }

    /**
     * Returns value of 'boss_award_pool' property
     *
     * @return integer
     */
    public function getBossAwardPool()
    {
        $value = $this->get(self::BOSS_AWARD_POOL);
        return $value === null ? (integer)$value : $value;
    }
}
}