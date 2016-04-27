<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 08:47:18)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Sliders_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();
        $header = Mage::getSingleton('modulesgarden_base/slider')->isEmpty() ? 'New Slider Details' : 'Edit Slider Details';

        $this->_blockGroup = 'modulesgarden_base';
        $this->_controller = 'adminhtml_plugins_sliders';
        $this->_headerText = Mage::helper('modulesgarden_base')->__($header);
        $this->_mode = 'edit';

        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        
        $this->_formScripts[] = " function saveAndContinueEdit(){
            editForm.submit($('edit_form').action+'back/edit/');
        }";
    }

    public function getBackUrl() {
        return $this->getUrl('*/*/index');
    }

    // @todo better way to resolve it
    protected function _toHtml() {
        return '<div class="main-col-inner">' . parent::_toHtml() . '</div>';
    }

}
