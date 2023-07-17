<?php

namespace NewTik\system\helper;

class ConfigExtension {
    //put your code here
    
    public $menu;
    
    public $path = '';
    
    public $popap_modal = false;
    
    public $code = '';
    public $token = '';
    public $HTTPS_SERVER = HTTPS_SERVER;
    
    public function __construct() {
        $this->menu = new ConfigExtensionMenu();
    }
}


class ConfigExtensionMenu {
    
    public $buttons;
    
    public function __construct() {
        $this->buttons = new ConfigExtensionMenuButtons();
    }
}

class ConfigExtensionMenuButtons {
    public $setting_status = true;
    public $script_id = '';
    public $import = true;
    public $export = true;
    public $cache_clear = true;
}