<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace RozetkaPay\Model\Payment;

class RequestUserDetails extends \RozetkaPay\Model\Model{
    
    /**
     * 
     * @var string
     */
    public $address = '';    
    
    /**
     * 
     * @var string
     */
    public $city = '';
    
    /**
     * 
     * @var string
     */
    public $country = '';
    
    /**
     * 
     * @var string
     */
    public $email = '';
    
    /**
     * 
     * @var string
     */
    public $external_id = '';

    /**
     * 
     * @var string
     */
    public $first_name = '';
    
    /**
     * 
     * @var string
     */
    public $last_name = '';
    
    /**
     * 
     * @var string
     */
    public $patronym = '';
    
    /**
     * 
     * @var string
     */
    public $payment_method;
    
    public function __construct($data = []) {
        parent::__construct($data);
        
        if(isset($data['payment_method']) && !empty($data['payment_method'])){            
            $this->payment_method = new \Payment\RozetkaPay\Model\UserAction($data['payment_method']);            
        }
        
    }
    
}
