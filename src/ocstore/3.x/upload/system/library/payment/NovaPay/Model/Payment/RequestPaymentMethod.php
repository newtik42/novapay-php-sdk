<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace RozetkaPay\Model\Payment;

class AppleGooglePayRequestPaymentMethod extends \RozetkaPay\Model\Model{
    
    /**
     * 
     * @var RozetkaPay\Model\BrowserFingerprint
     */
    public $browser_fingerprint;
    
    /**
     * required
     * @var string
     */
    public $token;
    
    /**
     * 
     * @var bool
     */
    public $use_3ds_flow;
    
}
