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
import be.haxer.hxswfml.HXswfML;

class Main
{
	public static function main() 
	{
		var args:Array<String> = Sys.args();
		if (args.length<2)
		{
			Lib.println("Usage : hXswfML inputfile outputfile [true|false]");
			Lib.println("inputfile : text file containing xml");
			Lib.println("outputfile : swf or swc file");
			Lib.println("[true|false] : set to false to bypass checks. Default is true");
			Sys.exit(1);
		}
		else
		{	
			if(FileSystem.exists(args[0]))
			{
				var strict:Bool = true;
				if(args[2]!=null && args[2]!='true') 
					strict = false;
				var hxswfml = new HXswfML(strict);
				var swf = hxswfml.xml2swf(File.getContent(args[0]), args[1]);
				var file = File.write(args[1],true);
				file.write(swf);
				file.close();
			}
			else
			{
				Lib.println("!ERROR: File " + args[0] + " could not be found at the given location.");
				Sys.exit(1);
			}
		}
	}
}