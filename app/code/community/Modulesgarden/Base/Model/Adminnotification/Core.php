<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-11-12, 10:35:44)
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
class Modulesgarden_Base_Model_Adminnotification_Core {
    
    /**
     *
     * @var array
     */
    protected $events;
    
    /**
     *
     * @var Modulesgarden_Base_Model_Extension_Client
     */
    protected $client;
    
    /**
     *
     * @var Modulesgarden_Base_Model_Resource_Extension
     */
    protected $resource;
    
    /**
     *
     * @var Modulesgarden_Base_Helper_Data
     */
    protected $helper;
    
    public function __construct() {
        $this->events   = explode(',', Mage::getStoreConfig('mgbase_store/notifications/events'));
        $this->client   = new Modulesgarden_Base_Model_Extension_Client();

        $version        = (string) Mage::getConfig()->getNode()->modules->Modulesgarden_Base->version;
        $this->helper   = Mage::helper('modulesgarden_base');
        $this->resource = Mage::getResourceModel('modulesgarden_base/extension');
        
        $serverAddr = filter_input(INPUT_SERVER, 'SERVER_ADDR');
        $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME');
        
        $this->client->registerModuleInstance($version, $serverAddr, $serverName);
    }
    
    protected function hasEvent($event) {
        return in_array($event, $this->events);
    }
    
    protected function canBeAppended($title) {
        return ! Modulesgarden_Base_Model_Adminnotification_Inbox::exists($title);
    }
    
    /**
     * 
     * @return array (Modulesgarden_Base_Model_Adminnotification_Item)
     */
    public function getUpgrades() {
        $messages = array();
        
        if( ! $this->hasEvent(Modulesgarden_Base_Model_System_Config_Source_Notificationevents::UPGRADES) ) {
            return $messages;
        }
        
        foreach($this->resource->getModulesgardenCollection() as $installedMgExtension) {
            if($installedMgExtension->isUpgardeAvailable()) {
                $title = $this->helper->__('Upgarde Of "%s" Extension From ModulesGarden Is Available (%s)', $installedMgExtension->getFriendlyName(), $installedMgExtension->getLatestVersion());

                if( $this->canBeAppended($title) ) {
                    $description = $this->helper->__('New version: %s. Download extension from modulesgarden.com and install it in your magento.', $installedMgExtension->getLatestVersion());
                    $messages[] = new Modulesgarden_Base_Model_Adminnotification_Item($title, $description, $installedMgExtension->getChangelogUrl());
                }
            }
        }
        
        return $messages;
    }
    
    /**
     * 
     * @return array (Modulesgarden_Base_Model_Adminnotification_Item)
     */
    public function getReleases() {
        $messages = array();
        
        if( ! $this->hasEvent(Modulesgarden_Base_Model_System_Config_Source_Notificationevents::RELEASES) ) {
            return $messages;
        }
        
        foreach($this->resource->getExtensionsObjectsFromModulesgardenCom() as $extensionFromStore) {
            if($extensionFromStore->getIsNew()) {
                $title = $this->helper->__('New Extension From ModulesGarden: %s', $extensionFromStore->getFriendlyName());

                if( $this->canBeAppended($title) ) {
                    $description = $this->helper->__('Download extension from modulesgarden.com and install it in your magento.');
                    $messages[] = new Modulesgarden_Base_Model_Adminnotification_Item($title, $description, $extensionFromStore->getChangelogUrl());
                }
            }
        }
        
        return $messages;
    }
    
    /**
     * 
     * @return array (Modulesgarden_Base_Model_Adminnotification_Item)
     */
    public function getPromotions() {
        $messages = array();
        
        if( ! $this->hasEvent(Modulesgarden_Base_Model_System_Config_Source_Notificationevents::PROMOTIONS) ) {
            return $messages;
        }
        
        $promotions = $this->client->getActivePromotions();
        
        if( ! ($promotions && isset($promotions->data->promotions))) {
            return $messages;
        }
        
        $url  = (string) Mage::getConfig()->getNode('default/modulesgarden_base/urls/company');
        
        foreach($promotions->data->promotions as $promo) {
            $title = $this->helper->__('New Promotion From ModulesGarden: %s', $promo->notes);

            if($this->canBeAppended($title)) {
                $description = $this->helper->__('Promotion Code: %s', $promo->code);
                $messages[] = new Modulesgarden_Base_Model_Adminnotification_Item($title, $description, $url);
            }
        }
        
        return $messages;
    }
    
    public function getAll() {
        $messages = array();
        
        $messages = array_merge($messages, $this->getUpgrades());
        $messages = array_merge($messages, $this->getReleases());
        $messages = array_merge($messages, $this->getPromotions());
        
        return $messages;
    }

}
