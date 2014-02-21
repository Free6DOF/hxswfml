/*
 * format - haXe File Formats
 *
 * Copyright (c) 2008-2009, The haXe Project Contributors
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *   - Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE HAXE PROJECT CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE HAXE PROJECT CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 */
package format.png;
import format.png.Data;

class Tools {

	public static function getHeader( d : Data ) : Header {
		for( c in d )
			switch( c ) {
			case CHeader(h): return h;
			default:
			}
		throw "Header not found";
	}

	static inline function filter( rgba : #if flash10 format.tools.MemoryBytes #else haxe.io.Bytes #end, x, y, stride, prev, p ) {
		var b = rgba.get(p - stride);
		var c = x == 0 || y == 0  ? 0 : rgba.get(p - stride - 4);
		var k = prev + b - c;
		var pa = k - prev; if( pa < 0 ) pa = -pa;
		var pb = k - b; if( pb < 0 ) pb = -pb;
		var pc = k - c; if( pc < 0 ) pc = -pc;
		return (pa <= pb && pa <= pc) ? prev : (pb <= pc ? b : c);
	}
	
	public static function extract32( d : Data ) : haxe.io.Bytes {
		var h = getHeader(d);
		var rgba = haxe.io.Bytes.alloc(h.width * h.height * 4);
		var data = null;
		var fullData : haxe.io.BytesBuffer = null;
		var palette:Array<Array<Int>> = [];
		var paletteTrans:Array<Int>=[];
		for( c in d )
		{
			trace(c);
			switch( c ) {
			case CData(b):
				if( fullData != null )
					fullData.add(b);
				else if( data == null )
					data = b;
				else {
					fullData = new haxe.io.BytesBuffer();
					fullData.add(data);
					fullData.add(b);
					data = null;
				}
			case CPalette(b):
				var input = new haxe.io.BytesInput(b);
				for(i in 0...Std.int(b.length/3))
				{
					var paletteColor = [];
					paletteColor.push(input.readByte());
					paletteColor.push(input.readByte());
					paletteColor.push(input.readByte());
					palette.push(paletteColor);
				}
				
			case CTransparency(b):
				var input = new haxe.io.BytesInput(b);
				for(i in 0...b.length)
				{
					paletteTrans.push(input.readByte());
				}
				for(i in 0...palette.length - paletteTrans.length)
				{
					paletteTrans.push(0xFF);
				}
				
			default:
			}
		}
		if( fullData != null )
			data = fullData.getBytes();
		if( data == null )
			throw "Data not found";
		data = format.tools.Inflate.run(data);
		var r = 0, w = 0;
		var alpha_b:Bool=false;
		switch( h.color ) {
		case ColTrue(alpha):
			alpha_b = true;
			if( h.colbits != 8 )
				throw "Unsupported color mode";
			var width = h.width;
			var stride = (alpha ? 4 : 3) * width + 1;
			if( data.length < h.height * stride ) throw "Not enough data";

			#if flash10
			var bytes = data.getData();
			var start = h.height * stride;
			bytes.length = start + h.width * h.height * 4;
			if( bytes.length < 1024 ) bytes.length = 1024;
			flash.Memory.select(bytes);
			var realData = data, realRgba = rgba;
			var data = format.tools.MemoryBytes.make(0);
			var rgba = format.tools.MemoryBytes.make(start);
			#end
			//ABRG
			for( y in 0...h.height ) {
				var f = data.get(r++);
				//trace("f:"+f);
				switch( f ) {
				case 0://Each byte is unchanged.
					if( alpha )
						for( x in 0...width ) {
							rgba.set(w++,data.get(r+0));//R
							rgba.set(w++,data.get(r+1));//G
							rgba.set(w++,data.get(r+2));//B
							rgba.set(w++,data.get(r+3));//A
							r += 4;
						}
					else
						for( x in 0...width ) {
							rgba.set(w++,data.get(r+0));//R
							rgba.set(w++,data.get(r+1));//G
							rgba.set(w++,data.get(r+2));//B
							rgba.set(w++,0xFF);//A
							r += 3;
						}
				case 1://Each byte is replaced with the difference between it and the 'corresponding byte' to its left.
					var cr = 0, cg = 0, cb = 0, ca = 0;
					if( alpha )
						for( x in 0...width ) {
							cr += data.get(r + 0);	rgba.set(w++,cr);//R
							cg += data.get(r + 1);	rgba.set(w++,cg);//G
							cb += data.get(r + 2);	rgba.set(w++,cb);//B
							ca += data.get(r + 3);	rgba.set(w++,ca);//A
							r += 4;
						}
					else
						for( x in 0...width ) {
							cr += data.get(r + 0);	rgba.set(w++,cr);//R
							cg += data.get(r + 1);	rgba.set(w++,cg);//G
							cb += data.get(r + 2);	rgba.set(w++,cb);//B
							rgba.set(w++, 0xFF);//A
							r += 3;
						}
				case 2://Each byte is replaced with the difference between it and the byte above it (in the previous row, as it was before filtering). 
					var stride = y == 0 ? 0 : width * 4;
					if( alpha )
						for( x in 0...width ) {
							rgba.set(w, data.get(r + 0) + rgba.get(w - stride));	w++;//R
							rgba.set(w, data.get(r + 1) + rgba.get(w - stride));	w++;//G
							rgba.set(w, data.get(r + 2) + rgba.get(w - stride));	w++;//B
							rgba.set(w, data.get(r + 3) + rgba.get(w - stride));	w++;//A
							r += 4;
						}
					else
						for( x in 0...width ) {
							rgba.set(w, data.get(r + 0) + rgba.get(w - stride));	w++;//R
							rgba.set(w, data.get(r + 1) + rgba.get(w - stride));	w++;//G
							rgba.set(w, data.get(r + 2) + rgba.get(w - stride));	w++;//B
							rgba.set(w++,0xFF);//A
							r += 3;
						}
				case 3://Each byte is replaced with the difference between it and the average of the corresponding bytes to its left and above it, truncating any fractional part. 
					var cr = 0, cg = 0, cb = 0, ca = 0;
					var stride = y == 0 ? 0 : width * 4;
					if( alpha )
						for( x in 0...width ) {
							cr = (data.get(r + 0) + ((cr + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cr);//R
							cg = (data.get(r + 1) + ((cg + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cg);//G
							cb = (data.get(r + 2) + ((cb + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cb);//B
							ca = (data.get(r + 3) + ((ca + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, ca);//A
							r += 4;
						}
					else
						for( x in 0...width ) {
							cr = (data.get(r + 0) + ((cr + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cr);//R
							cg = (data.get(r + 1) + ((cg + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cg);//G
							cb = (data.get(r + 2) + ((cb + rgba.get(w - stride)) >> 1)) & 0xFF; rgba.set(w++, cb);//B
							rgba.set(w++, 0xFF);//A
							r += 3;
						}
				case 4://Each byte is replaced with the difference between it and the Paeth predictor of the corresponding bytes to its left, above it, and to its upper left. 
					var stride = width * 4;
					var cr = 0, cg = 0, cb = 0, ca = 0;
					if( alpha )
						for( x in 0...width ) {
							cr = (filter(rgba, x, y, stride, cr, w) + data.get(r + 0)) & 0xFF; rgba.set(w++, cr);//R
							cg = (filter(rgba, x, y, stride, cg, w) + data.get(r + 1)) & 0xFF; rgba.set(w++, cg);//G
							cb = (filter(rgba, x, y, stride, cb, w) + data.get(r + 2)) & 0xFF; rgba.set(w++, cb);//B
							ca = (filter(rgba, x, y, stride, ca, w) + data.get(r + 3)) & 0xFF; rgba.set(w++, ca);//A
							r += 4;
						}
					else
						for( x in 0...width ) {
							cr = (filter(rgba, x, y, stride, cr, w) + data.get(r + 0)) & 0xFF; rgba.set(w++, cr);//R
							cg = (filter(rgba, x, y, stride, cg, w) + data.get(r + 1)) & 0xFF; rgba.set(w++, cg);//G
							cb = (filter(rgba, x, y, stride, cb, w) + data.get(r + 2)) & 0xFF; rgba.set(w++, cb);//B
							rgba.set(w++, 0xFF);//A
							r += 3;
						}
				default:
					throw "Invalid filter "+f;
				}
			}

			#if flash10
			var b = realRgba.getData();
			b.position = 0;
			b.writeBytes(realData.getData(), start, h.width * h.height * 4);
			#end

		case ColIndexed:
			if( h.colbits != 8 && h.colbits != 4)
				throw "Unsupported color mode: "+h.colbits +". Currently only 4 and 8 are supported for ColorIndexed png types.";
			var g=0;
			var s=0;
			for(y in 0...h.height)
			{
				var filter = data.get(g); g++;
				trace("filter:"+filter);
				for(x in 0...Std.int(h.width/(8/h.colbits)))
				{
					var byte = data.get(g); g++;
					if(h.colbits==8)
					{
						var index = byte;
						var color = palette[index];
						var red = color[0];
						var green = color[1];
						var blue = color[2];
						var alpha = paletteTrans[index];
						
						rgba.set(s,red); s++;
						rgba.set(s,green); s++;
						rgba.set(s,blue); s++;
						rgba.set(s,alpha); s++;
					}
					else if(h.colbits==4)
					{
						var index = byte  >> 4;//upper 4 bits
						var color = palette[index];
						var red = color[0];
						var green = color[1];
						var blue = color[2];
						var alpha = paletteTrans[index];
						
						rgba.set(s,red); s++;
						rgba.set(s,green); s++;
						rgba.set(s,blue); s++;
						rgba.set(s,alpha); s++;
						
						var index = byte % 16; // lower 4 bits
						var color = palette[index];
						var red = color[0];
						var green = color[1];
						var blue = color[2];
						var alpha = paletteTrans[index];

						rgba.set(s,red); s++;
						rgba.set(s,green); s++;
						rgba.set(s,blue); s++;
						rgba.set(s,alpha); s++;
					}
				}
			}
		
		default:
			throw "Unsupported PNG image type : "+Std.string(h.color);
		}
		return rgba;
	}

	public static function build24( width : Int, height : Int, data : haxe.io.Bytes ) : Data {
		var rgb = haxe.io.Bytes.alloc(width * height * 3 + height);
		// translate RGB to BGR and add filter byte
		var w = 0, r = 0;
		for( y in 0...height ) {
			rgb.set(w++,0); // no filter for this scanline
			for( x in 0...width ) {
				rgb.set(w++,data.get(r+2));
				rgb.set(w++,data.get(r+1));
				rgb.set(w++,data.get(r));
				r += 3;
			}
		}
		var l = new List();
		l.add(CHeader({ width : width, height : height, colbits : 8, color : ColTrue(false), interlaced : false }));
		l.add(CData(format.tools.Deflate.run(rgb)));
		l.add(CEnd);
		return l;
	}

	public static function build32BE( width : Int, height : Int, data : haxe.io.Bytes ) : Data {
		var rgba = haxe.io.Bytes.alloc(width * height * 4 + height);
		// translate ARGB to RGBA and add filter byte
		var w = 0, r = 0;
		for( y in 0...height ) {
			rgba.set(w++,0); // no filter for this scanline
			for( x in 0...width ) {
				rgba.set(w++,data.get(r+1)); // r
				rgba.set(w++,data.get(r+2)); // g
				rgba.set(w++,data.get(r+3)); // b
				rgba.set(w++,data.get(r)); // a
				r += 4;
			}
		}
		var l = new List();
		l.add(CHeader({ width : width, height : height, colbits : 8, color : ColTrue(true), interlaced : false }));
		l.add(CData(format.tools.Deflate.run(rgba)));
		l.add(CEnd);
		return l;
	}

	public static function build32LE( width : Int, height : Int, data : haxe.io.Bytes ) : Data {
		var rgba = haxe.io.Bytes.alloc(width * height * 4 + height);
		// translate ARGB to RGBA and add filter byte
		var w = 0, r = 0;
		for( y in 0...height ) {
			rgba.set(w++,0); // no filter for this scanline
			for( x in 0...width ) {
				rgba.set(w++,data.get(r+2)); // r
				rgba.set(w++,data.get(r+1)); // g
				rgba.set(w++,data.get(r)); // b
				rgba.set(w++,data.get(r+3)); // a
				r += 4;
			}
		}
		var l = new List();
		l.add(CHeader({ width : width, height : height, colbits : 8, color : ColTrue(true), interlaced : false }));
		l.add(CData(format.tools.Deflate.run(rgba)));
		l.add(CEnd);
		return l;
	}
	
	//for DefineBitsLoss in swf: ARGB[image data size] The RGB data must already be multiplied by the alpha channel value.
	public static function rgba2argbmult( width : Int, height : Int, data : haxe.io.Bytes ) : haxe.io.Bytes {
		var argb = haxe.io.Bytes.alloc(width * height * 4);
		// translate RGBA to ARGB and pre-multiply channels with alpha
		var w = 0, r = 0;
		for( y in 0...height ) {
			for( x in 0...width ) {
				var a = data.get(r+3)/0xFF;
				argb.set(w++,data.get(r+3)); // a
				argb.set(w++,Math.round(data.get(r+0)*a)); // r
				argb.set(w++,Math.round(data.get(r+1)*a)); // g
				argb.set(w++,Math.round(data.get(r+2)*a)); // b
				r += 4;
			}
		}
		return argb;
	}
}