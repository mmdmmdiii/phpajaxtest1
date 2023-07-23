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

class CDBInstaller {

	private static function runSqlText( $px, $sql ) {

		$sql = str_replace(
			" `tbl_",
			" `" . $px["db-tbl-prefix"],
			$sql );

		//-- [BEGIN] Split Sql Text
		$sql = str_replace( "\r", "", $sql );
		$ax = explode( "\n", $sql );
		$bx = array();
		$cx = array();
		foreach( $ax as $s ) {
			if ( substr( $s, 0, 2 ) != "--" ) {
				$s = trim( $s );
				$bx[] = $s;
				if (( strlen( $s ) > 0 ) && ( substr( $s, -1 ) == ";" )) {
					$cx[] = implode( "\n", $bx );
					$bx = array();
				}
			}
		}
		//-- [END] Split Sql Text

		foreach( $cx as $s ) {
			if ( !( $result = CDb::query( $s ) ) ) {
				return false;
			}
		}

		return true;
	}

	public static function run( &$px, $path_sql, &$errmsg ) {
		$lca = CEnv::locale("install/validate");

		//-- check connection error
		if ( $errno = CDb::open($px) ) {
			$msg = $lca["err:cannot-connect-to-db"];
			$msg = str_replace("%hostname%", $px["db-hostname"], $msg);
			$msg .= " : ";
			$msg .= CDb::connectError();
			$msg .= " ({$errno})";
			$errmsg = $msg;
			return false;
		}

		$sql = file_get_contents( $path_sql );
		if ( !self::runSqlText($px, $sql) ) {
			$msg = "";
			$errno = CDb::errno();
			// 1050 : Table already exists
			// 1062 : key for a record already exists
			if (( $errno == 1050 ) || ( $errno == 1062 )) {
				$msg .= $lca["err:table-already-exists"];
				$msg .= " : ";
			}
			$msg .= CDb::error();
			$msg .= " ({$errno})";
			$errmsg = $msg;
			return false;
		}

		return true;
	}
}

?>