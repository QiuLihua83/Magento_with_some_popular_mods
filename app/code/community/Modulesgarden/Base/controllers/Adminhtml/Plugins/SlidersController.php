<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-04, 15:10:09)
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
class Modulesgarden_Base_Adminhtml_Plugins_SlidersController extends Modulesgarden_Base_Controller_Adminhtml_Sliders {

    public function indexAction() {
        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction() {
        $this->_initAction();
        $r = $this->getRequest();

        $slider = Mage::getSingleton('modulesgarden_base/slider');
        if ($r->getParam('id')) {
            $slider->load($r->getParam('id'));
        }

        $this->renderLayout();
    }

    public function saveAction() {
        $r = $this->getRequest();
        $slider = Mage::getModel('modulesgarden_base/slider');


        if ($r->getPost('slider_id')) { // edit
            $slider->load($r->getPost('slider_id'));
            if ($slider->isEmpty()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('It looks like slider with id #%d does not exists!', $r->getPost('slider_id')));
                return $this->_redirect('*/*/index');
            }
        } else { // adding
        }

        try {
            $slider->setStoreViewId($r->getPost('store_view_id'));
            $slider->setCode($r->getPost('code'));
            $slider->setTitle($r->getPost('title'));
            $slider->setEnabled($r->getPost('enabled'));

            $slider->save();
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Slider has been saved.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Slider has not been saved. Code is not unique probably.'));
        }
        
        if( $r->getParam('back') ) {
            return $this->_redirect('*/*/edit', array(
                'id' => $slider->getId(),
            ));  
        }
        else {
            return $this->_redirect('*/*/index');
        }
    }

    public function deleteAction() {
        $slider_id = $this->getRequest()->getParam('id');
        $slider = $slider = Mage::getModel('modulesgarden_base/slider')
                ->load($slider_id);

        $slider->delete();

        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Slider has been deleted.'));
        return $this->_redirect('*/*/index');
    }

}
