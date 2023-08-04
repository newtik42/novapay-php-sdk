<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2023 					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\NovaPay;

use NewTik\NovaPay\HttpClient\ClientInterface;

class Configuration {
    
    private static $merchant_id = 1;
    
    private static $private_key;
    
    private static $public_key;
    
    public static function getMerchant_id() {
        return self::$merchant_id;
    }

    public static function getPrivate_key() {
        return self::$private_key;
    }

    public static function getPublic_key() {
        return self::$public_key;
    }

    public static function setMerchant_id($merchant_id) {
        self::$merchant_id = $merchant_id;
    }

    public static function setPrivate_key($private_key) {
        self::$private_key = openssl_pkey_get_private($private_key);
    }

    public static function setPublic_key($public_key) {
        self::$public_key = openssl_pkey_get_public($public_key);
    }

        
    public static function setDev() {    
        self::$merchant_id = 1;
        self::$ApiUrl = 'api-qecom.novapay.ua';
        self::setPrivate_key(file_get_contents(__DIR__ . '/key/private_key.pem'));
        self::setPublic_key(file_get_contents(__DIR__ . '/key/public_key.pem'));        
    }
    
    /**
     * @var string Api version default 1.0
     */
    private static $ApiVersion = '1';
    
    /**
     * @var string Api endpoint url
     */
    private static $ApiUrl = 'api.novapay.ua';
    
    /**
     * @var string Api endpoint path
     */
    private static $ApiPath = '';
    
    
    private static $callbackUrl = '';
    
    public static function getCallbackUrl() {
        return self::$callbackUrl;
    }

    public static function getResultUrl() {
        return self::$resultUrl;
    }
    
    private static $resultUrl = '';
    
    public static function setCallbackUrl($callbackUrl) {
        self::$callbackUrl = $callbackUrl;
    }

    public static function setResultUrl($resultUrl) {
        self::$resultUrl = $resultUrl;
    }
    

    /**
     * @var string request Client
     */
    private static $HttpClient = 'HttpCurl';
    
    
    
    /**
     * @return string The API version used for requests. Default is v1.0
     */
    public static function getApiVersion() {
        return self::$ApiVersion;
    }
    
    /**
     * @return string The API version used for requests. Default is v1.0
     */
    public static function getApiVersionUrl() {
        return '/v' . self::$ApiVersion;
    }

    /**
     * @param $ApiVersion
     * @return string
     * @set string ApiVersion The API version to use for requests.
     */
    public static function setApiVersion($ApiVersion) {
        $versions = ['1'];
        if (!in_array($ApiVersion, $versions)) {
            trigger_error('Undefined version! Available versions: \'1\'', E_USER_NOTICE);
            return self::$ApiVersion = '1';
        }
        return self::$ApiVersion = $ApiVersion;
    }

    /**
     * @return string ApiUrl The API url to use for requests. Default is api.fondy.eu
     */
    public static function getApiUrl() {
        return 'https://' . self::$ApiUrl . self::$ApiPath;
    }

    /**
     * @param $ApiUrl
     * @set string ApiUrl The API url to use for requests.
     */
    public static function setApiUrl($ApiUrl) {
        self::$ApiUrl = $ApiUrl;
    }

    /**
     * @return string
     */
    public static function getHttpClient() {
        return self::setHttpClient(self::$HttpClient);
    }

    /**
     * @param $client
     * @return string
     */
    public static function setHttpClient($client) {
        if (is_string($client)) {
            $HttpClient = '\\NewTik\\NovaPay\\HttpClient\\' . $client;
            if (class_exists($HttpClient)) {
                return self::$HttpClient = new $HttpClient();
            }
        } elseif ($client instanceof ClientInterface) {
            return self::$HttpClient = $client;
        }
        trigger_error('Client Class not found or name set up incorrectly. Available clients: HttpCurl, HttpGuzzle', E_USER_NOTICE);
        $HttpClient = '\\NewTik\\NovaPay\\HttpClient\\HttpCurl';
        return self::$HttpClient = new $HttpClient();
    }
    

}
