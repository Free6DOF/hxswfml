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

class Main
{
	public static function main() 
	{
		var args:Array<String> = Sys.args();
		if (args.length!=2)
		{
			throw "Usage: hXswfML in.xml out.swf";
		}
		else
		{	
			if(FileSystem.exists(args[0]))
			{
				var hxswfml = new HXswfML();
				var swf = hxswfml.xml2swf(File.getContent(args[0]), args[1]);
				var file = File.write(args[1],true);
				file.write(swf);
				file.close();
			}
			else
			{
				throw '!ERROR: File ' + args[0] + ' could not be found at the given location.';
			}
		}
	}
}