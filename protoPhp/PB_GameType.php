<?php
/**
 * Auto generated from PB_game_config.proto at 2017-10-25 14:57:36
 */

namespace {
/**
 * PB_GameType enum
 */
final class PB_GameType
{
    const Game_None = -1;
    const Game_buyu = 1;
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
            'Game_Max' => self::Game_Max,
        );
    }
}
}