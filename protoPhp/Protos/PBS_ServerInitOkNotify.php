<?php
/**
 * Auto generated from PB_server_common.proto at 2017-09-28 20:15:01
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ServerInitOkNotify message
 */
class PBS_ServerInitOkNotify extends \ProtobufMessage
{
    /* Field index constants */
    const STYPE = 1;
    const CFG = 2;
    const TID_MIN = 3;
    const TID_MAX = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STYPE => array(
            'name' => 'stype',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CFG => array(
            'name' => 'cfg',
            'required' => false,
            'type' => '\PB_GameConfig'
        ),
        self::TID_MIN => array(
            'name' => 'tid_min',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TID_MAX => array(
            'name' => 'tid_max',
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
        $this->values[self::STYPE] = null;
        $this->values[self::CFG] = null;
        $this->values[self::TID_MIN] = null;
        $this->values[self::TID_MAX] = null;
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
     * Sets value of 'stype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStype($value)
    {
        return $this->set(self::STYPE, $value);
    }

    /**
     * Returns value of 'stype' property
     *
     * @return integer
     */
    public function getStype()
    {
        $value = $this->get(self::STYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'cfg' property
     *
     * @param \PB_GameConfig $value Property value
     *
     * @return null
     */
    public function setCfg(\PB_GameConfig $value=null)
    {
        return $this->set(self::CFG, $value);
    }

    /**
     * Returns value of 'cfg' property
     *
     * @return \PB_GameConfig
     */
    public function getCfg()
    {
        return $this->get(self::CFG);
    }

    /**
     * Sets value of 'tid_min' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTidMin($value)
    {
        return $this->set(self::TID_MIN, $value);
    }

    /**
     * Returns value of 'tid_min' property
     *
     * @return integer
     */
    public function getTidMin()
    {
        $value = $this->get(self::TID_MIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'tid_max' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTidMax($value)
    {
        return $this->set(self::TID_MAX, $value);
    }

    /**
     * Returns value of 'tid_max' property
     *
     * @return integer
     */
    public function getTidMax()
    {
        $value = $this->get(self::TID_MAX);
        return $value === null ? (integer)$value : $value;
    }
}
}