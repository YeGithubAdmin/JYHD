<?php
/**
 * Auto generated from PB_event.proto at 2018-02-01 10:23:59
 */

namespace {
/**
 * KillBossFishEvent message
 */
class KillBossFishEvent extends \ProtobufMessage
{
    /* Field index constants */
    const SCORE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SCORE => array(
            'name' => 'score',
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
        $this->values[self::SCORE] = null;
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
     * Sets value of 'score' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore($value)
    {
        return $this->set(self::SCORE, $value);
    }

    /**
     * Returns value of 'score' property
     *
     * @return integer
     */
    public function getScore()
    {
        $value = $this->get(self::SCORE);
        return $value === null ? (integer)$value : $value;
    }
}
}