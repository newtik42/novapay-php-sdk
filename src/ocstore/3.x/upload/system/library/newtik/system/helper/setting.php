<?php

namespace NewTik\system\helper;

class setting {
    
    private $registry;

    private $data = array();
    
    public function getStatus() {
        return $this->data['status']??false;
    }

    public function setStatus($status) {
        $this->data['status'] = $status;
    }

    
    /**
     * 
     *
     * @param	string	$key
     * @param	string	$value
     */
    public function set($key, $value) {
        if($key == 'status'){
            $this->setStatus($value);return;
        }
        $this->data[$key] = $value;
    }

    public function getArray() {
        return $this->data;
    }

    public function setArray($arrs) {
        
        if (gettype($arrs) == 'array') {
            foreach ($arrs as $key => $value) {
                if ($key == "status") {
                    
                    if($value == "1"){
                        $value = true;
                    }
                    if($value == "0"){
                        $value = false;
                    }
                    $this->setStatus($value);
                    
                }else{
                    $this->data[$key] = $value;
                }
            }
        }
        
    }

    /**
     * 
     *
     * @param	string	$key
     *
     * @return	mixed
     */
    public function has($key) {
        return isset($this->data[$key]);
    }

    public function __construct($registry = null, $config_name = '') {
        
        if(!empty($registry)){
            $this->registry = $registry;
            if(!empty($config_name)){
                $setting = $this->registry->get('config')->get($config_name);
                $this->setArray($setting);
            }
        }
        
        if (gettype($this->data) == 'string') {
            $this->data = json_decode($this->data, true);
        }
    }

    public function __get($key) {
        if($key == 'status'){
            return $this->getStatus();
        }
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

}
