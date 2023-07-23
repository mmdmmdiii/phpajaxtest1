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

class CFend_inpsummernote extends CObject {

	public function init () {
		self::load(array(
			"fbc/CFend",
		));

		$this->bind("hd_HtmlHead");
	}

	public function hd_HtmlHead() {
		$url_mod = $this->urlMod();
		$lca = CEnv::locale("inpsummernote/lc");
?>
<link href="<?php echo $url_mod; ?>fcp.summernote/summernote.css" rel="stylesheet">
<script src="<?php echo $url_mod; ?>fcp.summernote/summernote.js"></script>
<?php if ( $lca["lc"] ): ?>
<script src="<?php echo $url_mod; ?>fcp.summernote/lang/summernote-<?php echo $lca["lc"]; ?>.js"></script>
<?php endif; ?>
<?php CJRLdr::loadLocale("inpsummernote/lc"); ?>
<script src="<?php echo $url_mod; ?>js/CInpSummernote.js"></script>
<style>
.tooltip {
	z-index:90000;
}
</style>

<?php }

}

?>