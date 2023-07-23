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

CDlgNnews= {

	setup : function() {
		if ( this.b_setup ) { return; }
		this.b_setup = true;

		var _this = this;

		if ( !this.jqo_ctar ) {
			this.jqo_ctar = $(".dlgnnews");
		}

		this.jqo_ctar_form = this.jqo_ctar.find(".ctar-form");
		this.jqo_btn_ok = this.jqo_ctar.find(".btn-ok");
		this.jqo_txt = this.jqo_ctar.find("textarea[name='txt']");

		this.jqo_ctar
			.keydown(function(e){
				if ( e.which == 27 ) {//ESC
					e.preventDefault();
					_this.pc_cancel();
				}
			});

		this.jqo_ctar.find(".btn-cancel,.btn-close")
			.click( function(e){
				e.preventDefault();
				_this.pc_cancel();
			});

		this.jqo_btn_ok
			.click( function(e){
				e.preventDefault();
				_this.pc_ok();
			});

		this.rwin = new CRWindow({
			cwin:this,
			max_w:900,
			max_h:400,
			min_h:400
		});
	},

	open : function( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }
		this.setup( opt );

		//-- open
		this.rwin.open();

		//-- clear error states
		CForm.setFRes( this.jqo_ctar_form );

		//-- init summernote
		var px = {
			lang: 'ja-JP',
			height:210,
			toolbar: [
				// [groupName, [list of button]]
				['style', ['bold', 'italic', 'underline', 'strikethrough','clear']],
				['color', ['color']],
				['insert', ['link']],
				['miso', ['codeview','undo','redo']]
			]
		}

		this.jqo_txt.summernote(px);
		this.jqo_txt.summernote("code",this.txt);
		this.jqo_txt.summernote("focus");

		//-- init dropdown
		this.jqo_ctar.find(".dropdown-toggle").dropdown();
	},

	destroyEditor : function() {
		this.jqo_txt.summernote('destroy');
		this.jqo_txt.hide();
	},

	pc_ok : function() {
		var form = CForm.get(this.jqo_ctar_form);
		this.rwin.close();
		this.destroyEditor();
		if ( this.onOK ) {
			this.onOK(form);
		}
	},

	pc_cancel : function() {
		this.rwin.close();
		this.destroyEditor();
		if ( this.onCancel ) {
			this.onCancel();
		}
	},

	onRedraw : function() {
		this.jqo_ctar.css({
			width:this.rwin.jqo_rwin.width() + "px",
			height:this.rwin.jqo_rwin.height() + "px"
		});

		var h = (this.rwin.jqo_rwin.height()-(50*2+120+10));
		this.jqo_txt.css({
			height:h + "px"
		});
	}
};

}(jQuery));
