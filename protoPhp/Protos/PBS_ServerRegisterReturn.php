<?php
/**
 * Auto generated from PB_server_common.proto at 2017-09-25 11:08:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ServerRegisterReturn message
 */
class PBS_ServerRegisterReturn extends \ProtobufMessage
{
    /* Field index constants */
    const RET = 1;
    const CLIS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RET => array(
            'name' => 'ret',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CLIS => array(
            'name' => 'clis',
            'repeated' => true,
            'type' => '\Protos\PBS_ServerRegisterReturn_ClientInfo'
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
        $this->values[self::RET] = null;
        $this->values[self::CLIS] = array();
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
     * Sets value of 'ret' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRet($value)
    {
        return $this->set(self::RET, $value);
    }

    /**
     * Returns value of 'ret' property
     *
     * @return integer
     */
    public function getRet()
    {
        $value = $this->get(self::RET);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'clis' list
     *
     * @param \Protos\PBS_ServerRegisterReturn_ClientInfo $value Value to append
     *
     * @return null
     */
    public function appendClis(\Protos\PBS_ServerRegisterReturn_ClientInfo $value)
    {
        return $this->append(self::CLIS, $value);
    }

    /**
     * Clears 'clis' list
     *
     * @return null
     */
    public function clearClis()
    {
        return $this->clear(self::CLIS);
    }

    /**
     * Returns 'clis' list
     *
     * @return \Protos\PBS_ServerRegisterReturn_ClientInfo[]
     */
    public function getClis()
    {
        return $this->get(self::CLIS);
    }

    /**
     * Returns 'clis' iterator
     *
     * @return \ArrayIterator
     */
    public function getClisIterator()
    {
        return new \ArrayIterator($this->get(self::CLIS));
    }

    /**
     * Returns element from 'clis' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\PBS_ServerRegisterReturn_ClientInfo
     */
    public function getClisAt($offset)
    {
        return $this->get(self::CLIS, $offset);
    }

    /**
     * Returns count of 'clis' list
     *
     * @return int
     */
    public function getClisCount()
    {
        return $this->count(self::CLIS);
    }
}
}