<?php

namespace Application\Util;

class HttpClient
{

    /**
     * @param $url string
     * @return array
     */
    public function get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return array(
            "statusCode" => $httpStatusCode,
            "data" => $data
        );
    }

    /**
     * @param $url string
     * @param $data array
     * @return array
     */
    public function post($url, $data, $userPwd = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if($userPwd!=null) {
            curl_setopt($curl, CURLOPT_USERPWD, $userPwd);
        }
        $data = curl_exec($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return array(
            "statusCode" => $httpStatusCode,
            "data" => $data
        );
    }
    
    /**
     * @param $url string
     * @return array
     */
    public function delete($url, $userPwd = null) {
    	$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($curl, CURLOPT_POST, true);
    	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    	if($userPwd!=null) {
    		curl_setopt($curl, CURLOPT_USERPWD, $userPwd);
    	}
    
    	$data = curl_exec($curl);
    	$httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    	curl_close($curl);
    	return array(
    			"statusCode" => $httpStatusCode,
    			"data" => $data
    	);
    }
}