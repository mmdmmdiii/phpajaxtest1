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

if (!document.getElementsByClassName) {
	document.getElementsByClassName = function(cname) {
		var rx = [];
		var eles = document.getElementsByTagName("*");
		var pat = new RegExp("(^|\\s)" + cname + "(\\s|$)");
		for (var i=0; i<eles.length; i++) {
			if (pat.test(eles[i].className)) {
				rx.push(eles[i]);
			}
		}
		return rx;
	};
}

function insertIstyle() {
	var selector = cfg.selector + "-style";
	if ( !document.getElementById(selector) ) {
		var style = document.createElement("style");
		style.type = "text/css";
		style.id = selector;
		if (style.styleSheet){
			style.styleSheet.cssText = cfg.istyle;
		} else {
			style.appendChild(document.createTextNode(cfg.istyle));
		}
		document.getElementsByTagName("head")[0].appendChild(style);
	}
};

function insertIarea() {
	var cname = cfg.appcfg.selector;
	var eles = document.getElementsByClassName(cname);
	if ( !eles.length ) {
		document.write("<div class='"+cname+"'>"+cfg.iarea+"</div>");
	} else {
		for (var i=0; i<eles.length; i++) {
			if ( !eles[i].innerHTML ) {
				eles[i].innerHTML = cfg.iarea;
			}
		}
	}
};

function getVerN( ver ){
	var vx = ver.split(".");
	var cof = 1.0;
	var total = 0.0;
	for( var i=0; i<vx.length; i++ ) {
		total += parseInt(vx[i]) * cof;
		cof = cof / 100;
	}
	return total;
};

function shouldLoadJq( cfg ) {
	var b_load_jq = true;
	if ( window.jQuery ) {
		b_load_jq = false;
		var jq_vn = getVerN(window.jQuery.fn.jquery);
		if ( cfg.jq_min_ver ) {
			if ( jq_vn < getVerN(cfg.jq_min_ver) ) {
				b_load_jq = true;
			}
		}
		if ( cfg.jq_max_ver ) {
			if ( jq_vn >= getVerN(cfg.jq_max_ver) ) {
				b_load_jq = true;
			}
		}
	}
	return b_load_jq;
};

function loadScript(url, callback){
	if ( !url ) {
		callback( false );
		return;
	}

	var script = document.createElement("script");
	script.type = "text/javascript";

	if (script.readyState){/*IE*/
		script.onreadystatechange = function(){
			if (script.readyState == "loaded" ||
				script.readyState == "complete"){
				script.onreadystatechange = null;
				callback( true );
			}
		};
	} else {/*Others*/
		script.onload = function(){
			callback( true );
		};
	}

	script.src = url;

	/*-- document.head.appendChild(script); --*/
	/*-- document.head isn't available to IE<9. Just use  --*/
	document.getElementsByTagName("head")[0].appendChild(script);
};

function runApp(loader) {
	var b = (loader.jQuery && loader.app_main);
	if (b) {
		for( var i=0; i<loader.appcfgx.length; i++ ) {
			loader.app_main(loader.jQuery,loader.appcfgx[i]);
		}
		loader.appcfgx = [];
	}
	return b;
};

function main() {
	insertIstyle();
	insertIarea();

	if (!(cfg.loader_sig in window)) {
		window[cfg.loader_sig] = {
			b_req_jQuery:false,
			b_req_app_main:false,
			jQuery:null,
			app_main:null,
			appcfgx : []
		};
	}
	var loader = window[cfg.loader_sig];

	loader.appcfgx.push(cfg.appcfg);
	if (!runApp(loader)) {
		/*-- load jQuery --*/
		if (!loader.b_req_jQuery) {
			loader.b_req_jQuery = true;
			var url_js1 = shouldLoadJq(cfg) ? cfg.url_js1 : null;
			loadScript(url_js1,function(b_loaded){
				loader.jQuery = window.jQuery;
				if (b_loaded) {
					window.jQuery.noConflict(true);
				}
				runApp(loader);
			});
		}

		/*-- load App --*/
		if (!loader.b_req_app_main) {
			loader.b_req_app_main = true;
			loadScript(cfg.url_js2,function(b_loaded){
				loader.app_main = window[cfg.app_main];
				runApp(loader);
			});
		}
	}
};

main();
