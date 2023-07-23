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
<div id="inpnnews-editor-tpl" style="display:none">

<div class="inpnnews-editor" data-mode="1">
	<div class="inpnnews-header">
		<div class="inpnnews-header-inner">
			<div class="inpnnews-panel">
				<div class="inpnnews-panel-inner">
					<table class="inpnnews-panel-content"
					width="100%"
					cellpadding="0"
					cellspacing="0"
					border="0">
					<tr>
					<td class="inpnnews-cell-long">
						<span class="inpnnews-title">
						<?php echo $lca["text:title"]; ?> 
						</span>
					</td>
					<td class="inpnnews-cell inpnnews-cell-addnew">
						<div class="inpnnews-pbtn inpnnews-pbtn-addnew"
							tabindex="0"
							title="<?php echo $lca["title:addnew"]; ?>">
							<span class="glyphicon glyphicon-plus-sign"></span>
						</div>
					</td>
					<td class="inpnnews-cell inpnnews-cell-sel">
						<div class="inpnnews-pbtn inpnnews-pbtn-sel" data-sel="0"
							tabindex="0"
							title="<?php echo $lca["title:sel-all"]; ?>">
							<span class="glyphicon glyphicon-unchecked"></span>
						</div>
					</td>
					</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="inpnnews-body"><div class="inpnnews-board"></div></div>

	<div class="inpnnews-footer">
		<div class="inpnnews-footer-inner">
			<div class="inpnnews-panel">
				<div class="inpnnews-panel-inner">
					<span class="badge inpnnews-total pull-left"></span>
					<button type="button"
						class="btn btn-warning inpnnews-pbtn-del pull-right"
						title="<?php echo $lca["title:del"]; ?>">
						<?php echo $lca["label:del"]; ?> 
						<span class="badge inpnnews-selnum"></span>
					</button>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
	</div>
</div>

</div><!-- /inpnnews-editor-tpl -->

<?php // ?>