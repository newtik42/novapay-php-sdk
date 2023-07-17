<?php
/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */

namespace Payment\RozetkaPay\Model;

use Payment\RozetkaPay\Model;

class Customer extends Model\Model{
        
    /**
     * 
     * @var string
     */
    public $address = "";
    
    /**
     * 
     * @var string
     */
    public $city = "";
    
    /**
     * 
     * @var string
     */
    public $country = "";
    
    /**
     * 
     * @var string
     */
    public $email = "";
    
    /**
     * 
     * @var string
     */
    public $external_id = "";
    
    /**
     * 
     * @var string
     */
    public $first_name = "";
    
    /**
     * 
     * @var string
     */
    public $last_name = "";
    
    /**
     * 
     * @var string
     */
    public $patronym = "";    
    
    /**
     * 
     * @var string
     */
    public $phone = "";
    
    /**
     * 
     * @var string
     */
    public $postal_code = "";
    
}
