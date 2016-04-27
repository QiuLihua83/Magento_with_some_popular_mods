<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 09:10:19)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Sliders_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('modulesgarden_base_slider_tabs');
        $this->setTitle(Mage::helper('modulesgarden_base')->__('Slider'));
    }

    protected function _beforeToHtml() {
        $layout = $this->getLayout();

        $this->addTab('slider_form', array(
            'label' => Mage::helper('modulesgarden_base')->__('Details'),
            'content' => $layout->createBlock('modulesgarden_base/adminhtml_plugins_sliders_edit')->toHtml(),
        ));
        
        $sliderId = Mage::app()->getRequest()->getParam('id');
        
        if($sliderId) {
            $this->addTab('settings', array(
                'label' => Mage::helper('modulesgarden_base')->__('Banners'),
                'content' => $layout->createBlock('modulesgarden_base/adminhtml_plugins_banners')->toHtml(),
            ));
        }

        return parent::_beforeToHtml();
    }

}
