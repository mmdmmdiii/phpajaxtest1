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

class CAppSetup {

	private static function e2n($s) {
		return empty($s) ? null : $s;
	}

	public static function run($data) {
		//-- wdata
		$wdata = CJson::decode($data->requ["wdata"]);

		//-- init db
		CDb::open();

		//-- get root-admin id
		$cfg = CEnv::config("user/root-admin");
		$root_id = $cfg["root-admin-id"];

		//-- personal
		$personal = $wdata["personal"];
		$first_name = self::e2n($personal["first_name"]);
		$last_name = self::e2n($personal["last_name"]);
		$email = self::e2n($personal["email"]);
		$time_zone = $personal["time_zone"];

		CTable::updateByID("user","user_id",$root_id,array(
			"dt_create"=>CAppUTC::utcTStrNow(),
			"first_name"=>$first_name,
			"last_name"=>$last_name,
			"email"=>$email,
			"time_zone"=>$time_zone,
		));

		//-- cfgapp
		$cfgapp = CCfgDb::get("cfgapp");
		$cfgapp["tbl:user:default_time_zone"] = $time_zone;
		CCfgDb::set("cfgapp",$cfgapp);
	}

}

?>