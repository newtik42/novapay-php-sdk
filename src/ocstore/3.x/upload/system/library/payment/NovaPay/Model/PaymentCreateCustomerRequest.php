<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace Payment\RozetkaPay\Model;

use Payment\RozetkaPay\Model;

class PaymentCreateCustomerRequest extends Customer{
    
    /**
     * 
     * @var string
     */
    public $color_mode = "light";
    
    /**
     * 
     * @var string
     */
    public $locale = "";
    
    /**
     * 
     * @var string
     */
    public $account_number = "";
    
    /**
     * 
     * @var 
     */
    public $payment_method;
    
    
}
