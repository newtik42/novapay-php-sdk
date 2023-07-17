<?php

class ModelExtensionpaymentNewtikNovapay extends Model {
    
	public function addA($data) {
		
        
        
	}
    
    
    public function checkDB_table($table) {
        return (bool)$this->db->query("SELECT count(*) as `total` FROM INFORMATION_SCHEMA.COLUMNS  WHERE "
                . "table_name = '" . DB_PREFIX . $table ."' AND "
                . "table_schema = '".DB_DATABASE."'")->row['total'];
    }
    
    
    public function checkDB_table_column($table, $column) {
        return (bool)$this->db->query("SELECT count(*) as `total` FROM INFORMATION_SCHEMA.COLUMNS  WHERE "
                . "table_name = '" . DB_PREFIX . $table ."' AND "
                . "table_schema = '".DB_DATABASE."' AND "
                . "column_name = '".$column."'")->row['total'];        
    }
    
    public function addDB_table_column($table, $column) {
        if(!$this->checkDB_table_column($table, $column)){
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD `poster_id` int(11) NOT NULL default '0';");
        }
    }
    
    public function install() {  
        
        
        $hasPoster_id = $this->db->query("SELECT count(*) as `total` FROM INFORMATION_SCHEMA.COLUMNS  WHERE "
                . "table_name = '" . DB_PREFIX . "category' AND "
                . "table_schema = '".DB_DATABASE."' AND "
                . "column_name = 'poster_id'")->row['total'];
        
        if($hasPoster_id == "0"){
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD `poster_id` int(11) NOT NULL default '0';");
        }
        
        $this->db->query("CREATE TABLE IF NOT `" . DB_PREFIX . "newtik` (
            `guid` VARCHAR(38) NOT NULL COLLATE 'utf8_general_ci',
            `product_id` INT(11) NOT NULL,            
            PRIMARY KEY (`guid`) USING BTREE,
            UNIQUE INDEX `guid` (`guid`, `product_id`) USING BTREE
        )
        COLLATE='utf8_general_ci'
        ENGINE=MyISAM;");
        
        $this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."nt_dashboard_analytics_profit_expenses_to_orders` ( "
                . "`id` INT(11) NOT NULL AUTO_INCREMENT , "
                . "`order_id` INT(11) NOT NULL , "
                . "`name` VARCHAR(80) NOT NULL , "
                . "`formula` VARCHAR(100) NOT NULL , "
                . "`type` VARCHAR(20) NOT NULL , "
                . " PRIMARY KEY (`id`)) ENGINE = MyISAM;");
        
    }
}
