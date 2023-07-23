CColorTool = {

	isColorStr : function( color ) {
		return ( /^#([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(color) )
			? true : false;
	},

	hslToHslc : function( hsl ) {
		return hsl.h + "," + hsl.s + "%," + hsl.l + "%";
	},

	rgbToHex : function( rgb ) {
		var hex =
			String("00" + (rgb.r).toString(16)).slice(-2) +
			String("00" + (rgb.g).toString(16)).slice(-2) +
			String("00" + (rgb.b).toString(16)).slice(-2);
		return hex;
	},

	hexToRgb : function( hex ) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
	},

	rgbToHsl : function( rgb ) {
		var r = rgb.r / 255;
		var g = rgb.g / 255;
		var b = rgb.b / 255;

		var max = r;
		if ( g > max ) { max = g; }
		if ( b > max ) { max = b; }

		var min = r;
		if ( g < min ) { min = g; }
		if ( b < min ) { min = b; }

		var h;
		var s;
		var l = ( max + min ) / 2;
		var d = max - min;
		if( d == 0 ){
			h = s = 0; // achromatic
		} else {
			s = d / ( 1 - Math.abs( 2 * l - 1 ) );
			switch( max ) {
				case r:
					h = 60 * ( ( ( g - b ) / d ) % 6 ); 
						if (b > g) {
						h += 360;
					}
					break;
				case g:
					h = 60 * ( ( b - r ) / d + 2 ); 
					break;
				case b:
					h = 60 * ( ( r - g ) / d + 4 ); 
					break;
			}
		}

		return {
			h: Math.round( h ),
			s: Math.round( s * 100 ),
			l: Math.round( l * 100 )
		};
	},

	hslToRgb : function( hsl ){
		// h = 0 .. 360
		// s = 0 .. 100
		// l = 0 .. 100

		var h = ( hsl.h % 360 ) / 360;
		var s = hsl.s / 100;
		var l = hsl.l / 100;
		var r = l;
		var g = l;
		var b = l;
		v = (l <= 0.5) ? (l * (1.0 + s)) : (l + s - l * s);
		if (v > 0){
			var m;
			var sv;
			var sextant;
			var fract;
			var vsf;
			var mid1;
			var mid2;

			m = l + l - v;
			sv = ( v - m ) / v;
			h *= 6.0;
			sextant = Math.floor(h);
			fract = h - sextant;
			vsf = v * sv * fract;
			mid1 = m + vsf;
			mid2 = v - vsf;

			switch (sextant) {
				case 0:
					r = v;
					g = mid1;
					b = m;
					break;
				case 1:
					r = mid2;
					g = v;
					b = m;
					break;
				case 2:
					r = m;
					g = v;
					b = mid1;
					break;
				case 3:
					r = m;
					g = mid2;
					b = v;
					break;
				case 4:
					r = mid1;
					g = m;
					b = v;
					break;
				case 5:
					r = v;
					g = m;
					b = mid2;
					break;
			  }
		}

		return {
			r:Math.round( r * 255.0 ),
			g:Math.round( g * 255.0 ),
			b:Math.round( b * 255.0 )
		};
	},

	hsvToHsl : function( hsv ){
		var s = hsv.s / 100;
		var v = hsv.v / 100;
		var l = ( (2-s) * v ) / 2;
		var sat;
		switch( l ) {
		case 0:
			sat = 0;
			break;
		case 1:
			sat = 1;
			break;
		default:
			sat = ( s * v ) / ( l < 0.5 ? ( l*2 ) : (2-l*2) );
			break;
		}
		return {
			h:Math.round( hsv.h ),
			s:Math.round( sat * 100 ),
			l:Math.round( l * 100 )
		};
	},

	hslToHsv : function( hsl ) {
		var s = hsl.s / 100;
		var l = hsl.l / 100;
		var t = s * ( l < 0.5 ? l : 1-l );

		return {
			h : Math.round( hsl.h ),
			s : Math.round( (( l > 0 ) ? (( 2 * t ) / ( l + t )) : s ) * 100 ),
			v : Math.round( ( l + t ) * 100 )
		};
	},

	rgbToHsv : function( rgb ) {
		var hsl = this.rgbToHsl(rgb);
		return this.hslToHsv(hsl);
	},

	hsvToRgb : function( hsv ) {
		return this.hslToRgb(this.hsvToHsl(hsv));
	}
};

