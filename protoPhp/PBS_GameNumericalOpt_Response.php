<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-01-02 15:38:42
 */

namespace {
/**
 * Response message embedded in PBS_GameNumericalOpt message
 */
class PBS_GameNumericalOpt_Response extends \ProtobufMessage
{
    /* Field index constants */
    const CODE = 1;
    const GAME_NUMERICAL = 2;
    const BOSS_NUMERICAL = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CODE => array(
            'name' => 'code',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAME_NUMERICAL => array(
            'name' => 'game_numerical',
            'required' => false,
            'type' => '\RPB_GameNumerical'
        ),
        self::BOSS_NUMERICAL => array(
            'name' => 'boss_numerical',
            'required' => false,
            'type' => '\RPB_BossNumerical'
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
        $this->values[self::CODE] = null;
        $this->values[self::GAME_NUMERICAL] = null;
        $this->values[self::BOSS_NUMERICAL] = null;
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
     * Sets value of 'code' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCode($value)
    {
        return $this->set(self::CODE, $value);
    }

    /**
     * Returns value of 'code' property
     *
     * @return integer
     */
    public function getCode()
    {
        $value = $this->get(self::CODE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'game_numerical' property
     *
     * @param \RPB_GameNumerical $value Property value
     *
     * @return null
     */
    public function setGameNumerical(\RPB_GameNumerical $value=null)
    {
        return $this->set(self::GAME_NUMERICAL, $value);
    }

    /**
     * Returns value of 'game_numerical' property
     *
     * @return \RPB_GameNumerical
     */
    public function getGameNumerical()
    {
        return $this->get(self::GAME_NUMERICAL);
    }

    /**
     * Sets value of 'boss_numerical' property
     *
     * @param \RPB_BossNumerical $value Property value
     *
     * @return null
     */
    public function setBossNumerical(\RPB_BossNumerical $value=null)
    {
        return $this->set(self::BOSS_NUMERICAL, $value);
    }

    /**
     * Returns value of 'boss_numerical' property
     *
     * @return \RPB_BossNumerical
     */
    public function getBossNumerical()
    {
        return $this->get(self::BOSS_NUMERICAL);
    }
}
}