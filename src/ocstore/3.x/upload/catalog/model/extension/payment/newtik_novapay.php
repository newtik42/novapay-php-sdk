<?php

/* * ******************************************************* */
/* 	@copyright	NewTik 2023                                 */
/* 	@support	https://newtik-opencart.com/                */
/* 	@license	MIT                                         */
/* * ******************************************************* */

class ModelExtensionPaymentNewTikNovaPay extends Model {

    private $type = 'payment';
    private $code = 'newtik_novapay';
    private $path = 'extension/payment/newtik_novapay';
    private $prefix = 'payment_newtik_novapay_';
    private $token_name = 'user_token';
    
    public function getS($name) {
        
    }

    public function getMethod($address, $total) {

        $test = false;
        
        $setting = $this->config->get(['payment_newtik_novapay']);
        
        if (($setting['sandbox']['status']??'1') == "1" && isset($this->session->data[$this->token_name])) {
            $test = true;
        }
        
        $this->load->language($this->path);
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" .
                (int) $this->config->get('rozetkapay_geo_zone_id') . "' AND "
                . "country_id = '" . (int) $address['country_id'] . "' AND "
                . "(zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");
        
        if (empty(($setting['geo_zone_id']??''))) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        $method_data = array();

        if ($status) {

            $title = '';

            if (($setting['view']['icon']??'1') == "1") {
                $title .= '<img src="' . HTTPS_SERVER . 'image/payment/'.$this->code.'.png" height="32">';
            }

            if (($setting['view']['title_default']??'1') == "1") {
                
                $title .= $this->language->get('text_title');
                
            } else {
                
                $title .= $setting['view']['title'][$this->config->get('config_language_id')]??'';
                
                if (empty($title)) {                    
                    $title .= $this->language->get('text_title');                    
                }
            }

            if ($test) {
                $title .= '(Test)';
            }

            $method_data = array(
                'code' => $this->code,
                'title' => $title,
                'terms' => '',
                'sort_order' => ($setting['sort_order']??0)
            );
        }


        return $method_data;
    }

}
