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

class CBend_nticker extends CBend_crud {

	public function init() {
		$this->tbl_name = "nticker";
		$this->id_name = "nticker_id";
		parent::init();

		$this->bind("hd_search");
		$this->bind("hd_edit_inp");
		$this->bind("hd_edit_done");
		$this->bind("hd_reg_inp");
		$this->bind("hd_reg_done");
		$this->bind("hd_del_multi");
		$this->bind("hd_pin");
		$this->bind("hd_copy");
	}

	public function setupRec( &$rs ) {
		if ( !isset($rs["gname"]) ) {
			$rs["gname"] = ( isset($rs["username"]) ) ?
				$rs["username"] : "";
		}
	}

	public function pc_search( $data ) {

		//-- select clause
		$sx = array(
			$this->id_name,
			"nticker.dt_create",
			"nticker.group_id",
			"nticker.pinidx",
			"nticker.title",
			"nticker.notes",
		);
		if ( CUG::isAdmin() ) {
			$sx[] = "user.username";
		}

		$data->clx[] = CSql::clSelect($sx);

		//-- from clause
		$fromx = array();
		$fromx[] = CSql::clFrom($this->tbl_name);
		$fromx[] = CSql::clLeftJoin("user","group_id",
			$this->tbl_name,"group_id");
		$data->clx[] = implode("\n",$fromx);

		//-- where clause
		$cond = array();

		//-- search criteria
		$criteria = $data->requ["criteria"];
		$keyword = $criteria["keyword"];

		if ( $keyword != "" ) {
			$cond2 = array();
			$cond2[] = CSql::clCond("nticker.title","L%%",$keyword);
			$cond2[] = CSql::clCond("nticker.notes","L%%",$keyword);
			if ( CUG::isAdmin() ) {
				$cond2[] = CSql::clCond("user.username","=",$keyword);
			}
			$cond[] = CSql::clCondOp("OR",$cond2);
		}
		$this->addGroupIdCond( $cond );
		if ( count($cond) > 0  ) {
			$data->clx[] = CSql::clWhere("AND",$cond);
		}
	}

	protected function validate( $data ) {

		//-- locale
		$lca = CEnv::locale( $this->tbl_name."/validate" );

		//-- vali macro
		CValiMacro::setup($data, $lca);
		if ( $data->cmd == "reg_done" ) {
			CValiMacro::vStr("title");
		} else {
			CValiMacro::vCheckbox("pinidx");
			CValiMacro::vStr("title");
			CValiMacro::vStr("notes",false);
			CValiMacro::vInt("t_movein");
			CValiMacro::vInt("t_pause");
			CValiMacro::vInt("speed_moveout");
			CValiMacro::vColor("fc_news",false);
			CValiMacro::vColor("bc_news",false);
			CValiMacro::vColor("rc_ctar",false);
			CValiMacro::vColor("fc_btn",false);
			CValiMacro::vColor("bc_btn",false);

			CInpNnews::validate( $data );
		}
	}

	public function pc_edit_inp( $data ) {

		//-- select clause
		$sx = array(
			$this->id_name,
			"nticker.dt_create",
			"nticker.group_id",
			"nticker.pinidx",
			"nticker.title",
			"nticker.notes",
			"nticker.idata",
		);
		$data->clx[] = CSql::clSelect($sx);

		//-- from clause
		$fromx = array();
		$fromx[] = CSql::clFrom($this->tbl_name);
		$fromx[] = CSql::clLeftJoin("user","group_id",
			$this->tbl_name,"group_id");
		$data->clx[] = implode("\n",$fromx);

		//-- return subcmd
		$data->resp['subcmd'] = $data->requ["subcmd"];
	}

	public function pc_edit_done_validate( $data ) {
		//-- rearrange fields
		$ls = array(
			"news",
			"t_movein",
			"t_pause",
			"speed_moveout",
			"fc_news",
			"bc_news",
			"rc_ctar",
			"fc_btn",
			"bc_btn",
		);
		$vx = array();
		foreach( $ls as $key ) {
			$vx[$key] = $data->vx[$key];
			unset($data->vx[$key]);
		}
		$data->vx["idata"] = CJson::encode($vx);

		return true;
	}

	public function pc_edit_done_after_save( $data ) {
		CCodeNewsTicker::save( $data->id );
	}

	public function pc_reg_done_validate( $data ) {

		//-- dt_create, user_id, group_id
		$data->vx["dt_create"] = CAppUTC::utcTStrNow();
		$data->vx["user_id"] = CSess::getUserInfo("user_id");
		$data->vx["group_id"] = CSess::getUserInfo("group_id");

		//-- other fields
		$lca = CEnv::locale($this->tbl_name."/reg.init");
		$data->vx = array_merge($data->vx,$lca["form"]);

		return true;
	}

	public function pc_reg_done_after_save( $data ) {
		CCodeNewsTicker::save( $data->id );
	}

	public function pc_copy( $data ) {

		//-- locale
		$lca = CEnv::locale( $this->tbl_name."/validate" );

		//-- vali macro
		CValiMacro::setup($data, $lca);
		CValiMacro::vStr("title");
		CValiMacro::vInt("group_id");
		if ( !CFRes::isValidated() ) {
			return false;
		}

		if (!($rs = $this->getRec($data))) {
			return false;
		}

		//-- rearrange data
		unset($rs["nticker_id"]);
		$rs["dt_create"] = gmdate("Y-m-d H:i:s");
		$rs["title"] = $data->vx["title"];
		$rs["user_id"] = CSess::getUserInfo("user_id");
		$rs["group_id"] = $data->vx["group_id"];
		$data->vx = $rs;

		return true;
	}

	public function pc_copy_after_save( $data ) {
		CCodeNewsTicker::save( $data->new_id );
	}

}

?>