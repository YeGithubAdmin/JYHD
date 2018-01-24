<?php
/**
 * Auto generated from PB_notify.proto at 2018-01-24 16:26:41
 */

namespace {
/**
 * PB_NewEmail message
 */
class PB_NewEmail extends \ProtobufMessage
{
    /* Field index constants */
    const EMAIL = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::EMAIL => array(
            'name' => 'email',
            'required' => true,
            'type' => '\PB_Email'
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
        $this->values[self::EMAIL] = null;
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
     * Sets value of 'email' property
     *
     * @param \PB_Email $value Property value
     *
     * @return null
     */
    public function setEmail(\PB_Email $value=null)
    {
        return $this->set(self::EMAIL, $value);
    }

    /**
     * Returns value of 'email' property
     *
     * @return \PB_Email
     */
    public function getEmail()
    {
        return $this->get(self::EMAIL);
    }
}
}