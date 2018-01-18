<?php
/**
 * Auto generated from PB_game_config.proto at 2018-01-18 17:53:25
 */

namespace {
/**
 * PB_GameType enum
 */
final class PB_GameType
{
    const Game_None = -1;
    const Game_buyu = 1;
    const Game_shuihu = 2;
    const Game_Max = 100;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Game_None' => self::Game_None,
            'Game_buyu' => self::Game_buyu,
            'Game_shuihu' => self::Game_shuihu,
            'Game_Max' => self::Game_Max,
        );
    }
}
}