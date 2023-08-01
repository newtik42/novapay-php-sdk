<?php
include_once DIR_SYSTEM . 'library/newtik/autoloader.php';

class ControllerExtensionpaymentNewtikNovapay extends AdminModuleController {
    
    protected $code = 'newtik_novapay';
    protected $path = 'extension/payment/newtik_novapay';
    protected $type = 'payment';
    protected $version = '1.1.10';
    protected $setting;
    
    protected $mod_templeate_view_old = true;
    protected $sys_log_status = false;
    protected $eCron_status = false;

	public function index() {
		parent::index();

        
        $this->viewOutputIndex($data ?? []);
	}
    
} 