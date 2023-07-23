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

include_once( dirname(dirname(__FILE__)) . "/config/config.env.inc.php" );
include_once( dirname(dirname(__FILE__)) . "/lib/sys/index.inc.php" );
include_once( dirname(__FILE__) . "/include/index.inc.php" );

CEnv::useLib("app");
CEnv::useLib("admin");
CEnv::useLib("db");

CPreProc::checkPhpVersion();

?>