<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-04, 14:35:18)
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
class Modulesgarden_Base_Model_Banner extends Mage_Core_Model_Abstract {

    protected $_slider;

    protected function _construct() {
        $this->_init('modulesgarden_base/banner');
    }

    public function getSlider() {
        if ($this->_slider === null) {
            $this->_slider = Mage::getModel('modulesgarden_base/slider')->load($this->getSliderId());
        }
        return $this->_slider;
    }

    public function getFileUrl() {
        return Mage::getBaseUrl('media') . 'modulesgarden_base_sliders/' . $this->getFilename();
    }

    public function delete() {
        if ($this->getFilename()) {
            $path = Mage::getBaseDir('media') . DS . 'modulesgarden_base_sliders' . DS . $this->getFilename();
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        parent::delete();
        return $this;
    }

}
