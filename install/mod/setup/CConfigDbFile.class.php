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

class CConfigDbFile {

	private static $flist = array(
			"db-hostname",
			"db-database",
			"db-username",
			"db-password",
			"db-tbl-prefix",
		);

	private static function pathFile() {
		return CEnv::pathConfig() . "config.db.inc.php";
	}

	private static function readCfg( $ln, $key ) {
		$key = str_replace("-","\-",$key);

		$double_quoted_string = '"(?:[^"]|\\")*?"';
		$single_quoted_string = "'(?:[^']|\\')*?'";
		$string = "{$double_quoted_string}|{$single_quoted_string}";
		$white_space = '\s*';

		$pat = '/'
			. '\$cfg'
				. '<space>'
				. '\[<space>'
					. '[\"\']'
						. $key
					. '[\'\"]'
					. '<space>' 
				. '\]'
			. '<space>'
			. '='
			. '<space>'
			. '(<string>)'
			. '<space>'
			. '\;'
			. '/';

		$pat = str_replace( "<space>", $white_space, $pat );
		$pat = str_replace( "<string>", $string, $pat );

		if ( preg_match( $pat, $ln, $mx ) ) {
			$s = $mx[1];
			return substr( $s, 1, strlen($s)-2 );
		}
		return null;
	}

	public static function checkPermission() {
		$path = self::pathFile();
		return is_readable( $path ) && is_writeable( $path );
	}

	public static function load( &$px ) {
		$path = self::pathFile();
		$txt = file_get_contents($path);
		foreach( self::$flist as $key ) {
			$val = self::readCfg( $txt, $key );
			if (( $key == "db-tbl-prefix" ) && is_null($val) ) {
				return false;
			}
			$px[$key] = $val;
		}
		return true;
	}

	public static function save( $px ) {
		$sx = array();
		$sx[] = "<?php";
		$sx[] = "";
		foreach( self::$flist as $key ) {
			$sx[] = '$cfg["' . $key . '"] = "' . $px[$key] . '";';
		}
		$sx[] = "";
		$sx[] = "?>";
		$txt = implode("\r\n",$sx);

		$path = self::pathFile();
		file_put_contents($path,$txt);
	}

}

?>