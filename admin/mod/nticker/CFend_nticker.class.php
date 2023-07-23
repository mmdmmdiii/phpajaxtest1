<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// AjaxNewsTicker v1.05
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : SNTQK-105
// URL : http://www.phpkobo.com/ajax-news-ticker
//
// This software is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2 of the
// License.
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

class CFend_nticker extends CObject {

	public function init() {
		$this->bind("hd_HtmlHead");
		$this->bind("hd_Content");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
?>
<?php CJRLdr::loadLocale("nticker/bcrumb"); ?>
<?php CJRLdr::loadLocale("nticker/del-multi"); ?>

<link href="<?php echo $url_mod; ?>css/CNticker.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CNticker.js"></script>

<link href="<?php echo $url_mod; ?>css/CNtickerRec.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CNtickerRec.js"></script>

<link href="<?php echo $url_mod; ?>css/CInstCode.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>js/CNtickerRecSettingsPanel.js"></script>
<script src="<?php echo $url_mod; ?>js/CNtickerRecPreviewPanel.js"></script>
<?php }

	public function hd_Content() {
		include( dirname(__FILE__) . "/tpl.search.inc.php" );
?>
<?php }

}

?>