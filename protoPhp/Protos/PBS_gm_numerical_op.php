<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-10-30 16:45:17
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_gm_numerical_op message
 */
class PBS_gm_numerical_op extends \ProtobufMessage
{
    /* Field index constants */
    const SET_DATA = 1;
    const ADD_DATA = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SET_DATA => array(
            'name' => 'set_data',
            'repeated' => true,
            'type' => '\Protos\PBS_gm_numerical_op_data'
        ),
        self::ADD_DATA => array(
            'name' => 'add_data',
            'repeated' => true,
            'type' => '\Protos\PBS_gm_numerical_op_data'
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
        $this->values[self::SET_DATA] = array();
        $this->values[self::ADD_DATA] = array();
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
     * Appends value to 'set_data' list
     *
     * @param \Protos\PBS_gm_numerical_op_data $value Value to append
     *
     * @return null
     */
    public function appendSetData(\Protos\PBS_gm_numerical_op_data $value)
    {
        return $this->append(self::SET_DATA, $value);
    }

    /**
     * Clears 'set_data' list
     *
     * @return null
     */
    public function clearSetData()
    {
        return $this->clear(self::SET_DATA);
    }

    /**
     * Returns 'set_data' list
     *
     * @return \Protos\PBS_gm_numerical_op_data[]
     */
    public function getSetData()
    {
        return $this->get(self::SET_DATA);
    }

    /**
     * Returns 'set_data' iterator
     *
     * @return \ArrayIterator
     */
    public function getSetDataIterator()
    {
        return new \ArrayIterator($this->get(self::SET_DATA));
    }

    /**
     * Returns element from 'set_data' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\PBS_gm_numerical_op_data
     */
    public function getSetDataAt($offset)
    {
        return $this->get(self::SET_DATA, $offset);
    }

    /**
     * Returns count of 'set_data' list
     *
     * @return int
     */
    public function getSetDataCount()
    {
        return $this->count(self::SET_DATA);
    }

    /**
     * Appends value to 'add_data' list
     *
     * @param \Protos\PBS_gm_numerical_op_data $value Value to append
     *
     * @return null
     */
    public function appendAddData(\Protos\PBS_gm_numerical_op_data $value)
    {
        return $this->append(self::ADD_DATA, $value);
    }

    /**
     * Clears 'add_data' list
     *
     * @return null
     */
    public function clearAddData()
    {
        return $this->clear(self::ADD_DATA);
    }

    /**
     * Returns 'add_data' list
     *
     * @return \Protos\PBS_gm_numerical_op_data[]
     */
    public function getAddData()
    {
        return $this->get(self::ADD_DATA);
    }

    /**
     * Returns 'add_data' iterator
     *
     * @return \ArrayIterator
     */
    public function getAddDataIterator()
    {
        return new \ArrayIterator($this->get(self::ADD_DATA));
    }

    /**
     * Returns element from 'add_data' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\PBS_gm_numerical_op_data
     */
    public function getAddDataAt($offset)
    {
        return $this->get(self::ADD_DATA, $offset);
    }

    /**
     * Returns count of 'add_data' list
     *
     * @return int
     */
    public function getAddDataCount()
    {
        return $this->count(self::ADD_DATA);
    }
}
}