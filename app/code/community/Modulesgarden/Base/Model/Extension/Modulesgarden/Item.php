<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2015-11-19, 14:01:42)
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
 * @author Marcin Kozak <marcin.ko@modulesgarden.com>
 */
class Modulesgarden_Base_Model_Extension_Modulesgarden_Item extends Modulesgarden_Base_Model_Extension_Item {
    
    const TYPE_THEME    = 'theme';
    const TYPE_MODULE   = 'module';
    
    protected $type;
    protected $_versionFileApplied = false;
    protected $_remoteDetailsApplied = false;
    
    protected $wikiUrl;
    protected $friendlyName;
    protected $latestVersion;
    protected $iconUrl;
    protected $price;
    protected $description;
    protected $changelogUrl;
    
    
    public function __construct($type, $name, $version) {
        parent::__construct($name, $version);
        
        $this->type = $type;
    }
    
    public function getWikiUrl() {
        return $this->wikiUrl;
    }

    public function getFriendlyName() {
        return $this->friendlyName ?: $this->getName();
    }

    public function getLatestVersion() {
        return $this->latestVersion;
    }

    public function getIconUrl($default = '') {
        return $this->iconUrl ?: $default;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getChangelogUrl() {
        return $this->changelogUrl;
    }
    
    public function isUpgardeAvailable() {
        return $this->getVersion() && $this->getLatestVersion() && version_compare($this->getLatestVersion(), $this->getVersion()) === 1;
    }
    
}