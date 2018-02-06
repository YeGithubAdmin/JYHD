<?php
/**
 * Auto generated from PB_server_common.proto at 2018-02-06 16:55:50
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_GateInfosReturn message
 */
class PBS_GateInfosReturn extends \ProtobufMessage
{
    /* Field index constants */
    const GATES = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GATES => array(
            'name' => 'gates',
            'repeated' => true,
            'type' => '\Protos\PBS_GateServerInfo'
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
        $this->values[self::GATES] = array();
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
     * Appends value to 'gates' list
     *
     * @param \Protos\PBS_GateServerInfo $value Value to append
     *
     * @return null
     */
    public function appendGates(\Protos\PBS_GateServerInfo $value)
    {
        return $this->append(self::GATES, $value);
    }

    /**
     * Clears 'gates' list
     *
     * @return null
     */
    public function clearGates()
    {
        return $this->clear(self::GATES);
    }

    /**
     * Returns 'gates' list
     *
     * @return \Protos\PBS_GateServerInfo[]
     */
    public function getGates()
    {
        return $this->get(self::GATES);
    }

    /**
     * Returns 'gates' iterator
     *
     * @return \ArrayIterator
     */
    public function getGatesIterator()
    {
        return new \ArrayIterator($this->get(self::GATES));
    }

    /**
     * Returns element from 'gates' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\PBS_GateServerInfo
     */
    public function getGatesAt($offset)
    {
        return $this->get(self::GATES, $offset);
    }

    /**
     * Returns count of 'gates' list
     *
     * @return int
     */
    public function getGatesCount()
    {
        return $this->count(self::GATES);
    }
}
}