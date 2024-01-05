<?php

namespace API\IpLocation\ApiClasses;

use ipinfo\ipinfo\IPinfo;

use API\IpLocation\Core\Constants;

class IpInfoApi
{
	var $ipinfo;

	//initiate the IpInfo vars
	var $ip;
	var $hostname;
	var $city;
	var $region;
	var $country;
	var $loc;
	var $org;
	var $postal;
	var $timezone;

	function __construct()
	{
		$this->ipinfo = new IPinfo(Constants::IP_INFO_API_KEYS[Constants::getIpInfoApiKeysIndex()]);
	}

	function locate($ip = null)
	{
		global $_SERVER;

		if (is_null($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$data = $this->ipinfo->getDetails($ip);

		if (isset($data)) {
			//set the IpInfo vars
			$this->ip = $ip;
			$this->hostname = $data->hostname;
			$this->city = $data->city;
			$this->region = $data->region;
			$this->country = $data->country;
			$this->loc = $data->loc;
			$this->org = $data->org;
			$this->postal = $data->postal;
			$this->timezone = $data->timezone;
		}
	}
}
