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

function CColorCursor( opt ) {
	for ( var key in opt ) { this[key] = opt[key]; }
};

CColorCursor.prototype = {

	activate : function() {
		var offset = this.jqo_board.offset();
		var cw = this.jqo_cursor.outerWidth();
		var ch = this.jqo_cursor.outerHeight();
		this.board = {
			x:offset.left,
			y:offset.top,
			w:this.jqo_board.width(),
			h:this.jqo_board.height(),
			cw:cw,
			ch:ch,
			dx:(cw-1)/2,
			dy:(ch-1)/2
		};
		this.c_left = -1;
		this.c_top = -1;

		this.moveCursor();
	},

	update : function() {
		if ( this.onSVMove ) {
			this.onSVMove.call(this.caller,
				Math.round((this.c_left*100)/(this.board.w-1)),
				100-Math.round((this.c_top*100)/(this.board.h-1))
			);
		}

		if ( this.onHueMove ) {
			this.onHueMove.call(this.caller,
				360-Math.round((this.c_top*360)/(this.board.h-1))
			);
		}
	},

	nudgeCursor : function( dir ) {
		switch( dir ) {
		case "up":
			var top = this.c_top;
			top--;
			if ( top < 0 ) {
				top = 0;
			}
			this.posCursor(this.c_left,top);
			break;
		case "down":
			var top = this.c_top;
			top++;
			if ( top > this.board.h-1 ) {
				top = this.board.h-1;
			}
			this.posCursor(this.c_left,top);
			break;
		case "left":
			var left = this.c_left;
			left--;
			if ( left < 0 ) {
				left = 0;
			}
			this.posCursor(left,this.c_top);
			break;
		case "right":
			var left = this.c_left;
			left++;
			if ( left > this.board.w-1 ) {
				left = this.board.w-1;
			}
			this.posCursor(left,this.c_top);
			break;
		}
	},

	setHueCursor : function( hue ) {
		var top = Math.round( (360-hue) * (this.board.h-1) / 360 );
		this.posCursor( 0, top );
	},

	setSVCursor : function( sat, val ) {
		var left = Math.round( sat * (this.board.w-1) / 100 );
		var top = Math.round( (100-val) * (this.board.h-1) / 100 );

		this.posCursor( left, top );
	},

	posCursor : function( left, top ) {
		if ( this.ctype == "hue" ) {
			left = this.board.dx-2;
		}

		this.jqo_cursor.css({
			left:left-this.board.dx+"px",
			top:top-this.board.dy+"px"
		});

		this.c_left = left;
		this.c_top = top;
		this.update();
	},

	moveCursor : function( e ) {
		var left, top;
		if ( e ) {
			var x = e.pageX-this.board.dx;
			var y = e.pageY-this.board.dy;

			var left = x - this.board.x;
			if ( left < 0 ) { left = 0; }
			if ( left >= this.board.w ) { left = this.board.w-1; }

			var top = y - this.board.y;
			if ( top < 0 ) { top = 0; }
			if ( top >= this.board.h ) { top = this.board.h-1; }
		} else {
			left = this.board.w-1;
			top = 0;
		}

		if (( left != this.c_left ) || ( top != this.c_top )) {
			this.posCursor( left, top );
		}

	},

	addMouseCapture : function( e ) {
		e.preventDefault();
		if (e.which != 1) { return false; }

		var _this = this;

		//-- [BEGIN] Mouse Move
		var h_mousemove = function( e ) {
			e.preventDefault();
			if (e.which != 1) return false; 

			//-- move cursor
			_this.moveCursor( e );
		};
		//-- [END] Mouse Move

		//-- [BEGIN] Mouse Up
		var h_mouseup = function( e ) {
			e.preventDefault();
			if (e.which != 1) return false; 

			//-- enable right click
			$("body").unbind( "contextmenu" );

			//-- release mouse
			$(document).unbind( "mousemove", h_mousemove );
			$(document).unbind( "mouseup", h_mouseup );

			//-- move cursor
			_this.moveCursor( e );
		};
		//-- [END] Mouse Up

		//-- capture mouse
		$(document).mousemove( h_mousemove );
		$(document).mouseup( h_mouseup );

		//-- disable right click
		$("body").bind("contextmenu", function(e) {
			return false;
		});

		//-- fix chrome cursor problem while dragging
		if ( e.originalEvent.preventDefault ) {
			e.originalEvent.preventDefault();
		}
		//-- move cursor
		this.moveCursor( e );
	}

};

function CColorPicker( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CColorPicker.prototype = {

	isIE7 : function() {
		return (navigator.appVersion.indexOf("MSIE 7.")!=-1);
	},

	isIE8 : function() {
		return (navigator.appVersion.indexOf("MSIE 8.")!=-1);
	},

	isIE9 : function() {
		return (navigator.appVersion.indexOf("MSIE 9.")!=-1);
	},

	isIE789 : function() {
		return this.isIE7() || this.isIE8() || this.isIE9();
	},

	getColor : function() {
		return this.jqo_hex.find("span").html();
	},

	setColor : function( color ) {
		var hex = color;
		if ( hex.substr(0,1) == "#" ) {
			hex = hex.substr(1);
		}
		var rgb = CColorTool.hexToRgb(hex);
		if ( rgb != null ) {
			var hsv = CColorTool.rgbToHsv(rgb);
			this.hue_cursor.setHueCursor(hsv.h);
			this.sv_cursor.setSVCursor(hsv.s,hsv.v);
			this.updateHex("#"+hex.toUpperCase());
		}
	},

	setupHue : function() {
		var _this = this;

		var str_h = "";
		for( var i=0; i<=180; i++ ) {
			str_h += "<div class='clpk-hue-cell'></div>";
		}
		this.jqo_hue.append(str_h);

		var h = 360;
		$(".clpk-hue .clpk-hue-cell").each(function(){
			var rgb = CColorTool.hslToRgb({ h:h,s:100,l:50 });
			$(this)
				.css({
					"background-color":"#" + CColorTool.rgbToHex(rgb)
				})
				.attr("data-h",h);
			h -= 2;
		});

		this.jqo_hue.find(".clpk-hue-cell").click(function(){
			_this.onHue($(this).attr("data-h"));
		});

		if ( this.isIE7() ) {
			this.jqo_hue.before("<div class='clpk-ie7-space'></div>");
		}
	},

	setupVal : function() {
		if ( !this.is_ie789 ) {
			this.jqo_val.css({
				background:"linear-gradient( 0deg, rgba(0,0,0,1), rgba(0,0,0,0))"
			});
		} else {
			this.jqo_val.css({
				filter:"progid:DXImageTransform.Microsoft.gradient(" + 
					"startColorstr='#00000000'," +
					"endColorstr='#FF000000')"
			});
		}
	},

	setup : function() {

		var _this = this;

		this.is_ie789 = this.isIE789();

		this.jqo_hue = this.jqo_ctar.find(".clpk-hue");
		this.jqo_hue_cursor = this.jqo_hue.find(".clpk-hue-cursor");
		this.jqo_satval = this.jqo_ctar.find(".clpk-satval");
		this.jqo_sat = this.jqo_satval.find(".clpk-sat");
		this.jqo_val = this.jqo_satval.find(".clpk-val");
		this.jqo_sv_cursor = this.jqo_satval.find(".clpk-sv-cursor");
		this.jqo_hex = this.jqo_ctar.find(".clpk-hex");
		this.jqo_preview = this.jqo_ctar.find(".clpk-preview");

		this.jqo_hue
			.keydown(function(e) {
				//-- 37(left),38(up),39(right),40(down)
				switch( e.which ) {
				case 38://up
					e.preventDefault();
					_this.hue_cursor.nudgeCursor("up");
					break;
				case 40://down
					e.preventDefault();
					_this.hue_cursor.nudgeCursor("down");
					break;
				}
			});

		this.jqo_satval
			.keydown(function(e) {
				//-- 37(left),38(up),39(right),40(down)
				switch( e.which ) {
				case 38://up
					e.preventDefault();
					_this.sv_cursor.nudgeCursor("up");
					break;
				case 40://down
					e.preventDefault();
					_this.sv_cursor.nudgeCursor("down");
					break;
				case 37://left
					e.preventDefault();
					_this.sv_cursor.nudgeCursor("left");
					break;
				case 39://right
					e.preventDefault();
					_this.sv_cursor.nudgeCursor("right");
					break;
				}
			});

		this.setupHue();
		this.setupVal();

		this.sv_cursor = new CColorCursor({
			ctype:"sv",
			caller:this,
			jqo_board:this.jqo_satval,
			jqo_cursor:this.jqo_sv_cursor,
			onSVMove:function( sat, val ){
				this.updateSatVal( sat, val );
			} 
		});

		this.hue_cursor = new CColorCursor({
			ctype:"hue",
			caller:this,
			jqo_board:this.jqo_hue,
			jqo_cursor:this.jqo_hue_cursor,
			onHueMove:function( hue ){
				this.onHue( hue );
			} 
		});
		this.jqo_hue.find(".clpk-hue-cell,.clpk-hue-cursor").mousedown(function(e){
			_this.hue_cursor.addMouseCapture(e);
			_this.jqo_hue.focus();
		});

		if ( !this.is_ie789 ) {
			// mousedown comes to overlay (non-IE789)
			var jqo = this.jqo_val;
		} else {
			// mousedown comes to the button element (IE789)
			var jqo = this.jqo_satval;
		}
		jqo.mousedown(function(e){
			_this.sv_cursor.addMouseCapture(e);
			_this.jqo_satval.focus();
		});
		this.jqo_sv_cursor.mousedown(function(e){
			_this.sv_cursor.addMouseCapture(e);
			_this.jqo_satval.focus();
		});

	},

	activate : function() {
		this.sv_cursor.activate();
		this.hue_cursor.activate();
		this.jqo_satval.focus();
	},

	onHue : function( hue ) {
		this.updateSatValBoard( hue );
		this.sv_cursor.update();
	},

	updateSatValBoard : function( hue ) {
		this.hue = hue;

		var rgb = CColorTool.hsvToRgb({
			h:hue,s:100,v:100});
		var hex = CColorTool.rgbToHex(rgb);

		if ( !this.is_ie789 ) {
			this.jqo_sat.css({
				background:"linear-gradient( 90deg, " +
					"#ffffff, #" + hex + ")"
			});
		} else {
			this.jqo_sat.css({
				background:"-ms-linear-gradient(right,#ffffff,#" + hex + ")",
				filter:"progid:DXImageTransform.Microsoft.gradient(" +
					"startColorstr='#ffffff'," +
					"endColorstr='#" + hex + "'," + 
					"GradientType=1)"
			});
		}
	},

	updateSatVal : function( sat, val ) {

		var rgb = CColorTool.hsvToRgb({
			h:this.hue,s:sat,v:val});
		var hex = CColorTool.rgbToHex(rgb);

		this.updateHex("#"+hex.toUpperCase());
		this.updatePreview("#"+hex);
	},

	updateHex : function( color ) {
		this.jqo_hex.find("span").html(color);
	},

	updatePreview : function( color ) {
		this.jqo_preview.css({
			"background-color":color,
			"border-color":color
		});
	}

};

CDlgColor = {

	setup : function() {
		if ( this.b_setup ) { return; }
		this.b_setup = true;

		var _this = this;

		if ( !this.jqo_ctar ) {
			this.jqo_ctar = $(".dlgcolor");
		}

		this.cpicker = new CColorPicker({
			jqo_ctar:this.jqo_ctar.find(".clpk-ctar")
		});

		this.jqo_ctar.find(".btn-ok")
			.click( function(e){
				_this.close();
				if ( _this.onOK ) {
					_this.onOK( _this.cpicker.getColor() );
				}
			});

		this.jqo_ctar.find(".btn-cancel,.btn-close")
			.click( function(e){
				_this.close();
				if ( _this.onCancel ) {
					_this.onCancel();
				}
			});
	},

	open : function( opt ) {
		for( var key in opt ) { this[key] = opt[key]; }
		this.setup( opt );

		var _this = this;

		var w = 252;
		this.rwin = new CRWindow({
			b_keep_on_close:true,
			cwin:this,
			min_w:w,
			max_w:w,
			onReady:function(){
				_this.activate();
			}
		});

		this.rwin.open();
		this.activate();
	},

	activate : function() {
		this.cpicker.activate();
		this.cpicker.setColor( this.color );
	},

	close : function() {
		this.rwin.close();
	}
};

}(jQuery));
