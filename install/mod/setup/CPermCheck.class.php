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

class CPermCheck {

	private static $idx = 0;
	private static $errcnt = 0;

	public static function getErrCnt() {
		return self::$errcnt;
	}

	public static function setupAccessFileList( &$flist ) {
		foreach( $flist as &$rs ) {
			if ( strpos($rs["access"],"r") !== false ) {
				$b = is_readable($rs["path"]);
				$rs["r"] = $b;
				if ( !$b ) { self::$errcnt++; }
			}
			if ( strpos($rs["access"],"w") !== false ) {
				$b = is_writable($rs["path"]);
				$rs["w"] = $b;
				if ( !$b ) { self::$errcnt++; }
			}
		}
	}

	public static function printRWLabel( $lca, $access, $b ) {
		$txt = ( $b ? "<span class='glyphicon glyphicon-ok'></span>" :
			"<span class='glyphicon glyphicon-alert'></span>" ) . " ";

		switch( $access ) {
		case "r":
			$txt .= $lca["text:" . ( $b ? "readable" : "not-readable" )];
			break;
		case "w":
			$txt .= $lca["text:" . ( $b ? "writable" : "not-writable" )];
			break;
		}

		$cls = $b ? "label-success" : "label-danger label-error";
		echo "<span class='label label-rw {$cls}'>{$txt}</span> ";
	}

	public static function printRWLabels( $lca, $rs ) {
		if ( isset($rs["r"]) ) {
			self::printRWLabel( $lca, "r", $rs["r"] );
		}
		if ( isset($rs["w"]) ) {
			self::printRWLabel( $lca, "w", $rs["w"] );
		}
	}

	public static function printIdxLabel() {
		self::$idx++;
		$idx = self::$idx;
		echo "<div class='label-step'>{$idx}</div>";
	}

	public static function printTypeLabel( $lca, $rs ) {
		$txt = $lca["label:" . $rs["type"] ];
		echo "<div class='label-type'>{$txt}</div>";
	}
}

?>