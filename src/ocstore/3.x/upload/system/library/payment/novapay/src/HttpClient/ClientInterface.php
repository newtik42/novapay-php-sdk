<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace NewTik\NovaPay\HttpClient;

interface ClientInterface {

    /**
     * @param $method
     * @param $url
     * @param $headers
     * @param $data
     * @return mixed
     * HttpClient Interface
     */
    public function request($method, $url, $headers, $data);
}
