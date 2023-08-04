<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\API\NovaPay\Model;

class RequestPayment extends \NewTik\API\NovaPay\Model\Model {

    /**
     * var int
     */
    public $merchant_id = 1;
    
    /**
     * var string
     */
    public $session_id;
        
    /**
     * var string
     */
    public $external_id;
    
    /**
     * var float
     */
    public $amount;
    
    /**
     * var int
     */
    public $identifier;
    
    /**
     * var array
     */
    public $products = [];
    
    /**
     * var bool
     */
    public $use_hold;
    
    /**
     * var int
     */
    public $delivery;    
    
}
