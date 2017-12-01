<?php
/**
 * Auto generated from PB_notify.proto at 2017-11-29 17:29:43
 */

namespace {
/**
 * PB_DrawDataUpdate message
 */
class PB_DrawDataUpdate extends \ProtobufMessage
{
    /* Field index constants */
    const DATAS = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATAS => array(
            'name' => 'datas',
            'repeated' => true,
            'type' => '\PB_DrawData'
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
        $this->values[self::DATAS] = array();
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
     * Appends value to 'datas' list
     *
     * @param \PB_DrawData $value Value to append
     *
     * @return null
     */
    public function appendDatas(\PB_DrawData $value)
    {
        return $this->append(self::DATAS, $value);
    }

    /**
     * Clears 'datas' list
     *
     * @return null
     */
    public function clearDatas()
    {
        return $this->clear(self::DATAS);
    }

    /**
     * Returns 'datas' list
     *
     * @return \PB_DrawData[]
     */
    public function getDatas()
    {
        return $this->get(self::DATAS);
    }

    /**
     * Returns 'datas' iterator
     *
     * @return \ArrayIterator
     */
    public function getDatasIterator()
    {
        return new \ArrayIterator($this->get(self::DATAS));
    }

    /**
     * Returns element from 'datas' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_DrawData
     */
    public function getDatasAt($offset)
    {
        return $this->get(self::DATAS, $offset);
    }

    /**
     * Returns count of 'datas' list
     *
     * @return int
     */
    public function getDatasCount()
    {
        return $this->count(self::DATAS);
    }
}
}