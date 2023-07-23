/*js
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
*/

(function($){

CNtickerRec = {

	init : function( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }

		var _this = this;

		this.cajax = new CCAjax();
		this.jms = new CJMS();
	},

	selectTab : function( tab ) {
		this.jqo_menu.find("li").removeClass("active");
		this.jqo_menu.find(".ntickerrec-tab-btn-"+tab).addClass("active");

		this.jqo_ctarent.find(".ntickerrec-tab-content").hide();
		this.jqo_ctarent.find(".ntickerrec-tab-content-"+tab).show();
		this["activate_tab_"+tab.replace("-","_")]();
		
		CScrollBtn.update();
	},

	activate_tab_settings : function() {
		CNtickerRecSettingsPanel.activate();
	},

	activate_tab_preview : function() {
		CNtickerRecPreviewPanel.activate();
	},

	open : function( resp ) {
		var _this = this;

		var lca = CJRLdr.locale("nticker/bcrumb");
		var jqo = CPageStack.pushPage( null, resp.html, lca["bcrumb:edit"]);

		this.jqo_ctar = this.jqo_ctar_main.prev(".ntickerrec-ctar");
		this.jqo_menu = this.jqo_ctar.find(".ntickerrec-menu");
		this.jqo_ctarent = this.jqo_ctar.find(".ntickerrec-content");

		this.id = resp.id;

		//-- init components
		initCInpSave();
		initCInpCb();
		initCInpRb();

		this.jqo_menu.find(".btn-close").click(function(e){
			e.preventDefault();
			_this.pc_close();
		});

		this.jqo_menu.find(".ntickerrec-tab-btn-settings").click(function(e){
			e.preventDefault();
			_this.pc_tab_settings();
		});

		this.jqo_menu.find(".ntickerrec-tab-btn-preview").click(function(e){
			e.preventDefault();
			_this.pc_tab_preview();
		});

		CNtickerRecSettingsPanel.init({
			id:this.id,
			jqo_ctar:this.jqo_ctarent.find(".ntickerrec-tab-content-settings")
		});

		CNtickerRecPreviewPanel.init({
			id:this.id,
			jqo_ctar:this.jqo_ctarent.find(".ntickerrec-tab-content-preview")
		});

		this.selectTab(resp.subcmd);
	},

	pc_close : function() {
		CPageStack.popPage();
		CNticker.activate({b_reload:true});
	},

	pc_tab_settings : function() {
		this.selectTab("settings");
	},

	pc_tab_preview : function() {
		this.selectTab("preview");
	}

};

}(jQuery));
