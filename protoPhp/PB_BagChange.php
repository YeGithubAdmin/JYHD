<?php
/**
 * Auto generated from PB_notify.proto at 2017-09-25 11:08:41
 */

namespace {
/**
 * PB_BagChange message
 */
class PB_BagChange extends \ProtobufMessage
{
    /* Field index constants */
    const ITEM = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ITEM => array(
            'name' => 'item',
            'required' => false,
            'type' => '\PB_Item'
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
        $this->values[self::ITEM] = null;
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
     * Sets value of 'item' property
     *
     * @param \PB_Item $value Property value
     *
     * @return null
     */
    public function setItem(\PB_Item $value=null)
    {
        return $this->set(self::ITEM, $value);
    }

    /**
     * Returns value of 'item' property
     *
     * @return \PB_Item
     */
    public function getItem()
    {
        return $this->get(self::ITEM);
    }
}
}