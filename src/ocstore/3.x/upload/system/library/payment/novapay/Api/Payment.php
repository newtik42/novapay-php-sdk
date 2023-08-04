<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */
namespace NewTik\API\NovaPay\Api;

class Payment extends \NewTik\API\NovaPay\Api\Api{
    
    protected $url = '';
    
    public function info($session_id) {
        
//        $requiredParams = [
//            'external_id' => 'string',
//        ];
//        
//        $params->external_id = $this->externalIdToStr($params->external_id);
//
//        $this->validate($requiredParams, $this->requiredParams);
        
        return $this->Request('POST', "/get-status", [], ["session_id" => $session_id]);
    }

    /**
     * 
     * @param RozetkaPay\Model\Payment\CreateRequest $param
     * @return type
     */
    public function create($params) {

//        $requiredParams = [
//            'amount' => 'int',
//            'currency' => 'string',
//            'external_id' => 'string',
//            'mode' => 'string',
//        ];
//        
//        $params->external_id = $this->externalIdToStr($params->external_id);
//
//        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/payment", [], $params);
    }

    public function confirm($params) {
        
//        $requiredParams = [
//            'external_id' => 'string',
//        ];
//        
//        $params->external_id = $this->externalIdToStr($params->external_id);
//
//        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/confirm", [], $params);
    }
    
    public function cancel($params) {
        
//        $requiredParams = [
//            'external_id' => 'string',
//        ];
//        
//        $params->external_id = $this->externalIdToStr($params->external_id);
//
//        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/cancel", [], $params);
    }

    public function refund($params) {
        
//        $requiredParams = [
//            'external_id' => 'string',
//        ];
//        
//        $params->external_id = $this->externalIdToStr($params->external_id);
//
//        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/refund", [], $params);
    }
    
    
    
}
