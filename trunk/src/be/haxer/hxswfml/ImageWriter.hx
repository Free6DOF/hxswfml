package be.haxer.hxswfml;

import format.swf.Data;
import format.swf.Writer;
import format.mp3.Data;
import format.mp3.Reader;

import haxe.io.Bytes;
import haxe.io.BytesInput;
import haxe.io.BytesOutput;

/**
 * ...
 * @author Jan J. Flanders
 */

class ImageWriter
{
	public var width:Int;
	public var height:Int;
	var bytes:Bytes;
	var extension:String;
	public function new()
	{
	}
	public function write(bytes:Bytes, fileName:String, ?currentTag:Xml=null):Void
	{
		this.bytes=bytes;
		extension = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
		height = 0;
		width = 0;
		var input = new BytesInput(bytes);
		if(extension == 'jpg' || extension == 'jpeg')
		{
			if (input.readByte() != 255 || input.readByte() != 216)
			{
				throw 'ERROR: in image file: ' + fileName + '. SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: ' + currentTag.toString();
			}
			var marker : Int;
			var len : Int;
			while (input.readByte() == 255) 
			{
				marker = input.readByte();
				len = input.readByte() << 8 | input.readByte();

				if (marker == 192)
				{
					input.readByte();
					height = input.readByte() << 8 | input.readByte();
					width = input.readByte() << 8 | input.readByte();
					break;
				}
				input.read(len - 2);
			}
		}
		else if(extension == 'png' )
		{
			input.bigEndian = true;
			input.readInt32();//0x89504e47 SOI
			input.readInt32();//0x0D0A1A0A
			input.readInt32();//0x0000000D THDR
			input.readInt32();//0x49484452
			width = input.readInt32();
			height = input.readInt32();
		}
		else if(extension == 'gif' )
		{
			input.bigEndian = false;
			input.readInt32();//0x47 0x49 0x46 0x38 
			input.readUInt16();//0x39 0x61
			width = input.readUInt16();
			height = input.readUInt16();
		}
	}
	public function getTag(?id:Int=1, ?lossless:Bool=false):SWFTag
	{
		var tag:SWFTag = null;
		if(!lossless)
		{
			tag = TBitsJPEG(id, JDJPEG2(bytes));
		}
		else
		{
			#if (js || php || java || cs)
				tag = TBitsJPEG(id, JDJPEG2(bytes));
			#else
			if(extension=="png")
			{
				var input = new haxe.io.BytesInput(bytes);
				var reader = new format.png.Reader(input);
				var pngData = reader.read();
				var w:Int=0;
				var h:Int=0;
				for( chunk in pngData )
				{
					switch( chunk ) 
					{
						case CHeader( header ):
							w = header.width;
							h = header.height;
						default:
					}
				}
				var bitmapData:haxe.io.Bytes = format.png.Tools.rgba2argbmult(w,h,format.png.Tools.extract32(pngData));
				var zlibBitmapData = null;
				#if neko
				zlibBitmapData = neko.zip.Compress.run(bitmapData, 1);
				#elseif cpp
				zlibBitmapData = cpp.zip.Compress.run(bitmapData, 1);
				//#elseif php
				//var zlibBitmapData = haxe.io.Bytes.ofData(untyped __call__("zlib_encode",bitmapData.getData(), 15, 1));
				//#elseif (java || cs)
				//zlibBitmapData = haxe.zip.Compress.run(bitmapData, 1);
				#elseif flash9
				var byteArray = bitmapData.getData();
				byteArray.compress();
				zlibBitmapData = haxe.io.Bytes.ofData(byteArray);
				#end
				var data =
				{
					cid : id,
					color : CM32Bits,
					width : width,
					height : height,
					data : zlibBitmapData
				}
				tag = TBitsLossless2(data);
			}
			else
			{
				tag = TBitsJPEG(id, JDJPEG2(bytes));
				//tag = TBitsJPEG(id, JDJPEG3(bytes,Bytes.alloc(0)));
			}
			#end
		}
		return tag;
	}
	public function getSWF(?id:Int=1):Bytes
	{
		var placeObject2 = new PlaceObject();
		placeObject2.depth = 1;
		placeObject2.move = false;
		placeObject2.cid = id;
		placeObject2.bitmapCache = null;
		var swfFile = 
		{
			header: {version:10, compressed:true, width:width, height:height, fps:30, nframes:1},
			tags: 
			[
				getTag(id,true),
				getShape(id),
				TPlaceObject2(placeObject2),
				TShowFrame
			]
		}
		var swfOutput:haxe.io.BytesOutput = new haxe.io.BytesOutput();
		var writer = new Writer(swfOutput);
		writer.write(swfFile);
		return swfOutput.getBytes();
	}
	public function getShape(id):SWFTag
	{
			var width = width * 20;
			var height = height * 20;
			return TShape(id, SHDShape1({left : 0, right : width, top : 0,  bottom : height}, 
			{
				fillStyles:[FSBitmap(id, {scale : null, rotate : null, translate : {x : 0, y : 0}}, false, false)],
				lineStyles:[], 
				shapeRecords:
				[	
					SHRChange({	moveTo : {dx : width, dy : 0}, fillStyle0 : {idx : 1}, fillStyle1 : null, lineStyle : null, newStyles : null}), 
					SHREdge(0, height), SHREdge(- width, 0), SHREdge(0, - height), SHREdge( width, 0), SHREnd 
				]
			}));
	}
}