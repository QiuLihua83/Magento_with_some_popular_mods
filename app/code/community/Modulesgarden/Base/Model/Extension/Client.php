<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-10-30, 14:39:18)
 * 
 *
 *  CREATED BY MODULESGARDEN       ->        http://modulesgarden.com
 *  CONTACT                        ->       contact@modulesgarden.com
 *
 *
 *
 *
 * This software is furnished under a license and may be used and copied
 * only  in  accordance  with  the  terms  of such  license and with the
 * inclusion of the above copyright notice.  This software  or any other
 * copies thereof may not be provided or otherwise made available to any
 * other person.  No title to and  ownership of the  software is  hereby
 * transferred.
 *
 *
 * ******************************************************************** */

/**
 * @author Mariusz Miodowski <mariusz@modulesgarden.com>
 * @author Grzegorz Draganik <grzegorz@modulesgarden.com>
 */
class Modulesgarden_Base_Model_Extension_Client {
    
    CONST MODULE_NAME = 'Modules Garden Widget For Magento';
    CONST MODULE_KEY = 'fhKzDqtZ3NloER4kV0olIHRIqba8VDf8';
    
    /**
     *  Cache life time.
     */
    protected $cache = array();

    /**
     *
     * @var \Zend_Http_Client
     */
    protected $curl;

    /**
     *
     * @var string
     */
    protected $url;

    /**
     *
     * @var \Zend_Http_Response
     */
    protected $response;
    
    //This name will be send to modulesgarden.com
    protected $module = '';
    //Module Name
    protected $moduleName = '';
    //Encryption Key
    protected $accessHash = '';

    public function __construct($moduleName = '', $accessHash = '') {
        $this->url = (string) Mage::getConfig()->getNode('default/modulesgarden_base/urls/store');
        $this->curl = curl_init($this->url);
        
        $this->module = $moduleName;
	$this->moduleName = $moduleName ? strtolower(str_replace(' ', '', $moduleName)) : self::MODULE_NAME;
	$this->accessHash = $accessHash ? trim($accessHash) : self::MODULE_KEY;

        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_POSTREDIR, 3);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
    }
    
    protected function initCache() {
        $this->cache = array(
            'getLatestModuleVersion'    => (int) Mage::getConfig()->getNode('default/modulesgarden_base/urls/cache/latest_module_version'),
            'registerModuleInstance'    => (int) Mage::getConfig()->getNode('default/modulesgarden_base/urls/cache/register_module_instance'),
            'getAvailableProducts'      => (int) Mage::getConfig()->getNode('default/modulesgarden_base/urls/cache/available_products'),
            'getActivePromotions'       => (int) Mage::getConfig()->getNode('default/modulesgarden_base/urls/cache/active_promotions'),
        );
    }

    /**
     * @param type $currentVersion
     */
    public function getLatestModuleVersion() {
        $request = array(
            'action' => 'getLatestModuleVersion',
        );

        return $this->send($request);
    }

    public function getActivePromotions() {
        $request = array(
            'action'    => 'getActivePromotions',
        );

        return $this->send($request);
    }

    /**
     * Register new module instance
     * @param type $moduleVersion
     * @param type $serverIP
     * @param type $serverName
     * @return type
     */
    public function registerModuleInstance($moduleVersion, $serverIP, $serverName) {
        $request = array(
            'action' => 'registerModuleInstance',
            'data' => array(
                'moduleVersion' => $moduleVersion,
                'serverIP'      => $serverIP,
                'serverName'    => $serverName,
            ),
        );

        return $this->send($request);
    }

    /**
     * Get all available products
     * @return type
     */
    public function getAvailableProducts($platform = null) {
        $requst = array(
            'action'    => 'getAvailableProducts',
            'data'      => array(
                'platform'  => $platform,
            ),
        );

        return $this->send($requst);
    }

    private function send($data = array()) {
        if (!$data) {
            return false;
        }

        if (empty($data['action'])) {
            return false;
        }

        //Add module name and access hash
        $data['hash']   = $this->accessHash;
	$data['module'] = $this->module;

        //Are we have ane cache?

        $json = $this->getFromCache($data);

        if (!empty($json)) {
            return $json;
        }

        //Encode data
        $jsonData = json_encode($data);

        //Prepare Curl
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $jsonData);

        $this->response = curl_exec($this->curl);
        
        //echo '<pre>'; var_dump($data, $this->response); exit;

        if( ! $this->response) {
            $this->error = 'Did not receive any data. ' . curl_error($this->curl);
            return false;
        }

        $json = json_decode($this->response);
        
        if (!$json) {
            $this->setError('Invalid Format');
            return false;
        }

        if (!$json->status) {
            $this->setError($json->message);
            return false;
        }

        $this->saveCache($data, $json);

        return $json;
    }

    public function getError() {
        return $this->error;
    }

    protected function setError($error) {
        $this->error = $error;
    }

    private function getCacheKeyByData($data) {
        return $this->moduleName . '_' . serialize($data);
    }

    private function saveCache($data, $json) {
        $key = $this->getCacheKeyByData($data);
        $action = $data['action'];

        if (isset($this->cache[$action])) {
            Mage::app()->getCache()->save(urlencode(serialize($json)), $key, array(), $this->cache[$action]);
        }
    }

    private function getFromCache($data) {
        $key = $this->getCacheKeyByData($data);
        $object = Mage::app()->getCache()->load($key);

        if ($object !== false) {
            return unserialize(urldecode($object));
        }

        return null;
    }

}
