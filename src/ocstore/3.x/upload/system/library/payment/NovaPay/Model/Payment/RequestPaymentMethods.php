<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace RozetkaPay\Model\Payment;

class RequestPaymentMethods extends \RozetkaPay\Model\Model {
    
    /**
     * required
     * @var RozetkaPay\Model\Payment\EnumPaymentMethodType
     */
    public $type;
    
    /**
     * 
     * @var RozetkaPay\Model\Payment\RequestPaymentMethod
     */
    public $apple_pay;    
    
    /**
     * 
     * @var RozetkaPay\Model\Payment\RequestPaymentMethod
     */
    public $google_pay;
    
    /**
     * 
     * @var RozetkaPay\Model\Payment\RequestPaymentMethod
     */
    public $cc_token;
    
    
    /**
     * 
     * @var RozetkaPay\Model\Payment\RequestPaymentMethod
     */
    public $wallet;
    
    
}
