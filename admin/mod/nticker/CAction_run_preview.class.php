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

class CAction_run_preview extends CAction {

	public function main() {
		$inme = isset($_REQUEST["inme"]) ? $_REQUEST["inme"] : "script";
		$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
		switch( $inme ) {
		default:
			$obj = new CInstCode_scripttag();
			break;
		}

		$obj->setup($id);
		$txt = $obj->getHtmlSrc();
		echo $txt;
	}

}

?>