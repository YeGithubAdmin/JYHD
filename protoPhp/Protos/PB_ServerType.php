<?php
/**
 * Auto generated from PB_server_common.proto at 2017-11-29 17:29:42
 *
 * protos package
 */

namespace Protos {
/**
 * PB_ServerType enum
 */
final class PB_ServerType
{
    const S_HALL = 1;
    const S_GAME = 2;
    const S_DBAgent = 3;
    const S_GMTool = 4;
    const S_NUMERICAL = 5;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'S_HALL' => self::S_HALL,
            'S_GAME' => self::S_GAME,
            'S_DBAgent' => self::S_DBAgent,
            'S_GMTool' => self::S_GMTool,
            'S_NUMERICAL' => self::S_NUMERICAL,
        );
    }
}
}