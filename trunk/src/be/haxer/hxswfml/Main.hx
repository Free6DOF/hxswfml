package be.haxer.hxswfml;

import be.haxer.hxswfml.SwfWriter;

#if (haxe3 && (neko || cpp || php || java))
	import sys.FileSystem;
	import sys.io.File;
	typedef Lib=Sys;
#else
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
	#elseif java
	typedef Lib=Sys;
	import sys.io.File;
	import sys.FileSystem;
	#end
#end

class Main
{
	static var args:Array<String>;
	
	public static function main():Void
	{
		#if cpp
		cpp.vm.Gc.enable(false);
		#end
		
		args = Sys.args();
		if (args.length < 2) 
		{
			printUsage();
		}
		else
		{
			var op = args[0];
			switch(op)
			{
				case "xml2swf":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var strict = !argExists('-no-strict');//disables checking id references and valid elements
					var str = File.getContent(inFile);
					var swfWriter = new SwfWriter();
					var bytes = swfWriter.write(str, strict);
					var handle = File.write(outFile,true);
					handle.write(bytes);
					handle.close();

				case "xml2lib":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var str = File.getContent(inFile);
					var libWriter = new SwfLibWriter();
					var bytes = libWriter.write(str);
					var handle = File.write(outFile,true);
					handle.write(bytes);
					handle.close();

				case "lib2swc":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var str = File.getContent(inFile);
					var libWriter = new SwfLibWriter();
					libWriter.write(str);
					var bytes = libWriter.getSWC();
					var handle = File.write(outFile,true);
					handle.write(bytes);
					handle.close();

				case "xml2swc":
					if (args.length < 3) printUsage();
						
					var inFile = args[1];
					var outFile = args[2];
					var strict = !argExists('-no-strict');//disables checking id references and valid elements
					
					var swfWriter = new SwfWriter();
					swfWriter.write(File.getContent(inFile), strict);
					File.write(outFile,true).write(swfWriter.getSWC());

				case "xml2abc":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					
					var abcWriter = new AbcWriter();
					abcWriter.log = argExists('-stack');
					abcWriter.strict = argExists('-strict');
					File.write(outFile,true).write(abcWriter.write(File.getContent(inFile)));

				case "abc2swf":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var main = getArgValue('-main');//main class for symbol class tag
					var log:Bool = argExists('-stack');//monitors the stacks
					var strict:Bool = argExists('-strict');//throws errors when any of the stacks exeed their set limits
					var extension = inFile.substr(inFile.lastIndexOf('.') + 1).toLowerCase();
					
					var abcWriter = new AbcWriter();
					abcWriter.log = log;
					abcWriter.strict = strict;
					switch(extension)
					{
						case "xml":
							abcWriter.write(File.getContent(inFile));
						case "abc":
							abcWriter.abc2swf(File.getBytes(inFile));
						default :
					}
					File.write(outFile, true).write(abcWriter.getSWF(main));
					
				case "abc2swc":
					if (args.length < 3) printUsage();

					var inFile = args[1];
					var outFile = args[2];
					var main = getArgValue('-main');//main class for symbol class tag
					var log:Bool = argExists('-stack');//logs the stack depth
					var strict:Bool = argExists('-strict');//throws errors when any of the stacks exeed their set limits
					var extension = inFile.substr(inFile.lastIndexOf('.') + 1).toLowerCase();
					
					var abcWriter = new AbcWriter();
					abcWriter.log = log;
					abcWriter.strict = strict;
					switch(extension)
					{
						case "xml":
							abcWriter.write(File.getContent(inFile));
						//case "abc":
							//abcWriter.abc2swf(File.getBytes(inFile));
						default :
					}
					File.write(outFile, true).write(abcWriter.getSWC(main));

				case "abc2xml":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var debug = !argExists('-no-debug');//Filter out debug info.
					var source = argExists('-source');//Interweaves the original source code through the xml. (abc must have been compiled in -debug mode and source files must be available)
					var extension = inFile.substr(inFile.lastIndexOf('.') + 1).toLowerCase();
					
					var abcReader = new AbcReader();
					abcReader.debugInfo = debug;
					abcReader.sourceInfo = source;
					abcReader.read(extension, File.getBytes(inFile));
					File.write(outFile, false).writeString(abcReader.getXML());

				case "abc2hxm":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var mainClass = getArgValue('-main');//main class for symbol class tag
					if (mainClass == null) throw 'Missing class for -main';
					var useFolders = argExists('-folders');//create folders according to packages
					var debugInfo = !argExists('-no-debug');//Filter out debug info.
					var sourceInfo = argExists('-source');//Interweaves the original source code through the xml. (abc must have been compiled in -debug mode and source files must be available)
					var showBytePos = argExists('-bytepos');//show the byteposition for every opcode
					var log = argExists('-stack');//monitor the stacks
					var strict = argExists('-strict');//throw erros when stacks exceed set limits
					var extension = inFile.substr(inFile.lastIndexOf('.') + 1).toLowerCase();
					
					var abcReader = new AbcReader();
					abcReader.debugInfo = true;
					abcReader.sourceInfo = false;
					abcReader.read(extension, File.getBytes(inFile));
					var xml = abcReader.getXML();

					var hxmWriter = new HxmWriter();
					hxmWriter.debugInfo = true;//debugInfo;
					hxmWriter.sourceInfo = sourceInfo;
					hxmWriter.useFolders = useFolders;
					hxmWriter.showBytePos = showBytePos;
					hxmWriter.strict = strict;
					hxmWriter.log = log;
					hxmWriter.outputFolder = "";
					hxmWriter.write(xml);
					var zip = hxmWriter.getZIP(mainClass);
					File.write(outFile, true).write(zip);
					
				case "ttf2swf":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var className = getArgValue('-class');
					if (className == null) throw 'Missing class name for font';
					var ranges = getArgValue('-glyphs');
					if (ranges == null) ranges = "32-126";
						
					var fontWriter = new FontWriter();
					fontWriter.write(File.getBytes(inFile),ranges, 'swf');
					File.write(outFile,true).write(fontWriter.getSWF(1,className, 10, true, 1024, 1024, 30, 1));
					
				case "dumpttf":
					if (args.length < 3) printUsage();
					var inFile = args[1];
					var outFile = args[2];
					File.write(outFile, false).writeString(new FontWriter().listGlyphs(File.getBytes(inFile)));

				case "ttf2hx":
					if (args.length < 2) printUsage();
					
					var inFile = args[1];
					var ranges = getArgValue('-glyphs');
					if (ranges == null) ranges = "32-126";
					var precision = getArgValue('-precision');
					
					var fontWriter = new FontWriter();
					if(precision != null) fontWriter.precision = Std.parseInt(precision);
					fontWriter.write(File.getBytes(inFile), ranges, 'zip');
					File.write(fontWriter.fontName+'.zip', true).write(fontWriter.getZip());
					
				case "ttf2path":
					if (args.length < 2) printUsage();
					var inFile = args[1];
					var ranges = getArgValue('-glyphs');
					if (ranges == null) ranges = "32-126";
					var precision = getArgValue('-precision');

					var fontWriter = new FontWriter();
					if(precision != null) fontWriter.precision = Std.parseInt(precision);
					fontWriter.write(File.getBytes(inFile), ranges, 'path');
					File.write(fontWriter.fontName+'.path',false).writeString(fontWriter.getPath());
					
				case "ttf2hash":
					if (args.length < 2) printUsage();
					var inFile = args[1];
					var ranges = getArgValue('-glyphs');
					if (ranges == null) ranges = "32-126";
					var precision = getArgValue('-precision');
					
					var fontWriter = new FontWriter();
					if(precision != null) fontWriter.precision = Std.parseInt(precision);
					fontWriter.write(File.getBytes(inFile), ranges, 'hash');
					File.write(inFile+'.hash',false).writeString(fontWriter.getHash(true));
				
				case "flv2swf":
					if (args.length < 3) printUsage();
					
					var inFile = args[1];
					var outFile = args[2];
					var fps = getArgValue('-fps');
					if (fps == null ) fps = '24';
					var width = getArgValue('-width');
					if (width == null) width = "320";
					var height = getArgValue('-height');
					if (height == null) height = "320";
					
					var videoWriter = new VideoWriter();
					videoWriter.write(File.getBytes(inFile), Std.parseInt(fps), Std.parseInt(width), Std.parseInt(height));
					File.write(outFile, true).write(videoWriter.getSWF());
					
					/*
				case "swf2hx":
					Lib.println("Under construction");
					
					if (args.length < 2) printUsage();
					var inFile = args[1];

					var haxeWriter = new HaxeWriter();
					var outFile = args[2];
					var outFile = inFile.split(".swf").join(".zip");
					File.write(outFile,true).write(haxeWriter.write(File.getBytes(inFile)));
					*/
					
				default:
					Lib.println("Unknown operation: " + args[0]);
					printUsage();
			}
		}
	}
	static function printUsage():Void
	{
		Lib.println("hxswfml " + getRevisionNumber() + "- XML based swf and abc assembler. 2009-2013");
		Lib.println("Usage: hxswfml <operation> input-file output-file [args] [options]");
		Lib.println("");

		Lib.println("xml2swf");
		Lib.println("  in : xml file");
		Lib.println("  out : swf file");
		Lib.println("  options : -no-strict");
		Lib.println("");

		Lib.println("xml2lib");
		Lib.println("  in : xml file");
		Lib.println("  out : swf file");
		Lib.println("");
		
		Lib.println("lib2swc");
		Lib.println("  in : xml file");
		Lib.println("  out : swc file");
		Lib.println("");
		
		Lib.println("xml2swc");
		Lib.println("  in : xml file");
		Lib.println("  out: swc file");
		Lib.println("  options : -no-strict");
		Lib.println("");
		
		Lib.println("xml2abc");
		Lib.println("  in : xml file");
		Lib.println("  out : abc file");
		Lib.println("  options : -strict, -stack");
		Lib.println("");
		
		Lib.println("abc2swf");
		Lib.println("  in : xml or abc file");
		Lib.println("  out : swf file");
		Lib.println("  args : -main");
		Lib.println("  options : -strict, -stack");
		Lib.println("");

		Lib.println("abc2swc");
		Lib.println("  in : xml file");
		Lib.println("  out : swc file");
		Lib.println("  args : -main");
		Lib.println("  options : -strict, -stack");
		Lib.println("");

		Lib.println("abc2xml");
		Lib.println("  in : swf, swc or abc file");
		Lib.println("  out : xml file");
		Lib.println("  options : -no-debug, -source");
		Lib.println("");

		Lib.println("abc2hxm");
		Lib.println("  in : swf, swc or abc file");
		Lib.println("  out : zip file name");
		Lib.println("  args : -main");
		Lib.println("  options : -no-debug, -source, -folders");
		Lib.println("");

		Lib.println("ttf2swf");
		Lib.println("  in : ttf file");
		Lib.println("  out : swf file");
		Lib.println("  args : -class");
		Lib.println("  options : -glyphs");
		Lib.println("");

		Lib.println("ttf2hx");
		Lib.println("  in : ttf file");
		Lib.println("  options : -glyphs, -precision");
		Lib.println("");
			
		Lib.println("ttf2path");
		Lib.println("  in : ttf file");
		Lib.println("  options : -glyphs, -precision");
		Lib.println("");
			
		Lib.println("ttf2hash");
		Lib.println("  in : ttf file");
		Lib.println("  options : -glyphs, -precision");
		Lib.println("");

		Lib.println("flv2swf");
		Lib.println("  in : flv file (audioCodecs:mp3, videoCodecs: VP6, VP6+alpha, Sorenson H.263)");
		Lib.println("  out : swf file");
		Lib.println("  options : -fps, -width, -height");
		Lib.println("");

		/*
		Lib.println("swf2hx");
		Lib.println("  in : swf file");
		//Lib.println("  out : zip file");
		*/

		Sys.exit(1);
	}
	static function checkFile(p:String):Void
	{
		if (!FileSystem.exists(args[1]))
		{
			Lib.println("ERROR: File " + args[1] + " could not be found.");
			Sys.exit(1);
		}
	}
	static function argExists(v:String):Bool
	{
		for (arg in args)
			if (arg == v)
				return true;
		return false;
	}
	static function getArgValue(v:String):Null<String>
	{
		for (i in 0...args.length)
			if (args[i] == v)
				return args[i + 1];
		return null;
	}
	@:macro static function getRevisionNumber()
	{
		var revInfo = "";
		if (FileSystem.exists("./doc/version.txt"))
		{
			var content = sys.io.File.getContent("./doc/version.txt");
			var currentVersionPart = content.split(":").pop();
			var currentVersionStr = currentVersionPart.split("\r").join("").split("\n").join("").split("M").join("");
			var currentVersionNr = Std.parseInt(currentVersionStr);
			var newVersionNr = currentVersionNr + 1;
			revInfo = "r"+ newVersionNr + " ";
			//sys.io.File.saveContent("./version.txt", Std.string(newVersionNr));
		}
		return haxe.macro.Context.makeExpr(revInfo, haxe.macro.Context.currentPos());
	}
}