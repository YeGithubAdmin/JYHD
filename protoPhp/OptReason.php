<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-28 20:15:01
 */

namespace {
/**
 * OptReason enum
 */
final class OptReason
{
    const OptReason_None = 1;
    const buy_yueka_ok = 2;
    const get_yueka_award = 3;
    const use_item = 4;
    const pay_gold = 5;
    const exchange = 6;
    const vip_reward = 7;
    const checkin_reward = 8;
    const promotion_reward = 9;
    const mall_reward = 10;
    const mall_reward_sdk = 11;
    const first_pay = 12;
    const gm_tool = 13;
    const player_level_up = 14;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'OptReason_None' => self::OptReason_None,
            'buy_yueka_ok' => self::buy_yueka_ok,
            'get_yueka_award' => self::get_yueka_award,
            'use_item' => self::use_item,
            'pay_gold' => self::pay_gold,
            'exchange' => self::exchange,
            'vip_reward' => self::vip_reward,
            'checkin_reward' => self::checkin_reward,
            'promotion_reward' => self::promotion_reward,
            'mall_reward' => self::mall_reward,
            'mall_reward_sdk' => self::mall_reward_sdk,
            'first_pay' => self::first_pay,
            'gm_tool' => self::gm_tool,
            'player_level_up' => self::player_level_up,
        );
    }
}
}