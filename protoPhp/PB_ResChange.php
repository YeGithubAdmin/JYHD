<?php
/**
 * Auto generated from PB_notify.proto at 2017-11-07 17:09:46
 */

namespace {
/**
 * PB_ResChange message
 */
class PB_ResChange extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const REASON = 2;
    const RES = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::REASON => array(
            'name' => 'reason',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::RES => array(
            'name' => 'res',
            'repeated' => true,
            'type' => '\PB_ResChange_PB_Res'
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
        $this->values[self::UID] = null;
        $this->values[self::REASON] = null;
        $this->values[self::RES] = array();
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
     * Sets value of 'uid' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setUid($value)
    {
        return $this->set(self::UID, $value);
    }

    /**
     * Returns value of 'uid' property
     *
     * @return string
     */
    public function getUid()
    {
        $value = $this->get(self::UID);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'reason' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setReason($value)
    {
        return $this->set(self::REASON, $value);
    }

    /**
     * Returns value of 'reason' property
     *
     * @return string
     */
    public function getReason()
    {
        $value = $this->get(self::REASON);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Appends value to 'res' list
     *
     * @param \PB_ResChange_PB_Res $value Value to append
     *
     * @return null
     */
    public function appendRes(\PB_ResChange_PB_Res $value)
    {
        return $this->append(self::RES, $value);
    }

    /**
     * Clears 'res' list
     *
     * @return null
     */
    public function clearRes()
    {
        return $this->clear(self::RES);
    }

    /**
     * Returns 'res' list
     *
     * @return \PB_ResChange_PB_Res[]
     */
    public function getRes()
    {
        return $this->get(self::RES);
    }

    /**
     * Returns 'res' iterator
     *
     * @return \ArrayIterator
     */
    public function getResIterator()
    {
        return new \ArrayIterator($this->get(self::RES));
    }

    /**
     * Returns element from 'res' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_ResChange_PB_Res
     */
    public function getResAt($offset)
    {
        return $this->get(self::RES, $offset);
    }

    /**
     * Returns count of 'res' list
     *
     * @return int
     */
    public function getResCount()
    {
        return $this->count(self::RES);
    }
}
}