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
<link href="<?php echo $url_mod; ?>css/CSetup.css" rel="stylesheet">
<link href="<?php echo $url_mod; ?>css/CPermCheck.css" rel="stylesheet">
<link href="<?php echo $url_mod; ?>css/CDone.css" rel="stylesheet">

<script src="<?php echo $url_mod; ?>js/CSetup.js"></script>
<script>
(function($){
	$(document).ready(function(){
		if ( !CDuan.isTouchDevice() ) {
			$(".homebtn").show();
		}
	});
}(jQuery));
</script>
<?php // ?>