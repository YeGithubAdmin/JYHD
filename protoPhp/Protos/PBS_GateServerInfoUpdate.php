<?php
/**
 * Auto generated from PB_server_common.proto at 2018-01-02 15:38:42
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_GateServerInfoUpdate message
 */
class PBS_GateServerInfoUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const CUR_CLIENTS = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CUR_CLIENTS => array(
            'name' => 'cur_clients',
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
        $this->values[self::CUR_CLIENTS] = null;
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
     * Sets value of 'cur_clients' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCurClients($value)
    {
        return $this->set(self::CUR_CLIENTS, $value);
    }

    /**
     * Returns value of 'cur_clients' property
     *
     * @return integer
     */
    public function getCurClients()
    {
        $value = $this->get(self::CUR_CLIENTS);
        return $value === null ? (integer)$value : $value;
    }
}
}