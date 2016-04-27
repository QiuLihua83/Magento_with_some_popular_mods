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
class Modulesgarden_Base_Controller_Adminhtml_Sliders extends Mage_Adminhtml_Controller_Action {

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('modulesgarden_base/sliders');
    }

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu('modulesgarden_base/plugins/sliders');
        return $this;
    }

}
