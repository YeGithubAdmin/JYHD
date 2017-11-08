<?php
/**
 * Auto generated from PB_server_common.proto at 2017-11-07 17:09:46
 *
 * protos package
 */

namespace Protos {
/**
 * Ret enum embedded in PBS_ServerRegisterReturn message
 */
final class PBS_ServerRegisterReturn_Ret
{
    const Ret_OK = 1;
    const Ret_RepeatedRegister = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'Ret_OK' => self::Ret_OK,
            'Ret_RepeatedRegister' => self::Ret_RepeatedRegister,
        );
    }
}
}