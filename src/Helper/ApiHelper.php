<?php

namespace NewTik\NovaPay\Helper;

use NewTik\NovaPay\Configuration;

class ApiHelper {

    /**
     * @var string sign separator
     */
    const signatureSeparator = '|';

    /**
     * @param array $params
     * @param $secret_key
     * @param string $version
     * @param bool $encoded
     * @return string
     */
    public static function generateSignature($params, $secret_key) {        
        openssl_sign($params, $signature, $secret_key, OPENSSL_ALGO_SHA1);
        //openssl_free_key($secret_key);
        return base64_encode($signature);        
    }

    /**
     * @param string $merchant_id
     * @return string
     */
    public static function generateOrderID($merchant_id) {
        return $merchant_id . '_' . md5(uniqid(rand(), 1));
    }



    /**
     * @param $data
     * @param string $wrap
     * @return string
     */
    public static function toXML($data, $wrap = '?xml version="1.0" encoding="UTF-8"?') {
        $xml = '';
        if ($wrap != null) {
            $xml .= "<$wrap>\n";
        }
        foreach ($data as $key => $value) {

            if (empty($value))
                continue;
            if (is_numeric($key))
                continue;
            $xml .= "<$key>";
            if (is_array($value)) {
                $child = self::toXML($value, null);
                $xml .= $child;
            } else {
                if (!is_array($value))
                    $xml .= htmlspecialchars(trim($value)) . "</$key>";
            }
        }
        if ($wrap != null) {
            $xml .= "\n</xml>\n";
        }

        return $xml;
    }

    /**
     * @param $data
     * @return string
     */
    public static function toJSON($data) {
        return json_encode($data);
    }

    /**
     * @param $data
     * @return string
     */
    public static function toFormData($data) {
        return http_build_query($data, NULL, '&');
    }

}
