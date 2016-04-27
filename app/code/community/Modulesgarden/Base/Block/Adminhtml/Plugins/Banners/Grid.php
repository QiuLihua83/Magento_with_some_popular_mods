<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-05, 10:04:32)
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
class Modulesgarden_Base_Block_Adminhtml_Plugins_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    protected $sliderId;
    
    public function __construct() {
        parent::__construct();

        $this->setId('modulesgarden_base_BannersGrid');
        $this->setDefaultSort('title');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(false);
    }

    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('modulesgarden_base/banner_collection');

        $this->sliderId = Mage::app()->getRequest()->getParam('id');
        
        if ($this->sliderId) {
            $collection->addFieldToFilter('main_table.slider_id', $this->sliderId);
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $h = Mage::helper('modulesgarden_base');

        $this->addColumn('banner_id', array(
            'header' => $h->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'banner_id',
        ));

        $this->addColumn('title', array(
            'header' => $h->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('url_title', array(
            'header' => $h->__('Url Title'),
            'align' => 'left',
            'index' => 'url_title',
        ));

        $this->addColumn('url', array(
            'header' => $h->__('Url'),
            'align' => 'left',
            'index' => 'url',
        ));

        $this->addColumn('sort_order', array(
            'header' => $h->__('Sort Order'),
            'align' => 'left',
            'index' => 'sort_order',
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
        return $this->getUrl('*/plugins_banners/edit', array(
            'id'        => $row->getBannerId(),
            'slider_id' => $this->sliderId,
        ));
    }

}
