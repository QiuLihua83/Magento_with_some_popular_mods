<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-04, 14:35:13)
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
class Modulesgarden_Base_Model_Slider extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('modulesgarden_base/slider');
    }

    public function loadByCode($code) {
        $coll = $this->getCollection()
                ->addFieldToFilter('code', $code)
                ->load();

        return count($coll) ? $coll->getFirstItem() : $this;
    }

    public function isEnabledForCurrentStoreView() {
        return in_array($this->getStoreViewId(), array(0, Mage::app()->getStore()->getStoreId()));
    }

    public function getEnabledBanners() {
        $collection = Mage::getResourceModel('modulesgarden_base/banner_collection')
                ->addFieldToFilter('main_table.enabled', 1)
                ->addFieldToFilter('main_table.slider_id', $this->getSliderId());

        return $collection;
    }

}
