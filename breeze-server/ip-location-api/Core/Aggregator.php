<?php

namespace API\IpLocation\Core;

use API\IpLocation\ApiClasses\{
    GeoPluginApi,
    IpDataApi,
    IpInfoApi
};

class Aggregator
{
    const GEO_PLUGIN_SRC = 'geoplugin';
    const IP_INFO_SRC = 'ipinfo';
    const IP_DATA_SRC = 'ipdata';

    private $source;
    private $ipAddress;

    function __construct($ipAddress, $source = 'auto')
    {
        $this->ipAddress = $ipAddress;
        $this->source = $source;
    }

    public function fetchIpLocation()
    {
        $errorMsg = 'Unable to find IP Geolocation';

        switch (strtolower($this->source)) {
            case self::GEO_PLUGIN_SRC:
                $result = $this->fetchFromGeoPlugin();

                if (empty($result)) return $errorMsg;

                return $result;

                break;

            case self::IP_INFO_SRC:
                $result = $this->fetchFromIpInfo();

                if (empty($result)) return $errorMsg;

                return $result;

                break;

            case self::IP_DATA_SRC:
                $result = $this->fetchFromIpData();

                if (empty($result)) return $errorMsg;

                return $result;

                break;

            default:
                $geoPluginResult = $this->fetchFromGeoPlugin();

                if (empty($geoPluginResult)) {

                    $ipInfoResult = $this->fetchFromIpInfo();

                    if (empty($ipInfoResult)) {

                        $ipDataResult = $this->fetchFromIpData();

                        if (empty($ipDataResult)) return $errorMsg;

                        return $ipDataResult;
                    }

                    return $ipInfoResult;
                }

                return $geoPluginResult;
        }
    }

    private function fetchFromGeoPlugin()
    {
        $geoplugin = new GeoPluginApi();

        $geoplugin->locate($this->ipAddress);

        if (isset($geoplugin->countryCode)) {
            return [
                'ip' => $geoplugin->ip,
                'latitude' => $geoplugin->latitude,
                'longitude' => $geoplugin->longitude,
                'continent' => $geoplugin->continentName,
                'country' => $geoplugin->countryName,
                'region' => $geoplugin->regionName,
                'city' => $geoplugin->city,
                'iso' => $geoplugin->countryCode,
                'timezone' => $geoplugin->timezone,
                'currency' => $geoplugin->currencyCode,
                'source' => self::GEO_PLUGIN_SRC
            ];
        }

        return [];
    }

    private function fetchFromIpInfo()
    {
        $ipInfo = new IpInfoApi();

        $ipInfo->locate($this->ipAddress);

        if (isset($ipInfo->country)) {
            return [
                'ip' => $ipInfo->ip,
                'latitude' => explode(',', $ipInfo->loc)[0],
                'longitude' => explode(',', $ipInfo->loc)[1],
                'continent' => '',
                'country' => $ipInfo->country,
                'region' => $ipInfo->region,
                'city' => $ipInfo->city,
                'iso' => $ipInfo->country,
                'timezone' => $ipInfo->timezone,
                'currency' => '',
                'source' => self::IP_INFO_SRC
            ];
        }

        return [];
    }

    private function fetchFromIpData()
    {
        $ipData = new IpDataApi();

        $ipData->locate($this->ipAddress);

        if ($ipData->country_code) {
            return [
                'ip' => $ipData->ip,
                'latitude' => $ipData->latitude,
                'longitude' => $ipData->longitude,
                'continent' => $ipData->continent_name,
                'country' => $ipData->country_name,
                'region' => $ipData->region,
                'city' => $ipData->city,
                'iso' => $ipData->country_code,
                'timezone' => $ipData->timezone,
                'currency' => $ipData->currency,
                'source' => self::IP_DATA_SRC
            ];
        }

        return [];
    }
}
