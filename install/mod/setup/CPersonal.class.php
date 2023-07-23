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

class CPersonal {

	private static function validate( $data ) {

		//-- locale
		$lca = CEnv::locale( "install/validate" );

		//-- vali macro
		CValiMacro::setup($data, $lca);
		CValiMacro::vStr("first_name",false);
		CValiMacro::vStr("last_name",false);
		CValiMacro::vEmail("email",false);
		CValiMacro::vStr("time_zone");
	}

	public static function valiForm( $data ) {
		$data->vx = array();
		$data->fm = $data->requ["form"];

		//-- validate
		self::validate( $data );
		if ( !CFRes::isValidated() ) {
			return false;
		}

		return true;
	}

}

?>