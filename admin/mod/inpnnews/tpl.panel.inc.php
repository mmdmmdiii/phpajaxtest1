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
<div id="inpnnews-panel-tpl" style="display:none">

<div class="inpnnews-panel">
	<div class="inpnnews-panel-inner">
		<table class="inpnnews-panel-content"
		width="100%"
		cellpadding="0"
		cellspacing="0"
		border="0">
		<tr>
		<td class="inpnnews-cell inpnnews-cell-handle">
			<div class="inpnnews-pbtn inpnnews-pbtn-handle"
				title="<?php echo $lca["title:handle"]; ?>">
				<span class="glyphicon glyphicon-resize-vertical"></span>
			</div>
		</td>
		<td class="inpnnews-cell inpnnews-cell-up">
			<div class="inpnnews-pbtn inpnnews-pbtn-up" tabindex="0"
				title="<?php echo $lca["title:up"]; ?>">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</div>
		</td>
		<td class="inpnnews-cell inpnnews-cell-down">
			<div class="inpnnews-pbtn inpnnews-pbtn-down" tabindex="0"
				title="<?php echo $lca["title:down"]; ?>">
				<span class="glyphicon glyphicon-chevron-down"></span>
			</div>
		</td>
		<td class="inpnnews-cell-long inpnnews-cell-txt">
			<div class="inpnnews-txt-ctar"><div class="inpnnews-txt-viewport"
				><div class="inpnnews-txt-board"><div class="inpnnews-txt-panel"
				></div></div></div></div>
		</td>
		<td class="inpnnews-cell inpnnews-cell-edit">
			<div class="inpnnews-pbtn inpnnews-pbtn-edit" tabindex="0"
				title="<?php echo $lca["title:edit"]; ?>">
				<span class="glyphicon glyphicon-pencil"></span></div>
		</td>
		<td class="inpnnews-cell inpnnews-cell-addnew">
			<div class="inpnnews-pbtn inpnnews-pbtn-addnew" tabindex="0"
				title="<?php echo $lca["title:addnew"]; ?>">
				<span class="glyphicon glyphicon-plus-sign"></span>
			</div>
		</td>
		<td class="inpnnews-cell inpnnews-cell-sel">
			<div class="inpnnews-pbtn inpnnews-pbtn-sel" tabindex="0" data-sel="0"
				title="<?php echo $lca["title:sel"]; ?>">
				<span class="glyphicon glyphicon-unchecked"></span>
			</div>
		</td>
		</tr>
		</table>
	</div>
</div>

</div><!-- /inpnnews-panel-tpl -->

<?php // ?>