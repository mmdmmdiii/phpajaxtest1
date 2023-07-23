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

class CFend_inpnnews extends CObject {

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
<script>var url_be_entry_inpnnews = "<?php echo CApp::vurl("inpnnews","_be=1"); ?>";</script>

<link rel="stylesheet" href="<?php echo $url_mod; ?>css/CDlgNnews.css">
<script src="<?php echo $url_mod; ?>js/CDlgNnews.js"></script>

<link rel="stylesheet" href="<?php echo $url_mod; ?>css/CInpNnews.css">
<script src="<?php echo $url_mod; ?>js/CScrollBoard.js"></script>
<script src="<?php echo $url_mod; ?>js/CInpNnews.js"></script>

<?php }

	public function hd_Content() {
		$lca = CEnv::locale("inpnnews/editor");

		include( dirname(__FILE__) . "/tpl.editor.inc.php" );
		include( dirname(__FILE__) . "/tpl.panel.inc.php" );
		include( dirname(__FILE__) . "/tpl.dialog.inc.php" );
	}

}

?>