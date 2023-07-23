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

class CCodeNewsTicker {

	private static function obStart() {
		ob_start();
	}

	private static function obEnd() {
		$html = ob_get_contents();
		if ( !empty($html) ) {
			ob_end_clean();
		}
		return $html;
	}

	private static function compact( $s ) {
		$s = str_replace("\t","",$s);
		$s = str_replace("\n","",$s);
		$s = str_replace("\r","",$s);
		return $s;
	}

	public static function getSelector( $prefix, $id ) {
		return $prefix . $id;
	}

	public static function renderIstyle( $selector, $rec ) {
		self::obStart();
?>
/*-- [BEGIN] css reset --*/
%ctar% table,
%ctar% tbody,
%ctar% tfoot,
%ctar% thead,
%ctar% tr,
%ctar% th,
%ctar% td {
	margin:0;
	padding:0;
	border:0;
	font-size:100%;
	vertical-align:top;
	background-color:transparent;
	box-shadow:none;
}
%ctar% img {
	margin:0;
	padding:0;
	border:0;
	background-color:transparent;
	box-shadow:none;
}
%ctar% table {
	border-collapse:collapse;
	border-spacing:0;
}
/*-- [END] css reset --*/
%ctar% .ntic-ctar-inner {
	border-radius:0.21em;
	overflow:hidden;
}
%ctar% .ntic-ctar-table {
	width:100.1%; 
}
%ctar% .ntic-btn-dir {
	font-family:Arial;
	width:1.35em;
	text-align:center;
	vertical-align:middle;
	cursor:pointer;

	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select:none;
}
%ctar% .ntic-btn-dir:hover {
	opacity:0.7;
}
%ctar% .ntic-btn-dir .ntic-btn-dir-icon {
	position:relative;
	top:-0.03em;
}
%ctar% .ntic-btn-prev .ntic-btn-dir-icon {
	left:-0.02em;
}
%ctar% .ntic-btn-next .ntic-btn-dir-icon {
	left:0.02em;
}
%ctar% .ntic-btn-dir:active .ntic-btn-dir-icon span {
	position:relative;
	top:1px;
	left:1px;
}
%ctar% .ntic-cell-display {
	overflow:hidden;
}
%ctar% .ntic-display {
	position:relative;
	margin:0.2em 0.4em;
}
%ctar% .ntic-board-bg {
	position:relative;
}
%ctar% .ntic-board {
	position:absolute;
	left:0;
	top:0;
}
%ctar% .ntic-msg {
	position:relative;
	white-space:nowrap;
}
%ctar% .ntic-msg div,
%ctar% .ntic-msg p,
%ctar% .ntic-msg h1,
%ctar% .ntic-msg h2,
%ctar% .ntic-msg h3,
%ctar% .ntic-msg h4,
%ctar% .ntic-msg h5,
%ctar% .ntic-msg h6,
%ctar% .ntic-msg ul,
%ctar% .ntic-msg li,
%ctar% .ntic-msg ol,
%ctar% .ntic-msg dl,
%ctar% .ntic-msg pre,
%ctar% .ntic-msg hr {
	display:inline;
	padding-right:1em;
}
<?php if ($rec["rc_ctar"]): ?>
%ctar% .ntic-ctar-inner {border:1px solid <?php echo $rec["rc_ctar"]; ?>;}
<?php endif; ?>
<?php if ($rec["fc_news"]): ?>
%ctar% .ntic-cell-display {color:<?php echo $rec["fc_news"]; ?>; }
<?php endif; ?>
<?php if ($rec["bc_news"]): ?>
%ctar% .ntic-cell-display {background-color:<?php echo $rec["bc_news"]; ?>;}
<?php endif; ?>
<?php if ($rec["fc_btn"]): ?>
%ctar% .ntic-btn-dir {color:<?php echo $rec["fc_btn"]; ?>;}
<?php endif; ?>
<?php if ($rec["bc_btn"]): ?>
%ctar% .ntic-btn-dir {background-color:<?php echo $rec["bc_btn"]; ?>;}
<?php endif; ?>
<?php
		$s = self::compact(self::obEnd());
		$s = str_replace("%ctar%","." . $selector, $s);
		return $s;
	}

	public static function renderIarea( $rec ) {
		self::obStart();
?>
<div class="ntic-ctar-inner">
	<table class="ntic-ctar-table" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="ntic-btn-dir ntic-btn-prev">
			<span class="ntic-btn-dir-icon">
				<span><?php echo $rec["icon_prev"]; ?></span>
			</span>
		</td>
		<td class="ntic-cell-display">
			<div class="ntic-display">
				<div class="ntic-board-bg">&nbsp;</div>
				<div class="ntic-board">
					<div class="ntic-msg"></div>
				</div>
			</div>
		</td>
		<td class="ntic-btn-dir ntic-btn-next">
			<span class="ntic-btn-dir-icon">
				<span><?php echo $rec["icon_next"]; ?></span>
			</span>
		</td>
	</tr>
	</table>
</div>
<?php
		return self::compact(self::obEnd());
	}

	public static function save( $id ) {
		CDb::open();
		$rs = CTable::findByID( "nticker", "nticker_id", $id, array(
			"nticker_id","idata",
		));
		$rec = array_merge($rs,CJson::decode($rs["idata"]));

		$cfg = CEnv::config("client/ajax");
		$selector = self::getSelector( $cfg["app_selector_prefix"], $id );

		$rec["icon_prev"] = "«";
		$rec["icon_next"] = "»";

		$iarea = CCodeNewsTicker::renderIarea($rec);
		$istyle = CCodeNewsTicker::renderIstyle($selector,$rec);

		CTable::updateByID( "nticker", "nticker_id", $id, array(
			"iarea"=>$iarea,"istyle"=>$istyle,
		));
	}
}

?>