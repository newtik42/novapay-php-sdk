<?php
include_once DIR_SYSTEM . 'library/newtik/autoloader.php';

class ControllerExtensionpaymentNewtikNovapay extends AdminModuleController {
    
    protected $code = 'newtik_novapay';
    protected $path = 'extension/payment/newtik_novapay';
    protected $type = 'payment';
    protected $version = '1.1.51';
    protected $setting;
    
    protected $mod_templeate_view_old = true;
    protected $sys_log_status = false;
    protected $eCron_status = false;

	public function index() {
		parent::index();
        
        $data['languages'] = $this->getLanguagesList();
        
        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        $data['order_statuses_'] = $data['order_statuses'];
        array_unshift($data['order_statuses'], ['order_status_id' => 0, 'name' => '---']);

        
        $this->viewOutputIndex($data ?? []);
	}
    
} 