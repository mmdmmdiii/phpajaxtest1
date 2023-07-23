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

class CClient {

	private static function printLoader( $cfg ) {
		echo "(function( cfg ){";
		include(CAjaxTool::pathMinJs(
			dirname(dirname(__FILE__))."/js/",
			"loader.min.js")
		);
		echo "}(" . CAjaxTool::getConfig($cfg) . "));";
	}

	private static function getRec( $id ) {
		$rec = array();

		CDb::open();
		$rs = CTable::findByID( "nticker", "nticker_id", $id, array(
			"nticker_id","idata","iarea","istyle",
		));

		if ( !$rs ) {
			return null;
		}

		$rec = array_merge($rs,CJson::decode($rs["idata"]));
		return $rec;
	}

	public static function run() {
		CAjaxTool::printHeader();

		//-- read params
		$id = isset( $_REQUEST["id"] ) ? intval($_REQUEST["id"]) : 0;
		$info = isset( $_REQUEST["info"] ) ? intval($_REQUEST["info"]) : 0;
		$rec = self::getRec( $id );

		//-- invalid id
		if ( !$rec ) {
			echo "console.log('invalid id:'+$id);";
			return;
		}

		//-- load ajax config
		$cfg = CEnv::config("client/ajax");

		//-- min.js or .js
		$cfg["url_js2"] = CAjaxTool::urlMinJs(
			CEnv::pathClient()."js/",
			CEnv::urlClient()."js/",
			$cfg["fn_js2"]);

		//-- extra items to cfg
		$selector = CCodeNewsTicker::getSelector($cfg["app_selector_prefix"], $id);
		$cfg["selector"] = $selector;
		$cfg["iarea"] = $rec["iarea"];
		$cfg["istyle"] = $rec["istyle"];

		//-- build appcfg
		$cfg["appcfg"] = array(
			"info"=>$info,
			"id"=>$id,
			"selector"=>$selector,
			"rec"=>$rec,
		);

		//-- emit loader
		self::printLoader($cfg);
	}
}

?>