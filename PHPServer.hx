// Copyright (c) 2009 Omer Goshen <gershon@goosemoose.com>
import php.io.File;
import php.io.FileOutput;
import php.Sys;
import php.FileSystem;


/**
* @author Omer Goshen <gershon@goosemoose.com>
*/
class PHPServer {

	public static function main() {
		var ctx = new haxe.remoting.Context();
		ctx.addObject("Server", new PHPServer());
		if( haxe.remoting.HttpConnection.handleRequest(ctx) )
		return;
		// php.Lib.println("This is a remoting server !");


		// php.Lib.println(php.Web.getParams());

/*
		var headers = php.Web.getClientHeaders();
		php.Lib.println(headers);

		var out = new haxe.io.BytesOutput();
		var boundaryIndex = Std.string(headers).indexOf("boundary=");
		php.Lib.println(boundaryIndex);
		// byte[] boundary = (contentType.substring(boundaryIndex + 9)).getBytes();
		var boundary = Std.string(php.Web.getParams()).substr(boundaryIndex + 9);
		php.Lib.println(boundary);

		php.Web.parseMultipart(
		function(part:String, filename:String) {
			php.Lib.println(part);
			php.Lib.println(filename);
			php.Lib.println(php.FileSystem.fullPath(filename));
		},
		function(data:haxe.io.Bytes, pos:Int, size:Int) {
			php.Lib.println(pos);
			php.Lib.println(size);
			php.Lib.println(data);
		});
*/

		// php.Lib.println(php.Web.getParams());
	}

	//{{{ Constructor
	public function new() {
		// run();
		// load("library.xml");
	}
	//}}}


	//{{{ directoryExists
	public function directoryExists(dir:String) : Bool {
		return (php.FileSystem.exists(dir) && php.FileSystem.isDirectory(dir));
	}
	//}}}


	//{{{ readDirectoryFiltered
	public function readDirectoryFiltered(?dir:String=".", ?r:String=null) {
		if(!php.FileSystem.exists(dir) || !php.FileSystem.isDirectory(dir)) return null;
		var filter : EReg = new EReg(r, "");
		return Lambda.array(Lambda.filter(readDirectory(dir), function(f) { return filter.match(f); }));
	}
	//}}}


	//{{{ readDirectory
	public function readDirectory(?dir:String=".") : Array<String> {
		if(!php.FileSystem.exists(dir) || !php.FileSystem.isDirectory(dir)) return null;
		php.Sys.sleep(.5);
		return php.FileSystem.readDirectory(dir);
	}
	//}}}


	//{{{ getFileArrayStats
	public function getFileArrayStats(filearray:Array<String>) : Array<FileStat> {
		var stats = new Array<FileStat>();
		for(file in filearray)
			stats.push(getFileStats(file));
		php.Sys.sleep(.25);
		return stats;
	}
	//}}}


	//{{{ getFileStats
	public inline function getFileStats(f:String) : FileStat {
		var stat = php.FileSystem.stat(f);
		php.Sys.sleep(.025);
		return stat;
	}
	//}}}


	//{{{ getFullPath
	public inline function getFullPath(?dir:String=".") : String {
		return php.FileSystem.fullPath(dir);
	}
	//}}}


	//{{{ getDirectoryTree
	public function getDirectoryTree(?dir:String=".") : Dynamic {
		if(!php.FileSystem.exists(dir)) return;
		var o = {};
		var contents : Array<Dynamic> = readDirectory(getFullPath(dir));
		if(contents==null || contents.length==0) return;
		for(i in contents) {
			var f : String = getFullPath(dir+"/"+i);
			if(php.FileSystem.isDirectory(f)) {
				//Reflect.setField(o, i, getDirectoryTree(f));
				Reflect.setField(o, i, {stub: null});
			}
			//else
			//Reflect.setField(o, i, i);
		}
		return o;
	}
	//}}}


	//{{{ load
	public function load(fname:String) : String {
		return php.io.File.getContent(fname);
	}
	//}}}

	//{{{ save
	public function save(fname:String, data:String) {

		var fout = php.io.File.write(fname, false);


		fout.writeString(data);
		fout.close();
	}
	//}}}

	
	//{{{ run
	public function run(inFile:String, outFile:String) {
		//php.Lib.println("Launching hXswfML...");

		testCommand("hXswfML");

		// args = php.Sys.args();

		try {
			var proc = new php.io.Process("hXswfML", [inFile, outFile]);

			php.Lib.println(proc.stdout.readAll());
			php.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: " + ex);
			php.Lib.println("stack: " + haxe.Stack.exceptionStack());
			php.Sys.exit(1);
		}
	}
	//}}}
		
	/*
	//{{{ run
	public function run(inFile:String, outFile:String) {
		// php.Lib.println("Launching SwfMill...");

		testCommand("swfmill");


		// args = php.Sys.args();

		try {
			var fData = php.io.File.getContent("library.xml");
			var xmlData = Xml.parse(fData).firstElement();

			var proc = new php.io.Process("swfmill", ['-v', 'simple', inFile, outFile]);

			php.Lib.println(proc.stdout.readAll());
			php.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: " + ex);
			php.Lib.println("stack: " + haxe.Stack.exceptionStack());
			php.Sys.exit(1);
		}
	}
	//}}}
	*/


	//{{{ run
	public function dump(inFile:String) {
		// php.Lib.println("Launching swfdump...");

		testCommand("swfdump");

		// args = php.Sys.args();

		try {
			var proc = new php.io.Process("swfdump", [inFile]);

			php.Lib.println(proc.stdout.readAll());
			php.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: " + ex);
			php.Lib.println("stack: " + haxe.Stack.exceptionStack());
			php.Sys.exit(1);
		}
	}
	//}}}


	//{{{ make
	public function make() {
		testCommand("make");

		try {
			var proc = new php.io.Process("make", []);

			php.Lib.println(proc.stdout.readAll());
			php.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: " + ex);
			php.Lib.println("stack: " + haxe.Stack.exceptionStack());
			php.Sys.exit(1);
		}
	}
	//}}}

	//{{{ xsltproc
	public function xsltproc(arg:Array<String>) : String {
		// php.Lib.println("Launching xsltproc...");

		testCommand("xsltproc");

		// args = php.Sys.args();
		//php.Lib.println(arg);

		try {
			var proc = new php.io.Process("xsltproc", arg);

			var out = proc.stdout.readAll().toString();
			out += proc.stderr.readAll().toString();

			//php.Lib.println(out);
			//php.Lib.println(StringTools.urlDecode(out));
			//return StringTools.urlDecode(StringTools.htmlEscape(out.toString()));
			return StringTools.urlDecode(out);
			//return out;
		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: " + ex);
			php.Lib.println("stack: " + haxe.Stack.exceptionStack());
			php.Sys.exit(1);
		}
		return null;
	}
	//}}}


	//{{{ getExePath
	public function getExePath() : String {
		return php.Sys.executablePath();
	}
	//}}}


	//{{{ getCwd
	public function getCwd() : String {
		return php.Sys.getCwd();
	}
	//}}}


	//{{{ getWebCwd
	public function getWebCwd() : String {
		return php.Web.getCwd();
	}
	//}}}


	//{{{ testCommand
	/**
	* Test if a command is installed in the system
	*/
	public function testCommand(c:String, ?args:Array<String>) {
		if(args==null) args = [];
		try	{
			var ret = new php.io.Process(c, args);
			ret.exitCode();
		}
		catch (ex:String) {
			php.Lib.println("Launcher Error: "+c+" is not installed");
			php.Sys.exit(2);
		}
	}
	//}}}
}

