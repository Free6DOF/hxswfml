package be.haxer.hxswfml;
#if neko
import neko.Sys;
import neko.Lib;
import neko.FileSystem;
import neko.io.File;
#elseif cpp
import cpp.Sys;
import cpp.Lib;
import cpp.FileSystem;
import cpp.io.File;
#elseif php
import php.Sys;
import php.Lib;
import php.FileSystem;
import php.io.File;
#end
//import be.haxer.hxswfml.SwfWriter;

class Main
{
	public static function main() 
	{
		var args:Array<String> = Sys.args();
		if (args.length<3 && args[0] != 'ttf2hx' && args[0] != 'ttf2swf')
		{
			Lib.println("Usage		: hxswfml operation inputfile outputfile [options]");
			Lib.println("");
			Lib.println("operation	: xml2swf");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: swf file");
			Lib.println("options		: strict: true|false. Default: true");
			//Lib.println("example		: hxswfml xml2swf index.xml index.swf false");
			Lib.println("");
			Lib.println("operation	: xml2swc");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: swc file");
			Lib.println("options		: strict: true|false. Default: true");
			//Lib.println("example		: hxswfml xml2swc index.xml index.swc false");
			Lib.println("");
			Lib.println("operation	: xml2abc");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: abc file");
			//Lib.println("example		: hxswfml xml2abc script.xml script.abc false");
			Lib.println("");
			Lib.println("operation	: abc2xml");
			Lib.println("inputfile	: swf, swc or abc file");
			Lib.println("outputfile	: xml file");
			Lib.println("options		: debugInfo: true|false. Display debug statements. Default: false");
			Lib.println("       		: sourceInfo: true|false. Display original source code. Default: false");
			Lib.println("");
			//Lib.println("example		: hxswfml abc2xml movie.swf scripts.xml true true true");
			Lib.println("operation	: abc2hxm");
			Lib.println("inputfile	: swf, swc or abc file");
			Lib.println("outputfile	: hx file");
			Lib.println("main class	: main class");
			Lib.println("options		: debugInfo: true|false. Display debug statements. Default: false");
			Lib.println("       		: sourceInfo: true|false. Display original source code. Default: false");
			Lib.println("       		: useFolders: true|false. Output to package folders. Default: false(single file)");
			//Lib.println("example		: hxswfml abc2hxm movie.swf scripts.hx true true true");
			Lib.println("");
			Lib.println("operation	: abc2swf");
			Lib.println("inputfile	: xml or abc file");
			Lib.println("outputfile	: swf file");
			//Lib.println("example		: hxswfml abc2swf script.abc index.swf");
			Lib.println("");
			Lib.println("operation	: abc2swc");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: swc file");
			//Lib.println("example		: hxswfml abc2swc script.xml lib.swc");
			Lib.println("");
			Lib.println("operation	: ttf2swf");
			Lib.println("inputfile	: ttf file");
			//Lib.println("outputfile	: swf file");
			Lib.println("arguments	: class name");
			Lib.println("       		: charcodes:[32-127]");
			//Lib.println("example		: hxswfml ttf2swf arial.ttf font.swf MyFont [32-100,110-127]");
			Lib.println("");
			Lib.println("operation	: ttf2hx");
			Lib.println("inputfile	: ttf file");
			Lib.println("argument		: charcodes:[32-127]");
			//Lib.println("example		: hxswfml ttf2hx arial.ttf [32-127]");
			Lib.println("");
			Lib.println("operation	: ttf2path");
			Lib.println("inputfile	: ttf file");
			Lib.println("argument		: charcodes:[32-127]");
			//Lib.println("example		: hxswfml ttf2txt arial.ttf [32-127]");
			Lib.println("");
			Lib.println("operation	: flv2swf");
			Lib.println("inputfile	: flv file (audioCodecs:mp3, videoCodecs: VP6, VP6+alpha, Sorenson H.263)");
			Lib.println("outputfile	: swf file");
			Lib.println("options		: fps");
			Lib.println("       		: width");			
			Lib.println("       		: height");	
			//Lib.println("example		: hxswfml flv2swf video.flv movie.swf 25 320 240");
			Lib.println("");
			
			Sys.exit(1);
		}
		else
		{	
			if (!FileSystem.exists(args[1]))
			{
				Lib.println("ERROR: File " + args[1] + " could not be found at the given location.");
				Sys.exit(1);
			}
			else 
			{
				if(args[0] == 'xml2swf')
				{
					var w = new SwfWriter();
					var file = File.write(args[2],true);
					file.write(w.write(File.getContent(args[1]), args[3]!='false'));
					file.close();
				}
				else if(args[0] == 'xml2swc')
				{
					var swfWriter = new SwfWriter();
					var file = File.write(args[2],true);
					swfWriter.write(File.getContent(args[1]), args[3]!='false');
					file.write(swfWriter.getSWC());
					file.close();
				}
				else if (args[0] == 'xml2abc')
				{
					var file = File.write(args[2],true);
					file.write(new AbcWriter().write(File.getContent(args[1])));
					file.close();
				}
				else if (args[0] == 'abc2swf')
				{
					var extension = args[1].substr(args[1].lastIndexOf('.') + 1).toLowerCase();
					var className = args[3];
					var abcWriter = new AbcWriter();
					if(extension=="xml")
						abcWriter.write(File.getContent(args[1]));
					else if(extension=="abc")
						abcWriter.abc2swf(File.getBytes(args[1]));
					var swf = abcWriter.getSWF(if(className!=null)className);	
					var file = File.write(args[2],true);
					file.write(swf);
					file.close();
				}
				else if (args[0] == 'abc2swc')
				{
					var extension = args[1].substr(args[1].lastIndexOf('.') + 1).toLowerCase();
					var className = args[3];
					var abcWriter = new AbcWriter();
					if(extension=="xml")
						abcWriter.write(File.getContent(args[1]));
					else
						throw 'unsupported file format';
					var swc = abcWriter.getSWC();	
					var file = File.write(args[2],true);
					file.write(swc);
					file.close();
				}
				else if(args[0] == 'abc2xml')
				{
					#if cpp
					Lib.println("ERROR: Due to a bug in the cpp target, abc2xml is currently not available.Use the neko version.");
					#else
					var abcReader = new AbcReader();
					abcReader.debugInfo = args[3]=='true';
					abcReader.sourceInfo = args[4]=='true';
					abcReader.read(args[1]);
					var xml = abcReader.getXML();
					var file = File.write(args[2], false);
					file.writeString(xml);
					file.close();
					#end
				}
				else if(args[0] == 'abc2hxm')
				{
					#if cpp
					Lib.println("ERROR: Due to a bug in the cpp target, abc2hxm is currently not available. Use the neko version.");
					#else
					var abcReader = new AbcReader();
					abcReader.debugInfo = args[4]=='true';
					abcReader.sourceInfo = args[5]=='true';
					abcReader.read(args[1]);
					var xml = abcReader.getXML();
					
					var hxmWriter = new HxmWriter();
					hxmWriter.debugInfo = args[4]=='true';
					hxmWriter.sourceInfo = args[5]=='true';
					hxmWriter.useFolders = args[6]=='true';
					hxmWriter.showBytePos=true;
					hxmWriter.log=false;
					var tempFolder=args[2].split('/');
					tempFolder.pop();
					hxmWriter.outputFolder=tempFolder.join('/');
					hxmWriter.write(xml);
					var hxm = hxmWriter.getHXM(args[3]);	
					var file = File.write(hxmWriter.outputFolder+'/GenSWF.hx', false);
					file.writeString(hxm);
					file.close();
					#end
				}
				else if(args[0] == 'xml2hxm')
				{
					#if cpp
					Lib.println("ERROR: Due to a bug in the cpp target, xml2hxm is currently not available. Use the neko version.");
					#else
					var xml = File.getContent(args[1]);
					
					var hxmWriter = new HxmWriter();
					hxmWriter.debugInfo = args[4]=='true';
					hxmWriter.sourceInfo = args[5]=='true';
					hxmWriter.useFolders = args[6]=='true';
					hxmWriter.showBytePos=true;
					hxmWriter.log=false;
					var tempFolder=args[2].split('/');
					tempFolder.pop();
					hxmWriter.outputFolder=tempFolder.join('/');
					hxmWriter.write(xml);
					var hxm = hxmWriter.getHXM(args[3]);	
					var file = File.write(hxmWriter.outputFolder+'/GenSWF.hx', false);
					file.writeString(hxm);
					file.close();
					#end
				}
				else if(args[0] == 'ttf2swf')
				{
					var bytes = File.getBytes(args[1]);
					var className = args[2]==null?throw 'Missing class name argument':args[2];
					var ranges = "32-127";
					if(args[3]!=null)ranges=args[3];
					
					var fontWriter = new FontWriter();
					fontWriter.write(bytes,ranges, 'swf');
					var swf = fontWriter.getSWF(1,className, 10, false, 1024, 1024, 30, 1);
					var file = File.write(fontWriter.fontName+'.swf',true);
					file.write(swf);
					file.close();
				}
				else if(args[0] == 'ttf2hx')
				{
					var bytes = File.getBytes(args[1]);
					var ranges = "32-127";
					if(args[2]!=null) ranges = args[2];
					var fontWriter = new FontWriter();
					fontWriter.write(bytes, ranges, 'zip');
					var zip = fontWriter.getZip();
					var file = File.write(fontWriter.fontName+'.zip', true);
					file.write(zip);
					file.close();
				}
				else if(args[0] == 'ttf2path')
				{
					var bytes = File.getBytes(args[1]);
					var ranges = "32-127";
					if(args[2]!=null) ranges = args[2];
					var fontWriter = new FontWriter();
					fontWriter.write(bytes, ranges, 'path');
					var path = fontWriter.getPath();
					var file = File.write(fontWriter.fontName+'.path',false);
					file.writeString(path);
					file.close();
				}
				else if(args[0] == 'flv2swf')
				{
					var flvBytes = File.getBytes(args[1]);
					var swfName = args[2];
					var fps = args[3]==null?24:Std.parseInt(args[3]);
					var width = args[4]==null?320:Std.parseInt(args[4]);
					var height = args[5]==null?240:Std.parseInt(args[5]);
					var videoWriter = new VideoWriter();
					videoWriter.write(flvBytes, fps, width, height);
					var file = File.write(swfName,true);
					file.write(videoWriter.getSWF());
					file.close();
				}
				else
				{
					Lib.println("Unknown operation: " + args[0]);
					Sys.exit(1);
				}
			}
		}
	}
}