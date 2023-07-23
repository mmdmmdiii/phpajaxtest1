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

class CBend_setup extends CBend_crud {

	public function init() {
		$this->bind("hd_goto_page2");
		$this->bind("hd_goto_page3");
		$this->bind("hd_goto_page4");
		$this->bind("hd_goto_page5");
	}

	private function outputPageTpl( $data, $tpl ) {
		self::obStart();
		include( $this->pathMod() . "tpl.page.{$tpl}.inc.php" );
		$html = self::obEnd();

		//-- resp
		$data->resp["html"] = $html;
		$this->ret($data);
	}

	public function hd_goto_page2( $data ) {
		$this->outputPageTpl( $data, "permcheck" );
	}

	public function hd_goto_page3( $data ) {
		$this->outputPageTpl( $data, "personal" );
	}

	public function hd_goto_page4( $data ) {
		if ( !CPersonal::valiForm($data) ) {
			$this->ret($data);
			return;
		}

		$this->outputPageTpl( $data, "dbsetup" );
	}

	public function hd_goto_page5( $data ) {
		//-- CDBSetup
		$data->path_sql = self::pathMod() . "sql/sql.txt";
		if ( !CDBSetup::process( $data ) ) {
			$this->ret($data);
			return;
		}

		//-- application setup
		CAppSetup::run($data);

		//-- output template
		$this->outputPageTpl( $data, "done" );
	}

}

?>