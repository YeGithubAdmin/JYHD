<?php
/**
 * Auto generated from PB_base_data.proto at 2017-12-06 14:11:24
 */

namespace {
/**
 * Attr_Type enum embedded in PB_Attr message
 */
final class PB_Attr_Attr_Type
{
    const player_level = 1;
    const exp = 2;
    const vip_exp = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'player_level' => self::player_level,
            'exp' => self::exp,
            'vip_exp' => self::vip_exp,
        );
    }
}
}