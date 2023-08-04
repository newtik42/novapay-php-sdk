<?php

class ControllerExtensionPaymentNewtikNovapay extends Controller {

    public function index() {
        $this->load->language('extension/module/newtik_novapay');
        
        

        return $this->load->view('extension/module/newtik_novapay', $data);
    }
    
    public function getSetting() {
        $this->config->get('sdfsdf');
        //$results = 
        
    }

}


