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
?>
<footer>
<?php if ( !empty($lca_ai[ "site:name" ]) ): ?>
<div class="site-name-container"><span class="site-name btn-a"
	data-href="<?php echo $lca_ai[ "site:url" ]; ?>"
	data-target="_blank"
	><?php echo $lca_ai[ "site:name" ]; ?></span></div>
<?php endif; ?>
</footer>
<?php // ?>