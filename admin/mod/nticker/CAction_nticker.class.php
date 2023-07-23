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

class CAction_nticker extends CAction {

	public function main() {

		if ( self::isFend() ) {
			self::load(array(
				"btpl/CBaseTpl",
				"fbc/CFend",
				"dtable/CFend_dtable",
				"dlgcopynticker/CFend_dlgcopynticker",
				"inpsave/CFend_inpsave",
				"inpcb/CFend_inpcb",
				"inprb/CFend_inprb",
				"inpint/CFend_inpint",
				"inpcolor/CFend_inpcolor",
				"inpsummernote/CFend_inpsummernote",
				"inpnnews/CFend_inpnnews",
				"inpcopy2clip/CFend_inpcopy2clip",
				"~/CFend_nticker",
				"btpl/CMPage",
			));
		} else {
			self::load(array(
				"fbc",
				"dtable",
				"inpnnews",
				"~/CBend_nticker",
				"fbc/CSAjax",
			));
		}
	}

}

?>