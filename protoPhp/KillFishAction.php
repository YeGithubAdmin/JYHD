<?php
/**
 * Auto generated from PB_event.proto at 2017-12-26 10:10:52
 */

namespace {
/**
 * KillFishAction message
 */
class KillFishAction extends \ProtobufMessage
{
    /* Field index constants */
    const ACTS = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ACTS => array(
            'name' => 'acts',
            'repeated' => true,
            'type' => '\KillFishAction_ActionInfo'
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
        $this->values[self::ACTS] = array();
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
     * Appends value to 'acts' list
     *
     * @param \KillFishAction_ActionInfo $value Value to append
     *
     * @return null
     */
    public function appendActs(\KillFishAction_ActionInfo $value)
    {
        return $this->append(self::ACTS, $value);
    }

    /**
     * Clears 'acts' list
     *
     * @return null
     */
    public function clearActs()
    {
        return $this->clear(self::ACTS);
    }

    /**
     * Returns 'acts' list
     *
     * @return \KillFishAction_ActionInfo[]
     */
    public function getActs()
    {
        return $this->get(self::ACTS);
    }

    /**
     * Returns 'acts' iterator
     *
     * @return \ArrayIterator
     */
    public function getActsIterator()
    {
        return new \ArrayIterator($this->get(self::ACTS));
    }

    /**
     * Returns element from 'acts' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \KillFishAction_ActionInfo
     */
    public function getActsAt($offset)
    {
        return $this->get(self::ACTS, $offset);
    }

    /**
     * Returns count of 'acts' list
     *
     * @return int
     */
    public function getActsCount()
    {
        return $this->count(self::ACTS);
    }
}
}