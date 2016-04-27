<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-04, 14:46:45)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Sliders_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();

        $this->setId('modulesgarden_base_SlidersGrid');
        $this->setDefaultSort('title');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(false);
    }

    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('modulesgarden_base/slider_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $h = Mage::helper('modulesgarden_base');

        $this->addColumn('slider_id', array(
            'header' => $h->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'slider_id',
        ));

        $this->addColumn('code', array(
            'header' => $h->__('Code'),
            'align' => 'left',
            'index' => 'code',
            'width' => '200px',
        ));

        $this->addColumn('title', array(
            'header' => $h->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('enabled', array(
            'header' => $h->__('Enabled'),
            'align' => 'left',
            'index' => 'enabled',
            'width' => '120px',
            'type' => 'options',
            'sortable' => false,
            'options' => array(
                0 => $h->__('No'),
                1 => $h->__('Yes'),
            )
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getSliderId()));
    }

}
