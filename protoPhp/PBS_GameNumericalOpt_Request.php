<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-10-30 16:45:18
 */

namespace {
/**
 * Request message embedded in PBS_GameNumericalOpt message
 */
class PBS_GameNumericalOpt_Request extends \ProtobufMessage
{
    /* Field index constants */
    const GAME_NUMERICAL_GET = 1;
    const GAME_NUMERICAL_SET = 2;
    const GAME_NUMERICAL_INCR = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GAME_NUMERICAL_GET => array(
            'name' => 'game_numerical_get',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAME_NUMERICAL_SET => array(
            'name' => 'game_numerical_set',
            'required' => false,
            'type' => '\RPB_GameNumerical'
        ),
        self::GAME_NUMERICAL_INCR => array(
            'name' => 'game_numerical_incr',
            'required' => false,
            'type' => '\RPB_GameNumerical'
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
        $this->values[self::GAME_NUMERICAL_GET] = null;
        $this->values[self::GAME_NUMERICAL_SET] = null;
        $this->values[self::GAME_NUMERICAL_INCR] = null;
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
     * Sets value of 'game_numerical_get' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGameNumericalGet($value)
    {
        return $this->set(self::GAME_NUMERICAL_GET, $value);
    }

    /**
     * Returns value of 'game_numerical_get' property
     *
     * @return integer
     */
    public function getGameNumericalGet()
    {
        $value = $this->get(self::GAME_NUMERICAL_GET);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'game_numerical_set' property
     *
     * @param \RPB_GameNumerical $value Property value
     *
     * @return null
     */
    public function setGameNumericalSet(\RPB_GameNumerical $value=null)
    {
        return $this->set(self::GAME_NUMERICAL_SET, $value);
    }

    /**
     * Returns value of 'game_numerical_set' property
     *
     * @return \RPB_GameNumerical
     */
    public function getGameNumericalSet()
    {
        return $this->get(self::GAME_NUMERICAL_SET);
    }

    /**
     * Sets value of 'game_numerical_incr' property
     *
     * @param \RPB_GameNumerical $value Property value
     *
     * @return null
     */
    public function setGameNumericalIncr(\RPB_GameNumerical $value=null)
    {
        return $this->set(self::GAME_NUMERICAL_INCR, $value);
    }

    /**
     * Returns value of 'game_numerical_incr' property
     *
     * @return \RPB_GameNumerical
     */
    public function getGameNumericalIncr()
    {
        return $this->get(self::GAME_NUMERICAL_INCR);
    }
}
}