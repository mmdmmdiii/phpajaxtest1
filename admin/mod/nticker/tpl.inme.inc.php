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
	$lca = CEnv::locale("nticker/inme");
?>
<div class="inme-ctar">
	<div class="inme-content">
		<div class="inme-tab-content inme-tab-content-scripttag">
			<?php
				$key = "scripttag";
				$obj = new CInstCode_scripttag();
				$obj->setup($id);
				include("tpl.inme.tab.inc.php");
			?>
		</div>
	</div>
</div>
<?php // ?>