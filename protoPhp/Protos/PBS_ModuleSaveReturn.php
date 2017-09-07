<?php
/**
 * Auto generated from PB_module_rpc.proto at 2017-09-07 01:23:07
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ModuleSaveReturn message
 */
class PBS_ModuleSaveReturn extends \ProtobufMessage
{
    /* Field index constants */
    const PLAYERID = 1;
    const CODE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PLAYERID => array(
            'name' => 'playerid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CODE => array(
            'name' => 'code',
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
        $this->values[self::PLAYERID] = null;
        $this->values[self::CODE] = null;
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
}
}