<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Core
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Base html block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Mage_Core_Block_Text_Copy extends Mage_Core_Block_Text
{
    protected function _toHtml()
    {
		$this->setText(base64_decode("PHAgY2xhc3M9ImdsX2NvcHlyaWdodCI+PGEgaHJlZj0iaHR0cDovL2dhbGF0aGVtZXMuY29tIj5NYWdlbnRvIFRoZW1lczwvYT4gYnkgPGEgaHJlZj0iaHR0cDovL2dhbGF0aGVtZXMuY29tL21hZ2VudG8tdGhlbWVzLmh0bWwiIHRpdGxlPSJQcmVtaXVtIE1hZ2VudG8gVGVtcGxhdGVzIC0gR2FsYXRoZW1lcy5jb20iPkdhbGF0aGVtZXMuY29tPC9hPjwvcD4="));
        return parent::_toHtml();
    }
}
