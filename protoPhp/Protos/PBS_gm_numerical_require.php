<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-24 16:26:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_gm_numerical_require message
 */
class PBS_gm_numerical_require extends \ProtobufMessage
{
    /* Field index constants */
    const SERVERID = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SERVERID => array(
            'name' => 'serverid',
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
        $this->values[self::SERVERID] = null;
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
     * Sets value of 'serverid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setServerid($value)
    {
        return $this->set(self::SERVERID, $value);
    }

    /**
     * Returns value of 'serverid' property
     *
     * @return integer
     */
    public function getServerid()
    {
        $value = $this->get(self::SERVERID);
        return $value === null ? (integer)$value : $value;
    }
}
}