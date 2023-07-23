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

class CCfgDb {

	public static function get( $ckey ) {
		CDb::open();
		$rs = CTable::findById( "cfgdb", "ckey", $ckey, array("cval") );
		if ( $rs ) {
			$cval = $rs["cval"];
			if ( $cval ) {
				return CJson::decode($cval);
			}
		}
		return array();
	}

	public static function set( $ckey, $cval ) {
		CDb::open();
		CTable::updateById( "cfgdb", "ckey", $ckey, array(
			"cval"=>CJson::encode($cval) ) );
	}

}

?>