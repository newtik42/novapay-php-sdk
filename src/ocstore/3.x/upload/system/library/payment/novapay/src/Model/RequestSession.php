<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\NovaPay\Model;

class RequestSession extends \NewTik\NovaPay\Model\Model {

    /**
     * var int
     */
    public $merchant_id = 1;
    
    /**
     * var string
     */
    public $client_first_name = '';
    
    /**
     * var string
     */
    public $client_last_name = '';
    
    /**
     * var string
     */
    public $client_patronymic = '';
    
    /**
     * var string
     */
    public $client_phone = '';
    
    /**
     * var string
     */
    public $client_email = '';
    
    /**
     * var object
     */
    public $metadata;
    
        
    /**
     * var string
     */
    public $success_url = '';
    
    /**
     * var string
     */
    public $fail_url = '';
    
    
    /**
     * var string
     */
    public $callback_url = '';
    
}
