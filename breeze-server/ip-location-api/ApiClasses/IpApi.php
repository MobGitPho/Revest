<?php

namespace API\IpLocation\ApiClasses;

class IpApi
{
	var $host = 'https://ipapi.co/{IP}/json/';

	//initiate the IpApi vars
	var $ip = null;
	var $version = null;
	var $city = null;
	var $region = null;
	var $region_code = null;
	var $country_code = null;
	var $country_code_iso3 = null;
	var $country_name = null;
	var $country_capital = null;
	var $country_tld = null;
	var $continent_code = null;
	var $in_eu = null;
	var $postal = null;
	var $latitude = null;
	var $longitude = null;
	var $timezone = null;
	var $currency = null;
	var $currency_name = null;
	var $asn = null;
	var $org = null;

	function __construct()
	{
	}

	function locate($ip = null)
	{
		global $_SERVER;

		if (is_null($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$host = str_replace('{IP}', $ip, $this->host);

		$data = array();

		$response = $this->fetch($host);

		$data = unserialize($response);

		//set the IpApi vars
		$this->ip = $ip;
		$this->version = $data['version'];
		$this->city = $data['city'];
		$this->region = $data['region'];
		$this->region_code = $data['region_code'];
		$this->country_code = $data['country_code'];
		$this->country_code_iso3 = $data['country_code_iso3'];
		$this->country_name = $data['country_name'];
		$this->country_capital = $data['country_capital'];
		$this->country_tld = $data['country_tld'];
		$this->continent_code = $data['continent_code'];
		$this->in_eu = $data['in_eu'];
		$this->postal = $data['postal'];
		$this->latitude = $data['latitude'];
		$this->longitude = $data['longitude'];
		$this->timezone = $data['timezone'];
		$this->currency = $data['currency'];
		$this->currency_name = $data['currency_name'];
		$this->asn = $data['asn'];
		$this->org = $data['org'];
	}

	function fetch($host)
	{
		if (function_exists('curl_init')) {

			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch);
			curl_close($ch);
		} else if (ini_get('allow_url_fopen')) {

			//fall back to fopen()
			$response = file_get_contents($host);
		} else {

			trigger_error('IpApi class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		}

		return $response;
	}
}
