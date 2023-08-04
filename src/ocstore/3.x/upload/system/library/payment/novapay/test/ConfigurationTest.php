<?php
include_once './../src/autoloader.php';

use NewTik\API\NovaPay\Configuration;

$novapay = Configuration::getApiUrl() . Configuration::getApiVersionUrl();
echo '<pre>';
var_dump($novapay);
echo '</pre>';
die();