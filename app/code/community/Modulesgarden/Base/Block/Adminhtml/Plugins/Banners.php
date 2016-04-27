<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 10:02:49)
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

class Modulesgarden_Base_Block_Adminhtml_Plugins_Banners extends Mage_Adminhtml_Block_Widget_Grid_Container {

	public function __construct() {
		$this->_blockGroup = 'modulesgarden_base';
		$this->_controller = 'adminhtml_plugins_banners';
		$this->_headerText = Mage::helper('modulesgarden_base')->__('Banners List');

		parent::__construct();
	}

	public function getCreateUrl() {
		$slider_id = Mage::app()->getRequest()->getParam('id');
		return $this->getUrl('*/plugins_banners/edit', array('slider_id' => $slider_id));
	}

	protected function _toHtml(){
		return '<div class="main-col-inner">'.parent::_toHtml().'</div>';
	}
	
}
