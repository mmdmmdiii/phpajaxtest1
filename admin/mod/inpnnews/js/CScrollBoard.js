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

	function CAutoScroll( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }

		if ( this.dir == "h" ) {
			this.x_coef = 0.2;
			this.speed_ms = 10;
			this.x_activate = 5;//pixel
			this.x_deactivate = this.x_activate * 2;//pixel
		} else {
			this.y_coef = 0.2;
			this.speed_ms = 10;
			this.y_activate = 5;//pixel
			this.y_deactivate = this.y_activate * 2;//pixel
		}
	};

	CAutoScroll.prototype = {

		begin : function( jqo_moving, pageX, pageY ) {
			this.pageX = pageX;
			this.pageY = pageY;

			this.speed = 0;
			this.timer_id = null;
			this.jqo_moving = jqo_moving;

			if ( this.dir == "h" ) {
				this.rel_panel_left = jqo_moving.offset().left - pageX;
				this.rel_panel_right = jqo_moving.offset().left + jqo_moving.width() - pageX;
				this.frame_left = this.jqo_ctar.offset().left;
				this.frame_right = this.jqo_ctar.offset().left + this.jqo_ctar.width();
				this.x_scroll_max = this.jqo_board.outerWidth(true)
					- this.jqo_ctar.width();
			} else {
				this.rel_panel_top = jqo_moving.offset().top - pageY;
				this.rel_panel_bottom = jqo_moving.offset().top + jqo_moving.height() - pageY;
				this.frame_top = this.jqo_ctar.offset().top;
				this.frame_bottom = this.jqo_ctar.offset().top + this.jqo_ctar.height();
				this.y_scroll_max = this.jqo_board.outerHeight(true)
					- this.jqo_ctar.height();
			}
		},

		done : function() {
			if ( this.timer_id != null ) {
				clearInterval( this.timer_id );
				this.timer_id = null;
			}
		},

		mouseMove : function( pageX, pageY ) {
			this.pageX = pageX;
			this.pageY = pageY;

			if ( this.speed == 0 ) {
				this.checkStatus();
				if ( this.speed != 0 ) {
					var _this = this;
					this.timer_id = setInterval(
						function(){ _this.scroll(); },
						this.speed_ms );
				}
			} else {
				this.checkStatus();
				if ( this.speed == 0 ) {
					this.done();
				}
			}
		},

		scroll : function() {
			if ( this.dir == "h" ) {
				var dx = this.speed * this.x_coef;
				var new_scroll_left = this.jqo_ctar.scrollLeft() + dx;
				if ( new_scroll_left < this.x_scroll_max ) {
					this.jqo_ctar.scrollLeft( new_scroll_left, 0 );
					this.scroll_board.mousemove(this);
				}
			} else {
				var dy = this.speed * this.y_coef;
				var new_scroll_top = this.jqo_ctar.scrollTop() + dy;
				if ( new_scroll_top < this.y_scroll_max ) {
					this.jqo_ctar.scrollTop( new_scroll_top, 0 );
					this.scroll_board.mousemove(this);
				}
			}
		},

		checkStatus : function() {
			if ( this.dir == "h" ) {

				var frame_left = this.frame_left;
				var frame_right = this.frame_right;
				var panel_left = this.pageX + this.rel_panel_left;
				var panel_right = this.pageX + this.rel_panel_right;
				var d;

				d = ( panel_left - frame_left ) - this.x_activate;
				if ( d < 0 ) {
					this.speed = d;
					return;
				}

				d = this.x_activate - ( frame_right - panel_right );
				if ( d > 0 ) {
					this.speed = d;
					return;
				}

				d = panel_left - frame_left - this.x_deactivate;
				if ( d > 0 ) {
					this.speed = 0;
					return;
				}

				d = ( this.x_deactivate - ( frame_right - panel_right ) )
				if ( d < 0 ) {
					this.speed = 0;
					return;
				}
			} else {

				var frame_top = this.frame_top;
				var frame_bottom = this.frame_bottom;
				var panel_top = this.pageY + this.rel_panel_top;
				var panel_bottom = this.pageY + this.rel_panel_bottom;
				var d;

				d = ( panel_top - frame_top ) - this.y_activate;
				if ( d < 0 ) {
					this.speed = d;
					return;
				}

				d = this.y_activate - ( frame_bottom - panel_bottom );
				if ( d > 0 ) {
					this.speed = d;
					return;
				}

				d = panel_top - frame_top - this.y_deactivate;
				if ( d > 0 ) {
					this.speed = 0;
					return;
				}

				d = ( this.y_deactivate - ( frame_bottom - panel_bottom ) )
				if ( d < 0 ) {
					this.speed = 0;
					return;
				}
			}
		}
	};

	function CScrollBoard( opt ) {
		for ( var key in opt ) { this[key] = opt[key]; }

		this.jqo_ctar
			.mouseenter( function(){
				document.onselectstart = function(){ return false; }
			})
			.mouseleave( function(){
				document.onselectstart = function(){ return true; }
			});
/*
		// frame should have "relative" & "overflow-x" [IE7 bug fix]
		switch ( this.dir ) {
		case "h":
			this.jqo_ctar.css({
				"position":"relative",
				"overflow-x":"scroll",
				"overflow-y":"hidden"
			});
			break;

		case "v":
			this.jqo_ctar.css({
				"position":"relative",
				"overflow-x":"hidden",
				"overflow-y":"scroll"
			});
			break;

		case "c":
			this.jqo_ctar.css({
				"position":"relative",
				"overflow-x":"hidden",
				"overflow-y":"scroll"
			});
			break;
		}
*/
		this.jqo_board.css("position","relative");

		this.autoscroll = new CAutoScroll({
			dir:this.dir, 
			scroll_board:this,
			jqo_ctar:this.jqo_ctar,
			jqo_board:this.jqo_board
		});
	};

	CScrollBoard.prototype = {

		scrollTo : function(jqo) {
			if ( this.dir == "h" ) {
				var dx = this.jqo_board.offset().left -
					jqo.offset().left;
				this.jqo_ctar.scrollLeft( dx, 0 );
			} else {
				var dy = this.jqo_board.offset().top -
					jqo.offset().top;
				this.jqo_ctar.scrollLeft( 0, dy );
			}
		},

		mousemove : function( e ) {
			var jqo_board = this.jqo_board;
			var jqo_moving = this.jqo_moving;
			var jqo_space = this.jqo_space;

			switch ( this.dir ) {

			case "h":
				//-- move panel
				jqo_moving.offset({
					"top": jqo_moving.offset().top,
					"left": e.pageX - this.rel_pos_x
				});

				//-- move space panel
				var pos_x = jqo_board.offset().left;
				var x = e.pageX - pos_x - this.rel_pos_x;
				var xw = x + jqo_moving.width();

				var pdiv = 3;
				if ( x < jqo_space.offset().left - pos_x ) {
					jqo_board.children().each( function( idx ) {
						var jqo = $(this);
						if ( jqo.is( jqo_space ) ) {
							return false;
						} else if ( !jqo.is( jqo_moving ) ) {
							var w = jqo.width();
							var x1 = jqo.offset().left - jqo_board.offset().left;
							if ( x < x1+w*1/pdiv ) {
								jqo.before( jqo_space );
								return false;
							}
						}
					});
				} else {
					$.each( jqo_board.children().get().reverse(), function( idx ) {
						var jqo = $(this);
						if ( jqo.is( jqo_space ) ) {
							return false;
						} else if ( !jqo.is( jqo_moving ) ) {
							var w = jqo.width();
							var x1 = jqo.offset().left - jqo_board.offset().left;
							if ( xw > x1+w*(pdiv-1)/pdiv ) {
								jqo.after( jqo_space );
								return false;
							}
						}
					});
				}
				break;

			case "v":
				//-- move panel
				jqo_moving.offset({
					"left": jqo_moving.offset().left,
					"top": e.pageY - this.rel_pos_y
				});

				//-- move space panel
				var pos_y = jqo_board.offset().top;
				var y = e.pageY - pos_y - this.rel_pos_y;
				var yh = y + jqo_moving.height();

				var pdiv = 3;
				if ( y < jqo_space.offset().top - pos_y ) {
					jqo_board.children().each( function( idx ) {
						var jqo = $(this);
						if ( jqo.is( jqo_space ) ) {
							return false;
						} else if ( !jqo.is( jqo_moving ) ) {
							var h = jqo.height();
							var y1 = jqo.offset().top - jqo_board.offset().top;
							if ( y < y1+h*1/pdiv ) {
								jqo.before( jqo_space );
								return false;
							}
						}
					});
				} else {
					$.each( jqo_board.children().get().reverse(), function( idx ) {
						var jqo = $(this);
						if ( jqo.is( jqo_space ) ) {
							return false;
						} else if ( !jqo.is( jqo_moving ) ) {
							var h = jqo.height();
							var y1 = jqo.offset().top - jqo_board.offset().top;
							if ( yh > y1+h*(pdiv-1)/pdiv ) {
								jqo.after( jqo_space );
								return false;
							}
						}
					});
				}
				break;

			case "c":
				//-- move panel
				jqo_moving.offset({
					"left": e.pageX - this.rel_pos_x,
					"top": e.pageY - this.rel_pos_y
				});

				//-- move space panel
				var pos_x = jqo_board.offset().left;
				var x = e.pageX - pos_x;

				var pos_y = jqo_board.offset().top;
				var y = e.pageY - pos_y;

				jqo_board.children().each( function( idx ) {
					var jqo = $(this);
					if ( jqo.is( jqo_space ) ) {
						return false;
					} else if ( !jqo.is( jqo_moving ) ) {
						var w = jqo.width();
						var h = jqo.height();
						var x1 = jqo.offset().left - pos_x;
						var y1 = jqo.offset().top - pos_y;
						if (
							(x1<=x) && (x<=x1+w) &&
							(y1<=y) && (y<=y1+h)
						) {
							jqo.before( jqo_space );
							return false;
						}
					}
				});

				$.each( jqo_board.children().get().reverse(), function( idx ) {
					var jqo = $(this);
					if ( jqo.is( jqo_space ) ) {
						return false;
					} else if ( !jqo.is( jqo_moving ) ) {
						var w = jqo.width();
						var h = jqo.height();
						var x1 = jqo.offset().left - pos_x;
						var y1 = jqo.offset().top - pos_y;
						if (
							(x1<=x) && (x<=x1+w) &&
							(y1<=y) && (y<=y1+h)
						) {
							jqo.after( jqo_space );
							return false;
						}
					}
				});
				break;
			}
		},

		mouseup : function( e ) {
			this.jqo_moving.css({
				position:"static",
				"z-index":1,
				opacity:1.0
			});

			this.jqo_space.before( this.jqo_moving );
			this.jqo_space.remove();

			if ( "onEndMove" in this ) {
				this.onEndMove(this.jqo_moving);
			}

			this.jqo_moving = undefined;
		},

		mousedown : function( e, jqo_moving ) {

			//-- keep offset in static mode
			var offset = jqo_moving.offset();
			this.rel_pos_x = e.pageX - offset.left;
			this.rel_pos_y = e.pageY - offset.top;

			//-- setup a dummy panel
			this.jqo_space = $("<div>");

			if ( "onSpaceCreated" in this ) {
				this.onSpaceCreated(this.jqo_space,jqo_moving);
			}

			//-- insert space
			jqo_moving.after( this.jqo_space );

			//-- [BEGIN] Shift to Absolute Mode
			if ( "onBeginMove" in this ) {
				this.onBeginMove(jqo_moving);
			}

			this.jqo_moving = jqo_moving
			.css({
				position:"absolute",
				"z-index":10000,
				opacity:0.5
			});
			//-- [END] Shift to Absolute Mode

			this.jqo_moving.offset( offset );
		},

		canMouseCapture : function( e ) {
			return (e.which == 1);
		},

		addMouseCapture : function( e, jqo_moving, onCompleted ) {
			e.preventDefault();
			if (e.which != 1) { return false; }

			var _this = this;

			//-- [BEGIN] Mouse Move
			var h_mousemove = function( e ) {
				e.preventDefault();
				if (e.which != 1) { return false; }
				if ( _this.jqo_moving == undefined ) { return false; }

				//-- auto scroll
				_this.autoscroll.mouseMove( e.pageX, e.pageY );

				//-- mousemove core
				_this.mousemove(e);
			};
			//-- [END] Mouse Move

			//-- [BEGIN] Mouse Up
			var h_mouseup = function( e ) {
				e.preventDefault();
				if (e.which != 1) { return false; }
				if ( _this.jqo_moving == undefined ) { return false; }

				//-- disable autoscroll
				_this.autoscroll.done();

				//-- enable right click
				$("body").unbind( "contextmenu" );

				//-- release mouse
				$(document).unbind( "mousemove", h_mousemove );
				$(document).unbind( "mouseup", h_mouseup );

				//-- mouseup core
				_this.mouseup(e);

				if ( onCompleted !== undefined ) {
					onCompleted();
				}
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

			//-- init autoscroll
			this.autoscroll.begin( jqo_moving, e.pageX, e.pageY );

			//-- mousedown core
			this.mousedown(e,jqo_moving);
		}
	};

	window.CScrollBoard = CScrollBoard;

}(jQuery));
