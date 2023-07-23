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
	$lca = CEnv::locale("inpcolor/dlgcolor");
?>
<div class="dlg dlgcolor">
	<div class="dlg-heading"><span class="dlg-heading-title"><?php echo $lca["title"]; ?></span>
		<button type="button" class="close btn-close" aria-label="Close"
			title="<?php echo $lca["alt:close"]; ?>">
			<span aria-hidden="true">&times;</span></button>
	</div>

	<div class="dlg-body">
		<div class="clpk-ctar">
			<div class="clpk-panels"><div tabindex="0"
					class="clpk-satval"><div
					class="clpk-sat"></div><div
					class="clpk-val"></div><div
					class="clpk-sv-cursor"></div></div>
				<div class="clpk-hue" tabindex="0"><div
					class="clpk-hue-cursor"></div></div>
			</div>
			<div class="clpk-status"><div
				class="clpk-hex"><span></span></div><div
				class="clpk-preview"></div>
			</div>
		</div>
	</div>

	<div class="dlg-footer">
		<button type="button" class="btn btn-primary btn-ok"><?php
			echo $lca["label:ok"]; ?></button>
		<button type="button" class="btn btn-default btn-cancel"><?php echo
			$lca["label:cancel"]; ?></button>
		<div class="clear:both"></div>
	</div>
</div><!-- /dlgcolor -->

<?php // ?>