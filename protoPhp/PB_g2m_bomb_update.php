<?php
/**
 * Auto generated from PB_numerical.proto at 2018-02-06 16:55:50
 */

namespace {
/**
 * PB_g2m_bomb_update message
 */
class PB_g2m_bomb_update extends \ProtobufMessage
{
    /* Field index constants */
    const CU = 1;
    const AG = 2;
    const AU = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CU => array(
            'name' => 'cu',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::AG => array(
            'name' => 'ag',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::AU => array(
            'name' => 'au',
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
        $this->values[self::CU] = null;
        $this->values[self::AG] = null;
        $this->values[self::AU] = null;
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
     * Sets value of 'cu' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCu($value)
    {
        return $this->set(self::CU, $value);
    }

    /**
     * Returns value of 'cu' property
     *
     * @return integer
     */
    public function getCu()
    {
        $value = $this->get(self::CU);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'ag' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAg($value)
    {
        return $this->set(self::AG, $value);
    }

    /**
     * Returns value of 'ag' property
     *
     * @return integer
     */
    public function getAg()
    {
        $value = $this->get(self::AG);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'au' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAu($value)
    {
        return $this->set(self::AU, $value);
    }

    /**
     * Returns value of 'au' property
     *
     * @return integer
     */
    public function getAu()
    {
        $value = $this->get(self::AU);
        return $value === null ? (integer)$value : $value;
    }
}
}