<?php

require_once (__DIR__ . '/../abstract.php');
require_once (__DIR__ . '/../../app/Mage.php');

class Modulesgarden_Base_Shell extends Mage_Shell_Abstract {
    
    protected $response;
    
    public function run() {
        if( $this->getArg('check') ) {
            $this->check();
            
            if( $this->getArg('save') ) {
                $this->saveCheck();
            }
        }
    }
    
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f modulesgarden/base.php -- [options]

  check         Show Magento instance condition
  save          Save the "check" command response in the var file
  help          This help

USAGE;
    }
    
    protected function check() {
        $client             = new Modulesgarden_Base_Model_Check_Client;
        $this->response     = $client->fetch()->getResponse();
        
        print_r($this->response);
    }
    
    protected function saveCheck() {
        $fileName = 'modulesgarden_base_check.log';
        
        Mage::log(print_r($this->response, true), null, $fileName);
        $filename = Mage::getBaseDir('var') . '/log/' . $fileName;
        
        print_r(sprintf("The response was saved in the file %s\n\r", $filename));
    }

}

$shell = new Modulesgarden_Base_Shell();
$shell->run();