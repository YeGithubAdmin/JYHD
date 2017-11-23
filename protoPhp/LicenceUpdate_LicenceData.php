<?php
/**
 * Auto generated from PB_event.proto at 2017-11-22 14:55:06
 */

namespace {
/**
 * LicenceData message embedded in LicenceUpdate message
 */
class LicenceUpdate_LicenceData extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const LICENCE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LICENCE => array(
            'name' => 'licence',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::LICENCE] = null;
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

    /**
     * Sets value of 'licence' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setLicence($value)
    {
        return $this->set(self::LICENCE, $value);
    }

    /**
     * Returns value of 'licence' property
     *
     * @return boolean
     */
    public function getLicence()
    {
        $value = $this->get(self::LICENCE);
        return $value === null ? (boolean)$value : $value;
    }
}
}