<?php

/**
 * Log class
 */

namespace NewTik\system\helper;

class Log {

    private $handle;
    private $filename;

    /**
     * Constructor
     *
     * @param	string	$filename
     */
    public function __construct($filename) {
        $this->filename = DIR_LOGS . $filename;
        $this->handle = fopen($this->filename, 'a');
    }

    /**
     * 
     *
     * @param	string	$message
     */
    public function write($message) {
        fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
    }

    public function getSize() {

        if (file_exists($this->filename)) {
            $size = filesize($this->filename);

            $suffix = array(
                'B',
                'KB',
                'MB',
                'GB',
                'TB',
                'PB',
                'EB',
                'ZB',
                'YB'
            );

            $i = 0;

            while (($size / 1024) > 1) {
                $size = $size / 1024;
                $i++;
            }
            
            return round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i];
        }
    }

    public function getFile() {
        if(file_exists($this->filename)){
            return file_get_contents($this->filename, FILE_USE_INCLUDE_PATH, null);
        }else{
            return '';
        }
    }
    
    public function clear() {
        $this->handle = fopen($this->filename, 'w+');
        fclose($this->handle);
        $this->handle = fopen($this->filename, 'a');
    }
    
    public function download() {
        
		if (file_exists($this->filename) && filesize($this->filename) > 0) {
			header('Pragma: public');
			header('Expires: 0');
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($this->filename) . '_' . date('Y-m-d_H-i-s', time()) . '.log.txt"');
			header('Content-Transfer-Encoding: binary');
            echo file_get_contents($this->filename, FILE_USE_INCLUDE_PATH, null);
            return true;
		} else {
			return false;
		}
	}

    /**
     * 
     *
     */
    public function __destruct() {
        fclose($this->handle);
    }

}
