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

$cfg["loader_sig"] = "sig-CAjaxNewsTickerV105";
//$cfg["url_js1"] = "http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js";
$cfg["url_js1"] = CEnv::urlClient() . "js/jquery-1.2.6.js";
$cfg["jq_min_ver"] = "1.2.6";
$cfg["jq_max_ver"] = "3.2.2";
$cfg["fn_js2"] = "CAjaxNewsTicker.min.js";

$cfg["app_selector_prefix"] = "ajaxnewsticker-ctar-";
$cfg["app_main"] = "runCAjaxNewsTicker";

?>