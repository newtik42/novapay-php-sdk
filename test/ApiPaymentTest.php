<?php
include_once './../src/autoloader.php';

NewTik\API\NovaPay\Configuration::setDev();

$session_id = '54ad8b9d-0c36-437b-a8ad-3494a9b42aec';

$pay = new NewTik\API\NovaPay\Api\Payment();

$data = $pay->info($session_id);

echo '<pre>';
var_dump($data);
echo '</pre>';