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
	$lca = CEnv::locale("nticker/ntickerrec.preview");
	$url_mod = $this->urlMod();
?>
<div class="ppart">
	<div class="ppart-heading">
		<div class="ppart-title"><?php echo $lca["ppart:title:install"]; ?></div>
	</div>
	<div class="ppart-body" style="padding-bottom:20px;">
	<?php include("tpl.inme.inc.php"); ?>
	</div>
</div>
<?php // ?>