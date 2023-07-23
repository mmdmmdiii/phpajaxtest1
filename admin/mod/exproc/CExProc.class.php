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

class CExProc {

	public static function main( $cmd, $data ) {
		switch( $cmd ) {
		case "logout":
			//exit("logout");
			break;

		case "session:start":
			CAppUTC::setup(CSess::getUserInfo("time_zone"));
			//CAppUTC::setup("UTC");
			break;

		case "htmlhead:cfg":
			//$cfgapp_org = CCfgDb::get("cfgapp");
			//unset($cfg["..."]);
			//$cfgapp["first-dow"] = $cfgapp_org["app:first-dow"];
			//CJRLdr::loadConfig("cfgapp",$cfgapp);
			break;
		}
	}

}

?>