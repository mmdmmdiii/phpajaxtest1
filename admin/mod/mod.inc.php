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

$mods = array();

//-- default entry
$mods["main"] = array(
	"vrtp"=>"/^$/",
);

//-- bootstrap template
$mods["btpl"] = null;

//-- login & out
$mods["login"] = array(
	"dir"=>"auth"
);
$mods["logout"] = array(
	"dir"=>"auth"
);

//-- application pages
$mods["nticker"] = null;
$mods["run-preview"] = array(
	"dir"=>"nticker"
);
$mods["about"] = null;
$mods["user"] = null;
$mods["cfgapp"] = null;

$mods["inpnnews"] = null;

?>