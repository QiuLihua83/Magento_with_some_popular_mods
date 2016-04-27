<?php

$installer = $this;
if ($installer->getConnection()->isTableExists($this->getTable('autocompleteplus_batches'))) {
    try{
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $_tableprefix = (string)Mage::getConfig()->getTablePrefix();
        $query = 'SHOW FIELDS FROM  `'.$_tableprefix.'autocompleteplus_batches` WHERE Field = \'update_date\'';
    //     $query = 'DESCRIBE `'.$_tableprefix.'autocompleteplus_batches`'.' \'update_date\'';
        
        $result = $read->fetchAll($query);
        if (!empty($result) && array_key_exists('Type', $result[0])){
            if (!(substr($result[0]['Type'], 0, 3) == 'int')){     // check if variable 'update_date' type is not Integer
                
                $installer->startSetup();
                // rebuild the autocompleteplus_batches table
                $res=$installer->run("
                    DROP TABLE IF EXISTS {$this->getTable('autocompleteplus_batches')};
                    
                    CREATE TABLE IF NOT EXISTS {$this->getTable('autocompleteplus_batches')} (
                       `id` int(11) NOT NULL auto_increment,
                       `product_id` INT NULL,
                       `store_id` INT NOT NULL,
                       `update_date` INT DEFAULT NULL,
                       `action` VARCHAR( 255 ) NOT NULL,
                       `sku` VARCHAR( 255 ) NOT NULL,
                       PRIMARY KEY  (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
                    
                ");
                $installer->endSetup();
            }
        }
    } catch (Exception $e) {
        $errMsg = $e->getMessage();
        Mage::log('Install failed with a message: ' . $errMsg, null, 'autocomplete.log',true);
        
        $command = "http://magento.instantsearchplus.com/install_error";
        $helper = Mage::helper('autocompleteplus_autosuggest');
        //getting site url
        $url = $helper->getConfigDataByFullPath('web/unsecure/base_url');
        
        $data = array();
        $data['site'] = $url;
        $data['msg'] = $errMsg;
        $data['f'] = '2.0.7.3';
        $res = $helper->sendPostCurl($command, $data);
    }
}

?>