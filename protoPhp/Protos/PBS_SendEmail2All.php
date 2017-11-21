<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-15 14:42:26
 *
 * protos package
 */

namespace Protos {
/**
 * PBS_SendEmail2All message
 */
class PBS_SendEmail2All extends \ProtobufMessage
{
    /* Field index constants */
    const SEND_EMAIL = 1;
    const CHANNEL = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SEND_EMAIL => array(
            'name' => 'send_email',
            'required' => false,
            'type' => '\PB_Email'
        ),
        self::CHANNEL => array(
            'name' => 'channel',
            'required' => false,
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
        $this->values[self::SEND_EMAIL] = null;
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
     * Sets value of 'send_email' property
     *
     * @param \PB_Email $value Property value
     *
     * @return null
     */
    public function setSendEmail(\PB_Email $value=null)
    {
        return $this->set(self::SEND_EMAIL, $value);
    }

    /**
     * Returns value of 'send_email' property
     *
     * @return \PB_Email
     */
    public function getSendEmail()
    {
        return $this->get(self::SEND_EMAIL);
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