<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace RozetkaPay\Api;

class Payment extends \RozetkaPay\Api\Api {

    protected $url = '/payments';
    
    public function info($params) {
        
        $requiredParams = [
            'external_id' => 'string',
        ];
        
        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($requiredParams, $this->requiredParams);
        
        return $this->Request('POST', "/confirm", [], $params);
    }

    /**
     * 
     * @param RozetkaPay\Model\Payment\CreateRequest $param
     * @return type
     */
    public function create($params) {

        $requiredParams = [
            'amount' => 'int',
            'currency' => 'string',
            'external_id' => 'string',
            'mode' => 'string',
        ];
        
        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);

        return $this->Request('POST', "/new", [], $params);
    }

    public function confirm($params) {
        
        $requiredParams = [
            'external_id' => 'string',
        ];
        
        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/confirm", [], $params);
    }
    
    public function cancel($params) {
        
        $requiredParams = [
            'external_id' => 'string',
        ];
        
        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/cancel", [], $params);
    }

    public function refund($params) {
        
        $requiredParams = [
            'external_id' => 'string',
        ];
        
        $params->external_id = $this->externalIdToStr($params->external_id);

        $this->validate($params, $requiredParams);
        
        return $this->Request('POST', "/refund", [], $params);
    }

}
