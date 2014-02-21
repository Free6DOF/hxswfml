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

class Reader {

	var i : haxe.io.Input;
	public var checkCRC : Bool;

	public function new(i) {
		this.i = i;
		i.bigEndian = true;
		checkCRC = false;//true
	}

	public function read() : Data {
		for( b in [137,80,78,71,13,10,26,10] )
			if( i.readByte() != b )
				throw "Invalid header";

		var l = new List();
		while( true ) {
			var c = readChunk();
			l.add(c);
			if( c == CEnd )
				break;
		}
		return l;
	}

	function readHeader( i : haxe.io.Input ) : Header {
		i.bigEndian = true;
		var width = i.readInt32();
		var height = i.readInt32();
		var colbits = i.readByte();
		var color = i.readByte();
		var color = switch( color ) {
		case 0: ColGrey(false);
		case 2: ColTrue(false);
		case 3: ColIndexed;
		case 4: ColGrey(true);
		case 6: ColTrue(true);
		default: throw "Unknown color model "+color+":"+colbits;
		};
		var compress = i.readByte();
		var filter = i.readByte();
		if( compress != 0 || filter != 0 )
			throw "Invalid header";
		var interlace = i.readByte();
		if( interlace != 0 && interlace != 1 )
			throw "Invalid header";
		return {
			width : width,
			height : height,
			colbits : colbits,
			color : color,
			interlaced : interlace == 1,
		};
	}

	function readChunk() {
		var dataLen = i.readInt32();
		var id = i.readString(4);
		var data = i.read(dataLen);
		var crc = i.readInt32();
		if( checkCRC ) {
			var b = haxe.io.Bytes.alloc(4);
			for( i in 0...4 )
				b.set(i, id.charCodeAt(i));
			if( haxe.crypto.Crc32.make(b) != crc )
				throw "CRC check failure";
		}
		return switch( id ) {
		case "IEND": CEnd;
		case "IHDR": CHeader(readHeader(new haxe.io.BytesInput(data)));
		case "IDAT": CData(data);
		case "PLTE": CPalette(data);
		case "tRNS": CTransparency(data);
		default: CUnknown(id,data);
		}
	}

}