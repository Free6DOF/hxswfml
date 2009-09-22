package;
import format.swf.Data;
import format.swf.Reader;
import format.swf.Writer;

import format.mp3.Data;
import format.mp3.Reader;
import format.mp3.Writer;

import haxe.io.Bytes;
import haxe.io.BytesInput;
import haxe.io.BytesOutput;

import neko.Lib;
import neko.io.File;

/**
* ...
* @author jan j.
*/

class XswfML
{
	public static function main() 
	{
		var args:Array<String> = neko.Sys.args();
		if (args.length!=2)
		{
			Lib.println("Usage: hXswfML in.xml out.swf");
		}
		else
		{	
			if(neko.FileSystem.exists(args[0]))
			{
				new HXswfML(args[0], args[1]);
			}
			else
			{
				throw '!' + args[0] + ' does not exist!';
			}
		}
	}
}

class HXswfML
{
	private var fileIn:String;
	private var xml_str:String;
	private var currentTagNode:Xml;
	private var swfBytesOutput:BytesOutput;
	private var swfWriter:format.swf.Writer;
	private var bitmapIds:Array<Array<Int>>;//[[width, height]]
	
	public function new(fileIn:String, fileOut:String)
	{
		bitmapIds = new Array();
		//get xml
		this.fileIn = fileIn;
		var xml:Xml = Xml.parse(File.getContent(fileIn));
		
		//create SWF
		swfBytesOutput = new BytesOutput();
		swfWriter = new format.swf.Writer(swfBytesOutput);
		createSWF(xml);

		//save SWF
		var file = File.write(fileOut,true);
		file.write(swfBytesOutput.getBytes());
		file.close();
	}
	private function createSWF(xml:Xml):Void
	{
		var swfNode:Xml = xml.firstElement();
		for(tagNode in swfNode.elements())
		{
			currentTagNode = tagNode;
			switch(currentTagNode.nodeName.toLowerCase())
			{
				case 'header' :  swfWriter.writeHeader(header());
				case 'fileattributes' : swfWriter.writeTag(fileAttributes());
				case 'setbackgroundcolor' : swfWriter.writeTag(setBackgroundColor());
				case 'scriptlimits' : swfWriter.writeTag(scriptLimits());

				case 'definebitsjpeg2' : swfWriter.writeTag(defineBitsJPEG2());
				case 'defineshape' : swfWriter.writeTag(defineShape());
				case 'definesprite' : swfWriter.writeTag(defineSprite());
				case 'definebutton' : swfWriter.writeTag(defineButton2());
				case 'definebinarydata' : swfWriter.writeTag(defineBinaryData());
				case 'definesound' : swfWriter.writeTag(defineSound());
				case 'definefont' : swfWriter.writeTag(defineFont());
				case 'defineedittext' : swfWriter.writeTag(defineEditText());
				case 'defineabc' : swfWriter.writeTag(defineABC());
					
				case 'placeobject' : swfWriter.writeTag(placeObject2());
				case 'removeobject' : swfWriter.writeTag(removeObject2());
				case 'startsound' : swfWriter.writeTag(startSound());
					
				case 'symbolclass' : swfWriter.writeTag(symbolClass());
					
				case "framelabel" : swfWriter.writeTag(frameLabel());
				case 'showframe' : swfWriter.writeTag(showFrame());
				case 'endframe' : swfWriter.writeTag(endFrame());
				
				default : throw 'Unsupported swf tag : '+ currentTagNode.nodeName;
			}
		}
		swfWriter.writeEnd();
	}
	
	//FILE TAGS
	private function header()
	{
		return
		{
			version:_getInt('version',10), 
			compressed:_getBool('compressed',true), 
			width:_getInt('width',800), 
			height:_getInt('height',600), 
			fps:_getInt('fps',30), 
			nframes:_getInt('frameCount',1)
		};
	}
	private function fileAttributes()
	{
		return 
		TSandBox (
		{
			useDirectBlit:_getBool('useDirectBlit',false), 
			useGPU:_getBool('useGPU',false), 
			hasMetaData:_getBool('hasMetaData',false), 
			actionscript3:_getBool('actionscript3',true), 
			useNetWork:_getBool('useNetwork',false)
		});
	}
	private function setBackgroundColor()
	{
		return TBackgroundColor(_getInt('color',0xffffff));
	}
	private function scriptLimits()
	{
		var maxRecursion = _getInt('maxRecursionDepth',256);
		var timeoutSeconds = _getInt('scriptTimeoutSeconds',15);
		return TScriptLimits(maxRecursion,timeoutSeconds);
	}
	// DEFINE TAGS
	private function defineBitsJPEG2()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var file = _getString('file',"");
		checkAttS(file, 'file');
		var bytes = neko.io.File.getBytes(file);
		storeWidthHeight(id, file, bytes);
		return TBitsJPEG(id, JDJPEG2(bytes));
	}
	private function defineShape()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var bounds;
		var shapeWithStyle;
		if(currentTagNode.exists('bitmapId'))
		{
			var bitmapId = _getInt('bitmapId');
			var width = bitmapIds[bitmapId][0];
			var height = bitmapIds[bitmapId][1];
			var scaleX = _getFloat('scaleX',1.0);
			var scaleY = _getFloat('scaleY',1.0);
			var scale = (scaleX==1.0 && scaleY==1.0)?{x:scaleX*20, y:scaleY*20}:{x:scaleX*20, y:scaleY*20};
			var rotate0 = _getFloat('rotate0',0.0);
			var rotate1 = _getFloat('rotate1',0.0);
			var rotate = (rotate0==0.0 && rotate1==0.0)?{rs0:rotate0*20, rs1:rotate1*20}:{rs0:rotate0*20, rs1:rotate1*20};
			var x = _getInt('x',0);
			var y = _getInt('y',0);
			var translate = (x==0 && y==0)?{x:x*20, y:y*20}:{x:x*20, y:y*20}
			var repeat:Bool = _getBool('repeat',false);
			var smooth:Bool = _getBool('smooth',false);
			bounds = {left :x*20, right : x*20 + width*20, top:y*20,  bottom : y*20 + height*20}
			shapeWithStyle = 
			{
				fillStyles:
				[
					FSBitmap(1, {scale:scale, rotate:rotate, translate:translate}, repeat, smooth)
				],
				lineStyles:
				[
				
				], 
				shapeRecords:
				[	
					SHRChange(
					{	
						moveTo:{dx:x*20+width*20,dy:y*20}, 
						fillStyle0:{idx:1}, 
						fillStyle1:null, 
						lineStyle:null, 
						newStyles:null
					}), 
					SHREdge(x*20, y*20+height*20), 
					SHREdge(x*20-width*20, y*20), 
					SHREdge(x*20, y*20-height*20), 
					SHREdge(x*20+width*20, y*20), 
					SHREnd 
				]
			}
		}
		else
		{
			var width = _getInt('width', null);
			checkAtt(width, 'width');
			var height = _getInt('height', null);
			checkAtt(height, 'height');
			var fillColor = _getInt('fillColor',0x000000);
			var lineColor = _getInt('lineColor',0x000000);
			var lineWidth = _getInt('lineWidth',0);
			var x = _getInt('x',0);
			var y = _getInt('y',0);
			bounds ={ left:x*20, right:x*20+width*20, top:y*20, bottom:y*20 + height*20};
			var fillStyles = 
			[
				FSSolid({r:(fillColor & 0xff0000) >> 16, g:(fillColor & 0x00ff00) >> 8, b:(fillColor & 0x0000ff)})
			] ;
			var lineStyles = (lineWidth==0)?[]:[{width:lineWidth*20, data:LSRGB({r:(lineColor & 0xff0000) >> 16, g:(lineColor & 0x00ff00) >> 8, b:lineColor & 0x0000ff})}];
			shapeWithStyle = 
			{
				fillStyles:fillStyles,				
				lineStyles:lineStyles,
				shapeRecords:
				[
					SHRChange(
					{
						moveTo:{dx:x*20+width*20, dy:y*20},
						fillStyle0:{idx:1}, 
						fillStyle1:null, 
						lineStyle:{idx:1}, 
						newStyles:null
					}), 
					SHREdge(x*20, y*20+height*20), 
					SHREdge(x*20-width*20, y*20), 
					SHREdge(x*20, y*20-height*20), 
					SHREdge(x*20+width*20, y*20), 
					SHREnd 
				]
			}	
		}
		return TShape(id, SHDShape1(bounds, shapeWithStyle));
	}
	private function defineSprite()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var frames = _getInt('frameCount',1);
		var tags : Array<SWFTag>=new Array();
		for(tagNode in currentTagNode.elements())
		{
			currentTagNode = tagNode;
			switch(tagNode.nodeName.toLowerCase())
			{
				case "placeobject":tags.push(placeObject2());
				case "removeobject":tags.push(removeObject2());
				case "startsound":tags.push(startSound());
				
				case "framelabel":tags.push(frameLabel());
				case 'showframe': tags.push(showFrame());
				case "endframe":tags.push(endFrame());
				
				default: throw 'Unsupported tag:' + currentTagNode.nodeName  + ' found inside DefineSprite with id: '+ id;
			}
		}
		return TClip(id, frames, tags);
	}
	private function defineButton2()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var buttonRecords : Array<ButtonRecord>=new Array();
		for(buttonRecord in currentTagNode.elements())
		{
				currentTagNode = buttonRecord;
				var hit = _getBool('hit', false);
				var down = _getBool('down', false);
				var over = _getBool('over', false);
				var up = _getBool('up', false);
				if(hit==null && down==null && over==null && up==null) 
					throw 'Missing button state in tag : ' + currentTagNode +'with id: ' + id;
				var id = _getInt('id',null);
				checkAtt(id, 'id');
				var depth = _getInt('depth',null);
				checkAtt(depth, 'depth');
				var x:Int = _getInt('x',0);
				var y:Int = _getInt('y',0);
				var scaleX:Float = _getFloat('scaleX',1.0);
				var scaleY:Float = _getFloat('scaleY',1.0);
				var rs0 :Float = _getFloat('rotate0',0.0);
				var rs1 :Float = _getFloat('rotate1',0.0);
				buttonRecords.push(
				{
					hit:hit,
					down:down,
					over:over,
					up:up,
					id:id,
					depth:depth,
					matrix:{scale:{x:scaleX, y:scaleY}, rotate:{rs0:rs0, rs1:rs1}, translate:{x:x*20, y:y*20}}
				});
		}
		return TDefineButton2(id, buttonRecords);
	}
	private function defineSound()
	{
		var file = _getString('file',"");
		checkAttS(file, 'file');
		var mp3FileBytes = neko.io.File.read(file, true);
		var mp3Reader = new format.mp3.Reader(mp3FileBytes);

		var mp3 = mp3Reader.read();
		var mp3Frames:Array<MP3Frame> = mp3.frames;
		var mp3Header:MP3Header =mp3Frames[0].header;
		
		var dataBytesOutput = new BytesOutput();
		var mp3Writer = new format.mp3.Writer(dataBytesOutput);
		mp3Writer.write(mp3, false);
		var _sid = _getInt('id',null);
		checkAtt(_sid, 'id');
		return TSound(
		{
			sid:_sid,
			format : SFMP3,
			rate : 
			switch(mp3Header.samplingRate) 
			{
				case SR_11025: SR11k;
				case SR_22050: SR22k;
				case SR_44100: SR44k;
				default: throw 'Unsupported MP3 SoundRate' + mp3Header.samplingRate + ' in '+ fileIn;
			},
			is16bit : true,
			isStereo : 
			switch(mp3Header.channelMode) 
			{
				case Stereo: true;
				case JointStereo: true;
				case DualChannel: true;
				case Mono:false;
			},
			samples : haxe.Int32.ofInt(mp3.sampleCount),
			//samples : haxe.Int32.ofInt(0),				
			data : SDMp3(0, dataBytesOutput.getBytes())
		});
	}
	private function defineBinaryData()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var file = _getString('file',"");
		checkAttS(file, 'file');
		var bytes = neko.io.File.getBytes(file);
		return TBinaryData(id, bytes);
	}
	private function defineFont()
	{
		var _id = _getInt('id',null);
		checkAtt(_id, 'id');
		var file = _getString('file',"");
		checkAttS(file, 'file');
		var swf:Bytes = neko.io.File.getBytes(file);
		var swfBytesInput = new BytesInput(swf);
		var swfReader = new format.swf.Reader(swfBytesInput);
		var header = swfReader.readHeader();
		var tags:Array<SWFTag> = swfReader.readTagList();
		swfBytesInput.close();
		
		for (tag in tags)
		{
			switch (tag)
			{
				case TFont(id, data): 
					return TFont(_id, data);
				default://do nothing
			}
		}
		return throw 'No Font definitions were found inside swf: ' + file;
	}
	private function defineEditText()
	{
		var _id = _getInt('id',null);
		checkAtt(_id, 'id');
		
		var width = _getInt('width',100);
		var height = _getInt('height',100);
		var bounds = {left :0*20, right : width*20, top:0*20,  bottom : height*20};
		
		var wordWrap:Bool = _getBool('wordWrap',true);
		var multiline:Bool = _getBool('multiline',true);
		var password:Bool = _getBool('password',false);
		var input:Bool = !_getBool('input',false);//written as: readOnly:Bool
		var autoSize:Bool = _getBool('autoSize',false); 
		var selectable:Bool = !_getBool('selectable',false); //written as: noSelect:Bool
		var border:Bool = _getBool('border',false);
		var wasStatic:Bool = _getBool('wasStatic',false);
		var html:Bool = _getBool('html',false);
		var useOutlines:Bool = _getBool('useOutlines',false);
		
		var fontID:Int = _getInt('fontID',null);
		var fontClass:String =_getString('fontClass',"");
		var fontHeight:Int = _getInt('fontHeight',20);
		var textColor:Int = _getInt('textColor',0x000000ff);
		var maxLength:Int = _getInt('maxLength',0);
		var align:Int = _getInt('align',0);//0 left, 1, center, 2 right, 3 justify
		var leftMargin:Int = _getInt('leftMargin',0);
		var rightMargin:Int = _getInt('rightMargin',0);
		var indent:Int = _getInt('indent',0);
		var leading:Int = _getInt('leading',0);
		var variableName:String  = _getString('variableName',"");
		var initialText:String  = _getString('initialText',"");
		//file=""//TODO
		
		var hasText:Bool= (initialText!="")?true:false;
		var hasTextColor:Bool=true;
		var hasMaxLength:Bool = (maxLength!=0)?true:false;
		var hasFont:Bool = (fontID!=null)?true:false;
		var hasFontClass:Bool = (fontClass!="")?true:false;
		var	hasLayout:Bool = (align!=0 || leftMargin!=0 || rightMargin!=0 || indent!=0 || leading!=0)? true:false;
		
		return TDefineEditText(
		_id, 
		{
			bounds:bounds, 
			hasText:hasText, 
			hasTextColor:hasTextColor, 
			hasMaxLength:hasMaxLength, 
			hasFont:hasFont, 
			hasFontClass:hasFontClass, 
			hasLayout:hasLayout,
			
			wordWrap:wordWrap, 
			multiline:multiline, 
			password:password, 
			input:input,	
			autoSize:autoSize, 
			selectable:selectable, 
			border:border, 
			wasStatic:wasStatic,
			
			html:html,
			useOutlines:useOutlines,
			fontID:fontID,
			fontClass:fontClass,
			fontHeight:fontHeight*20,
			textColor:
			{
				r:(textColor & 0xff000000) >> 24, 
				g:(textColor & 0x00ff0000) >> 16, 
				b:(textColor & 0x0000ff00)>>8, 
				a:(textColor & 0x000000ff) 
			},
			maxLength:maxLength,
			align:align*20,
			leftMargin:leftMargin*20,
			rightMargin:rightMargin*20,
			indent:indent*20,
			leading:leading*20,
			variableName:variableName,
			initialText:initialText
		});
	}
	private function defineABC()
	{
		var remap = _getString('remap', "");
		var file = _getString('file',"");
		checkAttS(file, 'file');
		var swf:Bytes = neko.io.File.getBytes(file);
		var swfBytesInput = new BytesInput(swf);
		var swfReader = new format.swf.Reader(swfBytesInput);
		var header = swfReader.readHeader();
		var tags:Array<SWFTag> = swfReader.readTagList();
		swfBytesInput.close();
		
		var _lookupStrings = ["Boot", "Lib", "Type"];//expand? custom classnames?
		for (tag in tags)
		{
			switch (tag)
			{
				case TActionScript3(data,ctx): 
					if(remap=="")
					{
						return TActionScript3(data, ctx);
					}
					else
					{
						var abcReader = new format.abc.Reader(new haxe.io.BytesInput(data));
						var abcFile = abcReader.read();
						var cpoolStrings = abcFile.strings;
						Lib.println('\nChanged following class names in: ' + file + '\n');
						Lib.println("-------------------");
						for (i in 0...cpoolStrings.length)
						{
							for ( s in _lookupStrings)
							{
								var regex =  new EReg('\\b' + s+'\\b', '');
								var str = cpoolStrings[i];
								if (regex.match(str))
								{
									Lib.println('<-'+cpoolStrings[i]);
									cpoolStrings[i] = regex.replace(str, s + remap);
									Lib.println('->'+cpoolStrings[i]);
									Lib.println("-------------------");
								}
							}
						}

						var abcOutput = new haxe.io.BytesOutput();
						format.abc.Writer.write(abcOutput,abcFile);
						var abcBytes = abcOutput.getBytes();
						return TActionScript3(abcBytes);
					}
					
				default://do nothing
			}
		}
		return throw 'No ABC files were found inside swf: ' + file;
	}
	
	//CONTROL TAGS
	private function placeObject2()
	{
		var id:Int = _getInt('id', null);
		//checkAtt(id, 'id');
		var depth:Int = _getInt('depth', null);
		checkAtt(depth, 'depth');
		var x:Int = _getInt('x',0);
		var y:Int = _getInt('y',0);
		var scaleX:Float = _getFloat('scaleX',1.0);
		var scaleY:Float = _getFloat('scaleY',1.0);
		var rs0 :Float = _getFloat('rotate0',0.0);
		var rs1 :Float = _getFloat('rotate1',0.0);
		var name = _getString('name', "");
		var move = _getBool('move', false);
		
		var _placeObject:PlaceObject = new PlaceObject();
		_placeObject.depth = depth;
		_placeObject.move = move==false?null:move;
		_placeObject.cid = id;
		_placeObject.matrix={scale:{x:scaleX, y:scaleY}, rotate:{rs0:rs0, rs1:rs1}, translate:{x:x*20, y:y*20}};
		_placeObject.color=null;
		_placeObject.ratio=null;
		_placeObject.instanceName = name==""?null:name;
		_placeObject.clipDepth=null;
		_placeObject.events=null;
		_placeObject.filters=null;
		_placeObject.blendMode=null;
		_placeObject.bitmapCache = false;
		
		return TPlaceObject2(_placeObject);
	}
	private function removeObject2()
	{
		var depth = _getInt('depth',null);
		checkAtt(depth, 'depth');
		return TRemoveObject2(depth);
	}
	private function startSound()
	{
		var id:Int = _getInt('id',null);
		checkAtt(id, 'id');
		var stop:Bool = _getBool('stop', false);
		var loopCount = _getInt('loopCount', 0);
		var hasLoops = loopCount==0?false:true;
		return TStartSound(id, {syncStop:stop, hasLoops:hasLoops, loopCount:loopCount});
	}
	private function symbolClass()
	{
		var cid = _getInt('id',null);
		checkAtt(cid, 'id');
		var className = _getString('class', "");
		checkAttS(className, 'class');
		var symbols: Array<SymData> = [{cid:cid, className:className}];
		return TSymbolClass(symbols);
	}
	
	//FRAME TAGS:
	private function frameLabel()
	{
		var label = _getString('name',"");
		checkAttS(label, 'label');
		var anchor = _getBool('anchor', false);
		return TFrameLabel(label, anchor);
	}
	private function showFrame()
	{
		return TShowFrame;
	}
	private function endFrame()
	{
		return TEnd;
	}	
//helper for defineShape for DefineBitsJPEG2
	private function storeWidthHeight(id:Int, fileName:String, _bytes:Bytes):Void
	{
		var extension = fileName.substr(fileName.lastIndexOf('.')+1);
		var height=0;
		var width=0;
		var bytes = new BytesInput(_bytes);
		if(extension.toLowerCase()=='jpg' || extension.toLowerCase()=='jpeg')
		{
			if (bytes.readByte() != 255 || bytes.readByte() != 216)
			{
				throw "SOI (Start Of Image) marker 0xff 0xd8 missing";
			}
			var marker:Int;
			var len:Int;
			while (bytes.readByte() == 255) 
			{
				marker = bytes.readByte();
				len = bytes.readByte() << 8 | bytes.readByte();

				if (marker == 192)
				{
					bytes.readByte();
					height = bytes.readByte() << 8 | bytes.readByte();
					width = bytes.readByte() << 8 | bytes.readByte();
					break;
				}
				bytes.read(len - 2);
			}
		}
		else if(extension.toLowerCase()=='png' )
		{
			bytes.bigEndian=true;
			bytes.readInt32();//0x89504e47 SOI
			bytes.readInt32();//0x0D0A1A0A
			bytes.readInt32();//0x0000000D THDR
			bytes.readInt32();//0x49484452
			//width = haxe.Int32.toInt(bytes.readInt32());
			//height = haxe.Int32.toInt(bytes.readInt32());
			width = bytes.readUInt30();
			height = bytes.readUInt30();
		}
		else if(extension.toLowerCase()=='gif' )
		{
			bytes.bigEndian=false;
			bytes.readInt32();//0x47 0x49 0x46 0x38 
			bytes.readUInt16();//0x39 0x61
			width = bytes.readUInt16();
			height = bytes.readUInt16();
		}
		bitmapIds[id]=[width, height];
		
	}
	//helpers for reading xml attributes and converting to correct datatype and/or default value
	private function _getInt(att:String, ?defaultValue:Int):Int
	{
		return currentTagNode.exists(att)? Std.parseInt(currentTagNode.get(att)) : defaultValue;
	}
	private function _getBool(att:String, ?defaultValue:Bool):Bool
	{
		return currentTagNode.exists(att)? (currentTagNode.get(att) == 'true' ? true:false) : defaultValue;
	}
	private function _getFloat(att:String,?defaultValue:Float):Float
	{
		return currentTagNode.exists(att)? Std.parseFloat(currentTagNode.get(att)) : defaultValue;
	}
	private function _getString(att:String,?defaultValue:String ):String
	{
		return currentTagNode.exists(att)? currentTagNode.get(att) : defaultValue;
	}
	//check for missing mandatory attributes
	private function checkAtt(att, name):Void
	{
		if(att==null) throw 'Attribute ' + name + ' missing in tag ' + currentTagNode;
	}
	private function checkAttS(att, name):Void
	{
		if(att=="") throw 'Attribute ' + name + ' missing in tag ' + currentTagNode;
	}
}
