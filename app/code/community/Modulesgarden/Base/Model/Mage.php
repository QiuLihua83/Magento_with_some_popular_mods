<?php

/**********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2015-11-19, 10:36:28)
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
 **********************************************************************/

/**
 * @author Marcin Kozak <marcin.ko@modulesgarden.com>
 */

class Modulesgarden_Base_Model_Mage {
            
    protected $version;
    protected $edition;
    protected $index;
    protected $core;
    protected $extensions = array();
    protected $models = array();
    protected $blocks = array();
    protected $coreModels = array();
    
    public function __construct() {
        $this->version  = Mage::getVersion();
        $this->edition  = Mage::helper('core')->isModuleEnabled('Enterprise_Enterprise') ? 'EE' : 'CE';
        
        $root           = Mage::getBaseDir();
        
        $this->index    = $this->getPathMd5Sum($root . '/index.php');
        $this->core     = $this->getPathMd5Sum($root . '/app/code/core/Mage');
        
        $this->fetchOverwrittenModels();
        $this->fetchOverwrittenBlocks();
        $this->fetchExtensions();
        $this->fetchCoreModels();
    }
    
    protected function fetchExtensions() {
        $extensions = (array) Mage::getConfig()->getNode('modules')->children();
        
        foreach($extensions as $name => $settings) {
            if( ! $this->isMageExtension($name) ) {
                $this->extensions[$name] = (string) $settings->version;
            }
        }
    }
    
    protected function isMageExtension($name) {
        return strrpos($name, 'Mage_', -strlen($name)) !== FALSE;
    }
    
    protected function fetchOverwrittenModels() {
        $models = Mage::getConfig()->getNode()->xpath('//global/models//rewrite');
        
        foreach($models as $model){
            foreach ($model as $key => $object){
                $this->models[(string)$key] = (string)$object;
            }
        }
    }
    
    protected function fetchOverwrittenBlocks() {
        $blocks = Mage::getConfig()->getNode()->xpath('//global/blocks//rewrite');
        
        foreach($blocks as $block){
            foreach ($block as $key => $object){
                $this->blocks[(string)$key] = (string)$object;
            }
        }
    }
    
    protected function fetchCoreModels() {
        $coreModelsNames = array(
            'catalog/product',
            'sales/order',
            'sales/quote',
            'customer/customer',
        );
        
        foreach($coreModelsNames as $coreModelName) {
            $this->coreModels[$coreModelName] = get_class(Mage::getModel($coreModelName));
        }     
    }
    
    public function getPathMd5Sum($path) {
        $command    = sprintf('find %s -type f | xargs cat | md5sum', $path);
        $response   = exec($command);
        
        return trim(str_replace('  -', '', $response));
    }
    
    public function toArray() {
        return array(
            'version'       => $this->version,
            'edition'       => $this->edition,
            'index_md5_sum' => $this->index,
            'core_md5_sum'  => $this->core,
            'extensions'    => $this->extensions,
            'core_models'   => $this->coreModels,
            'overwritten'   => array(
                'blocks'        => $this->blocks,
                'models'        => $this->models,
            )
        );
    }
}