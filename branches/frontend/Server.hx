// Copyright (c) 2009 Omer Goshen <gershon@goosemoose.com>
import neko.io.File;
import neko.io.FileOutput;
import neko.Sys;
import neko.FileSystem;


/**
* @author Omer Goshen <gershon@goosemoose.com>
*/
class Server {

	public static function main() {
		var ctx = new haxe.remoting.Context();
		ctx.addObject("Server", new Server());
		if( haxe.remoting.HttpConnection.handleRequest(ctx) )
		return;
		// neko.Lib.println("This is a remoting server !");


		// neko.Lib.println(neko.Web.getParams());

/*
		var headers = neko.Web.getClientHeaders();
		neko.Lib.println(headers);

		var out = new haxe.io.BytesOutput();
		var boundaryIndex = Std.string(headers).indexOf("boundary=");
		neko.Lib.println(boundaryIndex);
		// byte[] boundary = (contentType.substring(boundaryIndex + 9)).getBytes();
		var boundary = Std.string(neko.Web.getParams()).substr(boundaryIndex + 9);
		neko.Lib.println(boundary);

		neko.Web.parseMultipart(
		function(part:String, filename:String) {
			neko.Lib.println(part);
			neko.Lib.println(filename);
			neko.Lib.println(neko.FileSystem.fullPath(filename));
		},
		function(data:haxe.io.Bytes, pos:Int, size:Int) {
			neko.Lib.println(pos);
			neko.Lib.println(size);
			neko.Lib.println(data);
		});
*/

		// neko.Lib.println(neko.Web.getParams());
	}

	//{{{ Constructor
	public function new() {
		// run();
		// load("library.xml");
	}
	//}}}


	//{{{ directoryExists
	public function directoryExists(dir:String) : Bool {
		return (neko.FileSystem.exists(dir) && neko.FileSystem.isDirectory(dir));
	}
	//}}}


	//{{{ readDirectoryFiltered
	public function readDirectoryFiltered(?dir:String=".", ?r:String=null) {
		if(!neko.FileSystem.exists(dir) || !neko.FileSystem.isDirectory(dir)) return null;
		var filter : EReg = new EReg(r, "");
		return Lambda.array(Lambda.filter(readDirectory(dir), function(f) { return filter.match(f); }));
	}
	//}}}


	//{{{ readDirectory
	public function readDirectory(?dir:String=".") : Array<String> {
		if(!neko.FileSystem.exists(dir) || !neko.FileSystem.isDirectory(dir)) return null;
		neko.Sys.sleep(.5);
		return neko.FileSystem.readDirectory(dir);
	}
	//}}}


	//{{{ getFileArrayStats
	public function getFileArrayStats(filearray:Array<String>) : Array<FileStat> {
		var stats = new Array<FileStat>();
		for(file in filearray)
			stats.push(getFileStats(file));
		neko.Sys.sleep(.25);
		return stats;
	}
	//}}}


	//{{{ getFileStats
	public inline function getFileStats(f:String) : FileStat {
		var stat = neko.FileSystem.stat(f);
		neko.Sys.sleep(.025);
		return stat;
	}
	//}}}


	//{{{ getFullPath
	public inline function getFullPath(?dir:String=".") : String {
		return neko.FileSystem.fullPath(dir);
	}
	//}}}


	//{{{ getDirectoryTree
	public function getDirectoryTree(?dir:String=".") : Dynamic {
		if(!neko.FileSystem.exists(dir)) return;
		var o = {};
		var contents : Array<Dynamic> = readDirectory(getFullPath(dir));
		if(contents==null || contents.length==0) return;
		for(i in contents) {
			var f : String = getFullPath(dir+"/"+i);
			if(neko.FileSystem.isDirectory(f)) {
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
		return neko.io.File.getContent(fname);
	}
	//}}}

	//{{{ save
	public function save(fname:String, data:String) {

		var fout = neko.io.File.write(fname, false);


		fout.writeString(data);
		fout.close();
	}
	//}}}


	//{{{ run
	public function run(inFile:String, outFile:String) {
		// neko.Lib.println("Launching SwfMill...");

		testCommand("swfmill");


		// args = neko.Sys.args();

		try {
			var fData = neko.io.File.getContent("library.xml");
			var xmlData = Xml.parse(fData).firstElement();

			var proc = new neko.io.Process("swfmill", ['-v', 'simple', inFile, outFile]);

			neko.Lib.println(proc.stdout.readAll());
			neko.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			neko.Lib.println("Launcher Error: " + ex);
			neko.Lib.println("stack: " + haxe.Stack.exceptionStack());
			neko.Sys.exit(1);
		}
	}
	//}}}


	//{{{ run
	public function dump(inFile:String) {
		// neko.Lib.println("Launching swfdump...");

		testCommand("swfdump");

		// args = neko.Sys.args();

		try {
			var proc = new neko.io.Process("swfdump", [inFile]);

			neko.Lib.println(proc.stdout.readAll());
			neko.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			neko.Lib.println("Launcher Error: " + ex);
			neko.Lib.println("stack: " + haxe.Stack.exceptionStack());
			neko.Sys.exit(1);
		}
	}
	//}}}


	//{{{ make
	public function make() {
		testCommand("make");

		try {
			var proc = new neko.io.Process("make", []);

			neko.Lib.println(proc.stdout.readAll());
			neko.Lib.println(proc.stderr.readAll());

		}
		catch (ex:String) {
			neko.Lib.println("Launcher Error: " + ex);
			neko.Lib.println("stack: " + haxe.Stack.exceptionStack());
			neko.Sys.exit(1);
		}
	}
	//}}}

	//{{{ xsltproc
	public function xsltproc(arg:Array<String>) : String {
		// neko.Lib.println("Launching xsltproc...");

		testCommand("xsltproc");

		// args = neko.Sys.args();
		//neko.Lib.println(arg);

		try {
			var proc = new neko.io.Process("xsltproc", arg);

			var out = proc.stdout.readAll().toString();
			out += proc.stderr.readAll().toString();

			//neko.Lib.println(out);
			//neko.Lib.println(StringTools.urlDecode(out));
			//return StringTools.urlDecode(StringTools.htmlEscape(out.toString()));
			return StringTools.urlDecode(out);
			//return out;
		}
		catch (ex:String) {
			neko.Lib.println("Launcher Error: " + ex);
			neko.Lib.println("stack: " + haxe.Stack.exceptionStack());
			neko.Sys.exit(1);
		}
		return null;
	}
	//}}}


	//{{{ cpuTime
	public function getCwd() : String {
		return neko.Sys.getCwd();
	}
	//}}}


	//{{{ testCommand
	/**
	* Test if a command is installed in the system
	*/
	public function testCommand(c:String, ?args:Array<String>) {
		if(args==null) args = [];
		try	{
			var ret = new neko.io.Process(c, args);
			ret.exitCode();
		}
		catch (ex:String) {
			neko.Lib.println("Launcher Error: "+c+" is not installed");
			neko.Sys.exit(2);
		}
	}
	//}}}
}

