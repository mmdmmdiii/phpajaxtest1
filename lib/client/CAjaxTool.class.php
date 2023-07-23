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

class CAjaxTool {

	public static function printHeader() {
		header("Content-Type: application/javascript");
	}

	public static function returnAjax( $json ) {
		if ( isset($_GET["callback"]) ) {
			echo $_GET["callback"] . "(" . json_encode( $json ) . ");";
		} else {
			echo json_encode( $json );
		}
	}

	public static function obStart() {
		ob_start();
	}

	public static function obEnd() {
		$html = ob_get_contents();
		if ( !empty($html) ) {
			ob_end_clean();
		}
		return $html;
	}

	public static function getConfig( $px ) {
		return CJson::encode($px);
	}

	public static function pathMinJs( $path, $fn ) {
		return ( file_exists($path . $fn) ) ?
			($path . $fn) :
			($path . str_replace(".min","",$fn));
	}

	public static function urlMinJs( $path, $url, $fn ) {
		return ( file_exists($path . $fn) ) ?
			($url . $fn) :
			($url . str_replace(".min","",$fn));
	}
}

?>