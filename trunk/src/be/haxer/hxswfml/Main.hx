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
#end
import be.haxer.hxswfml.SwfWriter;

class Main
{
	public static function main() 
	{
		var args:Array<String> = Sys.args();
		if (args.length<3)
		{
			Lib.println("Usage		: hxswfml operation inputfile outputfile [options]");
			Lib.println("");
			Lib.println("operation	: xml2swf");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: swf or swc file");
			Lib.println("options		: strict: true|false. Default: true");
			Lib.println("");
			Lib.println("operation	: xml2abc");
			Lib.println("inputfile	: xml file");
			Lib.println("outputfile	: abc file");
			//Lib.println("options	: name: . Name for the abc file. Default: ");
			Lib.println("");
			Lib.println("operation	: abc2xml");
			Lib.println("inputfile	: swf, swc or abc file");
			Lib.println("outputfile	: xml file");
			Lib.println("options		: debugInfo: true|false. Display debug statements. Default: false");
			Lib.println("       		: jumpInfo: true|false. Display labels linked to jump statements. Default: false");
			Lib.println("       		: sourceInfo: true|false. Display original source code. Default: false");
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
				if(args[0] == 'abc2xml')
				{
					var abcReader = new AbcReader();
					abcReader.debugInfo = args[3]=='true';
					abcReader.jumpInfo = args[4]=='true';
					abcReader.sourceInfo = args[5]=='true';
					var xml = abcReader.abc2xml(args[1]);
					var file = File.write(args[2], false);
					file.writeString(xml);
					file.close();
				}
				else if (args[0] == 'xml2abc')
				{
					var abcWriter = new AbcWriter();
					var abc = abcWriter.xmlToabc(Xml.parse(File.getContent(args[1])).firstElement(), false);
					var file = File.write(args[2],true);
					file.write(abc);
					file.close();
				}
				else if(args[0] == 'xml2swf')
				{
					var strict:Bool = true;
					if(args[2]!=null && args[2]!='true') 
						strict = false;
					var swfWriter = new SwfWriter(strict);
					var swf = swfWriter.xml2swf(File.getContent(args[1]), args[2]);
					var file = File.write(args[2],true);
					file.write(swf);
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