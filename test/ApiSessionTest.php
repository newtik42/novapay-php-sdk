<?php
include_once './../src/autoloader.php';

NewTik\API\NovaPay\Configuration::setDev();

$session = new NewTik\API\NovaPay\Api\Session();

$params = new NewTik\API\NovaPay\Model\RequestSession();

$params->client_first_name = 'Иванов';
$params->client_last_name = 'Иван';
$params->client_patronymic = 'Иваноич';
$params->client_phone = '+380982850654';
$params->metadata = [];
$params->callback_url = '';

$data = $session->login($params);
echo '<pre>';
var_dump($data);
echo '</pre>';

$session_id = $data['response']['id'];
echo '<pre>';
var_dump($session_id);
echo '</pre>';


$dataPay = new NewTik\API\NovaPay\Model\RequestPayment();

$dataPay->session_id = $session_id;

$dataPay->amount = 50;

$dataPay->external_id = 'test 2';

$pay = new NewTik\API\NovaPay\Api\Payment();


$data = $pay->create($dataPay);

echo '<pre>';
var_dump($data);
echo '</pre>';

//
//die;
//
//
//$data = $session->logout($session_id);
//
//echo '<pre>';
//var_dump($data);
//echo '</pre>';