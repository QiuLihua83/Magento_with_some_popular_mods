<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-10-31, 12:07:11)
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
class Modulesgarden_Base_Block_Adminhtml_System_Config_Form_Fieldset_Installedratio extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface {

    protected $_template = 'modulesgardenbase/system/config/form/fieldset/installedratio.phtml';
    protected $_response;
    protected $_hasError = false;
    protected $_errorMessage = '';

    public function _construct() {
        parent::_construct();
        
        $client = new Modulesgarden_Base_Model_Check_Client;
        
        try {
            $this->_response    = $client->fetch()->getResponse();
        }
        catch(Exception $e) {
            $this->_hasError = true;
            $this->_errorMessage = $e->getMessage();
        }
    }
    
    public function hasError() {
        return $this->_hasError;
    }
    
    public function getErrorMessage() {
        return $this->_errorMessage;
    }

    public function render(Varien_Data_Form_Element_Abstract $element) {
        return $this->toHtml();
    }

    public function getRatio() {
        return $this->_response->summary->ratio;
    }

    public function getRatioLabel() {
        return $this->_response->summary->label;
    }

    public function getDebugString() {
        return print_r( (array) $this->_response, true);
    }

}
