<?php

namespace Payment\RozetkaPay\Model\Payment;

use Payment\RozetkaPay\Model;

use Payment\RozetkaPay\Model\TransactionDetails;

class ResponsesInfoSuccess extends Model\Model{
    
    //======================= purchased ============================================================
    /**
     * 
     * @var float
     */
    public $amount = 0;
    
    
    /**
     * 
     * @var bool
     */
    public $purchased;
    
    /**
     * 
     * @var array <Payment\RozetkaPay\Model\TransactionDetails>
     */
    public $purchase_details = array();
    
    //==============================================================================================
    
    //======================= canceled= ============================================================
    /**
     * 
     * @var float
     */
    public $amount_canceled = 0;
    
    
    /**
     * 
     * @var bool
     */
    public $canceled;
    
    /**
     * 
     * @var array <Payment\RozetkaPay\Model\TransactionDetails>
     */
    public $cancellation_details = array();
    
    //==============================================================================================
    
    /**
     * 
     * @var float
     */
    public $amount_confirmed = 0;    
    
    /**
     * 
     * @var bool
     */
    public $confirmed;
    
    /**
     * 
     * @var array <Payment\RozetkaPay\Model\TransactionDetails>
     */
    public $confirmation_details = array();
    
    //==============================================================================================
    
    /**
     * 
     * @var float
     */
    public $amount_refunded = 0;    
    
    /**
     * 
     * @var bool
     */
    public $refunded;
    
    /**
     * 
     * @var array <Payment\RozetkaPay\Model\TransactionDetails>
     */
    public $refund_details = array();
    
    //==============================================================================================
    
    /**
     * 
     * @var Payment\RozetkaPay\Model\UserAction
     */
    public $action;
    
    /**
     * 
     * @var bool
     */
    public $action_required;
    
    /**
     * 
     * @var string
     */
    public $currency = "UAH";
    
    
    /**
     * 
     * @var string <date-time>
     */
    public $created_at;
    
    /**
     * 
     * @var string
     */
    public $external_id;
    
    /**
     * 
     * @var string
     */
    public $id;
    
    /**
     * 
     * @var bool
     */
    public $receipt_url;
    
    
    public function __construct($data = []) {
        
        parent::__construct($data);
        
        if(isset($data['action']) && !empty($data['action'])){            
            $this->action = new \Payment\RozetkaPay\Model\UserAction($data['action']);            
        }
        
        if(isset($data['purchase_details']) && !empty($data['purchase_details'])){
            foreach ((array)$data['purchase_details'] as $detail) {
                $this->purchase_details = [];
                $this->purchase_details[] = new TransactionDetails($detail);      
            }
        }
        
        if(isset($data['confirmation_details']) && !empty($data['confirmation_details'])){
            $this->confirmation_details = [];
            foreach ((array)$data['confirmation_details'] as $detail) {
                $this->confirmation_details[] = new TransactionDetails($detail);      
            }
        }
        
        if(isset($data['cancellation_details']) && !empty($data['cancellation_details'])){
            $this->cancellation_details = [];
            foreach ((array)$data['cancellation_details'] as $detail) {
                $this->cancellation_details[] = new TransactionDetails($detail);      
            }
        }
        
        if(isset($data['refund_details']) && !empty($data['refund_details'])){
            $this->refund_details = [];
            foreach ((array)$data['refund_details'] as $detail) {
                $this->refund_details[] = new TransactionDetails($detail);      
            }
        }
    }
    
}
