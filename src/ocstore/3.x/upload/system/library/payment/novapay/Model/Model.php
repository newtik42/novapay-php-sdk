<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace NewTik\API\NovaPay\Model;

class Model {
    public function __construct($data = []) {
        
        foreach ($this as $key => $value) {
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }
        
    }
}
