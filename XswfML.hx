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
			Lib.print("Usage: hXswfML in.xml out.swf");
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
	
	public function new(fileIn:String, fileOut:String)
	{
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
		return {version:_getInt('version',10), compressed:_getBool('compressed',true), width:_getInt('width',800), height:_getInt('height',600), fps:_getInt('fps',30), nframes:_getInt('frameCount',1)};
	}
	private function fileAttributes()
	{
		return TSandBox ({
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
		return TBitsJPEG(id, JDJPEG2(bytes));
	}
	private function defineShape()
	{
		var id = _getInt('id',null);
		checkAtt(id, 'id');
		var width = _getInt('width',null);
		checkAtt(width, 'width');
		var height = _getInt('height',null);
		checkAtt(height, 'height');
		var bounds;
		var shapeWithStyle;
		if(currentTagNode.exists('bitmapId'))
		{
			var bitmapId = _getInt('bitmapId');
			bounds = {left :0*20, right : width*20, top:0*20,  bottom : height*20}
			shapeWithStyle = {
								fillStyles:[FSBitmap(1, {scale:{x:0.0, y:0.0}, rotate:{rs0:0.0, rs1:0.0}, translate:{x:0, y:0}}, false, false)],
								lineStyles:[], 
								shapeRecords:[	SHRChange({	moveTo:{dx:width*20,dy:0*20}, 
															fillStyle0:{idx:1}, 
															fillStyle1:null, 
															lineStyle:null, 
															newStyles:null}), 
												SHREdge(0, height*20),
												SHREdge(-width*20, 0), 
												SHREdge(0, -height*20), 
												SHREdge(width*20, 0), 
												SHREnd ]
							}
		}
		else
		{
			var width = _getInt('width');
			checkAtt(width, 'width');
			var height = _getInt('height');
			checkAtt(height, 'height');
			var fillColor = _getInt('fillColor',0x000000);
			var lineColor = _getInt('lineColor',0x000000);
			var lineWidth = _getInt('lineWidth',1);
			bounds = {left:0*20, right:width*20, top:0*20, bottom:height*20};
			
			var fillStyles = [FSSolid({	r:(fillColor & 0xff0000) >> 16, g:(fillColor & 0x00ff00) >> 8, b:(fillColor & 0x0000ff)})];
			var lineStyles = [{	width:lineWidth*20, data:LSRGB({	r:(lineColor & 0xff0000) >> 16, g:(lineColor & 0x00ff00) >> 8, b:lineColor & 0x0000ff})}];
			
			shapeWithStyle = {	fillStyles:fillStyles,				
								lineStyles:lineStyles,
								shapeRecords:[	SHRChange({	moveTo:{dx:width*20,dy:0*20},
															fillStyle0:{idx:1}, 
															fillStyle1:null, 
															lineStyle:{idx:1}, 
															newStyles:null}), 
												SHREdge(0, height*20), 
												SHREdge(-width*20, 0), 
												SHREdge(0, -height*20), 
												SHREdge(width*20, 0), 
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
				if(hit==null && down==null && over==null && up==null) throw 'Missing button state in tag : ' + currentTagNode +'with id: ' + id;
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
				buttonRecords.push({hit:hit,
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
		return TSound( {sid:_sid,
						format : SFMP3,
						rate : switch(mp3Header.samplingRate) 
								{
									case SR_11025: SR11k;
									case SR_22050: SR22k;
									case SR_44100: SR44k;
									default: throw 'Unsupported MP3 SoundRate' + mp3Header.samplingRate + ' in '+ fileIn;
								},
						is16bit : true,
						isStereo : switch(mp3Header.channelMode) 
								{
									case Stereo: true;
									case JointStereo: true;
									case DualChannel: true;
									case Mono:false;
								},
//						samples : haxe.Int32.ofInt(mp3.sampleCount),
						samples : haxe.Int32.ofInt(0),				
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
