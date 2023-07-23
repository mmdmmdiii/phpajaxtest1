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

function CInpNnews( opt ) {
	for ( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CInpNnews.prototype = {

	handler_resize : null,
	setupResizeHandler : function() {
		var _this = this;
		if ( this.handler_resize ) {
			$( window ).unbind( "resize", this.handler_resize );
		}
		this.handler_resize = function() {
			setTimeout(function(){
				_this.onResized();
			},100);
		};
		this.handler_resize();
		$( window ).bind( "resize", this.handler_resize );
	},

	onResized : function() {
		this.changeLine();
	},

	breakpoint : 752,
	getChangeLineMode : function() {
		var b_new = ( $(window).width() >= this.breakpoint );
		var b_curr = ( this.jqo_editor.attr("data-mode") == "1" );

		if ( b_new && !b_curr ) {//=>change to 1 line
			return 1;
		}
		if ( !b_new && b_curr ) {//=>change to 2 lines
			return 2;
		}
		return 0;
	},

	change1Line : function( jqo_panel ) {
		var jqo_ctns = jqo_panel.find(".inpnnews-panel-content");
		var jqo_row_1 = jqo_ctns.eq(1);
		var jqo_row_2 = jqo_ctns.eq(0);
		var jqo_row_1_d = jqo_row_1.find(".inpnnews-cell-dummy");
		jqo_row_1_d.after(jqo_row_2.find(".inpnnews-cell-txt"));
		jqo_row_1_d.remove();
		jqo_row_2.remove();
	},

	change2Lines : function( jqo_panel ) {
		var jqo_row_1 = jqo_panel.find(".inpnnews-panel-content");
		jqo_row_1.find(".inpnnews-cell-edit")
			.before($("<td>")
				.attr("class","inpnnews-cell-dummy")
			);
		var jqo_row_2 = jqo_row_1.clone();
		jqo_row_2.find("td").remove();
		jqo_row_2.find("tr")
			.append(jqo_row_1.find(".inpnnews-cell-txt"))
		jqo_row_1.before(jqo_row_2);
	},

	changeLine : function() {
		var _this = this;
		switch( this.getChangeLineMode() ) {
		case 1:
			this.jqo_board.children().each(function(){
				_this.change1Line($(this));
			});
			this.jqo_editor.attr("data-mode",1);
			break;

		case 2:
			this.jqo_board.children().each(function(){
				_this.change2Lines($(this));
			});
			this.jqo_editor.attr("data-mode",2);
			break;
		}
	},

	check : function( jqo, nobg ) {
		jqo.attr("data-sel",1);
		jqo.find("span")
		.removeClass("glyphicon-unchecked")
		.addClass("glyphicon-check");
		if ( nobg === undefined ) {
			jqo.parents(".inpnnews-panel")
				.addClass("has-check");
			this.onSelNumChange();
		}
	},

	uncheck : function( jqo, nobg  ) {
		jqo.attr("data-sel",0);
		jqo.find("span")
		.removeClass("glyphicon-check")
		.addClass("glyphicon-unchecked");
		if ( nobg === undefined ) {
			jqo.parents(".inpnnews-panel")
				.removeClass("has-check");
			this.onSelNumChange();
		}
	},

	addNew : function( jqo, rec ) {
		rec = rec || {txt:""};

		var html = $("#inpnnews-panel-tpl").html();

		if ( jqo == undefined ) {
			this.jqo_board.prepend(html);
			var jqo_new = this.jqo_board.children(".inpnnews-panel").first();
		} else if ( jqo == "init" ) {
			this.jqo_board.append(html);
			var jqo_new = this.jqo_board.children(".inpnnews-panel").last();
		} else {
			jqo.after(html);
			var jqo_new = jqo.next(".inpnnews-panel");
		}
		this.initPanel(jqo_new);

		if ( this.jqo_editor.attr("data-mode") == "2" ) {
			this.change2Lines( jqo_new );
		}

		this.onTotalChange();
		jqo_new.find(".inpnnews-txt-panel").html(rec.txt);
		if ( jqo != "init" ) {
			jqo_new.find(".inpnnews-edit").focus();
		}
	},

	delPenel : function() {
		var jqo = this.jqo_board.find(".inpnnews-pbtn[data-sel='1']");
		if (jqo.length) {
			jqo.parents(".inpnnews-panel").remove();
			this.onSelNumChange();
			this.onTotalChange();
		}
	},

	onSelNumChange : function() {
		var total = this.jqo_board.find(".inpnnews-pbtn-sel").length;
		var selnum = this.jqo_board.find(".inpnnews-pbtn-sel[data-sel='1']").length;
		if ( selnum == total ) {
			this.check(this.jqo_header.find(".inpnnews-pbtn-sel"),true);
		}
		if ( selnum == 0 ) {
			this.uncheck(this.jqo_header.find(".inpnnews-pbtn-sel"),true);
		}
		this.jqo_pbtn_del.prop( "disabled", ( selnum == 0 ) );
		this.jqo_editor.find(".inpnnews-selnum").html(selnum);
	},

	onTotalChange : function() {
		var total = this.jqo_board.find(".inpnnews-panel").length;
		this.jqo_editor.find(".inpnnews-total").html(total);
	},

	initDivBtn : function( jqo, func ) {
		jqo
		.click(func)
		.keypress(function(e) {
			if ((e.which == 13) || (e.which == 32)) {
				func.call(this,e);
			}
		});
	},

	initHeader : function() {
		var _this = this;

		//-- addnew
		this.initDivBtn(this.jqo_header.find(".inpnnews-pbtn-addnew"),function(e){
			e.preventDefault();
			_this.addNew();
		});

		//-- sel
		this.initDivBtn(this.jqo_header.find(".inpnnews-pbtn-sel"),function(e){
			e.preventDefault();
			if ( parseInt($(this).attr("data-sel")) ){
				_this.uncheck($(this),true);
				_this.uncheck(_this.jqo_board.find(".inpnnews-pbtn-sel"));
			} else {
				_this.check($(this),true);
				_this.check(_this.jqo_board.find(".inpnnews-pbtn-sel"));
			}
		});
	},

	initFooter : function() {
		var _this = this;

		this.jqo_pbtn_del
		.click(function(e){
			_this.delPenel();
		});
	},

	initPanel : function( jqo_panel ) {
		var _this = this;

		jqo_panel
		.on("up",function(){
			var jqo_prev = $(this).prev();
			if ( jqo_prev.length ) {
				$(this).prev().before($(this));
			} else {
				$(this).parent()
					.children()
					.last()
					.after($(this));
			}
			$(this).find(".inpnnews-pbtn-up").focus();
		})
		.on("down",function(){
			var jqo_next = $(this).next();
			if ( jqo_next.length ) {
				$(this).next().after($(this));
			} else {
				$(this).parent()
					.children()
					.first()
					.before($(this));
			}
			$(this).find(".inpnnews-pbtn-down").focus();
		})
		.on("addnew",function(){
			_this.addNew($(this));
		});

		jqo_panel.find(".inpnnews-pbtn-handle")
		.mousedown(function(e){
			_this.mousedown(e,$(this).parents(".inpnnews-panel"));
		});

		//-- up
		this.initDivBtn(jqo_panel.find(".inpnnews-pbtn-up"),function(e){
			e.preventDefault();
			$(this).parents(".inpnnews-panel").trigger("up");
		});

		//-- down
		this.initDivBtn(jqo_panel.find(".inpnnews-pbtn-down"),function(e){
			e.preventDefault();
			$(this).parents(".inpnnews-panel").trigger("down");
		});

		//-- txt
		jqo_panel.find(".inpnnews-cell-txt")
			.click(function(){
				$(this).parents(".inpnnews-panel")
					.find(".inpnnews-pbtn-edit")
					.click();
			});

		//-- edit
		jqo_panel.each(function(){
			var jqo_pbtn_edit = $(this).find(".inpnnews-pbtn-edit");

			var func = function(e){
				e.preventDefault();
				var jqo_prt = $(this).parents(".inpnnews-panel");

				CDlgNnews.open({
					cajax:_this.cajax,
					txt:jqo_prt.find(".inpnnews-txt-panel").html(),
					onOK : function( form ){
						//-- [BEGIN] summernote issue
						//-- summernote outputs &quot; in double quotes.
						//-- (e.g.) style="font-family:&quot;Times New Roman&quot;;"
						form.txt = form.txt.replace(/&quot;/g, "'");
						//-- [END] summernote issue

						//-- [BEGIN] summernote issue
						//-- copy&paste CR turns to <div> mostly but sometimes <br>
						//-- replace <br> with "<div>&nbsp;</div>"
						form.txt = form.txt.replace(/<br>/g, "<div>&nbsp;</div>");
						//-- [END] summernote issue
						jqo_prt.find(".inpnnews-txt-panel").html(form.txt);
						jqo_prt.removeClass("has-error");
					},
					onCancel : function(){
						//
					}
				});
			};

			_this.initDivBtn(jqo_pbtn_edit,func);
		});

		//-- addnew
		this.initDivBtn(jqo_panel.find(".inpnnews-pbtn-addnew"),function(e){
			e.preventDefault();
			$(this).parents(".inpnnews-panel").trigger("addnew");
		});

		//-- sel
		this.initDivBtn(jqo_panel.find(".inpnnews-pbtn-sel"),function(e){
			e.preventDefault();
			if ( parseInt($(this).attr("data-sel")) ){
				_this.uncheck($(this));
			} else {
				_this.check($(this));
			}
		});
	},

	mousedown : function(e,jqo) {
		if ( this.scroll_board.canMouseCapture(e) ) {
			this.scroll_board.addMouseCapture( e, jqo );
		}
	},

	setup : function() {
		this.cajax = new CCAjax({
			url_be:url_be_entry_inpnnews
		});
		this.jms = new CJMS();

		var html = $("#inpnnews-editor-tpl").html();
		this.jqo_inp.before(html);
		this.jqo_editor = this.jqo_inp.prev();

		this.jqo_header = this.jqo_editor.find(".inpnnews-header");
		this.jqo_footer = this.jqo_editor.find(".inpnnews-footer");
		this.jqo_pbtn_del = this.jqo_footer.find(".inpnnews-pbtn-del");
		this.jqo_board = this.jqo_editor.find(".inpnnews-body .inpnnews-board");

		this.scroll_board = new CScrollBoard({
			dir:"v",
			jqo_ctar:this.jqo_editor,
			jqo_board:this.jqo_board,
			onSpaceCreated:function(jqo_space,jqo_moving){
				jqo_space
				.addClass("inpnnews-panel-space")
				.css({
					width:jqo_moving.outerWidth()+"px",
					height:jqo_moving.outerHeight()+"px"
				});
			},
			onBeginMove:function(jqo_moving){
				jqo_moving
				.css({
					width:jqo_moving.outerWidth()+"px",
					height:jqo_moving.outerHeight()+"px"
				});
			},
			onEndMove:function(jqo_moving){
				jqo_moving
				.css({
					width:"auto",
					height:"auto"
				});
			}
		});

		//-- init
		var news = JSON.parse(this.jqo_inp.val());
		for( var i = 0; i<news.length; i++ ) {
			var rec = news[i];
			this.addNew("init",rec);
		}

		this.initHeader();
		this.initFooter();
		this.onSelNumChange();
		this.onTotalChange();
		this.setupResizeHandler();
	},

	getData : function(){
		var ls = [];
		this.jqo_board.find(".inpnnews-panel").each(function(){
			var data = {
				txt : $(this).find(".inpnnews-txt-panel").html()
			};
			ls.push( data );
		});
		return ls;
	},

	msgProc : function( msg ){
		switch ( msg.event ) {
		case "saved":
			break;
		case "error":
			if ( msg.resp["inpnnews"] ) {
				var err = msg.resp["inpnnews"];
				for( idx in err ) {
					this.jqo_board.find(".inpnnews-panel")
						.eq(idx)
						.addClass("has-error");
				}
			}
			break;
		}
	}

};

window.initCInpNnews = function() {
	$(".inpnnews").each( function(){
		if ( !$(this).data("_obj_") ) {
			var obj = new CInpNnews({jqo_inp:$(this)});
			$(this).data("_obj_",obj);
		}
	});
};

})(jQuery);

