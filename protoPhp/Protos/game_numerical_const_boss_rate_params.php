<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-02 15:38:42
 *
 * protos package
 */

namespace Protos {
/**
 * const_boss_rate_params message embedded in game_numerical message
 */
class game_numerical_const_boss_rate_params extends \ProtobufMessage
{
    /* Field index constants */
    const BOSS_ID = 1;
    const STAGE = 2;
    const CRRT_PARAM = 3;
    const CU_RATE = 4;
    const AG_RATE = 5;
    const AU_RATE = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BOSS_ID => array(
            'name' => 'boss_id',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STAGE => array(
            'name' => 'stage',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CRRT_PARAM => array(
            'name' => 'crrt_param',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::CU_RATE => array(
            'name' => 'cu_rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::AG_RATE => array(
            'name' => 'ag_rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::AU_RATE => array(
            'name' => 'au_rate',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
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
        $this->values[self::BOSS_ID] = null;
        $this->values[self::STAGE] = null;
        $this->values[self::CRRT_PARAM] = null;
        $this->values[self::CU_RATE] = null;
        $this->values[self::AG_RATE] = null;
        $this->values[self::AU_RATE] = null;
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
     * Sets value of 'boss_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossId($value)
    {
        return $this->set(self::BOSS_ID, $value);
    }

    /**
     * Returns value of 'boss_id' property
     *
     * @return integer
     */
    public function getBossId()
    {
        $value = $this->get(self::BOSS_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'stage' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStage($value)
    {
        return $this->set(self::STAGE, $value);
    }

    /**
     * Returns value of 'stage' property
     *
     * @return integer
     */
    public function getStage()
    {
        $value = $this->get(self::STAGE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'crrt_param' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setCrrtParam($value)
    {
        return $this->set(self::CRRT_PARAM, $value);
    }

    /**
     * Returns value of 'crrt_param' property
     *
     * @return double
     */
    public function getCrrtParam()
    {
        $value = $this->get(self::CRRT_PARAM);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'cu_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setCuRate($value)
    {
        return $this->set(self::CU_RATE, $value);
    }

    /**
     * Returns value of 'cu_rate' property
     *
     * @return double
     */
    public function getCuRate()
    {
        $value = $this->get(self::CU_RATE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'ag_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setAgRate($value)
    {
        return $this->set(self::AG_RATE, $value);
    }

    /**
     * Returns value of 'ag_rate' property
     *
     * @return double
     */
    public function getAgRate()
    {
        $value = $this->get(self::AG_RATE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'au_rate' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setAuRate($value)
    {
        return $this->set(self::AU_RATE, $value);
    }

    /**
     * Returns value of 'au_rate' property
     *
     * @return double
     */
    public function getAuRate()
    {
        $value = $this->get(self::AU_RATE);
        return $value === null ? (double)$value : $value;
    }
}
}