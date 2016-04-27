<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2015-11-19, 14:39:18)
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
 * @author Marcin Kozak <marcin.ko@modulesgarden.com>
 */
class Modulesgarden_Base_Model_Check_Client {
    
    /**
     *
     * @var \Zend_Http_Client
     */
    protected $curl;
    
    /**
     *
     * @var \Modulesgarden_Base_Model_Mage
     */
    protected $mage;
    
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
    
    public function __construct() {
        $this->url  = (string) Mage::getConfig()->getNode('default/modulesgarden_base/urls/check');
        $this->mage = new Modulesgarden_Base_Model_Mage();
        $this->curl = curl_init($this->url);
        
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_POSTREDIR, 3);
    }
    
    /**
     * 
     * @return \Modulesgarden_Base_Model_Information_Client
     */
    public function fetch() {
        $data = array(
            'check' => $this->mage->toArray()
        );
        
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($this->curl);
        
        if($response === false) {
            $error = curl_error($this->curl);
            Mage::log($error, null, 'modulesgarden_base.log');
            throw new Exception($error);
        }

        $this->response = json_decode($response);
        
        return $this;
    }
    
    /**
     * 
     * @return \Zend_Http_Response
     */
    public function getResponse() {
        return $this->response;
    }
}