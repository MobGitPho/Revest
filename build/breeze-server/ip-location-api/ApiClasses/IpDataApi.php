<?php

namespace API\IpLocation\ApiClasses;

use API\IpLocation\Core\Constants;

use Ipdata\ApiClient\Ipdata;
use Symfony\Component\HttpClient\Psr18Client;
use Nyholm\Psr7\Factory\Psr17Factory;

class IpDataApi
{
    var $ipdata;
    var $httpClient;
    var $psr17Factory;

    //initiate the IpData vars
    var $ip;
    var $city;
    var $region;
    var $region_code;
    var $country_name;
    var $country_code;
    var $continent_name;
    var $continent_code;
    var $latitude;
    var $longitude;
    var $asn;
    var $calling_code;
    var $flag;
    var $languages;
    var $currency;
    var $timezone;

    function __construct()
    {
        $this->httpClient = new Psr18Client();
        $this->psr17Factory = new Psr17Factory();

        $this->ipdata = new Ipdata(Constants::IP_DATA_API_KEYS[Constants::getIpDataApiKeysIndex()], $this->httpClient, $this->psr17Factory);
    }

    function locate($ip = null)
    {
        global $_SERVER;

        if (is_null($ip)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $data = $this->ipdata->lookup($ip);

        if (isset($data) && isset($data['country_code'])) {
            //set the IpInfo vars
            $this->ip = $ip;
            $this->city = $data['city'];
            $this->region = $data['region'];
            $this->region_code = $data['region_code'];
            $this->country_name = $data['country_name'];
            $this->country_code = $data['country_code'];
            $this->continent_name = $data['continent_name'];
            $this->continent_code = $data['continent_code'];
            $this->latitude = $data['latitude'];
            $this->longitude = $data['longitude'];
            $this->asn = $data['asn'];
            $this->calling_code = $data['calling_code'];
            $this->flag = $data['flag'];
            $this->languages = $data['languages'];
            $this->currency = $data['currency']['name'];
            $this->timezone = $data['time_zone']['name'];
        }
    }
}
