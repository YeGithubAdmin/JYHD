<?php
/**
 * Auto generated from PB_statistics_data.proto at 2018-02-06 16:55:50
 */

namespace {
/**
 * RPB_HhmfNumerical message
 */
class RPB_HhmfNumerical extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_PLAYER_NUM = 1;
    const PLAYER_JOIN_NUM = 2;
    const TOTAL_ONLINE_TIME = 3;
    const PRODUCE_GOLD = 4;
    const CONSUME_GOLD = 5;
    const TOTAL_WIN = 6;
    const ROBOT_BANKER_WIN = 7;
    const ROBOT_PLAYER_WIN = 8;
    const BET_TIMES = 9;
    const ROOM_LEVEL = 22;
    const UPDATE_TIME = 23;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_PLAYER_NUM => array(
            'name' => 'cur_player_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYER_JOIN_NUM => array(
            'name' => 'player_join_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TOTAL_ONLINE_TIME => array(
            'name' => 'total_online_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_GOLD => array(
            'name' => 'produce_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CONSUME_GOLD => array(
            'name' => 'consume_gold',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TOTAL_WIN => array(
            'name' => 'total_win',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROBOT_BANKER_WIN => array(
            'name' => 'robot_banker_win',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROBOT_PLAYER_WIN => array(
            'name' => 'robot_player_win',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BET_TIMES => array(
            'name' => 'bet_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ROOM_LEVEL => array(
            'name' => 'room_level',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UPDATE_TIME => array(
            'name' => 'update_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::CUR_PLAYER_NUM] = null;
        $this->values[self::PLAYER_JOIN_NUM] = null;
        $this->values[self::TOTAL_ONLINE_TIME] = null;
        $this->values[self::PRODUCE_GOLD] = null;
        $this->values[self::CONSUME_GOLD] = null;
        $this->values[self::TOTAL_WIN] = null;
        $this->values[self::ROBOT_BANKER_WIN] = null;
        $this->values[self::ROBOT_PLAYER_WIN] = null;
        $this->values[self::BET_TIMES] = null;
        $this->values[self::ROOM_LEVEL] = null;
        $this->values[self::UPDATE_TIME] = null;
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
     * Sets value of 'cur_player_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurPlayerNum($value)
    {
        return $this->set(self::CUR_PLAYER_NUM, $value);
    }

    /**
     * Returns value of 'cur_player_num' property
     *
     * @return integer
     */
    public function getCurPlayerNum()
    {
        $value = $this->get(self::CUR_PLAYER_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'player_join_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerJoinNum($value)
    {
        return $this->set(self::PLAYER_JOIN_NUM, $value);
    }

    /**
     * Returns value of 'player_join_num' property
     *
     * @return integer
     */
    public function getPlayerJoinNum()
    {
        $value = $this->get(self::PLAYER_JOIN_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'total_online_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTotalOnlineTime($value)
    {
        return $this->set(self::TOTAL_ONLINE_TIME, $value);
    }

    /**
     * Returns value of 'total_online_time' property
     *
     * @return integer
     */
    public function getTotalOnlineTime()
    {
        $value = $this->get(self::TOTAL_ONLINE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceGold($value)
    {
        return $this->set(self::PRODUCE_GOLD, $value);
    }

    /**
     * Returns value of 'produce_gold' property
     *
     * @return integer
     */
    public function getProduceGold()
    {
        $value = $this->get(self::PRODUCE_GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'consume_gold' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setConsumeGold($value)
    {
        return $this->set(self::CONSUME_GOLD, $value);
    }

    /**
     * Returns value of 'consume_gold' property
     *
     * @return integer
     */
    public function getConsumeGold()
    {
        $value = $this->get(self::CONSUME_GOLD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'total_win' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTotalWin($value)
    {
        return $this->set(self::TOTAL_WIN, $value);
    }

    /**
     * Returns value of 'total_win' property
     *
     * @return integer
     */
    public function getTotalWin()
    {
        $value = $this->get(self::TOTAL_WIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'robot_banker_win' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRobotBankerWin($value)
    {
        return $this->set(self::ROBOT_BANKER_WIN, $value);
    }

    /**
     * Returns value of 'robot_banker_win' property
     *
     * @return integer
     */
    public function getRobotBankerWin()
    {
        $value = $this->get(self::ROBOT_BANKER_WIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'robot_player_win' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRobotPlayerWin($value)
    {
        return $this->set(self::ROBOT_PLAYER_WIN, $value);
    }

    /**
     * Returns value of 'robot_player_win' property
     *
     * @return integer
     */
    public function getRobotPlayerWin()
    {
        $value = $this->get(self::ROBOT_PLAYER_WIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bet_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBetTimes($value)
    {
        return $this->set(self::BET_TIMES, $value);
    }

    /**
     * Returns value of 'bet_times' property
     *
     * @return integer
     */
    public function getBetTimes()
    {
        $value = $this->get(self::BET_TIMES);
        return $value === null ? (integer)$value : $value;
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

    /**
     * Sets value of 'update_time' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUpdateTime($value)
    {
        return $this->set(self::UPDATE_TIME, $value);
    }

    /**
     * Returns value of 'update_time' property
     *
     * @return string
     */
    public function getUpdateTime()
    {
        $value = $this->get(self::UPDATE_TIME);
        return $value === null ? (string)$value : $value;
    }
}
}