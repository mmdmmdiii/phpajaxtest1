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

class CInpNnews {

	public static function validate( $data ) {
		$news = $data->fm["news"];
		$idx = 0;
		$rx = array();
		foreach( $news as $nn ) {
			if ( !$nn["txt"] ) {
				$rx[$idx] = "empty";
			}
			$idx++;
		}
		$data->resp["inpnnews"] = $rx;
		if ( count($rx) ) {
			$lca = CEnv::locale( "inpnnews/validate" );
			CFRes::addEA( $lca["err:empty:news"] );
		}

		$data->vx["news"] = $data->fm["news"];
	}

}

?>