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

CFRes = {
	execute : function( resp, jqo_form ) {
		if ( jqo_form != undefined ) {
			CForm.setFRes(jqo_form,resp.fres);
			window.scrollTo(0,0);
		}
		if ( resp.fres.nmsg ) {
			CNotice.show(resp.fres);
		}
		
		return ( resp.fres.b_validated );
	}
};

}(jQuery));
