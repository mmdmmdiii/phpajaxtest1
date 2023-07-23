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

class CFend_inpcolor extends CObject {

	public function init () {
		self::load(array(
			"fbc/CFend",
		));

		$this->bind("hd_HtmlHead");
		$this->bind("hd_Content");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
?>
<link rel="stylesheet" href="<?php echo $url_mod; ?>css/CInpColor.css" />
<link rel="stylesheet" href="<?php echo $url_mod; ?>css/CDlgColor.css">
<script type="text/javascript" src="<?php echo $url_mod; ?>js/CColorTool.js"></script>
<script type="text/javascript" src="<?php echo $url_mod; ?>js/CInpColor.js"></script>
<script type="text/javascript" src="<?php echo $url_mod; ?>js/CDlgColor.js"></script>

<?php }

	public function hd_Content() {
		include( dirname(__FILE__) . "/tpl.dialog.inc.php" );
	}

}

?>