<?php

class ControllerExtensionPaymentNewtikNovapay extends Controller {
    
    public $path = 'extension/payment/newtik_novapay';

    public function index() {
        $this->load->language($this->path);
        
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['button_pay'] = $this->language->get('button_pay');
        
        $data['path'] = $this->path;

        return $this->load->view($this->path, $data);
    }
    
    public function createPay() {
        
        
        
    }

}


