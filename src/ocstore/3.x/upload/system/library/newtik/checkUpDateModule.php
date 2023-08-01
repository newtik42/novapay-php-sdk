<?php

namespace NewTik;

class checkUpDateModule {
    
    public $classVersion = '3.0.0';

    private $version_v_major = 1;
    private $version_v_minor = 1;
    private $version_v_path = 1;
    private $base_url = 'https://raw.githubusercontent.com/newtik42/opencartdata/master/updata/';
    private $versType = 'v1';
    private $version_core = 'opencart';
    private $version = VERSION;
    private $language = 'uk-ua';
    
    public $chmod_dir = 0750; 
    
    public $chmod_file = 0640;

    public function setLanguage($language): void {
        $this->language = $language;
    }

    public function __construct($base_url = 'https://raw.githubusercontent.com/newtik42/opencartdata/master/updata/', $versType = 'v1') {
        $this->version = $this->getVersion($this->version);
        $this->checkVersionCode();
        
//        $this->chmod_dir = fileperms(DIR_APPLICATION); 
//        $this->chmod_file = fileperms(DIR_APPLICATION.'index.php');
    }

    public function checkVersionCode() {
        if (defined('VERSION_CORE')) {
            $this->version_core = strtolower(VERSION_CORE);
        }
    }

    public function checkUpDate(string $module_code, string $module_version) {

        if ($this->versType == "v1") {
            return $this->checkUpDate_VTv1($module_code, $module_version);
        }

        return 'text_not_supported_anymore';
    }

    public function sendRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function checkUpDate_VTv1(string $module_code, string $module_version) {

//        if (file_exists(self::base_url . 'modules/' . $module_code . '.json')) {
        $content = $this->sendRequest($this->base_url . 'modules/' . $module_code . '.json');

//        }else{
//            return '';
//        }

        $json = [];
        if (!empty($content)) {
            $json = json_decode($content, true);
        } else {
            return '';
        }

        $module_version = $this->getVersion($module_version);

        $AccumulatedChanges = [];
        $AccumulatedChangesVersions = [];

        if (isset($json['list'])) {
            foreach ($json['list'] as $pac) {

                $break = false;

                $pac_versions = $this->getVersion((isset($pac['version'])?$pac['version']:'1.0.0'));

                if ($pac_versions <= $module_version) {
                    continue;
                }

                if (isset($pac['cores'])) {

                    foreach ($pac['cores'] as $core) {

                        if ($core['name'] == "*" || $core['name'] == $this->version_core) {

                            if (isset($core['versions'])) {
                                foreach ($core['versions'] as $version) {

                                    if ($this->hasVersion($version)) {
                                        $break = true;
                                        break;
                                    }
                                }
                            }
                        }

                        if ($break) {
                            break;
                        }
                    }
                }

                if ($break) {

                    if (isset($pac['description']) && isset($pac['description'][$this->language])) {
                        $pac['description'] = $pac['description'][$this->language];
                    } else {
                        $pac['description'] = [];
                    }

                    if (isset($pac['add']) && isset($pac['add'][$this->language])) {
                        $pac['add'] = $pac['add'][$this->language];
                    } else {
                        $pac['add'] = [];
                    }

                    if (isset($pac['fix']) && isset($pac['fix'][$this->language])) {
                        $pac['fix'] = $pac['fix'][$this->language];
                    } else {
                        $pac['fix'] = [];
                    }

                    $AccumulatedChanges[$pac['version']] = $pac;
                    $AccumulatedChangesVersions[] = $pac['version'];
                }
            }
        }

        sort($AccumulatedChangesVersions);
        $AccumulatedChangesVersions = array_reverse($AccumulatedChangesVersions);
        $AccumulatedChanges_ = [];
        foreach ($AccumulatedChangesVersions as $AccumulatedChangesVersion) {
            $AccumulatedChanges_[$AccumulatedChangesVersion] = $AccumulatedChanges[$AccumulatedChangesVersion];
        }

        return $AccumulatedChanges_;
    }

    private function getVersion($version) {
        return (int) str_replace('.', "", $version);
    }

    public function hasVersion($version) {

        $result = false;

        $version = str_replace('.', "", $version);

        $versions = explode('-', $version);

        if (count($versions) == 2) {

            $version_start = (int) str_replace('*', "0", $versions[0]);
            $version_end = (int) str_replace('*', "9", $versions[1]);
            return ($this->version >= $version_start && $this->version <= $version_end);
        } elseif (count($versions) == 1) {
            $version_start = (int) str_replace('*', "0", $versions[0]);
            $version_end = (int) str_replace('*', "9", $versions[0]);
            return ($this->version >= $version_start && $this->version <= $version_end);
        }

        return $result;
    }

    public function autoUpDate() {
        
    }

    public function groupVersion($version = false, $roject = 'opencart') {

        if ($version === false) {
            $version = $this->version;
        }

        if ($roject == 'opencart') {

            if ($this->hasVersion("2.0.*.*") && $this->hasVersion("2.1.*.*")) {
                return "2.0";
            }


            if ($this->hasVersion("2.2.*.*") && $this->hasVersion("2.3.*.*")) {
                return "2.2";
            }

            if ($this->hasVersion("3.*.*.*")) {
                return "3.0";
            }

            if ($this->hasVersion("4.*.*.*")) {
                return "4.0";
            }
        }
    }
    
    public function groupVersionLast($version = false, $build = 'opencart') {
        
        $group_version = $this->groupVersion($version, $build);

        if ($build == 'opencart') {

            switch ($group_version) {
                case "1.5":
                    return "1.5.6.4";
                    break;
                case "2.0":
                    return "2.1.0.2";
                    break;
                case "2.0":
                    return "2.3.0.2";
                    break;
                case "3.0":
                    return "3.0.3.8";
                    break;
                case "4.0":
                    return "4.0.1.1";
                    break;

                default:
                    break;
            }
            
            
        }
    }
    
    
    public function getSource($source = "https://raw.github.com/opencart/opencart/tree/", $project = "opencart", $version = false) {
        
        $project = strtolower($project);
        
        if($project == "opencart"){
            
            $source = "https://raw.githubusercontent.com/opencart/opencart/";            
            $source .= $this->groupVersionLast($version);            
            $source .= "/upload/";
            
        }elseif($project == "ocstore"){
            
            $source = "https://raw.githubusercontent.com/ocStore/ocStore/";            
            $source .= $this->groupVersionLast($version);            
            $source .= "/upload/";
            
        }elseif($project == "newtik\opencart_modules_update"){
            
            $source = 'https://raw.githubusercontent.com/newtik42/opencart_modules_update/main/';
            
        }
        
        return $source;
        
    }
    
    public function download($source, $files = []) {

        $this->errors = [];
        $results = [];
        foreach ($files as $key => $file) {
            
            $return = $this->simpleCURL($source . $file);
            
            $result = [];
            $result['status'] = '';
            $result['id'] = $key;
            $result['file'] = $file;
            if ($return->http_code == 200) {

                if (file_exists(DIR_OPENCART . $file)) {
                    $result['status'] = 'rewrite';
                    file_put_contents(DIR_OPENCART . $file, $return->data);
                } else {
                    
                    if(!file_exists(dirname(DIR_OPENCART.$file))){
                        mkdir(dirname(DIR_OPENCART.$file), 0777, true);
                    }
                    
                    file_put_contents(DIR_OPENCART . $file, $return->data);
                    chmod(DIR_OPENCART . $file, 0777);
                    $result['status'] = 'write';
                }
            } else {
                $result['status'] = 'error';
            }
            
            $results[$key] = $result;
        }
        
        return $results;
        
        
    }
    
    public function simpleCURL($url): Response_data {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            //CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        $retval = new Response_data($curl, $response);

        curl_close($curl);

        return $retval;
    }

}

class Response_data {

    public $data;
    public $http_code;
    public $headers;
    public $ip;
    public $curlErrors;
    public $method;
    public $timestamp;

    public function __construct(&$curl = false, $response = null) {

        if ($curl !== false) {
            $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $headerCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $ip = curl_getinfo($curl, CURLINFO_PRIMARY_IP);
            $curlErrors = curl_error($curl);
            $this->data = ($response);
            $this->http_code = (int) $headerCode;
            //$this->headers = $responseHeaders;
            $this->ip = $ip;
            $this->curlErrors = $curlErrors;
            //$this->method = 'GET: ' . $url;
            $this->timestamp = date('h:i:sP d-m-Y');
        }
    }

}
