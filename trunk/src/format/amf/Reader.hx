/*
 * format - haXe File Formats
 *
 * Copyright (c) 2008, The haXe Project Contributors
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
package format.amf;
import format.amf.Value;

class Reader {

	var i : haxe.io.Input;

	public function new( i : haxe.io.Input ) {
		this.i = i;
		i.bigEndian = true;
	}

	function readObject() {
		var h = new Map();
		while( true ) {
			var c1 = i.readByte();
			var c2 = i.readByte();
			var name = i.readString((c1 << 8) | c2);
			var k = i.readByte();
			if( k == 0x09 )
				break;
			h.set(name,readWithCode(k, true));
		}
		return h;
	}

	function readArray(n : Int) {
		var a = new Array();
		for( i in 0...n )
			a.push(read());
		return a;
	}

	public function readWithCode( id , inObj:Bool) {
		var i = this.i;
		return switch( id ) {
		case 0x00:
			var out = ANumber( i.readDouble() );
			if(!inObj) i.readByte();
			out;
		case 0x01:
			var out = 
			ABool(
				switch( i.readByte() ) {
				case 0: false;
				case 1: true;
				default: throw "Invalid AMF";
				}
			);
			if(!inObj) i.readByte();
			out;
		case 0x02:
			var len = i.readUInt16();
			var out = AString( i.readString(len) );
			if(!inObj) i.readByte();
			out;
		case 0x03,0x08:
			var ismixed = (id == 0x08);
			var size = if( ismixed ) i.readInt32(); else null;
			var out = AObject(readObject(),size);
			if(!inObj) i.readByte();
			out;
		case 0x05:
			var out = ANull;
			if(!inObj) i.readByte();
			out;
		case 0x06:
			var out = AUndefined;
			if(!inObj) i.readByte();
			out;
		case 0x07:
			throw "Not supported : Reference";
		case 0x0A:
			var out = AArray(readArray(i.readInt32()));
			if(!inObj) i.readByte();
			out;
			
		case 0x0B:
			var time_ms = i.readDouble();
			var tz_min = i.readUInt16();
			var out = ADate( Date.fromTime(time_ms + tz_min * 60 * 1000.0) );
			if(!inObj) i.readByte();
			out;
		case 0x0C:
			var out = AString( i.readString(i.readInt32()) );
			if(!inObj) i.readByte();
			out;
		default:
			throw "Unknown AMF "+id;
		}
	}

	public function read() {
		return readWithCode(i.readByte(), false);
	}
}