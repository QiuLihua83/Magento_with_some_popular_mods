<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-08-07, 12:00:53)
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

$installer = $this;
$installer->startSetup();

$installer->run("	

CREATE TABLE IF NOT EXISTS `".Mage::getSingleton('core/resource')->getTableName('modulesgarden_base/sliders')."` (
  `slider_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_view_id` int(10) unsigned NOT NULL,
  `code` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `".Mage::getSingleton('core/resource')->getTableName('modulesgarden_base/banners')."` (
  `banner_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` int(10) unsigned NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '1',
  `title` varchar(250) NOT NULL,
  `description` text,
  `url_title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `enabled` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

");

@mkdir(Mage::getBaseDir('media') . DS . 'modulesgarden_base_sliders', 0777);

$installer->endSetup();