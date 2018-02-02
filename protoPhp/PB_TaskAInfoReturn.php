<?php
/**
 * Auto generated from PB_task_rpc.proto at 2018-02-01 10:24:00
 */

namespace {
/**
 * PB_TaskAInfoReturn message
 */
class PB_TaskAInfoReturn extends \ProtobufMessage
{
    /* Field index constants */
    const CODE = 1;
    const TASKS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CODE => array(
            'name' => 'code',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TASKS => array(
            'name' => 'tasks',
            'repeated' => true,
            'type' => '\PB_TaskA'
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
        $this->values[self::CODE] = null;
        $this->values[self::TASKS] = array();
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

    /**
     * Appends value to 'tasks' list
     *
     * @param \PB_TaskA $value Value to append
     *
     * @return null
     */
    public function appendTasks(\PB_TaskA $value)
    {
        return $this->append(self::TASKS, $value);
    }

    /**
     * Clears 'tasks' list
     *
     * @return null
     */
    public function clearTasks()
    {
        return $this->clear(self::TASKS);
    }

    /**
     * Returns 'tasks' list
     *
     * @return \PB_TaskA[]
     */
    public function getTasks()
    {
        return $this->get(self::TASKS);
    }

    /**
     * Returns 'tasks' iterator
     *
     * @return \ArrayIterator
     */
    public function getTasksIterator()
    {
        return new \ArrayIterator($this->get(self::TASKS));
    }

    /**
     * Returns element from 'tasks' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_TaskA
     */
    public function getTasksAt($offset)
    {
        return $this->get(self::TASKS, $offset);
    }

    /**
     * Returns count of 'tasks' list
     *
     * @return int
     */
    public function getTasksCount()
    {
        return $this->count(self::TASKS);
    }
}
}