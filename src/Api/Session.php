<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */
namespace NewTik\NovaPay\Api;

class Session extends \NewTik\NovaPay\Api\Api{
    
    protected $url = '';
    
    public function login($params) {
        
        $requiredParams = [
            'client_phone' => 'string',
        ];

        //$this->validate($requiredParams, $params);
        
        return $this->Request('POST', "/session", [], $params);
        
    }
    
    public function logout($session_id) {
                
        return $this->Request('POST', "/expire", [], ['session_id' => $session_id]);
        
    }
    
    
    
}
