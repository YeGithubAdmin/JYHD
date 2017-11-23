<?php
/**
 * Auto generated from PB_gm_tool.proto at 2017-11-22 14:55:06
 *
 * protos package
 */

namespace Protos {
/**
 * game_numerical message
 */
class game_numerical extends \ProtobufMessage
{
    /* Field index constants */
    const POOL_RATIO = 1;
    const LIMIT_RATIO = 2;
    const CHANGE_POINT = 3;
    const FISH_CARD_P1 = 4;
    const FISH_CARD_P2 = 5;
    const BOSS_AWARD_POOL = 6;
    const RETURN_GOLD_RATE = 20;
    const RECHARGE_EFFECT = 21;
    const KEY_RECHARGE_EFFECT = 22;
    const DOWN_GRADE = 23;
    const FISH_CARD_RATE = 24;
    const BOSS_RATE_PARAMS = 25;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::POOL_RATIO => array(
            'name' => 'pool_ratio',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::LIMIT_RATIO => array(
            'name' => 'limit_ratio',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::CHANGE_POINT => array(
            'name' => 'change_point',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FISH_CARD_P1 => array(
            'name' => 'fish_card_p1',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::FISH_CARD_P2 => array(
            'name' => 'fish_card_p2',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BOSS_AWARD_POOL => array(
            'name' => 'boss_award_pool',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RETURN_GOLD_RATE => array(
            'name' => 'return_gold_rate',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_return_gold_rate'
        ),
        self::RECHARGE_EFFECT => array(
            'name' => 'recharge_effect',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_recharge_effect'
        ),
        self::KEY_RECHARGE_EFFECT => array(
            'name' => 'key_recharge_effect',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_key_recharge_effect'
        ),
        self::DOWN_GRADE => array(
            'name' => 'down_grade',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_down_grade'
        ),
        self::FISH_CARD_RATE => array(
            'name' => 'fish_card_rate',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_fish_card_rate'
        ),
        self::BOSS_RATE_PARAMS => array(
            'name' => 'boss_rate_params',
            'repeated' => true,
            'type' => '\Protos\game_numerical_const_boss_rate_params'
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
        $this->values[self::POOL_RATIO] = null;
        $this->values[self::LIMIT_RATIO] = null;
        $this->values[self::CHANGE_POINT] = null;
        $this->values[self::FISH_CARD_P1] = null;
        $this->values[self::FISH_CARD_P2] = null;
        $this->values[self::BOSS_AWARD_POOL] = null;
        $this->values[self::RETURN_GOLD_RATE] = array();
        $this->values[self::RECHARGE_EFFECT] = array();
        $this->values[self::KEY_RECHARGE_EFFECT] = array();
        $this->values[self::DOWN_GRADE] = array();
        $this->values[self::FISH_CARD_RATE] = array();
        $this->values[self::BOSS_RATE_PARAMS] = array();
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
     * Sets value of 'pool_ratio' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setPoolRatio($value)
    {
        return $this->set(self::POOL_RATIO, $value);
    }

    /**
     * Returns value of 'pool_ratio' property
     *
     * @return double
     */
    public function getPoolRatio()
    {
        $value = $this->get(self::POOL_RATIO);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'limit_ratio' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setLimitRatio($value)
    {
        return $this->set(self::LIMIT_RATIO, $value);
    }

    /**
     * Returns value of 'limit_ratio' property
     *
     * @return double
     */
    public function getLimitRatio()
    {
        $value = $this->get(self::LIMIT_RATIO);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'change_point' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setChangePoint($value)
    {
        return $this->set(self::CHANGE_POINT, $value);
    }

    /**
     * Returns value of 'change_point' property
     *
     * @return integer
     */
    public function getChangePoint()
    {
        $value = $this->get(self::CHANGE_POINT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'fish_card_p1' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setFishCardP1($value)
    {
        return $this->set(self::FISH_CARD_P1, $value);
    }

    /**
     * Returns value of 'fish_card_p1' property
     *
     * @return double
     */
    public function getFishCardP1()
    {
        $value = $this->get(self::FISH_CARD_P1);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'fish_card_p2' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFishCardP2($value)
    {
        return $this->set(self::FISH_CARD_P2, $value);
    }

    /**
     * Returns value of 'fish_card_p2' property
     *
     * @return integer
     */
    public function getFishCardP2()
    {
        $value = $this->get(self::FISH_CARD_P2);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'boss_award_pool' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBossAwardPool($value)
    {
        return $this->set(self::BOSS_AWARD_POOL, $value);
    }

    /**
     * Returns value of 'boss_award_pool' property
     *
     * @return integer
     */
    public function getBossAwardPool()
    {
        $value = $this->get(self::BOSS_AWARD_POOL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'return_gold_rate' list
     *
     * @param \Protos\game_numerical_const_return_gold_rate $value Value to append
     *
     * @return null
     */
    public function appendReturnGoldRate(\Protos\game_numerical_const_return_gold_rate $value)
    {
        return $this->append(self::RETURN_GOLD_RATE, $value);
    }

    /**
     * Clears 'return_gold_rate' list
     *
     * @return null
     */
    public function clearReturnGoldRate()
    {
        return $this->clear(self::RETURN_GOLD_RATE);
    }

    /**
     * Returns 'return_gold_rate' list
     *
     * @return \Protos\game_numerical_const_return_gold_rate[]
     */
    public function getReturnGoldRate()
    {
        return $this->get(self::RETURN_GOLD_RATE);
    }

    /**
     * Returns 'return_gold_rate' iterator
     *
     * @return \ArrayIterator
     */
    public function getReturnGoldRateIterator()
    {
        return new \ArrayIterator($this->get(self::RETURN_GOLD_RATE));
    }

    /**
     * Returns element from 'return_gold_rate' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_return_gold_rate
     */
    public function getReturnGoldRateAt($offset)
    {
        return $this->get(self::RETURN_GOLD_RATE, $offset);
    }

    /**
     * Returns count of 'return_gold_rate' list
     *
     * @return int
     */
    public function getReturnGoldRateCount()
    {
        return $this->count(self::RETURN_GOLD_RATE);
    }

    /**
     * Appends value to 'recharge_effect' list
     *
     * @param \Protos\game_numerical_const_recharge_effect $value Value to append
     *
     * @return null
     */
    public function appendRechargeEffect(\Protos\game_numerical_const_recharge_effect $value)
    {
        return $this->append(self::RECHARGE_EFFECT, $value);
    }

    /**
     * Clears 'recharge_effect' list
     *
     * @return null
     */
    public function clearRechargeEffect()
    {
        return $this->clear(self::RECHARGE_EFFECT);
    }

    /**
     * Returns 'recharge_effect' list
     *
     * @return \Protos\game_numerical_const_recharge_effect[]
     */
    public function getRechargeEffect()
    {
        return $this->get(self::RECHARGE_EFFECT);
    }

    /**
     * Returns 'recharge_effect' iterator
     *
     * @return \ArrayIterator
     */
    public function getRechargeEffectIterator()
    {
        return new \ArrayIterator($this->get(self::RECHARGE_EFFECT));
    }

    /**
     * Returns element from 'recharge_effect' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_recharge_effect
     */
    public function getRechargeEffectAt($offset)
    {
        return $this->get(self::RECHARGE_EFFECT, $offset);
    }

    /**
     * Returns count of 'recharge_effect' list
     *
     * @return int
     */
    public function getRechargeEffectCount()
    {
        return $this->count(self::RECHARGE_EFFECT);
    }

    /**
     * Appends value to 'key_recharge_effect' list
     *
     * @param \Protos\game_numerical_const_key_recharge_effect $value Value to append
     *
     * @return null
     */
    public function appendKeyRechargeEffect(\Protos\game_numerical_const_key_recharge_effect $value)
    {
        return $this->append(self::KEY_RECHARGE_EFFECT, $value);
    }

    /**
     * Clears 'key_recharge_effect' list
     *
     * @return null
     */
    public function clearKeyRechargeEffect()
    {
        return $this->clear(self::KEY_RECHARGE_EFFECT);
    }

    /**
     * Returns 'key_recharge_effect' list
     *
     * @return \Protos\game_numerical_const_key_recharge_effect[]
     */
    public function getKeyRechargeEffect()
    {
        return $this->get(self::KEY_RECHARGE_EFFECT);
    }

    /**
     * Returns 'key_recharge_effect' iterator
     *
     * @return \ArrayIterator
     */
    public function getKeyRechargeEffectIterator()
    {
        return new \ArrayIterator($this->get(self::KEY_RECHARGE_EFFECT));
    }

    /**
     * Returns element from 'key_recharge_effect' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_key_recharge_effect
     */
    public function getKeyRechargeEffectAt($offset)
    {
        return $this->get(self::KEY_RECHARGE_EFFECT, $offset);
    }

    /**
     * Returns count of 'key_recharge_effect' list
     *
     * @return int
     */
    public function getKeyRechargeEffectCount()
    {
        return $this->count(self::KEY_RECHARGE_EFFECT);
    }

    /**
     * Appends value to 'down_grade' list
     *
     * @param \Protos\game_numerical_const_down_grade $value Value to append
     *
     * @return null
     */
    public function appendDownGrade(\Protos\game_numerical_const_down_grade $value)
    {
        return $this->append(self::DOWN_GRADE, $value);
    }

    /**
     * Clears 'down_grade' list
     *
     * @return null
     */
    public function clearDownGrade()
    {
        return $this->clear(self::DOWN_GRADE);
    }

    /**
     * Returns 'down_grade' list
     *
     * @return \Protos\game_numerical_const_down_grade[]
     */
    public function getDownGrade()
    {
        return $this->get(self::DOWN_GRADE);
    }

    /**
     * Returns 'down_grade' iterator
     *
     * @return \ArrayIterator
     */
    public function getDownGradeIterator()
    {
        return new \ArrayIterator($this->get(self::DOWN_GRADE));
    }

    /**
     * Returns element from 'down_grade' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_down_grade
     */
    public function getDownGradeAt($offset)
    {
        return $this->get(self::DOWN_GRADE, $offset);
    }

    /**
     * Returns count of 'down_grade' list
     *
     * @return int
     */
    public function getDownGradeCount()
    {
        return $this->count(self::DOWN_GRADE);
    }

    /**
     * Appends value to 'fish_card_rate' list
     *
     * @param \Protos\game_numerical_const_fish_card_rate $value Value to append
     *
     * @return null
     */
    public function appendFishCardRate(\Protos\game_numerical_const_fish_card_rate $value)
    {
        return $this->append(self::FISH_CARD_RATE, $value);
    }

    /**
     * Clears 'fish_card_rate' list
     *
     * @return null
     */
    public function clearFishCardRate()
    {
        return $this->clear(self::FISH_CARD_RATE);
    }

    /**
     * Returns 'fish_card_rate' list
     *
     * @return \Protos\game_numerical_const_fish_card_rate[]
     */
    public function getFishCardRate()
    {
        return $this->get(self::FISH_CARD_RATE);
    }

    /**
     * Returns 'fish_card_rate' iterator
     *
     * @return \ArrayIterator
     */
    public function getFishCardRateIterator()
    {
        return new \ArrayIterator($this->get(self::FISH_CARD_RATE));
    }

    /**
     * Returns element from 'fish_card_rate' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_fish_card_rate
     */
    public function getFishCardRateAt($offset)
    {
        return $this->get(self::FISH_CARD_RATE, $offset);
    }

    /**
     * Returns count of 'fish_card_rate' list
     *
     * @return int
     */
    public function getFishCardRateCount()
    {
        return $this->count(self::FISH_CARD_RATE);
    }

    /**
     * Appends value to 'boss_rate_params' list
     *
     * @param \Protos\game_numerical_const_boss_rate_params $value Value to append
     *
     * @return null
     */
    public function appendBossRateParams(\Protos\game_numerical_const_boss_rate_params $value)
    {
        return $this->append(self::BOSS_RATE_PARAMS, $value);
    }

    /**
     * Clears 'boss_rate_params' list
     *
     * @return null
     */
    public function clearBossRateParams()
    {
        return $this->clear(self::BOSS_RATE_PARAMS);
    }

    /**
     * Returns 'boss_rate_params' list
     *
     * @return \Protos\game_numerical_const_boss_rate_params[]
     */
    public function getBossRateParams()
    {
        return $this->get(self::BOSS_RATE_PARAMS);
    }

    /**
     * Returns 'boss_rate_params' iterator
     *
     * @return \ArrayIterator
     */
    public function getBossRateParamsIterator()
    {
        return new \ArrayIterator($this->get(self::BOSS_RATE_PARAMS));
    }

    /**
     * Returns element from 'boss_rate_params' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Protos\game_numerical_const_boss_rate_params
     */
    public function getBossRateParamsAt($offset)
    {
        return $this->get(self::BOSS_RATE_PARAMS, $offset);
    }

    /**
     * Returns count of 'boss_rate_params' list
     *
     * @return int
     */
    public function getBossRateParamsCount()
    {
        return $this->count(self::BOSS_RATE_PARAMS);
    }
}
}