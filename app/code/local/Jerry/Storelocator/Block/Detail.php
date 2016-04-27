<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is under the Magento root directory in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Jerry
 * @package     Jerry_Storelocator
 * @copyright   Copyright (c) 2015 Qun WU. (http://www.jerrywebsolutions.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Jerry_Storelocator_Block_Detail extends Mage_Core_Block_Template 
{
    protected function _construct() 
    {
        parent::_construct();

        $this->setTemplate('storelocator/detail.phtml');
     }
    
    public function getStore()
    {
        return Mage::registry('storelocator_data');
    }
    
    public function getAddress()
    {
        $_store = $this->getStore();
        
        return $_store->address;
    }
}
