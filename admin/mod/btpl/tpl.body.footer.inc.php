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
	<div class="main">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		<?php echo CSess::getUserInfo("username"); ?>
		<?php //echo " : " . CSess::getUserInfo("sess_exp"); ?> 
	</div>
</footer>
<?php // ?>