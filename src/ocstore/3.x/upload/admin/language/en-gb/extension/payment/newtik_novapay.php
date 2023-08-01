<?php
//Global

$_['text_url_site']    = 'https://newtik-opencart.com/';
$_['text_COPYRIGTHSHOW'] = "<svg height='12' viewBox='0 0 323 74' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M42.5078 2H54.0078V72H45.0078L12.0078 24.5V72H0.507813V2H9.50781L42.5078 49.5V2ZM75.7883 51.6C76.5883 55.4 78.4216 58.3333 81.2883 60.4C84.1549 62.4 87.6549 63.4 91.7883 63.4C97.5216 63.4 101.822 61.3333 104.688 57.2L113.588 62.4C108.655 69.6667 101.355 73.3 91.6883 73.3C83.5549 73.3 76.9883 70.8333 71.9883 65.9C66.9883 60.9 64.4883 54.6 64.4883 47C64.4883 39.5333 66.9549 33.3 71.8883 28.3C76.8216 23.2333 83.1549 20.7 90.8883 20.7C98.2216 20.7 104.222 23.2667 108.888 28.4C113.622 33.5333 115.988 39.7667 115.988 47.1C115.988 48.2333 115.855 49.7333 115.588 51.6H75.7883ZM75.6883 42.8H105.088C104.355 38.7333 102.655 35.6667 99.9883 33.6C97.3883 31.5333 94.3216 30.5 90.7883 30.5C86.7883 30.5 83.4549 31.6 80.7883 33.8C78.1216 36 76.4216 39 75.6883 42.8ZM181.138 22H192.538L176.838 72H166.238L155.838 38.3L145.338 72H134.738L119.038 22H130.438L140.138 56.5L150.638 22H160.938L171.338 56.5L181.138 22ZM246.691 2V13H226.991V72H215.491V13H195.691V2H246.691ZM264.695 12.5C263.362 13.8333 261.762 14.5 259.895 14.5C258.029 14.5 256.395 13.8333 254.995 12.5C253.662 11.1 252.995 9.46666 252.995 7.59999C252.995 5.73333 253.662 4.13333 254.995 2.8C256.329 1.4 257.962 0.699994 259.895 0.699994C261.829 0.699994 263.462 1.4 264.795 2.8C266.129 4.13333 266.795 5.73333 266.795 7.59999C266.795 9.46666 266.095 11.1 264.695 12.5ZM254.495 72V22H265.295V72H254.495ZM322.035 72H309.135L288.635 48.9V72H277.835V2H288.635V44.1L308.035 22H321.235L299.235 46.5L322.035 72Z' fill='url(#paint0_linear_412_2)'/><defs><linearGradient id='paint0_linear_412_2' x1='-7' y1='37.0083' x2='323' y2='37.0083' gradientUnits='userSpaceOnUse'><stop stop-color='#3B5D8A'/><stop offset='1' stop-color='#02B1FB'/></linearGradient></defs></svg>";
$_['text_COPYRIGTH'] = 'NewTik';
$_['text_COPYRIGTHSHOWLINK'] = '<a href="'.$_['text_url_site'] .'" target="_blank">'.$_['text_COPYRIGTHSHOW'].'</a>';

//Global Module
$_['text_heading_name']    = 'NovaPay';
$_['text_url_module']    = $_['text_url_site'] . '';

$utm = '?utm_medium=MyModule&utm_source='.urlencode($_['text_heading_name']);
$_['text_url_site'] .= $utm;
$_['text_url_module'] .= $utm;

$_['text_heading_title']    = $_['text_COPYRIGTHSHOW'] . ' <b>'.$_['text_heading_name'].'</b>';
$_['text_heading_form_title'] = $_['text_heading_name'] . ' ' . $_['text_COPYRIGTH'];
$_['heading_title'] = $_['text_heading_title'] ;


//type_extension == payment
$_['text_newtik_novapay'] = '<img src="/image/payment/newtik_novapay.png" alt="" title="" style="border: 1px solid #EEEEEE;" />';

//support
$_['text_support_email'] = '';
$_['text_support_telegram'] = '';
$_['text_support_phone'] = '';

$_['text_button_apply']     = 'Застосувати';//Применить

// Text
$_['text_extension']   = 'Розширення';
$_['text_success_save']     = 'Налаштування збережено!';
$_['text_success_cache_clear']     = 'Кеш очищено';
$_['text_store']        = 'Налаштування для магазину:';

$_['text_button_cache_clear']     = 'Очищення кеша';

$_['text_setting_basic']        = 'Завантажте основні налаштування';
$_['text_setting_export']        = 'Експортувати налаштування';
$_['text_setting_import']        = 'Налаштування імпорту';


$_['text_zamanuha']        = 'Ще більше модулів для Opencart на нашому сайті';

//Tab General
$_['text_tab_general']      = 'Загальні';



// Error
$_['text_error_permission'] = 'Попередження: у вас немає дозволу на зміни '.$_['text_heading_form_title'].' module!';

