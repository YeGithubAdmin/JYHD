<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-28 20:15:01
 */

namespace {
/**
 * PB_OnlineRewardTask message
 */
class PB_OnlineRewardTask extends \ProtobufMessage
{
    /* Field index constants */
    const TASKID = 1;
    const OVER_TIME = 2;
    const ISFINISH = 3;
    const START_TIME = 4;
    const BK_COUNT = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::TASKID => array(
            'name' => 'taskid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::OVER_TIME => array(
            'name' => 'over_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ISFINISH => array(
            'name' => 'isfinish',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::START_TIME => array(
            'name' => 'start_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BK_COUNT => array(
            'name' => 'bk_count',
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
        $this->values[self::TASKID] = null;
        $this->values[self::OVER_TIME] = null;
        $this->values[self::ISFINISH] = null;
        $this->values[self::START_TIME] = null;
        $this->values[self::BK_COUNT] = null;
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
     * Sets value of 'taskid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTaskid($value)
    {
        return $this->set(self::TASKID, $value);
    }

    /**
     * Returns value of 'taskid' property
     *
     * @return integer
     */
    public function getTaskid()
    {
        $value = $this->get(self::TASKID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'over_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOverTime($value)
    {
        return $this->set(self::OVER_TIME, $value);
    }

    /**
     * Returns value of 'over_time' property
     *
     * @return integer
     */
    public function getOverTime()
    {
        $value = $this->get(self::OVER_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'isfinish' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsfinish($value)
    {
        return $this->set(self::ISFINISH, $value);
    }

    /**
     * Returns value of 'isfinish' property
     *
     * @return boolean
     */
    public function getIsfinish()
    {
        $value = $this->get(self::ISFINISH);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'start_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStartTime($value)
    {
        return $this->set(self::START_TIME, $value);
    }

    /**
     * Returns value of 'start_time' property
     *
     * @return integer
     */
    public function getStartTime()
    {
        $value = $this->get(self::START_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'bk_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBkCount($value)
    {
        return $this->set(self::BK_COUNT, $value);
    }

    /**
     * Returns value of 'bk_count' property
     *
     * @return integer
     */
    public function getBkCount()
    {
        $value = $this->get(self::BK_COUNT);
        return $value === null ? (integer)$value : $value;
    }
}
}