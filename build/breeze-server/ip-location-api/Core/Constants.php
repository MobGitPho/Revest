<?php

namespace API\IpLocation\Core;

abstract class Constants
{
    const IP_INFO_API_KEYS = [
        '318d30e42618d0',
        '57684c6b63693e',
        '45f5af4157a78a'
    ];

    const IP_DATA_API_KEYS = [
        '71c795fdde2765485e67f6331c0964d5b2294045753cd42cfb7fff6d',
        '51a5e77b62ea7c3162fe3c5e1d9c5a2a0d42d2c4e07cf0af051333a7',
        '02d28766a003f0112a945d558baffe756c01b1cc30231dc28bfe5094'
    ];

    public static function getIpDataApiKeysIndex()
    {
        return rand(0, count(self::IP_DATA_API_KEYS) - 1);
    }

    public static function getIpInfoApiKeysIndex()
    {
        return rand(0, count(self::IP_INFO_API_KEYS) - 1);
    }
}
