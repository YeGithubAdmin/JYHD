<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-02-06 16:55:50
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
    const BOSS_NUMERICAL_SET = 4;
    const BOSS_NUMERICAL_INCR = 5;
    const HHMF_NUMERICAL_SET = 6;
    const HHMF_NUMERICAL_INCR = 7;
    const ROOM_LEVEL = 10;

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
        self::BOSS_NUMERICAL_SET => array(
            'name' => 'boss_numerical_set',
            'required' => false,
            'type' => '\RPB_BossNumerical'
        ),
        self::BOSS_NUMERICAL_INCR => array(
            'name' => 'boss_numerical_incr',
            'required' => false,
            'type' => '\RPB_BossNumerical'
        ),
        self::HHMF_NUMERICAL_SET => array(
            'name' => 'hhmf_numerical_set',
            'required' => false,
            'type' => '\RPB_HhmfNumerical'
        ),
        self::HHMF_NUMERICAL_INCR => array(
            'name' => 'hhmf_numerical_incr',
            'required' => false,
            'type' => '\RPB_HhmfNumerical'
        ),
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
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
        $this->values[self::GAME_NUMERICAL_GET] = null;
        $this->values[self::GAME_NUMERICAL_SET] = null;
        $this->values[self::GAME_NUMERICAL_INCR] = null;
        $this->values[self::BOSS_NUMERICAL_SET] = null;
        $this->values[self::BOSS_NUMERICAL_INCR] = null;
        $this->values[self::HHMF_NUMERICAL_SET] = null;
        $this->values[self::HHMF_NUMERICAL_INCR] = null;
        $this->values[self::ROOM_LEVEL] = null;
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

    /**
     * Sets value of 'boss_numerical_set' property
     *
     * @param \RPB_BossNumerical $value Property value
     *
     * @return null
     */
    public function setBossNumericalSet(\RPB_BossNumerical $value=null)
    {
        return $this->set(self::BOSS_NUMERICAL_SET, $value);
    }

    /**
     * Returns value of 'boss_numerical_set' property
     *
     * @return \RPB_BossNumerical
     */
    public function getBossNumericalSet()
    {
        return $this->get(self::BOSS_NUMERICAL_SET);
    }

    /**
     * Sets value of 'boss_numerical_incr' property
     *
     * @param \RPB_BossNumerical $value Property value
     *
     * @return null
     */
    public function setBossNumericalIncr(\RPB_BossNumerical $value=null)
    {
        return $this->set(self::BOSS_NUMERICAL_INCR, $value);
    }

    /**
     * Returns value of 'boss_numerical_incr' property
     *
     * @return \RPB_BossNumerical
     */
    public function getBossNumericalIncr()
    {
        return $this->get(self::BOSS_NUMERICAL_INCR);
    }

    /**
     * Sets value of 'hhmf_numerical_set' property
     *
     * @param \RPB_HhmfNumerical $value Property value
     *
     * @return null
     */
    public function setHhmfNumericalSet(\RPB_HhmfNumerical $value=null)
    {
        return $this->set(self::HHMF_NUMERICAL_SET, $value);
    }

    /**
     * Returns value of 'hhmf_numerical_set' property
     *
     * @return \RPB_HhmfNumerical
     */
    public function getHhmfNumericalSet()
    {
        return $this->get(self::HHMF_NUMERICAL_SET);
    }

    /**
     * Sets value of 'hhmf_numerical_incr' property
     *
     * @param \RPB_HhmfNumerical $value Property value
     *
     * @return null
     */
    public function setHhmfNumericalIncr(\RPB_HhmfNumerical $value=null)
    {
        return $this->set(self::HHMF_NUMERICAL_INCR, $value);
    }

    /**
     * Returns value of 'hhmf_numerical_incr' property
     *
     * @return \RPB_HhmfNumerical
     */
    public function getHhmfNumericalIncr()
    {
        return $this->get(self::HHMF_NUMERICAL_INCR);
    }

    /**
     * Sets value of 'room_level' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRoomLevel($value)
    {
        return $this->set(self::ROOM_LEVEL, $value);
    }

    /**
     * Returns value of 'room_level' property
     *
     * @return integer
     */
    public function getRoomLevel()
    {
        $value = $this->get(self::ROOM_LEVEL);
        return $value === null ? (integer)$value : $value;
    }
}
}