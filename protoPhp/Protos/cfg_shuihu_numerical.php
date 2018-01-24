<?php
/**
 * Auto generated from PB_gm_tool.proto at 2018-01-24 16:26:41
 *
 * protos package
 */

namespace Protos {
/**
 * cfg_shuihu_numerical message
 */
class cfg_shuihu_numerical extends \ProtobufMessage
{
    /* Field index constants */
    const CFG_SHUIHU_FLUCTUATE = 1;
    const CFG_SHUIHU_FLUCTUATE_RANGE = 2;
    const CFG_SHUIHU_RETURN_MULTIPLE = 3;
    const CFG_SHUIGUOJI_RAND_1 = 4;
    const CFG_SHUIGUOJI_RAND_2 = 5;
    const CFG_SHUIGUOJI_DENOMINATOR_1 = 6;
    const CFG_SHUIGUOJI_DENOMINATOR_2 = 7;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CFG_SHUIHU_FLUCTUATE => array(
            'name' => 'cfg_shuihu_fluctuate',
            'repeated' => true,
            'type' => '\Protos\cfg_shuihu_fluctuate'
        ),
        self::CFG_SHUIHU_FLUCTUATE_RANGE => array(
            'name' => 'cfg_shuihu_fluctuate_range',
            'required' => false,
            'type' => '\Protos\cfg_shuihu_fluctuate_range'
        ),
        self::CFG_SHUIHU_RETURN_MULTIPLE => array(
            'name' => 'cfg_shuihu_return_multiple',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::CFG_SHUIGUOJI_RAND_1 => array(
            'name' => 'cfg_shuiguoji_rand_1',
            'required' => false,
            'type' => '\Protos\cfg_shuiguoji_rand_1'
        ),
        self::CFG_SHUIGUOJI_RAND_2 => array(
            'name' => 'cfg_shuiguoji_rand_2',
            'required' => false,
            'type' => '\Protos\cfg_shuiguoji_rand_2'
        ),
        self::CFG_SHUIGUOJI_DENOMINATOR_1 => array(
            'name' => 'cfg_shuiguoji_denominator_1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CFG_SHUIGUOJI_DENOMINATOR_2 => array(
            'name' => 'cfg_shuiguoji_denominator_2',
            'required' => false,
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
        $this->values[self::CFG_SHUIHU_FLUCTUATE] = array();
        $this->values[self::CFG_SHUIHU_FLUCTUATE_RANGE] = null;
        $this->values[self::CFG_SHUIHU_RETURN_MULTIPLE] = null;
        $this->values[self::CFG_SHUIGUOJI_RAND_1] = null;
        $this->values[self::CFG_SHUIGUOJI_RAND_2] = null;
        $this->values[self::CFG_SHUIGUOJI_DENOMINATOR_1] = null;
        $this->values[self::CFG_SHUIGUOJI_DENOMINATOR_2] = null;
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
     * Appends value to 'cfg_shuihu_fluctuate' list
     *
     * @param \Protos\cfg_shuihu_fluctuate $value Value to append
     *
     * @return null
     */
    public function appendCfgShuihuFluctuate(\Protos\cfg_shuihu_fluctuate $value)
    {
        return $this->append(self::CFG_SHUIHU_FLUCTUATE, $value);
    }

    /**
     * Clears 'cfg_shuihu_fluctuate' list
     *
     * @return null
     */
    public function clearCfgShuihuFluctuate()
    {
        return $this->clear(self::CFG_SHUIHU_FLUCTUATE);
    }

    /**
     * Returns 'cfg_shuihu_fluctuate' list
     *
     * @return \Protos\cfg_shuihu_fluctuate[]
     */
    public function getCfgShuihuFluctuate()
    {
        return $this->get(self::CFG_SHUIHU_FLUCTUATE);
    }

    /**
     * Returns 'cfg_shuihu_fluctuate' iterator
     *
     * @return \ArrayIterator
     */
    public function getCfgShuihuFluctuateIterator()
    {
        return new \ArrayIterator($this->get(self::CFG_SHUIHU_FLUCTUATE));
    }

    /**
     * Returns element from 'cfg_shuihu_fluctuate' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\cfg_shuihu_fluctuate
     */
    public function getCfgShuihuFluctuateAt($offset)
    {
        return $this->get(self::CFG_SHUIHU_FLUCTUATE, $offset);
    }

    /**
     * Returns count of 'cfg_shuihu_fluctuate' list
     *
     * @return int
     */
    public function getCfgShuihuFluctuateCount()
    {
        return $this->count(self::CFG_SHUIHU_FLUCTUATE);
    }

    /**
     * Sets value of 'cfg_shuihu_fluctuate_range' property
     *
     * @param \Protos\cfg_shuihu_fluctuate_range $value Property value
     *
     * @return null
     */
    public function setCfgShuihuFluctuateRange(\Protos\cfg_shuihu_fluctuate_range $value=null)
    {
        return $this->set(self::CFG_SHUIHU_FLUCTUATE_RANGE, $value);
    }

    /**
     * Returns value of 'cfg_shuihu_fluctuate_range' property
     *
     * @return \Protos\cfg_shuihu_fluctuate_range
     */
    public function getCfgShuihuFluctuateRange()
    {
        return $this->get(self::CFG_SHUIHU_FLUCTUATE_RANGE);
    }

    /**
     * Sets value of 'cfg_shuihu_return_multiple' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setCfgShuihuReturnMultiple($value)
    {
        return $this->set(self::CFG_SHUIHU_RETURN_MULTIPLE, $value);
    }

    /**
     * Returns value of 'cfg_shuihu_return_multiple' property
     *
     * @return double
     */
    public function getCfgShuihuReturnMultiple()
    {
        $value = $this->get(self::CFG_SHUIHU_RETURN_MULTIPLE);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'cfg_shuiguoji_rand_1' property
     *
     * @param \Protos\cfg_shuiguoji_rand_1 $value Property value
     *
     * @return null
     */
    public function setCfgShuiguojiRand1(\Protos\cfg_shuiguoji_rand_1 $value=null)
    {
        return $this->set(self::CFG_SHUIGUOJI_RAND_1, $value);
    }

    /**
     * Returns value of 'cfg_shuiguoji_rand_1' property
     *
     * @return \Protos\cfg_shuiguoji_rand_1
     */
    public function getCfgShuiguojiRand1()
    {
        return $this->get(self::CFG_SHUIGUOJI_RAND_1);
    }

    /**
     * Sets value of 'cfg_shuiguoji_rand_2' property
     *
     * @param \Protos\cfg_shuiguoji_rand_2 $value Property value
     *
     * @return null
     */
    public function setCfgShuiguojiRand2(\Protos\cfg_shuiguoji_rand_2 $value=null)
    {
        return $this->set(self::CFG_SHUIGUOJI_RAND_2, $value);
    }

    /**
     * Returns value of 'cfg_shuiguoji_rand_2' property
     *
     * @return \Protos\cfg_shuiguoji_rand_2
     */
    public function getCfgShuiguojiRand2()
    {
        return $this->get(self::CFG_SHUIGUOJI_RAND_2);
    }

    /**
     * Sets value of 'cfg_shuiguoji_denominator_1' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCfgShuiguojiDenominator1($value)
    {
        return $this->set(self::CFG_SHUIGUOJI_DENOMINATOR_1, $value);
    }

    /**
     * Returns value of 'cfg_shuiguoji_denominator_1' property
     *
     * @return integer
     */
    public function getCfgShuiguojiDenominator1()
    {
        $value = $this->get(self::CFG_SHUIGUOJI_DENOMINATOR_1);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'cfg_shuiguoji_denominator_2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCfgShuiguojiDenominator2($value)
    {
        return $this->set(self::CFG_SHUIGUOJI_DENOMINATOR_2, $value);
    }

    /**
     * Returns value of 'cfg_shuiguoji_denominator_2' property
     *
     * @return integer
     */
    public function getCfgShuiguojiDenominator2()
    {
        $value = $this->get(self::CFG_SHUIGUOJI_DENOMINATOR_2);
        return $value === null ? (integer)$value : $value;
    }
}
}