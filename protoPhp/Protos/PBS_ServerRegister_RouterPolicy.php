<?php
/**
 * Auto generated from PB_server_common.proto at 2018-01-02 15:38:42
 *
 * protos package
 */

namespace Protos {
/**
 * RouterPolicy enum embedded in PBS_ServerRegister message
 */
final class PBS_ServerRegister_RouterPolicy
{
    const RoundRobin = 1;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'RoundRobin' => self::RoundRobin,
        );
    }
}
}