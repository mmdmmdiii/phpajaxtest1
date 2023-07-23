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

$lca["form"] = array(
	"pinidx"=>0,
	"idata"=>CJson::encode(array(
		"news"=>array(),
		"t_movein"=>1000,
		"t_pause"=>2000,
		"speed_moveout"=>100,
		"fc_news"=>null,
		"bc_news"=>"#FFFFFF",
		"rc_ctar"=>"#404040",
		"fc_btn"=>"#E0E0E0",
		"bc_btn"=>"#404040"
	))
);

?>