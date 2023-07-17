<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace RozetkaPay\Model\Payment;

class CreateRequest {
    
    /**
     * 
     * @var int
     */
    public $amount = 0;
    
    /**
     * 
     * @var string
     */
    public $callback_url = '';
    
    /**
     * 
     * @var string
     */
    public $result_url = '';
    
    public $confirm = true;
    
    /**
     * 
     * @var string
     */
    public $currency = 'UAH';
    
    public $customer;
    
    /**
     * 
     * @var string
     */
    public $description = '';
    
    /**
     * 
     * @var string
     */
    public $external_id = '';
    
    /**
     * 
     * @var string
     */
    public $payload = '';
    
    public $products;
    
    public $properties;
    
    public $recipient;
    
    /**
     * 
     * @var string
     */
    public $mode = 'hosted'; //direct or hosted    
    
    
}
