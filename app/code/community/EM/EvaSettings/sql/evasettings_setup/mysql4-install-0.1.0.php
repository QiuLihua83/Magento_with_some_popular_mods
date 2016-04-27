<?php

$installer = $this;

$installer->startSetup();
$block = Mage::getModel('cms/block');
$page = Mage::getModel('cms/page');
//$stores = array_keys(Mage::getSingleton('adminhtml/system_store')->getStoreOptionHash());

$stores = array(0);

// Config perfix for identifier of static block and static page
$prefixBlock = 'galaeva_';
$prefixPage = 'galaeva_';


####################################################################################################
# INSERT STATIC BLOCKS
####################################################################################################

$dataBlock = array(
	'title' => 'Block Content 1',
	'identifier' => 'block_content_1',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<ul>
		<li><a href="#"><img src="{{skin url='images/block1.jpg'}}" alt="" /></a></li>
		<li><a href="#"><img src="{{skin url='images/block2.jpg'}}" alt="" /></a></li>
		<li><a href="#"><img src="{{skin url='images/block3.jpg'}}" alt="" /></a></li>
		</ul>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 1',
	'identifier' => 'block_footer_1',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-1">
		<h3>Visiting the Store</h3>
		<ul>
		<li><a href="#">Store Opening Hours</a></li>
		<li><a href="#">Store Guide</a></li>
		<li><a href="#">Visitor Guidelines</a></li>
		<li><a href="#">Restaurants </a></li>
		<li><a href="#">News &amp; Events </a></li>
		<li><a href="#">Contact Us </a></li>
		</ul>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Top Links',
	'identifier' => 'top_links',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<ul>
		<li><a title="Contact us" href="{{store url='about-magento-demo-store'}}">Contact Us</a></li>
		<li> <a title="Customer service" href="{{store url='customer-service'}}">Customer service <span>1.234.567.8910</span></a> </li>
		</ul>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Main Slideshow',
	'identifier' => 'mainslideshow',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<p>{{widget type="slideshowwidget/create" image1="img1.jpg" image2="img2.jpg" width="960" height="460" delay="5000" displaybutton="true" autostart="true" transition="horz.tl" transitionspeed="800" autocenter="false" cpanelalign="BR" cpanelposition="inside" timeralign="top" displaytimer="true" mouseoverpause="false" cpanelmouseover="false" textmouseover="false" texteffect="fade" textsync="true" shuffle="false"}}</p>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 2',
	'identifier' => 'block_footer_2',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-2">
		<h3>Shopping on Eva .com</h3>
		<ul>
		<li><a href="#">Buying Guides </a></li>
		<li><a href="#">Check Gift Card Balance </a></li>
		<li><a href="#">Delivery &amp; Returns Information </a></li>
		<li><a href="#">Frequently Asked Questions </a></li>
		<li><a href="#">International Shopping </a></li>
		<li><a href="#">Moisque Eva Publications </a></li>
		<li><a href="#">Terms and Conditions </a></li>
		</ul>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 3',
	'identifier' => 'block_footer_3',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-3">
		<h3>Eva Services</h3>
		<ul>
		<li><a href="#">In-store Services </a></li>
		<li><a href="#">Moisque Eva Rewards </a></li>
		<li><a href="#">Moisque Eva Careers </a></li>
		<li><a href="#">Moisque Eva Group Businesses</a></li>
		<li><a href="#">Become a Supplier </a></li>
		</ul>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 4',
	'identifier' => 'block_footer_4',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-4">
		<h3>Follow us</h3>
		<ul>
		<li><a href="http://twitter.com/"><img src="{{skin url='images/i_fb.gif'}}" alt="" /></a>Facebook </li>
		<li><a href="http://www.facebook.com/"><img src="{{skin url='images/i_tw.gif'}}" alt="" /></a>Twitter </li>
		<li><a href="http://www.youtube.com/"><img src="{{skin url='images/i_youtobe.gif'}}" alt="" /></a>Youtube </li>
		</ul>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 5',
	'identifier' => 'block_footer_5',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-5">
		<h3>International delivery</h3>
		Moisque Eva.com delivers to over 40 countries <a href="#">&raquo; </a></div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Block Footer 6',
	'identifier' => 'block_footer_6',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="block-footer-6"><span>Payment Accept</span> 
		<ul>
		<li><a href="#"><img src="{{skin url='images/i_visa.jpg'}}" alt="" /></a></li>
		<li><a href="#"><img src="{{skin url='images/i_master.jpg'}}" alt="" /></a></li>
		<li><a href="#"><img src="{{skin url='images/i_amex.jpg'}}" alt="" /></a></li>
		</ul>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Callout Left',
	'identifier' => 'callout_left',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="callout-left"><a href="#"><img src="{{skin url='images/freegift.png'}}" alt="" /></a></div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Image Header',
	'identifier' => 'image_header',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="image-header"><img src="{{skin url='images/checkout_promotion.jpg'}}" alt="" /></div>
EOB
);
$block->setData($dataBlock)->save();


$dataBlock = array(
	'title' => 'Helpful Links',
	'identifier' => 'helpful_links',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
		<div class="helpful-links">
		<h3>Helpful links</h3>
		<div class="helpful-links-content">
		<ul>
		<li><a href="#"><img src="{{skin url='images/i1.gif'}}" alt="" />Free 2-3 Day Priority Shipping !</a></li>
		<li><a href="#"><img src="{{skin url='images/i2.gif'}}" alt="" />30 Day Price Match Guarantee</a></li>
		<li><a href="#"><img src="{{skin url='images/i3.gif'}}" alt="" />FREE Returns &amp; Exchanges</a></li>
		</ul>
		<div class="helpful-link-right">
		<p><a href="#"><img src="{{skin url='images/i4.gif'}}" alt="" />MoisqueEva Customer Care</a></p>
		<ul class="first">
		<li><a href="#"><img src="{{skin url='images/i5.gif'}}" alt="" />0.123.456.789</a></li>
		<li><a href="#"><img src="{{skin url='images/i6.gif'}}" alt="" />Live chat</a></li>
		</ul>
		<ul class="last">
		<li><a href="#"><img src="{{skin url='images/i7.gif'}}" alt="" />Email</a></li>
		<li><a href="#"><img src="{{skin url='images/i8.gif'}}" alt="" />FAQs</a></li>
		</ul>
		</div>
		</div>
		</div>
EOB
);
$block->setData($dataBlock)->save();


$dataPage = array(
	'title'				=> 'Eva Home page',
	'identifier' 		=> $prefixPage.'home',
	'stores'			=> $stores,
	'content_heading'	=> 'Latest products',
	'content'			=> <<<EOB
	<p>{{widget type="catalog/product_widget_new" products_count="9" template="catalog/product/widget/new/content/new_grid.phtml" cache_lifetime="3600"}}</p>
EOB
,
	'root_template'		=> 'one_column',
	'layout_update_xml'	=> <<<EOB

EOB
);
$page->setData($dataPage)->save();



$installer->endSetup(); 
