// Copyright (c) 2009 The haxegui developers
//
// Permission is hereby granted, free of charge, to any person obtaining a copy of
// this software and associated documentation files (the "Software"), to deal in
// the Software without restriction, including without limitation the rights to
// use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
// the Software, and to permit persons to whom the Software is furnished to do so,
// subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in all
// copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
// COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
// IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
// CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

import haxe.remoting.HttpAsyncConnection;

class Actions {
	public static var cnx : HttpAsyncConnection;

//		var URL = "http://localhost:2000/server.n";
//		cnx = haxe.remoting.HttpAsyncConnection.urlConnect(URL);
//		cnx.setErrorHandler( function(err) trace("Error : "+Std.string(err)) );

	public static inline function log(err:Dynamic) {
		trace("Error : "+Std.string(err));
	}

	// public static inline function getCwd(cb:Dynamic->Void) : String {
	// 	cnx.Server.getCwd.call ([], cb);
	// }

	public static inline function load(file:String, cb:Dynamic->Void) {
		cnx.Server.load.call([file], cb);
	}

	public static inline function dump(output:String) {
		cnx.Server.dump.call([output], log);
	}

	public static inline function getFileStats(f:String, cb:Dynamic->Void) {
		cnx.Server.getFileStats.call([f], cb);
	}

	public static inline function getFileArrayStats(fa:Array<String>, cb:Dynamic->Void) {
		cnx.Server.getFileArrayStats.call([fa], cb);
	}

	public static inline function getFullPath(dir:String, cb:Dynamic->Void) {
		cnx.Server.getFullPath.call([dir], cb);
	}

	public static inline function readDirectoryFiltered(dir:String, filter:String, cb:Dynamic->Void) {
		cnx.Server.readDirectoryFiltered.call([dir, filter], cb);
	}

	public static inline function readDirectory(dir:String, cb:Dynamic->Void) {
		cnx.Server.readDirectory.call([dir], cb);
	}

	public static inline function getDirectoryTree(dir:String, cb:Dynamic->Void) {
		cnx.Server.getDirectoryTree.call([dir], cb);
	}

}

