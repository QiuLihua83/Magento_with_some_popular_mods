<?php

/**
 * InstantSearchPlus (Autosuggest) * * NOTICE OF LICENSE * * This source file is subject to the Open Software License (OSL 3.0) * that is available through the world-wide-web at this URL: * http://opensource.org/licenses/osl-3.0.php * * @category   Mage * @package    InstantSearchPlus * @copyright  Copyright (c) 2014 Fast Simon (http://www.instantsearchplus.com) * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0) */
/** * Used in creating options for Yes|No config value selection * */
class Autocompleteplus_Autosuggest_Block_Adminhtml_Sync extends Mage_Adminhtml_Block_System_Config_Form_Field{
    /*     * Set template     */
    protected function _construct(){
        parent::_construct();
        $this->setTemplate('autocompleteplus/system/config/sync.phtml');
    }

    /**
     *
     * Return element html
     *     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){
        return $this->_toHtml();
    }

    public function getUUID(){
        $helper=Mage::helper('autocompleteplus_autosuggest');
        return $helper->getUUID();
    }

    public function getIsReachable(){
        $helper=Mage::helper('autocompleteplus_autosuggest');
        return $helper->getIsReachable();
    }

    /**
     * Return ajax url for button     *
     * @return string
     */
    public function getSyncUrl(){
        return Mage::helper('adminhtml')->getUrl('autocompleteplus/adminhtml_push/startpush');
    }

    /**
     * Generate button html     *
     * @return string
     */
    public function getButtonHtml(){
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id'        => 'autocompleteplus_sync',
                'label'     => $this->helper('adminhtml')->__('Sync'),
                'onclick'   => 'javascript:syncautocomplete(); return false;'
            ));
        return $button->toHtml();
    }
}