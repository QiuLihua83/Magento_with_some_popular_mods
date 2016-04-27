<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 10:15:19)
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
class Modulesgarden_Base_Adminhtml_Plugins_BannersController extends Modulesgarden_Base_Controller_Adminhtml_Sliders {

    public function editAction() {
        $r = $this->getRequest();

        $banner = Mage::getSingleton('modulesgarden_base/banner');

        if ($r->getParam('id')) {
            $banner->load($r->getParam('id'));
        }

        $this->_initAction();
        $this->renderLayout();
    }

    public function saveAction() {
        $r = $this->getRequest();
        $banner = Mage::getModel('modulesgarden_base/banner');

        if (!$r->getPost('slider_id')) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('It looks like slider id is empty.'));
            return $this->_redirect('*/plugins_sliders/index');
        }

        if ($r->getPost('banner_id')) { // edit
            $banner->load($r->getPost('banner_id'));
            if ($banner->isEmpty()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('It looks like banner with id #%d does not exists!', $r->getPost('banner_id')));
                return $this->_redirect('*/plugins_sliders/index');
            }
        } else { // adding
        }

        if (isset($_FILES['filename']['name']) && (file_exists($_FILES['filename']['tmp_name']))) {
            try {
                $uploader = new Varien_File_Uploader('filename');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $uploader->save(Mage::getBaseDir('media') . DS . 'modulesgarden_base_sliders' . DS, $_FILES['filename']['name']);

                $banner->setFilename($_FILES['filename']['name']);
            } catch (Exception $e) {
                
            }
        }

        try {
            $banner->setSliderId($r->getPost('slider_id'));
            $banner->setTitle($r->getPost('title'));
            $banner->setDescription($r->getPost('description'));
            $banner->setEnabled($r->getPost('enabled'));
            $banner->setUrlTitle($r->getPost('url_title'));
            $banner->setUrl($r->getPost('url'));
            $banner->setSortOrder($r->getPost('sort_order'));

            $banner->save();
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Banner has been saved.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Banner has not been saved. ' . $e->getMessage()));
        }
        
        if( $r->getParam('back') ) {
            return $this->_redirect('*/*/edit', array(
                'id'        => $banner->getId(),
                'slider_id' => $r->getPost('slider_id'),
            ));
        }
        else {
            return $this->_redirect('*/plugins_sliders/edit', array('id' => $r->getPost('slider_id')));
        }
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $banner = Mage::getModel('modulesgarden_base/banner')->load($id);
            if ($banner->delete()) {
                Mage::getSingleton('core/session')->addSuccess($this->__('Banner has been deleted.'));
                $slider_id = $banner->getSliderId();
            }
        }
        return $this->_redirect('*/plugins_sliders/edit', array(
                    'id' => isset($slider_id) ? $slider_id : null
        ));
    }

}
