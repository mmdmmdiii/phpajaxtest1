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

function CInpSummernote( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CInpSummernote.prototype = {

	setup : function(){
		var _this = this;
	},

	getData : function() {
		var v = this.jqo_inp.summernote('code');
		console.log(v);
		return v;
	}
};

window.initCInpSummernote = function() {
	$(".inpsummernote").each( function(){
		if ( !$(this).data("_obj_") ) {
			var obj = new CInpSummernote({jqo_inp:$(this)});
			$(this).data("_obj_",obj);
		}
	});
};

}(jQuery));
