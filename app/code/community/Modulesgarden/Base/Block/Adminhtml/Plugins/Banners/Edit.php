<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 11:00:02)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Banners_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();
        $header = Mage::getSingleton('modulesgarden_base/banner')->isEmpty() ? 'New Banner Details' : 'Edit Banner Details';

        $this->_blockGroup = 'modulesgarden_base';
        $this->_controller = 'adminhtml_plugins_banners';
        $this->_headerText = Mage::helper('modulesgarden_base')->__($header);
        $this->_mode = 'edit';
        
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        
        $this->_formScripts[] = " function saveAndContinueEdit(){
            editForm.submit($('edit_form').action+'back/edit/');
        }";

        $this->_removeButton('reset');
    }

    public function getBackUrl() {
        $slider_id = Mage::app()->getRequest()->getParam('slider_id');
        return $this->getUrl('*/plugins_sliders/edit', array('id' => $slider_id));
    }

}
