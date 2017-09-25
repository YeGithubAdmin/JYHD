<?php
/**
 * Auto generated from PB_server_common.proto at 2017-09-25 11:08:41
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_NotifyClient message
 */
class PBS_NotifyClient extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const MSG = 2;
    const MSGID = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MSG => array(
            'name' => 'msg',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MSGID => array(
            'name' => 'msgid',
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
        $this->values[self::UID] = null;
        $this->values[self::MSG] = null;
        $this->values[self::MSGID] = null;
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
     * @param integer $value Property value
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
     * @return integer
     */
    public function getUid()
    {
        $value = $this->get(self::UID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'msg' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMsg($value)
    {
        return $this->set(self::MSG, $value);
    }

    /**
     * Returns value of 'msg' property
     *
     * @return string
     */
    public function getMsg()
    {
        $value = $this->get(self::MSG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'msgid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMsgid($value)
    {
        return $this->set(self::MSGID, $value);
    }

    /**
     * Returns value of 'msgid' property
     *
     * @return integer
     */
    public function getMsgid()
    {
        $value = $this->get(self::MSGID);
        return $value === null ? (integer)$value : $value;
    }
}
}