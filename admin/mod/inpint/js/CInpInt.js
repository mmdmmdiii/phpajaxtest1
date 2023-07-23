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

function isInt( v ) {
	var x;
	if (isNaN(v)) {
		return false;
	}
	x = parseFloat(v);
	return (x | 0) === x;
};

function CInpInt( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }

	this.init_delay = this.attrInt(this.jqo_inp,"init-delay",500);
	this.repeat_delay = this.attrInt(this.jqo_inp,"repeat-delay",100);
	this.max_val = this.attrInt(this.jqo_inp,"max-val");
	this.min_val = this.attrInt(this.jqo_inp,"min-val",0);
	this.step = this.attrInt(this.jqo_inp,"step",1);
	this.setup();
};

CInpInt.prototype = {

	setup : function() {
		var _this = this;

		var isDigit = function( cc ) {
			return (( 48 <= cc ) && ( cc <= 57 )) || //0-9
				( 45 == cc ) || //-
				(( 8 == cc ) || ( cc == 46 )); //backspace. delete
		}

		this.jqo_inp
			.attr("maxlength","11")
			.css({
				"text-align":"right"
			})
			.keypress(function(e) {
				if ( e.which == 13 ) {
					e.preventDefault();
					_this.setVal($(this).val());
				}
				if ( !isDigit(e.which) ) {
					e.preventDefault();
				}
			})
			.blur(function(){
				_this.setVal($(this).val());
			});

		this.jqo_cont = this.jqo_inp.parents(".input-group").eq(0)
			.wrap("<div class='inpint-ctar'></div>")
			.wrap("<div class='inpint-cell'></div>")
			.parents(".inpint-ctar");

		this.jqo_cont.append(
			$("<div>")
			.attr("class","inpint-cell")
			.append(
				$("<button>")
				.attr("class","btn btn-warning inpint-minus")
				.append($("<span>").attr("class","glyphicon glyphicon-minus"))
			)
			.append(
				$("<button>")
				.attr("class","btn btn-success inpint-plus")
				.append($("<span>").attr("class","glyphicon glyphicon-plus"))
			)
		);

		var b_bootstrap = (typeof $().modal == "function");
		if ( !b_bootstrap ) {
			this.jqo_cont.find(".inpint-plus").html("+");
			this.jqo_cont.find(".inpint-minus").html("-");
		}

		function autoRepeat(jqo,task,init_delay,repeat_delay){
			jqo
				.click(function(e){
					e.preventDefault();
					$(this).trigger(task);
				})
				.mousedown(function(e){
					if (e.which != 1) { return false; }

					var me = $(this);
					me.data("timer_id",-1);
					me.data("repeat_delay",repeat_delay);

					var startX = e.pageX;
					var startY = e.pageY;
					var h_mousemove = function(e){
						var dx = (e.pageX-startX);
						var dy = (e.pageY-startY);
						var dd = ( Math.abs(dx) > Math.abs(dy) ) ? dx : dy;
						var d = repeat_delay - dd;
						if ( d < 1 ) { d = 1; }
						me.data("repeat_delay",d);
					};
					$(document).mousemove(h_mousemove);

					var h_mouseup = function(){
						if ( me.data("timer_id") != -1 ) {
							$(document).unbind( "mousemove", h_mousemove );
							$(document).unbind( "mouseup", h_mouseup );
							var timer_id = me.data("timer_id");
							clearTimeout(timer_id);
						}
						me.data("timer_id",-2);
					};
					$(document).mouseup(h_mouseup);

					if ( me.data("timeout_id") ) {
						clearTimeout(me.data("timeout_id"));
					}

					var repeat_proc = function(){
						me.data("timer_id",setTimeout(function(e){
							me.trigger(task);
							repeat_proc();
						},me.data("repeat_delay")));
					};
					me.data("timeout_id",setTimeout(function(){
						if ( me.data("timer_id") == -1 ) {
							repeat_proc();
						}
					},init_delay));
				});
		};

		//-- plus button
		var jqo = this.jqo_cont.find(".inpint-plus")
			.bind("dotask",function(){
				var i = parseInt(_this.jqo_inp.val());
				if ( !isNaN(i) ) {
					i = i + _this.step;
					_this.setVal(i);
				}
			});
		autoRepeat(jqo,"dotask",this.init_delay,this.repeat_delay);

		//-- minus button
		var jqo = this.jqo_cont.find(".inpint-minus")
			.bind("dotask",function(){
				var i = parseInt(_this.jqo_inp.val());
				if ( !isNaN(i) ) {
					i = i - _this.step;
					_this.setVal(i);
				}
			});
		autoRepeat(jqo,"dotask",this.init_delay,this.repeat_delay);
	},

	setVal : function( val ) {
		if ( !isInt( val ) ) {
			val = this.val;
		} else {
			if ( ( this.max_val !== null ) && ( val > this.max_val ) ) {
				val = this.max_val;
			}
			if ( ( this.min_val !== null ) && ( val < this.min_val ) ) {
				val = this.min_val;
			}
		}
		val = parseInt(val);
		this.setData({val:val});

		this.updateInput();
		if ( this.onChange ) {
			this.onChange( val );
		}
	},

	setData : function( data ) {
		this.val = data.val;
	},

	setDataFromFFE : function() {
		this.setData({val:this.jqo_inp.val()});
	},

	updateInput : function() {
		this.jqo_inp.val(this.val);
	},

	change : function( onChange ) {
		this.onChange = onChange;
	},

	attrInt : function( jqo, key, def ) {
		var val = parseInt(jqo.attr("data-"+key));
		if ( isNaN( val ) ) {
			val = ( def !== undefined ) ? def : null;
		}
		return val;
	}

};

window.initCInpInt = function() {
	$(".inpint").each( function(){
		if ( !$(this).data("_obj_") ) {
			var obj = new CInpInt({jqo_inp:$(this)});
			obj.setDataFromFFE();
			$(this).data("_obj_",obj);
		}
	});
};

}(jQuery));
