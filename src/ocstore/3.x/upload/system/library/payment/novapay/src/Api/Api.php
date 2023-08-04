<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\NovaPay\Api;

use NewTik\NovaPay\Configuration;
use NewTik\NovaPay\Exception\ApiException;
use NewTik\NovaPay\Helper;

class Api {

    protected $url = '';

    /**
     * @var string request client
     */
    protected $client;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    public function __construct() {

        $this->client = Configuration::getHttpClient();
    }

    /**
     * @param $method
     * @param $url
     * @param $headers
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function Request($method, $url, $headers = [], $params = []) {

        $result = [];

        $headers = [];
        $headers[] = 'Content-Type: application/json';
                
        if(isset($params->callback_url) && empty($params->callback_url)){
            $params->callback_url = Configuration::getCallbackUrl();
        }

        if(isset($params->result_url) && empty($params->result_url)){
            $params->result_url = Configuration::getResultUrl();
        }
        
        $params = (array)$params;
        
        $params['merchant_id'] = Configuration::getMerchant_id();
        
        $params = $this->toJSON($params);
        
        
        
//       $testData = '{"merchant_id":1,"client_first_name":"Иванов","client_last_name":"Иван","client_patronymic":"Иванович","client_phone":"+380982850654","metadata":{"lol":"kek"},"callback_url":"http://test.com"}';
//        echo($testData);
//        echo PHP_EOL;
//        echo($params);
//        echo PHP_EOL;
        $url = $this->createUrl($url);
        $headers[] = 'x-sign: ' . Helper\ApiHelper::generateSignature($params, Configuration::getPrivate_key());
        //$headers[] = 'x-sign: ' . Helper\ApiHelper::generateSignature($testData, Configuration::getPrivate_key());
        
        $response = $this->client->request($method, $url, $headers, $params);

        if (!$response) {
            throw new ApiException('Unknown error.');
        }

        $result['response'] = $this->jsonToArray($response);
        return $result;
    }

    /**
     * @param $url
     * @return string
     */
    protected function createUrl($url) {
        return Configuration::getApiUrl() . $this->url . Configuration::getApiVersionUrl() . $url;
    }

    /**
     * @param $data
     * @return string
     */
    public static function toJSON($data) {
        $data = (array)$data;
        foreach ($data as $key => $value) {
            if(empty($value)){
                unset($data[$key]);
            }
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    public static function jsonToArray($data) {
        return json_decode($data, TRUE);
    }

    protected function validate($params, $required, $dateFormat = '') {
        Helper\Validation::validateRequiredParams((array) $params, $required, $dateFormat);
    }

    /**
     * @param $params
     * @return mixed
     */
    protected function prepareParams($params) {

        $prepared_params = (array) $params;

        if (isset($prepared_params['merchant_data']) && is_array($prepared_params['merchant_data'])) {
            $prepared_params['merchant_data'] = Helper\ApiHelper::toJSON($prepared_params['merchant_data']);
        }

        if (isset($prepared_params['recurring_data']) && $this->version === '1.0')
            throw new \InvalidArgumentException('Reccuring_data allowed only for api version \'2.0\'');

        if (isset($prepared_params['reservation_data']) && is_array($prepared_params['reservation_data'])) {
            $prepared_params['reservation_data'] = base64_encode(Helper\ApiHelper::toJSON($prepared_params['reservation_data']));
        }

        return $prepared_params;
    }

    protected function externalIdToStr($external_id) {
        return "" . $external_id . "";
    }

}
