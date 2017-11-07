<?php
/**
 * Auto generated from PB_base_data.proto at 2017-09-13 05:44:30
 */

namespace {
/**
 * Broadcast_Type enum embedded in PB_SysBroadcast message
 */
final class PB_SysBroadcast_Broadcast_Type
{
    const Broadcast_Vip = 1;
    const Broadcast_Gold = 2;
    const Broadcast_Yuquan = 3;
    const Broadcast_Item = 4;
    const Broadcast_Php = 5;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Broadcast_Vip' => self::Broadcast_Vip,
            'Broadcast_Gold' => self::Broadcast_Gold,
            'Broadcast_Yuquan' => self::Broadcast_Yuquan,
            'Broadcast_Item' => self::Broadcast_Item,
            'Broadcast_Php' => self::Broadcast_Php,
        );
    }
}
}