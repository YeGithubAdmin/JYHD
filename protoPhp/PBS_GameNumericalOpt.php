<?php
/**
 * Auto generated from PB_statistics_data.proto at 2017-09-22 17:45:22
 */

namespace {
/**
 * PBS_GameNumericalOpt message
 */
class PBS_GameNumericalOpt extends \ProtobufMessage
{
    /* Field index constants */
    const REQUEST = 1;
    const RESPONSE = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::REQUEST => array(
            'name' => 'request',
            'required' => false,
            'type' => '\PBS_GameNumericalOpt_Request'
        ),
        self::RESPONSE => array(
            'name' => 'response',
            'required' => false,
            'type' => '\PBS_GameNumericalOpt_Response'
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
        $this->values[self::REQUEST] = null;
        $this->values[self::RESPONSE] = null;
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
     * Sets value of 'request' property
     *
     * @param \PBS_GameNumericalOpt_Request $value Property value
     *
     * @return null
     */
    public function setRequest(\PBS_GameNumericalOpt_Request $value=null)
    {
        return $this->set(self::REQUEST, $value);
    }

    /**
     * Returns value of 'request' property
     *
     * @return \PBS_GameNumericalOpt_Request
     */
    public function getRequest()
    {
        return $this->get(self::REQUEST);
    }

    /**
     * Sets value of 'response' property
     *
     * @param \PBS_GameNumericalOpt_Response $value Property value
     *
     * @return null
     */
    public function setResponse(\PBS_GameNumericalOpt_Response $value=null)
    {
        return $this->set(self::RESPONSE, $value);
    }

    /**
     * Returns value of 'response' property
     *
     * @return \PBS_GameNumericalOpt_Response
     */
    public function getResponse()
    {
        return $this->get(self::RESPONSE);
    }
}
}