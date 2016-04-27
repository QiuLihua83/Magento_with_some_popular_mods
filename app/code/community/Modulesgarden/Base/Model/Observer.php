<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-10-30, 13:23:34)
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
 * @author Grzegorz Draganik <grzegorz@modulesgarden.com>
 */
class Modulesgarden_Base_Model_Observer {

    protected $_mgSections = array(
        'mgbase_installed_extensions' => 'Installed Extensions',
        'mgbase_store' => 'Store'
    );

    public function adminhtml_block_html_before(Varien_Event_Observer $observer) {
        $block      = $observer->getEvent()->getBlock();
        $section    = Mage::app()->getRequest()->getParam('section');
        
        if ($block instanceof Mage_Adminhtml_Block_System_Config_Edit AND in_array($section, array_keys($this->_mgSections))) {
            if ($section === 'mgbase_installed_extensions') {
                $block->unsetChild('save_button');
            }
            
            $block->setTitle('<img src="' . Mage::getBaseUrl('skin') . '/adminhtml/base/default/modulesgardenbase/img/mgcommerce-logo.png" style="vertical-align: bottom;" /> ' . $block->__($this->_mgSections[$section]));
            $block->setHeaderCss('modulesgarden_base_config_header');
        }
    }

    /**
     * By Cron
     */
    public function fetchNotifications() {
        $notificationsCore  = new Modulesgarden_Base_Model_Adminnotification_Core;
        $messages           = $notificationsCore->getAll();
        
        /* @var $message Modulesgarden_Base_Model_Adminnotification_Item */
        
        foreach($messages as $message) {
            Mage::getModel('modulesgarden_base/adminnotification_inbox')->addMajor($message->title, $message->description, $message->url);
        }
    }

}
