<?php
class EM_EvaSettings_EvaSettings 
{
		public function get_grid_thumb_width()
	{
		$w = 225;
		if(Mage::getStoreConfig('eva/image/grid_thumb_width'))
			$w = Mage::getStoreConfig('eva/image/grid_thumb_width');
		return $w;
	}
	public function get_grid_thumb_height()
	{
		$h = 300;
		if(Mage::getStoreConfig('eva/image/grid_thumb_height'))
			$h = Mage::getStoreConfig('eva/image/grid_thumb_height');
		return $h;
	}
	public function get_grid_thumb_bgcolor()
	{
		$b ="FFF";
		if(Mage::getStoreConfig('eva/image/grid_thumb_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/grid_thumb_bgcolor');
		return $b;
	}
	public function get_listing_thumb_width()
	{
		$w=225;
		if(Mage::getStoreConfig('eva/image/listing_thumb_width'))
			$w = Mage::getStoreConfig('eva/image/listing_thumb_width');
		return $w;
	}
	public function get_listing_thumb_height()
	{
		$h = 300;
		if(Mage::getStoreConfig('eva/image/listing_thumb_height'))
			$h = Mage::getStoreConfig('eva/image/listing_thumb_height');
		return $h;
	}
	public function get_listing_thumb_bgcolor()
	{
		$b = "FFF";
		if(Mage::getStoreConfig('eva/image/listing_thumb_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/listing_thumb_bgcolor');
		return $b;
	}
	public function get_base_image_width()
	{
		$w = 300;
		if(Mage::getStoreConfig('eva/image/base_image_width'))
			$w =Mage::getStoreConfig('eva/image/base_image_width');
		return $w;
	}
	public function get_base_image_height()
	{
		$h = 300;
		if(Mage::getStoreConfig('eva/image/base_image_height'))
			$h = Mage::getStoreConfig('eva/image/base_image_height');
		return $h;
	}
	public function get_base_image_bgcolor()
	{
		$b ="FFF";
		if(Mage::getStoreConfig('eva/image/base_image_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/base_image_bgcolor');
		return $b;
	}
	public function get_thumb_base_width()
	{
		$w = 75;
		if(Mage::getStoreConfig('eva/image/thumb_base_width'))
			$w = Mage::getStoreConfig('eva/image/thumb_base_width');
		return $w;
	}
	public function get_thumb_base_height()
	{
		$h = 85;
		if(Mage::getStoreConfig('eva/image/thumb_base_height'))
			$h = Mage::getStoreConfig('eva/image/thumb_base_height');
		return $h;
	}
	public function get_thumb_base_bgcolor()
	{
		$b = "FFF";
		if(Mage::getStoreConfig('eva/image/thumb_base_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/thumb_base_bgcolor');
		return $b;
	}
	public function get_related_width()
	{
		$w = 80;
		if(Mage::getStoreConfig('eva/image/related_width'))
			$w = Mage::getStoreConfig('eva/image/related_width');
		return $w;
	}
	public function get_related_height()
	{
		$h = 90;
		if(Mage::getStoreConfig('eva/image/related_height'))
			$h = Mage::getStoreConfig('eva/image/related_height');
		return $h;
	}
	public function get_related_bgcolor()
	{
		$b ="FFF";
		if(Mage::getStoreConfig('eva/image/related_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/related_bgcolor');
		return $b;
	}
	public function get_crosssell_width()
	{
		$w = 225;
		if(Mage::getStoreConfig('eva/image/crosssell_width'))
			$w = Mage::getStoreConfig('eva/image/crosssell_width');
		return $w;
	}
	public function get_crosssell_height()
	{
		$h = 300;
		if(Mage::getStoreConfig('eva/image/crosssell_height'))
			$h = Mage::getStoreConfig('eva/image/crosssell_height');
		return $h;
	}
	public function get_crosssell_bgcolor()
	{
		$b = "FFF";
		if(Mage::getStoreConfig('eva/image/crosssell_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/crosssell_bgcolor');
		return $b;
	}
	public function get_upsell_width()
	{
		$w = 225;
		if(Mage::getStoreConfig('eva/image/upsell_width'))
			$w = Mage::getStoreConfig('eva/image/upsell_width');
		return $w;
	}
	public function get_upsell_height()
	{
		$h = 300;
		if(Mage::getStoreConfig('eva/image/upsell_height'))
			$h = Mage::getStoreConfig('eva/image/upsell_height');
		return $h;
	}
	public function get_upsell_bgcolor()
	{
		$b = "FFF";
		if(Mage::getStoreConfig('eva/image/upsell_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/upsell_bgcolor');
		return $b;
	}
	public function get_widget_width()
	{
		$w = 230;
		if(Mage::getStoreConfig('eva/image/widget_width'))
			$w = Mage::getStoreConfig('eva/image/widget_width');
		return $w;
	}
	public function get_widget_height()
	{
		$h = 305;
		if(Mage::getStoreConfig('eva/image/widget_height'))
			$h = Mage::getStoreConfig('eva/image/widget_height');
		return $h;
	}
	public function get_widget_bgcolor()
	{
		$b="#FFF";
		if(Mage::getStoreConfig('eva/image/widget_bgcolor'))
			$b = Mage::getStoreConfig('eva/image/widget_bgcolor');
		return $b;
	}
	
	public function get_option_swatches() {
		return $this->parse_swatches(Mage::getStoreConfig('eva/image/option_swatches'));
	}
	
	protected function parse_swatches($s) {
		$swatches = array();
		if ($s) {
			if (preg_match_all("/^(.*)\:(.*)=(.*)$/m", $s, $m, PREG_SET_ORDER)) {
				foreach ($m as $_ln)
					$swatches[] = array(
						'key' => trim($_ln[1]),
						'value' => trim($_ln[2]),
						'img' => trim($_ln[3])
					);
			}
		}
		return $swatches;
	}
	
	public function get_body_font() {
		return Mage::getStoreConfig('eva/color/body_font') ? Mage::getStoreConfig('eva/color/body_font') : '';
	}
	
	public function get_body_bg_color() {
		return Mage::getStoreConfig('eva/color/body_bg_color') ? Mage::getStoreConfig('eva/color/body_bg_color') : '';
	}
	
	public function get_body_bg_pattern() {
		return Mage::getStoreConfig('eva/color/body_bg_pattern') ? Mage::getStoreConfig('eva/color/body_bg_pattern') : '';
	}
	
	public function get_link_color() {
		return Mage::getStoreConfig('eva/color/link_color') ? Mage::getStoreConfig('eva/color/link_color') : '';
	}
	
	public function get_header_bg_image() {
		return Mage::getStoreConfig('eva/color/header_bg_image') ? Mage::getStoreConfig('eva/color/header_bg_image') : '';
	}
	
	public function get_nav_bg_image() {
		return Mage::getStoreConfig('eva/color/nav_bg_image') ? Mage::getStoreConfig('eva/color/nav_bg_image') : '';
	}
	
	public function get_nav_text_color() {
		return Mage::getStoreConfig('eva/color/nav_text_color') ? Mage::getStoreConfig('eva/color/nav_text_color') : '';
	}
	
	public function get_nav_top_menu_font() {
		return Mage::getStoreConfig('eva/color/nav_top_menu_font') ? Mage::getStoreConfig('eva/color/nav_top_menu_font') : '';
	}
	
	public function get_nav_top_menu_text_color() {
		return Mage::getStoreConfig('eva/color/nav_top_menu_text_color') ? Mage::getStoreConfig('eva/color/nav_top_menu_text_color') : '';
	}
	
	public function get_nav_top_menu_text_hover_color() {
		return Mage::getStoreConfig('eva/color/nav_top_menu_text_hover_color') ? Mage::getStoreConfig('eva/color/nav_top_menu_text_hover_color') : '';
	}
	
	public function get_nav_sub_menu_font() {
		return Mage::getStoreConfig('eva/color/nav_sub_menu_font') ? Mage::getStoreConfig('eva/color/nav_sub_menu_font') : '';
	}
	
	public function get_nav_sub_menu_text_color() {
		return Mage::getStoreConfig('eva/color/nav_sub_menu_text_color') ? Mage::getStoreConfig('eva/color/nav_sub_menu_text_color') : '';
	}
	
	public function get_nav_sub_menu_text_hover_color() {
		return Mage::getStoreConfig('eva/color/nav_sub_menu_text_hover_color') ? Mage::getStoreConfig('eva/color/nav_sub_menu_text_hover_color') : '';
	}
	
	public function get_caption_bg_color() {
		return Mage::getStoreConfig('eva/color/caption_bg_color') ? Mage::getStoreConfig('eva/color/caption_bg_color') : '';
	}
	
	public function get_block_title_font() {
		return Mage::getStoreConfig('eva/color/block_title_font') ? Mage::getStoreConfig('eva/color/block_title_font') : '';
	}
	
	public function get_block_title_color() {
		return Mage::getStoreConfig('eva/color/block_title_color') ? Mage::getStoreConfig('eva/color/block_title_color') : '';
	}
	
	public function get_secondary_color() {
		return Mage::getStoreConfig('eva/color/secondary_color') ? Mage::getStoreConfig('eva/color/secondary_color') : '';
	}
	
}