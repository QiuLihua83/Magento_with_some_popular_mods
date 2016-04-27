<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 08:49:27)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Sliders_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $form->setUseContainer(true);
        $form->setId('edit_form');

        $h = Mage::helper('modulesgarden_base');
        $slider = Mage::getSingleton('modulesgarden_base/slider');
        $isEditMode = !$slider->isEmpty();

        $fieldset = $form->addFieldset('modulesgarden_basesliders_form', array(
            'legend' => $h->__('Slider')
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_view_id', 'select', array(
                'name' => 'store_view_id',
                'label' => $h->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        } else {
            $fieldset->addField('store_view_id', 'hidden', array(
                'name' => 'store_view_id',
                'value' => Mage::app()->getStore(true)->getId(),
            ));
        }

        $fieldset->addField('code', 'text', array(
            'name' => 'code',
            'label' => $h->__('Code'),
            'class' => 'required-entry',
            'required' => true,
            'disabled' => $isEditMode
        ));
        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => $h->__('Title'),
            'class' => 'required-entry',
            'required' => true,
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


        if (!$slider->isEmpty()) {
            $fieldset->addField('slider_id', 'hidden', array(
                'name' => 'slider_id',
                'value' => $slider->getSliderId()
            ));

            $form->setValues($slider->getData());
        }

        $form->setAction($this->getUrl('*/*/save'))
                ->setMethod('post');

        $this->setForm($form);
        return parent::_prepareForm();
    }

}
