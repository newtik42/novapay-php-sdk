<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\NovaPay\Model;

class Model {
    public function __construct($data = []) {
        
        foreach ($this as $key => $value) {
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }
        
    }
}
