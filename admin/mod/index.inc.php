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

class CAutoloader {

	//-- use addon
	public static function connect( $dir ) {
		include_once( dirname(__FILE__) . "/" . $dir . "/index.inc.php" );
	}

	//-- proc_autoloader
	public static function autoloader( $class, $path_dir ) {
		$path = "{$path_dir}/{$class}.class.php";
		if ( is_file( $path ) ) {
			require_once( $path );
		}
	}

}

CAutoloader::connect("base");
CModule::setup($_rtc);
CRoll::setup($_rtc);
CApp::run($_rtc);

?>