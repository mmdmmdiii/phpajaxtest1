(function($){

//-- [polyfill] trim
if (!String.prototype.trim) {
	String.prototype.trim = function () {
		return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
	};
};

function CInpColor( opt ) {
	for( var key in opt ) { this[key] = opt[key]; }
	this.setup();
};

CInpColor.prototype = {

	setup : function() {

		var _this = this;

		var isSharpHex = function( cc ) {
			if (( 97 <= cc ) && ( cc <= 102 )) { //a-f
				cc -= (97-65);
			}
			return (( 48 <= cc ) && ( cc <= 57 )) || //0-9
				( 35 == cc ) || //#
				(( 65 <= cc ) && ( cc <= 70 )) || //A-F
				(( 8 == cc ) || ( cc == 46 )); //backspace. delete
		}

		this.jqo_inp
			.attr("maxlength","7")
			.keypress(function(e) {
				if ( e.which == 13 ) {
					e.preventDefault();
					_this.setColor($(this).val());
				}
				if ( !isSharpHex(e.which) ) {
					e.preventDefault();
				}
			})
			.blur(function(){
				_this.setColor($(this).val());
			});

		//-- open button
		this.jqo_btn_open = $("<span>")
			.attr("tabindex",0)
			.attr("class","input-group-addon inpcolor-btn");
		this.jqo_inp.before(this.jqo_btn_open);

		this.jqo_preview = $("<div>")
			.attr("class","inpcolor-preview")
			.appendTo(this.jqo_btn_open);

		this.jqo_btn_open
			.click(function(e){
				e.preventDefault();
				CDlgColor.open({
					color:_this.color,
					onOK:function(color){
						_this.setColor(color);
						_this.jqo_btn_open.focus();
					},
					onCancel:function(){
						_this.jqo_btn_open.focus();
					}
				});
			})
			.keydown(function(e){
				if (( e.which == 13 ) || ( e.which == 32 )) {
					e.preventDefault();
					$(this).click();
				}
			});

		//-- clear button
		this.jqo_btn_clear = $("<span>")
			.attr("tabindex",0)
			.html($("<span>")
				.attr("class","glyphicon glyphicon-remove-circle")
			)
			.attr("class","input-group-addon inpcolor-btn")
			.insertAfter(this.jqo_inp)
			.click(function(e){
				e.preventDefault();
				_this.setColor("");
			})
			.keydown(function(e){
				if (( e.which == 13 ) || ( e.which == 32 )) {
					e.preventDefault();
					$(this).click();
				}
			});

		//-- set data
		this.setData({color:this.jqo_inp.val()});
		this.updatePreview();
	},

	setColor : function( color ) {
		color = color.trim();
		if ( color != "" ) {
			if ( !CColorTool.isColorStr( color ) ) {
				color = this.color;
			}
			color = color.toUpperCase();
		}
		this.setData({color:color});

		this.updateInput();
		this.updatePreview();
		if ( this.onChange ) {
			this.onChange( color );
		}
	},

	setData : function( data ) {
		this.color = data.color;
	},

	updateInput : function() {
		this.jqo_inp.val(this.color);
	},

	updatePreview : function() {
		if ( this.color == "" ) {
			this.jqo_preview
				.addClass("inpcolor-preview-empty")
				.css({
					"background-color":"transparent"
				});
		} else {
			this.jqo_preview
				.removeClass("inpcolor-preview-empty")
				.css({
					"background-color":this.color
				});
		}
	},

	change : function( onChange ) {
		this.onChange = onChange;
	}

};

window.initCInpColor = function() {
	$(".inpcolor").each( function(){
		if ( !$(this).data("_obj_") ) {
			var obj = new CInpColor({jqo_inp:$(this)});
			$(this).data("_obj_",obj);
		}
	});
};

}(jQuery));
