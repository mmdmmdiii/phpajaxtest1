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

function runCAjaxNewsTicker( $, appcfg ) {

//-- [polyfill] trim
if (!String.prototype.trim) {
	String.prototype.trim = function () {
		return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
	};
};

//-- [polyfill] JSON
if (!window.JSON) {
	window.JSON = {
		parse: function(sJSON) { return eval('(' + sJSON + ')'); },
		stringify: (function () {
			var toString = Object.prototype.toString;
			var isArray = Array.isArray || function (a) { return toString.call(a) === '[object Array]'; };
			var escMap = {'"': '\\"', '\\': '\\\\', '\b': '\\b', '\f': '\\f', '\n': '\\n', '\r': '\\r', '\t': '\\t'};
			var escFunc = function (m) { return escMap[m] || '\\u' + (m.charCodeAt(0) + 0x10000).toString(16).substr(1); };
			var escRE = /[\\"\u0000-\u001F\u2028\u2029]/g;
			return function stringify(value) {
				if (value == null) {
					return 'null';
				} else if (typeof value === 'number') {
					return isFinite(value) ? value.toString() : 'null';
				} else if (typeof value === 'boolean') {
					return value.toString();
				} else if (typeof value === 'object') {
					if (typeof value.toJSON === 'function') {
						return stringify(value.toJSON());
					} else if (isArray(value)) {
						var res = '[';
						for (var i = 0; i < value.length; i++) {
							res += (i ? ', ' : '') + stringify(value[i]);
						}
						return res + ']';
					} else if (toString.call(value) === '[object Object]') {
						var tmp = [];
						for (var k in value) {
							if (value.hasOwnProperty(k)) {
								tmp.push(stringify(k) + ': ' + stringify(value[k]));
							}
						}
						return '{' + tmp.join(', ') + '}';
					}
				}
				return '"' + value.toString().replace(escRE, escFunc) + '"';
			};
		})()
	};
};

function fix_IE7_overflow_bug(jqo)  {
	if (navigator.appVersion.indexOf("MSIE 7.")!=-1) {
		jqo.wrap($("<div>")
			.css({
				position:"relative",
				overflow:"hidden"
			})
		);
	}
};

function CAjaxNewsTicker( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CAjaxNewsTicker.prototype = {

	isRunnable : function() {
		return ( this.news.length > 0 );
	},

	step_movein : function() {
		var _this = this;

		var nrec = this.news[this.idx];

		this.jqo_msg
			.css({
				visibilty:"hidden"
			})
			.html(nrec.txt);
		this.w_msg = this.jqo_msg.width();

		this.jqo_msg
			.css({
				left:this.jqo_display.width()+"px",
				visibilty:"visible"
			});

		if ( this.t_movein ) {
			this.jqo_msg
				.animate({
					left:0
				},this.t_movein,function(){
					_this.step_pause();
				});
		} else {
			this.jqo_msg
				.css({
					left:0
				});
				this.step_pause();
		}
	},

	step_pause : function() {
		var _this = this;

		if ( this.t_pause ) {
			this.jqo_msg
				.animate({
					opacity:1
				},this.t_pause,function(){
					_this.step_moveout()
				});
		} else {
			this.jqo_msg
				.css({
					opacity:1
				});
				this.step_moveout();
		}
	},

	step_moveout : function() {
		var _this = this;
		if ( this.speed_moveout ) {
			var t = parseInt( this.w_msg * 1000 / this.speed_moveout );
			this.jqo_msg
				.animate({
					left:"-="+this.w_msg+"px"
				},t,"linear",function(){
					_this.step_done();
				});
		}
	},

	step_done : function() {
		this.idx++;
		if ( this.idx >= this.news.length ) {
			this.idx = 0;
		}
		this.step_movein();
	},

	goPrev : function() {
		this.jqo_msg.stop(false,false);
		if ( this.isRunnable() ) {
			this.idx--;
			if ( this.idx < 0 ) {
				this.idx = this.news.length-1;
			}
			this.step_movein();
		}
	},

	goNext : function() {
		this.jqo_msg.stop(false,false);
		if ( this.isRunnable() ) {
			this.idx++;
			if ( this.idx >= this.news.length ) {
				this.idx = 0;
			}
			this.step_movein();
		}
	},

	run : function() {
		this.idx = 0;
		if ( this.isRunnable() ) {
			this.step_movein();
		}
	},

	setup : function() {
		var _this = this;

		//-- jQuery version info
		if ( appcfg.info ) {
			console.log("INFO","[jQuery version]",$.fn.jquery);
		}

		this.news = appcfg.rec.news;

		this.jqo_display = this.jqo_ctar.find(".ntic-display");
		this.jqo_msg = this.jqo_ctar.find(".ntic-msg");
		this.jqo_prev = this.jqo_ctar.find(".ntic-btn-prev");
		this.jqo_next = this.jqo_ctar.find(".ntic-btn-next");

		fix_IE7_overflow_bug(this.jqo_display);

		var news = appcfg.rec.news;
		this.t_movein = appcfg.rec.t_movein;
		this.t_pause = appcfg.rec.t_pause;
		this.speed_moveout = appcfg.rec.speed_moveout;

		this.jqo_prev.click(function(){
			_this.goPrev();
		});

		this.jqo_next.click(function(){
			_this.goNext();
		});

		this.run();
	}

};

$("."+appcfg.selector).each(function(){
	if ( !$(this).data("_obj_") && ($(this).html().length)) {
		var obj = new CAjaxNewsTicker({
			id:appcfg.id,
			jqo_ctar:$(this)
		});
		$(this).data("_obj_",obj);
	}
});

};
