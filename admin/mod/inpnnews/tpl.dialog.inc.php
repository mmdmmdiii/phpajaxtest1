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
	$lca_dlg = CEnv::locale("inpnnews/dialog");
	$req = _req();
?>
<div id="inpnnews-dialog-tpl" style="display:none">

<div class="dlg dlgnnews">
	<div class="dlg-heading"><?php echo $lca_dlg["title"]; ?> 
		<button type="button"
			class="close btn-close"
			aria-label="Close"
			title="<?php echo $lca_dlg["alt:close"]; ?>">
		<span aria-hidden="true">&times;</span></button>
	</div>

	<div class="dlg-body">
		<form class="ctar-form">
			<div class="ctar-falert" data-display-mode="dialog"></div>

			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<textarea
							class="form-control inpsummernote _ffe_"
							name="txt"
							style="display:none;"
						></textarea>
					</div>
				</div>
			</div>

		</form>
	</div>

	<div class="dlg-footer">
		<button type="button" class="btn btn-primary btn-ok"><?php
			echo $lca_dlg["label:ok"]; ?></button>
		<button type="button" class="btn btn-default btn-cancel"><?php
			echo $lca_dlg["label:cancel"]; ?></button>
		<div class="clear:both"></div>
	</div>
</div>

</div><!-- /inpnnews-dialog-tpl -->

<?php // ?>