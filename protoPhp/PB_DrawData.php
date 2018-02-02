<?php
/**
 * Auto generated from PB_base_data.proto at 2018-02-01 10:24:00
 */

namespace {
/**
 * PB_DrawData message
 */
class PB_DrawData extends \ProtobufMessage
{
    /* Field index constants */
    const ZHUANPAN_TYPE = 1;
    const KILL_BOSS = 2;
    const KILL_BOSS_COND = 3;
    const SCORE = 4;
    const DRAW_STATE = 5;
    const SCORE_MAX = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ZHUANPAN_TYPE => array(
            'name' => 'zhuanpan_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::KILL_BOSS => array(
            'name' => 'kill_boss',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::KILL_BOSS_COND => array(
            'name' => 'kill_boss_cond',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE => array(
            'name' => 'score',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DRAW_STATE => array(
            'name' => 'draw_state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::SCORE_MAX => array(
            'name' => 'score_max',
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
        $this->values[self::ZHUANPAN_TYPE] = null;
        $this->values[self::KILL_BOSS] = null;
        $this->values[self::KILL_BOSS_COND] = null;
        $this->values[self::SCORE] = null;
        $this->values[self::DRAW_STATE] = null;
        $this->values[self::SCORE_MAX] = null;
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
     * Sets value of 'zhuanpan_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setZhuanpanType($value)
    {
        return $this->set(self::ZHUANPAN_TYPE, $value);
    }

    /**
     * Returns value of 'zhuanpan_type' property
     *
     * @return integer
     */
    public function getZhuanpanType()
    {
        $value = $this->get(self::ZHUANPAN_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'kill_boss' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setKillBoss($value)
    {
        return $this->set(self::KILL_BOSS, $value);
    }

    /**
     * Returns value of 'kill_boss' property
     *
     * @return integer
     */
    public function getKillBoss()
    {
        $value = $this->get(self::KILL_BOSS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'kill_boss_cond' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setKillBossCond($value)
    {
        return $this->set(self::KILL_BOSS_COND, $value);
    }

    /**
     * Returns value of 'kill_boss_cond' property
     *
     * @return integer
     */
    public function getKillBossCond()
    {
        $value = $this->get(self::KILL_BOSS_COND);
        return $value === null ? (integer)$value : $value;
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

    /**
     * Sets value of 'draw_state' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setDrawState($value)
    {
        return $this->set(self::DRAW_STATE, $value);
    }

    /**
     * Returns value of 'draw_state' property
     *
     * @return boolean
     */
    public function getDrawState()
    {
        $value = $this->get(self::DRAW_STATE);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'score_max' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScoreMax($value)
    {
        return $this->set(self::SCORE_MAX, $value);
    }

    /**
     * Returns value of 'score_max' property
     *
     * @return integer
     */
    public function getScoreMax()
    {
        $value = $this->get(self::SCORE_MAX);
        return $value === null ? (integer)$value : $value;
    }
}
}