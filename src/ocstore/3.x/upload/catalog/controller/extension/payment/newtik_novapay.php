<?php

class ControllerExtensionPaymentNewtikNovapay extends Controller {

    public function index() {
        $this->load->language('extension/module/newtik_novapay');
        
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['button_pay'] = $this->language->get('button_pay');
        
        $data['path'] = 'extension/module/newtik_novapay';

        return $this->load->view('extension/module/newtik_novapay', $data);
    }
    
    public function createPay() {
        
        
        
    }

}


