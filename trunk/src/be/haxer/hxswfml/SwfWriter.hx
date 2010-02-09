/**
* 
* @author Jan J. Flanders
*/
package be.haxer.hxswfml;
import be.haxer.hxswfml.ShapeWriter;
import be.haxer.hxswfml.AbcWriter;
import be.haxer.hxswfml.AbcReader;

import format.abc.Data;
import format.swf.Data;
import format.swf.Reader;
import format.swf.Writer;
import format.zip.Data;
import format.zip.Writer;
import format.mp3.Data;
import format.mp3.Reader;
import format.mp3.Writer;
import haxe.io.Bytes;
import haxe.io.BytesInput;
import haxe.io.BytesOutput;


#if air
import flash.display.MovieClip;
import flash.events.IOErrorEvent;
import flash.filesystem.File;
import flash.filesystem.FileMode;
import flash.filesystem.FileStream;
#elseif flash
import flash.display.MovieClip;
import flash.Lib;
#elseif neko
import neko.Lib;
#elseif php
import php.Lib;
#end

class SwfWriter
{
	private var currentTag : Xml;
	private var validBaseClasses : Array<String>;
	private var validElements : Hash<Array<String>>;
	private var validChildren : Hash<Array<String>>;
	private var swcClasses : Array<Array<String>>;
	private var bitmapIds : Array<Array<Int>>;
	private var dictionary : Array<String>;
	private var strict:Bool;
	public var library : Hash<Dynamic>;
	public static function main()
	{
		new SwfWriter();
	}
	public function new(?strict:Bool=true)
	{
		this.strict=strict;
		#if (swc || air)
		new flash.Boot(new MovieClip());//for swc
		#end
		bitmapIds = new Array();
		dictionary = new Array();
		swcClasses = new Array();
		library = new Hash();
		setup();
	}
	public function xml2swf(input : String, fileOut : String) : Bytes
	{
		var xml : Xml = Xml.parse(input);
		var swfBytesOutput = new BytesOutput();
		var swfWriter : format.swf.Writer = new format.swf.Writer(swfBytesOutput);
		createSWF(xml, swfWriter);
		var swfBytes = swfBytesOutput.getBytes();

		if(StringTools.endsWith(fileOut, '.swf'))
		{
			return swfBytes;
		}
		else if(StringTools.endsWith(fileOut, '.swc'))
		{
			var date : Date = Date.now();
			var mod : Float = date.getTime();

			var xmlBytesOutput = new BytesOutput();
			xmlBytesOutput.write(Bytes.ofString(createXML(mod)));
			var xmlBytes = xmlBytesOutput.getBytes();
			
			var zipBytesOutput = new BytesOutput();
			var zipWriter = new format.zip.Writer(zipBytesOutput);
			
			var data : List<Entry> = new List();
			
			data.push({
			fileName : 'catalog.xml', 
			fileSize : xmlBytes.length, 
			fileTime : date, 
			compressed : false, 
			dataSize : xmlBytes.length,
			data : xmlBytes,
			crc32 : format.tools.CRC32.encode(xmlBytes),
			extraFields : null});
			
			data.push({
			fileName : 'library.swf', 
			fileSize : swfBytes.length, 
			fileTime : date, 
			compressed : false, 
			dataSize : swfBytes.length,
			data : swfBytes,
			crc32 : format.tools.CRC32.encode(swfBytes),
			extraFields : null});
			
			zipWriter.writeData( data );
			
			return zipBytesOutput.getBytes();
		}
		else
		{
			error(': Supported file formats for output are .swf and .swc');
			return null;
		}
	}
	private function createSWF(xml : Xml, swfWriter) : Void
	{
		var swf : Xml = xml.firstElement();
		for(tag in swf.elements())
		{
			currentTag = tag;
			checkUnknownAttributes();
			switch(currentTag.nodeName.toLowerCase())
			{
				case 'header' : swfWriter.writeHeader(header());
				case 'fileattributes' : swfWriter.writeTag(fileAttributes());
				case 'setbackgroundcolor' : swfWriter.writeTag(setBackgroundColor());
				case 'scriptlimits' : swfWriter.writeTag(scriptLimits());
				case 'definebitsjpeg' : swfWriter.writeTag(defineBitsJPEG());
				case 'defineshape' : swfWriter.writeTag(defineShape());
				case 'definesprite' : swfWriter.writeTag(defineSprite());
				case 'definebutton' : swfWriter.writeTag(defineButton2());
				case 'definebinarydata' : swfWriter.writeTag(defineBinaryData());
				case 'definesound' : swfWriter.writeTag(defineSound());
				case 'definefont' : swfWriter.writeTag(defineFont());
				case 'defineedittext' : swfWriter.writeTag(defineEditText());
				case 'defineabc' : for(tag in defineABC()) swfWriter.writeTag(tag);
				case 'definescalinggrid' : swfWriter.writeTag(defineScalingGrid());
				case 'placeobject' : swfWriter.writeTag(placeObject2());
				case 'removeobject' : swfWriter.writeTag(removeObject2());
				case 'startsound' : swfWriter.writeTag(startSound());
				case 'symbolclass' : for(tag in symbolClass()) swfWriter.writeTag(tag);
				case 'exportassets' : for(tag in exportAssets()) swfWriter.writeTag(tag);
				case 'metadata' : swfWriter.writeTag(metadata());
				case 'framelabel' : swfWriter.writeTag(frameLabel());
				case 'showframe' : for(tag in showFrame()) swfWriter.writeTag(tag);
				case 'endframe' : swfWriter.writeTag(endFrame());
				case 'tween' : for(tag in tween()) swfWriter.writeTag(tag);
				case 'custom' : swfWriter.writeTag(custom());
				default:
					error('ERROR: ' + currentTag.nodeName + ' is not allowed inside an swf element. Valid children are: ' +  validChildren.get('swf').toString() + '. TAG: ' + currentTag.toString());
			}
		}
		swfWriter.writeEnd();
	}
	
	//FILE TAGS
	private function header()
	{
		return
		{
			version : getInt('version', 10), 
			compressed : getBool('compressed', true), 
			width : getInt('width', 800), 
			height : getInt('height', 600), 
			fps : getInt('fps', 30), 
			nframes : getInt('frameCount', 1)
		};
	}
	private function fileAttributes()
	{
		return 
		TSandBox (
		{
			useDirectBlit : getBool('useDirectBlit', false), 
			useGPU : getBool('useGPU', false),  
			hasMetaData : getBool('hasMetaData', false),  
			actionscript3 : getBool('actionscript3', true),  
			useNetWork : getBool('useNetwork', false)
		});
	}
	private function setBackgroundColor()
	{
		return TBackgroundColor(getInt('color', 0xffffff));
	}
	private function scriptLimits()
	{
		var maxRecursion = getInt('maxRecursionDepth', 256);
		var timeoutSeconds = getInt('scriptTimeoutSeconds', 15);
		return TScriptLimits(maxRecursion, timeoutSeconds);
	}
	// DEFINITION TAGS
	private function defineBitsJPEG()
	{
		var id = getInt('id', null, true, true);
		var file = getString('file', "", true);
		var bytes = getBytes(file);
		storeWidthHeight(id, file, bytes);
		return TBitsJPEG(id, JDJPEG2(bytes));
	}
	private function defineShape()
	{
		var id = getInt('id', null, true, true);
		var bounds;
		var shapeWithStyle;
		if(currentTag.exists('bitmapId'))
		{
			var bitmapId = getInt('bitmapId', null);
			if(strict)
			{
				if(dictionary[bitmapId] != 'definebitsjpeg')
				{
					error('EERROR: bitmapId ' + bitmapId + ' must be a reference to a DefineBitsJPEG tag. TAG: ' + currentTag.toString());
				}
			}
			var width = bitmapIds[bitmapId][0] * 20;
			var height = bitmapIds[bitmapId][1] * 20;
			var scaleX = getFloat('scaleX', 1.0) * 20;
			var scaleY = getFloat('scaleY', 1.0) * 20;
			var scale = {x : scaleX, y : scaleY};
			var rotate0 = getFloat('rotate0', 0.0);
			var rotate1 = getFloat('rotate1', 0.0);
			var rotate = {rs0 : rotate0, rs1 : rotate1};
			var x = getInt('x', 0) * 20;
			var y = getInt('y', 0) * 20;
			var translate = {x : x, y : y}
			var repeat : Bool = getBool('repeat', false);
			var smooth : Bool = getBool('smooth', false);
			bounds = {left : x, right : x + width, top : y,  bottom : y + height}
			shapeWithStyle = 
			{
				fillStyles:
				[
					FSBitmap(bitmapId, {scale : scale, rotate : rotate, translate : translate}, repeat, smooth)
				],
				lineStyles:
				[
				
				], 
				shapeRecords:
				[	
					SHRChange(
					{	
						moveTo : {dx : x + width, dy : y}, 
						fillStyle0 : {idx : 1}, 
						fillStyle1 : null, 
						lineStyle : null, 
						newStyles : null
					}), 
					SHREdge(x, y + height), 
					SHREdge(x - width, y), 
					SHREdge(x, y - height), 
					SHREdge(x + width, y), 
					SHREnd 
				]
			}
			return TShape(id, SHDShape1(bounds, shapeWithStyle));
		}
		else
		{
			var shapeWriter = new ShapeWriter();
			for(cmd in currentTag.elements())
			{
				currentTag = cmd;
				checkUnknownAttributes();
				switch(currentTag.nodeName.toLowerCase())
				{
					case 'beginfill':
						var color = getInt('color', 0x000000);
						var alpha = getFloat('alpha', 1.0);
						shapeWriter.beginFill(color, alpha);
						
					case 'begingradientfill':
						var type = getString('type', '', true);
						switch (type)
						{
							case 'linear', 'radial':
								var colors = getString('colors', '', true).split(',');
								var alphas = getString('alphas', '', true).split(',');
								var ratios = getString('ratios', '', true).split(',');
								var x = getFloat('x', 0.0);
								var y = getFloat('y', 0.0);
								var scaleX = getFloat('scaleX', 1.0);
								var scaleY = getFloat('scaleY', 1.0);
								var rotate0 = getFloat('rotate0', 0.0);
								var rotate1 = getFloat('rotate1', 0.0);
								shapeWriter.beginGradientFill(type, colors, alphas, ratios, x, y, scaleX, scaleY, rotate0, rotate1);
								
							default:
								error('ERROR! Invalid gradient type ' + type + '. Valid types are: radial,linear. TAG: ' + currentTag.toString());
						}
						
					case 'beginbitmapfill':
						var bitmapId = getInt('bitmapId', null, true);
						if(strict)
						{
							if(dictionary[bitmapId] != 'definebitsjpeg')
							{
								error('ERROR: bitmapId ' + bitmapId + ' must be a reference to a DefineBitsJPEG tag. TAG: ' + currentTag.toString());
							}
						}
						var scaleX = getFloat('scaleX', 1.0);
						var scaleY = getFloat('scaleY', 1.0);
						var scale = {x : scaleX, y : scaleY};
						var rotate0 = getFloat('rotate0', 0.0);
						var rotate1 = getFloat('rotate1', 0.0);
						var rotate = {rs0 : rotate0, rs1 : rotate1};
						var x = getInt('x', 0);
						var y = getInt('y', 0);
						var translate = {x : x, y : y}
						var repeat : Bool = getBool('repeat', false);
						var smooth : Bool = getBool('smooth', false);
						shapeWriter.beginBitmapFill(bitmapId, x, y, scaleX, scaleY, rotate0, rotate1, repeat, smooth);
			
			    case 'linestyle':
						var width = getFloat('width', 1.0);
						var color = getInt('color', 0x000000);
						var alpha = getFloat('alpha', 1.0);
						var pixelHinting = getBool('pixelHinting', null);
						var scaleMode = getString('scaleMode', null);
						var caps = getString('caps', null);
						var joints = getString('joints', null);
						var miterLimit = getInt('miterLimit', null);
						var noClose = getBool('noClose', null);
						//shapeWriter.lineStyle(width, color, alpha);
						shapeWriter.lineStyle(width, color, alpha, pixelHinting, scaleMode, caps, joints, miterLimit, noClose);
						
			    case 'moveto':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						shapeWriter.moveTo(x,  y);
						
			    case 'lineto':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						shapeWriter.lineTo(x, y);
						
			    case 'curveto': 
						var cx = getFloat('cx', 0.0);
						var cy = getFloat('cy', 0.0);
						var ax = getFloat('ax', 0.0);
						var ay = getFloat('ay', 0.0);
						shapeWriter.curveTo( cx, cy, ax, ay );
						
			    case 'endfill':
						shapeWriter.endFill();
						
			    case 'endline':
						shapeWriter.endLine();
						
			    case 'clear': 
						shapeWriter.clear();
						
			    case 'drawcircle':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						var r = getFloat('r', 0.0);
						var sections = getInt('sections', 16);
						shapeWriter.drawCircle(x, y, r, sections);
						
			    case 'drawellipse':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						var w = getFloat('width', 0.0);
						var h = getFloat('height', 0.0);
						shapeWriter.drawEllipse(x, y, w, h);
						
			    case 'drawrect':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						var w = getFloat('width', 0.0);
						var h = getFloat('height', 0.0);
						shapeWriter.drawRect(x, y, w, h);
						
			    case 'drawroundrect':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						var w = getFloat('width', 0.0);
						var h = getFloat('height', 0.0);
						var r = getFloat('r', 0.0);
						shapeWriter.drawRoundRect(x, y, w, h, r);
						
			    case 'drawroundrectcomplex':
						var x = getFloat('x', 0.0);
						var y = getFloat('y', 0.0);
						var w = getFloat('width', 0.0);
						var h = getFloat('height', 0.0);
						var rtl = getFloat('rtl', 0.0);
						var rtr = getFloat('rtr', 0.0);
						var rbl = getFloat('rbl', 0.0);
						var rbr = getFloat('rbr', 0.0);
						shapeWriter.drawRoundRectComplex(x, y, w, h, rtl, rtr, rbl, rbr);
						
				default:
						error('ERROR: ' + currentTag.nodeName +' is not allowed inside a DefineShape element. Valid children are: ' + validChildren.get('defineshape').toString() + '. TAG: ' + currentTag.toString());
				}
			}
			return shapeWriter.getTag(id);
		}
	}
	private function defineSprite()
	{
		var id = getInt('id', null, true, true);
		var frameCount = getInt('frameCount', 1);
		var tags : Array<SWFTag> = new Array();
		var spriteTag = currentTag;
		for(tag in currentTag.elements())
		{
			currentTag = tag;
			checkUnknownAttributes();
			switch(currentTag.nodeName.toLowerCase())
			{
				case "placeobject" : tags.push(placeObject2());
				case "removeobject" : tags.push(removeObject2());
				case "startsound" : tags.push(startSound());
				case "framelabel" : tags.push(frameLabel());
				case 'showframe' : 
					var showFrames = showFrame();
					for(tag in showFrames)
						tags.push(tag);
				case "endframe" : tags.push(endFrame());
				case 'tween' : for(tag in tween()) tags.push(tag);
				default : error('ERROR: ' + currentTag.nodeName + ' is not allowed inside a DefineSprite element. Valid children are: ' + validChildren.get('definesprite').toString() + '. TAG: ' + currentTag.toString());
			}
		}
		return TClip(id, frameCount, tags);
	}

	private function defineButton2()
	{
		var id = getInt('id', null, true, true);
		var buttonRecords : Array<ButtonRecord> = new Array();
		for(buttonRecord in currentTag.elements())
		{
				currentTag = buttonRecord;
				checkUnknownAttributes();
				switch(currentTag.nodeName.toLowerCase())
				{
					case 'buttonstate':
						var hit = getBool('hit', false);
						var down = getBool('down', false);
						var over = getBool('over', false);
						var up = getBool('up', false);
						if(hit == false && down == false && over == false && up == false)
						{
							error('ERROR: You need to set at least one button state to true. TAG: '+currentTag.toString());
						}
						var id = getInt('id', null, true, false, true);
						var depth = getInt('depth', null, true);
						buttonRecords.push(
						{
							hit : hit,
							down : down,
							over : over,
							up : up,
							id : id,
							depth : depth,
							matrix : getMatrix()
						});
					default :
						error('ERROR: ' + currentTag.nodeName + ' is not allowed inside a DefineButton element. Valid children are: ' + validChildren.get('definebutton').toString() + '. TAG: ' + currentTag.toString());
				}
		}
		if(buttonRecords.length == 0)
			error('ERROR: You need to supply at least one buttonstate element. TAG: ' + currentTag.toString());
		return TDefineButton2(id, buttonRecords);
	}
	private function defineSound()
	{
		var file = getString('file', "", true);
		#if neko
		checkFileExistence(file);
		var mp3FileBytes = neko.io.File.read(file, true);
		#else
		var mp3FileBytes = new haxe.io.BytesInput(getBytes(file));
		#end
		var mp3Reader = new format.mp3.Reader(mp3FileBytes);

		var mp3 = mp3Reader.read();
		var mp3Frames : Array<MP3Frame> = mp3.frames;
		var mp3Header : MP3Header = mp3Frames[0].header;
		
		var dataBytesOutput = new BytesOutput();
		var mp3Writer = new format.mp3.Writer(dataBytesOutput);
		mp3Writer.write(mp3, false);
		var sid = getInt('id', null, true, true);
		var samplingRate = switch(mp3Header.samplingRate) 
											{
												case SR_11025 : SR11k;
												case SR_22050 : SR22k;
												case SR_44100 : SR44k;
												default: null; 
											}
		if(samplingRate == null)
			error('ERROR: Unsupported MP3 SoundRate ' + mp3Header.samplingRate + ' in ' + file + '. TAG: ' + currentTag.toString());
		return TSound(
		{
			sid : sid,
			format : SFMP3,
			rate : samplingRate,
			is16bit : true,
			isStereo : 
			switch(mp3Header.channelMode) 
			{
				case Stereo : true;
				case JointStereo : true;
				case DualChannel : true;
				case Mono : false;
			},
			samples : haxe.Int32.ofInt(mp3.sampleCount),
			data : SDMp3(0, dataBytesOutput.getBytes())
		});
	}
	private function defineBinaryData()
	{
		var id = getInt('id', null, true, true);
		var file = getString('file', "", true);
		var bytes = getBytes(file);
		return TBinaryData(id, bytes);
	}
	private function defineFont()
	{
		var _id = getInt('id', null, true, true);
		var file = getString('file', "", true);
		var swf = getBytes(file);
		var swfBytesInput = new BytesInput(swf);
		var swfReader = new format.swf.Reader(swfBytesInput);
		var header = swfReader.readHeader();
		var tags : Array<SWFTag> = swfReader.readTagList();
		swfBytesInput.close();
		var fontTag = null;
		for (tag in tags)
		{
			switch (tag)
			{
				case TFont(id, data) : fontTag = TFont(_id, data);
				default :
			}
		}
		if(fontTag == null)
			error('ERROR: No Font definitions were found inside swf: ' + file + ', TAG: ' + currentTag.toString());
		return fontTag;
	}
	private function defineEditText()
	{
		var id = getInt('id', null, true, true);
		var fontID = getInt('fontID', null);
		if(strict)
		{
			if(fontID != null && dictionary[fontID] != 'definefont')
				error('ERROR: The id ' + fontID + ' must be a reference to a DefineFont tag. TAG: ' + currentTag.toString());
		}
		var textColor : Int = getInt('textColor', 0x000000ff);

		return TDefineEditText(
		id, 
		{
			bounds : {left : 0, right : getInt('width', 100) * 20, top : 0,  bottom : getInt('height', 100) * 20}, 
			hasText : (getString('initialText', "") != "")? true : false, 
			hasTextColor : true, 
			hasMaxLength : (getInt('maxLength', 0) != 0)? true : false, 
			hasFont : (getInt('fontID', 0) != 0)? true : false, 
			hasFontClass : (getString('fontClass', "") != "")? true : false, 
			hasLayout : (getInt('align', 0) != 0 || getInt('leftMargin', 0) * 20 != 0 || getInt('rightMargin', 0) * 20 != 0 || getInt('indent', 0) * 20 != 0 || getInt('leading', 0) * 20 != 0)? true : false,
			
			wordWrap : getBool('wordWrap', true), 
			multiline : getBool('multiline', true), 
			password : getBool('password', false), 
			input : !getBool('input', false),	
			autoSize : getBool('autoSize', false), 
			selectable : !getBool('selectable', false), 
			border : getBool('border', false), 
			wasStatic : getBool('wasStatic', false),
			
			html : getBool('html', false),
			useOutlines : getBool('useOutlines', false),
			fontID : getInt('fontID', null),
			fontClass : getString('fontClass', ""),
			fontHeight : getInt('fontHeight', 12) * 20,
			textColor:
			{
				r : (textColor & 0xff000000) >> 24, 
				g : (textColor & 0x00ff0000) >> 16, 
				b : (textColor & 0x0000ff00) >>  8, 
				a : (textColor & 0x000000ff) 
			},
			maxLength : getInt('maxLength', 0),
			align : getInt('align', 0),
			leftMargin : getInt('leftMargin', 0) * 20,
			rightMargin : getInt('rightMargin', 0) * 20,
			indent : getInt('indent', 0) * 20,
			leading : getInt('leading', 0) * 20,
			variableName : getString('variableName', ""),
			initialText : getString('initialText', "")
		});
	}
	private function defineABC()
	{
		var abcTags : Array<SWFTag> = new Array();
		var name = getString('name', null, false);
		var remap = getString('remap', "");
		var file;
		if (currentTag.elements().hasNext())
		{
			var abcWriter = new AbcWriter();
			abcWriter.name = name;
			abcTags =  abcWriter.xml2abc(currentTag.elements().next().toString());
		}	
		else 
		{
			file = getString('file', "", true);
			if(StringTools.endsWith(file, '.abc'))
			{
				var abc = getBytes(file);
				abcTags.push(TActionScript3(abc, name==null?null:{id : 1, label : name}));
			}
			else if(StringTools.endsWith(file, '.swf'))
			{
				var swf = getBytes(file);
				var swfBytesInput = new BytesInput(swf);
				var swfReader = new format.swf.Reader(swfBytesInput);
				var header = swfReader.readHeader();
				var tags : Array<SWFTag> = swfReader.readTagList();
				swfBytesInput.close();
				
				var lookupStrings = ["Boot", "Lib", "Type"];
				for (tag in tags)
				{
					switch (tag)
					{
						case TActionScript3(data, ctx): 
							if(remap == "")
							{
								abcTags.push(TActionScript3(data, ctx));
							}
							else
							{
								var abcReader = new format.abc.Reader(new haxe.io.BytesInput(data));
								var abcFile = abcReader.read();
								var cpoolStrings = abcFile.strings;
								for (i in 0...cpoolStrings.length)
								{
									for ( s in lookupStrings)
									{
										var regex =  new EReg('\\b' + s + '\\b', '');
										var str = cpoolStrings[i];
										if (regex.match(str))
										{
											inform('<-' + cpoolStrings[i]);
											cpoolStrings[i] = regex.replace(str, s + remap);
											inform('->' + cpoolStrings[i]);
										}
									}
								}

								var abcOutput = new haxe.io.BytesOutput();
								format.abc.Writer.write(abcOutput, abcFile);
								var abcBytes = abcOutput.getBytes();
								abcTags.push(TActionScript3(abcBytes, ctx));
							}
						default :
					}
				}
				if(abcTags.length == 0)
					error('ERROR: No ABC files were found inside the given file ' + file + '. TAG : ' + currentTag.toString());
			}
			else if(StringTools.endsWith(file, '.xml'))
			{
				var xml:String = getContent(file);
				var abcWriter = new AbcWriter();
				abcWriter.name = name;
				abcTags = abcWriter.xml2abc(xml);
			}
		}
		return abcTags;
	}
	private function defineScalingGrid()
	{
		var id = getInt('id', null, true, false, true);
		var x = getInt('x', null, true) * 20;
		var y = getInt('y', null, true) * 20;
		var width = getInt('width', null, true) * 20;
		var height = getInt('height', null, true) * 20;
		var splitter = { left : x, right : x + width, top : y, bottom : y + height};
		return TDefineScalingGrid(id, splitter);
	}
	//CONTROL TAGS
	private function placeObject2()
	{
		var id = getInt('id', null);
		if(id != null)
			checkTargetId(id);
		var depth : Int = getInt('depth', null, true);
		var name = getString('name', "");
		var move = getBool('move', false);
		
		var placeObject : PlaceObject = new PlaceObject();
		placeObject.depth = depth;
		placeObject.move = !move? null : true;
		placeObject.cid = id;
		placeObject.matrix = getMatrix();
		placeObject.color = null;
		placeObject.ratio = null;
		placeObject.instanceName = name == ""? null : name;
		placeObject.clipDepth = null;
		placeObject.events = null;
		placeObject.filters = null;
		placeObject.blendMode = null;
		placeObject.bitmapCache = false;
		
		return TPlaceObject2(placeObject);
	}
	private function moveObject(depth : Int, x : Int, y : Int, scaleX : Null<Float>, scaleY : Null<Float>, rs0 : Null<Float>, rs1 : Null<Float>)
	{
		var id = null;
		var depth = depth;
		var name = "";
		var move = true;
		
		var scale;
		if(scaleX == null && scaleY == null)
			scale = null;
		else if(scaleX == null && scaleY != null) 
			scale = {x : 1.0, y : scaleY};
		else if(scaleX != null && scaleY == null) 
			scale = {x : scaleX, y : 1.0};
		else  
			scale = {x : scaleX, y : scaleY};
			
		var rotate;
		if(rs0 == null && rs1 == null) 
			rotate = null;
		else if(rs0 == null && rs1 != null) 
			rotate = {rs0 : 0.0, rs1 : rs1};
		else if(rs0 != null && rs1 == null) 
			rotate = {rs0 : rs0, rs1 : 0.0};
		else 
			rotate = {rs0 : rs0, rs1 : rs1};
			
		var translate = {x : x, y : y}

		var placeObject : PlaceObject = new PlaceObject();
		placeObject.depth = depth;
		placeObject.move = move;
		placeObject.cid = id;
		placeObject.matrix = {scale : scale, rotate : rotate, translate : translate};
		placeObject.color = null;
		placeObject.ratio = null;
		placeObject.instanceName = name == ""? null : name;
		placeObject.clipDepth = null;
		placeObject.events = null;
		placeObject.filters = null;
		placeObject.blendMode = null;
		placeObject.bitmapCache = false;
		return TPlaceObject2(placeObject);
	}
	
	private function tween()/*:Array<SWFTag>*/
	{
		var depth : Int = getInt('depth', null, true);
		var frameCount : Int = getInt('frameCount', null, true);
		var startX : Null<Int> = null;
		var startY : Null<Int> = null;
		var endX : Null<Int> = null;
		var endY : Null<Int> = null;
		
		var startScaleX : Null<Float> = null;
		var startScaleY : Null<Float> = null;
		var endScaleX : Null<Float> = null;
		var endScaleY : Null<Float> = null;
		
		var startRotateO : Null<Float> = null;
		var startRotate1 : Null<Float> = null;
		var endRotateO : Null<Float> = null;
		var endRotate1 : Null<Float> = null;
		
		for(tagNode in currentTag.elements())
		{
			currentTag = tagNode;
			checkUnknownAttributes();
			switch(currentTag.nodeName.toLowerCase())
			{
				case 'tw' : 
					var prop : String = getString('prop', "");
					var startxy : Null<Int> = null;
					var endxy : Null<Int> = null;
					var start : Null<Float> = null;
					var end : Null<Float> = null;
					if(prop == 'x' || prop == 'y')
					{
						startxy = getInt('start', 0, true);
						endxy = getInt('end', 0, true);
					}
					else
					{
						start = getFloat('start', null, true);
						end = getFloat('end', null, true);
					}
					switch(prop)
					{
						case 'x' : 
							startX = startxy;
							endX = endxy;
						case 'y' : 
							startY = startxy;
							endY = endxy;
						case 'scaleX' : 
							startScaleX = start;
							endScaleX = end;
						case 'scaleY' : 
							startScaleY = start;
							endScaleY = end;
						case 'rotate0' : 
							startRotateO = start;
							endRotateO = end;
						case 'rotate1' : 
							startRotate1 = start;
							endRotate1 = end;
						default : 
							error('ERROR: Unsupported ' + prop + ' in TW element. Tweenable properties are: x, y, scaleX, scaleY, rotateO, rotate1. TAG: ' + currentTag.toString());
					}
					
				default : 
					error('ERROR: ' + currentTag.nodeName + ' is not allowed inside a Tween element.  Valid children are: ' + validChildren.get('tween').toString() + '. TAG: ' + currentTag.toString());
			}
		}
		var tags : Array<SWFTag> = new Array();
		for(i in 0...frameCount)
		{
			var dx : Null<Int> = (startX == null || endX == null)? 0 : Std.int(startX + ((endX - startX) * i) / frameCount);
			var dy : Null<Int> = (startY == null || endY == null)? 0 : Std.int(startY + ((endY - startY) * i) / frameCount);
			
			var dsx : Null<Float> = (startScaleX == null || endScaleX == null)? null : startScaleX + ((endScaleX - startScaleX) * i) / frameCount;
			var dsy : Null<Float> = (startScaleY == null || endScaleY == null)? null : startScaleY + ((endScaleY - startScaleY) * i) / frameCount;
			
			var drs0 : Null<Float> = (startRotateO == null || endRotateO == null)? null : startRotateO + ((endRotateO - startRotateO) * i) / frameCount;
			var drs1 : Null<Float> = (startRotate1 == null || endRotate1 == null)? null : startRotate1 + ((endRotate1 - startRotate1) * i) / frameCount;
			tags.push(moveObject(depth, dx * 20, dy * 20, dsx, dsy ,drs0 , drs1));
			tags.push(showFrame()[0]);
		}
		return tags;
	}
	
	private function removeObject2()
	{
		var depth = getInt('depth', null, true);
		return TRemoveObject2(depth);
	}
	private function startSound()
	{
		var id : Int = getInt('id', null, true, false, true);
		var stop : Bool = getBool('stop', false);
		var loopCount = getInt('loopCount', 0);
		var hasLoops = loopCount == 0? false : true;
		return TStartSound(id, {syncStop : stop, hasLoops : hasLoops, loopCount : loopCount});
	}
	private function symbolClass()
	{
		var cid = getInt('id', null, true, false, true);
		var className = getString('class', "", true);
		var symbols : Array<SymData> = [{cid : cid, className : className}];
		var baseClass = getString('base', "");
		var tags : Array<SWFTag> = new Array();
		if(baseClass != "")
		{
			if(checkValidBaseClass(baseClass))
			{
				swcClasses.push([className, baseClass]);
				tags = [createABC(className, baseClass), TSymbolClass(symbols)];
			}
			else
			{
				error('ERROR: Invalid base class: ' + baseClass + '. Valid base classes are: ' + validBaseClasses.toString() + '. TAG: ' + currentTag.toString());
			}
		}
		else 
		{
			tags = [TSymbolClass(symbols)];
		}
		return tags;
	}
	private function exportAssets()
	{
		var cid = getInt('id', null, true, false, true);
		var className = getString('class', "", true);
		var symbols : Array<SymData> = [{cid : cid, className : className}];
		return [TExportAssets(symbols)];
	}
	private function metadata()
	{
		var file = getString('file', "", true);
		var data = getContent(file);
		return TMetadata(data);
	}
	//FRAME TAGS:
	private function frameLabel()
	{
		var label = getString('name', "", true);
		var anchor = getBool('anchor', false);
		return TFrameLabel(label, anchor);
	}
	
	private function showFrame():Array<SWFTag>
	{
		var showFrames:Array<SWFTag>=new Array();
		var count = getInt('count', null, false);
		if(count==null)
			return [TShowFrame];
		else
			for(i in 0...count)
				showFrames.push(TShowFrame);
		return showFrames;
	}
	
	private function endFrame()
	{
		return TEnd;
	}	
	private function custom()
	{
		var tagId = getInt('tagId', null, false);
		var data;
		var file = getString('file', "", false);
		if(file=='')
		{
			var str = getString('data', "", true);
			var arr:Array<String> = str.split(',');
			var buffer = new haxe.io.BytesBuffer();
			for(i in 0...arr.length)
			{
				buffer.addByte(Std.parseInt(arr[i]));
			}
			data = buffer.getBytes();
		}
		else
		{
			data = getBytes(file);
		}
		return TUnknown(tagId, data);
	}

	private function storeWidthHeight(id : Int, fileName : String, b : Bytes) : Void
	{
		var extension = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
		var height = 0;
		var width = 0;
		var bytes = new BytesInput(b);
		if(extension == 'jpg' || extension == 'jpeg')
		{
			if (bytes.readByte() != 255 || bytes.readByte() != 216)
			{
				error('ERROR: in image file: ' + fileName + '. SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: ' + currentTag.toString());
			}
			var marker : Int;
			var len : Int;
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
		else if(extension == 'png' )
		{
			bytes.bigEndian = true;
			bytes.readInt32();//0x89504e47 SOI
			bytes.readInt32();//0x0D0A1A0A
			bytes.readInt32();//0x0000000D THDR
			bytes.readInt32();//0x49484452
			//width = haxe.Int32.toInt(bytes.readInt32());
			//height = haxe.Int32.toInt(bytes.readInt32());
			width = bytes.readUInt30();
			height = bytes.readUInt30();
		}
		else if(extension == 'gif' )
		{
			bytes.bigEndian = false;
			bytes.readInt32();//0x47 0x49 0x46 0x38 
			bytes.readUInt16();//0x39 0x61
			width = bytes.readUInt16();
			height = bytes.readUInt16();
		}
		bitmapIds[id] = [width, height];
	}
	
	private function createABC(className : String, baseClass : String)
	{
		var ctx = new format.abc.Context();
		var c = ctx.beginClass(className);
		c.superclass = ctx.type(baseClass);
		switch(baseClass)
		{
			case 'flash.display.MovieClip' : 	
				ctx.addClassSuper("flash.events.EventDispatcher");
				ctx.addClassSuper("flash.display.DisplayObject");
				ctx.addClassSuper("flash.display.InteractiveObject");
				ctx.addClassSuper("flash.display.DisplayObjectContainer");
				ctx.addClassSuper("flash.display.Sprite");
				ctx.addClassSuper("flash.display.MovieClip");

			case 'flash.display.Sprite' : 
				ctx.addClassSuper("flash.events.EventDispatcher");
				ctx.addClassSuper("flash.display.DisplayObject");
				ctx.addClassSuper("flash.display.InteractiveObject");
				ctx.addClassSuper("flash.display.DisplayObjectContainer");
				ctx.addClassSuper("flash.display.Sprite");
				
			case 'flash.display.SimpleButton' : 
				ctx.addClassSuper("flash.events.EventDispatcher");
				ctx.addClassSuper("flash.display.DisplayObject");
				ctx.addClassSuper("flash.display.InteractiveObject");
				ctx.addClassSuper("flash.display.SimpleButton");
			
			case 'flash.display.Bitmap' : 
				ctx.addClassSuper("flash.events.EventDispatcher");
				ctx.addClassSuper("flash.display.DisplayObject");
				ctx.addClassSuper("flash.display.Bitmap");
			
			case 'flash.media.Sound' : 
				ctx.addClassSuper("flash.events.EventDispatcher");
				ctx.addClassSuper("flash.media.Sound");
				
			case 'flash.text.Font' : 
				ctx.addClassSuper("flash.text.Font");
			
			case 'flash.utils.ByteArray' : 
				ctx.addClassSuper("flash.utils.ByteArray");
		}
		var m = ctx.beginMethod(className, [], null, false, false, false, true);
		m.maxStack = 2;
		c.constructor = m.type;
		ctx.ops( [OThis, OConstructSuper(0), ORetVoid] );
		ctx.finalize();
		var abcOutput = new haxe.io.BytesOutput();
		format.abc.Writer.write(abcOutput, ctx.getData());
		return TActionScript3(abcOutput.getBytes(), {id : 1, label : className});
	}
	
	private function getContent(file : String)
	{
		checkFileExistence(file);
		#if neko
			return neko.io.File.getContent(file);
		#elseif php
			return php.io.File.getContent(file);
		#elseif cpp
			return cpp.io.File.getContent(file);
		#elseif air
			var f = new flash.filesystem.File();
			f = f.resolvePath(file);
			var fileStream = new flash.filesystem.FileStream();
			fileStream.open(f, FileMode.READ);
			var str = fileStream.readMultiByte(f.size, File.systemCharset);
			fileStream.close();
			return str;
		#else
			return Std.string(library.get(file));
		#end
	}
	private function getBytes(file : String)
	{
		checkFileExistence(file);
		#if neko
			return neko.io.File.getBytes(file);
		#elseif cpp
			return cpp.io.File.getBytes(file);
		#elseif php
			return php.io.File.getBytes(file);
		#elseif air
			var f = new flash.filesystem.File();
			f = f.resolvePath(file);
			var fileStream = new flash.filesystem.FileStream();
			fileStream.open(f, FileMode.READ);
			var byteArray : flash.utils.ByteArray = new flash.utils.ByteArray();
			fileStream.readBytes(byteArray);
			fileStream.close();
			return Bytes.ofData(byteArray);
		#else
			return Bytes.ofData(library.get(file));
		#end
	}
	private function getInt(att : String, defaultValue, ?required : Bool = false, ?uniqueId : Bool = false, ?targetId : Bool = false)
	{
		if(currentTag.exists(att))
			if(Math.isNaN(Std.parseInt(currentTag.get(att))))
				error('ERROR: attribute ' + att + ' must be an integer: ' + currentTag.toString());
		if(required)
			if(!currentTag.exists(att))
				error('ERROR: Required attribute ' + att + ' is missing in tag: ' + currentTag.toString());
		if(uniqueId)
			checkDictionary(Std.parseInt(currentTag.get(att)));
		if(targetId)
			checkTargetId(Std.parseInt(currentTag.get(att)));
		return currentTag.exists(att)?  Std.parseInt(currentTag.get(att)) : defaultValue;
	}
	private function getBool(att : String, defaultValue : Null<Bool>, ?required : Bool = false):Null<Bool>
	{
		if(required)
			if(!currentTag.exists(att))
				error('ERROR: Required attribute ' + att + ' is missing in tag: ' + currentTag);
		return currentTag.exists(att)? (currentTag.get(att) == 'true'? true : false) : defaultValue;
	}
	private function getFloat(att : String, defaultValue : Null<Float>, ?required : Bool = false)
	{
		if(currentTag.exists(att))
			if(Math.isNaN(Std.parseFloat(currentTag.get(att))))
				error('ERROR: attribute ' + att + ' must be a number: ' + currentTag.toString());
		if(required)
			if(!currentTag.exists(att))
				error('ERROR: Required attribute ' + att + ' is missing in tag: ' + currentTag.toString());
		return currentTag.exists(att)? Std.parseFloat(currentTag.get(att)) : defaultValue;
	}
	private function getString(att : String, defaultValue : String, ?required : Bool = false)
	{
		if(required)
			if(!currentTag.exists(att))
				error('ERROR: Required attribute ' + att + ' is missing in tag: ' + currentTag.toString());
		return currentTag.exists(att)? currentTag.get(att) : defaultValue;
	}
	private function getMatrix()
	{
		var scale, rotate, translate;
		//scale:
		var scaleX : Null<Float> = getFloat('scaleX', null);
		var scaleY : Null<Float> = getFloat('scaleY', null);
		scale = (scaleX == null && scaleY == null)? null : {x : scaleX == null? 1.0 : scaleX, y : scaleY == null? 1.0 : scaleY}
		//rotate:
		var rs0 : Null<Float> = getFloat('rotate0', null);
		var rs1 : Null<Float> = getFloat('rotate1', null);
		rotate = (rs0 == null && rs1 == null)? null : {rs0 : rs0 == null? 0.0 : rs0, rs1 : rs1 == null? 0.0 : rs1};
		//translate:
		var x = getInt('x', 0) * 20;
		var y = getInt('y', 0) * 20;
		translate = {x : x, y : y};
		return {scale : scale, rotate : rotate, translate : translate};
	}

	private function checkDictionary(id : Int) : Void
	{
		if(strict)
		{
			if(dictionary[id] != null)
			{
				error('ERROR: You are overwriting an existing id: ' + id + '. TAG: ' + currentTag.toString()); 
			}
			if(id == 0 && currentTag.nodeName.toLowerCase() != 'symbolclass')
			{
				error('ERROR: id 0 used outside symbol class. Index 0 can only be used for the SymbolClass tag that references the DefineABC tag which holds your document class/main entry point. Tag: ' + currentTag.toString());
			}
		}
		dictionary[id] = currentTag.nodeName.toLowerCase();
	}
	private function checkTargetId(id : Int) : Void
	{
		if(strict)
		{
			if(id != 0 && dictionary[id] == null)
			{
				error('ERROR: The target id ' + id + ' does not exist. TAG: ' + currentTag.toString());
			}
			else if(currentTag.nodeName.toLowerCase() == 'placeobject' || currentTag.nodeName.toLowerCase() == 'buttonstate')
			{
				switch(dictionary[id])
				{
					case'defineshape', 'definebutton', 'definesprite', 'defineedittext' : 
					default : 
						error('ERROR: The target id ' + id + ' must be a reference to a DefineShape, DefineButton, DefineSprite or DefineEditText tag. TAG: ' + currentTag.toString()); 
				}
			}
			else if(currentTag.nodeName.toLowerCase() == 'definescalinggrid')
			{
				switch(dictionary[id])
				{
					case'definebutton', 'definesprite' : 
					default : 
						error('ERROR: The target id ' + id + ' must be a reference to a DefineButton or DefineSprite tag. TAG: ' + currentTag.toString()); 
				}
			}
			else if(currentTag.nodeName.toLowerCase() == 'startsound')
			{
				if(dictionary[id] != 'definesound')
				{
					error('ERROR: The target id ' + id + ' must be a reference to a DefineSound tag. TAG: ' + currentTag.toString()); 
				}
			}
			else if(id != 0 && currentTag.nodeName.toLowerCase() == 'symbolclass')
			{
				switch(dictionary[id])
				{
					case'definebutton', 'definesprite', 'definebinarydata', 'definefont', 'defineabc', 'definesound', 'definebitsjpeg' : 
					default : 
						error('ERROR: The target id ' + id + ' must be a reference to a DefineButton, DefineSprite, DefineBinaryData, DefineFont, DefineABC, DefineSound or DefineBitsJPEG tag. TAG: ' + currentTag.toString()); 
				}
			}
		}
	}
	private function checkFileExistence(file : String) : Void
	{
		#if neko
		if(!neko.FileSystem.exists(file))
		{
			error('ERROR: File: ' + file + ' could not be found at the given location. TAG: ' + currentTag.toString());
		}
		#elseif cpp
		if(!cpp.FileSystem.exists(file))
		{
			error('ERROR: File: ' + file + ' could not be found at the given location. TAG: ' + currentTag.toString());
		}
		#elseif php
		if(!php.FileSystem.exists(file))
		{
			error('ERROR: File: ' + file + ' could not be found at the given location. TAG: ' + currentTag.toString());
		}
		#elseif air
			var f : File = new flash.filesystem.File(file);
			if(!f.exists)
			{
				error('ERROR: File: ' + file + ' could not be found at the given location. TAG: ' + currentTag.toString());
			}
		#else
			if(library.get(file) == null)
			{
				error('ERROR: File: ' + file + ' could not be found in the library. TAG: ' + currentTag.toString());
			}
		#end
	}
	private function setup() : Void
	{
		validChildren = new Hash();
		validChildren.set('swf', ['header', 'fileattributes', 'setbackgroundcolor', 'scriptlimits', 'definebitsjpeg', 'defineshape', 'definesprite', 'definebutton', 'definebinarydata', 'definesound', 'definefont', 'defineedittext', 'defineabc', 'definescalinggrid', 'placeobject', 'removeobject', 'startsound', 'symbolclass', 'exportassets', 'metadata', 'framelabel', 'showframe', 'endframe', 'custom']);
		validChildren.set('defineshape', ['beginfill', 'begingradientfill', 'beginbitmapfill', 'linestyle', 'moveto', 'lineto', 'curveto', 'endfill', 'endline', 'clear', 'drawcircle', 'drawellipse', 'drawrect', 'drawroundrect', 'drawroundrectcomplex', 'custom']);
		validChildren.set('definesprite', ['placeobject', 'removeobject', 'startsound', 'framelabel', 'showframe', 'endframe', 'tween', 'custom']);
		validChildren.set('definebutton', ['buttonstate', 'custom']);
		validChildren.set('tween', ['tw', 'custom']);
		
		validElements = new Hash();
		validElements.set('swf', []);
		validElements.set('header', ['width', 'height', 'fps', 'version', 'compressed', 'frameCount']);
		validElements.set('fileattributes', ['actionscript3', 'useNetwork', 'useDirectBlit', 'useGPU', 'hasMetaData']);
		validElements.set('setbackgroundcolor', ['color']);
		validElements.set('scriptlimits', ['maxRecursionDepth', 'scriptTimeoutSeconds']);
		validElements.set('definebitsjpeg', ['id', 'file']);
		validElements.set('defineshape', ['id', 'bitmapId', 'x', 'y', 'scaleX', 'scaleY', 'rotate0', 'rotate1', 'repeat', 'smooth']);
		validElements.set('beginfill',  ['color', 'alpha']);
		validElements.set('begingradientfill', ['colors', 'alphas', 'ratios', 'type', 'x', 'y', 'scaleX', 'scaleY', 'rotate0', 'rotate1']);
		validElements.set('beginbitmapfill', ['bitmapId', 'x', 'y', 'scaleX', 'scaleY', 'rotate0', 'rotate1', 'repeat', 'smooth']);
		validElements.set('linestyle', ['width', 'color', 'alpha','pixelHinting', 'scaleMode', 'caps', 'joints', 'miterLimit', 'noClose']);
		validElements.set('moveto', ['x', 'y']);
		validElements.set('lineto', ['x', 'y']);
		validElements.set('curveto', ['cx', 'cy', 'ax', 'ay']);
		validElements.set('endfill', []);
		validElements.set('endline', []);
		validElements.set('clear', []);
		validElements.set('drawcircle', ['x', 'y', 'r', 'sections']);
		validElements.set('drawellipse', ['x', 'y', 'width', 'height']);
		validElements.set('drawrect', ['x', 'y', 'width', 'height']);
		validElements.set('drawroundrect', ['x', 'y', 'width', 'height', 'r']);
		validElements.set('drawroundrectcomplex', ['x', 'y', 'width', 'height', 'rtl', 'rtr', 'rbl', 'rbr']);
		validElements.set('definesprite', ['id', 'frameCount']);
		validElements.set('definebutton', ['id']);
		validElements.set('buttonstate', ['id', 'depth', 'hit', 'down', 'over', 'up', 'x', 'y', 'scaleX', 'scaleY', 'rotate0', 'rotate1']);
		validElements.set('definebinarydata', ['id', 'file']);
		validElements.set('definesound', ['id', 'file']);
		validElements.set('definefont', ['id', 'file']);
		validElements.set('defineedittext', ['id', 'initialText', 'fontID', 'useOutlines', 'width', 'height', 'wordWrap', 'multiline', 'password', 'input', 'autoSize', 'selectable', 'border', 'wasStatic', 'html', 'fontClass', 'fontHeight', 'textColor', 'maxLength', 'align', 'leftMargin', 'rightMargin', 'indent', 'leading', 'variableName', 'file']);
		validElements.set('defineabc', ['file', 'name']);
		validElements.set('definescalinggrid', ['id', 'x', 'width', 'y', 'height']);
		validElements.set('placeobject', ['id', 'depth', 'name', 'move', 'x', 'y', 'scaleX', 'scaleY', 'rotate0', 'rotate1']);
		validElements.set('removeobject', ['depth']);
		validElements.set('startsound', ['id', 'stop', 'loopCount']);
		validElements.set('symbolclass', ['id', 'class', 'base']);
		validElements.set('exportassets', ['id', 'class']);
		validElements.set('metadata', ['file']);
		validElements.set('framelabel', ['name', 'anchor']);
		validElements.set('showframe', ['count']);
		validElements.set('endframe', []);
		validElements.set('tween', ['depth', 'frameCount']);
		validElements.set('tw', ['prop', 'start', 'end']);
		validElements.set('custom', ['tagId', 'file', 'data', 'comment']);
		
		validBaseClasses = ['flash.display.MovieClip', 'flash.display.Sprite', 'flash.display.SimpleButton', 'flash.display.Bitmap', 'flash.media.Sound', 'flash.text.Font','flash.utils.ByteArray'];
	}
	
	private function checkUnknownAttributes() : Void
	{
		if(!validElements.exists(currentTag.nodeName.toLowerCase()))
			error('ERROR: Unknown tag: '+ currentTag.nodeName);
		for(a in currentTag.attributes())
		{
			if(!checkValidAttribute(a))
			{
				error('ERROR: Unknown attribute: ' + a + '. Valid attributes are: ' + validElements.get(currentTag.nodeName.toLowerCase()).toString() +'. TAG: ' + currentTag.toString());
			}
		}
	}
	
	private function checkValidAttribute(a : String) : Bool
	{
		var validAttributes = validElements.get(currentTag.nodeName.toLowerCase());
		for(i in validAttributes)
		{
			if(a == i)
				return true;
		}
		return false;
	}
	
	private function checkValidBaseClass( c:String) : Bool
	{
		for(i in validBaseClasses)
		{
			if(c == i)
				return true;
		}
		return false;
	}
	private function createXML(mod : Float) : String
	{
		var xmlString = '';
		xmlString += '<?xml version="1.0" encoding ="utf-8"?>';
		xmlString += '<swc xmlns="http://www.adobe.com/flash/swccatalog/9">';
		xmlString += '<versions>';
		xmlString += '<swc version="1.2"/>';
		xmlString += '<haxe version="2.04"/>';
		xmlString += '</versions>';
		xmlString += '<features>';
		xmlString += '<feature-script-deps/>';
		xmlString += '<feature-files/>';
		xmlString += '</features>';
		//xmlString += '<components>';
		//xmlString += '<component className="Foo" name="foo" uri="http://foo.com" />';
		//xmlString += '</components>';
		xmlString += '<libraries>';
		xmlString += '<library path="library.swf">';
		for(i in swcClasses)
		{
			var dep = i[1].split('.');
			//xmlString += '<script name="'+i[0]+'" mod="' + Std.string(mod/1000) +'000" >';
			xmlString += '<script name="' + i[0] + '" mod="0" >';
			xmlString += '<def id="' + i[0] + '" />';
			xmlString += '<dep id="' + dep[0] + '.' + dep[1] + ':' + dep[2] + '" type="i" />';
			xmlString += '<dep id="AS3" type="n" />';
			xmlString += '</script>';
		}
		xmlString += '</library>';
		xmlString += '</libraries>';
		xmlString += '<files>';
		xmlString += '</files>';
		xmlString += '</swc>';
		return xmlString;
	}
	private function error(msg : String)
	{
			throw msg;
	}
	private function inform(msg : String)
	{
		#if neko
			neko.Lib.println(msg);
		#elseif php
			php.Lib.println(msg);
		#elseif cpp
			cpp.Lib.println(msg);
		#elseif (flash || air)
			flash.Lib.trace(msg);
		#end
	}
}
