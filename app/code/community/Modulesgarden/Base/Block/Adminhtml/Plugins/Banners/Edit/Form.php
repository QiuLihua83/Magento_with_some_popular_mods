<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 11:00:14)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Banners_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setEnctype('multipart/form-data');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setMethod('post');

        $sliderGetId = Mage::app()->getRequest()->getParam('slider_id');
        $h = Mage::helper('modulesgarden_base');

        $banner = Mage::getSingleton('modulesgarden_base/banner');
        $isEditMode = !$banner->isEmpty();

        $fieldset = $form->addFieldset('modulesgarden_base_banner_form', array(
            'legend' => $h->__('Banner')
        ));
        
        $fieldset->addField('enabled', 'select', array(
            'name' => 'enabled',
            'label' => $h->__('Enabled'),
            'class' => 'required-entry',
            'required' => true,
            'options' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ));

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => $h->__('Title'),
            'class' => 'required-entry',
            'required' => true,
        ));
        $fieldset->addField('description', 'textarea', array(
            'name' => 'description',
            'label' => $h->__('Description'),
        ));
        $fieldset->addField('url_title', 'text', array(
            'name' => 'url_title',
            'label' => $h->__('Url Title'),
        ));
        $fieldset->addField('url', 'text', array(
            'name' => 'url',
            'label' => $h->__('Url'),
            'class' => 'validate-url'
        ));

        $fieldset->addField('filename', 'file', array(
            'label' => $h->__('Image'),
            'name' => 'filename',
        ));

        if ($isEditMode && $banner->getFilename()) {
            $fieldset->addField('filename_img', 'note', array(
                'label' => $h->__('Image Preview'),
                'text' => '<img src="' . $banner->getFileUrl() . '" />',
            ));
        }

        $fieldset->addField('sort_order', 'text', array(
            'name' => 'sort_order',
            'label' => $h->__('Sort Order'),
            'class' => 'validate-not-negative-number',
            'value' => '0',
        ));
        
        $fieldset->addField('slider_id', 'hidden', array(
            'name'      => 'slider_id',
            'required'  => true,
            'value'     => $sliderGetId,
        ));


        if (!$banner->isEmpty()) {
            $fieldset->addField('banner_id', 'hidden', array(
                'name' => 'banner_id',
                'value' => $banner->getBannerId()
            ));

            $form->setValues($banner->getData());
        }

        $this->setForm($form);
        return parent::_prepareForm();
    }

}
