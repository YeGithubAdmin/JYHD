<?php
/**
 * Auto generated from PB_event.proto at 2018-02-01 10:23:59
 */

namespace {
/**
 * PayInfoUpdate message
 */
class PayInfoUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const DAY1_PAY = 1;
    const DAY3_PAY = 2;
    const DAY7_PAY = 3;
    const DAY30_PAY = 4;
    const PLAYERID = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DAY1_PAY => array(
            'name' => 'day1_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAY3_PAY => array(
            'name' => 'day3_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAY7_PAY => array(
            'name' => 'day7_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAY30_PAY => array(
            'name' => 'day30_pay',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PLAYERID => array(
            'name' => 'playerid',
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
        $this->values[self::DAY1_PAY] = null;
        $this->values[self::DAY3_PAY] = null;
        $this->values[self::DAY7_PAY] = null;
        $this->values[self::DAY30_PAY] = null;
        $this->values[self::PLAYERID] = null;
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
     * Sets value of 'day1_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay1Pay($value)
    {
        return $this->set(self::DAY1_PAY, $value);
    }

    /**
     * Returns value of 'day1_pay' property
     *
     * @return integer
     */
    public function getDay1Pay()
    {
        $value = $this->get(self::DAY1_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'day3_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay3Pay($value)
    {
        return $this->set(self::DAY3_PAY, $value);
    }

    /**
     * Returns value of 'day3_pay' property
     *
     * @return integer
     */
    public function getDay3Pay()
    {
        $value = $this->get(self::DAY3_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'day7_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay7Pay($value)
    {
        return $this->set(self::DAY7_PAY, $value);
    }

    /**
     * Returns value of 'day7_pay' property
     *
     * @return integer
     */
    public function getDay7Pay()
    {
        $value = $this->get(self::DAY7_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'day30_pay' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDay30Pay($value)
    {
        return $this->set(self::DAY30_PAY, $value);
    }

    /**
     * Returns value of 'day30_pay' property
     *
     * @return integer
     */
    public function getDay30Pay()
    {
        $value = $this->get(self::DAY30_PAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'playerid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPlayerid($value)
    {
        return $this->set(self::PLAYERID, $value);
    }

    /**
     * Returns value of 'playerid' property
     *
     * @return integer
     */
    public function getPlayerid()
    {
        $value = $this->get(self::PLAYERID);
        return $value === null ? (integer)$value : $value;
    }
}
}