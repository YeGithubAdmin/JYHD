<?php
/**
 * Auto generated from PB_usr_rpc.proto at 2017-09-05 00:47:23
 *
 * protos package
 */

namespace Protos {
/**
 * UsrDataOpt enum
 */
final class UsrDataOpt
{
    const Request_All = 1;
    const Request_Player = 2;
    const Request_Account = 3;
    const Modify_Account = 4;
    const Modify_Player = 5;
    const Clear_Email = 6;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Request_All' => self::Request_All,
            'Request_Player' => self::Request_Player,
            'Request_Account' => self::Request_Account,
            'Modify_Account' => self::Modify_Account,
            'Modify_Player' => self::Modify_Player,
            'Clear_Email' => self::Clear_Email,
        );
    }
}
}