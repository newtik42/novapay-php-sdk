<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2020-.					          */
/* 	@support	https://newtik-opencart.com/			  */
/* 	@license	LICENSE.txt								  */
/* * ******************************************************* */

namespace Payment\RozetkaPay\Model;

final class OperationStatus {
    const init = 'init';
    const pending = 'pending';
    const success = 'success';
    const failure = 'failure';
}
