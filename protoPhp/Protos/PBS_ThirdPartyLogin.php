<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-15 14:42:26
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_ThirdPartyLogin message
 */
class PBS_ThirdPartyLogin extends \ProtobufMessage
{
    /* Field index constants */
    const UID = 1;
    const LOGIN_CODE = 2;
    const CHANNEL = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::UID => array(
            'name' => 'uid',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::LOGIN_CODE => array(
            'name' => 'login_code',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::LOGIN_CODE] = null;
        $this->values[self::CHANNEL] = null;
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
     * Sets value of 'login_code' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLoginCode($value)
    {
        return $this->set(self::LOGIN_CODE, $value);
    }

    /**
     * Returns value of 'login_code' property
     *
     * @return string
     */
    public function getLoginCode()
    {
        $value = $this->get(self::LOGIN_CODE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'channel' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setChannel($value)
    {
        return $this->set(self::CHANNEL, $value);
    }

    /**
     * Returns value of 'channel' property
     *
     * @return string
     */
    public function getChannel()
    {
        $value = $this->get(self::CHANNEL);
        return $value === null ? (string)$value : $value;
    }
}
}