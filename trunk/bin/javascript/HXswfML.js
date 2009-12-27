$estr = function() { return js.Boot.__string_rec(this,''); }
format = {}
format.swf = {}
format.swf.TagId = function() { }
format.swf.TagId.__name__ = ["format","swf","TagId"];
format.swf.TagId.prototype.__class__ = format.swf.TagId;
format.swf.FillStyleTypeId = function() { }
format.swf.FillStyleTypeId.__name__ = ["format","swf","FillStyleTypeId"];
format.swf.FillStyleTypeId.prototype.__class__ = format.swf.FillStyleTypeId;
haxe = {}
haxe.io = {}
haxe.io.BytesBuffer = function(p) { if( p === $_ ) return; {
	this.b = new Array();
}}
haxe.io.BytesBuffer.__name__ = ["haxe","io","BytesBuffer"];
haxe.io.BytesBuffer.prototype.add = function(src) {
	var b1 = this.b;
	var b2 = src.b;
	{
		var _g1 = 0, _g = src.length;
		while(_g1 < _g) {
			var i = _g1++;
			this.b.push(b2[i]);
		}
	}
}
haxe.io.BytesBuffer.prototype.addByte = function($byte) {
	this.b.push($byte);
}
haxe.io.BytesBuffer.prototype.addBytes = function(src,pos,len) {
	if(pos < 0 || len < 0 || pos + len > src.length) throw haxe.io.Error.OutsideBounds;
	var b1 = this.b;
	var b2 = src.b;
	{
		var _g1 = pos, _g = pos + len;
		while(_g1 < _g) {
			var i = _g1++;
			this.b.push(b2[i]);
		}
	}
}
haxe.io.BytesBuffer.prototype.b = null;
haxe.io.BytesBuffer.prototype.getBytes = function() {
	var bytes = new haxe.io.Bytes(this.b.length,this.b);
	this.b = null;
	return bytes;
}
haxe.io.BytesBuffer.prototype.__class__ = haxe.io.BytesBuffer;
format.abc = {}
format.abc.Reader = function(i) { if( i === $_ ) return; {
	this.i = i;
	this.opr = new format.abc.OpReader(i);
}}
format.abc.Reader.__name__ = ["format","abc","Reader"];
format.abc.Reader.prototype.i = null;
format.abc.Reader.prototype.opr = null;
format.abc.Reader.prototype.read = function() {
	if(this.i.readUInt30() != 3014672) throw "invalid header";
	var data = new format.abc.ABCData();
	data.ints = this.readList($closure(this.opr,"readInt32"));
	data.uints = this.readList($closure(this.opr,"readInt32"));
	data.floats = this.readList($closure(this.i,"readDouble"));
	data.strings = this.readList($closure(this,"readString"));
	data.namespaces = this.readList($closure(this,"readNamespace"));
	data.nssets = this.readList($closure(this,"readNsSet"));
	data.names = this.readList(function(f,a1) {
		return function() {
			return f(a1);
		}
	}($closure(this,"readName"),-1));
	data.methodTypes = this.readList2($closure(this,"readMethodType"));
	data.metadatas = this.readList2($closure(this,"readMetadata"));
	data.classes = this.readList2($closure(this,"readClass"));
	{
		var _g = 0, _g1 = data.classes;
		while(_g < _g1.length) {
			var c = _g1[_g];
			++_g;
			c.statics = format.abc.Index.Idx(this.opr.readInt());
			c.staticFields = this.readList2($closure(this,"readField"));
		}
	}
	data.inits = this.readList2($closure(this,"readInit"));
	data.functions = this.readList2($closure(this,"readFunction"));
	return data;
}
format.abc.Reader.prototype.readClass = function() {
	var name = format.abc.Index.Idx(this.opr.readInt());
	var csuper = this.readIndexOpt();
	var flags = this.i.readByte();
	var ns = null;
	if((flags & 8) != 0) ns = format.abc.Index.Idx(this.opr.readInt());
	var interfs = this.readList2($closure(this,"readIndex"));
	var construct = format.abc.Index.Idx(this.opr.readInt());
	var fields = this.readList2($closure(this,"readField"));
	return { name : name, superclass : csuper, interfaces : interfs, constructor : construct, fields : fields, namespace : ns, isSealed : (flags & 1) != 0, isFinal : (flags & 2) != 0, isInterface : (flags & 4) != 0, statics : null, staticFields : null}
}
format.abc.Reader.prototype.readField = function() {
	var name = format.abc.Index.Idx(this.opr.readInt());
	var kind = this.i.readByte();
	var slot = this.opr.readInt();
	var f;
	switch(kind & 15) {
	case 0:case 6:{
		var t = this.readIndexOpt();
		var v = this.readValue(false);
		f = format.abc.FieldKind.FVar(t,v,kind == 6);
	}break;
	case 1:case 2:case 3:{
		var mt = format.abc.Index.Idx(this.opr.readInt());
		var $final = (kind & 16) != 0;
		var over = (kind & 32) != 0;
		var kind1 = (function($this) {
			var $r;
			switch(kind & 15) {
			case 1:{
				$r = format.abc.MethodKind.KNormal;
			}break;
			case 2:{
				$r = format.abc.MethodKind.KGetter;
			}break;
			case 3:{
				$r = format.abc.MethodKind.KSetter;
			}break;
			default:{
				$r = (function($this) {
					var $r;
					throw "assert";
					return $r;
				}($this));
			}break;
			}
			return $r;
		}(this));
		f = format.abc.FieldKind.FMethod(mt,kind1,$final,over);
	}break;
	case 4:{
		f = format.abc.FieldKind.FClass(format.abc.Index.Idx(this.opr.readInt()));
	}break;
	case 5:{
		f = format.abc.FieldKind.FFunction(format.abc.Index.Idx(this.opr.readInt()));
	}break;
	default:{
		throw "assert";
	}break;
	}
	var metas = null;
	if((kind & 64) != 0) metas = this.readList2($closure(this,"readIndex"));
	return { name : name, slot : slot, kind : f, metadatas : metas}
}
format.abc.Reader.prototype.readFunction = function() {
	var t = format.abc.Index.Idx(this.opr.readInt());
	var ss = this.opr.readInt();
	var nregs = this.opr.readInt();
	var init_scope = this.opr.readInt();
	var max_scope = this.opr.readInt();
	var code = this.i.read(this.opr.readInt());
	var trys = this.readList2($closure(this,"readTryCatch"));
	var locals = this.readList2($closure(this,"readField"));
	return { type : t, maxStack : ss, nRegs : nregs, initScope : init_scope, maxScope : max_scope, code : code, trys : trys, locals : locals}
}
format.abc.Reader.prototype.readIndex = function() {
	return format.abc.Index.Idx(this.opr.readInt());
}
format.abc.Reader.prototype.readIndexOpt = function() {
	var i = this.opr.readInt();
	return ((i == 0)?null:format.abc.Index.Idx(i));
}
format.abc.Reader.prototype.readInit = function() {
	return { method : format.abc.Index.Idx(this.opr.readInt()), fields : this.readList2($closure(this,"readField"))}
}
format.abc.Reader.prototype.readInt = function() {
	return this.opr.readInt();
}
format.abc.Reader.prototype.readList = function(f) {
	var a = new Array();
	var n = this.opr.readInt();
	if(n == 0) return a;
	{
		var _g1 = 0, _g = n - 1;
		while(_g1 < _g) {
			var i = _g1++;
			a.push(f());
		}
	}
	return a;
}
format.abc.Reader.prototype.readList2 = function(f) {
	var a = new Array();
	var n = this.opr.readInt();
	{
		var _g = 0;
		while(_g < n) {
			var i = _g++;
			a.push(f());
		}
	}
	return a;
}
format.abc.Reader.prototype.readMetadata = function() {
	var name = format.abc.Index.Idx(this.opr.readInt());
	var data = this.readList2($closure(this,"readIndexOpt"));
	var a = new Array();
	{
		var _g = 0;
		while(_g < data.length) {
			var i = data[_g];
			++_g;
			a.push({ n : i, v : format.abc.Index.Idx(this.opr.readInt())});
		}
	}
	return { name : name, data : a}
}
format.abc.Reader.prototype.readMethodType = function() {
	var nargs = this.i.readByte();
	var tret = this.readIndexOpt();
	var targs = new Array();
	{
		var _g = 0;
		while(_g < nargs) {
			var i = _g++;
			targs.push(this.readIndexOpt());
		}
	}
	var dname = this.readIndexOpt();
	var flags = this.i.readByte();
	if(flags == 0 && dname == null) return { args : targs, ret : tret, extra : null}
	var dparams = null, pnames = null;
	if((flags & 8) != 0) dparams = this.readList2(function(f,a1) {
		return function() {
			return f(a1);
		}
	}($closure(this,"readValue"),true));
	if((flags & 128) != 0) {
		pnames = new Array();
		{
			var _g = 0;
			while(_g < nargs) {
				var i = _g++;
				pnames.push(this.readIndexOpt());
			}
		}
	}
	return { args : targs, ret : tret, extra : { native : (flags & 32) != 0, variableArgs : (flags & 4) != 0, argumentsDefined : (flags & 1) != 0, usesDXNS : (flags & 64) != 0, newBlock : (flags & 2) != 0, unused : (flags & 16) != 0, debugName : dname, defaultParameters : dparams, paramNames : pnames}}
}
format.abc.Reader.prototype.readName = function(k) {
	if(k == null) k = -1;
	if(k == -1) k = this.i.readByte();
	return (function($this) {
		var $r;
		switch(k) {
		case 7:{
			$r = (function($this) {
				var $r;
				var ns = format.abc.Index.Idx($this.opr.readInt());
				var id = format.abc.Index.Idx($this.opr.readInt());
				$r = format.abc.Name.NName(id,ns);
				return $r;
			}($this));
		}break;
		case 9:{
			$r = (function($this) {
				var $r;
				var id = format.abc.Index.Idx($this.opr.readInt());
				var ns = format.abc.Index.Idx($this.opr.readInt());
				$r = format.abc.Name.NMulti(id,ns);
				return $r;
			}($this));
		}break;
		case 13:{
			$r = format.abc.Name.NAttrib($this.readName(7));
		}break;
		case 14:{
			$r = format.abc.Name.NAttrib($this.readName(9));
		}break;
		case 15:{
			$r = format.abc.Name.NRuntime(format.abc.Index.Idx($this.opr.readInt()));
		}break;
		case 16:{
			$r = format.abc.Name.NRuntimeLate;
		}break;
		case 18:{
			$r = format.abc.Name.NAttrib($this.readName(17));
		}break;
		case 27:{
			$r = format.abc.Name.NMultiLate(format.abc.Index.Idx($this.opr.readInt()));
		}break;
		case 28:{
			$r = format.abc.Name.NAttrib($this.readName(27));
		}break;
		case 29:{
			$r = (function($this) {
				var $r;
				var id = format.abc.Index.Idx($this.opr.readInt());
				var params = $this.readList2($closure($this,"readIndex"));
				$r = format.abc.Name.NParams(id,params);
				return $r;
			}($this));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw "assert";
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.abc.Reader.prototype.readNamespace = function() {
	var k = this.i.readByte();
	var p = format.abc.Index.Idx(this.opr.readInt());
	return (function($this) {
		var $r;
		switch(k) {
		case 5:{
			$r = format.abc.Namespace.NPrivate(p);
		}break;
		case 8:{
			$r = format.abc.Namespace.NNamespace(p);
		}break;
		case 22:{
			$r = format.abc.Namespace.NPublic(p);
		}break;
		case 23:{
			$r = format.abc.Namespace.NInternal(p);
		}break;
		case 24:{
			$r = format.abc.Namespace.NProtected(p);
		}break;
		case 25:{
			$r = format.abc.Namespace.NExplicit(p);
		}break;
		case 26:{
			$r = format.abc.Namespace.NStaticProtected(p);
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw "assert";
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.abc.Reader.prototype.readNsSet = function() {
	var a = new Array();
	{
		var _g1 = 0, _g = this.i.readByte();
		while(_g1 < _g) {
			var n = _g1++;
			a.push(format.abc.Index.Idx(this.opr.readInt()));
		}
	}
	return a;
}
format.abc.Reader.prototype.readString = function() {
	return this.i.readString(this.opr.readInt());
}
format.abc.Reader.prototype.readTryCatch = function() {
	return { start : this.opr.readInt(), end : this.opr.readInt(), handle : this.opr.readInt(), type : this.readIndexOpt(), variable : this.readIndexOpt()}
}
format.abc.Reader.prototype.readValue = function(extra) {
	var idx = this.opr.readInt();
	if(idx == 0) {
		if(extra && this.i.readByte() != 0) throw "assert";
		return null;
	}
	var n = this.i.readByte();
	return (function($this) {
		var $r;
		switch(n) {
		case 1:{
			$r = format.abc.Value.VString(format.abc.Index.Idx(idx));
		}break;
		case 3:{
			$r = format.abc.Value.VInt(format.abc.Index.Idx(idx));
		}break;
		case 4:{
			$r = format.abc.Value.VUInt(format.abc.Index.Idx(idx));
		}break;
		case 6:{
			$r = format.abc.Value.VFloat(format.abc.Index.Idx(idx));
		}break;
		case 5:case 8:case 22:case 23:case 24:case 25:case 26:{
			$r = format.abc.Value.VNamespace(n,format.abc.Index.Idx(idx));
		}break;
		case 10:{
			$r = (function($this) {
				var $r;
				if(idx != 10) throw "assert";
				$r = format.abc.Value.VBool(false);
				return $r;
			}($this));
		}break;
		case 11:{
			$r = (function($this) {
				var $r;
				if(idx != 11) throw "assert";
				$r = format.abc.Value.VBool(true);
				return $r;
			}($this));
		}break;
		case 12:{
			$r = (function($this) {
				var $r;
				if(idx != 12) throw "assert";
				$r = format.abc.Value.VNull;
				return $r;
			}($this));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw "assert";
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.abc.Reader.prototype.__class__ = format.abc.Reader;
format.tools = {}
format.tools._InflateImpl = {}
format.tools._InflateImpl.Window = function(p) { if( p === $_ ) return; {
	this.buffer = haxe.io.Bytes.alloc(65536);
	this.pos = 0;
	this.crc = new format.tools.Adler32();
}}
format.tools._InflateImpl.Window.__name__ = ["format","tools","_InflateImpl","Window"];
format.tools._InflateImpl.Window.prototype.addByte = function(c) {
	if(this.pos == 65536) this.slide();
	this.buffer.b[this.pos] = (c & 255);
	this.pos++;
}
format.tools._InflateImpl.Window.prototype.addBytes = function(b,p,len) {
	if(this.pos + len > 65536) this.slide();
	this.buffer.blit(this.pos,b,p,len);
	this.pos += len;
}
format.tools._InflateImpl.Window.prototype.available = function() {
	return this.pos;
}
format.tools._InflateImpl.Window.prototype.buffer = null;
format.tools._InflateImpl.Window.prototype.checksum = function() {
	this.crc.update(this.buffer,0,this.pos);
	return this.crc;
}
format.tools._InflateImpl.Window.prototype.crc = null;
format.tools._InflateImpl.Window.prototype.getLastChar = function() {
	return this.buffer.b[this.pos - 1];
}
format.tools._InflateImpl.Window.prototype.pos = null;
format.tools._InflateImpl.Window.prototype.slide = function() {
	this.crc.update(this.buffer,0,32768);
	var b = haxe.io.Bytes.alloc(65536);
	this.pos -= 32768;
	b.blit(0,this.buffer,32768,this.pos);
	this.buffer = b;
}
format.tools._InflateImpl.Window.prototype.__class__ = format.tools._InflateImpl.Window;
format.tools._InflateImpl.State = { __ename__ : ["format","tools","_InflateImpl","State"], __constructs__ : ["Head","Block","CData","Flat","Crc","Dist","DistOne","Done"] }
format.tools._InflateImpl.State.Block = ["Block",1];
format.tools._InflateImpl.State.Block.toString = $estr;
format.tools._InflateImpl.State.Block.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.CData = ["CData",2];
format.tools._InflateImpl.State.CData.toString = $estr;
format.tools._InflateImpl.State.CData.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.Crc = ["Crc",4];
format.tools._InflateImpl.State.Crc.toString = $estr;
format.tools._InflateImpl.State.Crc.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.Dist = ["Dist",5];
format.tools._InflateImpl.State.Dist.toString = $estr;
format.tools._InflateImpl.State.Dist.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.DistOne = ["DistOne",6];
format.tools._InflateImpl.State.DistOne.toString = $estr;
format.tools._InflateImpl.State.DistOne.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.Done = ["Done",7];
format.tools._InflateImpl.State.Done.toString = $estr;
format.tools._InflateImpl.State.Done.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.Flat = ["Flat",3];
format.tools._InflateImpl.State.Flat.toString = $estr;
format.tools._InflateImpl.State.Flat.__enum__ = format.tools._InflateImpl.State;
format.tools._InflateImpl.State.Head = ["Head",0];
format.tools._InflateImpl.State.Head.toString = $estr;
format.tools._InflateImpl.State.Head.__enum__ = format.tools._InflateImpl.State;
format.tools.InflateImpl = function(i,header) { if( i === $_ ) return; {
	if(header == null) header = true;
	this["final"] = false;
	this.htools = new format.tools.HuffTools();
	this.huffman = this.buildFixedHuffman();
	this.huffdist = null;
	this.len = 0;
	this.dist = 0;
	this.state = (header?format.tools._InflateImpl.State.Head:format.tools._InflateImpl.State.Block);
	this.input = i;
	this.bits = 0;
	this.nbits = 0;
	this.needed = 0;
	this.output = null;
	this.outpos = 0;
	this.lengths = new Array();
	{
		var _g = 0;
		while(_g < 19) {
			var i1 = _g++;
			this.lengths.push(-1);
		}
	}
	this.window = new format.tools._InflateImpl.Window();
}}
format.tools.InflateImpl.__name__ = ["format","tools","InflateImpl"];
format.tools.InflateImpl.run = function(i,bufsize) {
	if(bufsize == null) bufsize = 65536;
	var buf = haxe.io.Bytes.alloc(bufsize);
	var output = new haxe.io.BytesBuffer();
	var inflate = new format.tools.InflateImpl(i);
	while(true) {
		var len = inflate.readBytes(buf,0,bufsize);
		output.addBytes(buf,0,len);
		if(len < bufsize) break;
	}
	return output.getBytes();
}
format.tools.InflateImpl.prototype.addByte = function(b) {
	this.window.addByte(b);
	this.output.b[this.outpos] = (b & 255);
	this.needed--;
	this.outpos++;
}
format.tools.InflateImpl.prototype.addBytes = function(b,p,len) {
	this.window.addBytes(b,p,len);
	this.output.blit(this.outpos,b,p,len);
	this.needed -= len;
	this.outpos += len;
}
format.tools.InflateImpl.prototype.addDist = function(d,len) {
	this.addBytes(this.window.buffer,this.window.pos - d,len);
}
format.tools.InflateImpl.prototype.addDistOne = function(n) {
	var c = this.window.getLastChar();
	{
		var _g = 0;
		while(_g < n) {
			var i = _g++;
			this.addByte(c);
		}
	}
}
format.tools.InflateImpl.prototype.applyHuffman = function(h) {
	return (function($this) {
		var $r;
		var $e = (h);
		switch( $e[1] ) {
		case 0:
		var n = $e[2];
		{
			$r = n;
		}break;
		case 1:
		var b = $e[3], a = $e[2];
		{
			$r = $this.applyHuffman(($this.getBit()?b:a));
		}break;
		case 2:
		var tbl = $e[3], n = $e[2];
		{
			$r = $this.applyHuffman(tbl[$this.getBits(n)]);
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.tools.InflateImpl.prototype.bits = null;
format.tools.InflateImpl.prototype.buildFixedHuffman = function() {
	if(format.tools.InflateImpl.FIXED_HUFFMAN != null) return format.tools.InflateImpl.FIXED_HUFFMAN;
	var a = new Array();
	{
		var _g = 0;
		while(_g < 288) {
			var n = _g++;
			a.push((n <= 143?8:(n <= 255?9:(n <= 279?7:8))));
		}
	}
	format.tools.InflateImpl.FIXED_HUFFMAN = this.htools.make(a,0,288,10);
	return format.tools.InflateImpl.FIXED_HUFFMAN;
}
format.tools.InflateImpl.prototype.dist = null;
format.tools.InflateImpl.prototype["final"] = null;
format.tools.InflateImpl.prototype.getBit = function() {
	if(this.nbits == 0) {
		this.nbits = 8;
		this.bits = this.input.readByte();
	}
	var b = (this.bits & 1) == 1;
	this.nbits--;
	this.bits >>= 1;
	return b;
}
format.tools.InflateImpl.prototype.getBits = function(n) {
	while(this.nbits < n) {
		this.bits |= this.input.readByte() << this.nbits;
		this.nbits += 8;
	}
	var b = this.bits & ((1 << n) - 1);
	this.nbits -= n;
	this.bits >>= n;
	return b;
}
format.tools.InflateImpl.prototype.getRevBits = function(n) {
	return (n == 0?0:(this.getBit()?(1 << (n - 1)) | this.getRevBits(n - 1):this.getRevBits(n - 1)));
}
format.tools.InflateImpl.prototype.htools = null;
format.tools.InflateImpl.prototype.huffdist = null;
format.tools.InflateImpl.prototype.huffman = null;
format.tools.InflateImpl.prototype.inflateLengths = function(a,max) {
	var i = 0;
	var prev = 0;
	while(i < max) {
		var n = this.applyHuffman(this.huffman);
		switch(n) {
		case 0:case 1:case 2:case 3:case 4:case 5:case 6:case 7:case 8:case 9:case 10:case 11:case 12:case 13:case 14:case 15:{
			prev = n;
			a[i] = n;
			i++;
		}break;
		case 16:{
			var end = i + 3 + this.getBits(2);
			if(end > max) throw "Invalid data";
			while(i < end) {
				a[i] = prev;
				i++;
			}
		}break;
		case 17:{
			i += 3 + this.getBits(3);
			if(i > max) throw "Invalid data";
		}break;
		case 18:{
			i += 11 + this.getBits(7);
			if(i > max) throw "Invalid data";
		}break;
		default:{
			throw "Invalid data";
		}break;
		}
	}
}
format.tools.InflateImpl.prototype.inflateLoop = function() {
	var $e = (this.state);
	switch( $e[1] ) {
	case 0:
	{
		var cmf = this.input.readByte();
		var cm = cmf & 15;
		var cinfo = cmf >> 4;
		if(cm != 8 || cinfo != 7) throw "Invalid data";
		var flg = this.input.readByte();
		var fdict = (flg & 32) != 0;
		if(((cmf << 8) + flg) % 31 != 0) throw "Invalid data";
		if(fdict) throw "Unsupported dictionary";
		this.state = format.tools._InflateImpl.State.Block;
		return true;
	}break;
	case 4:
	{
		var calc = this.window.checksum();
		var crc = format.tools.Adler32.read(this.input);
		if(!calc.equals(crc)) throw "Invalid CRC";
		this.state = format.tools._InflateImpl.State.Done;
		return true;
	}break;
	case 7:
	{
		return false;
	}break;
	case 1:
	{
		this["final"] = this.getBit();
		switch(this.getBits(2)) {
		case 0:{
			this.len = this.input.readUInt16();
			var nlen = this.input.readUInt16();
			if(nlen != 65535 - this.len) throw "Invalid data";
			this.state = format.tools._InflateImpl.State.Flat;
			var r = this.inflateLoop();
			this.resetBits();
			return r;
		}break;
		case 1:{
			this.huffman = this.buildFixedHuffman();
			this.huffdist = null;
			this.state = format.tools._InflateImpl.State.CData;
			return true;
		}break;
		case 2:{
			var hlit = this.getBits(5) + 257;
			var hdist = this.getBits(5) + 1;
			var hclen = this.getBits(4) + 4;
			{
				var _g = 0;
				while(_g < hclen) {
					var i = _g++;
					this.lengths[format.tools.InflateImpl.CODE_LENGTHS_POS[i]] = this.getBits(3);
				}
			}
			{
				var _g = hclen;
				while(_g < 19) {
					var i = _g++;
					this.lengths[format.tools.InflateImpl.CODE_LENGTHS_POS[i]] = 0;
				}
			}
			this.huffman = this.htools.make(this.lengths,0,19,8);
			var lengths = new Array();
			{
				var _g1 = 0, _g = hlit + hdist;
				while(_g1 < _g) {
					var i = _g1++;
					lengths.push(0);
				}
			}
			this.inflateLengths(lengths,hlit + hdist);
			this.huffdist = this.htools.make(lengths,hlit,hdist,16);
			this.huffman = this.htools.make(lengths,0,hlit,16);
			this.state = format.tools._InflateImpl.State.CData;
			return true;
		}break;
		default:{
			throw "Invalid data";
		}break;
		}
	}break;
	case 3:
	{
		var rlen = ((this.len < this.needed)?this.len:this.needed);
		var bytes = this.input.read(rlen);
		this.len -= rlen;
		this.addBytes(bytes,0,rlen);
		if(this.len == 0) this.state = (this["final"]?format.tools._InflateImpl.State.Crc:format.tools._InflateImpl.State.Block);
		return this.needed > 0;
	}break;
	case 6:
	{
		var rlen = ((this.len < this.needed)?this.len:this.needed);
		this.addDistOne(rlen);
		this.len -= rlen;
		if(this.len == 0) this.state = format.tools._InflateImpl.State.CData;
		return this.needed > 0;
	}break;
	case 5:
	{
		while(this.len > 0 && this.needed > 0) {
			var rdist = ((this.len < this.dist)?this.len:this.dist);
			var rlen = ((this.needed < rdist)?this.needed:rdist);
			this.addDist(this.dist,rlen);
			this.len -= rlen;
		}
		if(this.len == 0) this.state = format.tools._InflateImpl.State.CData;
		return this.needed > 0;
	}break;
	case 2:
	{
		var n = this.applyHuffman(this.huffman);
		if(n < 256) {
			this.addByte(n);
			return this.needed > 0;
		}
		else if(n == 256) {
			this.state = (this["final"]?format.tools._InflateImpl.State.Crc:format.tools._InflateImpl.State.Block);
			return true;
		}
		else {
			n -= 257;
			var extra_bits = format.tools.InflateImpl.LEN_EXTRA_BITS_TBL[n];
			if(extra_bits == -1) throw "Invalid data";
			this.len = format.tools.InflateImpl.LEN_BASE_VAL_TBL[n] + this.getBits(extra_bits);
			var dist_code = (this.huffdist == null?this.getRevBits(5):this.applyHuffman(this.huffdist));
			extra_bits = format.tools.InflateImpl.DIST_EXTRA_BITS_TBL[dist_code];
			if(extra_bits == -1) throw "Invalid data";
			this.dist = format.tools.InflateImpl.DIST_BASE_VAL_TBL[dist_code] + this.getBits(extra_bits);
			if(this.dist > this.window.available()) throw "Invalid data";
			this.state = ((this.dist == 1)?format.tools._InflateImpl.State.DistOne:format.tools._InflateImpl.State.Dist);
			return true;
		}
	}break;
	}
}
format.tools.InflateImpl.prototype.input = null;
format.tools.InflateImpl.prototype.len = null;
format.tools.InflateImpl.prototype.lengths = null;
format.tools.InflateImpl.prototype.nbits = null;
format.tools.InflateImpl.prototype.needed = null;
format.tools.InflateImpl.prototype.outpos = null;
format.tools.InflateImpl.prototype.output = null;
format.tools.InflateImpl.prototype.readBytes = function(b,pos,len) {
	this.needed = len;
	this.outpos = pos;
	this.output = b;
	if(len > 0) while(this.inflateLoop()) null;
	return len - this.needed;
}
format.tools.InflateImpl.prototype.resetBits = function() {
	this.bits = 0;
	this.nbits = 0;
}
format.tools.InflateImpl.prototype.state = null;
format.tools.InflateImpl.prototype.window = null;
format.tools.InflateImpl.prototype.__class__ = format.tools.InflateImpl;
format.tools.BitsInput = function(i) { if( i === $_ ) return; {
	this.i = i;
	this.nbits = 0;
	this.bits = 0;
}}
format.tools.BitsInput.__name__ = ["format","tools","BitsInput"];
format.tools.BitsInput.prototype.bits = null;
format.tools.BitsInput.prototype.i = null;
format.tools.BitsInput.prototype.nbits = null;
format.tools.BitsInput.prototype.read = function() {
	if(this.nbits == 0) {
		this.bits = this.i.readByte();
		this.nbits = 8;
	}
	this.nbits--;
	return ((this.bits >>> this.nbits) & 1) == 1;
}
format.tools.BitsInput.prototype.readBits = function(n) {
	if(this.nbits >= n) {
		var c = this.nbits - n;
		var k = (this.bits >>> c) & ((1 << n) - 1);
		this.nbits = c;
		return k;
	}
	var k = this.i.readByte();
	if(this.nbits >= 24) {
		if(n >= 31) throw "Bits error";
		var c = 8 + this.nbits - n;
		var d = this.bits & ((1 << this.nbits) - 1);
		d = ((d << (8 - c)) | (k << c));
		this.bits = k;
		this.nbits = c;
		return d;
	}
	this.bits = ((this.bits << 8) | k);
	this.nbits += 8;
	return this.readBits(n);
}
format.tools.BitsInput.prototype.reset = function() {
	this.nbits = 0;
}
format.tools.BitsInput.prototype.__class__ = format.tools.BitsInput;
format.mp3 = {}
format.mp3.FrameType = { __ename__ : ["format","mp3","FrameType"], __constructs__ : ["FT_MP3","FT_NONE"] }
format.mp3.FrameType.FT_MP3 = ["FT_MP3",0];
format.mp3.FrameType.FT_MP3.toString = $estr;
format.mp3.FrameType.FT_MP3.__enum__ = format.mp3.FrameType;
format.mp3.FrameType.FT_NONE = ["FT_NONE",1];
format.mp3.FrameType.FT_NONE.toString = $estr;
format.mp3.FrameType.FT_NONE.__enum__ = format.mp3.FrameType;
format.mp3.Reader = function(i) { if( i === $_ ) return; {
	this.i = i;
	i.setEndian(true);
	this.bits = new format.tools.BitsInput(i);
	this.samples = 0;
	this.sampleSize = 0;
	this.any_read = false;
}}
format.mp3.Reader.__name__ = ["format","mp3","Reader"];
format.mp3.Reader.prototype.any_read = null;
format.mp3.Reader.prototype.bits = null;
format.mp3.Reader.prototype.i = null;
format.mp3.Reader.prototype.id3v2_data = null;
format.mp3.Reader.prototype.id3v2_flags = null;
format.mp3.Reader.prototype.id3v2_version = null;
format.mp3.Reader.prototype.read = function() {
	var fs = this.readFrames();
	return { frames : fs, sampleCount : this.samples, sampleSize : this.sampleSize, id3v2 : ((this.id3v2_data == null)?null:{ versionBytes : this.id3v2_version, flagByte : this.id3v2_flags, data : this.id3v2_data})}
}
format.mp3.Reader.prototype.readFrame = function() {
	var header = this.readFrameHeader();
	if(header == null || format.mp3.Tools.isInvalidFrameHeader(header)) return null;
	try {
		var data = this.i.read(format.mp3.Tools.getSampleDataSizeHdr(header));
		this.samples += format.mp3.Tools.getSampleCountHdr(header);
		this.sampleSize += data.length;
		return { header : header, data : data}
	}
	catch( $e0 ) {
		if( js.Boot.__instanceof($e0,haxe.io.Eof) ) {
			var e = $e0;
			{
				return null;
			}
		} else throw($e0);
	}
}
format.mp3.Reader.prototype.readFrameHeader = function() {
	var version = this.bits.readBits(2);
	var layer = this.bits.readBits(2);
	var hasCrc = !this.bits.read();
	if(version == format.mp3.MPEG.Reserved || layer == format.mp3.CLayer.LReserved) return null;
	var bitrateIdx = this.bits.readBits(4);
	var bitrate = format.mp3.Tools.getBitrate(version,layer,bitrateIdx);
	var samplingRateIdx = this.bits.readBits(2);
	var samplingRate = format.mp3.Tools.getSamplingRate(version,samplingRateIdx);
	var isPadded = this.bits.read();
	var privateBit = this.bits.read();
	if(bitrate == format.mp3.Bitrate.BR_Bad || bitrate == format.mp3.Bitrate.BR_Free || samplingRate == format.mp3.SamplingRate.SR_Bad) return null;
	var channelMode = this.bits.readBits(2);
	var isIntensityStereo = this.bits.read();
	var isMSStereo = this.bits.read();
	var isCopyrighted = this.bits.read();
	var isOriginal = this.bits.read();
	var emphasis = this.bits.readBits(2);
	var crc16 = 0;
	if(hasCrc) {
		crc16 = this.i.readUInt16();
	}
	return { version : format.mp3.MPEG.num2Enum(version), layer : format.mp3.CLayer.num2Enum(layer), hasCrc : hasCrc, crc16 : crc16, bitrate : bitrate, samplingRate : samplingRate, isPadded : isPadded, privateBit : privateBit, channelMode : format.mp3.CChannelMode.num2Enum(channelMode), isIntensityStereo : isIntensityStereo, isMSStereo : isMSStereo, isCopyrighted : isCopyrighted, isOriginal : isOriginal, emphasis : format.mp3.CEmphasis.num2Enum(emphasis)}
}
format.mp3.Reader.prototype.readFrames = function() {
	var frames = new Array();
	var ft;
	while((ft = this.seekFrame()) != format.mp3.FrameType.FT_NONE) {
		var $e = (ft);
		switch( $e[1] ) {
		case 0:
		{
			var f = this.readFrame();
			if(f != null) frames.push(f);
		}break;
		case 1:
		{
			null;
		}break;
		}
	}
	return frames;
}
format.mp3.Reader.prototype.sampleSize = null;
format.mp3.Reader.prototype.samples = null;
format.mp3.Reader.prototype.seekFrame = function() {
	var found = false;
	try {
		var b;
		while(true) {
			b = this.i.readByte();
			if(!this.any_read) {
				this.any_read = true;
				if(b == 73) {
					b = this.i.readByte();
					if(b == 68) {
						b = this.i.readByte();
						if(b == 51) {
							this.skipID3v2();
						}
					}
				}
			}
			if(b == 255) {
				this.bits.nbits = 0;
				b = this.bits.readBits(3);
				if(b == 7) {
					return format.mp3.FrameType.FT_MP3;
				}
			}
		}
		return format.mp3.FrameType.FT_NONE;
	}
	catch( $e1 ) {
		if( js.Boot.__instanceof($e1,haxe.io.Eof) ) {
			var ex = $e1;
			{
				return format.mp3.FrameType.FT_NONE;
			}
		} else throw($e1);
	}
}
format.mp3.Reader.prototype.skipID3v2 = function() {
	this.id3v2_version = this.i.readUInt16();
	this.id3v2_flags = this.i.readByte();
	var size = this.i.readByte() & 127;
	size = ((size << 7) | (this.i.readByte() & 127));
	size = ((size << 7) | (this.i.readByte() & 127));
	size = ((size << 7) | (this.i.readByte() & 127));
	this.id3v2_data = this.i.read(size);
}
format.mp3.Reader.prototype.version = null;
format.mp3.Reader.prototype.__class__ = format.mp3.Reader;
format.swf.SWFTag = { __ename__ : ["format","swf","SWFTag"], __constructs__ : ["TShowFrame","TEnd","TShape","TMorphShape","TFont","TFontInfo","TBackgroundColor","TClip","TPlaceObject2","TPlaceObject3","TRemoveObject2","TFrameLabel","TDoInitActions","TActionScript3","TSymbolClass","TExportAssets","TSandBox","TBitsLossless","TBitsLossless2","TBitsJPEG","TJPEGTables","TBinaryData","TSound","TStartSound","TDoAction","TScriptLimits","TDefineButton2","TDefineEditText","TMetadata","TDefineScalingGrid","TUnknown"] }
format.swf.SWFTag.TActionScript3 = function(data,context) { var $x = ["TActionScript3",13,data,context]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TBackgroundColor = function(color) { var $x = ["TBackgroundColor",6,color]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TBinaryData = function(id,data) { var $x = ["TBinaryData",21,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TBitsJPEG = function(id,data) { var $x = ["TBitsJPEG",19,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TBitsLossless = function(data) { var $x = ["TBitsLossless",17,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TBitsLossless2 = function(data) { var $x = ["TBitsLossless2",18,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TClip = function(id,frames,tags) { var $x = ["TClip",7,id,frames,tags]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TDefineButton2 = function(id,records) { var $x = ["TDefineButton2",26,id,records]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TDefineEditText = function(id,data) { var $x = ["TDefineEditText",27,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TDefineScalingGrid = function(id,splitter) { var $x = ["TDefineScalingGrid",29,id,splitter]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TDoAction = function(data) { var $x = ["TDoAction",24,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TDoInitActions = function(id,data) { var $x = ["TDoInitActions",12,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TEnd = ["TEnd",1];
format.swf.SWFTag.TEnd.toString = $estr;
format.swf.SWFTag.TEnd.__enum__ = format.swf.SWFTag;
format.swf.SWFTag.TExportAssets = function(symbols) { var $x = ["TExportAssets",15,symbols]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TFont = function(id,data) { var $x = ["TFont",4,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TFontInfo = function(id,data) { var $x = ["TFontInfo",5,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TFrameLabel = function(label,anchor) { var $x = ["TFrameLabel",11,label,anchor]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TJPEGTables = function(data) { var $x = ["TJPEGTables",20,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TMetadata = function(data) { var $x = ["TMetadata",28,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TMorphShape = function(id,data) { var $x = ["TMorphShape",3,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TPlaceObject2 = function(po) { var $x = ["TPlaceObject2",8,po]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TPlaceObject3 = function(po) { var $x = ["TPlaceObject3",9,po]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TRemoveObject2 = function(depth) { var $x = ["TRemoveObject2",10,depth]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TSandBox = function(v) { var $x = ["TSandBox",16,v]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TScriptLimits = function(maxRecursion,timeoutSeconds) { var $x = ["TScriptLimits",25,maxRecursion,timeoutSeconds]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TShape = function(id,data) { var $x = ["TShape",2,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TShowFrame = ["TShowFrame",0];
format.swf.SWFTag.TShowFrame.toString = $estr;
format.swf.SWFTag.TShowFrame.__enum__ = format.swf.SWFTag;
format.swf.SWFTag.TSound = function(data) { var $x = ["TSound",22,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TStartSound = function(id,soundInfo) { var $x = ["TStartSound",23,id,soundInfo]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TSymbolClass = function(symbols) { var $x = ["TSymbolClass",14,symbols]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.SWFTag.TUnknown = function(id,data) { var $x = ["TUnknown",30,id,data]; $x.__enum__ = format.swf.SWFTag; $x.toString = $estr; return $x; }
format.swf.PlaceObject = function(p) { if( p === $_ ) return; {
	null;
}}
format.swf.PlaceObject.__name__ = ["format","swf","PlaceObject"];
format.swf.PlaceObject.prototype.bitmapCache = null;
format.swf.PlaceObject.prototype.blendMode = null;
format.swf.PlaceObject.prototype.cid = null;
format.swf.PlaceObject.prototype.clipDepth = null;
format.swf.PlaceObject.prototype.color = null;
format.swf.PlaceObject.prototype.depth = null;
format.swf.PlaceObject.prototype.events = null;
format.swf.PlaceObject.prototype.filters = null;
format.swf.PlaceObject.prototype.instanceName = null;
format.swf.PlaceObject.prototype.matrix = null;
format.swf.PlaceObject.prototype.move = null;
format.swf.PlaceObject.prototype.ratio = null;
format.swf.PlaceObject.prototype.__class__ = format.swf.PlaceObject;
format.swf.ShapeData = { __ename__ : ["format","swf","ShapeData"], __constructs__ : ["SHDShape1","SHDShape2","SHDShape3","SHDShape4"] }
format.swf.ShapeData.SHDShape1 = function(bounds,shapes) { var $x = ["SHDShape1",0,bounds,shapes]; $x.__enum__ = format.swf.ShapeData; $x.toString = $estr; return $x; }
format.swf.ShapeData.SHDShape2 = function(bounds,shapes) { var $x = ["SHDShape2",1,bounds,shapes]; $x.__enum__ = format.swf.ShapeData; $x.toString = $estr; return $x; }
format.swf.ShapeData.SHDShape3 = function(bounds,shapes) { var $x = ["SHDShape3",2,bounds,shapes]; $x.__enum__ = format.swf.ShapeData; $x.toString = $estr; return $x; }
format.swf.ShapeData.SHDShape4 = function(data) { var $x = ["SHDShape4",3,data]; $x.__enum__ = format.swf.ShapeData; $x.toString = $estr; return $x; }
format.swf.MorphShapeData = { __ename__ : ["format","swf","MorphShapeData"], __constructs__ : ["MSDShape1","MSDShape2"] }
format.swf.MorphShapeData.MSDShape1 = function(data) { var $x = ["MSDShape1",0,data]; $x.__enum__ = format.swf.MorphShapeData; $x.toString = $estr; return $x; }
format.swf.MorphShapeData.MSDShape2 = function(data) { var $x = ["MSDShape2",1,data]; $x.__enum__ = format.swf.MorphShapeData; $x.toString = $estr; return $x; }
format.swf.MorphFillStyle = { __ename__ : ["format","swf","MorphFillStyle"], __constructs__ : ["MFSSolid","MFSLinearGradient","MFSRadialGradient","MFSBitmap"] }
format.swf.MorphFillStyle.MFSBitmap = function(cid,startMatrix,endMatrix,repeat,smooth) { var $x = ["MFSBitmap",3,cid,startMatrix,endMatrix,repeat,smooth]; $x.__enum__ = format.swf.MorphFillStyle; $x.toString = $estr; return $x; }
format.swf.MorphFillStyle.MFSLinearGradient = function(startMatrix,endMatrix,gradients) { var $x = ["MFSLinearGradient",1,startMatrix,endMatrix,gradients]; $x.__enum__ = format.swf.MorphFillStyle; $x.toString = $estr; return $x; }
format.swf.MorphFillStyle.MFSRadialGradient = function(startMatrix,endMatrix,gradients) { var $x = ["MFSRadialGradient",2,startMatrix,endMatrix,gradients]; $x.__enum__ = format.swf.MorphFillStyle; $x.toString = $estr; return $x; }
format.swf.MorphFillStyle.MFSSolid = function(startColor,endColor) { var $x = ["MFSSolid",0,startColor,endColor]; $x.__enum__ = format.swf.MorphFillStyle; $x.toString = $estr; return $x; }
format.swf.Morph2LineStyle = { __ename__ : ["format","swf","Morph2LineStyle"], __constructs__ : ["M2LSNoFill","M2LSFill"] }
format.swf.Morph2LineStyle.M2LSFill = function(fill,data) { var $x = ["M2LSFill",1,fill,data]; $x.__enum__ = format.swf.Morph2LineStyle; $x.toString = $estr; return $x; }
format.swf.Morph2LineStyle.M2LSNoFill = function(startColor,endColor,data) { var $x = ["M2LSNoFill",0,startColor,endColor,data]; $x.__enum__ = format.swf.Morph2LineStyle; $x.toString = $estr; return $x; }
format.swf.ShapeRecord = { __ename__ : ["format","swf","ShapeRecord"], __constructs__ : ["SHREnd","SHRChange","SHREdge","SHRCurvedEdge"] }
format.swf.ShapeRecord.SHRChange = function(data) { var $x = ["SHRChange",1,data]; $x.__enum__ = format.swf.ShapeRecord; $x.toString = $estr; return $x; }
format.swf.ShapeRecord.SHRCurvedEdge = function(cdx,cdy,adx,ady) { var $x = ["SHRCurvedEdge",3,cdx,cdy,adx,ady]; $x.__enum__ = format.swf.ShapeRecord; $x.toString = $estr; return $x; }
format.swf.ShapeRecord.SHREdge = function(dx,dy) { var $x = ["SHREdge",2,dx,dy]; $x.__enum__ = format.swf.ShapeRecord; $x.toString = $estr; return $x; }
format.swf.ShapeRecord.SHREnd = ["SHREnd",0];
format.swf.ShapeRecord.SHREnd.toString = $estr;
format.swf.ShapeRecord.SHREnd.__enum__ = format.swf.ShapeRecord;
format.swf.FillStyle = { __ename__ : ["format","swf","FillStyle"], __constructs__ : ["FSSolid","FSSolidAlpha","FSLinearGradient","FSRadialGradient","FSFocalGradient","FSBitmap"] }
format.swf.FillStyle.FSBitmap = function(cid,mat,repeat,smooth) { var $x = ["FSBitmap",5,cid,mat,repeat,smooth]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.FillStyle.FSFocalGradient = function(mat,grad) { var $x = ["FSFocalGradient",4,mat,grad]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.FillStyle.FSLinearGradient = function(mat,grad) { var $x = ["FSLinearGradient",2,mat,grad]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.FillStyle.FSRadialGradient = function(mat,grad) { var $x = ["FSRadialGradient",3,mat,grad]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.FillStyle.FSSolid = function(rgb) { var $x = ["FSSolid",0,rgb]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.FillStyle.FSSolidAlpha = function(rgb) { var $x = ["FSSolidAlpha",1,rgb]; $x.__enum__ = format.swf.FillStyle; $x.toString = $estr; return $x; }
format.swf.LineStyleData = { __ename__ : ["format","swf","LineStyleData"], __constructs__ : ["LSRGB","LSRGBA","LS2"] }
format.swf.LineStyleData.LS2 = function(data) { var $x = ["LS2",2,data]; $x.__enum__ = format.swf.LineStyleData; $x.toString = $estr; return $x; }
format.swf.LineStyleData.LSRGB = function(rgb) { var $x = ["LSRGB",0,rgb]; $x.__enum__ = format.swf.LineStyleData; $x.toString = $estr; return $x; }
format.swf.LineStyleData.LSRGBA = function(rgba) { var $x = ["LSRGBA",1,rgba]; $x.__enum__ = format.swf.LineStyleData; $x.toString = $estr; return $x; }
format.swf.LineCapStyle = { __ename__ : ["format","swf","LineCapStyle"], __constructs__ : ["LCRound","LCNone","LCSquare"] }
format.swf.LineCapStyle.LCNone = ["LCNone",1];
format.swf.LineCapStyle.LCNone.toString = $estr;
format.swf.LineCapStyle.LCNone.__enum__ = format.swf.LineCapStyle;
format.swf.LineCapStyle.LCRound = ["LCRound",0];
format.swf.LineCapStyle.LCRound.toString = $estr;
format.swf.LineCapStyle.LCRound.__enum__ = format.swf.LineCapStyle;
format.swf.LineCapStyle.LCSquare = ["LCSquare",2];
format.swf.LineCapStyle.LCSquare.toString = $estr;
format.swf.LineCapStyle.LCSquare.__enum__ = format.swf.LineCapStyle;
format.swf.LineJoinStyle = { __ename__ : ["format","swf","LineJoinStyle"], __constructs__ : ["LJRound","LJBevel","LJMiter"] }
format.swf.LineJoinStyle.LJBevel = ["LJBevel",1];
format.swf.LineJoinStyle.LJBevel.toString = $estr;
format.swf.LineJoinStyle.LJBevel.__enum__ = format.swf.LineJoinStyle;
format.swf.LineJoinStyle.LJMiter = function(limitFactor) { var $x = ["LJMiter",2,limitFactor]; $x.__enum__ = format.swf.LineJoinStyle; $x.toString = $estr; return $x; }
format.swf.LineJoinStyle.LJRound = ["LJRound",0];
format.swf.LineJoinStyle.LJRound.toString = $estr;
format.swf.LineJoinStyle.LJRound.__enum__ = format.swf.LineJoinStyle;
format.swf.LS2Fill = { __ename__ : ["format","swf","LS2Fill"], __constructs__ : ["LS2FColor","LS2FStyle"] }
format.swf.LS2Fill.LS2FColor = function(color) { var $x = ["LS2FColor",0,color]; $x.__enum__ = format.swf.LS2Fill; $x.toString = $estr; return $x; }
format.swf.LS2Fill.LS2FStyle = function(style) { var $x = ["LS2FStyle",1,style]; $x.__enum__ = format.swf.LS2Fill; $x.toString = $estr; return $x; }
format.swf.GradRecord = { __ename__ : ["format","swf","GradRecord"], __constructs__ : ["GRRGB","GRRGBA"] }
format.swf.GradRecord.GRRGB = function(pos,col) { var $x = ["GRRGB",0,pos,col]; $x.__enum__ = format.swf.GradRecord; $x.toString = $estr; return $x; }
format.swf.GradRecord.GRRGBA = function(pos,col) { var $x = ["GRRGBA",1,pos,col]; $x.__enum__ = format.swf.GradRecord; $x.toString = $estr; return $x; }
format.swf.SpreadMode = { __ename__ : ["format","swf","SpreadMode"], __constructs__ : ["SMPad","SMReflect","SMRepeat","SMReserved"] }
format.swf.SpreadMode.SMPad = ["SMPad",0];
format.swf.SpreadMode.SMPad.toString = $estr;
format.swf.SpreadMode.SMPad.__enum__ = format.swf.SpreadMode;
format.swf.SpreadMode.SMReflect = ["SMReflect",1];
format.swf.SpreadMode.SMReflect.toString = $estr;
format.swf.SpreadMode.SMReflect.__enum__ = format.swf.SpreadMode;
format.swf.SpreadMode.SMRepeat = ["SMRepeat",2];
format.swf.SpreadMode.SMRepeat.toString = $estr;
format.swf.SpreadMode.SMRepeat.__enum__ = format.swf.SpreadMode;
format.swf.SpreadMode.SMReserved = ["SMReserved",3];
format.swf.SpreadMode.SMReserved.toString = $estr;
format.swf.SpreadMode.SMReserved.__enum__ = format.swf.SpreadMode;
format.swf.InterpolationMode = { __ename__ : ["format","swf","InterpolationMode"], __constructs__ : ["IMNormalRGB","IMLinearRGB","IMReserved1","IMReserved2"] }
format.swf.InterpolationMode.IMLinearRGB = ["IMLinearRGB",1];
format.swf.InterpolationMode.IMLinearRGB.toString = $estr;
format.swf.InterpolationMode.IMLinearRGB.__enum__ = format.swf.InterpolationMode;
format.swf.InterpolationMode.IMNormalRGB = ["IMNormalRGB",0];
format.swf.InterpolationMode.IMNormalRGB.toString = $estr;
format.swf.InterpolationMode.IMNormalRGB.__enum__ = format.swf.InterpolationMode;
format.swf.InterpolationMode.IMReserved1 = ["IMReserved1",2];
format.swf.InterpolationMode.IMReserved1.toString = $estr;
format.swf.InterpolationMode.IMReserved1.__enum__ = format.swf.InterpolationMode;
format.swf.InterpolationMode.IMReserved2 = ["IMReserved2",3];
format.swf.InterpolationMode.IMReserved2.toString = $estr;
format.swf.InterpolationMode.IMReserved2.__enum__ = format.swf.InterpolationMode;
format.swf.BlendMode = { __ename__ : ["format","swf","BlendMode"], __constructs__ : ["BNormal","BLayer","BMultiply","BScreen","BLighten","BDarken","BAdd","BSubtract","BDifference","BInvert","BAlpha","BErase","BOverlay","BHardLight"] }
format.swf.BlendMode.BAdd = ["BAdd",6];
format.swf.BlendMode.BAdd.toString = $estr;
format.swf.BlendMode.BAdd.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BAlpha = ["BAlpha",10];
format.swf.BlendMode.BAlpha.toString = $estr;
format.swf.BlendMode.BAlpha.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BDarken = ["BDarken",5];
format.swf.BlendMode.BDarken.toString = $estr;
format.swf.BlendMode.BDarken.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BDifference = ["BDifference",8];
format.swf.BlendMode.BDifference.toString = $estr;
format.swf.BlendMode.BDifference.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BErase = ["BErase",11];
format.swf.BlendMode.BErase.toString = $estr;
format.swf.BlendMode.BErase.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BHardLight = ["BHardLight",13];
format.swf.BlendMode.BHardLight.toString = $estr;
format.swf.BlendMode.BHardLight.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BInvert = ["BInvert",9];
format.swf.BlendMode.BInvert.toString = $estr;
format.swf.BlendMode.BInvert.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BLayer = ["BLayer",1];
format.swf.BlendMode.BLayer.toString = $estr;
format.swf.BlendMode.BLayer.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BLighten = ["BLighten",4];
format.swf.BlendMode.BLighten.toString = $estr;
format.swf.BlendMode.BLighten.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BMultiply = ["BMultiply",2];
format.swf.BlendMode.BMultiply.toString = $estr;
format.swf.BlendMode.BMultiply.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BNormal = ["BNormal",0];
format.swf.BlendMode.BNormal.toString = $estr;
format.swf.BlendMode.BNormal.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BOverlay = ["BOverlay",12];
format.swf.BlendMode.BOverlay.toString = $estr;
format.swf.BlendMode.BOverlay.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BScreen = ["BScreen",3];
format.swf.BlendMode.BScreen.toString = $estr;
format.swf.BlendMode.BScreen.__enum__ = format.swf.BlendMode;
format.swf.BlendMode.BSubtract = ["BSubtract",7];
format.swf.BlendMode.BSubtract.toString = $estr;
format.swf.BlendMode.BSubtract.__enum__ = format.swf.BlendMode;
format.swf.Filter = { __ename__ : ["format","swf","Filter"], __constructs__ : ["FDropShadow","FBlur","FGlow","FBevel","FGradientGlow","FColorMatrix","FGradientBevel"] }
format.swf.Filter.FBevel = function(data) { var $x = ["FBevel",3,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FBlur = function(data) { var $x = ["FBlur",1,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FColorMatrix = function(data) { var $x = ["FColorMatrix",5,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FDropShadow = function(data) { var $x = ["FDropShadow",0,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FGlow = function(data) { var $x = ["FGlow",2,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FGradientBevel = function(data) { var $x = ["FGradientBevel",6,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.Filter.FGradientGlow = function(data) { var $x = ["FGradientGlow",4,data]; $x.__enum__ = format.swf.Filter; $x.toString = $estr; return $x; }
format.swf.JPEGData = { __ename__ : ["format","swf","JPEGData"], __constructs__ : ["JDJPEG1","JDJPEG2","JDJPEG3"] }
format.swf.JPEGData.JDJPEG1 = function(data) { var $x = ["JDJPEG1",0,data]; $x.__enum__ = format.swf.JPEGData; $x.toString = $estr; return $x; }
format.swf.JPEGData.JDJPEG2 = function(data) { var $x = ["JDJPEG2",1,data]; $x.__enum__ = format.swf.JPEGData; $x.toString = $estr; return $x; }
format.swf.JPEGData.JDJPEG3 = function(data,mask) { var $x = ["JDJPEG3",2,data,mask]; $x.__enum__ = format.swf.JPEGData; $x.toString = $estr; return $x; }
format.swf.ColorModel = { __ename__ : ["format","swf","ColorModel"], __constructs__ : ["CM8Bits","CM15Bits","CM24Bits","CM32Bits"] }
format.swf.ColorModel.CM15Bits = ["CM15Bits",1];
format.swf.ColorModel.CM15Bits.toString = $estr;
format.swf.ColorModel.CM15Bits.__enum__ = format.swf.ColorModel;
format.swf.ColorModel.CM24Bits = ["CM24Bits",2];
format.swf.ColorModel.CM24Bits.toString = $estr;
format.swf.ColorModel.CM24Bits.__enum__ = format.swf.ColorModel;
format.swf.ColorModel.CM32Bits = ["CM32Bits",3];
format.swf.ColorModel.CM32Bits.toString = $estr;
format.swf.ColorModel.CM32Bits.__enum__ = format.swf.ColorModel;
format.swf.ColorModel.CM8Bits = function(ncolors) { var $x = ["CM8Bits",0,ncolors]; $x.__enum__ = format.swf.ColorModel; $x.toString = $estr; return $x; }
format.swf.VideoData = { __ename__ : ["format","swf","VideoData"], __constructs__ : ["H263videoPacket","SCREENvideoPacket","VP6SWFvideoPacket","VP6SWFALPHAvideoPacket","SCREENV2videoPacket"] }
format.swf.VideoData.H263videoPacket = ["H263videoPacket",0];
format.swf.VideoData.H263videoPacket.toString = $estr;
format.swf.VideoData.H263videoPacket.__enum__ = format.swf.VideoData;
format.swf.VideoData.SCREENV2videoPacket = ["SCREENV2videoPacket",4];
format.swf.VideoData.SCREENV2videoPacket.toString = $estr;
format.swf.VideoData.SCREENV2videoPacket.__enum__ = format.swf.VideoData;
format.swf.VideoData.SCREENvideoPacket = ["SCREENvideoPacket",1];
format.swf.VideoData.SCREENvideoPacket.toString = $estr;
format.swf.VideoData.SCREENvideoPacket.__enum__ = format.swf.VideoData;
format.swf.VideoData.VP6SWFALPHAvideoPacket = ["VP6SWFALPHAvideoPacket",3];
format.swf.VideoData.VP6SWFALPHAvideoPacket.toString = $estr;
format.swf.VideoData.VP6SWFALPHAvideoPacket.__enum__ = format.swf.VideoData;
format.swf.VideoData.VP6SWFvideoPacket = ["VP6SWFvideoPacket",2];
format.swf.VideoData.VP6SWFvideoPacket.toString = $estr;
format.swf.VideoData.VP6SWFvideoPacket.__enum__ = format.swf.VideoData;
format.swf.SoundData = { __ename__ : ["format","swf","SoundData"], __constructs__ : ["SDMp3","SDRaw","SDOther"] }
format.swf.SoundData.SDMp3 = function(seek,data) { var $x = ["SDMp3",0,seek,data]; $x.__enum__ = format.swf.SoundData; $x.toString = $estr; return $x; }
format.swf.SoundData.SDOther = function(data) { var $x = ["SDOther",2,data]; $x.__enum__ = format.swf.SoundData; $x.toString = $estr; return $x; }
format.swf.SoundData.SDRaw = function(data) { var $x = ["SDRaw",1,data]; $x.__enum__ = format.swf.SoundData; $x.toString = $estr; return $x; }
format.swf.SoundFormat = { __ename__ : ["format","swf","SoundFormat"], __constructs__ : ["SFNativeEndianUncompressed","SFADPCM","SFMP3","SFLittleEndianUncompressed","SFNellymoser16k","SFNellymoser8k","SFNellymoser","SFSpeex"] }
format.swf.SoundFormat.SFADPCM = ["SFADPCM",1];
format.swf.SoundFormat.SFADPCM.toString = $estr;
format.swf.SoundFormat.SFADPCM.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFLittleEndianUncompressed = ["SFLittleEndianUncompressed",3];
format.swf.SoundFormat.SFLittleEndianUncompressed.toString = $estr;
format.swf.SoundFormat.SFLittleEndianUncompressed.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFMP3 = ["SFMP3",2];
format.swf.SoundFormat.SFMP3.toString = $estr;
format.swf.SoundFormat.SFMP3.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFNativeEndianUncompressed = ["SFNativeEndianUncompressed",0];
format.swf.SoundFormat.SFNativeEndianUncompressed.toString = $estr;
format.swf.SoundFormat.SFNativeEndianUncompressed.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFNellymoser = ["SFNellymoser",6];
format.swf.SoundFormat.SFNellymoser.toString = $estr;
format.swf.SoundFormat.SFNellymoser.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFNellymoser16k = ["SFNellymoser16k",4];
format.swf.SoundFormat.SFNellymoser16k.toString = $estr;
format.swf.SoundFormat.SFNellymoser16k.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFNellymoser8k = ["SFNellymoser8k",5];
format.swf.SoundFormat.SFNellymoser8k.toString = $estr;
format.swf.SoundFormat.SFNellymoser8k.__enum__ = format.swf.SoundFormat;
format.swf.SoundFormat.SFSpeex = ["SFSpeex",7];
format.swf.SoundFormat.SFSpeex.toString = $estr;
format.swf.SoundFormat.SFSpeex.__enum__ = format.swf.SoundFormat;
format.swf.SoundRate = { __ename__ : ["format","swf","SoundRate"], __constructs__ : ["SR5k","SR11k","SR22k","SR44k"] }
format.swf.SoundRate.SR11k = ["SR11k",1];
format.swf.SoundRate.SR11k.toString = $estr;
format.swf.SoundRate.SR11k.__enum__ = format.swf.SoundRate;
format.swf.SoundRate.SR22k = ["SR22k",2];
format.swf.SoundRate.SR22k.toString = $estr;
format.swf.SoundRate.SR22k.__enum__ = format.swf.SoundRate;
format.swf.SoundRate.SR44k = ["SR44k",3];
format.swf.SoundRate.SR44k.toString = $estr;
format.swf.SoundRate.SR44k.__enum__ = format.swf.SoundRate;
format.swf.SoundRate.SR5k = ["SR5k",0];
format.swf.SoundRate.SR5k.toString = $estr;
format.swf.SoundRate.SR5k.__enum__ = format.swf.SoundRate;
format.swf.FontData = { __ename__ : ["format","swf","FontData"], __constructs__ : ["FDFont1","FDFont2","FDFont3"] }
format.swf.FontData.FDFont1 = function(data) { var $x = ["FDFont1",0,data]; $x.__enum__ = format.swf.FontData; $x.toString = $estr; return $x; }
format.swf.FontData.FDFont2 = function(hasWideChars,data) { var $x = ["FDFont2",1,hasWideChars,data]; $x.__enum__ = format.swf.FontData; $x.toString = $estr; return $x; }
format.swf.FontData.FDFont3 = function(data) { var $x = ["FDFont3",2,data]; $x.__enum__ = format.swf.FontData; $x.toString = $estr; return $x; }
format.swf.FontInfoData = { __ename__ : ["format","swf","FontInfoData"], __constructs__ : ["FIDFont1","FIDFont2"] }
format.swf.FontInfoData.FIDFont1 = function(shiftJIS,isANSI,hasWideCodes,data) { var $x = ["FIDFont1",0,shiftJIS,isANSI,hasWideCodes,data]; $x.__enum__ = format.swf.FontInfoData; $x.toString = $estr; return $x; }
format.swf.FontInfoData.FIDFont2 = function(language,data) { var $x = ["FIDFont2",1,language,data]; $x.__enum__ = format.swf.FontInfoData; $x.toString = $estr; return $x; }
format.swf.LangCode = { __ename__ : ["format","swf","LangCode"], __constructs__ : ["LCNone","LCLatin","LCJapanese","LCKorean","LCSimplifiedChinese","LCTraditionalChinese"] }
format.swf.LangCode.LCJapanese = ["LCJapanese",2];
format.swf.LangCode.LCJapanese.toString = $estr;
format.swf.LangCode.LCJapanese.__enum__ = format.swf.LangCode;
format.swf.LangCode.LCKorean = ["LCKorean",3];
format.swf.LangCode.LCKorean.toString = $estr;
format.swf.LangCode.LCKorean.__enum__ = format.swf.LangCode;
format.swf.LangCode.LCLatin = ["LCLatin",1];
format.swf.LangCode.LCLatin.toString = $estr;
format.swf.LangCode.LCLatin.__enum__ = format.swf.LangCode;
format.swf.LangCode.LCNone = ["LCNone",0];
format.swf.LangCode.LCNone.toString = $estr;
format.swf.LangCode.LCNone.__enum__ = format.swf.LangCode;
format.swf.LangCode.LCSimplifiedChinese = ["LCSimplifiedChinese",4];
format.swf.LangCode.LCSimplifiedChinese.toString = $estr;
format.swf.LangCode.LCSimplifiedChinese.__enum__ = format.swf.LangCode;
format.swf.LangCode.LCTraditionalChinese = ["LCTraditionalChinese",5];
format.swf.LangCode.LCTraditionalChinese.toString = $estr;
format.swf.LangCode.LCTraditionalChinese.__enum__ = format.swf.LangCode;
format.swf.MPEGVersion = { __ename__ : ["format","swf","MPEGVersion"], __constructs__ : ["MPEG_V1","MPEG_V2","MPEG_V25","MPEG_Reserved"] }
format.swf.MPEGVersion.MPEG_Reserved = ["MPEG_Reserved",3];
format.swf.MPEGVersion.MPEG_Reserved.toString = $estr;
format.swf.MPEGVersion.MPEG_Reserved.__enum__ = format.swf.MPEGVersion;
format.swf.MPEGVersion.MPEG_V1 = ["MPEG_V1",0];
format.swf.MPEGVersion.MPEG_V1.toString = $estr;
format.swf.MPEGVersion.MPEG_V1.__enum__ = format.swf.MPEGVersion;
format.swf.MPEGVersion.MPEG_V2 = ["MPEG_V2",1];
format.swf.MPEGVersion.MPEG_V2.toString = $estr;
format.swf.MPEGVersion.MPEG_V2.__enum__ = format.swf.MPEGVersion;
format.swf.MPEGVersion.MPEG_V25 = ["MPEG_V25",2];
format.swf.MPEGVersion.MPEG_V25.toString = $estr;
format.swf.MPEGVersion.MPEG_V25.__enum__ = format.swf.MPEGVersion;
format.swf.Bitrate = { __ename__ : ["format","swf","Bitrate"], __constructs__ : ["BR_8","BR_16","BR_24","BR_32","BR_40","BR_48","BR_56","BR_64","BR_80","BR_96","BR_112","BR_128","BR_144","BR_160","BR_176","BR_192","BR_224","BR_256","BR_288","BR_320","BR_352","BR_384","BR_416","BR_448","BR_Free","BR_Bad"] }
format.swf.Bitrate.BR_112 = ["BR_112",10];
format.swf.Bitrate.BR_112.toString = $estr;
format.swf.Bitrate.BR_112.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_128 = ["BR_128",11];
format.swf.Bitrate.BR_128.toString = $estr;
format.swf.Bitrate.BR_128.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_144 = ["BR_144",12];
format.swf.Bitrate.BR_144.toString = $estr;
format.swf.Bitrate.BR_144.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_16 = ["BR_16",1];
format.swf.Bitrate.BR_16.toString = $estr;
format.swf.Bitrate.BR_16.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_160 = ["BR_160",13];
format.swf.Bitrate.BR_160.toString = $estr;
format.swf.Bitrate.BR_160.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_176 = ["BR_176",14];
format.swf.Bitrate.BR_176.toString = $estr;
format.swf.Bitrate.BR_176.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_192 = ["BR_192",15];
format.swf.Bitrate.BR_192.toString = $estr;
format.swf.Bitrate.BR_192.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_224 = ["BR_224",16];
format.swf.Bitrate.BR_224.toString = $estr;
format.swf.Bitrate.BR_224.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_24 = ["BR_24",2];
format.swf.Bitrate.BR_24.toString = $estr;
format.swf.Bitrate.BR_24.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_256 = ["BR_256",17];
format.swf.Bitrate.BR_256.toString = $estr;
format.swf.Bitrate.BR_256.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_288 = ["BR_288",18];
format.swf.Bitrate.BR_288.toString = $estr;
format.swf.Bitrate.BR_288.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_32 = ["BR_32",3];
format.swf.Bitrate.BR_32.toString = $estr;
format.swf.Bitrate.BR_32.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_320 = ["BR_320",19];
format.swf.Bitrate.BR_320.toString = $estr;
format.swf.Bitrate.BR_320.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_352 = ["BR_352",20];
format.swf.Bitrate.BR_352.toString = $estr;
format.swf.Bitrate.BR_352.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_384 = ["BR_384",21];
format.swf.Bitrate.BR_384.toString = $estr;
format.swf.Bitrate.BR_384.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_40 = ["BR_40",4];
format.swf.Bitrate.BR_40.toString = $estr;
format.swf.Bitrate.BR_40.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_416 = ["BR_416",22];
format.swf.Bitrate.BR_416.toString = $estr;
format.swf.Bitrate.BR_416.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_448 = ["BR_448",23];
format.swf.Bitrate.BR_448.toString = $estr;
format.swf.Bitrate.BR_448.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_48 = ["BR_48",5];
format.swf.Bitrate.BR_48.toString = $estr;
format.swf.Bitrate.BR_48.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_56 = ["BR_56",6];
format.swf.Bitrate.BR_56.toString = $estr;
format.swf.Bitrate.BR_56.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_64 = ["BR_64",7];
format.swf.Bitrate.BR_64.toString = $estr;
format.swf.Bitrate.BR_64.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_8 = ["BR_8",0];
format.swf.Bitrate.BR_8.toString = $estr;
format.swf.Bitrate.BR_8.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_80 = ["BR_80",8];
format.swf.Bitrate.BR_80.toString = $estr;
format.swf.Bitrate.BR_80.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_96 = ["BR_96",9];
format.swf.Bitrate.BR_96.toString = $estr;
format.swf.Bitrate.BR_96.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_Bad = ["BR_Bad",25];
format.swf.Bitrate.BR_Bad.toString = $estr;
format.swf.Bitrate.BR_Bad.__enum__ = format.swf.Bitrate;
format.swf.Bitrate.BR_Free = ["BR_Free",24];
format.swf.Bitrate.BR_Free.toString = $estr;
format.swf.Bitrate.BR_Free.__enum__ = format.swf.Bitrate;
format.swf.SamplingRate = { __ename__ : ["format","swf","SamplingRate"], __constructs__ : ["SR_8000","SR_11025","SR_12000","SR_22050","SR_24000","SR_32000","SR_44100","SR_48000","SR_Bad"] }
format.swf.SamplingRate.SR_11025 = ["SR_11025",1];
format.swf.SamplingRate.SR_11025.toString = $estr;
format.swf.SamplingRate.SR_11025.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_12000 = ["SR_12000",2];
format.swf.SamplingRate.SR_12000.toString = $estr;
format.swf.SamplingRate.SR_12000.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_22050 = ["SR_22050",3];
format.swf.SamplingRate.SR_22050.toString = $estr;
format.swf.SamplingRate.SR_22050.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_24000 = ["SR_24000",4];
format.swf.SamplingRate.SR_24000.toString = $estr;
format.swf.SamplingRate.SR_24000.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_32000 = ["SR_32000",5];
format.swf.SamplingRate.SR_32000.toString = $estr;
format.swf.SamplingRate.SR_32000.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_44100 = ["SR_44100",6];
format.swf.SamplingRate.SR_44100.toString = $estr;
format.swf.SamplingRate.SR_44100.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_48000 = ["SR_48000",7];
format.swf.SamplingRate.SR_48000.toString = $estr;
format.swf.SamplingRate.SR_48000.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_8000 = ["SR_8000",0];
format.swf.SamplingRate.SR_8000.toString = $estr;
format.swf.SamplingRate.SR_8000.__enum__ = format.swf.SamplingRate;
format.swf.SamplingRate.SR_Bad = ["SR_Bad",8];
format.swf.SamplingRate.SR_Bad.toString = $estr;
format.swf.SamplingRate.SR_Bad.__enum__ = format.swf.SamplingRate;
format.swf.Layer = { __ename__ : ["format","swf","Layer"], __constructs__ : ["LayerReserved","Layer3","Layer2","Layer1"] }
format.swf.Layer.Layer1 = ["Layer1",3];
format.swf.Layer.Layer1.toString = $estr;
format.swf.Layer.Layer1.__enum__ = format.swf.Layer;
format.swf.Layer.Layer2 = ["Layer2",2];
format.swf.Layer.Layer2.toString = $estr;
format.swf.Layer.Layer2.__enum__ = format.swf.Layer;
format.swf.Layer.Layer3 = ["Layer3",1];
format.swf.Layer.Layer3.toString = $estr;
format.swf.Layer.Layer3.__enum__ = format.swf.Layer;
format.swf.Layer.LayerReserved = ["LayerReserved",0];
format.swf.Layer.LayerReserved.toString = $estr;
format.swf.Layer.LayerReserved.__enum__ = format.swf.Layer;
format.swf.ChannelMode = { __ename__ : ["format","swf","ChannelMode"], __constructs__ : ["Stereo","JointStereo","DualChannel","Mono"] }
format.swf.ChannelMode.DualChannel = ["DualChannel",2];
format.swf.ChannelMode.DualChannel.toString = $estr;
format.swf.ChannelMode.DualChannel.__enum__ = format.swf.ChannelMode;
format.swf.ChannelMode.JointStereo = ["JointStereo",1];
format.swf.ChannelMode.JointStereo.toString = $estr;
format.swf.ChannelMode.JointStereo.__enum__ = format.swf.ChannelMode;
format.swf.ChannelMode.Mono = ["Mono",3];
format.swf.ChannelMode.Mono.toString = $estr;
format.swf.ChannelMode.Mono.__enum__ = format.swf.ChannelMode;
format.swf.ChannelMode.Stereo = ["Stereo",0];
format.swf.ChannelMode.Stereo.toString = $estr;
format.swf.ChannelMode.Stereo.__enum__ = format.swf.ChannelMode;
format.swf.Emphasis = { __ename__ : ["format","swf","Emphasis"], __constructs__ : ["NoEmphasis","Ms50_15","CCIT_J17","InvalidEmphasis"] }
format.swf.Emphasis.CCIT_J17 = ["CCIT_J17",2];
format.swf.Emphasis.CCIT_J17.toString = $estr;
format.swf.Emphasis.CCIT_J17.__enum__ = format.swf.Emphasis;
format.swf.Emphasis.InvalidEmphasis = ["InvalidEmphasis",3];
format.swf.Emphasis.InvalidEmphasis.toString = $estr;
format.swf.Emphasis.InvalidEmphasis.__enum__ = format.swf.Emphasis;
format.swf.Emphasis.Ms50_15 = ["Ms50_15",1];
format.swf.Emphasis.Ms50_15.toString = $estr;
format.swf.Emphasis.Ms50_15.__enum__ = format.swf.Emphasis;
format.swf.Emphasis.NoEmphasis = ["NoEmphasis",0];
format.swf.Emphasis.NoEmphasis.toString = $estr;
format.swf.Emphasis.NoEmphasis.__enum__ = format.swf.Emphasis;
List = function(p) { if( p === $_ ) return; {
	this.length = 0;
}}
List.__name__ = ["List"];
List.prototype.add = function(item) {
	var x = [item];
	if(this.h == null) this.h = x;
	else this.q[1] = x;
	this.q = x;
	this.length++;
}
List.prototype.clear = function() {
	this.h = null;
	this.q = null;
	this.length = 0;
}
List.prototype.filter = function(f) {
	var l2 = new List();
	var l = this.h;
	while(l != null) {
		var v = l[0];
		l = l[1];
		if(f(v)) l2.add(v);
	}
	return l2;
}
List.prototype.first = function() {
	return (this.h == null?null:this.h[0]);
}
List.prototype.h = null;
List.prototype.isEmpty = function() {
	return (this.h == null);
}
List.prototype.iterator = function() {
	return { h : this.h, hasNext : function() {
		return (this.h != null);
	}, next : function() {
		if(this.h == null) return null;
		var x = this.h[0];
		this.h = this.h[1];
		return x;
	}}
}
List.prototype.join = function(sep) {
	var s = new StringBuf();
	var first = true;
	var l = this.h;
	while(l != null) {
		if(first) first = false;
		else s.b[s.b.length] = sep;
		s.b[s.b.length] = l[0];
		l = l[1];
	}
	return s.b.join("");
}
List.prototype.last = function() {
	return (this.q == null?null:this.q[0]);
}
List.prototype.length = null;
List.prototype.map = function(f) {
	var b = new List();
	var l = this.h;
	while(l != null) {
		var v = l[0];
		l = l[1];
		b.add(f(v));
	}
	return b;
}
List.prototype.pop = function() {
	if(this.h == null) return null;
	var x = this.h[0];
	this.h = this.h[1];
	if(this.h == null) this.q = null;
	this.length--;
	return x;
}
List.prototype.push = function(item) {
	var x = [item,this.h];
	this.h = x;
	if(this.q == null) this.q = x;
	this.length++;
}
List.prototype.q = null;
List.prototype.remove = function(v) {
	var prev = null;
	var l = this.h;
	while(l != null) {
		if(l[0] == v) {
			if(prev == null) this.h = l[1];
			else prev[1] = l[1];
			if(this.q == l) this.q = prev;
			this.length--;
			return true;
		}
		prev = l;
		l = l[1];
	}
	return false;
}
List.prototype.toString = function() {
	var s = new StringBuf();
	var first = true;
	var l = this.h;
	s.b[s.b.length] = "{";
	while(l != null) {
		if(first) first = false;
		else s.b[s.b.length] = ", ";
		s.b[s.b.length] = Std.string(l[0]);
		l = l[1];
	}
	s.b[s.b.length] = "}";
	return s.b.join("");
}
List.prototype.__class__ = List;
format.abc.OpReader = function(i) { if( i === $_ ) return; {
	this.i = i;
}}
format.abc.OpReader.__name__ = ["format","abc","OpReader"];
format.abc.OpReader.jumps = null;
format.abc.OpReader.jumpNameIndex = null;
format.abc.OpReader.labels = null;
format.abc.OpReader.labelNameIndex = null;
format.abc.OpReader.ops = null;
format.abc.OpReader.decode = function(i) {
	format.abc.OpReader.bytePos = 0;
	format.abc.OpReader.jumps = new Array();
	format.abc.OpReader.jumpNameIndex = 0;
	format.abc.OpReader.labels = new Array();
	format.abc.OpReader.labelNameIndex = 0;
	var opr = new format.abc.OpReader(i);
	format.abc.OpReader.ops = [];
	while(true) {
		var op;
		try {
			if(format.abc.OpReader.jumps[format.abc.OpReader.bytePos] != null) {
				var _g = 0, _g1 = format.abc.OpReader.jumps[format.abc.OpReader.bytePos];
				while(_g < _g1.length) {
					var s = _g1[_g];
					++_g;
					format.abc.OpReader.ops.push(format.abc.OpCode.OJump3(s));
				}
			}
			op = i.readByte();
			++format.abc.OpReader.bytePos;
		}
		catch( $e2 ) {
			if( js.Boot.__instanceof($e2,haxe.io.Eof) ) {
				var e = $e2;
				break;
			} else throw($e2);
		}
		format.abc.OpReader.ops.push(opr.readOp(op));
	}
	return format.abc.OpReader.ops;
}
format.abc.OpReader.prototype.i = null;
format.abc.OpReader.prototype.jmp = function(j) {
	format.abc.OpReader.jumpNameIndex++;
	var offset = this.i.readInt24();
	++format.abc.OpReader.bytePos;
	++format.abc.OpReader.bytePos;
	++format.abc.OpReader.bytePos;
	if(offset < 0) {
		format.abc.OpReader.ops.push(format.abc.OpCode.OJump(j,offset));
		return format.abc.OpCode.OJump2(j,format.abc.OpReader.labels[format.abc.OpReader.bytePos + offset],offset);
	}
	else {
		if(format.abc.OpReader.jumps[format.abc.OpReader.bytePos + offset] == null) format.abc.OpReader.jumps[format.abc.OpReader.bytePos + offset] = [];
		format.abc.OpReader.jumps[format.abc.OpReader.bytePos + offset].push("j" + format.abc.OpReader.jumpNameIndex);
		format.abc.OpReader.ops.push(format.abc.OpCode.OJump(j,offset));
		return format.abc.OpCode.OJump2(j,"j" + format.abc.OpReader.jumpNameIndex,offset);
	}
}
format.abc.OpReader.prototype.readIndex = function() {
	return format.abc.Index.Idx(this.readInt());
}
format.abc.OpReader.prototype.readInt = function() {
	var a = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(a < 128) return a;
	a &= 127;
	var b = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(b < 128) return (b << 7) | a;
	b &= 127;
	var c = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(c < 128) return ((c << 14) | (b << 7)) | a;
	c &= 127;
	var d = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(d < 128) return (((d << 21) | (c << 14)) | (b << 7)) | a;
	d &= 127;
	var e = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(e > 15) throw "assert";
	if(((e & 8) == 0) != ((e & 4) == 0)) throw haxe.io.Error.Overflow;
	return ((((e << 28) | (d << 21)) | (c << 14)) | (b << 7)) | a;
}
format.abc.OpReader.prototype.readInt32 = function() {
	var a = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(a < 128) return a;
	a &= 127;
	var b = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(b < 128) return (b << 7) | a;
	b &= 127;
	var c = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(c < 128) return ((c << 14) | (b << 7)) | a;
	c &= 127;
	var d = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(d < 128) return (((d << 21) | (c << 14)) | (b << 7)) | a;
	d &= 127;
	var e = this.i.readByte();
	++format.abc.OpReader.bytePos;
	if(e > 15) throw "assert";
	var small = (((d << 21) | (c << 14)) | (b << 7)) | a;
	var big = (e) << 28;
	return (big) | (small);
}
format.abc.OpReader.prototype.readOp = function(op) {
	return (function($this) {
		var $r;
		switch(op) {
		case 1:{
			$r = format.abc.OpCode.OBreakPoint;
		}break;
		case 2:{
			$r = format.abc.OpCode.ONop;
		}break;
		case 3:{
			$r = format.abc.OpCode.OThrow;
		}break;
		case 4:{
			$r = format.abc.OpCode.OGetSuper(format.abc.Index.Idx($this.readInt()));
		}break;
		case 5:{
			$r = format.abc.OpCode.OSetSuper(format.abc.Index.Idx($this.readInt()));
		}break;
		case 6:{
			$r = format.abc.OpCode.ODxNs(format.abc.Index.Idx($this.readInt()));
		}break;
		case 7:{
			$r = format.abc.OpCode.ODxNsLate;
		}break;
		case 8:{
			$r = format.abc.OpCode.ORegKill((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 9:{
			$r = (function($this) {
				var $r;
				format.abc.OpReader.labelNameIndex++;
				format.abc.OpReader.labels[format.abc.OpReader.bytePos - 1] = "label" + format.abc.OpReader.labelNameIndex;
				format.abc.OpReader.ops.push(format.abc.OpCode.OLabel);
				$r = format.abc.OpCode.OLabel2("label" + format.abc.OpReader.labelNameIndex);
				return $r;
			}($this));
		}break;
		case 12:{
			$r = $this.jmp(format.abc.JumpStyle.JNotLt);
		}break;
		case 13:{
			$r = $this.jmp(format.abc.JumpStyle.JNotLte);
		}break;
		case 14:{
			$r = $this.jmp(format.abc.JumpStyle.JNotGt);
		}break;
		case 15:{
			$r = $this.jmp(format.abc.JumpStyle.JNotGte);
		}break;
		case 16:{
			$r = $this.jmp(format.abc.JumpStyle.JAlways);
		}break;
		case 17:{
			$r = $this.jmp(format.abc.JumpStyle.JTrue);
		}break;
		case 18:{
			$r = $this.jmp(format.abc.JumpStyle.JFalse);
		}break;
		case 19:{
			$r = $this.jmp(format.abc.JumpStyle.JEq);
		}break;
		case 20:{
			$r = $this.jmp(format.abc.JumpStyle.JNeq);
		}break;
		case 21:{
			$r = $this.jmp(format.abc.JumpStyle.JLt);
		}break;
		case 22:{
			$r = $this.jmp(format.abc.JumpStyle.JLte);
		}break;
		case 23:{
			$r = $this.jmp(format.abc.JumpStyle.JGt);
		}break;
		case 24:{
			$r = $this.jmp(format.abc.JumpStyle.JGte);
		}break;
		case 25:{
			$r = $this.jmp(format.abc.JumpStyle.JPhysEq);
		}break;
		case 26:{
			$r = $this.jmp(format.abc.JumpStyle.JPhysNeq);
		}break;
		case 27:{
			$r = (function($this) {
				var $r;
				format.abc.OpReader.bytePos += 3;
				var def = $this.i.readInt24();
				var cases = new Array();
				{
					var _g1 = 0, _g = $this.readInt() + 1;
					while(_g1 < _g) {
						var _ = _g1++;
						format.abc.OpReader.bytePos += 3;
						cases.push($this.i.readInt24());
					}
				}
				$r = format.abc.OpCode.OSwitch(def,cases);
				return $r;
			}($this));
		}break;
		case 28:{
			$r = format.abc.OpCode.OPushWith;
		}break;
		case 29:{
			$r = format.abc.OpCode.OPopScope;
		}break;
		case 30:{
			$r = format.abc.OpCode.OForIn;
		}break;
		case 31:{
			$r = format.abc.OpCode.OHasNext;
		}break;
		case 32:{
			$r = format.abc.OpCode.ONull;
		}break;
		case 33:{
			$r = format.abc.OpCode.OUndefined;
		}break;
		case 35:{
			$r = format.abc.OpCode.OForEach;
		}break;
		case 36:{
			$r = (function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = format.abc.OpCode.OSmallInt($this.i.readInt8());
				return $r;
			}($this));
		}break;
		case 37:{
			$r = format.abc.OpCode.OInt($this.readInt());
		}break;
		case 38:{
			$r = format.abc.OpCode.OTrue;
		}break;
		case 39:{
			$r = format.abc.OpCode.OFalse;
		}break;
		case 40:{
			$r = format.abc.OpCode.ONaN;
		}break;
		case 41:{
			$r = format.abc.OpCode.OPop;
		}break;
		case 42:{
			$r = format.abc.OpCode.ODup;
		}break;
		case 43:{
			$r = format.abc.OpCode.OSwap;
		}break;
		case 44:{
			$r = format.abc.OpCode.OString(format.abc.Index.Idx($this.readInt()));
		}break;
		case 45:{
			$r = format.abc.OpCode.OIntRef(format.abc.Index.Idx($this.readInt()));
		}break;
		case 46:{
			$r = format.abc.OpCode.OUIntRef(format.abc.Index.Idx($this.readInt()));
		}break;
		case 47:{
			$r = format.abc.OpCode.OFloat(format.abc.Index.Idx($this.readInt()));
		}break;
		case 48:{
			$r = format.abc.OpCode.OScope;
		}break;
		case 49:{
			$r = format.abc.OpCode.ONamespace(format.abc.Index.Idx($this.readInt()));
		}break;
		case 50:{
			$r = (function($this) {
				var $r;
				var r1 = $this.readInt();
				var r2 = $this.readInt();
				$r = format.abc.OpCode.ONext(r1,r2);
				return $r;
			}($this));
		}break;
		case 53:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemGet8);
		}break;
		case 54:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemGet16);
		}break;
		case 55:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemGet32);
		}break;
		case 56:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemGetFloat);
		}break;
		case 57:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemGetDouble);
		}break;
		case 58:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemSet8);
		}break;
		case 59:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemSet16);
		}break;
		case 60:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemSet32);
		}break;
		case 61:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemSetFloat);
		}break;
		case 62:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMemSetDouble);
		}break;
		case 64:{
			$r = format.abc.OpCode.OFunction(format.abc.Index.Idx($this.readInt()));
		}break;
		case 65:{
			$r = format.abc.OpCode.OCallStack($this.readInt());
		}break;
		case 66:{
			$r = format.abc.OpCode.OConstruct($this.readInt());
		}break;
		case 67:{
			$r = (function($this) {
				var $r;
				var s = $this.readInt();
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallMethod(s,n);
				return $r;
			}($this));
		}break;
		case 68:{
			$r = (function($this) {
				var $r;
				var m = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallStatic(m,n);
				return $r;
			}($this));
		}break;
		case 69:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallSuper(p,n);
				return $r;
			}($this));
		}break;
		case 70:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallProperty(p,n);
				return $r;
			}($this));
		}break;
		case 71:{
			$r = format.abc.OpCode.ORetVoid;
		}break;
		case 72:{
			$r = format.abc.OpCode.ORet;
		}break;
		case 73:{
			$r = format.abc.OpCode.OConstructSuper($this.readInt());
		}break;
		case 74:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OConstructProperty(p,n);
				return $r;
			}($this));
		}break;
		case 76:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallPropLex(p,n);
				return $r;
			}($this));
		}break;
		case 78:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallSuperVoid(p,n);
				return $r;
			}($this));
		}break;
		case 79:{
			$r = (function($this) {
				var $r;
				var p = format.abc.Index.Idx($this.readInt());
				var n = $this.readInt();
				$r = format.abc.OpCode.OCallPropVoid(p,n);
				return $r;
			}($this));
		}break;
		case 80:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpSign1);
		}break;
		case 81:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpSign8);
		}break;
		case 82:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpSign16);
		}break;
		case 83:{
			$r = format.abc.OpCode.OApplyType($this.readInt());
		}break;
		case 85:{
			$r = format.abc.OpCode.OObject($this.readInt());
		}break;
		case 86:{
			$r = format.abc.OpCode.OArray($this.readInt());
		}break;
		case 87:{
			$r = format.abc.OpCode.ONewBlock;
		}break;
		case 88:{
			$r = format.abc.OpCode.OClassDef(format.abc.Index.Idx($this.readInt()));
		}break;
		case 89:{
			$r = format.abc.OpCode.OGetDescendants(format.abc.Index.Idx($this.readInt()));
		}break;
		case 90:{
			$r = format.abc.OpCode.OCatch($this.readInt());
		}break;
		case 93:{
			$r = format.abc.OpCode.OFindPropStrict(format.abc.Index.Idx($this.readInt()));
		}break;
		case 94:{
			$r = format.abc.OpCode.OFindProp(format.abc.Index.Idx($this.readInt()));
		}break;
		case 95:{
			$r = format.abc.OpCode.OFindDefinition(format.abc.Index.Idx($this.readInt()));
		}break;
		case 96:{
			$r = format.abc.OpCode.OGetLex(format.abc.Index.Idx($this.readInt()));
		}break;
		case 97:{
			$r = format.abc.OpCode.OSetProp(format.abc.Index.Idx($this.readInt()));
		}break;
		case 98:{
			$r = format.abc.OpCode.OReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 99:{
			$r = format.abc.OpCode.OSetReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 100:{
			$r = format.abc.OpCode.OGetGlobalScope;
		}break;
		case 101:{
			$r = (function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = format.abc.OpCode.OGetScope($this.i.readByte());
				return $r;
			}($this));
		}break;
		case 102:{
			$r = format.abc.OpCode.OGetProp(format.abc.Index.Idx($this.readInt()));
		}break;
		case 104:{
			$r = format.abc.OpCode.OInitProp(format.abc.Index.Idx($this.readInt()));
		}break;
		case 106:{
			$r = format.abc.OpCode.ODeleteProp(format.abc.Index.Idx($this.readInt()));
		}break;
		case 108:{
			$r = format.abc.OpCode.OGetSlot($this.readInt());
		}break;
		case 109:{
			$r = format.abc.OpCode.OSetSlot($this.readInt());
		}break;
		case 110:{
			$r = format.abc.OpCode.OGetGlobalSlot($this.readInt());
		}break;
		case 111:{
			$r = format.abc.OpCode.OSetGlobalSlot($this.readInt());
		}break;
		case 112:{
			$r = format.abc.OpCode.OToString;
		}break;
		case 113:{
			$r = format.abc.OpCode.OToXml;
		}break;
		case 114:{
			$r = format.abc.OpCode.OToXmlAttr;
		}break;
		case 115:{
			$r = format.abc.OpCode.OToInt;
		}break;
		case 116:{
			$r = format.abc.OpCode.OToUInt;
		}break;
		case 117:{
			$r = format.abc.OpCode.OToNumber;
		}break;
		case 118:{
			$r = format.abc.OpCode.OToBool;
		}break;
		case 119:{
			$r = format.abc.OpCode.OToObject;
		}break;
		case 120:{
			$r = format.abc.OpCode.OCheckIsXml;
		}break;
		case 128:{
			$r = format.abc.OpCode.OCast(format.abc.Index.Idx($this.readInt()));
		}break;
		case 130:{
			$r = format.abc.OpCode.OAsAny;
		}break;
		case 133:{
			$r = format.abc.OpCode.OAsString;
		}break;
		case 134:{
			$r = format.abc.OpCode.OAsType(format.abc.Index.Idx($this.readInt()));
		}break;
		case 135:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpAs);
		}break;
		case 137:{
			$r = format.abc.OpCode.OAsObject;
		}break;
		case 144:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpNeg);
		}break;
		case 145:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIncr);
		}break;
		case 146:{
			$r = format.abc.OpCode.OIncrReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 147:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpDecr);
		}break;
		case 148:{
			$r = format.abc.OpCode.ODecrReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 149:{
			$r = format.abc.OpCode.OTypeof;
		}break;
		case 150:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpNot);
		}break;
		case 151:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpBitNot);
		}break;
		case 160:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpAdd);
		}break;
		case 161:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpSub);
		}break;
		case 162:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMul);
		}break;
		case 163:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpDiv);
		}break;
		case 164:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpMod);
		}break;
		case 165:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpShl);
		}break;
		case 166:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpShr);
		}break;
		case 167:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpUShr);
		}break;
		case 168:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpAnd);
		}break;
		case 169:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpOr);
		}break;
		case 170:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpXor);
		}break;
		case 171:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpEq);
		}break;
		case 172:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpPhysEq);
		}break;
		case 173:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpLt);
		}break;
		case 174:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpLte);
		}break;
		case 175:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpGt);
		}break;
		case 176:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpGte);
		}break;
		case 177:{
			$r = format.abc.OpCode.OInstanceOf;
		}break;
		case 178:{
			$r = format.abc.OpCode.OIsType(format.abc.Index.Idx($this.readInt()));
		}break;
		case 179:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIs);
		}break;
		case 180:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIn);
		}break;
		case 192:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIIncr);
		}break;
		case 193:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIDecr);
		}break;
		case 194:{
			$r = format.abc.OpCode.OIncrIReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 195:{
			$r = format.abc.OpCode.ODecrIReg((function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				$r = $this.i.readByte();
				return $r;
			}($this)));
		}break;
		case 196:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpINeg);
		}break;
		case 197:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIAdd);
		}break;
		case 198:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpISub);
		}break;
		case 199:{
			$r = format.abc.OpCode.OOp(format.abc.Operation.OpIMul);
		}break;
		case 208:{
			$r = format.abc.OpCode.OThis;
		}break;
		case 209:{
			$r = format.abc.OpCode.OReg(1);
		}break;
		case 210:{
			$r = format.abc.OpCode.OReg(2);
		}break;
		case 211:{
			$r = format.abc.OpCode.OReg(3);
		}break;
		case 212:{
			$r = format.abc.OpCode.OSetThis;
		}break;
		case 213:{
			$r = format.abc.OpCode.OSetReg(1);
		}break;
		case 214:{
			$r = format.abc.OpCode.OSetReg(2);
		}break;
		case 215:{
			$r = format.abc.OpCode.OSetReg(3);
		}break;
		case 239:{
			$r = (function($this) {
				var $r;
				++format.abc.OpReader.bytePos;
				if($this.i.readByte() != 1) throw "assert";
				var name = format.abc.Index.Idx($this.readInt());
				var r = (function($this) {
					var $r;
					++format.abc.OpReader.bytePos;
					$r = $this.i.readByte();
					return $r;
				}($this));
				var line = $this.readInt();
				$r = format.abc.OpCode.ODebugReg(name,r,line);
				return $r;
			}($this));
		}break;
		case 240:{
			$r = format.abc.OpCode.ODebugLine($this.readInt());
		}break;
		case 241:{
			$r = format.abc.OpCode.ODebugFile(format.abc.Index.Idx($this.readInt()));
		}break;
		case 242:{
			$r = format.abc.OpCode.OBreakPointLine($this.readInt());
		}break;
		case 243:{
			$r = format.abc.OpCode.OTimestamp;
		}break;
		default:{
			$r = format.abc.OpCode.OUnknown(op);
		}break;
		}
		return $r;
	}(this));
}
format.abc.OpReader.prototype.reg = function() {
	++format.abc.OpReader.bytePos;
	return this.i.readByte();
}
format.abc.OpReader.prototype.__class__ = format.abc.OpReader;
format.mp3.Tools = function() { }
format.mp3.Tools.__name__ = ["format","mp3","Tools"];
format.mp3.Tools.getBitrate = function(mpegVersion,layerIdx,bitrateIdx) {
	if(mpegVersion == format.mp3.MPEG.Reserved || layerIdx == format.mp3.CLayer.LReserved) return format.mp3.Bitrate.BR_Bad;
	return ((mpegVersion == format.mp3.MPEG.V1?format.mp3.MPEG.V1_Bitrates:format.mp3.MPEG.V2_Bitrates))[layerIdx][bitrateIdx];
}
format.mp3.Tools.getSamplingRate = function(mpegVersion,samplingRateIdx) {
	return format.mp3.MPEG.SamplingRates[mpegVersion][samplingRateIdx];
}
format.mp3.Tools.isInvalidFrameHeader = function(hdr) {
	return hdr.version == format.mp3.MPEGVersion.MPEG_Reserved || hdr.layer == format.mp3.Layer.LayerReserved || hdr.bitrate == format.mp3.Bitrate.BR_Bad || hdr.bitrate == format.mp3.Bitrate.BR_Free || hdr.samplingRate == format.mp3.SamplingRate.SR_Bad;
}
format.mp3.Tools.getSampleDataSize = function(mpegVersion,bitrate,samplingRate,isPadded,hasCrc) {
	return Std["int"]((((mpegVersion == format.mp3.MPEG.V1?144:72)) * bitrate * 1000) / samplingRate) + ((isPadded?1:0)) - ((hasCrc?2:0)) - 4;
}
format.mp3.Tools.getSampleDataSizeHdr = function(hdr) {
	return format.mp3.Tools.getSampleDataSize(format.mp3.MPEG.enum2Num(hdr.version),format.mp3.MPEG.bitrateEnum2Num(hdr.bitrate),format.mp3.MPEG.srEnum2Num(hdr.samplingRate),hdr.isPadded,hdr.hasCrc);
}
format.mp3.Tools.getSampleCount = function(mpegVersion) {
	return (mpegVersion == format.mp3.MPEG.V1?1152:576);
}
format.mp3.Tools.getSampleCountHdr = function(hdr) {
	return format.mp3.Tools.getSampleCount(format.mp3.MPEG.enum2Num(hdr.version));
}
format.mp3.Tools.getFrameInfo = function(fr) {
	return Std.string(fr.header.version) + ", " + Std.string(fr.header.layer) + ", " + Std.string(fr.header.channelMode) + ", " + fr.header.samplingRate + " Hz, " + fr.header.bitrate + " kbps " + "Emphasis: " + Std.string(fr.header.emphasis) + ", " + ((fr.header.hasCrc?"(CRC) ":"")) + ((fr.header.isPadded?"(Padded) ":"")) + ((fr.header.isIntensityStereo?"(Intensity Stereo) ":"")) + ((fr.header.isMSStereo?"(MS Stereo) ":"")) + ((fr.header.isCopyrighted?"(Copyrighted) ":"")) + ((fr.header.isOriginal?"(Original) ":""));
}
format.mp3.Tools.prototype.__class__ = format.mp3.Tools;
haxe.io.Input = function() { }
haxe.io.Input.__name__ = ["haxe","io","Input"];
haxe.io.Input.prototype.bigEndian = null;
haxe.io.Input.prototype.close = function() {
	null;
}
haxe.io.Input.prototype.read = function(nbytes) {
	var s = haxe.io.Bytes.alloc(nbytes);
	var p = 0;
	while(nbytes > 0) {
		var k = this.readBytes(s,p,nbytes);
		if(k == 0) throw haxe.io.Error.Blocked;
		p += k;
		nbytes -= k;
	}
	return s;
}
haxe.io.Input.prototype.readAll = function(bufsize) {
	if(bufsize == null) bufsize = 16384;
	var buf = haxe.io.Bytes.alloc(bufsize);
	var total = new haxe.io.BytesBuffer();
	try {
		while(true) {
			var len = this.readBytes(buf,0,bufsize);
			if(len == 0) throw haxe.io.Error.Blocked;
			total.addBytes(buf,0,len);
		}
	}
	catch( $e3 ) {
		if( js.Boot.__instanceof($e3,haxe.io.Eof) ) {
			var e = $e3;
			null;
		} else throw($e3);
	}
	return total.getBytes();
}
haxe.io.Input.prototype.readByte = function() {
	return (function($this) {
		var $r;
		throw "Not implemented";
		return $r;
	}(this));
}
haxe.io.Input.prototype.readBytes = function(s,pos,len) {
	var k = len;
	var b = s.b;
	if(pos < 0 || len < 0 || pos + len > s.length) throw haxe.io.Error.OutsideBounds;
	while(k > 0) {
		b[pos] = this.readByte();
		pos++;
		k--;
	}
	return len;
}
haxe.io.Input.prototype.readDouble = function() {
	throw "Not implemented";
	return 0;
}
haxe.io.Input.prototype.readFloat = function() {
	throw "Not implemented";
	return 0;
}
haxe.io.Input.prototype.readFullBytes = function(s,pos,len) {
	while(len > 0) {
		var k = this.readBytes(s,pos,len);
		pos += k;
		len -= k;
	}
}
haxe.io.Input.prototype.readInt16 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	var n = (this.bigEndian?ch2 | (ch1 << 8):ch1 | (ch2 << 8));
	if((n & 32768) != 0) return n - 65536;
	return n;
}
haxe.io.Input.prototype.readInt24 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	var ch3 = this.readByte();
	var n = (this.bigEndian?(ch3 | (ch2 << 8)) | (ch1 << 16):(ch1 | (ch2 << 8)) | (ch3 << 16));
	if((n & 8388608) != 0) return n - 16777216;
	return n;
}
haxe.io.Input.prototype.readInt31 = function() {
	var ch1, ch2, ch3, ch4;
	if(this.bigEndian) {
		ch4 = this.readByte();
		ch3 = this.readByte();
		ch2 = this.readByte();
		ch1 = this.readByte();
	}
	else {
		ch1 = this.readByte();
		ch2 = this.readByte();
		ch3 = this.readByte();
		ch4 = this.readByte();
	}
	if(((ch4 & 128) == 0) != ((ch4 & 64) == 0)) throw haxe.io.Error.Overflow;
	return ((ch1 | (ch2 << 8)) | (ch3 << 16)) | (ch4 << 24);
}
haxe.io.Input.prototype.readInt32 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	var ch3 = this.readByte();
	var ch4 = this.readByte();
	return (this.bigEndian?(((ch1 << 8) | ch2) << 16) | ((ch3 << 8) | ch4):(((ch4 << 8) | ch3) << 16) | ((ch2 << 8) | ch1));
}
haxe.io.Input.prototype.readInt8 = function() {
	var n = this.readByte();
	if(n >= 128) return n - 256;
	return n;
}
haxe.io.Input.prototype.readLine = function() {
	var buf = new StringBuf();
	var last;
	var s;
	try {
		while((last = this.readByte()) != 10) buf.b[buf.b.length] = String.fromCharCode(last);
		s = buf.b.join("");
		if(s.charCodeAt(s.length - 1) == 13) s = s.substr(0,-1);
	}
	catch( $e4 ) {
		if( js.Boot.__instanceof($e4,haxe.io.Eof) ) {
			var e = $e4;
			{
				s = buf.b.join("");
				if(s.length == 0) throw (e);
			}
		} else throw($e4);
	}
	return s;
}
haxe.io.Input.prototype.readString = function(len) {
	var b = haxe.io.Bytes.alloc(len);
	this.readFullBytes(b,0,len);
	return b.toString();
}
haxe.io.Input.prototype.readUInt16 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	return (this.bigEndian?ch2 | (ch1 << 8):ch1 | (ch2 << 8));
}
haxe.io.Input.prototype.readUInt24 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	var ch3 = this.readByte();
	return (this.bigEndian?(ch3 | (ch2 << 8)) | (ch1 << 16):(ch1 | (ch2 << 8)) | (ch3 << 16));
}
haxe.io.Input.prototype.readUInt30 = function() {
	var ch1 = this.readByte();
	var ch2 = this.readByte();
	var ch3 = this.readByte();
	var ch4 = this.readByte();
	if(((this.bigEndian?ch1:ch4)) >= 64) throw haxe.io.Error.Overflow;
	return (this.bigEndian?((ch4 | (ch3 << 8)) | (ch2 << 16)) | (ch1 << 24):((ch1 | (ch2 << 8)) | (ch3 << 16)) | (ch4 << 24));
}
haxe.io.Input.prototype.readUntil = function(end) {
	var buf = new StringBuf();
	var last;
	while((last = this.readByte()) != end) buf.b[buf.b.length] = String.fromCharCode(last);
	return buf.b.join("");
}
haxe.io.Input.prototype.setEndian = function(b) {
	this.bigEndian = b;
	return b;
}
haxe.io.Input.prototype.__class__ = haxe.io.Input;
haxe.io.BytesInput = function(b,pos,len) { if( b === $_ ) return; {
	if(pos == null) pos = 0;
	if(len == null) len = b.length - pos;
	if(pos < 0 || len < 0 || pos + len > b.length) throw haxe.io.Error.OutsideBounds;
	this.b = b.b;
	this.pos = pos;
	this.len = len;
}}
haxe.io.BytesInput.__name__ = ["haxe","io","BytesInput"];
haxe.io.BytesInput.__super__ = haxe.io.Input;
for(var k in haxe.io.Input.prototype ) haxe.io.BytesInput.prototype[k] = haxe.io.Input.prototype[k];
haxe.io.BytesInput.prototype.b = null;
haxe.io.BytesInput.prototype.len = null;
haxe.io.BytesInput.prototype.pos = null;
haxe.io.BytesInput.prototype.readByte = function() {
	if(this.len == 0) throw new haxe.io.Eof();
	this.len--;
	return this.b[this.pos++];
}
haxe.io.BytesInput.prototype.readBytes = function(buf,pos,len) {
	if(pos < 0 || len < 0 || pos + len > buf.length) throw haxe.io.Error.OutsideBounds;
	if(this.len == 0 && len > 0) throw new haxe.io.Eof();
	if(this.len < len) len = this.len;
	var b1 = this.b;
	var b2 = buf.b;
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			b2[pos + i] = b1[this.pos + i];
		}
	}
	this.pos += len;
	this.len -= len;
	return len;
}
haxe.io.BytesInput.prototype.__class__ = haxe.io.BytesInput;
haxe.io.Eof = function(p) { if( p === $_ ) return; {
	null;
}}
haxe.io.Eof.__name__ = ["haxe","io","Eof"];
haxe.io.Eof.prototype.toString = function() {
	return "Eof";
}
haxe.io.Eof.prototype.__class__ = haxe.io.Eof;
Reflect = function() { }
Reflect.__name__ = ["Reflect"];
Reflect.hasField = function(o,field) {
	if(o.hasOwnProperty != null) return o.hasOwnProperty(field);
	var arr = Reflect.fields(o);
	{ var $it5 = arr.iterator();
	while( $it5.hasNext() ) { var t = $it5.next();
	if(t == field) return true;
	}}
	return false;
}
Reflect.field = function(o,field) {
	var v = null;
	try {
		v = o[field];
	}
	catch( $e6 ) {
		{
			var e = $e6;
			null;
		}
	}
	return v;
}
Reflect.setField = function(o,field,value) {
	o[field] = value;
}
Reflect.callMethod = function(o,func,args) {
	return func.apply(o,args);
}
Reflect.fields = function(o) {
	if(o == null) return new Array();
	var a = new Array();
	if(o.hasOwnProperty) {
		
					for(var i in o)
						if( o.hasOwnProperty(i) )
							a.push(i);
				;
	}
	else {
		var t;
		try {
			t = o.__proto__;
		}
		catch( $e7 ) {
			{
				var e = $e7;
				{
					t = null;
				}
			}
		}
		if(t != null) o.__proto__ = null;
		
					for(var i in o)
						if( i != "__proto__" )
							a.push(i);
				;
		if(t != null) o.__proto__ = t;
	}
	return a;
}
Reflect.isFunction = function(f) {
	return typeof(f) == "function" && f.__name__ == null;
}
Reflect.compare = function(a,b) {
	return ((a == b)?0:((((a) > (b))?1:-1)));
}
Reflect.compareMethods = function(f1,f2) {
	if(f1 == f2) return true;
	if(!Reflect.isFunction(f1) || !Reflect.isFunction(f2)) return false;
	return f1.scope == f2.scope && f1.method == f2.method && f1.method != null;
}
Reflect.isObject = function(v) {
	if(v == null) return false;
	var t = typeof(v);
	return (t == "string" || (t == "object" && !v.__enum__) || (t == "function" && v.__name__ != null));
}
Reflect.deleteField = function(o,f) {
	if(!Reflect.hasField(o,f)) return false;
	delete(o[f]);
	return true;
}
Reflect.copy = function(o) {
	var o2 = { }
	{
		var _g = 0, _g1 = Reflect.fields(o);
		while(_g < _g1.length) {
			var f = _g1[_g];
			++_g;
			o2[f] = Reflect.field(o,f);
		}
	}
	return o2;
}
Reflect.makeVarArgs = function(f) {
	return function() {
		var a = new Array();
		{
			var _g1 = 0, _g = arguments.length;
			while(_g1 < _g) {
				var i = _g1++;
				a.push(arguments[i]);
			}
		}
		return f(a);
	}
}
Reflect.prototype.__class__ = Reflect;
format.mp3.SamplingRate = { __ename__ : ["format","mp3","SamplingRate"], __constructs__ : ["SR_8000","SR_11025","SR_12000","SR_22050","SR_24000","SR_32000","SR_44100","SR_48000","SR_Bad"] }
format.mp3.SamplingRate.SR_11025 = ["SR_11025",1];
format.mp3.SamplingRate.SR_11025.toString = $estr;
format.mp3.SamplingRate.SR_11025.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_12000 = ["SR_12000",2];
format.mp3.SamplingRate.SR_12000.toString = $estr;
format.mp3.SamplingRate.SR_12000.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_22050 = ["SR_22050",3];
format.mp3.SamplingRate.SR_22050.toString = $estr;
format.mp3.SamplingRate.SR_22050.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_24000 = ["SR_24000",4];
format.mp3.SamplingRate.SR_24000.toString = $estr;
format.mp3.SamplingRate.SR_24000.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_32000 = ["SR_32000",5];
format.mp3.SamplingRate.SR_32000.toString = $estr;
format.mp3.SamplingRate.SR_32000.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_44100 = ["SR_44100",6];
format.mp3.SamplingRate.SR_44100.toString = $estr;
format.mp3.SamplingRate.SR_44100.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_48000 = ["SR_48000",7];
format.mp3.SamplingRate.SR_48000.toString = $estr;
format.mp3.SamplingRate.SR_48000.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_8000 = ["SR_8000",0];
format.mp3.SamplingRate.SR_8000.toString = $estr;
format.mp3.SamplingRate.SR_8000.__enum__ = format.mp3.SamplingRate;
format.mp3.SamplingRate.SR_Bad = ["SR_Bad",8];
format.mp3.SamplingRate.SR_Bad.toString = $estr;
format.mp3.SamplingRate.SR_Bad.__enum__ = format.mp3.SamplingRate;
format.mp3.Bitrate = { __ename__ : ["format","mp3","Bitrate"], __constructs__ : ["BR_8","BR_16","BR_24","BR_32","BR_40","BR_48","BR_56","BR_64","BR_80","BR_96","BR_112","BR_128","BR_144","BR_160","BR_176","BR_192","BR_224","BR_256","BR_288","BR_320","BR_352","BR_384","BR_416","BR_448","BR_Free","BR_Bad"] }
format.mp3.Bitrate.BR_112 = ["BR_112",10];
format.mp3.Bitrate.BR_112.toString = $estr;
format.mp3.Bitrate.BR_112.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_128 = ["BR_128",11];
format.mp3.Bitrate.BR_128.toString = $estr;
format.mp3.Bitrate.BR_128.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_144 = ["BR_144",12];
format.mp3.Bitrate.BR_144.toString = $estr;
format.mp3.Bitrate.BR_144.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_16 = ["BR_16",1];
format.mp3.Bitrate.BR_16.toString = $estr;
format.mp3.Bitrate.BR_16.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_160 = ["BR_160",13];
format.mp3.Bitrate.BR_160.toString = $estr;
format.mp3.Bitrate.BR_160.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_176 = ["BR_176",14];
format.mp3.Bitrate.BR_176.toString = $estr;
format.mp3.Bitrate.BR_176.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_192 = ["BR_192",15];
format.mp3.Bitrate.BR_192.toString = $estr;
format.mp3.Bitrate.BR_192.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_224 = ["BR_224",16];
format.mp3.Bitrate.BR_224.toString = $estr;
format.mp3.Bitrate.BR_224.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_24 = ["BR_24",2];
format.mp3.Bitrate.BR_24.toString = $estr;
format.mp3.Bitrate.BR_24.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_256 = ["BR_256",17];
format.mp3.Bitrate.BR_256.toString = $estr;
format.mp3.Bitrate.BR_256.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_288 = ["BR_288",18];
format.mp3.Bitrate.BR_288.toString = $estr;
format.mp3.Bitrate.BR_288.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_32 = ["BR_32",3];
format.mp3.Bitrate.BR_32.toString = $estr;
format.mp3.Bitrate.BR_32.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_320 = ["BR_320",19];
format.mp3.Bitrate.BR_320.toString = $estr;
format.mp3.Bitrate.BR_320.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_352 = ["BR_352",20];
format.mp3.Bitrate.BR_352.toString = $estr;
format.mp3.Bitrate.BR_352.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_384 = ["BR_384",21];
format.mp3.Bitrate.BR_384.toString = $estr;
format.mp3.Bitrate.BR_384.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_40 = ["BR_40",4];
format.mp3.Bitrate.BR_40.toString = $estr;
format.mp3.Bitrate.BR_40.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_416 = ["BR_416",22];
format.mp3.Bitrate.BR_416.toString = $estr;
format.mp3.Bitrate.BR_416.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_448 = ["BR_448",23];
format.mp3.Bitrate.BR_448.toString = $estr;
format.mp3.Bitrate.BR_448.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_48 = ["BR_48",5];
format.mp3.Bitrate.BR_48.toString = $estr;
format.mp3.Bitrate.BR_48.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_56 = ["BR_56",6];
format.mp3.Bitrate.BR_56.toString = $estr;
format.mp3.Bitrate.BR_56.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_64 = ["BR_64",7];
format.mp3.Bitrate.BR_64.toString = $estr;
format.mp3.Bitrate.BR_64.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_8 = ["BR_8",0];
format.mp3.Bitrate.BR_8.toString = $estr;
format.mp3.Bitrate.BR_8.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_80 = ["BR_80",8];
format.mp3.Bitrate.BR_80.toString = $estr;
format.mp3.Bitrate.BR_80.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_96 = ["BR_96",9];
format.mp3.Bitrate.BR_96.toString = $estr;
format.mp3.Bitrate.BR_96.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_Bad = ["BR_Bad",25];
format.mp3.Bitrate.BR_Bad.toString = $estr;
format.mp3.Bitrate.BR_Bad.__enum__ = format.mp3.Bitrate;
format.mp3.Bitrate.BR_Free = ["BR_Free",24];
format.mp3.Bitrate.BR_Free.toString = $estr;
format.mp3.Bitrate.BR_Free.__enum__ = format.mp3.Bitrate;
format.mp3.MPEG = function() { }
format.mp3.MPEG.__name__ = ["format","mp3","MPEG"];
format.mp3.MPEG.enum2Num = function(m) {
	return (function($this) {
		var $r;
		var $e = (m);
		switch( $e[1] ) {
		case 0:
		{
			$r = format.mp3.MPEG.V1;
		}break;
		case 1:
		{
			$r = format.mp3.MPEG.V2;
		}break;
		case 2:
		{
			$r = format.mp3.MPEG.V25;
		}break;
		case 3:
		{
			$r = format.mp3.MPEG.Reserved;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.num2Enum = function(m) {
	return (function($this) {
		var $r;
		switch(m) {
		case format.mp3.MPEG.V1:{
			$r = format.mp3.MPEGVersion.MPEG_V1;
		}break;
		case format.mp3.MPEG.V2:{
			$r = format.mp3.MPEGVersion.MPEG_V2;
		}break;
		case format.mp3.MPEG.V25:{
			$r = format.mp3.MPEGVersion.MPEG_V25;
		}break;
		default:{
			$r = format.mp3.MPEGVersion.MPEG_Reserved;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.srNum2Enum = function(sr) {
	return (function($this) {
		var $r;
		switch(sr) {
		case 8000:{
			$r = format.mp3.SamplingRate.SR_8000;
		}break;
		case 11025:{
			$r = format.mp3.SamplingRate.SR_11025;
		}break;
		case 12000:{
			$r = format.mp3.SamplingRate.SR_12000;
		}break;
		case 22050:{
			$r = format.mp3.SamplingRate.SR_22050;
		}break;
		case 24000:{
			$r = format.mp3.SamplingRate.SR_24000;
		}break;
		case 32000:{
			$r = format.mp3.SamplingRate.SR_32000;
		}break;
		case 44100:{
			$r = format.mp3.SamplingRate.SR_44100;
		}break;
		case 48000:{
			$r = format.mp3.SamplingRate.SR_48000;
		}break;
		default:{
			$r = format.mp3.SamplingRate.SR_Bad;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.srEnum2Num = function(sr) {
	return (function($this) {
		var $r;
		var $e = (sr);
		switch( $e[1] ) {
		case 0:
		{
			$r = 8000;
		}break;
		case 1:
		{
			$r = 11025;
		}break;
		case 2:
		{
			$r = 12000;
		}break;
		case 3:
		{
			$r = 22050;
		}break;
		case 4:
		{
			$r = 24000;
		}break;
		case 5:
		{
			$r = 32000;
		}break;
		case 6:
		{
			$r = 44100;
		}break;
		case 7:
		{
			$r = 48000;
		}break;
		case 8:
		{
			$r = -1;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.getBitrateIdx = function(br,mpeg,layer) {
	var arr = (((mpeg == format.mp3.MPEGVersion.MPEG_V1)?format.mp3.MPEG.V1_Bitrates:format.mp3.MPEG.V2_Bitrates))[format.mp3.CLayer.enum2Num(layer)];
	{
		var _g = 0;
		while(_g < 16) {
			var i = _g++;
			if(arr[i] == br) return i;
		}
	}
	throw "Bitrate index not found";
}
format.mp3.MPEG.getSamplingRateIdx = function(sr,mpeg) {
	var arr = format.mp3.MPEG.SamplingRates[format.mp3.MPEG.enum2Num(mpeg)];
	{
		var _g = 0;
		while(_g < 4) {
			var i = _g++;
			if(arr[i] == sr) return i;
		}
	}
	throw "Sampling rate index not found";
}
format.mp3.MPEG.bitrateEnum2Num = function(br) {
	return (function($this) {
		var $r;
		var $e = (br);
		switch( $e[1] ) {
		case 25:
		{
			$r = -1;
		}break;
		case 24:
		{
			$r = 0;
		}break;
		case 0:
		{
			$r = 8;
		}break;
		case 1:
		{
			$r = 16;
		}break;
		case 2:
		{
			$r = 24;
		}break;
		case 3:
		{
			$r = 32;
		}break;
		case 4:
		{
			$r = 40;
		}break;
		case 5:
		{
			$r = 48;
		}break;
		case 6:
		{
			$r = 56;
		}break;
		case 7:
		{
			$r = 64;
		}break;
		case 8:
		{
			$r = 80;
		}break;
		case 9:
		{
			$r = 96;
		}break;
		case 10:
		{
			$r = 112;
		}break;
		case 11:
		{
			$r = 128;
		}break;
		case 12:
		{
			$r = 144;
		}break;
		case 13:
		{
			$r = 160;
		}break;
		case 14:
		{
			$r = 176;
		}break;
		case 15:
		{
			$r = 192;
		}break;
		case 16:
		{
			$r = 224;
		}break;
		case 17:
		{
			$r = 256;
		}break;
		case 18:
		{
			$r = 288;
		}break;
		case 19:
		{
			$r = 320;
		}break;
		case 20:
		{
			$r = 352;
		}break;
		case 21:
		{
			$r = 384;
		}break;
		case 22:
		{
			$r = 416;
		}break;
		case 23:
		{
			$r = 448;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.bitrateNum2Enum = function(br) {
	return (function($this) {
		var $r;
		switch(br) {
		case 0:{
			$r = format.mp3.Bitrate.BR_Free;
		}break;
		case 8:{
			$r = format.mp3.Bitrate.BR_8;
		}break;
		case 16:{
			$r = format.mp3.Bitrate.BR_16;
		}break;
		case 24:{
			$r = format.mp3.Bitrate.BR_24;
		}break;
		case 32:{
			$r = format.mp3.Bitrate.BR_32;
		}break;
		case 40:{
			$r = format.mp3.Bitrate.BR_40;
		}break;
		case 48:{
			$r = format.mp3.Bitrate.BR_48;
		}break;
		case 56:{
			$r = format.mp3.Bitrate.BR_56;
		}break;
		case 64:{
			$r = format.mp3.Bitrate.BR_64;
		}break;
		case 80:{
			$r = format.mp3.Bitrate.BR_80;
		}break;
		case 96:{
			$r = format.mp3.Bitrate.BR_96;
		}break;
		case 112:{
			$r = format.mp3.Bitrate.BR_112;
		}break;
		case 128:{
			$r = format.mp3.Bitrate.BR_128;
		}break;
		case 144:{
			$r = format.mp3.Bitrate.BR_144;
		}break;
		case 160:{
			$r = format.mp3.Bitrate.BR_160;
		}break;
		case 176:{
			$r = format.mp3.Bitrate.BR_176;
		}break;
		case 192:{
			$r = format.mp3.Bitrate.BR_192;
		}break;
		case 224:{
			$r = format.mp3.Bitrate.BR_224;
		}break;
		case 256:{
			$r = format.mp3.Bitrate.BR_256;
		}break;
		case 288:{
			$r = format.mp3.Bitrate.BR_288;
		}break;
		case 320:{
			$r = format.mp3.Bitrate.BR_320;
		}break;
		case 352:{
			$r = format.mp3.Bitrate.BR_352;
		}break;
		case 384:{
			$r = format.mp3.Bitrate.BR_384;
		}break;
		case 416:{
			$r = format.mp3.Bitrate.BR_416;
		}break;
		case 448:{
			$r = format.mp3.Bitrate.BR_448;
		}break;
		default:{
			$r = format.mp3.Bitrate.BR_Bad;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.MPEG.prototype.__class__ = format.mp3.MPEG;
format.mp3.CLayer = function() { }
format.mp3.CLayer.__name__ = ["format","mp3","CLayer"];
format.mp3.CLayer.enum2Num = function(l) {
	return (function($this) {
		var $r;
		var $e = (l);
		switch( $e[1] ) {
		case 1:
		{
			$r = format.mp3.CLayer.LLayer3;
		}break;
		case 2:
		{
			$r = format.mp3.CLayer.LLayer2;
		}break;
		case 3:
		{
			$r = format.mp3.CLayer.LLayer1;
		}break;
		case 0:
		{
			$r = format.mp3.CLayer.LReserved;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CLayer.num2Enum = function(l) {
	return (function($this) {
		var $r;
		switch(l) {
		case format.mp3.CLayer.LLayer3:{
			$r = format.mp3.Layer.Layer3;
		}break;
		case format.mp3.CLayer.LLayer2:{
			$r = format.mp3.Layer.Layer2;
		}break;
		case format.mp3.CLayer.LLayer1:{
			$r = format.mp3.Layer.Layer1;
		}break;
		default:{
			$r = format.mp3.Layer.LayerReserved;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CLayer.prototype.__class__ = format.mp3.CLayer;
format.mp3.CChannelMode = function() { }
format.mp3.CChannelMode.__name__ = ["format","mp3","CChannelMode"];
format.mp3.CChannelMode.enum2Num = function(c) {
	return (function($this) {
		var $r;
		var $e = (c);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = format.mp3.CChannelMode.CDualChannel;
		}break;
		case 3:
		{
			$r = format.mp3.CChannelMode.CMono;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CChannelMode.num2Enum = function(c) {
	return (function($this) {
		var $r;
		switch(c) {
		case 0:{
			$r = format.mp3.ChannelMode.Stereo;
		}break;
		case 1:{
			$r = format.mp3.ChannelMode.JointStereo;
		}break;
		case format.mp3.CChannelMode.CDualChannel:{
			$r = format.mp3.ChannelMode.DualChannel;
		}break;
		case format.mp3.CChannelMode.CMono:{
			$r = format.mp3.ChannelMode.Mono;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CChannelMode.prototype.__class__ = format.mp3.CChannelMode;
format.mp3.CEmphasis = function() { }
format.mp3.CEmphasis.__name__ = ["format","mp3","CEmphasis"];
format.mp3.CEmphasis.enum2Num = function(c) {
	return (function($this) {
		var $r;
		var $e = (c);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 3;
		}break;
		case 3:
		{
			$r = 2;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CEmphasis.num2Enum = function(c) {
	return (function($this) {
		var $r;
		switch(c) {
		case 0:{
			$r = format.mp3.Emphasis.NoEmphasis;
		}break;
		case 1:{
			$r = format.mp3.Emphasis.Ms50_15;
		}break;
		case 3:{
			$r = format.mp3.Emphasis.CCIT_J17;
		}break;
		case 2:{
			$r = format.mp3.Emphasis.InvalidEmphasis;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.mp3.CEmphasis.prototype.__class__ = format.mp3.CEmphasis;
format.swf.Writer = function(o) { if( o === $_ ) return; {
	this.output = o;
}}
format.swf.Writer.__name__ = ["format","swf","Writer"];
format.swf.Writer.prototype.bits = null;
format.swf.Writer.prototype.closeTMP = function(old) {
	var bytes = this.o.getBytes();
	this.o = old;
	this.bits.o = old;
	return bytes;
}
format.swf.Writer.prototype.compressed = null;
format.swf.Writer.prototype.o = null;
format.swf.Writer.prototype.openTMP = function() {
	var old = this.o;
	this.o = new haxe.io.BytesOutput();
	this.bits.o = this.o;
	return old;
}
format.swf.Writer.prototype.output = null;
format.swf.Writer.prototype.write = function(s) {
	this.writeHeader(s.header);
	{
		var _g = 0, _g1 = s.tags;
		while(_g < _g1.length) {
			var t = _g1[_g];
			++_g;
			this.writeTag(t);
		}
	}
	this.writeEnd();
}
format.swf.Writer.prototype.writeBlendMode = function(b) {
	this.o.writeByte(b[1] + 1);
}
format.swf.Writer.prototype.writeButtonRecord = function(btnRec) {
	this.bits.writeBits(4,0);
	this.bits.writeBit(btnRec.hit);
	this.bits.writeBit(btnRec.down);
	this.bits.writeBit(btnRec.over);
	this.bits.writeBit(btnRec.up);
	this.o.writeUInt16(btnRec.id);
	this.o.writeUInt16(btnRec.depth);
	this.writeMatrix(btnRec.matrix);
	this.o.writeByte(0);
}
format.swf.Writer.prototype.writeCXA = function(c) {
	this.bits.writeBit(c.add != null);
	this.bits.writeBit(c.mult != null);
	this.bits.writeBits(4,c.nbits);
	if(c.mult != null) this.writeCXAColor(c.mult,c.nbits);
	if(c.add != null) this.writeCXAColor(c.add,c.nbits);
	this.bits.flush();
}
format.swf.Writer.prototype.writeCXAColor = function(c,nbits) {
	this.bits.writeBits(nbits,c.r);
	this.bits.writeBits(nbits,c.g);
	this.bits.writeBits(nbits,c.b);
	this.bits.writeBits(nbits,c.a);
}
format.swf.Writer.prototype.writeClipEvents = function(events) {
	this.o.writeUInt16(0);
	var all = 0;
	{
		var _g = 0;
		while(_g < events.length) {
			var e = events[_g];
			++_g;
			all |= e.eventsFlags;
		}
	}
	this.o.writeUInt30(all);
	{
		var _g = 0;
		while(_g < events.length) {
			var e = events[_g];
			++_g;
			this.o.writeUInt30(e.eventsFlags);
			this.o.writeUInt30(e.data.length);
			this.o.write(e.data);
		}
	}
	this.o.writeUInt16(0);
}
format.swf.Writer.prototype.writeDefineEditText = function(data) {
	this.writeRect(data.bounds);
	this.bits.writeBit(data.hasText);
	this.bits.writeBit(data.wordWrap);
	this.bits.writeBit(data.multiline);
	this.bits.writeBit(data.password);
	this.bits.writeBit(data.input);
	this.bits.writeBit(data.hasTextColor);
	this.bits.writeBit(data.hasMaxLength);
	this.bits.writeBit(data.hasFont);
	this.bits.writeBit(data.hasFontClass);
	this.bits.writeBit(data.autoSize);
	this.bits.writeBit(data.hasLayout);
	this.bits.writeBit(data.selectable);
	this.bits.writeBit(data.border);
	this.bits.writeBit(data.wasStatic);
	this.bits.writeBit(data.html);
	this.bits.writeBit(data.useOutlines);
	if(data.hasFont) {
		this.o.writeUInt16(data.fontID);
		this.o.writeUInt16(data.fontHeight);
	}
	else if(data.hasFontClass) {
		this.o.writeString(data.fontClass);
		this.o.writeByte(0);
	}
	if(data.hasTextColor) this.writeRGBA(data.textColor);
	if(data.hasMaxLength) this.o.writeUInt16(data.maxLength);
	if(data.hasLayout) {
		this.o.writeByte(data.align);
		this.o.writeUInt16(data.leftMargin);
		this.o.writeUInt16(data.rightMargin);
		this.o.writeUInt16(data.indent);
		this.o.writeInt16(data.leading);
	}
	this.o.writeString(data.variableName);
	this.o.writeByte(0);
	if(data.hasText) {
		this.o.writeString(data.initialText);
		this.o.writeByte(0);
	}
}
format.swf.Writer.prototype.writeEnd = function() {
	this.o.writeUInt16(0);
	var bytes = this.o.getBytes();
	var size = bytes.length;
	if(this.compressed) bytes = format.tools.Deflate.run(bytes);
	this.output.writeUInt30(size + 8);
	this.output.write(bytes);
}
format.swf.Writer.prototype.writeEnvelopeRecords = function(soundEnvelopes) {
	var _g1 = 0, _g = soundEnvelopes.length;
	while(_g1 < _g) {
		var env = _g1++;
		this.o.writeUInt30(soundEnvelopes[env].pos44);
		this.o.writeUInt16(soundEnvelopes[env].leftLevel);
		this.o.writeUInt16(soundEnvelopes[env].rightLevel);
	}
}
format.swf.Writer.prototype.writeFileAttributes = function(att) {
	this.bits.writeBit(false);
	this.bits.writeBit(att.useDirectBlit);
	this.bits.writeBit(att.useGPU);
	this.bits.writeBit(att.hasMetaData);
	this.bits.writeBit(att.actionscript3);
	this.bits.writeBits(2,0);
	this.bits.writeBit(att.useNetWork);
	this.bits.writeBits(24,0);
}
format.swf.Writer.prototype.writeFillStyle = function(ver,fill_style) {
	var $e = (fill_style);
	switch( $e[1] ) {
	case 0:
	var rgb = $e[2];
	{
		if(ver > 2) throw "Fill styles with Shape versions higher than 2 reqire alhpa channel!";
		this.o.writeByte(0);
		this.writeRGB(rgb);
	}break;
	case 1:
	var rgba = $e[2];
	{
		if(ver < 3) throw "Fill styles with Shape versions lower than 3 doesn't support alhpa channel!";
		this.o.writeByte(0);
		this.writeRGBA(rgba);
	}break;
	case 2:
	var grad = $e[3], mat = $e[2];
	{
		this.o.writeByte(16);
		this.writeMatrix(mat);
		this.writeGradient(ver,grad);
	}break;
	case 3:
	var grad = $e[3], mat = $e[2];
	{
		this.o.writeByte(18);
		this.writeMatrix(mat);
		this.writeGradient(ver,grad);
	}break;
	case 4:
	var grad = $e[3], mat = $e[2];
	{
		if(ver > 3) throw "Focal gradient fill style only supported with Shape versions higher than 3!";
		this.o.writeByte(19);
		this.writeMatrix(mat);
		this.writeFocalGradient(ver,grad);
	}break;
	case 5:
	var smooth = $e[5], repeat = $e[4], mat = $e[3], cid = $e[2];
	{
		this.o.writeByte((repeat?(smooth?64:66):(smooth?65:67)));
		this.o.writeUInt16(cid);
		this.writeMatrix(mat);
	}break;
	}
}
format.swf.Writer.prototype.writeFillStyles = function(ver,fill_styles) {
	var num_styles = fill_styles.length;
	this.bits.flush();
	if(num_styles > 254) {
		if(ver >= 2) {
			this.o.writeByte(255);
			this.o.writeUInt16(num_styles);
		}
		else if(num_styles == 255) this.o.writeByte(255);
		else throw "Too much fill styles (" + num_styles + ") for Shape version 1";
	}
	else this.o.writeByte(num_styles);
	{
		var _g = 0;
		while(_g < fill_styles.length) {
			var style = fill_styles[_g];
			++_g;
			this.writeFillStyle(ver,style);
		}
	}
}
format.swf.Writer.prototype.writeFilter = function(f) {
	var $e = (f);
	switch( $e[1] ) {
	case 0:
	var d = $e[2];
	{
		this.o.writeByte(0);
		this.writeRGBA(d.color);
		this.o.writeInt32(d.blurX);
		this.o.writeInt32(d.blurY);
		this.o.writeInt32(d.angle);
		this.o.writeInt32(d.distance);
		this.o.writeUInt16(d.strength);
		this.writeFilterFlags(d.flags,false);
	}break;
	case 1:
	var d = $e[2];
	{
		this.o.writeByte(1);
		this.o.writeInt32(d.blurX);
		this.o.writeInt32(d.blurY);
		this.o.writeByte(d.passes << 3);
	}break;
	case 2:
	var d = $e[2];
	{
		this.o.writeByte(2);
		this.writeRGBA(d.color);
		this.o.writeInt32(d.blurX);
		this.o.writeInt32(d.blurY);
		this.o.writeUInt16(d.strength);
		this.writeFilterFlags(d.flags,false);
	}break;
	case 3:
	var d = $e[2];
	{
		this.o.writeByte(3);
		this.writeRGBA(d.color);
		this.writeRGBA(d.color2);
		this.o.writeInt32(d.blurX);
		this.o.writeInt32(d.blurY);
		this.o.writeInt32(d.angle);
		this.o.writeInt32(d.distance);
		this.o.writeUInt16(d.strength);
		this.writeFilterFlags(d.flags,true);
	}break;
	case 4:
	var d = $e[2];
	{
		this.o.writeByte(5);
		this.writeFilterGradient(d);
	}break;
	case 5:
	var d = $e[2];
	{
		this.o.writeByte(6);
		{
			var _g = 0;
			while(_g < d.length) {
				var f1 = d[_g];
				++_g;
				this.o.writeFloat(f1);
			}
		}
	}break;
	case 6:
	var d = $e[2];
	{
		this.o.writeByte(7);
		this.writeFilterGradient(d);
	}break;
	}
}
format.swf.Writer.prototype.writeFilterFlags = function(f,top) {
	var flags = 32;
	if(f.inner) flags |= 128;
	if(f.knockout) flags |= 64;
	if(f.ontop) flags |= 16;
	flags |= f.passes;
	this.o.writeByte(flags);
}
format.swf.Writer.prototype.writeFilterGradient = function(f) {
	this.o.writeByte(f.colors.length);
	{
		var _g = 0, _g1 = f.colors;
		while(_g < _g1.length) {
			var c = _g1[_g];
			++_g;
			this.writeRGBA(c.color);
		}
	}
	{
		var _g = 0, _g1 = f.colors;
		while(_g < _g1.length) {
			var c = _g1[_g];
			++_g;
			this.o.writeByte(c.position);
		}
	}
	var d = f.data;
	this.o.writeInt32(d.blurX);
	this.o.writeInt32(d.blurY);
	this.o.writeInt32(d.angle);
	this.o.writeInt32(d.distance);
	this.o.writeUInt16(d.strength);
	this.writeFilterFlags(d.flags,true);
}
format.swf.Writer.prototype.writeFilters = function(filters) {
	this.o.writeByte(filters.length);
	{
		var _g = 0;
		while(_g < filters.length) {
			var f = filters[_g];
			++_g;
			this.writeFilter(f);
		}
	}
}
format.swf.Writer.prototype.writeFixed = function(v) {
	this.o.writeInt32(v);
}
format.swf.Writer.prototype.writeFixed8 = function(v) {
	this.o.writeUInt16(v);
}
format.swf.Writer.prototype.writeFocalGradient = function(ver,grad) {
	if(ver < 4) throw "Focal gradient only supported in shape versions higher than 3!";
	this.writeGradient(ver,grad.data);
	this.o.writeUInt16(grad.focalPoint);
}
format.swf.Writer.prototype.writeFont = function(id,data) {
	var old = this.openTMP();
	this.o.writeUInt16(id);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var data1 = $e[2];
	{
		this.writeFont1(data1);
	}break;
	case 1:
	var data1 = $e[3], hasWideChars = $e[2];
	{
		this.writeFont2(hasWideChars,data1);
	}break;
	case 2:
	var data1 = $e[2];
	{
		this.writeFont2(true,data1);
	}break;
	}
	this.bits.flush();
	var font_data = this.closeTMP(old);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var data1 = $e[2];
	{
		this.writeTID(10,font_data.length);
	}break;
	case 1:
	var data1 = $e[3], hasWideChars = $e[2];
	{
		this.writeTID(48,font_data.length);
	}break;
	case 2:
	var data1 = $e[2];
	{
		this.writeTID(75,font_data.length);
	}break;
	}
	this.o.write(font_data);
}
format.swf.Writer.prototype.writeFont1 = function(data) {
	var old = this.openTMP();
	var offset_table = this.writeFontGlyphs(data.glyphs);
	if(offset_table.length * 2 + offset_table[offset_table.length - 1] > 65535) throw "Font version 1 only supports font sizes up to 64kB!";
	this.bits.flush();
	var shape_data = this.closeTMP(old);
	var first_glyph_offset = offset_table.length * 2;
	{
		var _g = 0;
		while(_g < offset_table.length) {
			var offset = offset_table[_g];
			++_g;
			this.o.writeUInt16(first_glyph_offset + offset);
		}
	}
	this.o.write(shape_data);
}
format.swf.Writer.prototype.writeFont2 = function(hasWideChars,data) {
	var glyphs = new Array();
	var num_glyphs = data.glyphs.length;
	{
		var _g = 0, _g1 = data.glyphs;
		while(_g < _g1.length) {
			var glyph = _g1[_g];
			++_g;
			glyphs.push(glyph.shape);
		}
	}
	var old = this.openTMP();
	var offset_table = this.writeFontGlyphs(glyphs);
	this.bits.flush();
	var shape_data = this.closeTMP(old);
	var hasWideOffsets = offset_table.length * 2 + 2 + shape_data.length > 65535;
	this.bits.writeBit(data.layout != null);
	this.bits.writeBit(data.shiftJIS);
	this.bits.writeBit(data.isSmall);
	this.bits.writeBit(data.isANSI);
	this.bits.writeBit(hasWideOffsets);
	this.bits.writeBit(hasWideChars);
	this.bits.writeBit(data.isItalic);
	this.bits.writeBit(data.isBold);
	this.bits.flush();
	this.o.writeByte((function($this) {
		var $r;
		var $e = (data.language);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		case 3:
		{
			$r = 3;
		}break;
		case 4:
		{
			$r = 4;
		}break;
		case 5:
		{
			$r = 5;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	this.o.writeByte(data.name.length);
	this.o.writeString(data.name);
	this.o.writeUInt16(num_glyphs);
	if(hasWideOffsets) {
		var first_glyph_offset = num_glyphs * 4 + 4;
		{
			var _g = 0;
			while(_g < offset_table.length) {
				var offset = offset_table[_g];
				++_g;
				this.o.writeUInt30(first_glyph_offset + offset);
			}
		}
		this.o.writeUInt30(first_glyph_offset + shape_data.length);
	}
	else {
		var first_glyph_offset = num_glyphs * 2 + 2;
		{
			var _g = 0;
			while(_g < offset_table.length) {
				var offset = offset_table[_g];
				++_g;
				this.o.writeUInt16(first_glyph_offset + offset);
			}
		}
		this.o.writeUInt16(first_glyph_offset + shape_data.length);
	}
	this.o.write(shape_data);
	if(hasWideChars) {
		{
			var _g = 0, _g1 = data.glyphs;
			while(_g < _g1.length) {
				var glyph = _g1[_g];
				++_g;
				this.o.writeUInt16(glyph.charCode);
			}
		}
	}
	else {
		{
			var _g = 0, _g1 = data.glyphs;
			while(_g < _g1.length) {
				var glyph = _g1[_g];
				++_g;
				this.o.writeByte(glyph.charCode);
			}
		}
	}
	if(data.layout != null) {
		this.o.writeInt16(data.layout.ascent);
		this.o.writeInt16(data.layout.descent);
		this.o.writeInt16(data.layout.leading);
		{
			var _g = 0, _g1 = data.layout.glyphs;
			while(_g < _g1.length) {
				var g = _g1[_g];
				++_g;
				this.o.writeInt16(g.advance);
			}
		}
		{
			var _g = 0, _g1 = data.layout.glyphs;
			while(_g < _g1.length) {
				var g = _g1[_g];
				++_g;
				this.writeRect(g.bounds);
			}
		}
		this.o.writeUInt16(data.layout.kerning.length);
		if(hasWideChars) {
			{
				var _g = 0, _g1 = data.layout.kerning;
				while(_g < _g1.length) {
					var k = _g1[_g];
					++_g;
					this.o.writeUInt16(k.charCode1);
					this.o.writeUInt16(k.charCode2);
					this.o.writeInt16(k.adjust);
				}
			}
		}
		else {
			{
				var _g = 0, _g1 = data.layout.kerning;
				while(_g < _g1.length) {
					var k = _g1[_g];
					++_g;
					this.o.writeByte(k.charCode1);
					this.o.writeByte(k.charCode2);
					this.o.writeInt16(k.adjust);
				}
			}
		}
	}
}
format.swf.Writer.prototype.writeFontGlyphs = function(glyphs) {
	var old = this.openTMP();
	var offsets = new Array();
	var offs = 0;
	{
		var _g = 0;
		while(_g < glyphs.length) {
			var shape = glyphs[_g];
			++_g;
			offsets.push(offs);
			var old1 = this.openTMP();
			this.writeShapeWithoutStyle(1,shape);
			this.bits.flush();
			var shape_data = this.closeTMP(old1);
			this.o.write(shape_data);
			offs += shape_data.length;
		}
	}
	var glyph_data = this.closeTMP(old);
	this.o.write(glyph_data);
	return offsets;
}
format.swf.Writer.prototype.writeFontInfo = function(id,data) {
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var data1 = $e[5], hasWideCodes = $e[4], isANSI = $e[3], shiftJIS = $e[2];
	{
		var data_length = (hasWideCodes?4 + data1.name.length + data1.codeTable.length * 2:4 + data1.name.length + data1.codeTable.length);
		this.writeTID(13,data_length);
		this.o.writeUInt16(id);
		this.o.writeByte(data1.name.length);
		this.o.writeString(data1.name);
		this.bits.writeBits(2,0);
		this.bits.writeBit(data1.isSmall);
		this.bits.writeBit(shiftJIS);
		this.bits.writeBit(isANSI);
		this.bits.writeBit(data1.isItalic);
		this.bits.writeBit(data1.isBold);
		this.bits.writeBit(hasWideCodes);
		if(hasWideCodes) {
			{
				var _g = 0, _g1 = data1.codeTable;
				while(_g < _g1.length) {
					var code = _g1[_g];
					++_g;
					this.o.writeUInt16(code);
				}
			}
		}
		else {
			{
				var _g = 0, _g1 = data1.codeTable;
				while(_g < _g1.length) {
					var code = _g1[_g];
					++_g;
					this.o.writeByte(code);
				}
			}
		}
	}break;
	case 1:
	var data1 = $e[3], language = $e[2];
	{
		this.writeTID(13,5 + data1.name.length + data1.codeTable.length * 2);
		this.o.writeUInt16(id);
		this.o.writeByte(data1.name.length);
		this.o.writeString(data1.name);
		this.bits.writeBits(2,0);
		this.bits.writeBit(data1.isSmall);
		this.bits.writeBit(false);
		this.bits.writeBit(false);
		this.bits.writeBit(data1.isItalic);
		this.bits.writeBit(data1.isBold);
		this.bits.writeBit(true);
		this.o.writeByte((function($this) {
			var $r;
			var $e = (language);
			switch( $e[1] ) {
			case 0:
			{
				$r = 0;
			}break;
			case 1:
			{
				$r = 1;
			}break;
			case 2:
			{
				$r = 2;
			}break;
			case 3:
			{
				$r = 3;
			}break;
			case 4:
			{
				$r = 4;
			}break;
			case 5:
			{
				$r = 5;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)));
		{
			var _g = 0, _g1 = data1.codeTable;
			while(_g < _g1.length) {
				var code = _g1[_g];
				++_g;
				this.o.writeUInt16(code);
			}
		}
	}break;
	}
}
format.swf.Writer.prototype.writeGradRecord = function(ver,grad_record) {
	var $e = (grad_record);
	switch( $e[1] ) {
	case 0:
	var col = $e[3], pos = $e[2];
	{
		if(ver > 2) throw "Shape versions higher than 2 require alpha channel in gradient control points!";
		this.o.writeByte(pos);
		this.writeRGB(col);
	}break;
	case 1:
	var col = $e[3], pos = $e[2];
	{
		if(ver < 3) throw "Shape versions lower than 3 don't support alpha channel in gradient control points!";
		this.o.writeByte(pos);
		this.writeRGBA(col);
	}break;
	}
}
format.swf.Writer.prototype.writeGradient = function(ver,grad) {
	var spread_mode = (function($this) {
		var $r;
		var $e = (grad.spread);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		case 3:
		{
			$r = 3;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	var interpolation_mode = (function($this) {
		var $r;
		var $e = (grad.interpolate);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		case 3:
		{
			$r = 3;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	if(ver < 4 && (spread_mode != 0 || interpolation_mode != 0)) throw "Spread must be Pad and interpolation mode must be Normal RGB in gradient specification when shape version is lower than 4!";
	var num_records = grad.data.length;
	if(ver < 4) {
		if(num_records > 8) throw "Gradient supports at most 8 control points (" + num_records + " has bee given) when shape verison is lower than 4!";
	}
	else if(num_records > 15) throw "Gradient supports at most 15 control points (" + num_records + " has been given) at shape version 4!";
	this.bits.writeBits(2,spread_mode);
	this.bits.writeBits(2,interpolation_mode);
	this.bits.writeBits(4,num_records);
	this.bits.flush();
	{
		var _g = 0, _g1 = grad.data;
		while(_g < _g1.length) {
			var grad_record = _g1[_g];
			++_g;
			this.writeGradRecord(ver,grad_record);
		}
	}
}
format.swf.Writer.prototype.writeHeader = function(h) {
	this.compressed = h.compressed;
	this.output.writeString((this.compressed?"CWS":"FWS"));
	this.output.writeByte(h.version);
	this.o = new haxe.io.BytesOutput();
	this.bits = new format.tools.BitsOutput(this.o);
	this.writeRect({ left : 0, top : 0, right : h.width * 20, bottom : h.height * 20});
	this.o.writeByte(0);
	this.o.writeByte(h.fps);
	this.o.writeUInt16(h.nframes);
}
format.swf.Writer.prototype.writeLineStyle = function(ver,line_style) {
	this.o.writeUInt16(line_style.width);
	var $e = (line_style.data);
	switch( $e[1] ) {
	case 0:
	var rgb = $e[2];
	{
		if(ver > 2) throw "Line styles with Shape versions higher than 2 reqire alhpa channel!";
		this.writeRGB(rgb);
	}break;
	case 1:
	var rgba = $e[2];
	{
		if(ver < 3) throw "Line styles with Shape versions lower than 3 doesn't support alhpa channel!";
		this.writeRGBA(rgba);
	}break;
	case 2:
	var data = $e[2];
	{
		if(ver < 4) throw "LineStyle version 2 only supported in shape versions higher than 3!";
		this.bits.writeBits(2,(function($this) {
			var $r;
			var $e = (data.startCap);
			switch( $e[1] ) {
			case 0:
			{
				$r = 0;
			}break;
			case 1:
			{
				$r = 1;
			}break;
			case 2:
			{
				$r = 2;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)));
		this.bits.writeBits(2,(function($this) {
			var $r;
			var $e = (data.join);
			switch( $e[1] ) {
			case 0:
			{
				$r = 0;
			}break;
			case 1:
			{
				$r = 1;
			}break;
			case 2:
			var limitFactor = $e[2];
			{
				$r = 2;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)));
		this.bits.writeBit((function($this) {
			var $r;
			var $e = (data.fill);
			switch( $e[1] ) {
			case 0:
			var color = $e[2];
			{
				$r = false;
			}break;
			case 1:
			var style = $e[2];
			{
				$r = true;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)));
		this.bits.writeBit(data.noHScale);
		this.bits.writeBit(data.noVScale);
		this.bits.writeBit(data.pixelHinting);
		this.bits.writeBits(5,0);
		this.bits.writeBit(data.noClose);
		this.bits.writeBits(2,(function($this) {
			var $r;
			var $e = (data.endCap);
			switch( $e[1] ) {
			case 0:
			{
				$r = 0;
			}break;
			case 1:
			{
				$r = 1;
			}break;
			case 2:
			{
				$r = 2;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)));
		var $e = (data.join);
		switch( $e[1] ) {
		case 2:
		var limitFactor = $e[2];
		{
			this.o.writeUInt16(limitFactor);
		}break;
		default:{
			null;
		}break;
		}
		var $e = (data.fill);
		switch( $e[1] ) {
		case 0:
		var color = $e[2];
		{
			this.writeRGBA(color);
		}break;
		case 1:
		var style = $e[2];
		{
			this.writeFillStyle(ver,style);
		}break;
		}
	}break;
	}
}
format.swf.Writer.prototype.writeLineStyles = function(ver,line_styles) {
	var num_styles = line_styles.length;
	this.bits.flush();
	if(num_styles > 254) {
		if(ver >= 2) {
			this.o.writeByte(255);
			this.o.writeUInt16(num_styles);
		}
		else if(num_styles == 255) this.o.writeByte(255);
		else throw "Too much line styles (" + num_styles + ") for Shape version 1";
	}
	else this.o.writeByte(num_styles);
	{
		var _g = 0;
		while(_g < line_styles.length) {
			var style = line_styles[_g];
			++_g;
			this.writeLineStyle(ver,style);
		}
	}
}
format.swf.Writer.prototype.writeMatrix = function(m) {
	this.bits.flush();
	if(m.scale != null) {
		this.bits.writeBit(true);
		var sx = format.swf.Tools.toFixed16(m.scale.x);
		var sy = format.swf.Tools.toFixed16(m.scale.y);
		var nbits = format.swf.Tools.minBits([sx,sy]) + 1;
		this.bits.writeBits(5,nbits);
		this.bits.writeBits(nbits,sx);
		this.bits.writeBits(nbits,sy);
	}
	else this.bits.writeBit(false);
	if(m.rotate != null) {
		this.bits.writeBit(true);
		var rs0 = format.swf.Tools.toFixed16(m.rotate.rs0);
		var rs1 = format.swf.Tools.toFixed16(m.rotate.rs1);
		var nbits = format.swf.Tools.minBits([rs0,rs1]) + 1;
		this.bits.writeBits(5,nbits);
		this.bits.writeBits(nbits,rs0);
		this.bits.writeBits(nbits,rs1);
	}
	else this.bits.writeBit(false);
	var nbits = format.swf.Tools.minBits([m.translate.x,m.translate.y]) + 1;
	this.bits.writeBits(5,nbits);
	this.bits.writeBits(nbits,m.translate.x);
	this.bits.writeBits(nbits,m.translate.y);
	this.bits.flush();
}
format.swf.Writer.prototype.writeMorph1LineStyle = function(s) {
	this.o.writeUInt16(s.startWidth);
	this.o.writeUInt16(s.endWidth);
	this.writeRGBA(s.startColor);
	this.writeRGBA(s.endColor);
}
format.swf.Writer.prototype.writeMorph1LineStyles = function(line_styles) {
	var num_styles = line_styles.length;
	this.bits.flush();
	if(num_styles > 254) {
		this.o.writeByte(255);
		this.o.writeUInt16(num_styles);
	}
	else this.o.writeByte(num_styles);
	{
		var _g = 0;
		while(_g < line_styles.length) {
			var style = line_styles[_g];
			++_g;
			this.writeMorph1LineStyle(style);
		}
	}
}
format.swf.Writer.prototype.writeMorph2LineStyle = function(style) {
	var m2data;
	var $e = (style);
	switch( $e[1] ) {
	case 0:
	var data = $e[4], endColor = $e[3], startColor = $e[2];
	{
		m2data = data;
	}break;
	case 1:
	var data = $e[3], fill = $e[2];
	{
		m2data = data;
	}break;
	}
	this.o.writeUInt16(m2data.startWidth);
	this.o.writeUInt16(m2data.endWidth);
	this.bits.writeBits(2,(function($this) {
		var $r;
		var $e = (m2data.startCapStyle);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	this.bits.writeBits(2,(function($this) {
		var $r;
		var $e = (m2data.joinStyle);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		var limitFactor = $e[2];
		{
			$r = 2;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	var $e = (style);
	switch( $e[1] ) {
	case 0:
	var data = $e[4], endColor = $e[3], startColor = $e[2];
	{
		this.bits.writeBit(false);
	}break;
	case 1:
	var data = $e[3], fill = $e[2];
	{
		this.bits.writeBit(true);
	}break;
	}
	this.bits.writeBit(m2data.noHScale);
	this.bits.writeBit(m2data.noVScale);
	this.bits.writeBit(m2data.pixelHinting);
	this.bits.writeBits(5,0);
	this.bits.writeBit(m2data.noClose);
	this.bits.writeBits(2,(function($this) {
		var $r;
		var $e = (m2data.endCapStyle);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	var $e = (m2data.joinStyle);
	switch( $e[1] ) {
	case 2:
	var limitFactor = $e[2];
	{
		this.o.writeUInt16(limitFactor);
	}break;
	default:{
		null;
	}break;
	}
	var $e = (style);
	switch( $e[1] ) {
	case 0:
	var data = $e[4], endColor = $e[3], startColor = $e[2];
	{
		this.writeRGBA(startColor);
		this.writeRGBA(endColor);
	}break;
	case 1:
	var data = $e[3], fill = $e[2];
	{
		this.writeMorphFillStyle(2,fill);
	}break;
	}
}
format.swf.Writer.prototype.writeMorph2LineStyles = function(line_styles) {
	var num_styles = line_styles.length;
	this.bits.flush();
	if(num_styles > 254) {
		this.o.writeByte(255);
		this.o.writeUInt16(num_styles);
	}
	else this.o.writeByte(num_styles);
	{
		var _g = 0;
		while(_g < line_styles.length) {
			var style = line_styles[_g];
			++_g;
			this.writeMorph2LineStyle(style);
		}
	}
}
format.swf.Writer.prototype.writeMorphFillStyle = function(ver,fill_style) {
	var $e = (fill_style);
	switch( $e[1] ) {
	case 0:
	var endColor = $e[3], startColor = $e[2];
	{
		this.o.writeByte(0);
		this.writeRGBA(startColor);
		this.writeRGBA(endColor);
	}break;
	case 1:
	var gradients = $e[4], endMatrix = $e[3], startMatrix = $e[2];
	{
		this.o.writeByte(16);
		this.writeMatrix(startMatrix);
		this.writeMatrix(endMatrix);
		this.writeMorphGradients(ver,gradients);
	}break;
	case 2:
	var gradients = $e[4], endMatrix = $e[3], startMatrix = $e[2];
	{
		this.o.writeByte(16);
		this.writeMatrix(startMatrix);
		this.writeMatrix(endMatrix);
		this.writeMorphGradients(ver,gradients);
	}break;
	case 3:
	var smooth = $e[6], repeat = $e[5], endMatrix = $e[4], startMatrix = $e[3], cid = $e[2];
	{
		this.o.writeByte((repeat?(smooth?64:66):(smooth?65:67)));
		this.o.writeUInt16(cid);
		this.writeMatrix(startMatrix);
		this.writeMatrix(endMatrix);
	}break;
	}
}
format.swf.Writer.prototype.writeMorphFillStyles = function(ver,fill_styles) {
	var num_styles = fill_styles.length;
	this.bits.flush();
	if(num_styles > 254) {
		this.o.writeByte(255);
		this.o.writeUInt16(num_styles);
	}
	else this.o.writeByte(num_styles);
	{
		var _g = 0;
		while(_g < fill_styles.length) {
			var style = fill_styles[_g];
			++_g;
			this.writeMorphFillStyle(ver,style);
		}
	}
}
format.swf.Writer.prototype.writeMorphGradient = function(ver,g) {
	this.o.writeByte(g.startRatio);
	this.writeRGBA(g.startColor);
	this.o.writeByte(g.endRatio);
	this.writeRGBA(g.endColor);
}
format.swf.Writer.prototype.writeMorphGradients = function(ver,gradients) {
	var num = gradients.length;
	if(num < 1 || num > 8) throw "Number of specified morph gradients (" + num + ") must be in range 1..8";
	{
		var _g = 0;
		while(_g < gradients.length) {
			var grad = gradients[_g];
			++_g;
			this.writeMorphGradient(ver,grad);
		}
	}
}
format.swf.Writer.prototype.writeMorphShape = function(id,data) {
	var old = this.openTMP();
	this.o.writeUInt16(id);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var sh1data = $e[2];
	{
		this.writeRect(sh1data.startBounds);
		this.writeRect(sh1data.endBounds);
		var old1 = this.openTMP();
		this.writeMorphFillStyles(1,sh1data.fillStyles);
		this.writeMorph1LineStyles(sh1data.lineStyles);
		this.writeShapeWithoutStyle(3,sh1data.startEdges);
		this.bits.flush();
		var part_data = this.closeTMP(old1);
		this.o.writeUInt30(part_data.length);
		this.o.write(part_data);
		this.writeShapeWithoutStyle(3,sh1data.endEdges);
	}break;
	case 1:
	var sh2data = $e[2];
	{
		this.writeRect(sh2data.startBounds);
		this.writeRect(sh2data.endBounds);
		this.writeRect(sh2data.startEdgeBounds);
		this.writeRect(sh2data.endEdgeBounds);
		this.bits.writeBits(6,0);
		this.bits.writeBit(sh2data.useNonScalingStrokes);
		this.bits.writeBit(sh2data.useScalingStrokes);
		this.bits.flush();
		var old1 = this.openTMP();
		this.writeMorphFillStyles(1,sh2data.fillStyles);
		this.writeMorph2LineStyles(sh2data.lineStyles);
		this.writeShapeWithoutStyle(4,sh2data.startEdges);
		this.bits.flush();
		var part_data = this.closeTMP(old1);
		this.o.writeUInt30(part_data.length);
		this.o.write(part_data);
		this.writeShapeWithoutStyle(4,sh2data.endEdges);
	}break;
	}
	this.bits.flush();
	var morph_shape_data = this.closeTMP(old);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var sh1data = $e[2];
	{
		this.writeTID(46,morph_shape_data.length);
	}break;
	case 1:
	var sh2data = $e[2];
	{
		this.writeTID(84,morph_shape_data.length);
	}break;
	}
	this.o.write(morph_shape_data);
}
format.swf.Writer.prototype.writePlaceObject = function(po,v3) {
	var f = 0;
	var f2 = 0;
	if(po.move) f |= 1;
	if(po.cid != null) f |= 2;
	if(po.matrix != null) f |= 4;
	if(po.color != null) f |= 8;
	if(po.ratio != null) f |= 16;
	if(po.instanceName != null) f |= 32;
	if(po.clipDepth != null) f |= 64;
	if(po.events != null) f |= 128;
	if(po.filters != null) f2 |= 1;
	if(po.blendMode != null) f2 |= 2;
	if(po.bitmapCache) f2 |= 4;
	this.o.writeByte(f);
	if(v3) this.o.writeByte(f2);
	else if(f2 != 0) throw "Invalid place object version";
	this.o.writeUInt16(po.depth);
	if(po.cid != null) this.o.writeUInt16(po.cid);
	if(po.matrix != null) this.writeMatrix(po.matrix);
	if(po.color != null) this.writeCXA(po.color);
	if(po.ratio != null) this.o.writeUInt16(po.ratio);
	if(po.instanceName != null) {
		this.o.writeString(po.instanceName);
		this.o.writeByte(0);
	}
	if(po.clipDepth != null) this.o.writeUInt16(po.clipDepth);
	if(po.filters != null) this.writeFilters(po.filters);
	if(po.blendMode != null) this.writeBlendMode(po.blendMode);
	if(po.events != null) this.writeClipEvents(po.events);
}
format.swf.Writer.prototype.writeRGB = function(c) {
	this.o.writeByte(c.r);
	this.o.writeByte(c.g);
	this.o.writeByte(c.b);
}
format.swf.Writer.prototype.writeRGBA = function(c) {
	this.o.writeByte(c.r);
	this.o.writeByte(c.g);
	this.o.writeByte(c.b);
	this.o.writeByte(c.a);
}
format.swf.Writer.prototype.writeRect = function(r) {
	var nbits = format.swf.Tools.minBits([r.left,r.right,r.top,r.bottom]) + 1;
	this.bits.writeBits(5,nbits);
	this.bits.writeBits(nbits,r.left);
	this.bits.writeBits(nbits,r.right);
	this.bits.writeBits(nbits,r.top);
	this.bits.writeBits(nbits,r.bottom);
	this.bits.flush();
}
format.swf.Writer.prototype.writeShape = function(id,data) {
	var old = this.openTMP();
	this.o.writeUInt16(id);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeRect(bounds);
		this.writeShapeWithStyle(1,shapes);
	}break;
	case 1:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeRect(bounds);
		this.writeShapeWithStyle(2,shapes);
	}break;
	case 2:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeRect(bounds);
		this.writeShapeWithStyle(3,shapes);
	}break;
	case 3:
	var data1 = $e[2];
	{
		this.writeRect(data1.shapeBounds);
		this.writeRect(data1.edgeBounds);
		this.bits.writeBits(5,0);
		this.bits.writeBit(data1.useWinding);
		this.bits.writeBit(data1.useNonScalingStroke);
		this.bits.writeBit(data1.useScalingStroke);
		this.bits.flush();
		this.writeShapeWithStyle(4,data1.shapes);
	}break;
	}
	this.bits.flush();
	var shape_data = this.closeTMP(old);
	var $e = (data);
	switch( $e[1] ) {
	case 0:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeTID(2,shape_data.length);
	}break;
	case 1:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeTID(22,shape_data.length);
	}break;
	case 2:
	var shapes = $e[3], bounds = $e[2];
	{
		this.writeTID(32,shape_data.length);
	}break;
	case 3:
	var data1 = $e[2];
	{
		this.writeTID(83,shape_data.length);
	}break;
	}
	this.o.write(shape_data);
}
format.swf.Writer.prototype.writeShapeRecord = function(ver,style_info,shape_record) {
	var $e = (shape_record);
	switch( $e[1] ) {
	case 0:
	{
		this.bits.writeBit(false);
		this.bits.writeBits(5,0);
	}break;
	case 1:
	var data = $e[2];
	{
		this.bits.writeBit(false);
		if(data.newStyles != null) {
			if(ver == 2 || ver == 3) this.bits.writeBit(true);
			else throw "Defining new fill and line style arrays are only supported in shape version 2 and 3!";
		}
		else this.bits.writeBit(false);
		this.bits.writeBit(data.lineStyle != null);
		this.bits.writeBit(data.fillStyle1 != null);
		this.bits.writeBit(data.fillStyle0 != null);
		this.bits.writeBit(data.moveTo != null);
		if(data.moveTo != null) {
			var mb = format.swf.Tools.minBits([data.moveTo.dx,data.moveTo.dy]) + 1;
			this.bits.writeBits(5,mb);
			this.bits.writeBits(mb,data.moveTo.dx);
			this.bits.writeBits(mb,data.moveTo.dy);
		}
		if(data.fillStyle0 != null) {
			this.bits.writeBits(style_info.fillBits,data.fillStyle0.idx);
		}
		if(data.fillStyle1 != null) {
			this.bits.writeBits(style_info.fillBits,data.fillStyle1.idx);
		}
		if(data.lineStyle != null) {
			this.bits.writeBits(style_info.lineBits,data.lineStyle.idx);
		}
		if(data.newStyles != null) {
			this.writeFillStyles(ver,data.newStyles.fillStyles);
			this.writeLineStyles(ver,data.newStyles.lineStyles);
			style_info.numFillStyles += data.newStyles.fillStyles.length;
			style_info.numLineStyles += data.newStyles.lineStyles.length;
			style_info.fillBits = format.swf.Tools.minBits([style_info.numFillStyles]);
			style_info.lineBits = format.swf.Tools.minBits([style_info.numLineStyles]);
			this.bits.writeBits(4,style_info.fillBits);
			this.bits.writeBits(4,style_info.lineBits);
		}
	}break;
	case 2:
	var dy = $e[3], dx = $e[2];
	{
		this.bits.writeBit(true);
		this.bits.writeBit(true);
		var mb = format.swf.Tools.minBits([dx,dy]) + 1;
		mb = (mb < 2?0:mb - 2);
		this.bits.writeBits(4,mb);
		mb += 2;
		var is_general = (dx != 0) && (dy != 0);
		this.bits.writeBit(is_general);
		if(!is_general) {
			var is_vertical = (dx == 0);
			this.bits.writeBit(is_vertical);
			if(is_vertical) this.bits.writeBits(mb,dy);
			else this.bits.writeBits(mb,dx);
		}
		else {
			this.bits.writeBits(mb,dx);
			this.bits.writeBits(mb,dy);
		}
	}break;
	case 3:
	var ady = $e[5], adx = $e[4], cdy = $e[3], cdx = $e[2];
	{
		this.bits.writeBit(true);
		this.bits.writeBit(false);
		var mb = format.swf.Tools.minBits([cdx,cdy,adx,ady]) + 1;
		mb = (mb < 2?0:mb - 2);
		this.bits.writeBits(4,mb);
		mb += 2;
		this.bits.writeBits(mb,cdx);
		this.bits.writeBits(mb,cdy);
		this.bits.writeBits(mb,adx);
		this.bits.writeBits(mb,ady);
	}break;
	}
}
format.swf.Writer.prototype.writeShapeWithStyle = function(ver,data) {
	this.writeFillStyles(ver,data.fillStyles);
	this.writeLineStyles(ver,data.lineStyles);
	var style_info = { numFillStyles : data.fillStyles.length, fillBits : format.swf.Tools.minBits([data.fillStyles.length]), numLineStyles : data.lineStyles.length, lineBits : format.swf.Tools.minBits([data.lineStyles.length])}
	this.bits.writeBits(4,style_info.fillBits);
	this.bits.writeBits(4,style_info.lineBits);
	this.bits.flush();
	{
		var _g = 0, _g1 = data.shapeRecords;
		while(_g < _g1.length) {
			var shr = _g1[_g];
			++_g;
			this.writeShapeRecord(ver,style_info,shr);
		}
	}
	this.bits.flush();
}
format.swf.Writer.prototype.writeShapeWithoutStyle = function(ver,data) {
	var style_info = { numFillStyles : 0, fillBits : 1, numLineStyles : 0, lineBits : 1}
	this.bits.writeBits(4,style_info.fillBits);
	this.bits.writeBits(4,style_info.lineBits);
	this.bits.flush();
	{
		var _g = 0, _g1 = data.shapeRecords;
		while(_g < _g1.length) {
			var shr = _g1[_g];
			++_g;
			this.writeShapeRecord(ver,style_info,shr);
		}
	}
	this.bits.flush();
}
format.swf.Writer.prototype.writeSound = function(s) {
	var len = 7 + (function($this) {
		var $r;
		var $e = (s.data);
		switch( $e[1] ) {
		case 0:
		var data = $e[3];
		{
			$r = data.length + 2;
		}break;
		case 1:
		var data = $e[2];
		{
			$r = data.length;
		}break;
		case 2:
		var data = $e[2];
		{
			$r = data.length;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	this.writeTIDExt(14,len);
	this.o.writeUInt16(s.sid);
	this.bits.writeBits(4,(function($this) {
		var $r;
		var $e = (s.format);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		case 3:
		{
			$r = 3;
		}break;
		case 4:
		{
			$r = 4;
		}break;
		case 5:
		{
			$r = 5;
		}break;
		case 6:
		{
			$r = 6;
		}break;
		case 7:
		{
			$r = 11;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	this.bits.writeBits(2,(function($this) {
		var $r;
		var $e = (s.rate);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 1:
		{
			$r = 1;
		}break;
		case 2:
		{
			$r = 2;
		}break;
		case 3:
		{
			$r = 3;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
	this.bits.writeBit(s.is16bit);
	this.bits.writeBit(s.isStereo);
	this.bits.flush();
	this.o.writeInt32(s.samples);
	var $e = (s.data);
	switch( $e[1] ) {
	case 0:
	var data = $e[3], seek = $e[2];
	{
		this.o.writeInt16(seek);
		this.o.write(data);
	}break;
	case 1:
	var data = $e[2];
	{
		this.o.write(data);
	}break;
	case 2:
	var data = $e[2];
	{
		this.o.write(data);
	}break;
	}
}
format.swf.Writer.prototype.writeSoundInfo = function(info) {
	this.bits.writeBits(2,0);
	this.bits.writeBit(info.syncStop);
	this.bits.writeBit(false);
	this.bits.writeBit(false);
	this.bits.writeBit(info.hasLoops);
	this.bits.writeBit(false);
	this.bits.writeBit(false);
	if(info.hasLoops) this.o.writeUInt16(info.loopCount);
}
format.swf.Writer.prototype.writeSymbols = function(sl,tagid) {
	var len = 2;
	{
		var _g = 0;
		while(_g < sl.length) {
			var s = sl[_g];
			++_g;
			len += 2 + s.className.length + 1;
		}
	}
	this.writeTID(tagid,len);
	this.o.writeUInt16(sl.length);
	{
		var _g = 0;
		while(_g < sl.length) {
			var s = sl[_g];
			++_g;
			this.o.writeUInt16(s.cid);
			this.o.writeString(s.className);
			this.o.writeByte(0);
		}
	}
}
format.swf.Writer.prototype.writeTID = function(id,len) {
	var h = (id << 6);
	if(len < 63) this.o.writeUInt16(h | len);
	else {
		this.o.writeUInt16(h | 63);
		this.o.writeUInt30(len);
	}
}
format.swf.Writer.prototype.writeTIDExt = function(id,len) {
	this.o.writeUInt16((id << 6) | 63);
	this.o.writeUInt30(len);
}
format.swf.Writer.prototype.writeTag = function(t) {
	var $e = (t);
	switch( $e[1] ) {
	case 30:
	var data = $e[3], id = $e[2];
	{
		if(id == null) {
			this.o.write(data);
		}
		else {
			this.writeTID(id,data.length);
			this.o.write(data);
		}
	}break;
	case 0:
	{
		this.writeTID(1,0);
	}break;
	case 1:
	{
		this.writeTID(0,0);
	}break;
	case 2:
	var sdata = $e[3], id = $e[2];
	{
		this.writeShape(id,sdata);
	}break;
	case 3:
	var data = $e[3], id = $e[2];
	{
		this.writeMorphShape(id,data);
	}break;
	case 4:
	var data = $e[3], id = $e[2];
	{
		this.writeFont(id,data);
	}break;
	case 5:
	var data = $e[3], id = $e[2];
	{
		this.writeFontInfo(id,data);
	}break;
	case 21:
	var data = $e[3], id = $e[2];
	{
		this.writeTID(87,data.length + 6);
		this.o.writeUInt16(id);
		this.o.writeUInt30(0);
		this.o.write(data);
	}break;
	case 6:
	var color = $e[2];
	{
		this.writeTID(9,3);
		this.o.setEndian(true);
		this.o.writeUInt24(color);
		this.o.setEndian(false);
	}break;
	case 8:
	var po = $e[2];
	{
		var t1 = this.openTMP();
		this.writePlaceObject(po,false);
		var bytes = this.closeTMP(t1);
		this.writeTID(26,bytes.length);
		this.o.write(bytes);
	}break;
	case 9:
	var po = $e[2];
	{
		var t1 = this.openTMP();
		this.writePlaceObject(po,true);
		var bytes = this.closeTMP(t1);
		this.writeTID(70,bytes.length);
		this.o.write(bytes);
	}break;
	case 10:
	var depth = $e[2];
	{
		this.writeTID(28,2);
		this.o.writeUInt16(depth);
	}break;
	case 11:
	var anchor = $e[3], label = $e[2];
	{
		var length = label.length + 1 + ((anchor?1:0));
		this.writeTIDExt(43,length);
		this.o.writeString(label);
		this.o.writeByte(0);
		if(anchor) this.o.writeByte(1);
	}break;
	case 7:
	var tags = $e[4], frames = $e[3], id = $e[2];
	{
		var t1 = this.openTMP();
		{
			var _g = 0;
			while(_g < tags.length) {
				var t2 = tags[_g];
				++_g;
				this.writeTag(t2);
			}
		}
		var bytes = this.closeTMP(t1);
		this.writeTIDExt(39,bytes.length + 6);
		this.o.writeUInt16(id);
		this.o.writeUInt16(frames);
		this.o.write(bytes);
		this.o.writeUInt16(0);
	}break;
	case 12:
	var data = $e[3], id = $e[2];
	{
		this.writeTID(59,data.length + 2);
		this.o.writeUInt16(id);
		this.o.write(data);
	}break;
	case 13:
	var ctx = $e[3], data = $e[2];
	{
		if(ctx == null) this.writeTID(72,data.length);
		else {
			var len = data.length + 4 + ctx.label.length + 1;
			this.writeTID(82,len);
			this.o.writeUInt30(ctx.id);
			this.o.writeString(ctx.label);
			this.o.writeByte(0);
		}
		this.o.write(data);
	}break;
	case 14:
	var sl = $e[2];
	{
		this.writeSymbols(sl,76);
	}break;
	case 15:
	var sl = $e[2];
	{
		this.writeSymbols(sl,56);
	}break;
	case 16:
	var v = $e[2];
	{
		this.writeTID(69,4);
		this.writeFileAttributes(v);
	}break;
	case 17:
	var l = $e[2];
	{
		var cbits = (function($this) {
			var $r;
			var $e = (l.color);
			switch( $e[1] ) {
			case 0:
			var n = $e[2];
			{
				$r = n;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this));
		this.writeTIDExt(20,l.data.length + (((cbits == null)?8:7)));
		this.o.writeUInt16(l.cid);
		var $e = (l.color);
		switch( $e[1] ) {
		case 0:
		{
			this.o.writeByte(3);
		}break;
		case 1:
		{
			this.o.writeByte(4);
		}break;
		case 2:
		{
			this.o.writeByte(5);
		}break;
		default:{
			throw "assert";
		}break;
		}
		this.o.writeUInt16(l.width);
		this.o.writeUInt16(l.height);
		if(cbits != null) this.o.writeByte(cbits);
		this.o.write(l.data);
	}break;
	case 18:
	var l = $e[2];
	{
		var cbits = (function($this) {
			var $r;
			var $e = (l.color);
			switch( $e[1] ) {
			case 0:
			var n = $e[2];
			{
				$r = n;
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this));
		this.writeTIDExt(36,l.data.length + (((cbits == null)?7:8)));
		this.o.writeUInt16(l.cid);
		var $e = (l.color);
		switch( $e[1] ) {
		case 0:
		{
			this.o.writeByte(3);
		}break;
		case 1:
		{
			this.o.writeByte(4);
		}break;
		case 3:
		{
			this.o.writeByte(5);
		}break;
		default:{
			throw "assert";
		}break;
		}
		this.o.writeUInt16(l.width);
		this.o.writeUInt16(l.height);
		if(cbits != null) this.o.writeByte(cbits);
		this.o.write(l.data);
	}break;
	case 20:
	var data = $e[2];
	{
		this.writeTIDExt(8,data.length);
		this.o.write(data);
	}break;
	case 19:
	var jdata = $e[3], id = $e[2];
	{
		var $e = (jdata);
		switch( $e[1] ) {
		case 0:
		var data = $e[2];
		{
			this.writeTIDExt(6,data.length + 2);
			this.o.writeUInt16(id);
			this.o.write(data);
		}break;
		case 1:
		var data = $e[2];
		{
			this.writeTIDExt(21,data.length + 2);
			this.o.writeUInt16(id);
			this.o.write(data);
		}break;
		case 2:
		var mask = $e[3], data = $e[2];
		{
			this.writeTIDExt(35,data.length + mask.length + 6);
			this.o.writeUInt16(id);
			this.o.writeUInt30(data.length);
			this.o.write(data);
			this.o.write(mask);
		}break;
		}
	}break;
	case 22:
	var data = $e[2];
	{
		this.writeSound(data);
	}break;
	case 23:
	var soundInfo = $e[3], id = $e[2];
	{
		if(soundInfo.hasLoops) this.writeTID(15,5);
		else this.writeTID(15,3);
		this.o.writeUInt16(id);
		this.writeSoundInfo(soundInfo);
	}break;
	case 24:
	var data = $e[2];
	{
		this.writeTID(12,data.length);
		this.o.write(data);
	}break;
	case 25:
	var timeoutseconds = $e[3], maxRecursion = $e[2];
	{
		this.writeTID(65,4);
		this.o.writeUInt16(maxRecursion);
		this.o.writeUInt16(timeoutseconds);
	}break;
	case 26:
	var buttonRecords = $e[3], id = $e[2];
	{
		var t1 = this.openTMP();
		{
			var _g = 0;
			while(_g < buttonRecords.length) {
				var t2 = buttonRecords[_g];
				++_g;
				this.writeButtonRecord(t2);
			}
		}
		var bytes = this.closeTMP(t1);
		this.writeTID(34,bytes.length + 6);
		this.o.writeUInt16(id);
		this.o.writeByte(0);
		this.o.writeUInt16(0);
		this.o.write(bytes);
		this.o.writeByte(0);
	}break;
	case 27:
	var data = $e[3], id = $e[2];
	{
		var t1 = this.openTMP();
		this.writeDefineEditText(data);
		var bytes = this.closeTMP(t1);
		this.writeTID(37,bytes.length + 2);
		this.o.writeUInt16(id);
		this.o.write(bytes);
	}break;
	case 28:
	var data = $e[2];
	{
		this.writeTID(77,data.length + 1);
		this.o.writeString(data);
		this.o.writeByte(0);
	}break;
	case 29:
	var splitter = $e[3], id = $e[2];
	{
		var t1 = this.openTMP();
		this.writeRect(splitter);
		var bytes = this.closeTMP(t1);
		this.writeTID(78,bytes.length + 2);
		this.o.writeUInt16(id);
		this.o.write(bytes);
	}break;
	}
}
format.swf.Writer.prototype.__class__ = format.swf.Writer;
format.abc.Index = { __ename__ : ["format","abc","Index"], __constructs__ : ["Idx"] }
format.abc.Index.Idx = function(v) { var $x = ["Idx",0,v]; $x.__enum__ = format.abc.Index; $x.toString = $estr; return $x; }
format.abc.Namespace = { __ename__ : ["format","abc","Namespace"], __constructs__ : ["NPrivate","NNamespace","NPublic","NInternal","NProtected","NExplicit","NStaticProtected"] }
format.abc.Namespace.NExplicit = function(ns) { var $x = ["NExplicit",5,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NInternal = function(ns) { var $x = ["NInternal",3,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NNamespace = function(ns) { var $x = ["NNamespace",1,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NPrivate = function(ns) { var $x = ["NPrivate",0,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NProtected = function(ns) { var $x = ["NProtected",4,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NPublic = function(ns) { var $x = ["NPublic",2,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Namespace.NStaticProtected = function(ns) { var $x = ["NStaticProtected",6,ns]; $x.__enum__ = format.abc.Namespace; $x.toString = $estr; return $x; }
format.abc.Name = { __ename__ : ["format","abc","Name"], __constructs__ : ["NName","NMulti","NRuntime","NRuntimeLate","NMultiLate","NAttrib","NParams"] }
format.abc.Name.NAttrib = function(n) { var $x = ["NAttrib",5,n]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NMulti = function(name,ns) { var $x = ["NMulti",1,name,ns]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NMultiLate = function(nset) { var $x = ["NMultiLate",4,nset]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NName = function(name,ns) { var $x = ["NName",0,name,ns]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NParams = function(n,params) { var $x = ["NParams",6,n,params]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NRuntime = function(name) { var $x = ["NRuntime",2,name]; $x.__enum__ = format.abc.Name; $x.toString = $estr; return $x; }
format.abc.Name.NRuntimeLate = ["NRuntimeLate",3];
format.abc.Name.NRuntimeLate.toString = $estr;
format.abc.Name.NRuntimeLate.__enum__ = format.abc.Name;
format.abc.Value = { __ename__ : ["format","abc","Value"], __constructs__ : ["VNull","VBool","VString","VInt","VUInt","VFloat","VNamespace"] }
format.abc.Value.VBool = function(b) { var $x = ["VBool",1,b]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.Value.VFloat = function(f) { var $x = ["VFloat",5,f]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.Value.VInt = function(i) { var $x = ["VInt",3,i]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.Value.VNamespace = function(kind,ns) { var $x = ["VNamespace",6,kind,ns]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.Value.VNull = ["VNull",0];
format.abc.Value.VNull.toString = $estr;
format.abc.Value.VNull.__enum__ = format.abc.Value;
format.abc.Value.VString = function(i) { var $x = ["VString",2,i]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.Value.VUInt = function(i) { var $x = ["VUInt",4,i]; $x.__enum__ = format.abc.Value; $x.toString = $estr; return $x; }
format.abc.MethodKind = { __ename__ : ["format","abc","MethodKind"], __constructs__ : ["KNormal","KGetter","KSetter"] }
format.abc.MethodKind.KGetter = ["KGetter",1];
format.abc.MethodKind.KGetter.toString = $estr;
format.abc.MethodKind.KGetter.__enum__ = format.abc.MethodKind;
format.abc.MethodKind.KNormal = ["KNormal",0];
format.abc.MethodKind.KNormal.toString = $estr;
format.abc.MethodKind.KNormal.__enum__ = format.abc.MethodKind;
format.abc.MethodKind.KSetter = ["KSetter",2];
format.abc.MethodKind.KSetter.toString = $estr;
format.abc.MethodKind.KSetter.__enum__ = format.abc.MethodKind;
format.abc.FieldKind = { __ename__ : ["format","abc","FieldKind"], __constructs__ : ["FVar","FMethod","FClass","FFunction"] }
format.abc.FieldKind.FClass = function(c) { var $x = ["FClass",2,c]; $x.__enum__ = format.abc.FieldKind; $x.toString = $estr; return $x; }
format.abc.FieldKind.FFunction = function(f) { var $x = ["FFunction",3,f]; $x.__enum__ = format.abc.FieldKind; $x.toString = $estr; return $x; }
format.abc.FieldKind.FMethod = function(type,k,isFinal,isOverride) { var $x = ["FMethod",1,type,k,isFinal,isOverride]; $x.__enum__ = format.abc.FieldKind; $x.toString = $estr; return $x; }
format.abc.FieldKind.FVar = function(type,value,const) { var $x = ["FVar",0,type,value,const]; $x.__enum__ = format.abc.FieldKind; $x.toString = $estr; return $x; }
format.abc.ABCData = function(p) { if( p === $_ ) return; {
	null;
}}
format.abc.ABCData.__name__ = ["format","abc","ABCData"];
format.abc.ABCData.prototype.classes = null;
format.abc.ABCData.prototype.floats = null;
format.abc.ABCData.prototype.functions = null;
format.abc.ABCData.prototype.get = function(t,i) {
	return (function($this) {
		var $r;
		var $e = (i);
		switch( $e[1] ) {
		case 0:
		var n = $e[2];
		{
			$r = t[n - 1];
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.abc.ABCData.prototype.inits = null;
format.abc.ABCData.prototype.ints = null;
format.abc.ABCData.prototype.metadatas = null;
format.abc.ABCData.prototype.methodTypes = null;
format.abc.ABCData.prototype.names = null;
format.abc.ABCData.prototype.namespaces = null;
format.abc.ABCData.prototype.nssets = null;
format.abc.ABCData.prototype.strings = null;
format.abc.ABCData.prototype.uints = null;
format.abc.ABCData.prototype.__class__ = format.abc.ABCData;
format.abc.OpCode = { __ename__ : ["format","abc","OpCode"], __constructs__ : ["OBreakPoint","ONop","OThrow","OGetSuper","OSetSuper","ODxNs","ODxNsLate","ORegKill","OLabel","OLabel2","OJump","OJump2","OJump3","OSwitch","OPushWith","OPopScope","OForIn","OHasNext","ONull","OUndefined","OForEach","OSmallInt","OInt","OTrue","OFalse","ONaN","OPop","ODup","OSwap","OString","OIntRef","OUIntRef","OFloat","OScope","ONamespace","ONext","OFunction","OCallStack","OConstruct","OCallMethod","OCallStatic","OCallSuper","OCallProperty","ORetVoid","ORet","OConstructSuper","OConstructProperty","OCallPropLex","OCallSuperVoid","OCallPropVoid","OApplyType","OObject","OArray","ONewBlock","OClassDef","OGetDescendants","OCatch","OFindPropStrict","OFindProp","OFindDefinition","OGetLex","OSetProp","OReg","OSetReg","OGetGlobalScope","OGetScope","OGetProp","OInitProp","ODeleteProp","OGetSlot","OSetSlot","OGetGlobalSlot","OSetGlobalSlot","OToString","OToXml","OToXmlAttr","OToInt","OToUInt","OToNumber","OToBool","OToObject","OCheckIsXml","OCast","OAsAny","OAsString","OAsType","OAsObject","OIncrReg","ODecrReg","OTypeof","OInstanceOf","OIsType","OIncrIReg","ODecrIReg","OThis","OSetThis","ODebugReg","ODebugLine","ODebugFile","OBreakPointLine","OTimestamp","OOp","OUnknown"] }
format.abc.OpCode.OApplyType = function(nargs) { var $x = ["OApplyType",50,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OArray = function(nvalues) { var $x = ["OArray",52,nvalues]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OAsAny = ["OAsAny",83];
format.abc.OpCode.OAsAny.toString = $estr;
format.abc.OpCode.OAsAny.__enum__ = format.abc.OpCode;
format.abc.OpCode.OAsObject = ["OAsObject",86];
format.abc.OpCode.OAsObject.toString = $estr;
format.abc.OpCode.OAsObject.__enum__ = format.abc.OpCode;
format.abc.OpCode.OAsString = ["OAsString",84];
format.abc.OpCode.OAsString.toString = $estr;
format.abc.OpCode.OAsString.__enum__ = format.abc.OpCode;
format.abc.OpCode.OAsType = function(t) { var $x = ["OAsType",85,t]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OBreakPoint = ["OBreakPoint",0];
format.abc.OpCode.OBreakPoint.toString = $estr;
format.abc.OpCode.OBreakPoint.__enum__ = format.abc.OpCode;
format.abc.OpCode.OBreakPointLine = function(n) { var $x = ["OBreakPointLine",99,n]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallMethod = function(slot,nargs) { var $x = ["OCallMethod",39,slot,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallPropLex = function(name,nargs) { var $x = ["OCallPropLex",47,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallPropVoid = function(name,nargs) { var $x = ["OCallPropVoid",49,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallProperty = function(name,nargs) { var $x = ["OCallProperty",42,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallStack = function(nargs) { var $x = ["OCallStack",37,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallStatic = function(meth,nargs) { var $x = ["OCallStatic",40,meth,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallSuper = function(name,nargs) { var $x = ["OCallSuper",41,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCallSuperVoid = function(name,nargs) { var $x = ["OCallSuperVoid",48,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCast = function(t) { var $x = ["OCast",82,t]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCatch = function(c) { var $x = ["OCatch",56,c]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OCheckIsXml = ["OCheckIsXml",81];
format.abc.OpCode.OCheckIsXml.toString = $estr;
format.abc.OpCode.OCheckIsXml.__enum__ = format.abc.OpCode;
format.abc.OpCode.OClassDef = function(c) { var $x = ["OClassDef",54,c]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OConstruct = function(nargs) { var $x = ["OConstruct",38,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OConstructProperty = function(name,nargs) { var $x = ["OConstructProperty",46,name,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OConstructSuper = function(nargs) { var $x = ["OConstructSuper",45,nargs]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODebugFile = function(file) { var $x = ["ODebugFile",98,file]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODebugLine = function(line) { var $x = ["ODebugLine",97,line]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODebugReg = function(name,r,line) { var $x = ["ODebugReg",96,name,r,line]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODecrIReg = function(r) { var $x = ["ODecrIReg",93,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODecrReg = function(r) { var $x = ["ODecrReg",88,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODeleteProp = function(p) { var $x = ["ODeleteProp",68,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODup = ["ODup",27];
format.abc.OpCode.ODup.toString = $estr;
format.abc.OpCode.ODup.__enum__ = format.abc.OpCode;
format.abc.OpCode.ODxNs = function(v) { var $x = ["ODxNs",5,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ODxNsLate = ["ODxNsLate",6];
format.abc.OpCode.ODxNsLate.toString = $estr;
format.abc.OpCode.ODxNsLate.__enum__ = format.abc.OpCode;
format.abc.OpCode.OFalse = ["OFalse",24];
format.abc.OpCode.OFalse.toString = $estr;
format.abc.OpCode.OFalse.__enum__ = format.abc.OpCode;
format.abc.OpCode.OFindDefinition = function(d) { var $x = ["OFindDefinition",59,d]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OFindProp = function(p) { var $x = ["OFindProp",58,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OFindPropStrict = function(p) { var $x = ["OFindPropStrict",57,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OFloat = function(v) { var $x = ["OFloat",32,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OForEach = ["OForEach",20];
format.abc.OpCode.OForEach.toString = $estr;
format.abc.OpCode.OForEach.__enum__ = format.abc.OpCode;
format.abc.OpCode.OForIn = ["OForIn",16];
format.abc.OpCode.OForIn.toString = $estr;
format.abc.OpCode.OForIn.__enum__ = format.abc.OpCode;
format.abc.OpCode.OFunction = function(f) { var $x = ["OFunction",36,f]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetDescendants = function(c) { var $x = ["OGetDescendants",55,c]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetGlobalScope = ["OGetGlobalScope",64];
format.abc.OpCode.OGetGlobalScope.toString = $estr;
format.abc.OpCode.OGetGlobalScope.__enum__ = format.abc.OpCode;
format.abc.OpCode.OGetGlobalSlot = function(s) { var $x = ["OGetGlobalSlot",71,s]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetLex = function(p) { var $x = ["OGetLex",60,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetProp = function(p) { var $x = ["OGetProp",66,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetScope = function(n) { var $x = ["OGetScope",65,n]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetSlot = function(s) { var $x = ["OGetSlot",69,s]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OGetSuper = function(v) { var $x = ["OGetSuper",3,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OHasNext = ["OHasNext",17];
format.abc.OpCode.OHasNext.toString = $estr;
format.abc.OpCode.OHasNext.__enum__ = format.abc.OpCode;
format.abc.OpCode.OIncrIReg = function(r) { var $x = ["OIncrIReg",92,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OIncrReg = function(r) { var $x = ["OIncrReg",87,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OInitProp = function(p) { var $x = ["OInitProp",67,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OInstanceOf = ["OInstanceOf",90];
format.abc.OpCode.OInstanceOf.toString = $estr;
format.abc.OpCode.OInstanceOf.__enum__ = format.abc.OpCode;
format.abc.OpCode.OInt = function(v) { var $x = ["OInt",22,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OIntRef = function(v) { var $x = ["OIntRef",30,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OIsType = function(t) { var $x = ["OIsType",91,t]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OJump = function(j,delta) { var $x = ["OJump",10,j,delta]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OJump2 = function(j,landingName,delta) { var $x = ["OJump2",11,j,landingName,delta]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OJump3 = function(landingName) { var $x = ["OJump3",12,landingName]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OLabel = ["OLabel",8];
format.abc.OpCode.OLabel.toString = $estr;
format.abc.OpCode.OLabel.__enum__ = format.abc.OpCode;
format.abc.OpCode.OLabel2 = function(name) { var $x = ["OLabel2",9,name]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ONaN = ["ONaN",25];
format.abc.OpCode.ONaN.toString = $estr;
format.abc.OpCode.ONaN.__enum__ = format.abc.OpCode;
format.abc.OpCode.ONamespace = function(v) { var $x = ["ONamespace",34,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ONewBlock = ["ONewBlock",53];
format.abc.OpCode.ONewBlock.toString = $estr;
format.abc.OpCode.ONewBlock.__enum__ = format.abc.OpCode;
format.abc.OpCode.ONext = function(r1,r2) { var $x = ["ONext",35,r1,r2]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ONop = ["ONop",1];
format.abc.OpCode.ONop.toString = $estr;
format.abc.OpCode.ONop.__enum__ = format.abc.OpCode;
format.abc.OpCode.ONull = ["ONull",18];
format.abc.OpCode.ONull.toString = $estr;
format.abc.OpCode.ONull.__enum__ = format.abc.OpCode;
format.abc.OpCode.OObject = function(nfields) { var $x = ["OObject",51,nfields]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OOp = function(op) { var $x = ["OOp",101,op]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OPop = ["OPop",26];
format.abc.OpCode.OPop.toString = $estr;
format.abc.OpCode.OPop.__enum__ = format.abc.OpCode;
format.abc.OpCode.OPopScope = ["OPopScope",15];
format.abc.OpCode.OPopScope.toString = $estr;
format.abc.OpCode.OPopScope.__enum__ = format.abc.OpCode;
format.abc.OpCode.OPushWith = ["OPushWith",14];
format.abc.OpCode.OPushWith.toString = $estr;
format.abc.OpCode.OPushWith.__enum__ = format.abc.OpCode;
format.abc.OpCode.OReg = function(r) { var $x = ["OReg",62,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ORegKill = function(r) { var $x = ["ORegKill",7,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.ORet = ["ORet",44];
format.abc.OpCode.ORet.toString = $estr;
format.abc.OpCode.ORet.__enum__ = format.abc.OpCode;
format.abc.OpCode.ORetVoid = ["ORetVoid",43];
format.abc.OpCode.ORetVoid.toString = $estr;
format.abc.OpCode.ORetVoid.__enum__ = format.abc.OpCode;
format.abc.OpCode.OScope = ["OScope",33];
format.abc.OpCode.OScope.toString = $estr;
format.abc.OpCode.OScope.__enum__ = format.abc.OpCode;
format.abc.OpCode.OSetGlobalSlot = function(s) { var $x = ["OSetGlobalSlot",72,s]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSetProp = function(p) { var $x = ["OSetProp",61,p]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSetReg = function(r) { var $x = ["OSetReg",63,r]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSetSlot = function(s) { var $x = ["OSetSlot",70,s]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSetSuper = function(v) { var $x = ["OSetSuper",4,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSetThis = ["OSetThis",95];
format.abc.OpCode.OSetThis.toString = $estr;
format.abc.OpCode.OSetThis.__enum__ = format.abc.OpCode;
format.abc.OpCode.OSmallInt = function(v) { var $x = ["OSmallInt",21,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OString = function(v) { var $x = ["OString",29,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OSwap = ["OSwap",28];
format.abc.OpCode.OSwap.toString = $estr;
format.abc.OpCode.OSwap.__enum__ = format.abc.OpCode;
format.abc.OpCode.OSwitch = function(def,deltas) { var $x = ["OSwitch",13,def,deltas]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OThis = ["OThis",94];
format.abc.OpCode.OThis.toString = $estr;
format.abc.OpCode.OThis.__enum__ = format.abc.OpCode;
format.abc.OpCode.OThrow = ["OThrow",2];
format.abc.OpCode.OThrow.toString = $estr;
format.abc.OpCode.OThrow.__enum__ = format.abc.OpCode;
format.abc.OpCode.OTimestamp = ["OTimestamp",100];
format.abc.OpCode.OTimestamp.toString = $estr;
format.abc.OpCode.OTimestamp.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToBool = ["OToBool",79];
format.abc.OpCode.OToBool.toString = $estr;
format.abc.OpCode.OToBool.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToInt = ["OToInt",76];
format.abc.OpCode.OToInt.toString = $estr;
format.abc.OpCode.OToInt.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToNumber = ["OToNumber",78];
format.abc.OpCode.OToNumber.toString = $estr;
format.abc.OpCode.OToNumber.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToObject = ["OToObject",80];
format.abc.OpCode.OToObject.toString = $estr;
format.abc.OpCode.OToObject.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToString = ["OToString",73];
format.abc.OpCode.OToString.toString = $estr;
format.abc.OpCode.OToString.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToUInt = ["OToUInt",77];
format.abc.OpCode.OToUInt.toString = $estr;
format.abc.OpCode.OToUInt.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToXml = ["OToXml",74];
format.abc.OpCode.OToXml.toString = $estr;
format.abc.OpCode.OToXml.__enum__ = format.abc.OpCode;
format.abc.OpCode.OToXmlAttr = ["OToXmlAttr",75];
format.abc.OpCode.OToXmlAttr.toString = $estr;
format.abc.OpCode.OToXmlAttr.__enum__ = format.abc.OpCode;
format.abc.OpCode.OTrue = ["OTrue",23];
format.abc.OpCode.OTrue.toString = $estr;
format.abc.OpCode.OTrue.__enum__ = format.abc.OpCode;
format.abc.OpCode.OTypeof = ["OTypeof",89];
format.abc.OpCode.OTypeof.toString = $estr;
format.abc.OpCode.OTypeof.__enum__ = format.abc.OpCode;
format.abc.OpCode.OUIntRef = function(v) { var $x = ["OUIntRef",31,v]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.OpCode.OUndefined = ["OUndefined",19];
format.abc.OpCode.OUndefined.toString = $estr;
format.abc.OpCode.OUndefined.__enum__ = format.abc.OpCode;
format.abc.OpCode.OUnknown = function(byte) { var $x = ["OUnknown",102,byte]; $x.__enum__ = format.abc.OpCode; $x.toString = $estr; return $x; }
format.abc.JumpStyle = { __ename__ : ["format","abc","JumpStyle"], __constructs__ : ["JNotLt","JNotLte","JNotGt","JNotGte","JAlways","JTrue","JFalse","JEq","JNeq","JLt","JLte","JGt","JGte","JPhysEq","JPhysNeq"] }
format.abc.JumpStyle.JAlways = ["JAlways",4];
format.abc.JumpStyle.JAlways.toString = $estr;
format.abc.JumpStyle.JAlways.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JEq = ["JEq",7];
format.abc.JumpStyle.JEq.toString = $estr;
format.abc.JumpStyle.JEq.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JFalse = ["JFalse",6];
format.abc.JumpStyle.JFalse.toString = $estr;
format.abc.JumpStyle.JFalse.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JGt = ["JGt",11];
format.abc.JumpStyle.JGt.toString = $estr;
format.abc.JumpStyle.JGt.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JGte = ["JGte",12];
format.abc.JumpStyle.JGte.toString = $estr;
format.abc.JumpStyle.JGte.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JLt = ["JLt",9];
format.abc.JumpStyle.JLt.toString = $estr;
format.abc.JumpStyle.JLt.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JLte = ["JLte",10];
format.abc.JumpStyle.JLte.toString = $estr;
format.abc.JumpStyle.JLte.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JNeq = ["JNeq",8];
format.abc.JumpStyle.JNeq.toString = $estr;
format.abc.JumpStyle.JNeq.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JNotGt = ["JNotGt",2];
format.abc.JumpStyle.JNotGt.toString = $estr;
format.abc.JumpStyle.JNotGt.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JNotGte = ["JNotGte",3];
format.abc.JumpStyle.JNotGte.toString = $estr;
format.abc.JumpStyle.JNotGte.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JNotLt = ["JNotLt",0];
format.abc.JumpStyle.JNotLt.toString = $estr;
format.abc.JumpStyle.JNotLt.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JNotLte = ["JNotLte",1];
format.abc.JumpStyle.JNotLte.toString = $estr;
format.abc.JumpStyle.JNotLte.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JPhysEq = ["JPhysEq",13];
format.abc.JumpStyle.JPhysEq.toString = $estr;
format.abc.JumpStyle.JPhysEq.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JPhysNeq = ["JPhysNeq",14];
format.abc.JumpStyle.JPhysNeq.toString = $estr;
format.abc.JumpStyle.JPhysNeq.__enum__ = format.abc.JumpStyle;
format.abc.JumpStyle.JTrue = ["JTrue",5];
format.abc.JumpStyle.JTrue.toString = $estr;
format.abc.JumpStyle.JTrue.__enum__ = format.abc.JumpStyle;
format.abc.Operation = { __ename__ : ["format","abc","Operation"], __constructs__ : ["OpAs","OpNeg","OpIncr","OpDecr","OpNot","OpBitNot","OpAdd","OpSub","OpMul","OpDiv","OpMod","OpShl","OpShr","OpUShr","OpAnd","OpOr","OpXor","OpEq","OpPhysEq","OpLt","OpLte","OpGt","OpGte","OpIs","OpIn","OpIIncr","OpIDecr","OpINeg","OpIAdd","OpISub","OpIMul","OpMemGet8","OpMemGet16","OpMemGet32","OpMemGetFloat","OpMemGetDouble","OpMemSet8","OpMemSet16","OpMemSet32","OpMemSetFloat","OpMemSetDouble","OpSign1","OpSign8","OpSign16"] }
format.abc.Operation.OpAdd = ["OpAdd",6];
format.abc.Operation.OpAdd.toString = $estr;
format.abc.Operation.OpAdd.__enum__ = format.abc.Operation;
format.abc.Operation.OpAnd = ["OpAnd",14];
format.abc.Operation.OpAnd.toString = $estr;
format.abc.Operation.OpAnd.__enum__ = format.abc.Operation;
format.abc.Operation.OpAs = ["OpAs",0];
format.abc.Operation.OpAs.toString = $estr;
format.abc.Operation.OpAs.__enum__ = format.abc.Operation;
format.abc.Operation.OpBitNot = ["OpBitNot",5];
format.abc.Operation.OpBitNot.toString = $estr;
format.abc.Operation.OpBitNot.__enum__ = format.abc.Operation;
format.abc.Operation.OpDecr = ["OpDecr",3];
format.abc.Operation.OpDecr.toString = $estr;
format.abc.Operation.OpDecr.__enum__ = format.abc.Operation;
format.abc.Operation.OpDiv = ["OpDiv",9];
format.abc.Operation.OpDiv.toString = $estr;
format.abc.Operation.OpDiv.__enum__ = format.abc.Operation;
format.abc.Operation.OpEq = ["OpEq",17];
format.abc.Operation.OpEq.toString = $estr;
format.abc.Operation.OpEq.__enum__ = format.abc.Operation;
format.abc.Operation.OpGt = ["OpGt",21];
format.abc.Operation.OpGt.toString = $estr;
format.abc.Operation.OpGt.__enum__ = format.abc.Operation;
format.abc.Operation.OpGte = ["OpGte",22];
format.abc.Operation.OpGte.toString = $estr;
format.abc.Operation.OpGte.__enum__ = format.abc.Operation;
format.abc.Operation.OpIAdd = ["OpIAdd",28];
format.abc.Operation.OpIAdd.toString = $estr;
format.abc.Operation.OpIAdd.__enum__ = format.abc.Operation;
format.abc.Operation.OpIDecr = ["OpIDecr",26];
format.abc.Operation.OpIDecr.toString = $estr;
format.abc.Operation.OpIDecr.__enum__ = format.abc.Operation;
format.abc.Operation.OpIIncr = ["OpIIncr",25];
format.abc.Operation.OpIIncr.toString = $estr;
format.abc.Operation.OpIIncr.__enum__ = format.abc.Operation;
format.abc.Operation.OpIMul = ["OpIMul",30];
format.abc.Operation.OpIMul.toString = $estr;
format.abc.Operation.OpIMul.__enum__ = format.abc.Operation;
format.abc.Operation.OpINeg = ["OpINeg",27];
format.abc.Operation.OpINeg.toString = $estr;
format.abc.Operation.OpINeg.__enum__ = format.abc.Operation;
format.abc.Operation.OpISub = ["OpISub",29];
format.abc.Operation.OpISub.toString = $estr;
format.abc.Operation.OpISub.__enum__ = format.abc.Operation;
format.abc.Operation.OpIn = ["OpIn",24];
format.abc.Operation.OpIn.toString = $estr;
format.abc.Operation.OpIn.__enum__ = format.abc.Operation;
format.abc.Operation.OpIncr = ["OpIncr",2];
format.abc.Operation.OpIncr.toString = $estr;
format.abc.Operation.OpIncr.__enum__ = format.abc.Operation;
format.abc.Operation.OpIs = ["OpIs",23];
format.abc.Operation.OpIs.toString = $estr;
format.abc.Operation.OpIs.__enum__ = format.abc.Operation;
format.abc.Operation.OpLt = ["OpLt",19];
format.abc.Operation.OpLt.toString = $estr;
format.abc.Operation.OpLt.__enum__ = format.abc.Operation;
format.abc.Operation.OpLte = ["OpLte",20];
format.abc.Operation.OpLte.toString = $estr;
format.abc.Operation.OpLte.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemGet16 = ["OpMemGet16",32];
format.abc.Operation.OpMemGet16.toString = $estr;
format.abc.Operation.OpMemGet16.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemGet32 = ["OpMemGet32",33];
format.abc.Operation.OpMemGet32.toString = $estr;
format.abc.Operation.OpMemGet32.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemGet8 = ["OpMemGet8",31];
format.abc.Operation.OpMemGet8.toString = $estr;
format.abc.Operation.OpMemGet8.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemGetDouble = ["OpMemGetDouble",35];
format.abc.Operation.OpMemGetDouble.toString = $estr;
format.abc.Operation.OpMemGetDouble.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemGetFloat = ["OpMemGetFloat",34];
format.abc.Operation.OpMemGetFloat.toString = $estr;
format.abc.Operation.OpMemGetFloat.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemSet16 = ["OpMemSet16",37];
format.abc.Operation.OpMemSet16.toString = $estr;
format.abc.Operation.OpMemSet16.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemSet32 = ["OpMemSet32",38];
format.abc.Operation.OpMemSet32.toString = $estr;
format.abc.Operation.OpMemSet32.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemSet8 = ["OpMemSet8",36];
format.abc.Operation.OpMemSet8.toString = $estr;
format.abc.Operation.OpMemSet8.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemSetDouble = ["OpMemSetDouble",40];
format.abc.Operation.OpMemSetDouble.toString = $estr;
format.abc.Operation.OpMemSetDouble.__enum__ = format.abc.Operation;
format.abc.Operation.OpMemSetFloat = ["OpMemSetFloat",39];
format.abc.Operation.OpMemSetFloat.toString = $estr;
format.abc.Operation.OpMemSetFloat.__enum__ = format.abc.Operation;
format.abc.Operation.OpMod = ["OpMod",10];
format.abc.Operation.OpMod.toString = $estr;
format.abc.Operation.OpMod.__enum__ = format.abc.Operation;
format.abc.Operation.OpMul = ["OpMul",8];
format.abc.Operation.OpMul.toString = $estr;
format.abc.Operation.OpMul.__enum__ = format.abc.Operation;
format.abc.Operation.OpNeg = ["OpNeg",1];
format.abc.Operation.OpNeg.toString = $estr;
format.abc.Operation.OpNeg.__enum__ = format.abc.Operation;
format.abc.Operation.OpNot = ["OpNot",4];
format.abc.Operation.OpNot.toString = $estr;
format.abc.Operation.OpNot.__enum__ = format.abc.Operation;
format.abc.Operation.OpOr = ["OpOr",15];
format.abc.Operation.OpOr.toString = $estr;
format.abc.Operation.OpOr.__enum__ = format.abc.Operation;
format.abc.Operation.OpPhysEq = ["OpPhysEq",18];
format.abc.Operation.OpPhysEq.toString = $estr;
format.abc.Operation.OpPhysEq.__enum__ = format.abc.Operation;
format.abc.Operation.OpShl = ["OpShl",11];
format.abc.Operation.OpShl.toString = $estr;
format.abc.Operation.OpShl.__enum__ = format.abc.Operation;
format.abc.Operation.OpShr = ["OpShr",12];
format.abc.Operation.OpShr.toString = $estr;
format.abc.Operation.OpShr.__enum__ = format.abc.Operation;
format.abc.Operation.OpSign1 = ["OpSign1",41];
format.abc.Operation.OpSign1.toString = $estr;
format.abc.Operation.OpSign1.__enum__ = format.abc.Operation;
format.abc.Operation.OpSign16 = ["OpSign16",43];
format.abc.Operation.OpSign16.toString = $estr;
format.abc.Operation.OpSign16.__enum__ = format.abc.Operation;
format.abc.Operation.OpSign8 = ["OpSign8",42];
format.abc.Operation.OpSign8.toString = $estr;
format.abc.Operation.OpSign8.__enum__ = format.abc.Operation;
format.abc.Operation.OpSub = ["OpSub",7];
format.abc.Operation.OpSub.toString = $estr;
format.abc.Operation.OpSub.__enum__ = format.abc.Operation;
format.abc.Operation.OpUShr = ["OpUShr",13];
format.abc.Operation.OpUShr.toString = $estr;
format.abc.Operation.OpUShr.__enum__ = format.abc.Operation;
format.abc.Operation.OpXor = ["OpXor",16];
format.abc.Operation.OpXor.toString = $estr;
format.abc.Operation.OpXor.__enum__ = format.abc.Operation;
format.tools.Huffman = { __ename__ : ["format","tools","Huffman"], __constructs__ : ["Found","NeedBit","NeedBits"] }
format.tools.Huffman.Found = function(i) { var $x = ["Found",0,i]; $x.__enum__ = format.tools.Huffman; $x.toString = $estr; return $x; }
format.tools.Huffman.NeedBit = function(left,right) { var $x = ["NeedBit",1,left,right]; $x.__enum__ = format.tools.Huffman; $x.toString = $estr; return $x; }
format.tools.Huffman.NeedBits = function(n,table) { var $x = ["NeedBits",2,n,table]; $x.__enum__ = format.tools.Huffman; $x.toString = $estr; return $x; }
format.tools.HuffTools = function(p) { if( p === $_ ) return; {
	null;
}}
format.tools.HuffTools.__name__ = ["format","tools","HuffTools"];
format.tools.HuffTools.prototype.make = function(lengths,pos,nlengths,maxbits) {
	var counts = new Array();
	var tmp = new Array();
	if(maxbits > 32) throw "Invalid huffman";
	{
		var _g = 0;
		while(_g < maxbits) {
			var i = _g++;
			counts.push(0);
			tmp.push(0);
		}
	}
	{
		var _g = 0;
		while(_g < nlengths) {
			var i = _g++;
			var p = lengths[i + pos];
			if(p >= maxbits) throw "Invalid huffman";
			counts[p]++;
		}
	}
	var code = 0;
	{
		var _g1 = 1, _g = maxbits - 1;
		while(_g1 < _g) {
			var i = _g1++;
			code = (code + counts[i]) << 1;
			tmp[i] = code;
		}
	}
	var bits = new IntHash();
	{
		var _g = 0;
		while(_g < nlengths) {
			var i = _g++;
			var l = lengths[i + pos];
			if(l != 0) {
				var n = tmp[l - 1];
				tmp[l - 1] = n + 1;
				bits.set((n << 5) | l,i);
			}
		}
	}
	return this.treeCompress(format.tools.Huffman.NeedBit(this.treeMake(bits,maxbits,0,1),this.treeMake(bits,maxbits,1,1)));
}
format.tools.HuffTools.prototype.treeCompress = function(t) {
	var d = this.treeDepth(t);
	if(d == 0) return t;
	if(d == 1) return (function($this) {
		var $r;
		var $e = (t);
		switch( $e[1] ) {
		case 1:
		var b = $e[3], a = $e[2];
		{
			$r = format.tools.Huffman.NeedBit($this.treeCompress(a),$this.treeCompress(b));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw "assert";
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
	var size = 1 << d;
	var table = new Array();
	{
		var _g = 0;
		while(_g < size) {
			var i = _g++;
			table.push(format.tools.Huffman.Found(-1));
		}
	}
	this.treeWalk(table,0,0,d,t);
	return format.tools.Huffman.NeedBits(d,table);
}
format.tools.HuffTools.prototype.treeDepth = function(t) {
	return (function($this) {
		var $r;
		var $e = (t);
		switch( $e[1] ) {
		case 0:
		{
			$r = 0;
		}break;
		case 2:
		{
			$r = (function($this) {
				var $r;
				throw "assert";
				return $r;
			}($this));
		}break;
		case 1:
		var b = $e[3], a = $e[2];
		{
			$r = (function($this) {
				var $r;
				var da = $this.treeDepth(a);
				var db = $this.treeDepth(b);
				$r = 1 + (((da < db)?da:db));
				return $r;
			}($this));
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.tools.HuffTools.prototype.treeMake = function(bits,maxbits,v,len) {
	if(len > maxbits) throw "Invalid huffman";
	var idx = (v << 5) | len;
	if(bits.exists(idx)) return format.tools.Huffman.Found(bits.get(idx));
	v <<= 1;
	len += 1;
	return format.tools.Huffman.NeedBit(this.treeMake(bits,maxbits,v,len),this.treeMake(bits,maxbits,v | 1,len));
}
format.tools.HuffTools.prototype.treeWalk = function(table,p,cd,d,t) {
	var $e = (t);
	switch( $e[1] ) {
	case 1:
	var b = $e[3], a = $e[2];
	{
		if(d > 0) {
			this.treeWalk(table,p,cd + 1,d - 1,a);
			this.treeWalk(table,p | (1 << cd),cd + 1,d - 1,b);
		}
		else table[p] = this.treeCompress(t);
	}break;
	default:{
		table[p] = this.treeCompress(t);
	}break;
	}
}
format.tools.HuffTools.prototype.__class__ = format.tools.HuffTools;
IntIter = function(min,max) { if( min === $_ ) return; {
	this.min = min;
	this.max = max;
}}
IntIter.__name__ = ["IntIter"];
IntIter.prototype.hasNext = function() {
	return this.min < this.max;
}
IntIter.prototype.max = null;
IntIter.prototype.min = null;
IntIter.prototype.next = function() {
	return this.min++;
}
IntIter.prototype.__class__ = IntIter;
format.tools.Inflate = function() { }
format.tools.Inflate.__name__ = ["format","tools","Inflate"];
format.tools.Inflate.run = function(bytes) {
	return format.tools.InflateImpl.run(new haxe.io.BytesInput(bytes));
}
format.tools.Inflate.prototype.__class__ = format.tools.Inflate;
format.mp3.MPEGVersion = { __ename__ : ["format","mp3","MPEGVersion"], __constructs__ : ["MPEG_V1","MPEG_V2","MPEG_V25","MPEG_Reserved"] }
format.mp3.MPEGVersion.MPEG_Reserved = ["MPEG_Reserved",3];
format.mp3.MPEGVersion.MPEG_Reserved.toString = $estr;
format.mp3.MPEGVersion.MPEG_Reserved.__enum__ = format.mp3.MPEGVersion;
format.mp3.MPEGVersion.MPEG_V1 = ["MPEG_V1",0];
format.mp3.MPEGVersion.MPEG_V1.toString = $estr;
format.mp3.MPEGVersion.MPEG_V1.__enum__ = format.mp3.MPEGVersion;
format.mp3.MPEGVersion.MPEG_V2 = ["MPEG_V2",1];
format.mp3.MPEGVersion.MPEG_V2.toString = $estr;
format.mp3.MPEGVersion.MPEG_V2.__enum__ = format.mp3.MPEGVersion;
format.mp3.MPEGVersion.MPEG_V25 = ["MPEG_V25",2];
format.mp3.MPEGVersion.MPEG_V25.toString = $estr;
format.mp3.MPEGVersion.MPEG_V25.__enum__ = format.mp3.MPEGVersion;
format.mp3.Layer = { __ename__ : ["format","mp3","Layer"], __constructs__ : ["LayerReserved","Layer3","Layer2","Layer1"] }
format.mp3.Layer.Layer1 = ["Layer1",3];
format.mp3.Layer.Layer1.toString = $estr;
format.mp3.Layer.Layer1.__enum__ = format.mp3.Layer;
format.mp3.Layer.Layer2 = ["Layer2",2];
format.mp3.Layer.Layer2.toString = $estr;
format.mp3.Layer.Layer2.__enum__ = format.mp3.Layer;
format.mp3.Layer.Layer3 = ["Layer3",1];
format.mp3.Layer.Layer3.toString = $estr;
format.mp3.Layer.Layer3.__enum__ = format.mp3.Layer;
format.mp3.Layer.LayerReserved = ["LayerReserved",0];
format.mp3.Layer.LayerReserved.toString = $estr;
format.mp3.Layer.LayerReserved.__enum__ = format.mp3.Layer;
format.mp3.ChannelMode = { __ename__ : ["format","mp3","ChannelMode"], __constructs__ : ["Stereo","JointStereo","DualChannel","Mono"] }
format.mp3.ChannelMode.DualChannel = ["DualChannel",2];
format.mp3.ChannelMode.DualChannel.toString = $estr;
format.mp3.ChannelMode.DualChannel.__enum__ = format.mp3.ChannelMode;
format.mp3.ChannelMode.JointStereo = ["JointStereo",1];
format.mp3.ChannelMode.JointStereo.toString = $estr;
format.mp3.ChannelMode.JointStereo.__enum__ = format.mp3.ChannelMode;
format.mp3.ChannelMode.Mono = ["Mono",3];
format.mp3.ChannelMode.Mono.toString = $estr;
format.mp3.ChannelMode.Mono.__enum__ = format.mp3.ChannelMode;
format.mp3.ChannelMode.Stereo = ["Stereo",0];
format.mp3.ChannelMode.Stereo.toString = $estr;
format.mp3.ChannelMode.Stereo.__enum__ = format.mp3.ChannelMode;
format.mp3.Emphasis = { __ename__ : ["format","mp3","Emphasis"], __constructs__ : ["NoEmphasis","Ms50_15","CCIT_J17","InvalidEmphasis"] }
format.mp3.Emphasis.CCIT_J17 = ["CCIT_J17",2];
format.mp3.Emphasis.CCIT_J17.toString = $estr;
format.mp3.Emphasis.CCIT_J17.__enum__ = format.mp3.Emphasis;
format.mp3.Emphasis.InvalidEmphasis = ["InvalidEmphasis",3];
format.mp3.Emphasis.InvalidEmphasis.toString = $estr;
format.mp3.Emphasis.InvalidEmphasis.__enum__ = format.mp3.Emphasis;
format.mp3.Emphasis.Ms50_15 = ["Ms50_15",1];
format.mp3.Emphasis.Ms50_15.toString = $estr;
format.mp3.Emphasis.Ms50_15.__enum__ = format.mp3.Emphasis;
format.mp3.Emphasis.NoEmphasis = ["NoEmphasis",0];
format.mp3.Emphasis.NoEmphasis.toString = $estr;
format.mp3.Emphasis.NoEmphasis.__enum__ = format.mp3.Emphasis;
ValueType = { __ename__ : ["ValueType"], __constructs__ : ["TNull","TInt","TFloat","TBool","TObject","TFunction","TClass","TEnum","TUnknown"] }
ValueType.TBool = ["TBool",3];
ValueType.TBool.toString = $estr;
ValueType.TBool.__enum__ = ValueType;
ValueType.TClass = function(c) { var $x = ["TClass",6,c]; $x.__enum__ = ValueType; $x.toString = $estr; return $x; }
ValueType.TEnum = function(e) { var $x = ["TEnum",7,e]; $x.__enum__ = ValueType; $x.toString = $estr; return $x; }
ValueType.TFloat = ["TFloat",2];
ValueType.TFloat.toString = $estr;
ValueType.TFloat.__enum__ = ValueType;
ValueType.TFunction = ["TFunction",5];
ValueType.TFunction.toString = $estr;
ValueType.TFunction.__enum__ = ValueType;
ValueType.TInt = ["TInt",1];
ValueType.TInt.toString = $estr;
ValueType.TInt.__enum__ = ValueType;
ValueType.TNull = ["TNull",0];
ValueType.TNull.toString = $estr;
ValueType.TNull.__enum__ = ValueType;
ValueType.TObject = ["TObject",4];
ValueType.TObject.toString = $estr;
ValueType.TObject.__enum__ = ValueType;
ValueType.TUnknown = ["TUnknown",8];
ValueType.TUnknown.toString = $estr;
ValueType.TUnknown.__enum__ = ValueType;
Type = function() { }
Type.__name__ = ["Type"];
Type.getClass = function(o) {
	if(o == null) return null;
	if(o.__enum__ != null) return null;
	return o.__class__;
}
Type.getEnum = function(o) {
	if(o == null) return null;
	return o.__enum__;
}
Type.getSuperClass = function(c) {
	return c.__super__;
}
Type.getClassName = function(c) {
	if(c == null) return null;
	var a = c.__name__;
	return a.join(".");
}
Type.getEnumName = function(e) {
	var a = e.__ename__;
	return a.join(".");
}
Type.resolveClass = function(name) {
	var cl;
	try {
		cl = eval(name);
	}
	catch( $e8 ) {
		{
			var e = $e8;
			{
				cl = null;
			}
		}
	}
	if(cl == null || cl.__name__ == null) return null;
	return cl;
}
Type.resolveEnum = function(name) {
	var e;
	try {
		e = eval(name);
	}
	catch( $e9 ) {
		{
			var err = $e9;
			{
				e = null;
			}
		}
	}
	if(e == null || e.__ename__ == null) return null;
	return e;
}
Type.createInstance = function(cl,args) {
	if(args.length <= 3) return new cl(args[0],args[1],args[2]);
	if(args.length > 8) throw "Too many arguments";
	return new cl(args[0],args[1],args[2],args[3],args[4],args[5],args[6],args[7]);
}
Type.createEmptyInstance = function(cl) {
	return new cl($_);
}
Type.createEnum = function(e,constr,params) {
	var f = Reflect.field(e,constr);
	if(f == null) throw "No such constructor " + constr;
	if(Reflect.isFunction(f)) {
		if(params == null) throw "Constructor " + constr + " need parameters";
		return f.apply(e,params);
	}
	if(params != null && params.length != 0) throw "Constructor " + constr + " does not need parameters";
	return f;
}
Type.createEnumIndex = function(e,index,params) {
	var c = Type.getEnumConstructs(e)[index];
	if(c == null) throw index + " is not a valid enum constructor index";
	return Type.createEnum(e,c,params);
}
Type.getInstanceFields = function(c) {
	var a = Reflect.fields(c.prototype);
	a.remove("__class__");
	return a;
}
Type.getClassFields = function(c) {
	var a = Reflect.fields(c);
	a.remove("__name__");
	a.remove("__interfaces__");
	a.remove("__super__");
	a.remove("prototype");
	return a;
}
Type.getEnumConstructs = function(e) {
	return e.__constructs__;
}
Type["typeof"] = function(v) {
	switch(typeof(v)) {
	case "boolean":{
		return ValueType.TBool;
	}break;
	case "string":{
		return ValueType.TClass(String);
	}break;
	case "number":{
		if(Math.ceil(v) == v % 2147483648.0) return ValueType.TInt;
		return ValueType.TFloat;
	}break;
	case "object":{
		if(v == null) return ValueType.TNull;
		var e = v.__enum__;
		if(e != null) return ValueType.TEnum(e);
		var c = v.__class__;
		if(c != null) return ValueType.TClass(c);
		return ValueType.TObject;
	}break;
	case "function":{
		if(v.__name__ != null) return ValueType.TObject;
		return ValueType.TFunction;
	}break;
	case "undefined":{
		return ValueType.TNull;
	}break;
	default:{
		return ValueType.TUnknown;
	}break;
	}
}
Type.enumEq = function(a,b) {
	if(a == b) return true;
	try {
		if(a[0] != b[0]) return false;
		{
			var _g1 = 2, _g = a.length;
			while(_g1 < _g) {
				var i = _g1++;
				if(!Type.enumEq(a[i],b[i])) return false;
			}
		}
		var e = a.__enum__;
		if(e != b.__enum__ || e == null) return false;
	}
	catch( $e10 ) {
		{
			var e = $e10;
			{
				return false;
			}
		}
	}
	return true;
}
Type.enumConstructor = function(e) {
	return e[0];
}
Type.enumParameters = function(e) {
	return e.slice(2);
}
Type.enumIndex = function(e) {
	return e[1];
}
Type.prototype.__class__ = Type;
js = {}
js.Boot = function() { }
js.Boot.__name__ = ["js","Boot"];
js.Boot.__unhtml = function(s) {
	return s.split("&").join("&amp;").split("<").join("&lt;").split(">").join("&gt;");
}
js.Boot.__trace = function(v,i) {
	var msg = (i != null?i.fileName + ":" + i.lineNumber + ": ":"");
	msg += js.Boot.__unhtml(js.Boot.__string_rec(v,"")) + "<br/>";
	var d = document.getElementById("haxe:trace");
	if(d == null) alert("No haxe:trace element defined\n" + msg);
	else d.innerHTML += msg;
}
js.Boot.__clear_trace = function() {
	var d = document.getElementById("haxe:trace");
	if(d != null) d.innerHTML = "";
	else null;
}
js.Boot.__closure = function(o,f) {
	var m = o[f];
	if(m == null) return null;
	var f1 = function() {
		return m.apply(o,arguments);
	}
	f1.scope = o;
	f1.method = m;
	return f1;
}
js.Boot.__string_rec = function(o,s) {
	if(o == null) return "null";
	if(s.length >= 5) return "<...>";
	var t = typeof(o);
	if(t == "function" && (o.__name__ != null || o.__ename__ != null)) t = "object";
	switch(t) {
	case "object":{
		if(o instanceof Array) {
			if(o.__enum__ != null) {
				if(o.length == 2) return o[0];
				var str = o[0] + "(";
				s += "\t";
				{
					var _g1 = 2, _g = o.length;
					while(_g1 < _g) {
						var i = _g1++;
						if(i != 2) str += "," + js.Boot.__string_rec(o[i],s);
						else str += js.Boot.__string_rec(o[i],s);
					}
				}
				return str + ")";
			}
			var l = o.length;
			var i;
			var str = "[";
			s += "\t";
			{
				var _g = 0;
				while(_g < l) {
					var i1 = _g++;
					str += ((i1 > 0?",":"")) + js.Boot.__string_rec(o[i1],s);
				}
			}
			str += "]";
			return str;
		}
		var tostr;
		try {
			tostr = o.toString;
		}
		catch( $e11 ) {
			{
				var e = $e11;
				{
					return "???";
				}
			}
		}
		if(tostr != null && tostr != Object.toString) {
			var s2 = o.toString();
			if(s2 != "[object Object]") return s2;
		}
		var k = null;
		var str = "{\n";
		s += "\t";
		var hasp = (o.hasOwnProperty != null);
		for( var k in o ) { ;
		if(hasp && !o.hasOwnProperty(k)) continue;
		if(k == "prototype" || k == "__class__" || k == "__super__" || k == "__interfaces__") continue;
		if(str.length != 2) str += ", \n";
		str += s + k + " : " + js.Boot.__string_rec(o[k],s);
		}
		s = s.substring(1);
		str += "\n" + s + "}";
		return str;
	}break;
	case "function":{
		return "<function>";
	}break;
	case "string":{
		return o;
	}break;
	default:{
		return String(o);
	}break;
	}
}
js.Boot.__interfLoop = function(cc,cl) {
	if(cc == null) return false;
	if(cc == cl) return true;
	var intf = cc.__interfaces__;
	if(intf != null) {
		var _g1 = 0, _g = intf.length;
		while(_g1 < _g) {
			var i = _g1++;
			var i1 = intf[i];
			if(i1 == cl || js.Boot.__interfLoop(i1,cl)) return true;
		}
	}
	return js.Boot.__interfLoop(cc.__super__,cl);
}
js.Boot.__instanceof = function(o,cl) {
	try {
		if(o instanceof cl) {
			if(cl == Array) return (o.__enum__ == null);
			return true;
		}
		if(js.Boot.__interfLoop(o.__class__,cl)) return true;
	}
	catch( $e12 ) {
		{
			var e = $e12;
			{
				if(cl == null) return false;
			}
		}
	}
	switch(cl) {
	case Int:{
		return Math.ceil(o%2147483648.0) === o;
	}break;
	case Float:{
		return typeof(o) == "number";
	}break;
	case Bool:{
		return o === true || o === false;
	}break;
	case String:{
		return typeof(o) == "string";
	}break;
	case Dynamic:{
		return true;
	}break;
	default:{
		if(o == null) return false;
		return o.__enum__ == cl || (cl == Class && o.__name__ != null) || (cl == Enum && o.__ename__ != null);
	}break;
	}
}
js.Boot.__init = function() {
	js.Lib.isIE = (document.all != null && window.opera == null);
	js.Lib.isOpera = (window.opera != null);
	Array.prototype.copy = Array.prototype.slice;
	Array.prototype.insert = function(i,x) {
		this.splice(i,0,x);
	}
	Array.prototype.remove = (Array.prototype.indexOf?function(obj) {
		var idx = this.indexOf(obj);
		if(idx == -1) return false;
		this.splice(idx,1);
		return true;
	}:function(obj) {
		var i = 0;
		var l = this.length;
		while(i < l) {
			if(this[i] == obj) {
				this.splice(i,1);
				return true;
			}
			i++;
		}
		return false;
	});
	Array.prototype.iterator = function() {
		return { cur : 0, arr : this, hasNext : function() {
			return this.cur < this.arr.length;
		}, next : function() {
			return this.arr[this.cur++];
		}}
	}
	var cca = String.prototype.charCodeAt;
	String.prototype.cca = cca;
	String.prototype.charCodeAt = function(i) {
		var x = cca.call(this,i);
		if(isNaN(x)) return null;
		return x;
	}
	var oldsub = String.prototype.substr;
	String.prototype.substr = function(pos,len) {
		if(pos != null && pos != 0 && len != null && len < 0) return "";
		if(len == null) len = this.length;
		if(pos < 0) {
			pos = this.length + pos;
			if(pos < 0) pos = 0;
		}
		else if(len < 0) {
			len = this.length + len - pos;
		}
		return oldsub.apply(this,[pos,len]);
	}
	$closure = js.Boot.__closure;
}
js.Boot.prototype.__class__ = js.Boot;
EReg = function(r,opt) { if( r === $_ ) return; {
	opt = opt.split("u").join("");
	this.r = new RegExp(r,opt);
}}
EReg.__name__ = ["EReg"];
EReg.prototype.customReplace = function(s,f) {
	var buf = new StringBuf();
	while(true) {
		if(!this.match(s)) break;
		buf.b[buf.b.length] = this.matchedLeft();
		buf.b[buf.b.length] = f(this);
		s = this.matchedRight();
	}
	buf.b[buf.b.length] = s;
	return buf.b.join("");
}
EReg.prototype.match = function(s) {
	this.r.m = this.r.exec(s);
	this.r.s = s;
	this.r.l = RegExp.leftContext;
	this.r.r = RegExp.rightContext;
	return (this.r.m != null);
}
EReg.prototype.matched = function(n) {
	return (this.r.m != null && n >= 0 && n < this.r.m.length?this.r.m[n]:(function($this) {
		var $r;
		throw "EReg::matched";
		return $r;
	}(this)));
}
EReg.prototype.matchedLeft = function() {
	if(this.r.m == null) throw "No string matched";
	if(this.r.l == null) return this.r.s.substr(0,this.r.m.index);
	return this.r.l;
}
EReg.prototype.matchedPos = function() {
	if(this.r.m == null) throw "No string matched";
	return { pos : this.r.m.index, len : this.r.m[0].length}
}
EReg.prototype.matchedRight = function() {
	if(this.r.m == null) throw "No string matched";
	if(this.r.r == null) {
		var sz = this.r.m.index + this.r.m[0].length;
		return this.r.s.substr(sz,this.r.s.length - sz);
	}
	return this.r.r;
}
EReg.prototype.r = null;
EReg.prototype.replace = function(s,by) {
	return s.replace(this.r,by);
}
EReg.prototype.split = function(s) {
	var d = "#__delim__#";
	return s.replace(this.r,d).split(d);
}
EReg.prototype.__class__ = EReg;
js.JsXml__ = function(p) { if( p === $_ ) return; {
	null;
}}
js.JsXml__.__name__ = ["js","JsXml__"];
js.JsXml__.parse = function(str) {
	var rules = [js.JsXml__.enode,js.JsXml__.epcdata,js.JsXml__.eend,js.JsXml__.ecdata,js.JsXml__.edoctype,js.JsXml__.ecomment,js.JsXml__.eprolog];
	var nrules = rules.length;
	var current = Xml.createDocument();
	var stack = new List();
	while(str.length > 0) {
		var i = 0;
		try {
			while(i < nrules) {
				var r = rules[i];
				if(r.match(str)) {
					switch(i) {
					case 0:{
						var x = Xml.createElement(r.matched(1));
						current.addChild(x);
						str = r.matchedRight();
						while(js.JsXml__.eattribute.match(str)) {
							x.set(js.JsXml__.eattribute.matched(1),js.JsXml__.eattribute.matched(3));
							str = js.JsXml__.eattribute.matchedRight();
						}
						if(!js.JsXml__.eclose.match(str)) {
							i = nrules;
							throw "__break__";
						}
						if(js.JsXml__.eclose.matched(1) == ">") {
							stack.push(current);
							current = x;
						}
						str = js.JsXml__.eclose.matchedRight();
					}break;
					case 1:{
						var x = Xml.createPCData(r.matched(0));
						current.addChild(x);
						str = r.matchedRight();
					}break;
					case 2:{
						if(current._children != null && current._children.length == 0) {
							var e = Xml.createPCData("");
							current.addChild(e);
						}
						else null;
						if(r.matched(1) != current._nodeName || stack.isEmpty()) {
							i = nrules;
							throw "__break__";
						}
						else null;
						current = stack.pop();
						str = r.matchedRight();
					}break;
					case 3:{
						str = r.matchedRight();
						if(!js.JsXml__.ecdata_end.match(str)) throw "End of CDATA section not found";
						var x = Xml.createCData(js.JsXml__.ecdata_end.matchedLeft());
						current.addChild(x);
						str = js.JsXml__.ecdata_end.matchedRight();
					}break;
					case 4:{
						var pos = 0;
						var count = 0;
						var old = str;
						try {
							while(true) {
								if(!js.JsXml__.edoctype_elt.match(str)) throw "End of DOCTYPE section not found";
								var p = js.JsXml__.edoctype_elt.matchedPos();
								pos += p.pos + p.len;
								str = js.JsXml__.edoctype_elt.matchedRight();
								switch(js.JsXml__.edoctype_elt.matched(0)) {
								case "[":{
									count++;
								}break;
								case "]":{
									count--;
									if(count < 0) throw "Invalid ] found in DOCTYPE declaration";
								}break;
								default:{
									if(count == 0) throw "__break__";
								}break;
								}
							}
						} catch( e ) { if( e != "__break__" ) throw e; }
						var x = Xml.createDocType(old.substr(0,pos));
						current.addChild(x);
					}break;
					case 5:{
						if(!js.JsXml__.ecomment_end.match(str)) throw "Unclosed Comment";
						var p = js.JsXml__.ecomment_end.matchedPos();
						var x = Xml.createComment(str.substr(0,p.pos + p.len));
						current.addChild(x);
						str = js.JsXml__.ecomment_end.matchedRight();
					}break;
					case 6:{
						var x = Xml.createProlog(r.matched(0));
						current.addChild(x);
						str = r.matchedRight();
					}break;
					}
					throw "__break__";
				}
				i += 1;
			}
		} catch( e ) { if( e != "__break__" ) throw e; }
		if(i == nrules) {
			if(str.length > 10) throw ("Xml parse error : Unexpected " + str.substr(0,10) + "...");
			else throw ("Xml parse error : Unexpected " + str);
		}
	}
	return current;
}
js.JsXml__.createElement = function(name) {
	var r = new js.JsXml__();
	r.nodeType = Xml.Element;
	r._children = new Array();
	r._attributes = new Hash();
	r.setNodeName(name);
	return r;
}
js.JsXml__.createPCData = function(data) {
	var r = new js.JsXml__();
	r.nodeType = Xml.PCData;
	r.setNodeValue(data);
	return r;
}
js.JsXml__.createCData = function(data) {
	var r = new js.JsXml__();
	r.nodeType = Xml.CData;
	r.setNodeValue(data);
	return r;
}
js.JsXml__.createComment = function(data) {
	var r = new js.JsXml__();
	r.nodeType = Xml.Comment;
	r.setNodeValue(data);
	return r;
}
js.JsXml__.createDocType = function(data) {
	var r = new js.JsXml__();
	r.nodeType = Xml.DocType;
	r.setNodeValue(data);
	return r;
}
js.JsXml__.createProlog = function(data) {
	var r = new js.JsXml__();
	r.nodeType = Xml.Prolog;
	r.setNodeValue(data);
	return r;
}
js.JsXml__.createDocument = function() {
	var r = new js.JsXml__();
	r.nodeType = Xml.Document;
	r._children = new Array();
	return r;
}
js.JsXml__.prototype._attributes = null;
js.JsXml__.prototype._children = null;
js.JsXml__.prototype._nodeName = null;
js.JsXml__.prototype._nodeValue = null;
js.JsXml__.prototype._parent = null;
js.JsXml__.prototype.addChild = function(x) {
	if(this._children == null) throw "bad nodetype";
	if(x._parent != null) x._parent._children.remove(x);
	x._parent = this;
	this._children.push(x);
}
js.JsXml__.prototype.attributes = function() {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	return this._attributes.keys();
}
js.JsXml__.prototype.elements = function() {
	if(this._children == null) throw "bad nodetype";
	return { cur : 0, x : this._children, hasNext : function() {
		var k = this.cur;
		var l = this.x.length;
		while(k < l) {
			if(this.x[k].nodeType == Xml.Element) break;
			k += 1;
		}
		this.cur = k;
		return k < l;
	}, next : function() {
		var k = this.cur;
		var l = this.x.length;
		while(k < l) {
			var n = this.x[k];
			k += 1;
			if(n.nodeType == Xml.Element) {
				this.cur = k;
				return n;
			}
		}
		return null;
	}}
}
js.JsXml__.prototype.elementsNamed = function(name) {
	if(this._children == null) throw "bad nodetype";
	return { cur : 0, x : this._children, hasNext : function() {
		var k = this.cur;
		var l = this.x.length;
		while(k < l) {
			var n = this.x[k];
			if(n.nodeType == Xml.Element && n._nodeName == name) break;
			k++;
		}
		this.cur = k;
		return k < l;
	}, next : function() {
		var k = this.cur;
		var l = this.x.length;
		while(k < l) {
			var n = this.x[k];
			k++;
			if(n.nodeType == Xml.Element && n._nodeName == name) {
				this.cur = k;
				return n;
			}
		}
		return null;
	}}
}
js.JsXml__.prototype.exists = function(att) {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	return this._attributes.exists(att);
}
js.JsXml__.prototype.firstChild = function() {
	if(this._children == null) throw "bad nodetype";
	return this._children[0];
}
js.JsXml__.prototype.firstElement = function() {
	if(this._children == null) throw "bad nodetype";
	var cur = 0;
	var l = this._children.length;
	while(cur < l) {
		var n = this._children[cur];
		if(n.nodeType == Xml.Element) return n;
		cur++;
	}
	return null;
}
js.JsXml__.prototype.get = function(att) {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	return this._attributes.get(att);
}
js.JsXml__.prototype.getNodeName = function() {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	return this._nodeName;
}
js.JsXml__.prototype.getNodeValue = function() {
	if(this.nodeType == Xml.Element || this.nodeType == Xml.Document) throw "bad nodeType";
	return this._nodeValue;
}
js.JsXml__.prototype.getParent = function() {
	return this._parent;
}
js.JsXml__.prototype.insertChild = function(x,pos) {
	if(this._children == null) throw "bad nodetype";
	if(x._parent != null) x._parent._children.remove(x);
	x._parent = this;
	this._children.insert(pos,x);
}
js.JsXml__.prototype.iterator = function() {
	if(this._children == null) throw "bad nodetype";
	return { cur : 0, x : this._children, hasNext : function() {
		return this.cur < this.x.length;
	}, next : function() {
		return this.x[this.cur++];
	}}
}
js.JsXml__.prototype.nodeName = null;
js.JsXml__.prototype.nodeType = null;
js.JsXml__.prototype.nodeValue = null;
js.JsXml__.prototype.parent = null;
js.JsXml__.prototype.remove = function(att) {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	this._attributes.remove(att);
}
js.JsXml__.prototype.removeChild = function(x) {
	if(this._children == null) throw "bad nodetype";
	var b = this._children.remove(x);
	if(b) x._parent = null;
	return b;
}
js.JsXml__.prototype.set = function(att,value) {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	this._attributes.set(att,value);
}
js.JsXml__.prototype.setNodeName = function(n) {
	if(this.nodeType != Xml.Element) throw "bad nodeType";
	return this._nodeName = n;
}
js.JsXml__.prototype.setNodeValue = function(v) {
	if(this.nodeType == Xml.Element || this.nodeType == Xml.Document) throw "bad nodeType";
	return this._nodeValue = v;
}
js.JsXml__.prototype.toString = function() {
	if(this.nodeType == Xml.PCData) return this._nodeValue;
	if(this.nodeType == Xml.CData) return "<![CDATA[" + this._nodeValue + "]]>";
	if(this.nodeType == Xml.Comment || this.nodeType == Xml.DocType || this.nodeType == Xml.Prolog) return this._nodeValue;
	var s = new StringBuf();
	if(this.nodeType == Xml.Element) {
		s.b[s.b.length] = "<";
		s.b[s.b.length] = this._nodeName;
		{ var $it13 = this._attributes.keys();
		while( $it13.hasNext() ) { var k = $it13.next();
		{
			s.b[s.b.length] = " ";
			s.b[s.b.length] = k;
			s.b[s.b.length] = "=\"";
			s.b[s.b.length] = this._attributes.get(k);
			s.b[s.b.length] = "\"";
		}
		}}
		if(this._children.length == 0) {
			s.b[s.b.length] = "/>";
			return s.b.join("");
		}
		s.b[s.b.length] = ">";
	}
	{ var $it14 = this.iterator();
	while( $it14.hasNext() ) { var x = $it14.next();
	s.b[s.b.length] = x.toString();
	}}
	if(this.nodeType == Xml.Element) {
		s.b[s.b.length] = "</";
		s.b[s.b.length] = this._nodeName;
		s.b[s.b.length] = ">";
	}
	return s.b.join("");
}
js.JsXml__.prototype.__class__ = js.JsXml__;
IntHash = function(p) { if( p === $_ ) return; {
	this.h = {}
	if(this.h.__proto__ != null) {
		this.h.__proto__ = null;
		delete(this.h.__proto__);
	}
	else null;
}}
IntHash.__name__ = ["IntHash"];
IntHash.prototype.exists = function(key) {
	return this.h[key] != null;
}
IntHash.prototype.get = function(key) {
	return this.h[key];
}
IntHash.prototype.h = null;
IntHash.prototype.iterator = function() {
	return { ref : this.h, it : this.keys(), hasNext : function() {
		return this.it.hasNext();
	}, next : function() {
		var i = this.it.next();
		return this.ref[i];
	}}
}
IntHash.prototype.keys = function() {
	var a = new Array();
	
			for( x in this.h )
				a.push(x);
		;
	return a.iterator();
}
IntHash.prototype.remove = function(key) {
	if(this.h[key] == null) return false;
	delete(this.h[key]);
	return true;
}
IntHash.prototype.set = function(key,value) {
	this.h[key] = value;
}
IntHash.prototype.toString = function() {
	var s = new StringBuf();
	s.b[s.b.length] = "{";
	var it = this.keys();
	{ var $it15 = it;
	while( $it15.hasNext() ) { var i = $it15.next();
	{
		s.b[s.b.length] = i;
		s.b[s.b.length] = " => ";
		s.b[s.b.length] = Std.string(this.get(i));
		if(it.hasNext()) s.b[s.b.length] = ", ";
	}
	}}
	s.b[s.b.length] = "}";
	return s.b.join("");
}
IntHash.prototype.__class__ = IntHash;
format.zip = {}
format.zip.ExtraField = { __ename__ : ["format","zip","ExtraField"], __constructs__ : ["FUnknown","FInfoZipUnicodePath"] }
format.zip.ExtraField.FInfoZipUnicodePath = function(name,crc) { var $x = ["FInfoZipUnicodePath",1,name,crc]; $x.__enum__ = format.zip.ExtraField; $x.toString = $estr; return $x; }
format.zip.ExtraField.FUnknown = function(tag,bytes) { var $x = ["FUnknown",0,tag,bytes]; $x.__enum__ = format.zip.ExtraField; $x.toString = $estr; return $x; }
StringBuf = function(p) { if( p === $_ ) return; {
	this.b = new Array();
}}
StringBuf.__name__ = ["StringBuf"];
StringBuf.prototype.add = function(x) {
	this.b[this.b.length] = x;
}
StringBuf.prototype.addChar = function(c) {
	this.b[this.b.length] = String.fromCharCode(c);
}
StringBuf.prototype.addSub = function(s,pos,len) {
	this.b[this.b.length] = s.substr(pos,len);
}
StringBuf.prototype.b = null;
StringBuf.prototype.toString = function() {
	return this.b.join("");
}
StringBuf.prototype.__class__ = StringBuf;
format.abc.Writer = function(o) { if( o === $_ ) return; {
	this.o = o;
	this.opw = new format.abc.OpWriter(o);
}}
format.abc.Writer.__name__ = ["format","abc","Writer"];
format.abc.Writer.write = function(out,data) {
	var w = new format.abc.Writer(out);
	w.writeABC(data);
}
format.abc.Writer.prototype.beginTag = function(id,len) {
	if(len >= 63) {
		this.o.writeUInt16((id << 6) | 63);
		this.o.writeUInt30(len);
	}
	else this.o.writeUInt16((id << 6) | len);
}
format.abc.Writer.prototype.o = null;
format.abc.Writer.prototype.opw = null;
format.abc.Writer.prototype.writeABC = function(d) {
	this.o.writeInt31(3014672);
	this.writeList(d.ints,$closure(this.opw,"writeInt32"));
	this.writeList(d.uints,$closure(this.opw,"writeInt32"));
	this.writeList(d.floats,$closure(this.o,"writeDouble"));
	this.writeList(d.strings,$closure(this,"writeString"));
	this.writeList(d.namespaces,$closure(this,"writeNamespace"));
	this.writeList(d.nssets,$closure(this,"writeNsSet"));
	this.writeList(d.names,function(f,a1) {
		return function(a2) {
			return f(a1,a2);
		}
	}($closure(this,"writeName"),-1));
	this.writeList2(d.methodTypes,$closure(this,"writeMethodType"));
	this.writeList2(d.metadatas,$closure(this,"writeMetadata"));
	this.writeList2(d.classes,$closure(this,"writeClass"));
	{
		var _g = 0, _g1 = d.classes;
		while(_g < _g1.length) {
			var c = _g1[_g];
			++_g;
			this.writeIndex(c.statics);
			this.writeList2(c.staticFields,$closure(this,"writeField"));
		}
	}
	this.writeList2(d.inits,$closure(this,"writeInit"));
	this.writeList2(d.functions,$closure(this,"writeFunction"));
}
format.abc.Writer.prototype.writeClass = function(c) {
	this.writeIndex(c.name);
	this.writeIndexOpt(c.superclass);
	var flags = 0;
	if(c.isSealed) flags |= 1;
	if(c.isFinal) flags |= 2;
	if(c.isInterface) flags |= 4;
	if(c["namespace"] != null) flags |= 8;
	this.o.writeByte(flags);
	if(c["namespace"] != null) this.writeIndex(c["namespace"]);
	this.writeList2(c.interfaces,$closure(this,"writeIndex"));
	this.writeIndex(c.constructor);
	this.writeList2(c.fields,$closure(this,"writeField"));
}
format.abc.Writer.prototype.writeField = function(f) {
	this.writeIndex(f.name);
	var flags = 0;
	if(f.metadatas != null) flags |= 64;
	var $e = (f.kind);
	switch( $e[1] ) {
	case 0:
	var const = $e[4], v = $e[3], t = $e[2];
	{
		this.o.writeByte((($const?6:0)) | flags);
		this.opw.writeInt(f.slot);
		this.writeIndexOpt(t);
		this.writeValue(false,v);
	}break;
	case 1:
	var isOverride = $e[5], isFinal = $e[4], k = $e[3], t = $e[2];
	{
		if(isFinal) flags |= 16;
		if(isOverride) flags |= 32;
		var $e = (k);
		switch( $e[1] ) {
		case 0:
		{
			flags |= 1;
		}break;
		case 1:
		{
			flags |= 2;
		}break;
		case 2:
		{
			flags |= 3;
		}break;
		}
		this.o.writeByte(flags);
		if(isOverride) this.opw.writeInt(0);
		else this.opw.writeInt(f.slot);
		this.writeIndex(t);
	}break;
	case 2:
	var c = $e[2];
	{
		this.o.writeByte(4 | flags);
		this.opw.writeInt(f.slot);
		this.writeIndex(c);
	}break;
	case 3:
	var i = $e[2];
	{
		this.o.writeByte(5 | flags);
		this.opw.writeInt(f.slot);
		this.writeIndex(i);
	}break;
	}
	if(f.metadatas != null) this.writeList2(f.metadatas,$closure(this,"writeIndex"));
}
format.abc.Writer.prototype.writeFunction = function(f) {
	this.writeIndex(f.type);
	this.opw.writeInt(f.maxStack);
	this.opw.writeInt(f.nRegs);
	this.opw.writeInt(f.initScope);
	this.opw.writeInt(f.maxScope);
	this.opw.writeInt(f.code.length);
	this.o.write(f.code);
	this.writeList2(f.trys,$closure(this,"writeTryCatch"));
	this.writeList2(f.locals,$closure(this,"writeField"));
}
format.abc.Writer.prototype.writeIndex = function(i) {
	var $e = (i);
	switch( $e[1] ) {
	case 0:
	var n = $e[2];
	{
		this.opw.writeInt(n);
	}break;
	}
}
format.abc.Writer.prototype.writeIndexOpt = function(i) {
	if(i == null) {
		this.o.writeByte(0);
		return;
	}
	this.writeIndex(i);
}
format.abc.Writer.prototype.writeInit = function(i) {
	this.writeIndex(i.method);
	this.writeList2(i.fields,$closure(this,"writeField"));
}
format.abc.Writer.prototype.writeInt = function(n) {
	this.opw.writeInt(n);
}
format.abc.Writer.prototype.writeList = function(a,write) {
	if(a.length == 0) {
		this.opw.writeInt(0);
		return;
	}
	this.opw.writeInt(a.length + 1);
	{
		var _g1 = 0, _g = a.length;
		while(_g1 < _g) {
			var i = _g1++;
			write(a[i]);
		}
	}
}
format.abc.Writer.prototype.writeList2 = function(a,write) {
	this.opw.writeInt(a.length);
	{
		var _g1 = 0, _g = a.length;
		while(_g1 < _g) {
			var i = _g1++;
			write(a[i]);
		}
	}
}
format.abc.Writer.prototype.writeMetadata = function(m) {
	this.writeIndex(m.name);
	this.opw.writeInt(m.data.length);
	{
		var _g = 0, _g1 = m.data;
		while(_g < _g1.length) {
			var d = _g1[_g];
			++_g;
			this.writeIndex(d.n);
		}
	}
	{
		var _g = 0, _g1 = m.data;
		while(_g < _g1.length) {
			var d = _g1[_g];
			++_g;
			this.writeIndex(d.v);
		}
	}
}
format.abc.Writer.prototype.writeMethodType = function(m) {
	this.o.writeByte(m.args.length);
	this.writeIndexOpt(m.ret);
	{
		var _g = 0, _g1 = m.args;
		while(_g < _g1.length) {
			var a = _g1[_g];
			++_g;
			this.writeIndexOpt(a);
		}
	}
	var x = m.extra;
	if(x == null) {
		this.writeIndexOpt(null);
		this.o.writeByte(0);
		return;
	}
	this.writeIndexOpt(x.debugName);
	var flags = 0;
	if(x.argumentsDefined) flags |= 1;
	if(x.newBlock) flags |= 2;
	if(x.variableArgs) flags |= 4;
	if(x.defaultParameters != null) flags |= 8;
	if(x.unused) flags |= 16;
	if(x["native"]) flags |= 32;
	if(x.usesDXNS) flags |= 64;
	if(x.paramNames != null) flags |= 128;
	this.o.writeByte(flags);
	if(x.defaultParameters != null) {
		this.o.writeByte(x.defaultParameters.length);
		{
			var _g = 0, _g1 = x.defaultParameters;
			while(_g < _g1.length) {
				var v = _g1[_g];
				++_g;
				this.writeValue(true,v);
			}
		}
	}
	if(x.paramNames != null) {
		if(x.paramNames.length != m.args.length) throw "assert";
		{
			var _g = 0, _g1 = x.paramNames;
			while(_g < _g1.length) {
				var i = _g1[_g];
				++_g;
				this.writeIndexOpt(i);
			}
		}
	}
}
format.abc.Writer.prototype.writeName = function(k,n) {
	if(k == null) k = -1;
	var $e = (n);
	switch( $e[1] ) {
	case 0:
	var ns = $e[3], id = $e[2];
	{
		this.o.writeByte(((k < 0)?7:k));
		this.writeIndex(ns);
		this.writeIndex(id);
	}break;
	case 1:
	var ns = $e[3], id = $e[2];
	{
		this.o.writeByte(((k < 0)?9:k));
		this.writeIndex(id);
		this.writeIndex(ns);
	}break;
	case 2:
	var n1 = $e[2];
	{
		this.o.writeByte(((k < 0)?15:k));
		this.writeIndex(n1);
	}break;
	case 3:
	{
		this.o.writeByte(((k < 0)?17:k));
	}break;
	case 4:
	var ns = $e[2];
	{
		this.o.writeByte(((k < 0)?27:k));
		this.writeIndex(ns);
	}break;
	case 5:
	var n1 = $e[2];
	{
		this.writeName((function($this) {
			var $r;
			var $e = (n1);
			switch( $e[1] ) {
			case 0:
			{
				$r = 13;
			}break;
			case 1:
			{
				$r = 14;
			}break;
			case 2:
			{
				$r = 16;
			}break;
			case 3:
			{
				$r = 18;
			}break;
			case 4:
			{
				$r = 28;
			}break;
			case 5:
			case 6:
			{
				$r = (function($this) {
					var $r;
					throw "assert";
					return $r;
				}($this));
			}break;
			default:{
				$r = null;
			}break;
			}
			return $r;
		}(this)),n1);
	}break;
	case 6:
	var params = $e[3], n1 = $e[2];
	{
		this.o.writeByte(((k < 0)?29:k));
		this.writeIndex(n1);
		this.o.writeByte(params.length);
		{
			var _g = 0;
			while(_g < params.length) {
				var i = params[_g];
				++_g;
				this.writeIndex(i);
			}
		}
	}break;
	}
}
format.abc.Writer.prototype.writeNameByte = function(k,n) {
	this.o.writeByte(((k < 0)?n:k));
}
format.abc.Writer.prototype.writeNamespace = function(n) {
	var $e = (n);
	switch( $e[1] ) {
	case 0:
	var id = $e[2];
	{
		this.o.writeByte(5);
		this.writeIndex(id);
	}break;
	case 1:
	var ns = $e[2];
	{
		this.o.writeByte(8);
		this.writeIndex(ns);
	}break;
	case 2:
	var id = $e[2];
	{
		this.o.writeByte(22);
		this.writeIndex(id);
	}break;
	case 3:
	var id = $e[2];
	{
		this.o.writeByte(23);
		this.writeIndex(id);
	}break;
	case 4:
	var id = $e[2];
	{
		this.o.writeByte(24);
		this.writeIndex(id);
	}break;
	case 5:
	var id = $e[2];
	{
		this.o.writeByte(25);
		this.writeIndex(id);
	}break;
	case 6:
	var id = $e[2];
	{
		this.o.writeByte(26);
		this.writeIndex(id);
	}break;
	}
}
format.abc.Writer.prototype.writeNsSet = function(n) {
	this.o.writeByte(n.length);
	{
		var _g = 0;
		while(_g < n.length) {
			var i = n[_g];
			++_g;
			this.writeIndex(i);
		}
	}
}
format.abc.Writer.prototype.writeString = function(s) {
	this.opw.writeInt(s.length);
	this.o.writeString(s);
}
format.abc.Writer.prototype.writeTryCatch = function(t) {
	this.opw.writeInt(t.start);
	this.opw.writeInt(t.end);
	this.opw.writeInt(t.handle);
	this.writeIndexOpt(t.type);
	this.writeIndexOpt(t.variable);
}
format.abc.Writer.prototype.writeUInt = function(n) {
	this.opw.writeInt(n);
}
format.abc.Writer.prototype.writeValue = function(extra,v) {
	if(v == null) {
		if(extra) this.o.writeByte(0);
		this.o.writeByte(0);
		return;
	}
	var $e = (v);
	switch( $e[1] ) {
	case 0:
	{
		this.o.writeByte(12);
		this.o.writeByte(12);
	}break;
	case 1:
	var b = $e[2];
	{
		var c = (b?11:10);
		this.o.writeByte(c);
		this.o.writeByte(c);
	}break;
	case 2:
	var i = $e[2];
	{
		this.writeIndex(i);
		this.o.writeByte(1);
	}break;
	case 3:
	var i = $e[2];
	{
		this.writeIndex(i);
		this.o.writeByte(3);
	}break;
	case 4:
	var i = $e[2];
	{
		this.writeIndex(i);
		this.o.writeByte(4);
	}break;
	case 5:
	var i = $e[2];
	{
		this.writeIndex(i);
		this.o.writeByte(6);
	}break;
	case 6:
	var i = $e[3], n = $e[2];
	{
		this.writeIndex(i);
		this.o.writeByte(n);
	}break;
	}
}
format.abc.Writer.prototype.__class__ = format.abc.Writer;
format.tools.IO = function() { }
format.tools.IO.__name__ = ["format","tools","IO"];
format.tools.IO.copy = function(i,o,buf,size) {
	var bufsize = buf.length;
	while(size > 0) {
		var n = i.readBytes(buf,0,(size > bufsize?bufsize:size));
		size -= n;
		o.writeFullBytes(buf,0,n);
	}
}
format.tools.IO.prototype.__class__ = format.tools.IO;
haxe.io.Output = function() { }
haxe.io.Output.__name__ = ["haxe","io","Output"];
haxe.io.Output.prototype.bigEndian = null;
haxe.io.Output.prototype.close = function() {
	null;
}
haxe.io.Output.prototype.flush = function() {
	null;
}
haxe.io.Output.prototype.prepare = function(nbytes) {
	null;
}
haxe.io.Output.prototype.setEndian = function(b) {
	this.bigEndian = b;
	return b;
}
haxe.io.Output.prototype.write = function(s) {
	var l = s.length;
	var p = 0;
	while(l > 0) {
		var k = this.writeBytes(s,p,l);
		if(k == 0) throw haxe.io.Error.Blocked;
		p += k;
		l -= k;
	}
}
haxe.io.Output.prototype.writeByte = function(c) {
	throw "Not implemented";
}
haxe.io.Output.prototype.writeBytes = function(s,pos,len) {
	var k = len;
	var b = s.b;
	if(pos < 0 || len < 0 || pos + len > s.length) throw haxe.io.Error.OutsideBounds;
	while(k > 0) {
		this.writeByte(b[pos]);
		pos++;
		k--;
	}
	return len;
}
haxe.io.Output.prototype.writeDouble = function(x) {
	throw "Not implemented";
}
haxe.io.Output.prototype.writeFloat = function(x) {
	throw "Not implemented";
}
haxe.io.Output.prototype.writeFullBytes = function(s,pos,len) {
	while(len > 0) {
		var k = this.writeBytes(s,pos,len);
		pos += k;
		len -= k;
	}
}
haxe.io.Output.prototype.writeInput = function(i,bufsize) {
	if(bufsize == null) bufsize = 4096;
	var buf = haxe.io.Bytes.alloc(bufsize);
	try {
		while(true) {
			var len = i.readBytes(buf,0,bufsize);
			if(len == 0) throw haxe.io.Error.Blocked;
			var p = 0;
			while(len > 0) {
				var k = this.writeBytes(buf,p,len);
				if(k == 0) throw haxe.io.Error.Blocked;
				p += k;
				len -= k;
			}
		}
	}
	catch( $e16 ) {
		if( js.Boot.__instanceof($e16,haxe.io.Eof) ) {
			var e = $e16;
			null;
		} else throw($e16);
	}
}
haxe.io.Output.prototype.writeInt16 = function(x) {
	if(x < -32768 || x >= 32768) throw haxe.io.Error.Overflow;
	this.writeUInt16(x & 65535);
}
haxe.io.Output.prototype.writeInt24 = function(x) {
	if(x < -8388608 || x >= 8388608) throw haxe.io.Error.Overflow;
	this.writeUInt24(x & 16777215);
}
haxe.io.Output.prototype.writeInt31 = function(x) {
	if(x < -1073741824 || x >= 1073741824) throw haxe.io.Error.Overflow;
	if(this.bigEndian) {
		this.writeByte(x >>> 24);
		this.writeByte((x >> 16) & 255);
		this.writeByte((x >> 8) & 255);
		this.writeByte(x & 255);
	}
	else {
		this.writeByte(x & 255);
		this.writeByte((x >> 8) & 255);
		this.writeByte((x >> 16) & 255);
		this.writeByte(x >>> 24);
	}
}
haxe.io.Output.prototype.writeInt32 = function(x) {
	if(this.bigEndian) {
		this.writeByte(haxe.Int32.toInt((x) >>> 24));
		this.writeByte(haxe.Int32.toInt((x) >>> 16) & 255);
		this.writeByte(haxe.Int32.toInt((x) >>> 8) & 255);
		this.writeByte(haxe.Int32.toInt((x) & 255));
	}
	else {
		this.writeByte(haxe.Int32.toInt((x) & 255));
		this.writeByte(haxe.Int32.toInt((x) >>> 8) & 255);
		this.writeByte(haxe.Int32.toInt((x) >>> 16) & 255);
		this.writeByte(haxe.Int32.toInt((x) >>> 24));
	}
}
haxe.io.Output.prototype.writeInt8 = function(x) {
	if(x < -128 || x >= 128) throw haxe.io.Error.Overflow;
	this.writeByte(x & 255);
}
haxe.io.Output.prototype.writeString = function(s) {
	var b = haxe.io.Bytes.ofString(s);
	this.writeFullBytes(b,0,b.length);
}
haxe.io.Output.prototype.writeUInt16 = function(x) {
	if(x < 0 || x >= 65536) throw haxe.io.Error.Overflow;
	if(this.bigEndian) {
		this.writeByte(x >> 8);
		this.writeByte(x & 255);
	}
	else {
		this.writeByte(x & 255);
		this.writeByte(x >> 8);
	}
}
haxe.io.Output.prototype.writeUInt24 = function(x) {
	if(x < 0 || x >= 16777216) throw haxe.io.Error.Overflow;
	if(this.bigEndian) {
		this.writeByte(x >> 16);
		this.writeByte((x >> 8) & 255);
		this.writeByte(x & 255);
	}
	else {
		this.writeByte(x & 255);
		this.writeByte((x >> 8) & 255);
		this.writeByte(x >> 16);
	}
}
haxe.io.Output.prototype.writeUInt30 = function(x) {
	if(x < 0 || x >= 1073741824) throw haxe.io.Error.Overflow;
	if(this.bigEndian) {
		this.writeByte(x >>> 24);
		this.writeByte((x >> 16) & 255);
		this.writeByte((x >> 8) & 255);
		this.writeByte(x & 255);
	}
	else {
		this.writeByte(x & 255);
		this.writeByte((x >> 8) & 255);
		this.writeByte((x >> 16) & 255);
		this.writeByte(x >>> 24);
	}
}
haxe.io.Output.prototype.__class__ = haxe.io.Output;
be = {}
be.haxer = {}
be.haxer.hxswfml = {}
be.haxer.hxswfml.HXswfML = function(strict) { if( strict === $_ ) return; {
	if(strict == null) strict = true;
	this.strict = strict;
	this.bitmapIds = new Array();
	this.dictionary = new Array();
	this.swcClasses = new Array();
	this.library = new Hash();
	this.setup();
}}
be.haxer.hxswfml.HXswfML.__name__ = ["be","haxer","hxswfml","HXswfML"];
be.haxer.hxswfml.HXswfML.prototype.bitmapIds = null;
be.haxer.hxswfml.HXswfML.prototype.checkDictionary = function(id) {
	if(this.strict) {
		if(this.dictionary[id] != null) {
			this.error("!ERROR: You are overwriting an existing id: " + id + ". TAG: " + this.currentTag.toString());
		}
		if(id == 0 && this.currentTag.getNodeName().toLowerCase() != "symbolclass") {
			this.error("!ERROR: id 0 used outside symbol class. Index 0 can only be used for the SymbolClass tag that references the DefineABC tag which holds your document class/main entry point. Tag: " + this.currentTag.toString());
		}
	}
	this.dictionary[id] = this.currentTag.getNodeName().toLowerCase();
}
be.haxer.hxswfml.HXswfML.prototype.checkFileExistence = function(file) {
	if(this.library.get(file) == null) {
		this.error("!ERROR: File: " + file + " could not be found in the library. TAG: " + this.currentTag.toString());
	}
}
be.haxer.hxswfml.HXswfML.prototype.checkTargetId = function(id) {
	if(this.strict) {
		if(id != 0 && this.dictionary[id] == null) {
			this.error("!ERROR: The target id " + id + " does not exist. TAG: " + this.currentTag.toString());
		}
		else if(this.currentTag.getNodeName().toLowerCase() == "placeobject" || this.currentTag.getNodeName().toLowerCase() == "buttonstate") {
			switch(this.dictionary[id]) {
			case "defineshape":case "definebutton":case "definesprite":case "defineedittext":{
				null;
			}break;
			default:{
				this.error("!ERROR: The target id " + id + " must be a reference to a DefineShape, DefineButton, DefineSprite or DefineEditText tag. TAG: " + this.currentTag.toString());
			}break;
			}
		}
		else if(this.currentTag.getNodeName().toLowerCase() == "definescalinggrid") {
			switch(this.dictionary[id]) {
			case "definebutton":case "definesprite":{
				null;
			}break;
			default:{
				this.error("!ERROR: The target id " + id + " must be a reference to a DefineButton or DefineSprite tag. TAG: " + this.currentTag.toString());
			}break;
			}
		}
		else if(this.currentTag.getNodeName().toLowerCase() == "startsound") {
			if(this.dictionary[id] != "definesound") {
				this.error("!ERROR: The target id " + id + " must be a reference to a DefineSound tag. TAG: " + this.currentTag.toString());
			}
		}
		else if(id != 0 && this.currentTag.getNodeName().toLowerCase() == "symbolclass") {
			switch(this.dictionary[id]) {
			case "definebutton":case "definesprite":case "definebinarydata":case "definefont":case "defineabc":case "definesound":case "definebitsjpeg":{
				null;
			}break;
			default:{
				this.error("!ERROR: The target id " + id + " must be a reference to a DefineButton, DefineSprite, DefineBinaryData, DefineFont, DefineABC, DefineSound or DefineBitsJPEG tag. TAG: " + this.currentTag.toString());
			}break;
			}
		}
	}
}
be.haxer.hxswfml.HXswfML.prototype.checkUnknownAttributes = function() {
	if(!this.validElements.exists(this.currentTag.getNodeName().toLowerCase())) this.error("!ERROR: Unknown tag: " + this.currentTag.getNodeName());
	{ var $it17 = this.currentTag.attributes();
	while( $it17.hasNext() ) { var a = $it17.next();
	{
		if(!this.checkValidAttribute(a)) {
			this.error("!ERROR: Unknown attribute: " + a + ". Valid attributes are: " + this.validElements.get(this.currentTag.getNodeName().toLowerCase()).toString() + ". TAG: " + this.currentTag.toString());
		}
	}
	}}
}
be.haxer.hxswfml.HXswfML.prototype.checkValidAttribute = function(a) {
	var validAttributes = this.validElements.get(this.currentTag.getNodeName().toLowerCase());
	{
		var _g = 0;
		while(_g < validAttributes.length) {
			var i = validAttributes[_g];
			++_g;
			if(a == i) return true;
		}
	}
	return false;
}
be.haxer.hxswfml.HXswfML.prototype.checkValidBaseClass = function(c) {
	{
		var _g = 0, _g1 = this.validBaseClasses;
		while(_g < _g1.length) {
			var i = _g1[_g];
			++_g;
			if(c == i) return true;
		}
	}
	return false;
}
be.haxer.hxswfml.HXswfML.prototype.createABC = function(className,baseClass) {
	var ctx = new format.abc.Context();
	var c = ctx.beginClass(className);
	c.superclass = ctx.type(baseClass);
	switch(baseClass) {
	case "flash.display.MovieClip":{
		ctx.addClassSuper("flash.events.EventDispatcher");
		ctx.addClassSuper("flash.display.DisplayObject");
		ctx.addClassSuper("flash.display.InteractiveObject");
		ctx.addClassSuper("flash.display.DisplayObjectContainer");
		ctx.addClassSuper("flash.display.Sprite");
		ctx.addClassSuper("flash.display.MovieClip");
	}break;
	case "flash.display.Sprite":{
		ctx.addClassSuper("flash.events.EventDispatcher");
		ctx.addClassSuper("flash.display.DisplayObject");
		ctx.addClassSuper("flash.display.InteractiveObject");
		ctx.addClassSuper("flash.display.DisplayObjectContainer");
		ctx.addClassSuper("flash.display.Sprite");
	}break;
	case "flash.display.SimpleButton":{
		ctx.addClassSuper("flash.events.EventDispatcher");
		ctx.addClassSuper("flash.display.DisplayObject");
		ctx.addClassSuper("flash.display.InteractiveObject");
		ctx.addClassSuper("flash.display.SimpleButton");
	}break;
	case "flash.display.Bitmap":{
		ctx.addClassSuper("flash.events.EventDispatcher");
		ctx.addClassSuper("flash.display.DisplayObject");
		ctx.addClassSuper("flash.display.Bitmap");
	}break;
	case "flash.media.Sound":{
		ctx.addClassSuper("flash.events.EventDispatcher");
		ctx.addClassSuper("flash.media.Sound");
	}break;
	case "flash.text.Font":{
		ctx.addClassSuper("flash.text.Font");
	}break;
	case "flash.utils.ByteArray":{
		ctx.addClassSuper("flash.utils.ByteArray");
	}break;
	}
	var m = ctx.beginMethod(className,[],null,false,false,false,true);
	m.maxStack = 2;
	c.constructor = m.type;
	ctx.ops([format.abc.OpCode.OThis,format.abc.OpCode.OConstructSuper(0),format.abc.OpCode.ORetVoid]);
	ctx.finalize();
	var abcOutput = new haxe.io.BytesOutput();
	format.abc.Writer.write(abcOutput,ctx.getData());
	return format.swf.SWFTag.TActionScript3(abcOutput.getBytes(),{ id : 1, label : className});
}
be.haxer.hxswfml.HXswfML.prototype.createSWF = function(xml,swfWriter) {
	var swf = xml.firstElement();
	{ var $it18 = swf.elements();
	while( $it18.hasNext() ) { var tag = $it18.next();
	{
		this.currentTag = tag;
		this.checkUnknownAttributes();
		switch(this.currentTag.getNodeName().toLowerCase()) {
		case "header":{
			swfWriter.writeHeader(this.header());
		}break;
		case "fileattributes":{
			swfWriter.writeTag(this.fileAttributes());
		}break;
		case "setbackgroundcolor":{
			swfWriter.writeTag(this.setBackgroundColor());
		}break;
		case "scriptlimits":{
			swfWriter.writeTag(this.scriptLimits());
		}break;
		case "definebitsjpeg":{
			swfWriter.writeTag(this.defineBitsJPEG());
		}break;
		case "defineshape":{
			swfWriter.writeTag(this.defineShape());
		}break;
		case "definesprite":{
			swfWriter.writeTag(this.defineSprite());
		}break;
		case "definebutton":{
			swfWriter.writeTag(this.defineButton2());
		}break;
		case "definebinarydata":{
			swfWriter.writeTag(this.defineBinaryData());
		}break;
		case "definesound":{
			swfWriter.writeTag(this.defineSound());
		}break;
		case "definefont":{
			swfWriter.writeTag(this.defineFont());
		}break;
		case "defineedittext":{
			swfWriter.writeTag(this.defineEditText());
		}break;
		case "defineabc":{
			{
				var _g = 0, _g1 = this.defineABC();
				while(_g < _g1.length) {
					var tag1 = _g1[_g];
					++_g;
					swfWriter.writeTag(tag1);
				}
			}
		}break;
		case "definescalinggrid":{
			swfWriter.writeTag(this.defineScalingGrid());
		}break;
		case "placeobject":{
			swfWriter.writeTag(this.placeObject2());
		}break;
		case "removeobject":{
			swfWriter.writeTag(this.removeObject2());
		}break;
		case "startsound":{
			swfWriter.writeTag(this.startSound());
		}break;
		case "symbolclass":{
			{
				var _g = 0, _g1 = this.symbolClass();
				while(_g < _g1.length) {
					var tag1 = _g1[_g];
					++_g;
					swfWriter.writeTag(tag1);
				}
			}
		}break;
		case "exportassets":{
			{
				var _g = 0, _g1 = this.exportAssets();
				while(_g < _g1.length) {
					var tag1 = _g1[_g];
					++_g;
					swfWriter.writeTag(tag1);
				}
			}
		}break;
		case "metadata":{
			swfWriter.writeTag(this.metadata());
		}break;
		case "framelabel":{
			swfWriter.writeTag(this.frameLabel());
		}break;
		case "showframe":{
			swfWriter.writeTag(this.showFrame());
		}break;
		case "endframe":{
			swfWriter.writeTag(this.endFrame());
		}break;
		case "tween":{
			{
				var _g = 0, _g1 = this.tween();
				while(_g < _g1.length) {
					var tag1 = _g1[_g];
					++_g;
					swfWriter.writeTag(tag1);
				}
			}
		}break;
		case "custom":{
			swfWriter.writeTag(this.custom());
		}break;
		default:{
			this.error("!ERROR: " + this.currentTag.getNodeName() + " is not allowed inside an swf element. Valid children are: " + this.validChildren.get("swf").toString() + ". TAG: " + this.currentTag.toString());
		}break;
		}
	}
	}}
	swfWriter.writeEnd();
}
be.haxer.hxswfml.HXswfML.prototype.createXML = function(mod) {
	var xmlString = "";
	xmlString += "<?xml version=\"1.0\" encoding =\"utf-8\"?>";
	xmlString += "<swc xmlns=\"http://www.adobe.com/flash/swccatalog/9\">";
	xmlString += "<versions>";
	xmlString += "<swc version=\"1.2\"/>";
	xmlString += "<haxe version=\"2.04\"/>";
	xmlString += "</versions>";
	xmlString += "<features>";
	xmlString += "<feature-script-deps/>";
	xmlString += "<feature-files/>";
	xmlString += "</features>";
	xmlString += "<libraries>";
	xmlString += "<library path=\"library.swf\">";
	{
		var _g = 0, _g1 = this.swcClasses;
		while(_g < _g1.length) {
			var i = _g1[_g];
			++_g;
			var dep = i[1].split(".");
			xmlString += "<script name=\"" + i[0] + "\" mod=\"0\" >";
			xmlString += "<def id=\"" + i[0] + "\" />";
			xmlString += "<dep id=\"" + dep[0] + "." + dep[1] + ":" + dep[2] + "\" type=\"i\" />";
			xmlString += "<dep id=\"AS3\" type=\"n\" />";
			xmlString += "</script>";
		}
	}
	xmlString += "</library>";
	xmlString += "</libraries>";
	xmlString += "<files>";
	xmlString += "</files>";
	xmlString += "</swc>";
	return xmlString;
}
be.haxer.hxswfml.HXswfML.prototype.currentTag = null;
be.haxer.hxswfml.HXswfML.prototype.custom = function() {
	var tagId = this.getInt("tagId",null,false);
	var data;
	var file = this.getString("file","",false);
	if(file == "") {
		var str = this.getString("data","",true);
		var arr = str.split(",");
		var buffer = new haxe.io.BytesBuffer();
		{
			var _g1 = 0, _g = arr.length;
			while(_g1 < _g) {
				var i = _g1++;
				buffer.b.push(Std.parseInt(arr[i]));
			}
		}
		data = buffer.getBytes();
	}
	else {
		data = this.getBytes(file);
	}
	return format.swf.SWFTag.TUnknown(tagId,data);
}
be.haxer.hxswfml.HXswfML.prototype.defineABC = function() {
	var abcTags = new Array();
	var name = this.getString("name",null,false);
	var remap = this.getString("remap","");
	var file;
	if(this.currentTag.elements().hasNext()) {
		var hxavm2 = new be.haxer.hxswfml.Hxavm2();
		hxavm2.name = name;
		abcTags = hxavm2.xml2abc(this.currentTag.elements().next().toString());
	}
	else {
		file = this.getString("file","",true);
		if(StringTools.endsWith(file,".abc")) {
			var abc = this.getBytes(file);
			abcTags.push(format.swf.SWFTag.TActionScript3(abc,(name == null?null:{ id : 1, label : name})));
		}
		else if(StringTools.endsWith(file,".swf")) {
			var swf = this.getBytes(file);
			var swfBytesInput = new haxe.io.BytesInput(swf);
			var swfReader = new format.swf.Reader(swfBytesInput);
			var header = swfReader.readHeader();
			var tags = swfReader.readTagList();
			swfBytesInput.close();
			var lookupStrings = ["Boot","Lib","Type"];
			{
				var _g = 0;
				while(_g < tags.length) {
					var tag = tags[_g];
					++_g;
					var $e = (tag);
					switch( $e[1] ) {
					case 13:
					var ctx = $e[3], data = $e[2];
					{
						if(remap == "") {
							abcTags.push(format.swf.SWFTag.TActionScript3(data,ctx));
						}
						else {
							var abcReader = new format.abc.Reader(new haxe.io.BytesInput(data));
							var abcFile = abcReader.read();
							var cpoolStrings = abcFile.strings;
							{
								var _g2 = 0, _g1 = cpoolStrings.length;
								while(_g2 < _g1) {
									var i = _g2++;
									{
										var _g3 = 0;
										while(_g3 < lookupStrings.length) {
											var s = lookupStrings[_g3];
											++_g3;
											var regex = new EReg("\\b" + s + "\\b","");
											var str = cpoolStrings[i];
											if(regex.match(str)) {
												this.inform("<-" + cpoolStrings[i]);
												cpoolStrings[i] = regex.replace(str,s + remap);
												this.inform("->" + cpoolStrings[i]);
											}
										}
									}
								}
							}
							var abcOutput = new haxe.io.BytesOutput();
							format.abc.Writer.write(abcOutput,abcFile);
							var abcBytes = abcOutput.getBytes();
							abcTags.push(format.swf.SWFTag.TActionScript3(abcBytes,ctx));
						}
					}break;
					default:{
						null;
					}break;
					}
				}
			}
			if(abcTags.length == 0) this.error("!ERROR: No ABC files were found inside the given file " + file + ". TAG : " + this.currentTag.toString());
		}
		else if(StringTools.endsWith(file,".xml")) {
			var xml = this.getContent(file);
			var hxavm2 = new be.haxer.hxswfml.Hxavm2();
			hxavm2.name = name;
			abcTags = hxavm2.xml2abc(xml);
		}
	}
	return abcTags;
}
be.haxer.hxswfml.HXswfML.prototype.defineBinaryData = function() {
	var id = this.getInt("id",null,true,true);
	var file = this.getString("file","",true);
	var bytes = this.getBytes(file);
	return format.swf.SWFTag.TBinaryData(id,bytes);
}
be.haxer.hxswfml.HXswfML.prototype.defineBitsJPEG = function() {
	var id = this.getInt("id",null,true,true);
	var file = this.getString("file","",true);
	var bytes = this.getBytes(file);
	this.storeWidthHeight(id,file,bytes);
	return format.swf.SWFTag.TBitsJPEG(id,format.swf.JPEGData.JDJPEG2(bytes));
}
be.haxer.hxswfml.HXswfML.prototype.defineButton2 = function() {
	var id = this.getInt("id",null,true,true);
	var buttonRecords = new Array();
	{ var $it19 = this.currentTag.elements();
	while( $it19.hasNext() ) { var buttonRecord = $it19.next();
	{
		this.currentTag = buttonRecord;
		this.checkUnknownAttributes();
		switch(this.currentTag.getNodeName().toLowerCase()) {
		case "buttonstate":{
			var hit = this.getBool("hit",false);
			var down = this.getBool("down",false);
			var over = this.getBool("over",false);
			var up = this.getBool("up",false);
			if(hit == false && down == false && over == false && up == false) {
				this.error("!ERROR: You need to set at least one button state to true. TAG: " + this.currentTag.toString());
			}
			var id1 = this.getInt("id",null,true,false,true);
			var depth = this.getInt("depth",null,true);
			buttonRecords.push({ hit : hit, down : down, over : over, up : up, id : id1, depth : depth, matrix : this.getMatrix()});
		}break;
		default:{
			this.error("!ERROR: " + this.currentTag.getNodeName() + " is not allowed inside a DefineButton element. Valid children are: " + this.validChildren.get("definebutton").toString() + ". TAG: " + this.currentTag.toString());
		}break;
		}
	}
	}}
	if(buttonRecords.length == 0) this.error("!ERROR: You need to supply at least one buttonstate element. TAG: " + this.currentTag.toString());
	return format.swf.SWFTag.TDefineButton2(id,buttonRecords);
}
be.haxer.hxswfml.HXswfML.prototype.defineEditText = function() {
	var id = this.getInt("id",null,true,true);
	var fontID = this.getInt("fontID",null);
	if(this.strict) {
		if(fontID != null && this.dictionary[fontID] != "definefont") this.error("!ERROR: The id " + fontID + " must be a reference to a DefineFont tag. TAG: " + this.currentTag.toString());
	}
	var textColor = this.getInt("textColor",255);
	return format.swf.SWFTag.TDefineEditText(id,{ bounds : { left : 0, right : this.getInt("width",100) * 20, top : 0, bottom : this.getInt("height",100) * 20}, hasText : ((this.getString("initialText","") != "")?true:false), hasTextColor : true, hasMaxLength : ((this.getInt("maxLength",0) != 0)?true:false), hasFont : ((this.getInt("fontID",0) != 0)?true:false), hasFontClass : ((this.getString("fontClass","") != "")?true:false), hasLayout : ((this.getInt("align",0) != 0 || this.getInt("leftMargin",0) * 20 != 0 || this.getInt("rightMargin",0) * 20 != 0 || this.getInt("indent",0) * 20 != 0 || this.getInt("leading",0) * 20 != 0)?true:false), wordWrap : this.getBool("wordWrap",true), multiline : this.getBool("multiline",true), password : this.getBool("password",false), input : !this.getBool("input",false), autoSize : this.getBool("autoSize",false), selectable : !this.getBool("selectable",false), border : this.getBool("border",false), wasStatic : this.getBool("wasStatic",false), html : this.getBool("html",false), useOutlines : this.getBool("useOutlines",false), fontID : this.getInt("fontID",null), fontClass : this.getString("fontClass",""), fontHeight : this.getInt("fontHeight",12) * 20, textColor : { r : (textColor & -16777216) >> 24, g : (textColor & 16711680) >> 16, b : (textColor & 65280) >> 8, a : (textColor & 255)}, maxLength : this.getInt("maxLength",0), align : this.getInt("align",0), leftMargin : this.getInt("leftMargin",0) * 20, rightMargin : this.getInt("rightMargin",0) * 20, indent : this.getInt("indent",0) * 20, leading : this.getInt("leading",0) * 20, variableName : this.getString("variableName",""), initialText : this.getString("initialText","")});
}
be.haxer.hxswfml.HXswfML.prototype.defineFont = function() {
	var _id = this.getInt("id",null,true,true);
	var file = this.getString("file","",true);
	var swf = this.getBytes(file);
	var swfBytesInput = new haxe.io.BytesInput(swf);
	var swfReader = new format.swf.Reader(swfBytesInput);
	var header = swfReader.readHeader();
	var tags = swfReader.readTagList();
	swfBytesInput.close();
	var fontTag = null;
	{
		var _g = 0;
		while(_g < tags.length) {
			var tag = tags[_g];
			++_g;
			var $e = (tag);
			switch( $e[1] ) {
			case 4:
			var data = $e[3], id = $e[2];
			{
				fontTag = format.swf.SWFTag.TFont(_id,data);
			}break;
			default:{
				null;
			}break;
			}
		}
	}
	if(fontTag == null) this.error("!ERROR: No Font definitions were found inside swf: " + file + ", TAG: " + this.currentTag.toString());
	return fontTag;
}
be.haxer.hxswfml.HXswfML.prototype.defineScalingGrid = function() {
	var id = this.getInt("id",null,true,false,true);
	var x = this.getInt("x",null,true) * 20;
	var y = this.getInt("y",null,true) * 20;
	var width = this.getInt("width",null,true) * 20;
	var height = this.getInt("height",null,true) * 20;
	var splitter = { left : x, right : x + width, top : y, bottom : y + height}
	return format.swf.SWFTag.TDefineScalingGrid(id,splitter);
}
be.haxer.hxswfml.HXswfML.prototype.defineShape = function() {
	var id = this.getInt("id",null,true,true);
	var bounds;
	var shapeWithStyle;
	if(this.currentTag.exists("bitmapId")) {
		var bitmapId = this.getInt("bitmapId",null);
		if(this.strict) {
			if(this.dictionary[bitmapId] != "definebitsjpeg") {
				this.error("!ERROR: bitmapId " + bitmapId + " must be a reference to a DefineBitsJPEG tag. TAG: " + this.currentTag.toString());
			}
		}
		var width = this.bitmapIds[bitmapId][0] * 20;
		var height = this.bitmapIds[bitmapId][1] * 20;
		var scaleX = this.getFloat("scaleX",1.0) * 20;
		var scaleY = this.getFloat("scaleY",1.0) * 20;
		var scale = { x : scaleX, y : scaleY}
		var rotate0 = this.getFloat("rotate0",0.0);
		var rotate1 = this.getFloat("rotate1",0.0);
		var rotate = { rs0 : rotate0, rs1 : rotate1}
		var x = this.getInt("x",0) * 20;
		var y = this.getInt("y",0) * 20;
		var translate = { x : x, y : y}
		var repeat = this.getBool("repeat",false);
		var smooth = this.getBool("smooth",false);
		bounds = { left : x, right : x + width, top : y, bottom : y + height}
		shapeWithStyle = { fillStyles : [format.swf.FillStyle.FSBitmap(bitmapId,{ scale : scale, rotate : rotate, translate : translate},repeat,smooth)], lineStyles : [], shapeRecords : [format.swf.ShapeRecord.SHRChange({ moveTo : { dx : x + width, dy : y}, fillStyle0 : { idx : 1}, fillStyle1 : null, lineStyle : null, newStyles : null}),format.swf.ShapeRecord.SHREdge(x,y + height),format.swf.ShapeRecord.SHREdge(x - width,y),format.swf.ShapeRecord.SHREdge(x,y - height),format.swf.ShapeRecord.SHREdge(x + width,y),format.swf.ShapeRecord.SHREnd]}
		return format.swf.SWFTag.TShape(id,format.swf.ShapeData.SHDShape1(bounds,shapeWithStyle));
	}
	else {
		var hxg = new be.haxer.hxswfml.HxGraphix();
		{ var $it20 = this.currentTag.elements();
		while( $it20.hasNext() ) { var cmd = $it20.next();
		{
			this.currentTag = cmd;
			this.checkUnknownAttributes();
			switch(this.currentTag.getNodeName().toLowerCase()) {
			case "beginfill":{
				var color = this.getInt("color",0);
				var alpha = this.getFloat("alpha",1.0);
				hxg.beginFill(color,alpha);
			}break;
			case "begingradientfill":{
				var type = this.getString("type","",true);
				switch(type) {
				case "linear":case "radial":{
					var colors = this.getString("colors","",true).split(",");
					var alphas = this.getString("alphas","",true).split(",");
					var ratios = this.getString("ratios","",true).split(",");
					var x = this.getFloat("x",0.0);
					var y = this.getFloat("y",0.0);
					var scaleX = this.getFloat("scaleX",1.0);
					var scaleY = this.getFloat("scaleY",1.0);
					var rotate0 = this.getFloat("rotate0",0.0);
					var rotate1 = this.getFloat("rotate1",0.0);
					hxg.beginGradientFill(type,colors,alphas,ratios,x,y,scaleX,scaleY,rotate0,rotate1);
				}break;
				default:{
					this.error("ERROR! Invalid gradient type " + type + ". Valid types are: radial,linear. TAG: " + this.currentTag.toString());
				}break;
				}
			}break;
			case "beginbitmapfill":{
				var bitmapId = this.getInt("bitmapId",null,true);
				if(this.strict) {
					if(this.dictionary[bitmapId] != "definebitsjpeg") {
						this.error("!ERROR: bitmapId " + bitmapId + " must be a reference to a DefineBitsJPEG tag. TAG: " + this.currentTag.toString());
					}
				}
				var scaleX = this.getFloat("scaleX",1.0);
				var scaleY = this.getFloat("scaleY",1.0);
				var scale = { x : scaleX, y : scaleY}
				var rotate0 = this.getFloat("rotate0",0.0);
				var rotate1 = this.getFloat("rotate1",0.0);
				var rotate = { rs0 : rotate0, rs1 : rotate1}
				var x = this.getInt("x",0);
				var y = this.getInt("y",0);
				var translate = { x : x, y : y}
				var repeat = this.getBool("repeat",false);
				var smooth = this.getBool("smooth",false);
				hxg.beginBitmapFill(bitmapId,x,y,scaleX,scaleY,rotate0,rotate1,repeat,smooth);
			}break;
			case "linestyle":{
				var width = this.getFloat("width",1.0);
				var color = this.getInt("color",0);
				var alpha = this.getFloat("alpha",1.0);
				var pixelHinting = this.getBool("pixelHinting",null);
				var scaleMode = this.getString("scaleMode",null);
				var caps = this.getString("caps",null);
				var joints = this.getString("joints",null);
				var miterLimit = this.getInt("miterLimit",null);
				var noClose = this.getBool("noClose",null);
				hxg.lineStyle(width,color,alpha,pixelHinting,scaleMode,caps,joints,miterLimit,noClose);
			}break;
			case "moveto":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				hxg.moveTo(x,y);
			}break;
			case "lineto":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				hxg.lineTo(x,y);
			}break;
			case "curveto":{
				var cx = this.getFloat("cx",0.0);
				var cy = this.getFloat("cy",0.0);
				var ax = this.getFloat("ax",0.0);
				var ay = this.getFloat("ay",0.0);
				hxg.curveTo(cx,cy,ax,ay);
			}break;
			case "endfill":{
				hxg.endFill();
			}break;
			case "endline":{
				hxg.endLine();
			}break;
			case "clear":{
				hxg.clear();
			}break;
			case "drawcircle":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				var r = this.getFloat("r",0.0);
				var sections = this.getInt("sections",16);
				hxg.drawCircle(x,y,r,sections);
			}break;
			case "drawellipse":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				var w = this.getFloat("width",0.0);
				var h = this.getFloat("height",0.0);
				hxg.drawEllipse(x,y,w,h);
			}break;
			case "drawrect":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				var w = this.getFloat("width",0.0);
				var h = this.getFloat("height",0.0);
				hxg.drawRect(x,y,w,h);
			}break;
			case "drawroundrect":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				var w = this.getFloat("width",0.0);
				var h = this.getFloat("height",0.0);
				var r = this.getFloat("r",0.0);
				hxg.drawRoundRect(x,y,w,h,r);
			}break;
			case "drawroundrectcomplex":{
				var x = this.getFloat("x",0.0);
				var y = this.getFloat("y",0.0);
				var w = this.getFloat("width",0.0);
				var h = this.getFloat("height",0.0);
				var rtl = this.getFloat("rtl",0.0);
				var rtr = this.getFloat("rtr",0.0);
				var rbl = this.getFloat("rbl",0.0);
				var rbr = this.getFloat("rbr",0.0);
				hxg.drawRoundRectComplex(x,y,w,h,rtl,rtr,rbl,rbr);
			}break;
			default:{
				this.error("!ERROR: " + this.currentTag.getNodeName() + " is not allowed inside a DefineShape element. Valid children are: " + this.validChildren.get("defineshape").toString() + ". TAG: " + this.currentTag.toString());
			}break;
			}
		}
		}}
		return hxg.getTag(id);
	}
}
be.haxer.hxswfml.HXswfML.prototype.defineSound = function() {
	var file = this.getString("file","",true);
	var mp3FileBytes = new haxe.io.BytesInput(this.getBytes(file));
	var mp3Reader = new format.mp3.Reader(mp3FileBytes);
	var mp3 = mp3Reader.read();
	var mp3Frames = mp3.frames;
	var mp3Header = mp3Frames[0].header;
	var dataBytesOutput = new haxe.io.BytesOutput();
	var mp3Writer = new format.mp3.Writer(dataBytesOutput);
	mp3Writer.write(mp3,false);
	var sid = this.getInt("id",null,true,true);
	var samplingRate = (function($this) {
		var $r;
		var $e = (mp3Header.samplingRate);
		switch( $e[1] ) {
		case 1:
		{
			$r = format.swf.SoundRate.SR11k;
		}break;
		case 3:
		{
			$r = format.swf.SoundRate.SR22k;
		}break;
		case 6:
		{
			$r = format.swf.SoundRate.SR44k;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	if(samplingRate == null) this.error("!ERROR: Unsupported MP3 SoundRate " + mp3Header.samplingRate + " in " + file + ". TAG: " + this.currentTag.toString());
	return format.swf.SWFTag.TSound({ sid : sid, format : format.swf.SoundFormat.SFMP3, rate : samplingRate, is16bit : true, isStereo : (function($this) {
		var $r;
		var $e = (mp3Header.channelMode);
		switch( $e[1] ) {
		case 0:
		{
			$r = true;
		}break;
		case 1:
		{
			$r = true;
		}break;
		case 2:
		{
			$r = true;
		}break;
		case 3:
		{
			$r = false;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)), samples : mp3.sampleCount, data : format.swf.SoundData.SDMp3(0,dataBytesOutput.getBytes())});
}
be.haxer.hxswfml.HXswfML.prototype.defineSprite = function() {
	var id = this.getInt("id",null,true,true);
	var frames = this.getInt("frameCount",1);
	var showFrameCount = 0;
	var tags = new Array();
	var spriteTag = this.currentTag;
	{ var $it21 = this.currentTag.elements();
	while( $it21.hasNext() ) { var tag = $it21.next();
	{
		this.currentTag = tag;
		this.checkUnknownAttributes();
		switch(this.currentTag.getNodeName().toLowerCase()) {
		case "placeobject":{
			tags.push(this.placeObject2());
		}break;
		case "removeobject":{
			tags.push(this.removeObject2());
		}break;
		case "startsound":{
			tags.push(this.startSound());
		}break;
		case "framelabel":{
			tags.push(this.frameLabel());
		}break;
		case "showframe":{
			showFrameCount++;
			tags.push(this.showFrame());
		}break;
		case "endframe":{
			tags.push(this.endFrame());
		}break;
		case "tween":{
			{
				var _g = 0, _g1 = this.tween();
				while(_g < _g1.length) {
					var tag1 = _g1[_g];
					++_g;
					tags.push(tag1);
				}
			}
		}break;
		default:{
			this.error("!ERROR: " + this.currentTag.getNodeName() + " is not allowed inside a DefineSprite element. Valid children are: " + this.validChildren.get("definesprite").toString() + ". TAG: " + this.currentTag.toString());
		}break;
		}
	}
	}}
	return format.swf.SWFTag.TClip(id,frames,tags);
}
be.haxer.hxswfml.HXswfML.prototype.dictionary = null;
be.haxer.hxswfml.HXswfML.prototype.endFrame = function() {
	return format.swf.SWFTag.TEnd;
}
be.haxer.hxswfml.HXswfML.prototype.error = function(msg) {
	throw msg;
}
be.haxer.hxswfml.HXswfML.prototype.exportAssets = function() {
	var cid = this.getInt("id",null,true,false,true);
	var className = this.getString("class","",true);
	var symbols = [{ cid : cid, className : className}];
	return [format.swf.SWFTag.TExportAssets(symbols)];
}
be.haxer.hxswfml.HXswfML.prototype.fileAttributes = function() {
	return format.swf.SWFTag.TSandBox({ useDirectBlit : this.getBool("useDirectBlit",false), useGPU : this.getBool("useGPU",false), hasMetaData : this.getBool("hasMetaData",false), actionscript3 : this.getBool("actionscript3",true), useNetWork : this.getBool("useNetwork",false)});
}
be.haxer.hxswfml.HXswfML.prototype.frameLabel = function() {
	var label = this.getString("name","",true);
	var anchor = this.getBool("anchor",false);
	return format.swf.SWFTag.TFrameLabel(label,anchor);
}
be.haxer.hxswfml.HXswfML.prototype.getBool = function(att,defaultValue,required) {
	if(required == null) required = false;
	if(required) if(!this.currentTag.exists(att)) this.error("!ERROR: Required attribute " + att + " is missing in tag: " + this.currentTag);
	return (this.currentTag.exists(att)?((this.currentTag.get(att) == "true"?true:false)):defaultValue);
}
be.haxer.hxswfml.HXswfML.prototype.getBytes = function(file) {
	this.checkFileExistence(file);
	return haxe.io.Bytes.ofData(this.library.get(file));
}
be.haxer.hxswfml.HXswfML.prototype.getContent = function(file) {
	this.checkFileExistence(file);
	return Std.string(this.library.get(file));
}
be.haxer.hxswfml.HXswfML.prototype.getFloat = function(att,defaultValue,required) {
	if(required == null) required = false;
	if(this.currentTag.exists(att)) if(Math.isNaN(Std.parseFloat(this.currentTag.get(att)))) this.error("!ERROR: attribute " + att + " must be a number: " + this.currentTag.toString());
	if(required) if(!this.currentTag.exists(att)) this.error("!ERROR: Required attribute " + att + " is missing in tag: " + this.currentTag.toString());
	return (this.currentTag.exists(att)?Std.parseFloat(this.currentTag.get(att)):defaultValue);
}
be.haxer.hxswfml.HXswfML.prototype.getInt = function(att,defaultValue,required,uniqueId,targetId) {
	if(targetId == null) targetId = false;
	if(uniqueId == null) uniqueId = false;
	if(required == null) required = false;
	if(this.currentTag.exists(att)) if(Math.isNaN(Std.parseInt(this.currentTag.get(att)))) this.error("!ERROR: attribute " + att + " must be an integer: " + this.currentTag.toString());
	if(required) if(!this.currentTag.exists(att)) this.error("!ERROR: Required attribute " + att + " is missing in tag: " + this.currentTag.toString());
	if(uniqueId) this.checkDictionary(Std.parseInt(this.currentTag.get(att)));
	if(targetId) this.checkTargetId(Std.parseInt(this.currentTag.get(att)));
	return (this.currentTag.exists(att)?Std.parseInt(this.currentTag.get(att)):defaultValue);
}
be.haxer.hxswfml.HXswfML.prototype.getMatrix = function() {
	var scale, rotate, translate;
	var scaleX = this.getFloat("scaleX",null);
	var scaleY = this.getFloat("scaleY",null);
	scale = ((scaleX == null && scaleY == null)?null:{ x : (scaleX == null?1.0:scaleX), y : (scaleY == null?1.0:scaleY)});
	var rs0 = this.getFloat("rotate0",null);
	var rs1 = this.getFloat("rotate1",null);
	rotate = ((rs0 == null && rs1 == null)?null:{ rs0 : (rs0 == null?0.0:rs0), rs1 : (rs1 == null?0.0:rs1)});
	var x = this.getInt("x",0) * 20;
	var y = this.getInt("y",0) * 20;
	translate = { x : x, y : y}
	return { scale : scale, rotate : rotate, translate : translate}
}
be.haxer.hxswfml.HXswfML.prototype.getString = function(att,defaultValue,required) {
	if(required == null) required = false;
	if(required) if(!this.currentTag.exists(att)) this.error("!ERROR: Required attribute " + att + " is missing in tag: " + this.currentTag.toString());
	return (this.currentTag.exists(att)?this.currentTag.get(att):defaultValue);
}
be.haxer.hxswfml.HXswfML.prototype.header = function() {
	return { version : this.getInt("version",10), compressed : this.getBool("compressed",true), width : this.getInt("width",800), height : this.getInt("height",600), fps : this.getInt("fps",30), nframes : this.getInt("frameCount",1)}
}
be.haxer.hxswfml.HXswfML.prototype.inform = function(msg) {
	null;
}
be.haxer.hxswfml.HXswfML.prototype.library = null;
be.haxer.hxswfml.HXswfML.prototype.metadata = function() {
	var file = this.getString("file","",true);
	var data = this.getContent(file);
	return format.swf.SWFTag.TMetadata(data);
}
be.haxer.hxswfml.HXswfML.prototype.moveObject = function(depth,x,y,scaleX,scaleY,rs0,rs1) {
	var id = null;
	var depth1 = depth;
	var name = "";
	var move = true;
	var scale;
	if(scaleX == null && scaleY == null) scale = null;
	else if(scaleX == null && scaleY != null) scale = { x : 1.0, y : scaleY}
	else if(scaleX != null && scaleY == null) scale = { x : scaleX, y : 1.0}
	else scale = { x : scaleX, y : scaleY}
	var rotate;
	if(rs0 == null && rs1 == null) rotate = null;
	else if(rs0 == null && rs1 != null) rotate = { rs0 : 0.0, rs1 : rs1}
	else if(rs0 != null && rs1 == null) rotate = { rs0 : rs0, rs1 : 0.0}
	else rotate = { rs0 : rs0, rs1 : rs1}
	var translate = { x : x, y : y}
	var placeObject = new format.swf.PlaceObject();
	placeObject.depth = depth1;
	placeObject.move = move;
	placeObject.cid = id;
	placeObject.matrix = { scale : scale, rotate : rotate, translate : translate}
	placeObject.color = null;
	placeObject.ratio = null;
	placeObject.instanceName = (name == ""?null:name);
	placeObject.clipDepth = null;
	placeObject.events = null;
	placeObject.filters = null;
	placeObject.blendMode = null;
	placeObject.bitmapCache = false;
	return format.swf.SWFTag.TPlaceObject2(placeObject);
}
be.haxer.hxswfml.HXswfML.prototype.placeObject2 = function() {
	var id = this.getInt("id",null);
	if(id != null) this.checkTargetId(id);
	var depth = this.getInt("depth",null,true);
	var name = this.getString("name","");
	var move = this.getBool("move",false);
	var placeObject = new format.swf.PlaceObject();
	placeObject.depth = depth;
	placeObject.move = !(move?null:true);
	placeObject.cid = id;
	placeObject.matrix = this.getMatrix();
	placeObject.color = null;
	placeObject.ratio = null;
	placeObject.instanceName = (name == ""?null:name);
	placeObject.clipDepth = null;
	placeObject.events = null;
	placeObject.filters = null;
	placeObject.blendMode = null;
	placeObject.bitmapCache = false;
	return format.swf.SWFTag.TPlaceObject2(placeObject);
}
be.haxer.hxswfml.HXswfML.prototype.removeObject2 = function() {
	var depth = this.getInt("depth",null,true);
	return format.swf.SWFTag.TRemoveObject2(depth);
}
be.haxer.hxswfml.HXswfML.prototype.scriptLimits = function() {
	var maxRecursion = this.getInt("maxRecursionDepth",256);
	var timeoutSeconds = this.getInt("scriptTimeoutSeconds",15);
	return format.swf.SWFTag.TScriptLimits(maxRecursion,timeoutSeconds);
}
be.haxer.hxswfml.HXswfML.prototype.setBackgroundColor = function() {
	return format.swf.SWFTag.TBackgroundColor(this.getInt("color",16777215));
}
be.haxer.hxswfml.HXswfML.prototype.setup = function() {
	this.validChildren = new Hash();
	this.validChildren.set("swf",["header","fileattributes","setbackgroundcolor","scriptlimits","definebitsjpeg","defineshape","definesprite","definebutton","definebinarydata","definesound","definefont","defineedittext","defineabc","definescalinggrid","placeobject","removeobject","startsound","symbolclass","exportassets","metadata","framelabel","showframe","endframe","custom"]);
	this.validChildren.set("defineshape",["beginfill","begingradientfill","beginbitmapfill","linestyle","moveto","lineto","curveto","endfill","endline","clear","drawcircle","drawellipse","drawrect","drawroundrect","drawroundrectcomplex","custom"]);
	this.validChildren.set("definesprite",["placeobject","removeobject","startsound","framelabel","showframe","endframe","tween","custom"]);
	this.validChildren.set("definebutton",["buttonstate","custom"]);
	this.validChildren.set("tween",["tw","custom"]);
	this.validElements = new Hash();
	this.validElements.set("swf",[]);
	this.validElements.set("header",["width","height","fps","version","compressed","frameCount"]);
	this.validElements.set("fileattributes",["actionscript3","useNetwork","useDirectBlit","useGPU","hasMetaData"]);
	this.validElements.set("setbackgroundcolor",["color"]);
	this.validElements.set("scriptlimits",["maxRecursionDepth","scriptTimeoutSeconds"]);
	this.validElements.set("definebitsjpeg",["id","file"]);
	this.validElements.set("defineshape",["id","bitmapId","x","y","scaleX","scaleY","rotate0","rotate1","repeat","smooth"]);
	this.validElements.set("beginfill",["color","alpha"]);
	this.validElements.set("begingradientfill",["colors","alphas","ratios","type","x","y","scaleX","scaleY","rotate0","rotate1"]);
	this.validElements.set("beginbitmapfill",["bitmapId","x","y","scaleX","scaleY","rotate0","rotate1","repeat","smooth"]);
	this.validElements.set("linestyle",["width","color","alpha"]);
	this.validElements.set("moveto",["x","y"]);
	this.validElements.set("lineto",["x","y"]);
	this.validElements.set("curveto",["cx","cy","ax","ay"]);
	this.validElements.set("endfill",[]);
	this.validElements.set("endline",[]);
	this.validElements.set("clear",[]);
	this.validElements.set("drawcircle",["x","y","r","sections"]);
	this.validElements.set("drawellipse",["x","y","width","height"]);
	this.validElements.set("drawrect",["x","y","width","height"]);
	this.validElements.set("drawroundrect",["x","y","width","height","r"]);
	this.validElements.set("drawroundrectcomplex",["x","y","width","height","rtl","rtr","rbl","rbr"]);
	this.validElements.set("definesprite",["id","frameCount"]);
	this.validElements.set("definebutton",["id"]);
	this.validElements.set("buttonstate",["id","depth","hit","down","over","up","x","y","scaleX","scaleY","rotate0","rotate1"]);
	this.validElements.set("definebinarydata",["id","file"]);
	this.validElements.set("definesound",["id","file"]);
	this.validElements.set("definefont",["id","file"]);
	this.validElements.set("defineedittext",["id","initialText","fontID","useOutlines","width","height","wordWrap","multiline","password","input","autoSize","selectable","border","wasStatic","html","fontClass","fontHeight","textColor","maxLength","align","leftMargin","rightMargin","indent","leading","variableName","file"]);
	this.validElements.set("defineabc",["file","name"]);
	this.validElements.set("definescalinggrid",["id","x","width","y","height"]);
	this.validElements.set("placeobject",["id","depth","name","move","x","y","scaleX","scaleY","rotate0","rotate1"]);
	this.validElements.set("removeobject",["depth"]);
	this.validElements.set("startsound",["id","stop","loopCount"]);
	this.validElements.set("symbolclass",["id","class","base"]);
	this.validElements.set("exportassets",["id","class"]);
	this.validElements.set("metadata",["file"]);
	this.validElements.set("framelabel",["name","anchor"]);
	this.validElements.set("showframe",[]);
	this.validElements.set("endframe",[]);
	this.validElements.set("tween",["depth","frameCount"]);
	this.validElements.set("tw",["prop","start","end"]);
	this.validElements.set("custom",["tagId","file","data","comment"]);
	this.validBaseClasses = ["flash.display.MovieClip","flash.display.Sprite","flash.display.SimpleButton","flash.display.Bitmap","flash.media.Sound","flash.text.Font","flash.utils.ByteArray"];
}
be.haxer.hxswfml.HXswfML.prototype.showFrame = function() {
	return format.swf.SWFTag.TShowFrame;
}
be.haxer.hxswfml.HXswfML.prototype.startSound = function() {
	var id = this.getInt("id",null,true,false,true);
	var stop = this.getBool("stop",false);
	var loopCount = this.getInt("loopCount",0);
	var hasLoops = (loopCount == 0?false:true);
	return format.swf.SWFTag.TStartSound(id,{ syncStop : stop, hasLoops : hasLoops, loopCount : loopCount});
}
be.haxer.hxswfml.HXswfML.prototype.storeWidthHeight = function(id,fileName,b) {
	var extension = fileName.substr(fileName.lastIndexOf(".") + 1).toLowerCase();
	var height = 0;
	var width = 0;
	var bytes = new haxe.io.BytesInput(b);
	if(extension == "jpg" || extension == "jpeg") {
		if(bytes.readByte() != 255 || bytes.readByte() != 216) {
			this.error("!ERROR: in image file: " + fileName + ". SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: " + this.currentTag.toString());
		}
		var marker;
		var len;
		while(bytes.readByte() == 255) {
			marker = bytes.readByte();
			len = (bytes.readByte() << 8 | bytes.readByte());
			if(marker == 192) {
				bytes.readByte();
				height = (bytes.readByte() << 8 | bytes.readByte());
				width = (bytes.readByte() << 8 | bytes.readByte());
				break;
			}
			bytes.read(len - 2);
		}
	}
	else if(extension == "png") {
		bytes.setEndian(true);
		bytes.readInt32();
		bytes.readInt32();
		bytes.readInt32();
		bytes.readInt32();
		width = bytes.readUInt30();
		height = bytes.readUInt30();
	}
	else if(extension == "gif") {
		bytes.setEndian(false);
		bytes.readInt32();
		bytes.readUInt16();
		width = bytes.readUInt16();
		height = bytes.readUInt16();
	}
	this.bitmapIds[id] = [width,height];
}
be.haxer.hxswfml.HXswfML.prototype.strict = null;
be.haxer.hxswfml.HXswfML.prototype.swcClasses = null;
be.haxer.hxswfml.HXswfML.prototype.symbolClass = function() {
	var cid = this.getInt("id",null,true,false,true);
	var className = this.getString("class","",true);
	var symbols = [{ cid : cid, className : className}];
	var baseClass = this.getString("base","");
	var tags = new Array();
	if(baseClass != "") {
		if(this.checkValidBaseClass(baseClass)) {
			this.swcClasses.push([className,baseClass]);
			tags = [this.createABC(className,baseClass),format.swf.SWFTag.TSymbolClass(symbols)];
		}
		else {
			this.error("!ERROR: Invalid base class: " + baseClass + ". Valid base classes are: " + this.validBaseClasses.toString() + ". TAG: " + this.currentTag.toString());
		}
	}
	else {
		tags = [format.swf.SWFTag.TSymbolClass(symbols)];
	}
	return tags;
}
be.haxer.hxswfml.HXswfML.prototype.tween = function() {
	var depth = this.getInt("depth",null,true);
	var frameCount = this.getInt("frameCount",null,true);
	var startX = null;
	var startY = null;
	var endX = null;
	var endY = null;
	var startScaleX = null;
	var startScaleY = null;
	var endScaleX = null;
	var endScaleY = null;
	var startRotateO = null;
	var startRotate1 = null;
	var endRotateO = null;
	var endRotate1 = null;
	{ var $it22 = this.currentTag.elements();
	while( $it22.hasNext() ) { var tagNode = $it22.next();
	{
		this.currentTag = tagNode;
		this.checkUnknownAttributes();
		switch(this.currentTag.getNodeName().toLowerCase()) {
		case "tw":{
			var prop = this.getString("prop","");
			var startxy = null;
			var endxy = null;
			var start = null;
			var end = null;
			if(prop == "x" || prop == "y") {
				startxy = this.getInt("start",0,true);
				endxy = this.getInt("end",0,true);
			}
			else {
				start = this.getFloat("start",null,true);
				end = this.getFloat("end",null,true);
			}
			switch(prop) {
			case "x":{
				startX = startxy;
				endX = endxy;
			}break;
			case "y":{
				startY = startxy;
				endY = endxy;
			}break;
			case "scaleX":{
				startScaleX = start;
				endScaleX = end;
			}break;
			case "scaleY":{
				startScaleY = start;
				endScaleY = end;
			}break;
			case "rotate0":{
				startRotateO = start;
				endRotateO = end;
			}break;
			case "rotate1":{
				startRotate1 = start;
				endRotate1 = end;
			}break;
			default:{
				this.error("!ERROR: Unsupported " + prop + " in TW element. Tweenable properties are: x, y, scaleX, scaleY, rotateO, rotate1. TAG: " + this.currentTag.toString());
			}break;
			}
		}break;
		default:{
			this.error("!ERROR: " + this.currentTag.getNodeName() + " is not allowed inside a Tween element.  Valid children are: " + this.validChildren.get("tween").toString() + ". TAG: " + this.currentTag.toString());
		}break;
		}
	}
	}}
	var tags = new Array();
	{
		var _g = 0;
		while(_g < frameCount) {
			var i = _g++;
			var dx = ((startX == null || endX == null)?0:Std["int"](startX + ((endX - startX) * i) / frameCount));
			var dy = ((startY == null || endY == null)?0:Std["int"](startY + ((endY - startY) * i) / frameCount));
			var dsx = ((startScaleX == null || endScaleX == null)?null:startScaleX + ((endScaleX - startScaleX) * i) / frameCount);
			var dsy = ((startScaleY == null || endScaleY == null)?null:startScaleY + ((endScaleY - startScaleY) * i) / frameCount);
			var drs0 = ((startRotateO == null || endRotateO == null)?null:startRotateO + ((endRotateO - startRotateO) * i) / frameCount);
			var drs1 = ((startRotate1 == null || endRotate1 == null)?null:startRotate1 + ((endRotate1 - startRotate1) * i) / frameCount);
			tags.push(this.moveObject(depth,dx * 20,dy * 20,dsx,dsy,drs0,drs1));
			tags.push(this.showFrame());
		}
	}
	return tags;
}
be.haxer.hxswfml.HXswfML.prototype.validBaseClasses = null;
be.haxer.hxswfml.HXswfML.prototype.validChildren = null;
be.haxer.hxswfml.HXswfML.prototype.validElements = null;
be.haxer.hxswfml.HXswfML.prototype.xml2swf = function(input,fileOut) {
	var xml = Xml.parse(input);
	var swfBytesOutput = new haxe.io.BytesOutput();
	var swfWriter = new format.swf.Writer(swfBytesOutput);
	this.createSWF(xml,swfWriter);
	var swfBytes = swfBytesOutput.getBytes();
	if(StringTools.endsWith(fileOut,".swf")) {
		return swfBytes;
	}
	else if(StringTools.endsWith(fileOut,".swc")) {
		var date = Date.now();
		var mod = date.getTime();
		var xmlBytesOutput = new haxe.io.BytesOutput();
		xmlBytesOutput.write(haxe.io.Bytes.ofString(this.createXML(mod)));
		var xmlBytes = xmlBytesOutput.getBytes();
		var zipBytesOutput = new haxe.io.BytesOutput();
		var zipWriter = new format.zip.Writer(zipBytesOutput);
		var data = new List();
		data.push({ fileName : "catalog.xml", fileSize : xmlBytes.length, fileTime : date, compressed : false, dataSize : xmlBytes.length, data : xmlBytes, crc32 : format.tools.CRC32.encode(xmlBytes), extraFields : null});
		data.push({ fileName : "library.swf", fileSize : swfBytes.length, fileTime : date, compressed : false, dataSize : swfBytes.length, data : swfBytes, crc32 : format.tools.CRC32.encode(swfBytes), extraFields : null});
		zipWriter.writeData(data);
		return zipBytesOutput.getBytes();
	}
	else {
		this.error("!ERROR: Supported file formats for output are .swf and .swc");
		return null;
	}
}
be.haxer.hxswfml.HXswfML.prototype.__class__ = be.haxer.hxswfml.HXswfML;
format.mp3.Writer = function(output) { if( output === $_ ) return; {
	this.o = output;
	this.o.setEndian(true);
	this.bits = new format.tools.BitsOutput(this.o);
}}
format.mp3.Writer.__name__ = ["format","mp3","Writer"];
format.mp3.Writer.prototype.bits = null;
format.mp3.Writer.prototype.o = null;
format.mp3.Writer.prototype.write = function(mp3,writeId3v2) {
	if(writeId3v2 == null) writeId3v2 = true;
	if(writeId3v2 && mp3.id3v2 != null) this.writeID3v2(mp3.id3v2);
	{
		var _g = 0, _g1 = mp3.frames;
		while(_g < _g1.length) {
			var f = _g1[_g];
			++_g;
			this.writeFrame(f);
		}
	}
}
format.mp3.Writer.prototype.writeFrame = function(f) {
	this.o.writeByte(255);
	this.bits.writeBits(3,7);
	var h = f.header;
	this.bits.writeBits(2,format.mp3.MPEG.enum2Num(h.version));
	this.bits.writeBits(2,format.mp3.CLayer.enum2Num(h.layer));
	this.bits.writeBit(!h.hasCrc);
	this.bits.writeBits(4,format.mp3.MPEG.getBitrateIdx(h.bitrate,h.version,h.layer));
	this.bits.writeBits(2,format.mp3.MPEG.getSamplingRateIdx(h.samplingRate,h.version));
	this.bits.writeBit(h.isPadded);
	this.bits.writeBit(h.privateBit);
	this.bits.writeBits(2,format.mp3.CChannelMode.enum2Num(h.channelMode));
	this.bits.writeBit(h.isIntensityStereo);
	this.bits.writeBit(h.isMSStereo);
	this.bits.writeBit(h.isCopyrighted);
	this.bits.writeBit(h.isOriginal);
	this.bits.writeBits(2,format.mp3.CEmphasis.enum2Num(h.emphasis));
	this.bits.flush();
	if(h.hasCrc) {
		this.o.writeUInt16(h.crc16);
	}
	this.o.write(f.data);
}
format.mp3.Writer.prototype.writeID3v2 = function(id3v2) {
	this.o.writeString("ID3");
	this.o.writeUInt16(id3v2.versionBytes);
	this.o.writeByte(id3v2.flagByte);
	var arr = new Array();
	var l = id3v2.data.length;
	{
		var _g = 0;
		while(_g < 4) {
			var i = _g++;
			arr.push(l & 127);
			l >>= 7;
		}
	}
	{
		var _g = 0;
		while(_g < 4) {
			var i = _g++;
			this.bits.writeBit(false);
			this.bits.writeBits(7,arr[3 - i]);
		}
	}
	this.bits.flush();
	this.o.write(id3v2.data);
}
format.mp3.Writer.prototype.__class__ = format.mp3.Writer;
format.tools.Deflate = function() { }
format.tools.Deflate.__name__ = ["format","tools","Deflate"];
format.tools.Deflate.run = function(b) {
	throw "Deflate is not supported on this platform";
	return null;
}
format.tools.Deflate.prototype.__class__ = format.tools.Deflate;
format.tools.CRC32 = function(p) { if( p === $_ ) return; {
	this.crc = -1;
}}
format.tools.CRC32.__name__ = ["format","tools","CRC32"];
format.tools.CRC32.encode = function(b) {
	var c = new format.tools.CRC32();
	c.run(b);
	return c.get();
}
format.tools.CRC32.prototype["byte"] = function(b) {
	var polynom = -306674912;
	var tmp = ((this.crc) ^ (b)) & 255;
	{
		var _g = 0;
		while(_g < 8) {
			var j = _g++;
			if(((tmp) & 1) == 1) tmp = (((tmp) >>> 1) ^ (polynom));
			else tmp = (tmp) >>> 1;
		}
	}
	this.crc = (((this.crc) >>> 8) ^ (tmp));
}
format.tools.CRC32.prototype.crc = null;
format.tools.CRC32.prototype.get = function() {
	return (this.crc) ^ -1;
}
format.tools.CRC32.prototype.run = function(b) {
	var crc = this.crc;
	var polynom = -306674912;
	{
		var _g1 = 0, _g = b.length;
		while(_g1 < _g) {
			var i = _g1++;
			var tmp = ((crc) ^ (b.b[i])) & 255;
			{
				var _g2 = 0;
				while(_g2 < 8) {
					var j = _g2++;
					if(((tmp) & 1) == 1) tmp = (((tmp) >>> 1) ^ (polynom));
					else tmp = (tmp) >>> 1;
				}
			}
			crc = (((crc) >>> 8) ^ (tmp));
		}
	}
	this.crc = crc;
}
format.tools.CRC32.prototype.__class__ = format.tools.CRC32;
format.abc._Context = {}
format.abc._Context.NullOutput = function(p) { if( p === $_ ) return; {
	this.n = 0;
}}
format.abc._Context.NullOutput.__name__ = ["format","abc","_Context","NullOutput"];
format.abc._Context.NullOutput.__super__ = haxe.io.Output;
for(var k in haxe.io.Output.prototype ) format.abc._Context.NullOutput.prototype[k] = haxe.io.Output.prototype[k];
format.abc._Context.NullOutput.prototype.n = null;
format.abc._Context.NullOutput.prototype.writeByte = function(c) {
	this.n++;
}
format.abc._Context.NullOutput.prototype.writeBytes = function(b,pos,len) {
	this.n += len;
	return len;
}
format.abc._Context.NullOutput.prototype.__class__ = format.abc._Context.NullOutput;
format.abc.Context = function(p) { if( p === $_ ) return; {
	this.classSupers = new List();
	this.bytepos = new format.abc._Context.NullOutput();
	this.opw = new format.abc.OpWriter(this.bytepos);
	this.hstrings = new Hash();
	this.data = new format.abc.ABCData();
	this.data.ints = new Array();
	this.data.uints = new Array();
	this.data.floats = new Array();
	this.data.strings = new Array();
	this.data.namespaces = new Array();
	this.data.nssets = new Array();
	this.data.metadatas = new Array();
	this.data.methodTypes = new Array();
	this.data.names = new Array();
	this.data.classes = new Array();
	this.data.functions = new Array();
	this.emptyString = this.string("");
	this.nsPublic = this["namespace"](format.abc.Namespace.NPublic(this.emptyString));
	this.arrayProp = this.name(format.abc.Name.NMultiLate(this.nsset([this.nsPublic])));
	this.classes = new Array();
	this.data.inits = [];
}}
format.abc.Context.__name__ = ["format","abc","Context"];
format.abc.Context.prototype.addClassSuper = function(sup) {
	if(this.curClass == null) return;
	this.classSupers.add(this.type(sup));
}
format.abc.Context.prototype.allocRegister = function() {
	{
		var _g1 = 0, _g = this.registers.length;
		while(_g1 < _g) {
			var i = _g1++;
			if(!this.registers[i]) {
				this.registers[i] = true;
				return i;
			}
		}
	}
	this.registers.push(true);
	this.curFunction.f.nRegs++;
	return this.registers.length - 1;
}
format.abc.Context.prototype.arrayProp = null;
format.abc.Context.prototype.backwardJump = function() {
	var start = this.bytepos.n;
	var me = this;
	this.op(format.abc.OpCode.OLabel);
	return function(jcond) {
		me.op(format.abc.OpCode.OJump(jcond,start - me.bytepos.n - 4));
	}
}
format.abc.Context.prototype.beginClass = function(path,isInterface) {
	this.classSupers = new List();
	if(!isInterface) {
		this.beginFunction([],null);
	}
	else {
		this.beginInterfaceFunction([],null);
	}
	this.ops([format.abc.OpCode.OThis,format.abc.OpCode.OScope]);
	this.init = this.curFunction;
	this.init.f.maxStack = 2;
	this.init.f.maxScope = 2;
	var script = { method : this.init.f.type, fields : new Array()}
	this.data.inits.push(script);
	this.classes = script.fields;
	this.endClass();
	var tpath = this.type(path);
	this.fieldSlot = 1;
	this.curClass = { name : tpath, superclass : this.type("Object"), interfaces : [], isSealed : false, isInterface : false, isFinal : false, namespace : null, constructor : null, statics : null, fields : [], staticFields : []}
	this.data.classes.push(this.curClass);
	this.classes.push({ name : tpath, slot : this.classes.length + 1, kind : format.abc.FieldKind.FClass(format.abc.Index.Idx(this.data.classes.length - 1)), metadatas : null});
	this.curFunction = null;
	return this.curClass;
}
format.abc.Context.prototype.beginFunction = function(args,ret,extra) {
	this.endFunction();
	var f = { type : this.methodType({ args : args, ret : ret, extra : extra}), nRegs : args.length + 1, initScope : 0, maxScope : 0, maxStack : 0, code : null, trys : [], locals : []}
	this.curFunction = { f : f, ops : []}
	this.data.functions.push(f);
	this.registers = new Array();
	{
		var _g1 = 0, _g = f.nRegs;
		while(_g1 < _g) {
			var x = _g1++;
			this.registers.push(true);
		}
	}
	return format.abc.Index.Idx(this.data.functions.length - 1);
}
format.abc.Context.prototype.beginInterfaceFunction = function(args,ret,extra) {
	this.endFunction();
	var f = { type : this.methodType({ args : args, ret : ret, extra : extra}), nRegs : args.length + 1, initScope : 0, maxScope : 0, maxStack : 0, code : null, trys : [], locals : []}
	this.curFunction = { f : f, ops : []}
	return format.abc.Index.Idx(this.data.methodTypes.length - 1);
}
format.abc.Context.prototype.beginInterfaceMethod = function(mname,targs,tret,isStatic,isOverride,isFinal,willAddLater,kind,extra,ns) {
	haxe.Log.trace("beginInterfaceMethod mname: " + mname,{ fileName : "Context.hx", lineNumber : 419, className : "format.abc.Context", methodName : "beginInterfaceMethod"});
	var m = this.beginInterfaceFunction(targs,tret,extra);
	if(willAddLater != true) {
		var fl = (isStatic?this.curClass.staticFields:this.curClass.fields);
		fl.push({ name : this.property(mname,ns), slot : fl.length + 1, kind : format.abc.FieldKind.FMethod(this.curFunction.f.type,kind,isFinal,isOverride), metadatas : null});
	}
	return this.curFunction.f;
}
format.abc.Context.prototype.beginMethod = function(mname,targs,tret,isStatic,isOverride,isFinal,willAddLater,kind,extra,ns) {
	var m = this.beginFunction(targs,tret,extra);
	if(willAddLater != true) {
		var fl = (isStatic?this.curClass.staticFields:this.curClass.fields);
		fl.push({ name : this.property(mname,ns), slot : fl.length + 1, kind : format.abc.FieldKind.FMethod(this.curFunction.f.type,kind,isFinal,isOverride), metadatas : null});
	}
	return this.curFunction.f;
}
format.abc.Context.prototype.bytepos = null;
format.abc.Context.prototype.classSupers = null;
format.abc.Context.prototype.classes = null;
format.abc.Context.prototype.curClass = null;
format.abc.Context.prototype.curFunction = null;
format.abc.Context.prototype.data = null;
format.abc.Context.prototype.defineField = function(fname,t,isStatic,value,$const,ns) {
	var fl = (isStatic?this.curClass.staticFields:this.curClass.fields);
	var slot = this.fieldSlot++;
	var kind = format.abc.FieldKind.FVar(t);
	if(value != null) {
		kind = format.abc.FieldKind.FVar(t,value);
		if($const) kind = format.abc.FieldKind.FVar(t,value,$const);
	}
	fl.push({ name : this.property(fname,ns), slot : fl.length + 1, kind : kind, metadatas : null});
	return fl.length;
}
format.abc.Context.prototype.elookup = function(arr,n) {
	{
		var _g1 = 0, _g = arr.length;
		while(_g1 < _g) {
			var i = _g1++;
			if(Type.enumEq(arr[i],n)) return format.abc.Index.Idx(i + 1);
		}
	}
	arr.push(n);
	return format.abc.Index.Idx(arr.length);
}
format.abc.Context.prototype.emptyString = null;
format.abc.Context.prototype.endClass = function(makeInit) {
	if(makeInit == null) makeInit = true;
	if(this.curClass == null) return;
	this.endFunction();
	if(makeInit) {
		this.curFunction = this.init;
		this.ops([format.abc.OpCode.OGetGlobalScope,format.abc.OpCode.OGetLex(this.type("Object"))]);
		{ var $it23 = this.classSupers.iterator();
		while( $it23.hasNext() ) { var sup = $it23.next();
		this.ops([format.abc.OpCode.OScope,format.abc.OpCode.OGetLex(sup)]);
		}}
		this.ops([format.abc.OpCode.OScope,format.abc.OpCode.OGetLex(this.curClass.superclass),format.abc.OpCode.OClassDef(format.abc.Index.Idx(this.data.classes.length - 1)),format.abc.OpCode.OPopScope]);
		{ var $it24 = this.classSupers.iterator();
		while( $it24.hasNext() ) { var sup = $it24.next();
		this.op(format.abc.OpCode.OPopScope);
		}}
		this.ops([format.abc.OpCode.OInitProp(this.curClass.name)]);
		this.curFunction.f.maxScope += this.classSupers.length;
		this.op(format.abc.OpCode.ORetVoid);
		this.endFunction();
	}
	else {
		this.curFunction = this.init;
		this.op(format.abc.OpCode.ORetVoid);
		this.endFunction();
	}
	if(this.curClass.statics == null) {
		this.beginFunction([],null);
		var st = this.curFunction.f.type;
		this.curClass.statics = st;
		this.curFunction.f.maxStack = 1;
		this.curFunction.f.maxScope = 1;
		this.op(format.abc.OpCode.OThis);
		this.op(format.abc.OpCode.OScope);
		this.op(format.abc.OpCode.ORetVoid);
		this.endFunction();
	}
	this.curFunction = null;
	this.curClass = null;
}
format.abc.Context.prototype.endFunction = function() {
	if(this.curFunction == null) return;
	var old = this.opw.o;
	var bytes = new haxe.io.BytesOutput();
	this.opw.o = bytes;
	{
		var _g = 0, _g1 = this.curFunction.ops;
		while(_g < _g1.length) {
			var op = _g1[_g];
			++_g;
			this.opw.write(op);
		}
	}
	this.curFunction.f.code = bytes.getBytes();
	this.opw.o = old;
	this.curFunction = null;
}
format.abc.Context.prototype.endMethod = function() {
	this.endFunction();
}
format.abc.Context.prototype.fieldSlot = null;
format.abc.Context.prototype.finalize = function() {
	this.endClass();
	this.curFunction = this.init;
	this.op(format.abc.OpCode.ORetVoid);
	this.endFunction();
	this.curClass = null;
}
format.abc.Context.prototype["float"] = function(f) {
	return this.lookup(this.data.floats,f);
}
format.abc.Context.prototype.freeRegister = function(i) {
	this.registers[i] = false;
}
format.abc.Context.prototype.getClass = function(n) {
	{
		var _g1 = 0, _g = this.data.classes.length;
		while(_g1 < _g) {
			var i = _g1++;
			if(this.data.classes[i] == n) return format.abc.Index.Idx(i);
		}
	}
	throw ("unknown class: " + n);
}
format.abc.Context.prototype.getData = function() {
	return this.data;
}
format.abc.Context.prototype.hstrings = null;
format.abc.Context.prototype.init = null;
format.abc.Context.prototype["int"] = function(i) {
	return this.lookup(this.data.ints,i,haxe.Int32);
}
format.abc.Context.prototype.jump = function(jcond) {
	var ops = this.curFunction.ops;
	var pos = ops.length;
	this.op(format.abc.OpCode.OJump(format.abc.JumpStyle.JTrue,-1));
	var start = this.bytepos.n;
	var me = this;
	return function() {
		ops[pos] = format.abc.OpCode.OJump(jcond,me.bytepos.n - start);
	}
}
format.abc.Context.prototype.lookup = function(arr,n,type) {
	if(type == haxe.Int32) {
		{
			var _g1 = 0, _g = arr.length;
			while(_g1 < _g) {
				var i = _g1++;
				if(arr[i] - n == 0) return format.abc.Index.Idx(i + 1);
			}
		}
	}
	else {
		{
			var _g1 = 0, _g = arr.length;
			while(_g1 < _g) {
				var i = _g1++;
				if(arr[i] == n) return format.abc.Index.Idx(i + 1);
			}
		}
	}
	arr.push(n);
	return format.abc.Index.Idx(arr.length);
}
format.abc.Context.prototype.methodType = function(m) {
	this.data.methodTypes.push(m);
	return format.abc.Index.Idx(this.data.methodTypes.length - 1);
}
format.abc.Context.prototype.name = function(n) {
	return this.elookup(this.data.names,n);
}
format.abc.Context.prototype["namespace"] = function(n) {
	return this.elookup(this.data.namespaces,n);
}
format.abc.Context.prototype.nsPublic = null;
format.abc.Context.prototype.nsset = function(ns) {
	{
		var _g1 = 0, _g = this.data.nssets.length;
		while(_g1 < _g) {
			var i = _g1++;
			var s = this.data.nssets[i];
			if(s.length != ns.length) continue;
			var ok = true;
			{
				var _g3 = 0, _g2 = s.length;
				while(_g3 < _g2) {
					var j = _g3++;
					if(!Type.enumEq(s[j],ns[j])) {
						ok = false;
						break;
					}
				}
			}
			if(ok) return format.abc.Index.Idx(i + 1);
		}
	}
	this.data.nssets.push(ns);
	return format.abc.Index.Idx(this.data.nssets.length);
}
format.abc.Context.prototype.op = function(o) {
	this.curFunction.ops.push(o);
	this.opw.write(o);
}
format.abc.Context.prototype.ops = function(ops) {
	var _g = 0;
	while(_g < ops.length) {
		var o = ops[_g];
		++_g;
		this.op(o);
	}
}
format.abc.Context.prototype.opw = null;
format.abc.Context.prototype.property = function(pname,ns) {
	var tid;
	if(pname.indexOf(".") != -1) {
		tid = this.type(pname);
	}
	else {
		var pid = this.string("");
		var nameid = this.string(pname);
		var pid1 = (ns == null?this["namespace"](format.abc.Namespace.NPublic(pid)):ns);
		tid = this.name(format.abc.Name.NName(nameid,pid1));
	}
	return tid;
}
format.abc.Context.prototype.registers = null;
format.abc.Context.prototype.string = function(s) {
	var n = this.hstrings.get(s);
	if(n == null) {
		this.data.strings.push(s);
		n = this.data.strings.length;
		this.hstrings.set(s,n);
	}
	return format.abc.Index.Idx(n);
}
format.abc.Context.prototype.type = function(path) {
	if(path != null && path.indexOf(" params:") != -1) return this.typeParams(path);
	if(path == "*") return null;
	var patharr = path.split(".");
	var cname = patharr.pop();
	var ns = patharr.join(".");
	var pid = this.string(ns);
	var nameid = this.string(cname);
	var pid1 = this["namespace"](format.abc.Namespace.NPublic(pid));
	var tid = this.name(format.abc.Name.NName(nameid,pid1));
	return tid;
}
format.abc.Context.prototype.typeParams = function(path) {
	if(path == "*") return null;
	var parts = path.split(" params:");
	var _path = parts[0];
	var __path = this.type(_path);
	var _params = parts[1].split(",");
	var __params = new Array();
	{
		var _g1 = 0, _g = _params.length;
		while(_g1 < _g) {
			var i = _g1++;
			__params.push(this.type(_params[i]));
		}
	}
	var tid = this.name(format.abc.Name.NParams(__path,__params));
	return tid;
}
format.abc.Context.prototype.uint = function(i) {
	return this.lookup(this.data.uints,i);
}
format.abc.Context.prototype.__class__ = format.abc.Context;
format.abc.OpWriter = function(o) { if( o === $_ ) return; {
	this.o = o;
}}
format.abc.OpWriter.__name__ = ["format","abc","OpWriter"];
format.abc.OpWriter.prototype.b = function(v) {
	this.o.writeByte(v);
}
format.abc.OpWriter.prototype.idx = function(i) {
	var $e = (i);
	switch( $e[1] ) {
	case 0:
	var i1 = $e[2];
	{
		this["int"](i1);
	}break;
	}
}
format.abc.OpWriter.prototype["int"] = function(i) {
	this.writeInt(i);
}
format.abc.OpWriter.prototype.jumpCode = function(j) {
	return (function($this) {
		var $r;
		var $e = (j);
		switch( $e[1] ) {
		case 0:
		{
			$r = 12;
		}break;
		case 1:
		{
			$r = 13;
		}break;
		case 2:
		{
			$r = 14;
		}break;
		case 3:
		{
			$r = 15;
		}break;
		case 4:
		{
			$r = 16;
		}break;
		case 5:
		{
			$r = 17;
		}break;
		case 6:
		{
			$r = 18;
		}break;
		case 7:
		{
			$r = 19;
		}break;
		case 8:
		{
			$r = 20;
		}break;
		case 9:
		{
			$r = 21;
		}break;
		case 10:
		{
			$r = 22;
		}break;
		case 11:
		{
			$r = 23;
		}break;
		case 12:
		{
			$r = 24;
		}break;
		case 13:
		{
			$r = 25;
		}break;
		case 14:
		{
			$r = 26;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.abc.OpWriter.prototype.o = null;
format.abc.OpWriter.prototype.operationCode = function(o) {
	return (function($this) {
		var $r;
		var $e = (o);
		switch( $e[1] ) {
		case 0:
		{
			$r = 135;
		}break;
		case 1:
		{
			$r = 144;
		}break;
		case 2:
		{
			$r = 145;
		}break;
		case 3:
		{
			$r = 147;
		}break;
		case 4:
		{
			$r = 150;
		}break;
		case 5:
		{
			$r = 151;
		}break;
		case 6:
		{
			$r = 160;
		}break;
		case 7:
		{
			$r = 161;
		}break;
		case 8:
		{
			$r = 162;
		}break;
		case 9:
		{
			$r = 163;
		}break;
		case 10:
		{
			$r = 164;
		}break;
		case 11:
		{
			$r = 165;
		}break;
		case 12:
		{
			$r = 166;
		}break;
		case 13:
		{
			$r = 167;
		}break;
		case 14:
		{
			$r = 168;
		}break;
		case 15:
		{
			$r = 169;
		}break;
		case 16:
		{
			$r = 170;
		}break;
		case 17:
		{
			$r = 171;
		}break;
		case 18:
		{
			$r = 172;
		}break;
		case 19:
		{
			$r = 173;
		}break;
		case 20:
		{
			$r = 174;
		}break;
		case 21:
		{
			$r = 175;
		}break;
		case 22:
		{
			$r = 176;
		}break;
		case 23:
		{
			$r = 179;
		}break;
		case 24:
		{
			$r = 180;
		}break;
		case 25:
		{
			$r = 192;
		}break;
		case 26:
		{
			$r = 193;
		}break;
		case 27:
		{
			$r = 196;
		}break;
		case 28:
		{
			$r = 197;
		}break;
		case 29:
		{
			$r = 198;
		}break;
		case 30:
		{
			$r = 199;
		}break;
		case 31:
		{
			$r = 53;
		}break;
		case 32:
		{
			$r = 54;
		}break;
		case 33:
		{
			$r = 55;
		}break;
		case 34:
		{
			$r = 56;
		}break;
		case 35:
		{
			$r = 57;
		}break;
		case 36:
		{
			$r = 58;
		}break;
		case 37:
		{
			$r = 59;
		}break;
		case 38:
		{
			$r = 60;
		}break;
		case 39:
		{
			$r = 61;
		}break;
		case 40:
		{
			$r = 62;
		}break;
		case 41:
		{
			$r = 80;
		}break;
		case 42:
		{
			$r = 81;
		}break;
		case 43:
		{
			$r = 82;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.abc.OpWriter.prototype.reg = function(v) {
	this.o.writeByte(v);
}
format.abc.OpWriter.prototype.write = function(op) {
	var $e = (op);
	switch( $e[1] ) {
	case 0:
	{
		this.o.writeByte(1);
	}break;
	case 1:
	{
		this.o.writeByte(2);
	}break;
	case 2:
	{
		this.o.writeByte(3);
	}break;
	case 3:
	var v = $e[2];
	{
		this.o.writeByte(4);
		this.idx(v);
	}break;
	case 4:
	var v = $e[2];
	{
		this.o.writeByte(5);
		this.idx(v);
	}break;
	case 5:
	var i = $e[2];
	{
		this.o.writeByte(6);
		this.idx(i);
	}break;
	case 6:
	{
		this.o.writeByte(7);
	}break;
	case 7:
	var r = $e[2];
	{
		this.o.writeByte(8);
		this.reg(r);
	}break;
	case 8:
	{
		this.o.writeByte(9);
	}break;
	case 9:
	var landingName = $e[2];
	{
		return;
	}break;
	case 10:
	var delta = $e[3], j = $e[2];
	{
		this.o.writeByte(this.jumpCode(j));
		this.o.writeInt24(delta);
	}break;
	case 11:
	var delta = $e[4], landingName = $e[3], j = $e[2];
	{
		return;
	}break;
	case 12:
	var landingName = $e[2];
	{
		return;
	}break;
	case 13:
	var deltas = $e[3], def = $e[2];
	{
		this.o.writeByte(27);
		this.o.writeInt24(def);
		this["int"](deltas.length - 1);
		{
			var _g = 0;
			while(_g < deltas.length) {
				var d = deltas[_g];
				++_g;
				this.o.writeInt24(d);
			}
		}
	}break;
	case 14:
	{
		this.o.writeByte(28);
	}break;
	case 15:
	{
		this.o.writeByte(29);
	}break;
	case 16:
	{
		this.o.writeByte(30);
	}break;
	case 17:
	{
		this.o.writeByte(31);
	}break;
	case 18:
	{
		this.o.writeByte(32);
	}break;
	case 19:
	{
		this.o.writeByte(33);
	}break;
	case 20:
	{
		this.o.writeByte(35);
	}break;
	case 21:
	var v = $e[2];
	{
		this.o.writeByte(36);
		this.o.writeInt8(v);
	}break;
	case 22:
	var v = $e[2];
	{
		this.o.writeByte(37);
		this["int"](v);
	}break;
	case 23:
	{
		this.o.writeByte(38);
	}break;
	case 24:
	{
		this.o.writeByte(39);
	}break;
	case 25:
	{
		this.o.writeByte(40);
	}break;
	case 26:
	{
		this.o.writeByte(41);
	}break;
	case 27:
	{
		this.o.writeByte(42);
	}break;
	case 28:
	{
		this.o.writeByte(43);
	}break;
	case 29:
	var v = $e[2];
	{
		this.o.writeByte(44);
		this.idx(v);
	}break;
	case 30:
	var v = $e[2];
	{
		this.o.writeByte(45);
		this.idx(v);
	}break;
	case 31:
	var v = $e[2];
	{
		this.o.writeByte(46);
		this.idx(v);
	}break;
	case 32:
	var v = $e[2];
	{
		this.o.writeByte(47);
		this.idx(v);
	}break;
	case 33:
	{
		this.o.writeByte(48);
	}break;
	case 34:
	var v = $e[2];
	{
		this.o.writeByte(49);
		this.idx(v);
	}break;
	case 35:
	var r2 = $e[3], r1 = $e[2];
	{
		this.o.writeByte(50);
		this["int"](r1);
		this["int"](r2);
	}break;
	case 36:
	var f = $e[2];
	{
		this.o.writeByte(64);
		this.idx(f);
	}break;
	case 37:
	var n = $e[2];
	{
		this.o.writeByte(65);
		this["int"](n);
	}break;
	case 38:
	var n = $e[2];
	{
		this.o.writeByte(66);
		this["int"](n);
	}break;
	case 39:
	var n = $e[3], s = $e[2];
	{
		this.o.writeByte(67);
		this["int"](s);
		this["int"](n);
	}break;
	case 40:
	var n = $e[3], m = $e[2];
	{
		this.o.writeByte(68);
		this.idx(m);
		this["int"](n);
	}break;
	case 41:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(69);
		this.idx(p);
		this["int"](n);
	}break;
	case 42:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(70);
		this.idx(p);
		this["int"](n);
	}break;
	case 43:
	{
		this.o.writeByte(71);
	}break;
	case 44:
	{
		this.o.writeByte(72);
	}break;
	case 45:
	var n = $e[2];
	{
		this.o.writeByte(73);
		this["int"](n);
	}break;
	case 46:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(74);
		this.idx(p);
		this["int"](n);
	}break;
	case 47:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(76);
		this.idx(p);
		this["int"](n);
	}break;
	case 48:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(78);
		this.idx(p);
		this["int"](n);
	}break;
	case 49:
	var n = $e[3], p = $e[2];
	{
		this.o.writeByte(79);
		this.idx(p);
		this["int"](n);
	}break;
	case 50:
	var n = $e[2];
	{
		this.o.writeByte(83);
		this["int"](n);
	}break;
	case 51:
	var n = $e[2];
	{
		this.o.writeByte(85);
		this["int"](n);
	}break;
	case 52:
	var n = $e[2];
	{
		this.o.writeByte(86);
		this["int"](n);
	}break;
	case 53:
	{
		this.o.writeByte(87);
	}break;
	case 54:
	var c = $e[2];
	{
		this.o.writeByte(88);
		this.idx(c);
	}break;
	case 55:
	var i = $e[2];
	{
		this.o.writeByte(89);
		this.idx(i);
	}break;
	case 56:
	var c = $e[2];
	{
		this.o.writeByte(90);
		this["int"](c);
	}break;
	case 57:
	var p = $e[2];
	{
		this.o.writeByte(93);
		this.idx(p);
	}break;
	case 58:
	var p = $e[2];
	{
		this.o.writeByte(94);
		this.idx(p);
	}break;
	case 59:
	var d = $e[2];
	{
		this.o.writeByte(95);
		this.idx(d);
	}break;
	case 60:
	var p = $e[2];
	{
		this.o.writeByte(96);
		this.idx(p);
	}break;
	case 61:
	var p = $e[2];
	{
		this.o.writeByte(97);
		this.idx(p);
	}break;
	case 62:
	var r = $e[2];
	{
		switch(r) {
		case 0:{
			this.o.writeByte(208);
		}break;
		case 1:{
			this.o.writeByte(209);
		}break;
		case 2:{
			this.o.writeByte(210);
		}break;
		case 3:{
			this.o.writeByte(211);
		}break;
		default:{
			this.o.writeByte(98);
			this.reg(r);
		}break;
		}
	}break;
	case 63:
	var r = $e[2];
	{
		switch(r) {
		case 0:{
			this.o.writeByte(212);
		}break;
		case 1:{
			this.o.writeByte(213);
		}break;
		case 2:{
			this.o.writeByte(214);
		}break;
		case 3:{
			this.o.writeByte(215);
		}break;
		default:{
			this.o.writeByte(99);
			this.reg(r);
		}break;
		}
	}break;
	case 64:
	{
		this.o.writeByte(100);
	}break;
	case 65:
	var n = $e[2];
	{
		this.o.writeByte(101);
		this.o.writeByte(n);
	}break;
	case 66:
	var p = $e[2];
	{
		this.o.writeByte(102);
		this.idx(p);
	}break;
	case 67:
	var p = $e[2];
	{
		this.o.writeByte(104);
		this.idx(p);
	}break;
	case 68:
	var p = $e[2];
	{
		this.o.writeByte(106);
		this.idx(p);
	}break;
	case 69:
	var s = $e[2];
	{
		this.o.writeByte(108);
		this["int"](s);
	}break;
	case 70:
	var s = $e[2];
	{
		this.o.writeByte(109);
		this["int"](s);
	}break;
	case 71:
	var s = $e[2];
	{
		this.o.writeByte(110);
		this["int"](s);
	}break;
	case 72:
	var s = $e[2];
	{
		this.o.writeByte(111);
		this["int"](s);
	}break;
	case 73:
	{
		this.o.writeByte(112);
	}break;
	case 74:
	{
		this.o.writeByte(113);
	}break;
	case 75:
	{
		this.o.writeByte(114);
	}break;
	case 76:
	{
		this.o.writeByte(115);
	}break;
	case 77:
	{
		this.o.writeByte(116);
	}break;
	case 78:
	{
		this.o.writeByte(117);
	}break;
	case 79:
	{
		this.o.writeByte(118);
	}break;
	case 80:
	{
		this.o.writeByte(119);
	}break;
	case 81:
	{
		this.o.writeByte(120);
	}break;
	case 82:
	var t = $e[2];
	{
		this.o.writeByte(128);
		this.idx(t);
	}break;
	case 83:
	{
		this.o.writeByte(130);
	}break;
	case 84:
	{
		this.o.writeByte(133);
	}break;
	case 85:
	var t = $e[2];
	{
		this.o.writeByte(134);
		this.idx(t);
	}break;
	case 86:
	{
		this.o.writeByte(137);
	}break;
	case 87:
	var r = $e[2];
	{
		this.o.writeByte(146);
		this.reg(r);
	}break;
	case 88:
	var r = $e[2];
	{
		this.o.writeByte(148);
		this.reg(r);
	}break;
	case 89:
	{
		this.o.writeByte(149);
	}break;
	case 90:
	{
		this.o.writeByte(177);
	}break;
	case 91:
	var t = $e[2];
	{
		this.o.writeByte(178);
		this.idx(t);
	}break;
	case 92:
	var r = $e[2];
	{
		this.o.writeByte(194);
		this.reg(r);
	}break;
	case 93:
	var r = $e[2];
	{
		this.o.writeByte(195);
		this.reg(r);
	}break;
	case 94:
	{
		this.o.writeByte(208);
	}break;
	case 95:
	{
		this.o.writeByte(212);
	}break;
	case 96:
	var line = $e[4], r = $e[3], name = $e[2];
	{
		this.o.writeByte(239);
		this.o.writeByte(1);
		this.idx(name);
		this.reg(r);
		this["int"](line);
	}break;
	case 97:
	var line = $e[2];
	{
		this.o.writeByte(240);
		this["int"](line);
	}break;
	case 98:
	var file = $e[2];
	{
		this.o.writeByte(241);
		this.idx(file);
	}break;
	case 99:
	var n = $e[2];
	{
		this.o.writeByte(242);
		this["int"](n);
	}break;
	case 100:
	{
		this.o.writeByte(243);
	}break;
	case 101:
	var op1 = $e[2];
	{
		this.o.writeByte(this.operationCode(op1));
	}break;
	case 102:
	var byte = $e[2];
	{
		this.o.writeByte($byte);
	}break;
	}
}
format.abc.OpWriter.prototype.writeInt = function(n) {
	var e = n >>> 28;
	var d = (n >> 21) & 127;
	var c = (n >> 14) & 127;
	var b = (n >> 7) & 127;
	var a = n & 127;
	if(b != 0 || c != 0 || d != 0 || e != 0) {
		this.o.writeByte(a | 128);
		if(c != 0 || d != 0 || e != 0) {
			this.o.writeByte(b | 128);
			if(d != 0 || e != 0) {
				this.o.writeByte(c | 128);
				if(e != 0) {
					this.o.writeByte(d | 128);
					this.o.writeByte(e);
				}
				else this.o.writeByte(d);
			}
			else this.o.writeByte(c);
		}
		else this.o.writeByte(b);
	}
	else this.o.writeByte(a);
}
format.abc.OpWriter.prototype.writeInt32 = function(n) {
	var e = haxe.Int32.toInt((n) >>> 28);
	var n1 = haxe.Int32.toInt((n) & 268435455);
	var d = (n1 >> 21) & 127;
	var c = (n1 >> 14) & 127;
	var b = (n1 >> 7) & 127;
	var a = n1 & 127;
	if(b != 0 || c != 0 || d != 0 || e != 0) {
		this.o.writeByte(a | 128);
		if(c != 0 || d != 0 || e != 0) {
			this.o.writeByte(b | 128);
			if(d != 0 || e != 0) {
				this.o.writeByte(c | 128);
				if(e != 0) {
					this.o.writeByte(d | 128);
					this.o.writeByte(e);
				}
				else this.o.writeByte(d);
			}
			else this.o.writeByte(c);
		}
		else this.o.writeByte(b);
	}
	else this.o.writeByte(a);
}
format.abc.OpWriter.prototype.__class__ = format.abc.OpWriter;
haxe.Log = function() { }
haxe.Log.__name__ = ["haxe","Log"];
haxe.Log.trace = function(v,infos) {
	js.Boot.__trace(v,infos);
}
haxe.Log.clear = function() {
	js.Boot.__clear_trace();
}
haxe.Log.prototype.__class__ = haxe.Log;
Hash = function(p) { if( p === $_ ) return; {
	this.h = {}
	if(this.h.__proto__ != null) {
		this.h.__proto__ = null;
		delete(this.h.__proto__);
	}
	else null;
}}
Hash.__name__ = ["Hash"];
Hash.prototype.exists = function(key) {
	try {
		key = "$" + key;
		return this.hasOwnProperty.call(this.h,key);
	}
	catch( $e25 ) {
		{
			var e = $e25;
			{
				
				for(var i in this.h)
					if( i == key ) return true;
			;
				return false;
			}
		}
	}
}
Hash.prototype.get = function(key) {
	return this.h["$" + key];
}
Hash.prototype.h = null;
Hash.prototype.iterator = function() {
	return { ref : this.h, it : this.keys(), hasNext : function() {
		return this.it.hasNext();
	}, next : function() {
		var i = this.it.next();
		return this.ref["$" + i];
	}}
}
Hash.prototype.keys = function() {
	var a = new Array();
	
			for(var i in this.h)
				a.push(i.substr(1));
		;
	return a.iterator();
}
Hash.prototype.remove = function(key) {
	if(!this.exists(key)) return false;
	delete(this.h["$" + key]);
	return true;
}
Hash.prototype.set = function(key,value) {
	this.h["$" + key] = value;
}
Hash.prototype.toString = function() {
	var s = new StringBuf();
	s.b[s.b.length] = "{";
	var it = this.keys();
	{ var $it26 = it;
	while( $it26.hasNext() ) { var i = $it26.next();
	{
		s.b[s.b.length] = i;
		s.b[s.b.length] = " => ";
		s.b[s.b.length] = Std.string(this.get(i));
		if(it.hasNext()) s.b[s.b.length] = ", ";
	}
	}}
	s.b[s.b.length] = "}";
	return s.b.join("");
}
Hash.prototype.__class__ = Hash;
format.swf.Reader = function(i) { if( i === $_ ) return; {
	this.i = i;
}}
format.swf.Reader.__name__ = ["format","swf","Reader"];
format.swf.Reader.prototype.bits = null;
format.swf.Reader.prototype.bitsRead = null;
format.swf.Reader.prototype.error = function(msg) {
	if(msg == null) msg = "";
	return "Invalid SWF: " + msg;
}
format.swf.Reader.prototype.getLineCap = function(t) {
	return (function($this) {
		var $r;
		switch(t) {
		case 0:{
			$r = format.swf.LineCapStyle.LCRound;
		}break;
		case 1:{
			$r = format.swf.LineCapStyle.LCNone;
		}break;
		case 2:{
			$r = format.swf.LineCapStyle.LCSquare;
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("invalid lineCap");
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.i = null;
format.swf.Reader.prototype.read = function() {
	return { header : this.readHeader(), tags : this.readTagList()}
}
format.swf.Reader.prototype.readBlendMode = function() {
	return (function($this) {
		var $r;
		switch($this.i.readByte()) {
		case 0:case 1:{
			$r = format.swf.BlendMode.BNormal;
		}break;
		case 2:{
			$r = format.swf.BlendMode.BLayer;
		}break;
		case 3:{
			$r = format.swf.BlendMode.BMultiply;
		}break;
		case 4:{
			$r = format.swf.BlendMode.BScreen;
		}break;
		case 5:{
			$r = format.swf.BlendMode.BLighten;
		}break;
		case 6:{
			$r = format.swf.BlendMode.BDarken;
		}break;
		case 7:{
			$r = format.swf.BlendMode.BAdd;
		}break;
		case 8:{
			$r = format.swf.BlendMode.BSubtract;
		}break;
		case 9:{
			$r = format.swf.BlendMode.BDifference;
		}break;
		case 10:{
			$r = format.swf.BlendMode.BInvert;
		}break;
		case 11:{
			$r = format.swf.BlendMode.BAlpha;
		}break;
		case 12:{
			$r = format.swf.BlendMode.BErase;
		}break;
		case 13:{
			$r = format.swf.BlendMode.BOverlay;
		}break;
		case 14:{
			$r = format.swf.BlendMode.BHardLight;
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("invalid blend mode");
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readCXA = function() {
	this.bits.nbits = 0;
	var add = this.bits.read();
	var mult = this.bits.read();
	var nbits = this.bits.readBits(4);
	return { nbits : nbits, mult : (mult?this.readCXAColor(nbits):null), add : (add?this.readCXAColor(nbits):null)}
}
format.swf.Reader.prototype.readCXAColor = function(nbits) {
	return { r : this.bits.readBits(nbits), g : this.bits.readBits(nbits), b : this.bits.readBits(nbits), a : this.bits.readBits(nbits)}
}
format.swf.Reader.prototype.readClipEvents = function() {
	if(this.i.readUInt16() != 0) throw this.error("invalid clip events");
	this.i.readUInt30();
	var a = new Array();
	while(true) {
		var code = this.i.readUInt30();
		if(code == 0) break;
		var data = this.i.read(this.i.readUInt30());
		a.push({ eventsFlags : code, data : data});
	}
	return a;
}
format.swf.Reader.prototype.readEnvelopeRecords = function(count) {
	var envelopeRecords = new Array();
	{
		var _g = 0;
		while(_g < count) {
			var env = _g++;
			envelopeRecords.push({ pos44 : this.i.readUInt30(), leftLevel : this.i.readUInt16(), rightLevel : this.i.readUInt16()});
		}
	}
	return envelopeRecords;
}
format.swf.Reader.prototype.readFileAttributes = function() {
	this.bits.nbits = 0;
	this.bits.readBits(1);
	var useDirectBlit = (this.bits.readBits(1) == 1?true:false);
	var useGPU = (this.bits.readBits(1) == 1?true:false);
	var hasMetaData = (this.bits.readBits(1) == 1?true:false);
	var actionscript3 = (this.bits.readBits(1) == 1?true:false);
	this.bits.readBits(2);
	var useNetWork = (this.bits.readBits(1) == 1?true:false);
	this.bits.readBits(24);
	return { useDirectBlit : useDirectBlit, useGPU : useGPU, hasMetaData : hasMetaData, actionscript3 : actionscript3, useNetWork : useNetWork}
}
format.swf.Reader.prototype.readFillStyle = function(ver) {
	var type = this.i.readByte();
	return (function($this) {
		var $r;
		switch(type) {
		case 0:{
			$r = ((ver <= 2)?format.swf.FillStyle.FSSolid($this.readRGB($this.i)):format.swf.FillStyle.FSSolidAlpha($this.readRGBA($this.i)));
		}break;
		case 16:case 18:case 19:{
			$r = (function($this) {
				var $r;
				var mat = $this.readMatrix();
				var grad = $this.readGradient(ver);
				$r = (function($this) {
					var $r;
					switch(type) {
					case 19:{
						$r = format.swf.FillStyle.FSFocalGradient(mat,{ focalPoint : $this.readFixed8($this.i), data : grad});
					}break;
					case 16:{
						$r = format.swf.FillStyle.FSLinearGradient(mat,grad);
					}break;
					case 18:{
						$r = format.swf.FillStyle.FSRadialGradient(mat,grad);
					}break;
					default:{
						$r = (function($this) {
							var $r;
							throw $this.error("invalid fill style type");
							return $r;
						}($this));
					}break;
					}
					return $r;
				}($this));
				return $r;
			}($this));
		}break;
		case 64:case 65:case 66:case 67:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var mat = $this.readMatrix();
				var isRepeat = (type == 64 || type == 66);
				var isSmooth = (type == 64 || type == 65);
				$r = format.swf.FillStyle.FSBitmap(cid,mat,isRepeat,isSmooth);
				return $r;
			}($this));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error() + " code " + type;
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readFillStyles = function(ver) {
	var cnt = this.i.readByte();
	if(cnt == 255 && ver > 1) cnt = this.i.readUInt16();
	var arr = new Array();
	{
		var _g = 0;
		while(_g < cnt) {
			var c = _g++;
			var fillStyle = this.readFillStyle(ver);
			arr.push(fillStyle);
		}
	}
	return arr;
}
format.swf.Reader.prototype.readFilter = function() {
	var n = this.i.readByte();
	return (function($this) {
		var $r;
		switch(n) {
		case 0:{
			$r = format.swf.Filter.FDropShadow({ color : $this.readRGBA(), color2 : null, blurX : $this.i.readInt32(), blurY : $this.i.readInt32(), angle : $this.i.readInt32(), distance : $this.i.readInt32(), strength : $this.readFixed8(null), flags : $this.readFilterFlags(false)});
		}break;
		case 1:{
			$r = format.swf.Filter.FBlur({ blurX : $this.i.readInt32(), blurY : $this.i.readInt32(), passes : $this.i.readByte() >> 3});
		}break;
		case 2:{
			$r = format.swf.Filter.FGlow({ color : $this.readRGBA(), color2 : null, blurX : $this.i.readInt32(), blurY : $this.i.readInt32(), angle : 0, distance : 0, strength : $this.readFixed8(null), flags : $this.readFilterFlags(false)});
		}break;
		case 3:{
			$r = format.swf.Filter.FBevel({ color : $this.readRGBA(), color2 : $this.readRGBA(), blurX : $this.i.readInt32(), blurY : $this.i.readInt32(), angle : $this.i.readInt32(), distance : $this.i.readInt32(), strength : $this.readFixed8(null), flags : $this.readFilterFlags(true)});
		}break;
		case 5:{
			$r = (function($this) {
				var $r;
				throw $this.error("convolution filter not supported");
				return $r;
			}($this));
		}break;
		case 4:{
			$r = format.swf.Filter.FGradientGlow($this.readFilterGradient());
		}break;
		case 6:{
			$r = (function($this) {
				var $r;
				var a = new Array();
				{
					var _g = 0;
					while(_g < 20) {
						var n1 = _g++;
						a.push($this.i.readFloat());
					}
				}
				$r = format.swf.Filter.FColorMatrix(a);
				return $r;
			}($this));
		}break;
		case 7:{
			$r = format.swf.Filter.FGradientBevel($this.readFilterGradient());
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("unknown filter");
				$r = null;
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readFilterFlags = function(top) {
	var flags = this.i.readByte();
	return { inner : (flags & 128) != 0, knockout : (flags & 64) != 0, ontop : (top?((flags & 16) != 0):false), passes : flags & ((top?15:31))}
}
format.swf.Reader.prototype.readFilterGradient = function() {
	var ncolors = this.i.readByte();
	var colors = new Array();
	{
		var _g = 0;
		while(_g < ncolors) {
			var i = _g++;
			colors.push({ color : this.readRGBA(), position : 0});
		}
	}
	{
		var _g = 0;
		while(_g < colors.length) {
			var c = colors[_g];
			++_g;
			c.position = this.i.readByte();
		}
	}
	var data = { color : null, color2 : null, blurX : this.i.readInt32(), blurY : this.i.readInt32(), angle : this.i.readInt32(), distance : this.i.readInt32(), strength : this.readFixed8(null), flags : this.readFilterFlags(true)}
	return { colors : colors, data : data}
}
format.swf.Reader.prototype.readFilters = function() {
	var filters = new Array();
	{
		var _g1 = 0, _g = this.i.readByte();
		while(_g1 < _g) {
			var i = _g1++;
			filters.push(this.readFilter());
		}
	}
	return filters;
}
format.swf.Reader.prototype.readFixed = function() {
	return this.i.readInt32();
}
format.swf.Reader.prototype.readFixed8 = function(i) {
	if(i == null) i = this.i;
	return i.readUInt16();
}
format.swf.Reader.prototype.readFont = function(len,ver) {
	var cid = this.i.readUInt16();
	return format.swf.SWFTag.TFont(cid,(function($this) {
		var $r;
		switch(ver) {
		case 1:{
			$r = $this.readFont1Data(len);
		}break;
		case 2:{
			$r = $this.readFont2Data(ver);
		}break;
		case 3:{
			$r = $this.readFont2Data(ver);
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
}
format.swf.Reader.prototype.readFont1Data = function(len) {
	var offs1 = this.i.readUInt16();
	var num_glyphs = offs1 >> 1;
	var offset_table = new Array();
	offset_table.push(0);
	{
		var _g = 1;
		while(_g < num_glyphs) {
			var j = _g++;
			offset_table.push(this.i.readUInt16() - offs1);
		}
	}
	return format.swf.FontData.FDFont1({ glyphs : this.readGlyphs(len - 2 - num_glyphs * 2,offset_table)});
}
format.swf.Reader.prototype.readFont2Data = function(ver) {
	this.bits.nbits = 0;
	var hasLayout = this.bits.read();
	var shiftJIS = this.bits.read();
	var isSmall = this.bits.read();
	var isANSI = this.bits.read();
	var hasWideOffsets = this.bits.read();
	var hasWideCodes = this.bits.read();
	var isItalic = this.bits.read();
	var isBold = this.bits.read();
	var language = this.readLanguage();
	var name = this.i.readString(this.i.readByte());
	var num_glyphs = this.i.readUInt16();
	var offset_table = new Array();
	var shape_data_length = 0;
	if(hasWideOffsets) {
		var first_glyph_offset = num_glyphs * 4 + 4;
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				offset_table.push(this.i.readUInt30() - first_glyph_offset);
			}
		}
		var code_table_offset = this.i.readUInt30();
		shape_data_length = code_table_offset - first_glyph_offset;
	}
	else {
		var first_glyph_offset = num_glyphs * 2 + 2;
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				var offs = this.i.readUInt16();
				offset_table.push(offs - first_glyph_offset);
			}
		}
		var code_table_offset = this.i.readUInt16();
		shape_data_length = code_table_offset - first_glyph_offset;
	}
	var glyph_shapes = this.readGlyphs(shape_data_length,offset_table);
	var glyphs = new Array();
	if(hasWideCodes) {
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				glyphs.push({ charCode : this.i.readUInt16(), shape : glyph_shapes[j]});
			}
		}
	}
	else {
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				glyphs.push({ charCode : this.i.readByte(), shape : glyph_shapes[j]});
			}
		}
	}
	var layout = null;
	if(hasLayout) {
		var ascent = this.i.readInt16();
		var descent = this.i.readInt16();
		var leading = this.i.readInt16();
		var advance_table = new Array();
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				advance_table.push(this.i.readInt16());
			}
		}
		var glyph_layout = new Array();
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				var bounds = this.readRect();
				glyph_layout.push({ advance : advance_table[j], bounds : bounds});
			}
		}
		var num_kerning = this.i.readUInt16();
		var kerning = new Array();
		{
			var _g = 0;
			while(_g < num_kerning) {
				var i = _g++;
				kerning.push(this.readKerningRecord(hasWideCodes));
			}
		}
		layout = { ascent : ascent, descent : descent, leading : leading, glyphs : glyph_layout, kerning : kerning}
	}
	var f2data = { shiftJIS : shiftJIS, isSmall : isSmall, isANSI : isANSI, isItalic : isItalic, isBold : isBold, language : language, name : name, glyphs : glyphs, layout : layout}
	return (function($this) {
		var $r;
		switch(ver) {
		case 2:{
			$r = format.swf.FontData.FDFont2(hasWideCodes,f2data);
		}break;
		case 3:{
			$r = format.swf.FontData.FDFont3(f2data);
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readFontInfo = function(len,ver) {
	var cid = this.i.readUInt16();
	var name = this.i.readString(this.i.readByte());
	this.bits.nbits = 0;
	this.bits.readBits(2);
	var isSmall = this.bits.read();
	var shiftJIS = this.bits.read();
	var isANSI = this.bits.read();
	var isItalic = this.bits.read();
	var isBold = this.bits.read();
	var hasWideCodes = this.bits.read();
	var language = (ver == 2?this.readLanguage():format.swf.LangCode.LCNone);
	var num_glyphs = len - 4 - name.length;
	var code_table = new Array();
	if(hasWideCodes) {
		num_glyphs >>= 1;
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				code_table.push(this.i.readUInt16());
			}
		}
	}
	else {
		{
			var _g = 0;
			while(_g < num_glyphs) {
				var j = _g++;
				code_table.push(this.i.readByte());
			}
		}
	}
	var fi_data = { name : name, isSmall : isSmall, isItalic : isItalic, isBold : isBold, codeTable : code_table}
	return format.swf.SWFTag.TFontInfo(cid,(function($this) {
		var $r;
		switch(ver) {
		case 1:{
			$r = format.swf.FontInfoData.FIDFont1(shiftJIS,isANSI,hasWideCodes,fi_data);
		}break;
		case 2:{
			$r = format.swf.FontInfoData.FIDFont2(language,fi_data);
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)));
}
format.swf.Reader.prototype.readGlyphs = function(len,offsets) {
	var shape_data = this.i.read(len);
	var glyphs = new Array();
	if(offsets.length == 0) return glyphs;
	{
		var _g = 0;
		while(_g < offsets.length) {
			var offs = offsets[_g];
			++_g;
			var old_i = this.i;
			var old_bits = this.bits;
			this.i = new haxe.io.BytesInput(shape_data,offs);
			this.bits = new format.tools.BitsInput(this.i);
			glyphs.push(this.readShapeWithoutStyle(1));
			this.i = old_i;
			this.bits = old_bits;
		}
	}
	return glyphs;
}
format.swf.Reader.prototype.readGradient = function(ver) {
	this.bits.nbits = 0;
	var spread = (function($this) {
		var $r;
		switch($this.bits.readBits(2)) {
		case 0:{
			$r = format.swf.SpreadMode.SMPad;
		}break;
		case 1:{
			$r = format.swf.SpreadMode.SMReflect;
		}break;
		case 2:{
			$r = format.swf.SpreadMode.SMRepeat;
		}break;
		case 3:{
			$r = format.swf.SpreadMode.SMReserved;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	var interp = (function($this) {
		var $r;
		switch($this.bits.readBits(2)) {
		case 0:{
			$r = format.swf.InterpolationMode.IMNormalRGB;
		}break;
		case 1:{
			$r = format.swf.InterpolationMode.IMLinearRGB;
		}break;
		case 2:{
			$r = format.swf.InterpolationMode.IMReserved1;
		}break;
		case 3:{
			$r = format.swf.InterpolationMode.IMReserved2;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	var nGrad = this.bits.readBits(4);
	var arr = new Array();
	{
		var _g = 0;
		while(_g < nGrad) {
			var c = _g++;
			var pos = this.i.readByte();
			if(ver <= 2) arr.push(format.swf.GradRecord.GRRGB(pos,this.readRGB()));
			else arr.push(format.swf.GradRecord.GRRGBA(pos,this.readRGBA()));
		}
	}
	return { spread : spread, interpolate : interp, data : arr}
}
format.swf.Reader.prototype.readHeader = function() {
	var tag = this.i.readString(3);
	var compressed;
	if(tag == "CWS") compressed = true;
	else if(tag == "FWS") compressed = false;
	else throw this.error("invalid file signature");
	this.version = this.i.readByte();
	var size = this.i.readUInt30();
	if(compressed) {
		var bytes = format.tools.Inflate.run(this.i.readAll());
		if(bytes.length + 8 != size) throw this.error("wrong bytes length after decompression");
		this.i = new haxe.io.BytesInput(bytes);
	}
	this.bits = new format.tools.BitsInput(this.i);
	var r = this.readRect();
	if(r.left != 0 || r.top != 0 || r.right % 20 != 0 || r.bottom % 20 != 0) throw this.error("invalid swf width or height");
	this.i.readByte();
	var fps = this.i.readByte();
	var nframes = this.i.readUInt16();
	return { version : this.version, compressed : compressed, width : Std["int"](r.right / 20), height : Std["int"](r.bottom / 20), fps : fps, nframes : nframes}
}
format.swf.Reader.prototype.readKerningRecord = function(hasWideCodes) {
	return { charCode1 : (hasWideCodes?this.i.readUInt16():this.i.readByte()), charCode2 : (hasWideCodes?this.i.readUInt16():this.i.readByte()), adjust : this.i.readInt16()}
}
format.swf.Reader.prototype.readLanguage = function() {
	return (function($this) {
		var $r;
		switch($this.i.readByte()) {
		case 0:{
			$r = format.swf.LangCode.LCNone;
		}break;
		case 1:{
			$r = format.swf.LangCode.LCLatin;
		}break;
		case 2:{
			$r = format.swf.LangCode.LCJapanese;
		}break;
		case 3:{
			$r = format.swf.LangCode.LCKorean;
		}break;
		case 4:{
			$r = format.swf.LangCode.LCSimplifiedChinese;
		}break;
		case 5:{
			$r = format.swf.LangCode.LCTraditionalChinese;
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw "Unknown language code!";
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readLineStyles = function(ver) {
	var cnt = this.i.readByte();
	if(cnt == 255) {
		if(ver == 1) throw this.error("invalid line count in line styles array");
		cnt = this.i.readUInt16();
	}
	var arr = new Array();
	{
		var _g = 0;
		while(_g < cnt) {
			var c = _g++;
			var width = this.i.readUInt16();
			arr.push({ width : width, data : (ver <= 2?format.swf.LineStyleData.LSRGB(this.readRGB(this.i)):(ver == 3?format.swf.LineStyleData.LSRGBA(this.readRGBA(this.i)):(ver == 4?(function($this) {
				var $r;
				$this.bits.nbits = 0;
				var startCap = $this.getLineCap($this.bits.readBits(2));
				var _join = $this.bits.readBits(2);
				var _fill = $this.bits.read();
				var noHScale = $this.bits.read();
				var noVScale = $this.bits.read();
				var pixelHinting = $this.bits.read();
				if($this.bits.readBits(5) != 0) throw $this.error("invalid nbits in line style");
				var noClose = $this.bits.read();
				var endCap = $this.getLineCap($this.bits.readBits(2));
				var join = (function($this) {
					var $r;
					switch(_join) {
					case 0:{
						$r = format.swf.LineJoinStyle.LJRound;
					}break;
					case 1:{
						$r = format.swf.LineJoinStyle.LJBevel;
					}break;
					case 2:{
						$r = format.swf.LineJoinStyle.LJMiter($this.readFixed8(null));
					}break;
					default:{
						$r = (function($this) {
							var $r;
							throw $this.error("invalid joint style in line style");
							return $r;
						}($this));
					}break;
					}
					return $r;
				}($this));
				var fill = (function($this) {
					var $r;
					switch(_fill) {
					case false:{
						$r = format.swf.LS2Fill.LS2FColor($this.readRGBA($this.i));
					}break;
					case true:{
						$r = format.swf.LS2Fill.LS2FStyle($this.readFillStyle(ver));
					}break;
					default:{
						$r = null;
					}break;
					}
					return $r;
				}($this));
				$r = format.swf.LineStyleData.LS2({ startCap : startCap, join : join, fill : fill, noHScale : noHScale, noVScale : noVScale, pixelHinting : pixelHinting, noClose : noClose, endCap : endCap});
				return $r;
			}(this)):(function($this) {
				var $r;
				throw $this.error("invalid line style version");
				return $r;
			}(this)))))});
		}
	}
	return arr;
}
format.swf.Reader.prototype.readLossless = function(len,v2) {
	var cid = this.i.readUInt16();
	var bits = this.i.readByte();
	return { cid : cid, width : this.i.readUInt16(), height : this.i.readUInt16(), color : (function($this) {
		var $r;
		switch(bits) {
		case 3:{
			$r = format.swf.ColorModel.CM8Bits($this.i.readByte());
		}break;
		case 4:{
			$r = format.swf.ColorModel.CM15Bits;
		}break;
		case 5:{
			$r = (v2?format.swf.ColorModel.CM32Bits:format.swf.ColorModel.CM24Bits);
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("invalid lossless bits");
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this)), data : this.i.read(len - ((bits == 3?8:7)))}
}
format.swf.Reader.prototype.readMatrix = function() {
	this.bits.nbits = 0;
	var scale = null;
	if(this.bits.read()) {
		var nbits = this.bits.readBits(5);
		var _x = format.swf.Tools.floatFixedBits(this.bits.readBits(nbits),nbits);
		var _y = format.swf.Tools.floatFixedBits(this.bits.readBits(nbits),nbits);
		scale = { x : _x, y : _y}
	}
	var rotate = null;
	if(this.bits.read()) {
		var nbits = this.bits.readBits(5);
		var _rs0 = format.swf.Tools.floatFixedBits(this.bits.readBits(nbits),nbits);
		var _rs1 = format.swf.Tools.floatFixedBits(this.bits.readBits(nbits),nbits);
		rotate = { rs0 : _rs0, rs1 : _rs1}
	}
	var nbits = this.bits.readBits(5);
	var translate = { x : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits), y : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits)}
	return { scale : scale, rotate : rotate, translate : translate}
}
format.swf.Reader.prototype.readMatrixPart = function() {
	var nbits = this.bits.readBits(5);
	return { nbits : nbits, x : this.bits.readBits(nbits), y : this.bits.readBits(nbits)}
}
format.swf.Reader.prototype.readMorph1LineStyle = function() {
	var sw = this.i.readUInt16();
	var ew = this.i.readUInt16();
	var sc = this.readRGBA(this.i);
	var ec = this.readRGBA(this.i);
	return { startWidth : sw, endWidth : ew, startColor : sc, endColor : ec}
}
format.swf.Reader.prototype.readMorph1LineStyles = function() {
	var len = this.i.readByte();
	if(len == 255) len = this.i.readUInt16();
	var styles = new Array();
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			styles.push(this.readMorph1LineStyle());
		}
	}
	return styles;
}
format.swf.Reader.prototype.readMorph2LineStyle = function() {
	var startWidth = this.i.readUInt16();
	var endWidth = this.i.readUInt16();
	this.bits.nbits = 0;
	var startCapStyle = this.bits.readBits(2);
	var joinStyle = this.bits.readBits(2);
	var hasFill = this.bits.read();
	var noHScale = this.bits.read();
	var noVScale = this.bits.read();
	var pixelHinting = this.bits.read();
	this.bits.readBits(5);
	var noClose = this.bits.read();
	var endCapStyle = this.bits.readBits(2);
	this.bits.nbits = 0;
	var morphData = { startWidth : startWidth, endWidth : endWidth, startCapStyle : (function($this) {
		var $r;
		switch(startCapStyle) {
		case 0:{
			$r = format.swf.LineCapStyle.LCRound;
		}break;
		case 1:{
			$r = format.swf.LineCapStyle.LCNone;
		}break;
		case 2:{
			$r = format.swf.LineCapStyle.LCSquare;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)), joinStyle : (function($this) {
		var $r;
		switch(joinStyle) {
		case 0:{
			$r = format.swf.LineJoinStyle.LJRound;
		}break;
		case 1:{
			$r = format.swf.LineJoinStyle.LJBevel;
		}break;
		case 2:{
			$r = format.swf.LineJoinStyle.LJMiter($this.readFixed8($this.i));
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this)), noHScale : noHScale, noVScale : noVScale, pixelHinting : pixelHinting, noClose : noClose, endCapStyle : (function($this) {
		var $r;
		switch(endCapStyle) {
		case 0:{
			$r = format.swf.LineCapStyle.LCRound;
		}break;
		case 1:{
			$r = format.swf.LineCapStyle.LCNone;
		}break;
		case 2:{
			$r = format.swf.LineCapStyle.LCSquare;
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this))}
	if(hasFill) return format.swf.Morph2LineStyle.M2LSFill(this.readMorphFillStyle(2),morphData);
	var startColor = this.readRGBA(this.i);
	var endColor = this.readRGBA(this.i);
	return format.swf.Morph2LineStyle.M2LSNoFill(startColor,endColor,morphData);
}
format.swf.Reader.prototype.readMorph2LineStyles = function() {
	var len = this.i.readByte();
	if(len == 255) len = this.i.readUInt16();
	var styles = new Array();
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			styles.push(this.readMorph2LineStyle());
		}
	}
	return styles;
}
format.swf.Reader.prototype.readMorphFillStyle = function(ver) {
	var type = this.i.readByte();
	return (function($this) {
		var $r;
		switch(type) {
		case 0:{
			$r = (function($this) {
				var $r;
				var startColor = $this.readRGBA($this.i);
				var endColor = $this.readRGBA($this.i);
				$r = format.swf.MorphFillStyle.MFSSolid(startColor,endColor);
				return $r;
			}($this));
		}break;
		case 16:case 18:case 19:{
			$r = (function($this) {
				var $r;
				var startMatrix = $this.readMatrix();
				var endMatrix = $this.readMatrix();
				var grads = $this.readMorphGradients(ver);
				$r = (function($this) {
					var $r;
					switch(type) {
					case 16:{
						$r = format.swf.MorphFillStyle.MFSLinearGradient(startMatrix,endMatrix,grads);
					}break;
					case 18:{
						$r = format.swf.MorphFillStyle.MFSRadialGradient(startMatrix,endMatrix,grads);
					}break;
					default:{
						$r = (function($this) {
							var $r;
							throw $this.error("invalid filltype in morphshape");
							return $r;
						}($this));
					}break;
					}
					return $r;
				}($this));
				return $r;
			}($this));
		}break;
		case 64:case 65:case 66:case 67:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var startMatrix = $this.readMatrix();
				var endMatrix = $this.readMatrix();
				var isRepeat = (type == 64 || type == 66);
				var isSmooth = (type == 64 || type == 65);
				$r = format.swf.MorphFillStyle.MFSBitmap(cid,startMatrix,endMatrix,isRepeat,isSmooth);
				return $r;
			}($this));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error() + " code " + type;
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readMorphFillStyles = function(ver) {
	var len = this.i.readByte();
	if(len == 255) len = this.i.readUInt16();
	var fill_styles = new Array();
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			fill_styles.push(this.readMorphFillStyle(ver));
		}
	}
	return fill_styles;
}
format.swf.Reader.prototype.readMorphGradient = function(ver) {
	var sr = this.i.readByte();
	var sc = this.readRGBA(this.i);
	var er = this.i.readByte();
	var ec = this.readRGBA(this.i);
	return { startRatio : sr, startColor : sc, endRatio : er, endColor : ec}
}
format.swf.Reader.prototype.readMorphGradients = function(ver) {
	var num = this.i.readByte();
	if(num < 1 || num > 8) throw "Invalid number of morph gradients (" + num + "). Should be in range 1..8!";
	var grads = new Array();
	{
		var _g = 0;
		while(_g < num) {
			var i = _g++;
			grads.push(this.readMorphGradient(ver));
		}
	}
	return grads;
}
format.swf.Reader.prototype.readMorphShape = function(ver) {
	var id = this.i.readUInt16();
	var startBounds = this.readRect();
	var endBounds = this.readRect();
	switch(ver) {
	case 1:{
		this.i.readUInt30();
		var fillStyles = this.readMorphFillStyles(ver);
		var lineStyles = this.readMorph1LineStyles();
		var startEdges = this.readShapeWithoutStyle(3);
		this.bits.nbits = 0;
		var endEdges = this.readShapeWithoutStyle(3);
		return format.swf.SWFTag.TMorphShape(id,format.swf.MorphShapeData.MSDShape1({ startBounds : startBounds, endBounds : endBounds, fillStyles : fillStyles, lineStyles : lineStyles, startEdges : startEdges, endEdges : endEdges}));
	}break;
	case 2:{
		var startEdgeBounds = this.readRect();
		var endEdgeBounds = this.readRect();
		this.bits.nbits = 0;
		this.bits.readBits(6);
		var useNonScalingStrokes = this.bits.read();
		var useScalingStrokes = this.bits.read();
		this.bits.nbits = 0;
		this.i.readUInt30();
		var fillStyles = this.readMorphFillStyles(ver);
		var lineStyles = this.readMorph2LineStyles();
		var startEdges = this.readShapeWithoutStyle(4);
		this.bits.nbits = 0;
		var endEdges = this.readShapeWithoutStyle(4);
		return format.swf.SWFTag.TMorphShape(id,format.swf.MorphShapeData.MSDShape2({ startBounds : startBounds, endBounds : endBounds, startEdgeBounds : startEdgeBounds, endEdgeBounds : endEdgeBounds, useNonScalingStrokes : useNonScalingStrokes, useScalingStrokes : useScalingStrokes, fillStyles : fillStyles, lineStyles : lineStyles, startEdges : startEdges, endEdges : endEdges}));
	}break;
	default:{
		throw "Unsupported morph fill style version!";
	}break;
	}
}
format.swf.Reader.prototype.readPlaceObject = function(v3) {
	var f = this.i.readByte();
	var f2 = (v3?this.i.readByte():0);
	if(f2 >> 3 != 0) throw this.error("unsupported bit flags in place object");
	var po = new format.swf.PlaceObject();
	po.depth = this.i.readUInt16();
	if((f & 1) != 0) po.move = true;
	if((f & 2) != 0) po.cid = this.i.readUInt16();
	if((f & 4) != 0) po.matrix = this.readMatrix();
	if((f & 8) != 0) po.color = this.readCXA();
	if((f & 16) != 0) po.ratio = this.i.readUInt16();
	if((f & 32) != 0) po.instanceName = this.readUTF8Bytes().toString();
	if((f & 64) != 0) po.clipDepth = this.i.readUInt16();
	if((f2 & 1) != 0) po.filters = this.readFilters();
	if((f2 & 2) != 0) po.blendMode = this.readBlendMode();
	if((f2 & 4) != 0) po.bitmapCache = true;
	if((f & 128) != 0) po.events = this.readClipEvents();
	return po;
}
format.swf.Reader.prototype.readRGB = function(i) {
	if(i == null) i = this.i;
	return { r : i.readByte(), g : i.readByte(), b : i.readByte()}
}
format.swf.Reader.prototype.readRGBA = function(i) {
	if(i == null) i = this.i;
	return { r : i.readByte(), g : i.readByte(), b : i.readByte(), a : i.readByte()}
}
format.swf.Reader.prototype.readRect = function() {
	this.bits.nbits = 0;
	var nbits = this.bits.readBits(5);
	return { left : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits), right : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits), top : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits), bottom : format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits)}
}
format.swf.Reader.prototype.readShape = function(len,ver) {
	var id = this.i.readUInt16();
	if(ver <= 3) {
		var bounds = this.readRect();
		var sws = this.readShapeWithStyle(ver);
		return format.swf.SWFTag.TShape(id,(function($this) {
			var $r;
			switch(ver) {
			case 1:{
				$r = format.swf.ShapeData.SHDShape1(bounds,sws);
			}break;
			case 2:{
				$r = format.swf.ShapeData.SHDShape2(bounds,sws);
			}break;
			case 3:{
				$r = format.swf.ShapeData.SHDShape3(bounds,sws);
			}break;
			default:{
				$r = (function($this) {
					var $r;
					throw $this.error("invalid shape type");
					return $r;
				}($this));
			}break;
			}
			return $r;
		}(this)));
	}
	var shapeBounds = this.readRect();
	var edgeBounds = this.readRect();
	this.bits.readBits(5);
	var useWinding = this.bits.read();
	var useNonScalingStroke = this.bits.read();
	var useScalingStroke = this.bits.read();
	var shapes = this.readShapeWithStyle(ver);
	return format.swf.SWFTag.TShape(id,format.swf.ShapeData.SHDShape4({ shapeBounds : shapeBounds, edgeBounds : edgeBounds, useWinding : useWinding, useNonScalingStroke : useNonScalingStroke, useScalingStroke : useScalingStroke, shapes : shapes}));
}
format.swf.Reader.prototype.readShapeRecords = function(ver) {
	this.bits.nbits = 0;
	var fillBits = this.bits.readBits(4);
	var lineBits = this.bits.readBits(4);
	var recs = new Array();
	do {
		if(this.bits.read()) {
			if(this.bits.read()) {
				var nbits = this.bits.readBits(4) + 2;
				var isGeneral = this.bits.read();
				var isVertical = ((!isGeneral)?this.bits.read():false);
				var dx = ((isGeneral || !isVertical)?format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits):0);
				var dy = ((isGeneral || isVertical)?format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits):0);
				recs.push(format.swf.ShapeRecord.SHREdge(dx,dy));
			}
			else {
				var nbits = this.bits.readBits(4) + 2;
				var cdx = format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits);
				var cdy = format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits);
				var adx = format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits);
				var ady = format.swf.Tools.signExtend(this.bits.readBits(nbits),nbits);
				recs.push(format.swf.ShapeRecord.SHRCurvedEdge(cdx,cdy,adx,ady));
			}
		}
		else {
			var flags = this.bits.readBits(5);
			if(flags == 0) {
				recs.push(format.swf.ShapeRecord.SHREnd);
				break;
			}
			else {
				var cdata = { moveTo : null, fillStyle0 : null, fillStyle1 : null, lineStyle : null, newStyles : null}
				if((flags & 1) != 0) {
					var mbits = this.bits.readBits(5);
					var dx = format.swf.Tools.signExtend(this.bits.readBits(mbits),mbits);
					var dy = format.swf.Tools.signExtend(this.bits.readBits(mbits),mbits);
					cdata.moveTo = { dx : dx, dy : dy}
				}
				if((flags & 2) != 0) {
					cdata.fillStyle0 = { idx : this.bits.readBits(fillBits)}
				}
				if((flags & 4) != 0) {
					cdata.fillStyle1 = { idx : this.bits.readBits(fillBits)}
				}
				if((flags & 8) != 0) {
					cdata.lineStyle = { idx : this.bits.readBits(lineBits)}
				}
				if((flags & 16) != 0) {
					var fst = this.readFillStyles(ver);
					var lst = this.readLineStyles(ver);
					this.bits.nbits = 0;
					fillBits = this.bits.readBits(4);
					lineBits = this.bits.readBits(4);
					cdata.newStyles = { fillStyles : fst, lineStyles : lst}
				}
				recs.push(format.swf.ShapeRecord.SHRChange(cdata));
			}
		}
	} while(true);
	return recs;
}
format.swf.Reader.prototype.readShapeWithStyle = function(ver) {
	var fillStyles = this.readFillStyles(ver);
	var lineStyles = this.readLineStyles(ver);
	return { fillStyles : fillStyles, lineStyles : lineStyles, shapeRecords : this.readShapeRecords(ver)}
}
format.swf.Reader.prototype.readShapeWithoutStyle = function(ver) {
	return { shapeRecords : this.readShapeRecords(ver)}
}
format.swf.Reader.prototype.readSound = function(len) {
	var sid = this.i.readUInt16();
	this.bits.nbits = 0;
	var soundFormat = (function($this) {
		var $r;
		switch($this.bits.readBits(4)) {
		case 0:{
			$r = format.swf.SoundFormat.SFNativeEndianUncompressed;
		}break;
		case 1:{
			$r = format.swf.SoundFormat.SFADPCM;
		}break;
		case 2:{
			$r = format.swf.SoundFormat.SFMP3;
		}break;
		case 3:{
			$r = format.swf.SoundFormat.SFLittleEndianUncompressed;
		}break;
		case 4:{
			$r = format.swf.SoundFormat.SFNellymoser16k;
		}break;
		case 5:{
			$r = format.swf.SoundFormat.SFNellymoser8k;
		}break;
		case 6:{
			$r = format.swf.SoundFormat.SFNellymoser;
		}break;
		case 11:{
			$r = format.swf.SoundFormat.SFSpeex;
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("invalid sound format");
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
	var soundRate = (function($this) {
		var $r;
		switch($this.bits.readBits(2)) {
		case 0:{
			$r = format.swf.SoundRate.SR5k;
		}break;
		case 1:{
			$r = format.swf.SoundRate.SR11k;
		}break;
		case 2:{
			$r = format.swf.SoundRate.SR22k;
		}break;
		case 3:{
			$r = format.swf.SoundRate.SR44k;
		}break;
		default:{
			$r = (function($this) {
				var $r;
				throw $this.error("invalid sound rate");
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
	var is16bit = this.bits.read();
	var isStereo = this.bits.read();
	var soundSamples = this.i.readInt32();
	var sdata = (function($this) {
		var $r;
		var $e = (soundFormat);
		switch( $e[1] ) {
		case 2:
		{
			$r = (function($this) {
				var $r;
				var seek = $this.i.readInt16();
				$r = format.swf.SoundData.SDMp3(seek,$this.i.read(len - 9));
				return $r;
			}($this));
		}break;
		case 3:
		{
			$r = format.swf.SoundData.SDRaw($this.i.read(len - 7));
		}break;
		default:{
			$r = format.swf.SoundData.SDOther($this.i.read(len - 7));
		}break;
		}
		return $r;
	}(this));
	return format.swf.SWFTag.TSound({ sid : sid, format : soundFormat, rate : soundRate, is16bit : is16bit, isStereo : isStereo, samples : soundSamples, data : sdata});
}
format.swf.Reader.prototype.readSoundInfo = function() {
	this.bits.nbits = 0;
	this.bits.readBits(2);
	var syncStop = (this.bits.readBits(1) == 1?true:false);
	var syncNoMultiple = this.bits.readBits(1);
	var hasEnvelope = this.bits.readBits(1);
	var hasLoops = (this.bits.readBits(1) == 1?true:false);
	var hasOutPoint = this.bits.readBits(1);
	var hasInPoint = this.bits.readBits(1);
	var inPoint;
	var outPoint;
	var loopCount = null;
	var envPoints;
	var envelopeRecords;
	if(hasInPoint == 1) inPoint = this.i.readUInt30();
	if(hasOutPoint == 1) outPoint = this.i.readUInt30();
	if(hasLoops) loopCount = this.i.readUInt16();
	if(hasEnvelope == 1) {
		envPoints = this.i.readByte();
		envelopeRecords = this.readEnvelopeRecords(envPoints);
	}
	return { syncStop : syncStop, hasLoops : hasLoops, loopCount : (hasLoops?loopCount:null)}
}
format.swf.Reader.prototype.readSymbols = function() {
	var sl = new Array();
	{
		var _g1 = 0, _g = this.i.readUInt16();
		while(_g1 < _g) {
			var n = _g1++;
			sl.push({ cid : this.i.readUInt16(), className : this.i.readUntil(0)});
		}
	}
	return sl;
}
format.swf.Reader.prototype.readTag = function() {
	var h = this.i.readUInt16();
	var id = h >> 6;
	var len = h & 63;
	var ext = false;
	if(len == 63) {
		len = this.i.readUInt30();
		if(len < 63) ext = true;
	}
	return (function($this) {
		var $r;
		switch(id) {
		case 0:{
			$r = null;
		}break;
		case 1:{
			$r = format.swf.SWFTag.TShowFrame;
		}break;
		case 2:{
			$r = $this.readShape(len,1);
		}break;
		case 22:{
			$r = $this.readShape(len,2);
		}break;
		case 32:{
			$r = $this.readShape(len,3);
		}break;
		case 83:{
			$r = $this.readShape(len,4);
		}break;
		case 46:{
			$r = $this.readMorphShape(1);
		}break;
		case 84:{
			$r = $this.readMorphShape(2);
		}break;
		case 10:{
			$r = $this.readFont(len,1);
		}break;
		case 48:{
			$r = $this.readFont(len,2);
		}break;
		case 75:{
			$r = $this.readFont(len,3);
		}break;
		case 13:{
			$r = $this.readFontInfo(len,1);
		}break;
		case 62:{
			$r = $this.readFontInfo(len,2);
		}break;
		case 9:{
			$r = (function($this) {
				var $r;
				$this.i.setEndian(true);
				var color = $this.i.readUInt24();
				$this.i.setEndian(false);
				$r = format.swf.SWFTag.TBackgroundColor(color);
				return $r;
			}($this));
		}break;
		case 20:{
			$r = format.swf.SWFTag.TBitsLossless($this.readLossless(len,false));
		}break;
		case 36:{
			$r = format.swf.SWFTag.TBitsLossless2($this.readLossless(len,true));
		}break;
		case 8:{
			$r = format.swf.SWFTag.TJPEGTables($this.i.read(len));
		}break;
		case 6:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				$r = format.swf.SWFTag.TBitsJPEG(cid,format.swf.JPEGData.JDJPEG1($this.i.read(len - 2)));
				return $r;
			}($this));
		}break;
		case 21:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				$r = format.swf.SWFTag.TBitsJPEG(cid,format.swf.JPEGData.JDJPEG2($this.i.read(len - 2)));
				return $r;
			}($this));
		}break;
		case 35:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var dataSize = $this.i.readUInt30();
				var data = $this.i.read(dataSize);
				var mask = $this.i.read(len - dataSize - 6);
				$r = format.swf.SWFTag.TBitsJPEG(cid,format.swf.JPEGData.JDJPEG3(data,mask));
				return $r;
			}($this));
		}break;
		case 26:{
			$r = format.swf.SWFTag.TPlaceObject2($this.readPlaceObject(false));
		}break;
		case 70:{
			$r = format.swf.SWFTag.TPlaceObject3($this.readPlaceObject(true));
		}break;
		case 28:{
			$r = format.swf.SWFTag.TRemoveObject2($this.i.readUInt16());
		}break;
		case 39:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var fcount = $this.i.readUInt16();
				var tags = $this.readTagList();
				$r = format.swf.SWFTag.TClip(cid,fcount,tags);
				return $r;
			}($this));
		}break;
		case 43:{
			$r = (function($this) {
				var $r;
				var label = $this.readUTF8Bytes();
				var anchor = (len == label.length + 2?$this.i.readByte() == 1:false);
				$r = format.swf.SWFTag.TFrameLabel(label.toString(),anchor);
				return $r;
			}($this));
		}break;
		case 59:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				$r = format.swf.SWFTag.TDoInitActions(cid,$this.i.read(len - 2));
				return $r;
			}($this));
		}break;
		case 69:{
			$r = format.swf.SWFTag.TSandBox($this.readFileAttributes());
		}break;
		case 72:{
			$r = format.swf.SWFTag.TActionScript3($this.i.read(len),null);
		}break;
		case 76:{
			$r = format.swf.SWFTag.TSymbolClass($this.readSymbols());
		}break;
		case 56:{
			$r = format.swf.SWFTag.TExportAssets($this.readSymbols());
		}break;
		case 82:{
			$r = (function($this) {
				var $r;
				var infos = { id : $this.i.readUInt30(), label : $this.i.readUntil(0)}
				len -= 4 + infos.label.length + 1;
				$r = format.swf.SWFTag.TActionScript3($this.i.read(len),infos);
				return $r;
			}($this));
		}break;
		case 87:{
			$r = (function($this) {
				var $r;
				var id1 = $this.i.readUInt16();
				if($this.i.readUInt30() != 0) throw $this.error("invalid binary data tag");
				$r = format.swf.SWFTag.TBinaryData(id1,$this.i.read(len - 6));
				return $r;
			}($this));
		}break;
		case 14:{
			$r = $this.readSound(len);
		}break;
		case 12:{
			$r = format.swf.SWFTag.TDoAction($this.i.read(len));
		}break;
		case 65:{
			$r = (function($this) {
				var $r;
				var maxRecursion = $this.i.readUInt16();
				var timeoutSeconds = $this.i.readUInt16();
				$r = format.swf.SWFTag.TScriptLimits(maxRecursion,timeoutSeconds);
				return $r;
			}($this));
		}break;
		case 15:{
			$r = (function($this) {
				var $r;
				var id1 = $this.i.readUInt16();
				$r = format.swf.SWFTag.TStartSound(id1,$this.readSoundInfo());
				return $r;
			}($this));
		}break;
		case 34:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var data = $this.i.read(len - 2);
				$r = format.swf.SWFTag.TUnknown(id,data);
				return $r;
			}($this));
		}break;
		case 37:{
			$r = (function($this) {
				var $r;
				var cid = $this.i.readUInt16();
				var data = $this.i.read(len - 2);
				$r = format.swf.SWFTag.TUnknown(id,data);
				return $r;
			}($this));
		}break;
		case 77:{
			$r = (function($this) {
				var $r;
				var data = $this.i.readString(len);
				$r = format.swf.SWFTag.TMetadata(data);
				return $r;
			}($this));
		}break;
		case 78:{
			$r = (function($this) {
				var $r;
				var id1 = $this.i.readUInt16();
				var splitter = $this.readRect();
				$r = format.swf.SWFTag.TDefineScalingGrid(id1,splitter);
				return $r;
			}($this));
		}break;
		default:{
			$r = (function($this) {
				var $r;
				var data = $this.i.read(len);
				$r = format.swf.SWFTag.TUnknown(id,data);
				return $r;
			}($this));
		}break;
		}
		return $r;
	}(this));
}
format.swf.Reader.prototype.readTagList = function() {
	var a = new Array();
	while(true) {
		var t = this.readTag();
		if(t == null) break;
		a.push(t);
	}
	return a;
}
format.swf.Reader.prototype.readUTF8Bytes = function() {
	var b = new haxe.io.BytesBuffer();
	while(true) {
		var c = this.i.readByte();
		if(c == 0) break;
		b.b.push(c);
	}
	return b.getBytes();
}
format.swf.Reader.prototype.version = null;
format.swf.Reader.prototype.__class__ = format.swf.Reader;
Std = function() { }
Std.__name__ = ["Std"];
Std["is"] = function(v,t) {
	return js.Boot.__instanceof(v,t);
}
Std.string = function(s) {
	return js.Boot.__string_rec(s,"");
}
Std["int"] = function(x) {
	if(x < 0) return Math.ceil(x);
	return Math.floor(x);
}
Std.parseInt = function(x) {
	var v = parseInt(x);
	if(Math.isNaN(v)) return null;
	return v;
}
Std.parseFloat = function(x) {
	return parseFloat(x);
}
Std.random = function(x) {
	return Math.floor(Math.random() * x);
}
Std.prototype.__class__ = Std;
format.zip.Writer = function(o) { if( o === $_ ) return; {
	this.o = o;
	this.files = new List();
}}
format.zip.Writer.__name__ = ["format","zip","Writer"];
format.zip.Writer.prototype.files = null;
format.zip.Writer.prototype.o = null;
format.zip.Writer.prototype.writeCDR = function() {
	var cdr_size = 0;
	var cdr_offset = 0;
	{ var $it27 = this.files.iterator();
	while( $it27.hasNext() ) { var f = $it27.next();
	{
		var namelen = f.name.length;
		var extraFieldsLength = f.fields.length;
		this.o.writeUInt30(33639248);
		this.o.writeUInt16(20);
		this.o.writeUInt16(20);
		this.o.writeUInt16(0);
		this.o.writeUInt16((f.compressed?8:0));
		this.writeZipDate(f.date);
		this.o.writeInt32(f.crc);
		this.o.writeUInt30(f.clen);
		this.o.writeUInt30(f.size);
		this.o.writeUInt16(namelen);
		this.o.writeUInt16(extraFieldsLength);
		this.o.writeUInt16(0);
		this.o.writeUInt16(0);
		this.o.writeUInt16(0);
		this.o.writeUInt30(0);
		this.o.writeUInt30(cdr_offset);
		this.o.writeString(f.name);
		this.o.write(f.fields);
		cdr_size += 46 + namelen + extraFieldsLength;
		cdr_offset += 30 + namelen + extraFieldsLength + f.clen;
	}
	}}
	this.o.writeUInt30(101010256);
	this.o.writeUInt16(0);
	this.o.writeUInt16(0);
	this.o.writeUInt16(this.files.length);
	this.o.writeUInt16(this.files.length);
	this.o.writeUInt30(cdr_size);
	this.o.writeUInt30(cdr_offset);
	this.o.writeUInt16(0);
}
format.zip.Writer.prototype.writeData = function(files) {
	{ var $it28 = files.iterator();
	while( $it28.hasNext() ) { var f = $it28.next();
	{
		this.writeEntryHeader(f);
		this.o.writeFullBytes(f.data,0,f.data.length);
	}
	}}
	this.writeCDR();
}
format.zip.Writer.prototype.writeEntryData = function(e,buf,data) {
	format.tools.IO.copy(data,this.o,buf,e.dataSize);
}
format.zip.Writer.prototype.writeEntryHeader = function(f) {
	var o = this.o;
	o.writeUInt30(67324752);
	o.writeUInt16(20);
	o.writeUInt16(0);
	if(f.data == null) {
		f.fileSize = 0;
		f.dataSize = 0;
		f.crc32 = 0;
		f.compressed = false;
		f.data = haxe.io.Bytes.alloc(0);
	}
	else {
		if(f.crc32 == null) {
			if(f.compressed) throw "CRC32 must be processed before compression";
			f.crc32 = format.tools.CRC32.encode(f.data);
		}
		if(!f.compressed) f.fileSize = f.data.length;
		f.dataSize = f.data.length;
	}
	o.writeUInt16((f.compressed?8:0));
	this.writeZipDate(f.fileTime);
	o.writeInt32(f.crc32);
	o.writeUInt30(f.dataSize);
	o.writeUInt30(f.fileSize);
	o.writeUInt16(f.fileName.length);
	var e = new haxe.io.BytesOutput();
	if(f.extraFields != null) {
		{ var $it29 = f.extraFields.iterator();
		while( $it29.hasNext() ) { var f1 = $it29.next();
		{
			var $e = (f1);
			switch( $e[1] ) {
			case 1:
			var crc = $e[3], name = $e[2];
			{
				var namebytes = haxe.io.Bytes.ofString(name);
				e.writeUInt16(28789);
				e.writeUInt16(namebytes.length + 5);
				e.writeByte(1);
				e.writeInt32(crc);
				e.write(namebytes);
			}break;
			case 0:
			var bytes = $e[3], tag = $e[2];
			{
				e.writeUInt16(tag);
				e.writeUInt16(bytes.length);
				e.write(bytes);
			}break;
			}
		}
		}}
	}
	var ebytes = e.getBytes();
	o.writeUInt16(ebytes.length);
	o.writeString(f.fileName);
	o.write(ebytes);
	this.files.add({ name : f.fileName, compressed : f.compressed, clen : f.data.length, size : f.fileSize, crc : f.crc32, date : f.fileTime, fields : ebytes});
}
format.zip.Writer.prototype.writeZipDate = function(date) {
	var hour = date.getHours();
	var min = date.getMinutes();
	var sec = date.getSeconds() >> 1;
	this.o.writeUInt16(((hour << 11) | (min << 5)) | sec);
	var year = date.getFullYear() - 1980;
	var month = date.getMonth() + 1;
	var day = date.getDate();
	this.o.writeUInt16(((year << 9) | (month << 5)) | day);
}
format.zip.Writer.prototype.__class__ = format.zip.Writer;
be.haxer.hxswfml.Hxavm2 = function(p) { if( p === $_ ) return; {
	this.log = true;
}}
be.haxer.hxswfml.Hxavm2.__name__ = ["be","haxer","hxswfml","Hxavm2"];
be.haxer.hxswfml.Hxavm2.prototype.abc2xml = function(abc) {
	return "";
}
be.haxer.hxswfml.Hxavm2.prototype.classDefs = null;
be.haxer.hxswfml.Hxavm2.prototype.className = null;
be.haxer.hxswfml.Hxavm2.prototype.createFunction = function(node,functionType,isInterface) {
	if(isInterface == null) isInterface = false;
	this.maxStack = 0;
	this.currentStack = 0;
	this.maxScopeStack = 0;
	this.currentScopeStack = 0;
	var args = new Array();
	var _args = node.get("args");
	if(_args == null || _args == "") args = [];
	else {
		var _g = 0, _g1 = _args.split(",");
		while(_g < _g1.length) {
			var i = _g1[_g];
			++_g;
			args.push(this.ctx.type(this.getImport(i)));
		}
	}
	var _return = ((node.get("return") == "" || node.get("return") == null)?this.ctx.type("*"):this.ctx.type(this.getImport(node.get("return"))));
	var _defaultParameters = null;
	var defaultParameters = node.get("defaultParameters");
	if(defaultParameters != null) {
		var values = defaultParameters.split(",");
		_defaultParameters = new Array();
		{
			var _g = 0;
			while(_g < values.length) {
				var v = values[_g];
				++_g;
				_defaultParameters.push(null);
			}
		}
	}
	var extra = { native : node.get("native") == "true", variableArgs : node.get("variableArgs") == "true", argumentsDefined : node.get("argumentsDefined") == "true", usesDXNS : node.get("usesDXNS") == "true", newBlock : node.get("newBlock") == "true", unused : node.get("unused") == "true", debugName : this.ctx.string((node.get("debugName") == null?"":node.get("debugName"))), defaultParameters : _defaultParameters, paramNames : null}
	var ns = this.namespaceType(node.get("ns"));
	var f = null;
	if(functionType == "function") {
		this.ctx.beginFunction(args,_return,extra);
		f = this.ctx.curFunction.f;
		var name = node.get("name");
		this.functionClosures.set(name,f.type);
	}
	else if(functionType == "method") {
		var _static = node.get("static") == "true";
		var _override = node.get("override") == "true";
		var _final = node.get("final") == "true";
		var _later = node.get("later") == "true";
		var kind = (function($this) {
			var $r;
			switch(node.get("kind")) {
			case "normal":{
				$r = format.abc.MethodKind.KNormal;
			}break;
			case "set":case "setter":{
				$r = format.abc.MethodKind.KSetter;
			}break;
			case "get":case "getter":{
				$r = format.abc.MethodKind.KGetter;
			}break;
			default:{
				$r = format.abc.MethodKind.KNormal;
			}break;
			}
			return $r;
		}(this));
		if(node.get("name") == this.className) {
			if(_static == true) {
				this.ctx.beginFunction(args,_return,extra);
				f = this.ctx.curFunction.f;
				this.curClass.statics = f.type;
			}
			else {
				if(isInterface) {
					f = this.ctx.beginInterfaceMethod(this.getImport(node.get("name")),args,_return,_static,_override,_final,true,kind,extra,ns);
					this.curClass.constructor = f.type;
					return f;
				}
				else {
					f = this.ctx.beginMethod(this.getImport(node.get("name")),args,_return,_static,_override,_final,true,kind,extra,ns);
					this.curClass.constructor = f.type;
				}
			}
		}
		else {
			if(isInterface) {
				var f1 = this.ctx.beginInterfaceMethod(this.getImport(node.get("name")),args,_return,_static,_override,_final,_later,kind,extra,ns);
				return f1;
			}
			else f = this.ctx.beginMethod(this.getImport(node.get("name")),args,_return,_static,_override,_final,_later,kind,extra,ns);
		}
	}
	else if(functionType == "init") {
		this.ctx.beginFunction(args,_return,extra);
		f = this.ctx.curFunction.f;
		var name = this.getImport(node.get("name"));
		this.inits.set(name,f.type);
	}
	if(node.get("locals") != null) {
		var locals = this.parseLocals(node.get("locals"));
		if(locals.length != 0) f.locals = locals;
	}
	var result = this.writeCodeBlock(node,f);
	if(node.get("maxStack") != null) f.maxStack = Std.parseInt(node.get("maxStack"));
	else f.maxStack = this.maxStack + f.trys.length;
	if(node.get("maxScope") != null) f.maxScope = Std.parseInt(node.get("maxScope"));
	else f.maxScope = this.maxScopeStack;
	if(this.currentStack > 0) this.nonEmptyStack(node.get("name"));
	return f;
}
be.haxer.hxswfml.Hxavm2.prototype.ctx = null;
be.haxer.hxswfml.Hxavm2.prototype.curClass = null;
be.haxer.hxswfml.Hxavm2.prototype.curClassName = null;
be.haxer.hxswfml.Hxavm2.prototype.currentScopeStack = null;
be.haxer.hxswfml.Hxavm2.prototype.currentStack = null;
be.haxer.hxswfml.Hxavm2.prototype.functionClosures = null;
be.haxer.hxswfml.Hxavm2.prototype.getAnyAttribute = function(element,arr) {
	{
		var _g1 = 0, _g = arr.length;
		while(_g1 < _g) {
			var i = _g1++;
			if(element.get(arr[i]) != null) return element.get(arr[i]);
		}
	}
	throw ("Missing attribute on element. Valid attributes are:" + arr.toString());
}
be.haxer.hxswfml.Hxavm2.prototype.getImport = function(name) {
	if(this.imports.exists(name)) return this.imports.get(name);
	return name;
}
be.haxer.hxswfml.Hxavm2.prototype.imports = null;
be.haxer.hxswfml.Hxavm2.prototype.inits = null;
be.haxer.hxswfml.Hxavm2.prototype.jumps = null;
be.haxer.hxswfml.Hxavm2.prototype.labels = null;
be.haxer.hxswfml.Hxavm2.prototype.log = null;
be.haxer.hxswfml.Hxavm2.prototype.logStack = function(msg) {
	haxe.Log.trace(msg,{ fileName : "Hxavm2.hx", lineNumber : 556, className : "be.haxer.hxswfml.Hxavm2", methodName : "logStack"});
}
be.haxer.hxswfml.Hxavm2.prototype.maxScopeStack = null;
be.haxer.hxswfml.Hxavm2.prototype.maxStack = null;
be.haxer.hxswfml.Hxavm2.prototype.name = null;
be.haxer.hxswfml.Hxavm2.prototype.namespaceType = function(ns) {
	return this.ctx["namespace"]((function($this) {
		var $r;
		switch(ns) {
		case "public":{
			$r = format.abc.Namespace.NPublic($this.ctx.string(""));
		}break;
		case "private":{
			$r = format.abc.Namespace.NPrivate($this.ctx.string("*"));
		}break;
		case "protected":{
			$r = format.abc.Namespace.NProtected($this.ctx.string($this.curClassName));
		}break;
		case "internal":{
			$r = format.abc.Namespace.NInternal($this.ctx.string(""));
		}break;
		case "namespace":{
			$r = format.abc.Namespace.NNamespace($this.ctx.string($this.curClassName));
		}break;
		case "explicit":{
			$r = format.abc.Namespace.NExplicit($this.ctx.string(""));
		}break;
		case "staticProtected":{
			$r = format.abc.Namespace.NStaticProtected($this.ctx.string($this.curClassName));
		}break;
		default:{
			$r = format.abc.Namespace.NPublic($this.ctx.string(""));
		}break;
		}
		return $r;
	}(this)));
}
be.haxer.hxswfml.Hxavm2.prototype.nonEmptyStack = function(fname) {
	var msg = "!Error: Function " + fname + " did not end with empty stack. current stack: " + this.currentStack;
	if(this.throwsErrors) throw (msg);
	if(this.log) this.logStack(msg);
}
be.haxer.hxswfml.Hxavm2.prototype.parseFieldKind = function(fld) {
	return format.abc.FieldKind.FVar();
}
be.haxer.hxswfml.Hxavm2.prototype.parseLocals = function(locals) {
	var locs = locals.split(",");
	var out = new Array();
	var index = 1;
	{
		var _g = 0;
		while(_g < locs.length) {
			var l = locs[_g];
			++_g;
			var props = l.split(":");
			out.push({ name : this.ctx.type(this.getImport(props[0])), slot : index, kind : this.parseFieldKind(l), metadatas : null});
			index++;
		}
	}
	return out;
}
be.haxer.hxswfml.Hxavm2.prototype.scopeStackError = function(op,type) {
	var o = Type.getEnum(op);
	var msg = (type == 0?"!Error scopeStack underflow: " + op:"!Error scopeStack overflow: " + op);
	if(this.throwsErrors) throw (msg);
	if(this.log) this.logStack(msg);
}
be.haxer.hxswfml.Hxavm2.prototype.stackError = function(op,type) {
	var o = Type.getEnum(op);
	var msg = (type == 0?"!Error stack underflow: " + op:"!Error stack overflow: " + op);
	if(this.throwsErrors) throw (msg);
	if(this.log) this.logStack(msg);
}
be.haxer.hxswfml.Hxavm2.prototype.throwsErrors = null;
be.haxer.hxswfml.Hxavm2.prototype.updateStacks = function(opc) {
	if(this.log) this.logStack(opc);
	var $e = (opc);
	switch( $e[1] ) {
	case 0:
	{
		null;
	}break;
	case 1:
	{
		null;
	}break;
	case 2:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 3:
	var v = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		++this.currentStack;
	}break;
	case 4:
	var v = $e[2];
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
	}break;
	case 5:
	var i = $e[2];
	{
		null;
	}break;
	case 6:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 7:
	var r = $e[2];
	{
		null;
	}break;
	case 8:
	{
		null;
	}break;
	case 9:
	var name = $e[2];
	{
		null;
	}break;
	case 10:
	var delta = $e[3], j = $e[2];
	{
		var $e = (j);
		switch( $e[1] ) {
		case 4:
		{
			null;
		}break;
		case 5:
		case 6:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
		}break;
		case 0:
		case 1:
		case 2:
		case 3:
		case 7:
		case 8:
		case 9:
		case 10:
		case 11:
		case 12:
		case 13:
		case 14:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		}break;
		}
	}break;
	case 11:
	var offset = $e[4], landingName = $e[3], j = $e[2];
	{
		null;
	}break;
	case 12:
	var landingName = $e[2];
	{
		null;
	}break;
	case 13:
	var deltas = $e[3], def = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 14:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.maxScopeStack++;
	}break;
	case 15:
	{
		if(--this.currentScopeStack < 0) this.scopeStackError(opc,0);
	}break;
	case 16:
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 17:
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 18:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 19:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 20:
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 21:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 22:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 23:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 24:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 25:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 26:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 27:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 28:
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		this.currentStack += 2;
	}break;
	case 29:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 30:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 31:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 32:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 33:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentScopeStack++;
		this.maxScopeStack++;
	}break;
	case 34:
	var v = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 35:
	var r2 = $e[3], r1 = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 36:
	var f = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 37:
	var n = $e[2];
	{
		if((this.currentStack -= (n + 2)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 38:
	var n = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 39:
	var n = $e[3], s = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 40:
	var n = $e[3], m = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 41:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 42:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 43:
	{
		null;
	}break;
	case 44:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 45:
	var n = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
	}break;
	case 46:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 47:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 48:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
	}break;
	case 49:
	var n = $e[3], p = $e[2];
	{
		if((this.currentStack -= (n + 1)) < 0) this.stackError(opc,0);
	}break;
	case 50:
	var n = $e[2];
	{
		null;
	}break;
	case 51:
	var n = $e[2];
	{
		if((this.currentStack -= (n * 2)) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 52:
	var n = $e[2];
	{
		if((this.currentStack -= n) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 53:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 54:
	var c = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 55:
	var i = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 56:
	var c = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 57:
	var p = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 58:
	var p = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 59:
	var d = $e[2];
	{
		null;
	}break;
	case 60:
	var p = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 61:
	var p = $e[2];
	{
		var popCount = 2;
		if(p == this.ctx.arrayProp) popCount = 3;
		if((this.currentStack -= popCount) < 0) this.stackError(opc,0);
	}break;
	case 62:
	var r = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
		switch(r) {
		case 0:{
			null;
		}break;
		case 1:{
			null;
		}break;
		case 2:{
			null;
		}break;
		case 3:{
			null;
		}break;
		default:{
			null;
		}break;
		}
	}break;
	case 63:
	var r = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		switch(r) {
		case 0:{
			null;
		}break;
		case 1:{
			null;
		}break;
		case 2:{
			null;
		}break;
		case 3:{
			null;
		}break;
		default:{
			null;
		}break;
		}
	}break;
	case 64:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 65:
	var n = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 66:
	var p = $e[2];
	{
		if(p == this.ctx.arrayProp) if(--this.currentStack < 0) this.stackError(opc,0);
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 67:
	var p = $e[2];
	{
		if((this.currentStack -= 2) < 0) {
			this.stackError(opc,0);
		}
	}break;
	case 68:
	var p = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 69:
	var s = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 70:
	var s = $e[2];
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
	}break;
	case 71:
	var s = $e[2];
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 72:
	var s = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 73:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 74:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 75:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 76:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 77:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 78:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 79:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 80:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 81:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 82:
	var t = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 83:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 84:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 85:
	var t = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 86:
	{
		null;
	}break;
	case 87:
	var r = $e[2];
	{
		null;
	}break;
	case 88:
	var r = $e[2];
	{
		null;
	}break;
	case 89:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 90:
	{
		if((this.currentStack -= 2) < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 91:
	var t = $e[2];
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
		this.currentStack++;
	}break;
	case 92:
	var r = $e[2];
	{
		null;
	}break;
	case 93:
	var r = $e[2];
	{
		null;
	}break;
	case 94:
	{
		if(++this.currentStack > this.maxStack) this.maxStack++;
	}break;
	case 95:
	{
		if(--this.currentStack < 0) this.stackError(opc,0);
	}break;
	case 96:
	var line = $e[4], r = $e[3], name = $e[2];
	{
		null;
	}break;
	case 97:
	var line = $e[2];
	{
		null;
	}break;
	case 98:
	var file = $e[2];
	{
		null;
	}break;
	case 99:
	var n = $e[2];
	{
		null;
	}break;
	case 100:
	{
		null;
	}break;
	case 101:
	var op = $e[2];
	{
		var $e = (op);
		switch( $e[1] ) {
		case 0:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 1:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 2:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 3:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 4:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 5:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 6:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 7:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 8:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 9:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 10:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 11:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 12:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 13:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 14:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 15:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 16:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 17:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 18:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 19:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 20:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 21:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 22:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 23:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 24:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 25:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 26:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 27:
		{
			if(--this.currentStack < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 28:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 29:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 30:
		{
			if((this.currentStack -= 2) < 0) this.stackError(opc,0);
			this.currentStack++;
		}break;
		case 31:
		{
			null;
		}break;
		case 32:
		{
			null;
		}break;
		case 33:
		{
			null;
		}break;
		case 34:
		{
			null;
		}break;
		case 35:
		{
			null;
		}break;
		case 36:
		{
			null;
		}break;
		case 37:
		{
			null;
		}break;
		case 38:
		{
			null;
		}break;
		case 39:
		{
			null;
		}break;
		case 40:
		{
			null;
		}break;
		case 41:
		{
			null;
		}break;
		case 42:
		{
			null;
		}break;
		case 43:
		{
			null;
		}break;
		}
	}break;
	case 102:
	var byte = $e[2];
	{
		null;
	}break;
	}
	if(this.log) this.logStack("currentStack= " + this.currentStack + ", maxStack= " + this.maxStack + "\ncurrentScopeStack= " + this.currentScopeStack + ", maxScopeStack= " + this.maxScopeStack + "\n\n");
}
be.haxer.hxswfml.Hxavm2.prototype.writeCodeBlock = function(member,f) {
	if(this.log) this.logStack("------------------------------------------------\ncurrent class= " + this.className + ", method= " + member.get("name") + "\ncurrentStack= " + this.currentStack + ", maxStack= " + this.maxStack + "\ncurrentScopeStack= " + this.currentScopeStack + ", maxScopeStack= " + this.maxScopeStack + "\n\n");
	{ var $it30 = member.elements();
	while( $it30.hasNext() ) { var o = $it30.next();
	{
		var op = (function($this) {
			var $r;
			switch(o.getNodeName()) {
			case "OBreakPoint":case "ONop":case "OThrow":case "ODxNsLate":case "OPushWith":case "OPopScope":case "OForIn":case "OHasNext":case "ONull":case "OUndefined":case "OForEach":case "OTrue":case "OFalse":case "ONaN":case "OPop":case "ODup":case "OSwap":case "OScope":case "ONewBlock":case "ORetVoid":case "ORet":case "OToString":case "OGetGlobalScope":case "OInstanceOf":case "OToXml":case "OToXmlAttr":case "OToInt":case "OToUInt":case "OToNumber":case "OToBool":case "OToObject":case "OCheckIsXml":case "OAsAny":case "OAsString":case "OAsObject":case "OTypeof":case "OThis":case "OSetThis":case "OTimestamp":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName());
			}break;
			case "ODxNs":case "ODebugFile":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.string($this.getAnyAttribute(o,["v","file"]))]);
			}break;
			case "OString":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.string(StringTools.urlDecode($this.getAnyAttribute(o,["v","file"])))]);
			}break;
			case "OIntRef":case "OUIntRef":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx["int"](Std.parseInt(o.get("v")))]);
			}break;
			case "OFloat":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx["float"](Std.parseFloat(o.get("v")))]);
			}break;
			case "ONamespace":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.type(o.get("v"))]);
			}break;
			case "OClassDef":{
				$r = (!$this.classDefs.exists(o.get("c"))?(function($this) {
					var $r;
					throw o.get("c") + " must be created as class before referencing it here.";
					return $r;
				}($this)):Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.classDefs.get(o.get("c"))]));
			}break;
			case "OFunction":{
				$r = (!$this.functionClosures.exists(o.get("f"))?(function($this) {
					var $r;
					throw o.get("f") + " must be created as function (closure) before referencing it here.";
					return $r;
				}($this)):Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.functionClosures.get(o.get("f"))]));
			}break;
			case "OGetSuper":case "OSetSuper":case "OGetDescendants":case "OFindPropStrict":case "OFindProp":case "OFindDefinition":case "OGetLex":case "OSetProp":case "OGetProp":case "OInitProp":case "ODeleteProp":case "OCast":case "OAsType":case "OIsType":{
				$r = (function($this) {
					var $r;
					var v = $this.getAnyAttribute(o,["v","c","cast","p","d","t"]);
					$r = (v == "#arrayProp"?Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.arrayProp]):Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.type($this.getImport(v))]));
					return $r;
				}($this));
			}break;
			case "OCallSuper":case "OCallProperty":case "OConstructProperty":case "OCallPropLex":case "OCallSuperVoid":case "OCallPropVoid":{
				$r = (function($this) {
					var $r;
					var p = $this.getAnyAttribute(o,["type","name","p"]);
					var nargs = Std.parseInt(o.get("nargs"));
					$r = (p == "#arrayProp"?Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.arrayProp,nargs]):Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.type($this.getImport(p)),nargs]));
					return $r;
				}($this));
			}break;
			case "ORegKill":case "OReg":case "OIncrReg":case "ODecrReg":case "OIncrIReg":case "ODecrIReg":case "OSmallInt":case "OInt":case "OGetScope":case "ODebugLine":case "OBreakPointLine":case "OUnknown":case "OCallStack":case "OConstruct":case "OConstructSuper":case "OApplyType":case "OObject":case "OArray":case "OGetSlot":case "OSetSlot":case "OGetGlobalSlot":case "OSetGlobalSlot":{
				$r = (function($this) {
					var $r;
					var v = Std.parseInt($this.getAnyAttribute(o,["c","r","v","n","s","line","byte","nargs","nfields","nvalues"]));
					$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[v]);
					return $r;
				}($this));
			}break;
			case "OCatch":{
				$r = (function($this) {
					var $r;
					var _try = { start : Std.parseInt(o.get("start")), end : Std.parseInt(o.get("end")), handle : Std.parseInt(o.get("handle")), type : $this.ctx.type($this.getImport(o.get("type"))), variable : $this.ctx.type($this.getImport(o.get("variable")))}
					f.trys.push(_try);
					$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[f.trys.length - 1]);
					return $r;
				}($this));
			}break;
			case "OSetReg":{
				$r = (function($this) {
					var $r;
					$this.ctx.allocRegister();
					var v = Std.parseInt($this.getAnyAttribute(o,["r","v"]));
					$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[v]);
					return $r;
				}($this));
			}break;
			case "OpAs":case "OpNeg":case "OpIncr":case "OpDecr":case "OpNot":case "OpBitNot":case "OpAdd":case "OpSub":case "OpMul":case "OpDiv":case "OpMod":case "OpShl":case "OpShr":case "OpUShr":case "OpAnd":case "OpOr":case "OpXor":case "OpEq":case "OpPhysEq":case "OpLt":case "OpLte":case "OpGt":case "OpGte":case "OpIs":case "OpIn":case "OpIIncr":case "OpIDecr":case "OpINeg":case "OpIAdd":case "OpISub":case "OpIMul":case "OpMemGet8":case "OpMemGet16":case "OpMemGet32":case "OpMemGetFloat":case "OpMemGetDouble":case "OpMemSet8":case "OpMemSet16":case "OpMemSet32":case "OpMemSetFloat":case "OpMemSetDouble":case "OpSign1":case "OpSign8":case "OpSign16":{
				$r = Type.createEnum(format.abc.OpCode,"OOp",[Type.createEnum(format.abc.Operation,o.getNodeName())]);
			}break;
			case "OOp":{
				$r = Type.createEnum(format.abc.OpCode,"OOp",[Type.createEnum(format.abc.Operation,$this.getAnyAttribute(o,["type","op","args"]))]);
			}break;
			case "OCallStatic":{
				$r = (function($this) {
					var $r;
					var meth = format.abc.Index.Idx(Std.parseInt(o.get("meth")));
					var nargs = Std.parseInt(o.get("nargs"));
					$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[meth,nargs]);
					return $r;
				}($this));
			}break;
			case "OCallMethod":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[Std.parseInt(o.get("s")),Std.parseInt(o.get("nargs"))]);
			}break;
			case "OJump":{
				$r = (function($this) {
					var $r;
					var jumpName = o.get("name");
					$r = (jumpName != null?(function($this) {
						var $r;
						($this.jumps.get(jumpName))();
						if($this.log) $this.logStack("OJump name=" + jumpName);
						$r = null;
						return $r;
					}($this)):(function($this) {
						var $r;
						var j = Type.createEnum(format.abc.JumpStyle,o.get("jump"),[]);
						var offset = Std.parseInt(o.get("offset"));
						$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[j,offset]);
						return $r;
					}($this)));
					return $r;
				}($this));
			}break;
			case "JNotLt":case "JNotLte":case "JNotGt":case "JNotGte":case "JAlways":case "JTrue":case "JFalse":case "JEq":case "JNeq":case "JLt":case "JLte":case "JGt":case "JGte":case "JPhysEq":case "JPhysNeq":{
				$r = (function($this) {
					var $r;
					var jump = Type.createEnum(format.abc.JumpStyle,o.getNodeName());
					var jumpName = o.get("jump");
					var labelName = o.get("label");
					if(jumpName != null) $this.jumps.set(jumpName,$this.ctx.jump(jump));
					else if(labelName != null) ($this.labels.get(labelName))(jump);
					$this.updateStacks(format.abc.OpCode.OJump(jump,0));
					$r = null;
					return $r;
				}($this));
			}break;
			case "OLabel":{
				$r = (o.get("name") != null?(function($this) {
					var $r;
					if($this.log) $this.logStack("OLabel name=" + o.get("name"));
					$this.updateStacks(format.abc.OpCode.OLabel);
					$this.labels.set(o.get("name"),$this.ctx.backwardJump());
					$r = null;
					return $r;
				}($this)):Type.createEnum(format.abc.OpCode,o.getNodeName(),[]));
			}break;
			case "OSwitch":{
				$r = (function($this) {
					var $r;
					var arr = o.get("deltas").split(",");
					var deltas = new Array();
					{
						var _g = 0;
						while(_g < arr.length) {
							var i = arr[_g];
							++_g;
							deltas.push(Std.parseInt(i));
						}
					}
					$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[Std.parseInt(o.get("def")),deltas]);
					return $r;
				}($this));
			}break;
			case "ONext":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[Std.parseInt(o.get("r1")),Std.parseInt(o.get("r2"))]);
			}break;
			case "ODebugReg":{
				$r = Type.createEnum(format.abc.OpCode,o.getNodeName(),[$this.ctx.string(o.get("name")),Std.parseInt(o.get("r")),Std.parseInt(o.get("line"))]);
			}break;
			default:{
				$r = (function($this) {
					var $r;
					throw (o.getNodeName() + " Unknown opcode.");
					return $r;
				}($this));
			}break;
			}
			return $r;
		}(this));
		if(op != null) {
			this.updateStacks(op);
			this.ctx.op(op);
		}
	}
	}}
	return true;
}
be.haxer.hxswfml.Hxavm2.prototype.xml2abc = function(xml) {
	var swfTags = [];
	var abcfiles = Xml.parse(xml).firstElement();
	{ var $it31 = abcfiles.elements();
	while( $it31.hasNext() ) { var abcfile = $it31.next();
	{
		swfTags.push(this.xmlToabc(abcfile));
	}
	}}
	return swfTags;
}
be.haxer.hxswfml.Hxavm2.prototype.xmlToabc = function(xml) {
	var ctx_xml = xml;
	this.ctx = new format.abc.Context();
	this.jumps = new Hash();
	this.labels = new Hash();
	this.curClassName = "";
	var statics = new Array();
	this.imports = new Hash();
	this.functionClosures = new Hash();
	this.inits = new Hash();
	this.classDefs = new Hash();
	var ctx = this.ctx;
	{ var $it32 = ctx_xml.elements();
	while( $it32.hasNext() ) { var _classNode = $it32.next();
	{
		switch(_classNode.getNodeName()) {
		case "function":{
			this.createFunction(_classNode,"function");
		}break;
		default:{
			null;
		}break;
		}
	}
	}}
	{ var $it33 = ctx_xml.elements();
	while( $it33.hasNext() ) { var _classNode = $it33.next();
	{
		switch(_classNode.getNodeName()) {
		case "function":{
			null;
		}break;
		case "init":{
			null;
		}break;
		case "import":{
			var n = _classNode.get("class");
			var cn = n.split(".").pop();
			this.imports.set(cn,n);
		}break;
		case "class":case "interface":{
			this.className = _classNode.get("name");
			var cl = ctx.beginClass(this.className,_classNode.get("interface") == "true");
			this.curClass = cl;
			this.classDefs.set(this.className,ctx.getClass(cl));
			this.curClassName = this.className.split(".").pop();
			if(_classNode.get("implements") != null) {
				cl.interfaces = [];
				{
					var _g = 0, _g1 = _classNode.get("implements").split(",");
					while(_g < _g1.length) {
						var i = _g1[_g];
						++_g;
						cl.interfaces.push(ctx.type(this.getImport(i)));
					}
				}
			}
			cl.isFinal = _classNode.get("final") == "true";
			cl.isInterface = _classNode.get("interface") == "true";
			cl.isSealed = _classNode.get("sealed") == "true";
			var _extends = _classNode.get("extends");
			if(_extends != null) {
				cl.superclass = ctx.type(this.getImport(_extends));
				ctx.addClassSuper(this.getImport(_extends));
			}
			{ var $it34 = _classNode.elements();
			while( $it34.hasNext() ) { var member = $it34.next();
			{
				switch(member.getNodeName()) {
				case "field":case "var":{
					var name = member.get("name");
					var type = member.get("type");
					if(type == null || type == "") type = "*";
					var isStatic = member.get("static") == "true";
					var value = member.get("value");
					var $const = member.get("const") == "true";
					var ns = this.namespaceType(member.get("ns"));
					var _value = ((value == null)?null:(function($this) {
						var $r;
						switch(type) {
						case "String":{
							$r = format.abc.Value.VString(ctx.string(value));
						}break;
						case "int":{
							$r = format.abc.Value.VInt(ctx["int"](Std.parseInt(value)));
						}break;
						case "uint":{
							$r = format.abc.Value.VUInt(ctx.uint(Std.parseInt(value)));
						}break;
						case "Number":{
							$r = format.abc.Value.VFloat(ctx["float"](Std.parseFloat(value)));
						}break;
						case "Boolean":{
							$r = format.abc.Value.VBool(value == "true");
						}break;
						default:{
							$r = (function($this) {
								var $r;
								null;
								$r = (function($this) {
									var $r;
									throw ("You must provide a datatype for: " + name + " if you provide a value here.(Supported types for predefined values are String, int, uint, Number, Boolean)");
									return $r;
								}($this));
								return $r;
							}($this));
						}break;
						}
						return $r;
					}(this)));
					ctx.defineField(name,ctx.type(this.getImport(type)),isStatic,_value,$const,ns);
				}break;
				case "method":case "function":{
					this.createFunction(member,"method",cl.isInterface);
				}break;
				default:{
					throw (member.getNodeName() + " Must be <method/> or <var/>.");
				}break;
				}
			}
			}}
			{ var $it35 = ctx_xml.elements();
			while( $it35.hasNext() ) { var _classNode1 = $it35.next();
			{
				switch(_classNode1.getNodeName()) {
				case "init":{
					if(_classNode1.get("name") == this.className) this.createFunction(_classNode1,"init");
				}break;
				default:{
					null;
				}break;
				}
			}
			}}
			if(this.inits.exists(this.className)) {
				ctx.getData().inits[ctx.getData().inits.length - 1].method = this.inits.get(this.className);
				ctx.endClass(false);
			}
			else {
				ctx.endClass();
			}
		}break;
		default:{
			throw ("<" + _classNode.getNodeName() + "> Must be <function>, <init>, <import> or <class [<var>], [<method>]>.");
		}break;
		}
	}
	}}
	var abcFile = ctx.getData();
	var abcOutput = new haxe.io.BytesOutput();
	format.abc.Writer.write(abcOutput,abcFile);
	return format.swf.SWFTag.TActionScript3(abcOutput.getBytes(),{ id : 1, label : this.className});
}
be.haxer.hxswfml.Hxavm2.prototype.__class__ = be.haxer.hxswfml.Hxavm2;
format.swf.Tools = function() { }
format.swf.Tools.__name__ = ["format","swf","Tools"];
format.swf.Tools.signExtend = function(v,nbits) {
	var max = 1 << nbits;
	if((v & (max >> 1)) != 0) return v - max;
	return v;
}
format.swf.Tools.floatFixedBits = function(i,nbits) {
	i = format.swf.Tools.signExtend(i,nbits);
	return (i >> 16) + (i & 65535) / 65536.0;
}
format.swf.Tools.floatFixed = function(i) {
	return haxe.Int32.toInt((i) >> 16) + haxe.Int32.toInt((i) & 65535) / 65536.0;
}
format.swf.Tools.floatFixed8 = function(i) {
	return (i >> 8) + (i & 255) / 256.0;
}
format.swf.Tools.toFixed8 = function(f) {
	var i = Std["int"](f);
	if((((i > 0)?i:-i)) >= 128) throw haxe.io.Error.Overflow;
	if(i < 0) i = 256 - i;
	return (i << 8) | Std["int"]((f - i) * 256.0);
}
format.swf.Tools.toFixed16 = function(f) {
	var i = Std["int"](f);
	if((((i > 0)?i:-i)) >= 32768) throw haxe.io.Error.Overflow;
	if(i < 0) i = 65536 - i;
	return (i << 16) | Std["int"]((f - i) * 65536.0);
}
format.swf.Tools.minBits = function(values) {
	var max_bits = 0;
	{
		var _g = 0;
		while(_g < values.length) {
			var x = values[_g];
			++_g;
			if(x < 0) x = -x;
			x |= (x >> 1);
			x |= (x >> 2);
			x |= (x >> 4);
			x |= (x >> 8);
			x |= (x >> 16);
			x -= ((x >> 1) & 1431655765);
			x = (((x >> 2) & 858993459) + (x & 858993459));
			x = (((x >> 4) + x) & 252645135);
			x += (x >> 8);
			x += (x >> 16);
			x &= 63;
			if(x > max_bits) max_bits = x;
		}
	}
	return max_bits;
}
format.swf.Tools.hex = function(b,max) {
	var hex = [48,49,50,51,52,53,54,55,56,57,65,66,67,68,69,70];
	var count = (max == null || b.length <= max?b.length:max);
	var buf = new StringBuf();
	{
		var _g = 0;
		while(_g < count) {
			var i = _g++;
			var v = b.b[i];
			buf.b[buf.b.length] = String.fromCharCode(hex[v >> 4]);
			buf.b[buf.b.length] = String.fromCharCode(hex[v & 15]);
		}
	}
	if(count < b.length) buf.b[buf.b.length] = "...";
	return buf.b.join("");
}
format.swf.Tools.bin = function(b,maxBytes) {
	var buf = new StringBuf();
	var cnt = ((maxBytes == null)?b.length:((maxBytes > b.length?b.length:maxBytes)));
	{
		var _g = 0;
		while(_g < cnt) {
			var i = _g++;
			var v = b.b[i];
			{
				var _g1 = 0;
				while(_g1 < 8) {
					var j = _g1++;
					buf.b[buf.b.length] = ((((v >> (7 - j)) & 1) == 1)?"1":"0");
					if(j == 3) buf.b[buf.b.length] = " ";
				}
			}
			buf.b[buf.b.length] = "  ";
		}
	}
	return buf.b.join("");
}
format.swf.Tools.dumpTag = function(t,max) {
	var infos = (function($this) {
		var $r;
		var $e = (t);
		switch( $e[1] ) {
		case 0:
		{
			$r = [];
		}break;
		case 1:
		{
			$r = [];
		}break;
		case 6:
		var color = $e[2];
		{
			$r = [StringTools.hex(color,6)];
		}break;
		case 2:
		var sdata = $e[3], id = $e[2];
		{
			$r = ["id",id];
		}break;
		case 3:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id];
		}break;
		case 4:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id];
		}break;
		case 5:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id];
		}break;
		case 21:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id,"data",format.swf.Tools.hex(data,max)];
		}break;
		case 7:
		var tags = $e[4], frames = $e[3], id = $e[2];
		{
			$r = ["id",id,"frames",frames];
		}break;
		case 8:
		var po = $e[2];
		{
			$r = [Std.string(po)];
		}break;
		case 9:
		var po = $e[2];
		{
			$r = [Std.string(po)];
		}break;
		case 10:
		var d = $e[2];
		{
			$r = ["depth",d];
		}break;
		case 11:
		var anchor = $e[3], label = $e[2];
		{
			$r = ["label",label,"anchor",anchor];
		}break;
		case 12:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id,"data",format.swf.Tools.hex(data,max)];
		}break;
		case 13:
		var context = $e[3], data = $e[2];
		{
			$r = ["context",context,"data",format.swf.Tools.hex(data,max)];
		}break;
		case 14:
		var symbols = $e[2];
		{
			$r = [Std.string(symbols)];
		}break;
		case 15:
		var symbols = $e[2];
		{
			$r = [Std.string(symbols)];
		}break;
		case 16:
		var v = $e[2];
		{
			$r = [v];
		}break;
		case 17:
		case 18:
		var l = $e[2];
		{
			$r = ["id",l.cid,"color",l.color,"width",l.width,"height",l.height,"data",format.swf.Tools.hex(l.data,max)];
		}break;
		case 20:
		var data = $e[2];
		{
			$r = ["data",format.swf.Tools.hex(data,max)];
		}break;
		case 19:
		var jdata = $e[3], id = $e[2];
		{
			$r = (function($this) {
				var $r;
				var $e = (jdata);
				switch( $e[1] ) {
				case 0:
				var data = $e[2];
				{
					$r = ["id",id,"ver",1,"data",format.swf.Tools.hex(data,max)];
				}break;
				case 1:
				var data = $e[2];
				{
					$r = ["id",id,"ver",2,"data",format.swf.Tools.hex(data,max)];
				}break;
				case 2:
				var mask = $e[3], data = $e[2];
				{
					$r = ["id",id,"ver",3,"data",format.swf.Tools.hex(data,max),"mask",format.swf.Tools.hex(mask,max)];
				}break;
				default:{
					$r = null;
				}break;
				}
				return $r;
			}($this));
		}break;
		case 22:
		var data = $e[2];
		{
			$r = ["sid",data.sid,"format",data.format,"rate",data.rate];
		}break;
		case 23:
		var soundInfo = $e[3], id = $e[2];
		{
			$r = ["id",id,"syncStop",soundInfo.syncStop,"hasLoops",soundInfo.hasLoops,"loopCount",soundInfo.loopCount];
		}break;
		case 24:
		var data = $e[2];
		{
			$r = [format.swf.Tools.hex(data,max)];
		}break;
		case 25:
		var timeoutSeconds = $e[3], maxRecursion = $e[2];
		{
			$r = ["maxRecursion",maxRecursion,"timeoutSeconds",timeoutSeconds];
		}break;
		case 26:
		var records = $e[3], id = $e[2];
		{
			$r = ["id",id,"records",records];
		}break;
		case 27:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id];
		}break;
		case 28:
		var data = $e[2];
		{
			$r = ["metadata",data];
		}break;
		case 29:
		var splitter = $e[3], id = $e[2];
		{
			$r = ["id",id,"splitter","todo"];
		}break;
		case 30:
		var data = $e[3], id = $e[2];
		{
			$r = ["id",id,"data",format.swf.Tools.hex(data,max)];
		}break;
		default:{
			$r = null;
		}break;
		}
		return $r;
	}(this));
	var b = new StringBuf();
	b.b[b.b.length] = Type.enumConstructor(t);
	b.b[b.b.length] = "(";
	while(infos.length > 0) {
		b.b[b.b.length] = infos.shift();
		if(infos.length == 0) break;
		b.b[b.b.length] = ":";
		b.b[b.b.length] = infos.shift();
		if(infos.length == 0) break;
		b.b[b.b.length] = ",";
	}
	b.b[b.b.length] = ")";
	return b.b.join("");
}
format.swf.Tools.prototype.__class__ = format.swf.Tools;
format.tools.Adler32 = function(p) { if( p === $_ ) return; {
	this.a1 = 1;
	this.a2 = 0;
}}
format.tools.Adler32.__name__ = ["format","tools","Adler32"];
format.tools.Adler32.read = function(i) {
	var a = new format.tools.Adler32();
	var a2a = i.readByte();
	var a2b = i.readByte();
	var a1a = i.readByte();
	var a1b = i.readByte();
	a.a1 = ((a1a << 8) | a1b);
	a.a2 = ((a2a << 8) | a2b);
	return a;
}
format.tools.Adler32.prototype.a1 = null;
format.tools.Adler32.prototype.a2 = null;
format.tools.Adler32.prototype.equals = function(a) {
	return a.a1 == this.a1 && a.a2 == this.a2;
}
format.tools.Adler32.prototype.update = function(b,pos,len) {
	var a1 = this.a1, a2 = this.a2;
	{
		var _g1 = pos, _g = pos + len;
		while(_g1 < _g) {
			var p = _g1++;
			var c = b.b[p];
			a1 = (a1 + c) % 65521;
			a2 = (a2 + a1) % 65521;
		}
	}
	this.a1 = a1;
	this.a2 = a2;
}
format.tools.Adler32.prototype.__class__ = format.tools.Adler32;
haxe.io.Error = { __ename__ : ["haxe","io","Error"], __constructs__ : ["Blocked","Overflow","OutsideBounds","Custom"] }
haxe.io.Error.Blocked = ["Blocked",0];
haxe.io.Error.Blocked.toString = $estr;
haxe.io.Error.Blocked.__enum__ = haxe.io.Error;
haxe.io.Error.Custom = function(e) { var $x = ["Custom",3,e]; $x.__enum__ = haxe.io.Error; $x.toString = $estr; return $x; }
haxe.io.Error.OutsideBounds = ["OutsideBounds",2];
haxe.io.Error.OutsideBounds.toString = $estr;
haxe.io.Error.OutsideBounds.__enum__ = haxe.io.Error;
haxe.io.Error.Overflow = ["Overflow",1];
haxe.io.Error.Overflow.toString = $estr;
haxe.io.Error.Overflow.__enum__ = haxe.io.Error;
haxe.io.BytesOutput = function(p) { if( p === $_ ) return; {
	this.b = new haxe.io.BytesBuffer();
}}
haxe.io.BytesOutput.__name__ = ["haxe","io","BytesOutput"];
haxe.io.BytesOutput.__super__ = haxe.io.Output;
for(var k in haxe.io.Output.prototype ) haxe.io.BytesOutput.prototype[k] = haxe.io.Output.prototype[k];
haxe.io.BytesOutput.prototype.b = null;
haxe.io.BytesOutput.prototype.getBytes = function() {
	return this.b.getBytes();
}
haxe.io.BytesOutput.prototype.writeByte = function(c) {
	this.b.b.push(c);
}
haxe.io.BytesOutput.prototype.writeBytes = function(buf,pos,len) {
	this.b.addBytes(buf,pos,len);
	return len;
}
haxe.io.BytesOutput.prototype.__class__ = haxe.io.BytesOutput;
haxe.io.Bytes = function(length,b) { if( length === $_ ) return; {
	this.length = length;
	this.b = b;
}}
haxe.io.Bytes.__name__ = ["haxe","io","Bytes"];
haxe.io.Bytes.alloc = function(length) {
	var a = new Array();
	{
		var _g = 0;
		while(_g < length) {
			var i = _g++;
			a.push(0);
		}
	}
	return new haxe.io.Bytes(length,a);
}
haxe.io.Bytes.ofString = function(s) {
	var a = new Array();
	{
		var _g1 = 0, _g = s.length;
		while(_g1 < _g) {
			var i = _g1++;
			var c = s["cca"](i);
			if(c <= 127) a.push(c);
			else if(c <= 2047) {
				a.push(192 | (c >> 6));
				a.push(128 | (c & 63));
			}
			else if(c <= 65535) {
				a.push(224 | (c >> 12));
				a.push(128 | ((c >> 6) & 63));
				a.push(128 | (c & 63));
			}
			else {
				a.push(240 | (c >> 18));
				a.push(128 | ((c >> 12) & 63));
				a.push(128 | ((c >> 6) & 63));
				a.push(128 | (c & 63));
			}
		}
	}
	return new haxe.io.Bytes(a.length,a);
}
haxe.io.Bytes.ofData = function(b) {
	return new haxe.io.Bytes(b.length,b);
}
haxe.io.Bytes.prototype.b = null;
haxe.io.Bytes.prototype.blit = function(pos,src,srcpos,len) {
	if(pos < 0 || srcpos < 0 || len < 0 || pos + len > this.length || srcpos + len > src.length) throw haxe.io.Error.OutsideBounds;
	var b1 = this.b;
	var b2 = src.b;
	if(b1 == b2 && pos > srcpos) {
		var i = len;
		while(i > 0) {
			i--;
			b1[i + pos] = b2[i + srcpos];
		}
		return;
	}
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			b1[i + pos] = b2[i + srcpos];
		}
	}
}
haxe.io.Bytes.prototype.compare = function(other) {
	var b1 = this.b;
	var b2 = other.b;
	var len = ((this.length < other.length)?this.length:other.length);
	{
		var _g = 0;
		while(_g < len) {
			var i = _g++;
			if(b1[i] != b2[i]) return b1[i] - b2[i];
		}
	}
	return this.length - other.length;
}
haxe.io.Bytes.prototype.get = function(pos) {
	return this.b[pos];
}
haxe.io.Bytes.prototype.getData = function() {
	return this.b;
}
haxe.io.Bytes.prototype.length = null;
haxe.io.Bytes.prototype.readString = function(pos,len) {
	if(pos < 0 || len < 0 || pos + len > this.length) throw haxe.io.Error.OutsideBounds;
	var s = "";
	var b = this.b;
	var fcc = $closure(String,"fromCharCode");
	var i = pos;
	var max = pos + len;
	while(i < max) {
		var c = b[i++];
		if(c < 128) {
			if(c == 0) break;
			s += fcc(c);
		}
		else if(c < 224) s += fcc(((c & 63) << 6) | (b[i++] & 127));
		else if(c < 240) {
			var c2 = b[i++];
			s += fcc((((c & 31) << 12) | ((c2 & 127) << 6)) | (b[i++] & 127));
		}
		else {
			var c2 = b[i++];
			var c3 = b[i++];
			s += fcc(((((c & 15) << 18) | ((c2 & 127) << 12)) | ((c3 << 6) & 127)) | (b[i++] & 127));
		}
	}
	return s;
}
haxe.io.Bytes.prototype.set = function(pos,v) {
	this.b[pos] = (v & 255);
}
haxe.io.Bytes.prototype.sub = function(pos,len) {
	if(pos < 0 || len < 0 || pos + len > this.length) throw haxe.io.Error.OutsideBounds;
	return new haxe.io.Bytes(len,this.b.slice(pos,pos + len));
}
haxe.io.Bytes.prototype.toString = function() {
	return this.readString(0,this.length);
}
haxe.io.Bytes.prototype.__class__ = haxe.io.Bytes;
be.haxer.hxswfml.HxGraphix = function(forceShape3) { if( forceShape3 === $_ ) return; {
	if(forceShape3 == null) forceShape3 = false;
	this._xMin = Math.POSITIVE_INFINITY;
	this._yMin = Math.POSITIVE_INFINITY;
	this._xMax = Math.POSITIVE_INFINITY;
	this._yMax = Math.POSITIVE_INFINITY;
	this._boundsInitialized = false;
	this._fillStyles = new Array();
	this._lineStyles = new Array();
	this._shapeRecords = new Array();
	this._stateFillStyle = false;
	this._stateLineStyle = false;
	this._lastX = 0.0;
	this._lastY = 0.0;
	this._shapeType = 4;
	this._forceShape3 = forceShape3;
}}
be.haxer.hxswfml.HxGraphix.__name__ = ["be","haxer","hxswfml","HxGraphix"];
be.haxer.hxswfml.HxGraphix.prototype._boundsInitialized = null;
be.haxer.hxswfml.HxGraphix.prototype._fillStyles = null;
be.haxer.hxswfml.HxGraphix.prototype._forceShape3 = null;
be.haxer.hxswfml.HxGraphix.prototype._lastX = null;
be.haxer.hxswfml.HxGraphix.prototype._lastY = null;
be.haxer.hxswfml.HxGraphix.prototype._lineStyles = null;
be.haxer.hxswfml.HxGraphix.prototype._shapeRecords = null;
be.haxer.hxswfml.HxGraphix.prototype._shapeType = null;
be.haxer.hxswfml.HxGraphix.prototype._stateFillStyle = null;
be.haxer.hxswfml.HxGraphix.prototype._stateLineStyle = null;
be.haxer.hxswfml.HxGraphix.prototype._xMax = null;
be.haxer.hxswfml.HxGraphix.prototype._xMax2 = null;
be.haxer.hxswfml.HxGraphix.prototype._xMin = null;
be.haxer.hxswfml.HxGraphix.prototype._xMin2 = null;
be.haxer.hxswfml.HxGraphix.prototype._yMax = null;
be.haxer.hxswfml.HxGraphix.prototype._yMax2 = null;
be.haxer.hxswfml.HxGraphix.prototype._yMin = null;
be.haxer.hxswfml.HxGraphix.prototype._yMin2 = null;
be.haxer.hxswfml.HxGraphix.prototype.beginBitmapFill = function(bitmapId,x,y,scaleX,scaleY,rotate0,rotate1,repeat,smooth) {
	if(smooth == null) smooth = false;
	if(repeat == null) repeat = false;
	if(rotate1 == null) rotate1 = 0.0;
	if(rotate0 == null) rotate0 = 0.0;
	if(scaleY == null) scaleY = 1.0;
	if(scaleX == null) scaleX = 1.0;
	if(y == null) y = 0;
	if(x == null) x = 0;
	this._stateFillStyle = true;
	var matrix = { scale : { x : this.toFloat5(scaleX) * 20, y : this.toFloat5(scaleY) * 20}, rotate : { rs0 : rotate0, rs1 : rotate1}, translate : { x : Math.round(this.toFloat5(x) * 20), y : Math.round(this.toFloat5(y) * 20)}}
	this._fillStyles.push(format.swf.FillStyle.FSBitmap(bitmapId,matrix,repeat,smooth));
	var _shapeChangeRec = { moveTo : null, fillStyle0 : { idx : this._fillStyles.length}, fillStyle1 : null, lineStyle : (this._stateLineStyle?{ idx : this._lineStyles.length}:null), newStyles : null}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRChange(_shapeChangeRec));
}
be.haxer.hxswfml.HxGraphix.prototype.beginFill = function(color,alpha) {
	if(alpha == null) alpha = 1.0;
	if(color == null) color = 0;
	this._stateFillStyle = true;
	this._fillStyles.push(format.swf.FillStyle.FSSolidAlpha(this.hexToRgba(color,alpha)));
	var _shapeChangeRec = { moveTo : null, fillStyle0 : { idx : this._fillStyles.length}, fillStyle1 : null, lineStyle : (this._stateLineStyle?{ idx : this._lineStyles.length}:null), newStyles : null}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRChange(_shapeChangeRec));
}
be.haxer.hxswfml.HxGraphix.prototype.beginGradientFill = function(type,colors,alphas,ratios,x,y,scaleX,scaleY,rotate0,rotate1) {
	if(rotate1 == null) rotate1 = 0;
	if(rotate0 == null) rotate0 = 0;
	if(type == null) type = "linear";
	this._stateFillStyle = true;
	var data = new Array();
	{
		var _g1 = 0, _g = colors.length;
		while(_g1 < _g) {
			var i = _g1++;
			var pos = Std.parseInt(ratios[i]);
			var color = Std.parseInt(colors[i]);
			var alpha = Std.parseFloat(alphas[i]);
			data.push(format.swf.GradRecord.GRRGBA(pos,this.hexToRgba(color,alpha)));
		}
	}
	var matrix = { scale : { x : scaleX, y : scaleY}, rotate : { rs0 : rotate0, rs1 : rotate1}, translate : { x : Math.round(this.toFloat5(x) * 20), y : Math.round(this.toFloat5(y) * 20)}}
	var gradient = { spread : format.swf.SpreadMode.SMPad, interpolate : format.swf.InterpolationMode.IMNormalRGB, data : data}
	switch(type) {
	case "linear":{
		this._fillStyles.push(format.swf.FillStyle.FSLinearGradient(matrix,gradient));
	}break;
	case "radial":{
		this._fillStyles.push(format.swf.FillStyle.FSRadialGradient(matrix,gradient));
	}break;
	default:{
		throw "Unsupported gradient type";
	}break;
	}
	var _shapeChangeRec = { moveTo : null, fillStyle0 : { idx : this._fillStyles.length}, fillStyle1 : null, lineStyle : (this._stateLineStyle?{ idx : this._lineStyles.length}:null), newStyles : null}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRChange(_shapeChangeRec));
}
be.haxer.hxswfml.HxGraphix.prototype.clear = function() {
	this._shapeRecords = new Array();
}
be.haxer.hxswfml.HxGraphix.prototype.curveTo = function(cx,cy,ax,ay) {
	if(!this._boundsInitialized) this.initBounds(0,0);
	var cx1 = this.toFloat5(cx);
	var cy1 = this.toFloat5(cy);
	var ax1 = this.toFloat5(ax);
	var ay1 = this.toFloat5(ay);
	var dcx = cx1 - this._lastX;
	var dcy = cy1 - this._lastY;
	var dax = ax1 - cx1;
	var day = ay1 - cy1;
	this._lastX = ax1;
	this._lastY = ay1;
	var midLine = (this._lineStyles[this._lineStyles.length - 1] == null?0:this._lineStyles[this._lineStyles.length - 1].width / 40);
	if(ax1 < this._xMin) {
		this._xMin = ax1;
		this._xMin2 = ax1 - midLine;
	}
	if(ax1 > this._xMax) {
		this._xMax = ax1;
		this._xMax2 = ax1 + midLine;
	}
	if(ay1 < this._yMin) {
		this._yMin = ay1;
		this._yMin2 = ay1 - midLine;
	}
	if(ay1 > this._yMax) {
		this._yMax = ay1;
		this._yMax2 = ay1 + midLine;
	}
	if(cx1 < this._xMin) {
		this._xMin = cx1;
		this._xMin2 = cx1 - midLine;
	}
	if(cx1 > this._xMax) {
		this._xMax = cx1;
		this._xMax2 = cx1 + midLine;
	}
	if(cy1 < this._yMin) {
		this._yMin = cy1;
		this._yMin2 = cy1 - midLine;
	}
	if(cy1 > this._yMax) {
		this._yMax = cy1;
		this._yMax2 = cy1 + midLine;
	}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRCurvedEdge(Math.round(dcx * 20),Math.round(dcy * 20),Math.round(dax * 20),Math.round(day * 20)));
}
be.haxer.hxswfml.HxGraphix.prototype.drawCircle = function(x,y,r,sections) {
	if(sections == null) sections = 16;
	if(sections < 3) sections = 3;
	if(sections > 360) sections = 360;
	var span = Math.PI / sections;
	var controlRadius = r / Math.cos(span);
	var anchorAngle = 0.0;
	var controlAngle = 0.0;
	var startPosX = x + Math.cos(anchorAngle) * r;
	var startPosY = y + Math.sin(anchorAngle) * r;
	this.moveTo(startPosX,startPosY);
	{
		var _g = 0;
		while(_g < sections) {
			var i = _g++;
			controlAngle = anchorAngle + span;
			anchorAngle = controlAngle + span;
			var cx = x + Math.cos(controlAngle) * controlRadius;
			var cy = y + Math.sin(controlAngle) * controlRadius;
			var ax = x + Math.cos(anchorAngle) * r;
			var ay = y + Math.sin(anchorAngle) * r;
			this.curveTo(cx,cy,ax,ay);
		}
	}
}
be.haxer.hxswfml.HxGraphix.prototype.drawEllipse = function(x,y,w,h) {
	this.moveTo(x,y + h / 2);
	this.curveTo(x,y,x + w / 2,y);
	this.curveTo(x + w,y,x + w,y + h / 2);
	this.curveTo(x + w,y + h,x + w / 2,y + h);
	this.curveTo(x,y + h,x,y + h / 2);
}
be.haxer.hxswfml.HxGraphix.prototype.drawRect = function(x,y,width,height) {
	this.moveTo(x,y);
	this.lineTo(x + width,y);
	this.lineTo(x + width,y + height);
	this.lineTo(x,y + height);
	this.lineTo(x,y);
}
be.haxer.hxswfml.HxGraphix.prototype.drawRoundRect = function(x,y,w,h,r) {
	this.drawRoundRectComplex(x,y,w,h,r,r,r,r);
}
be.haxer.hxswfml.HxGraphix.prototype.drawRoundRectComplex = function(x,y,w,h,rtl,rtr,rbl,rbr) {
	this.moveTo(rtl + x,y);
	this.lineTo(w - rtr + x,y);
	this.curveTo(w + x,y,w + x,y + rtr);
	this.lineTo(w + x,h - rbr + y);
	this.curveTo(w + x,h + y,w - rbr + x,h + y);
	this.lineTo(rbl + x,h + y);
	this.curveTo(x,h + y,x,h - rbl + y);
	this.lineTo(x,rtl + y);
	this.curveTo(x,y,rtl + x,y);
}
be.haxer.hxswfml.HxGraphix.prototype.endFill = function() {
	this._stateFillStyle = false;
	this.beginFill(0,0);
}
be.haxer.hxswfml.HxGraphix.prototype.endLine = function() {
	this._stateLineStyle = false;
	this.lineStyle(0,0,0);
}
be.haxer.hxswfml.HxGraphix.prototype.getTag = function(id,useWinding,useNonScalingStroke,useScalingStroke) {
	this._shapeRecords.push(format.swf.ShapeRecord.SHREnd);
	if(!this._boundsInitialized) this.initBounds(0,0);
	var _rect = { left : Math.round(this._xMin * 20), right : Math.round(this._xMax * 20), top : Math.round(this._yMin * 20), bottom : Math.round(this._yMax * 20)}
	var _rect2 = { left : Math.round(this._xMin2 * 20), right : Math.round(this._xMax2 * 20), top : Math.round(this._yMin2 * 20), bottom : Math.round(this._yMax2 * 20)}
	var _shapeWithStyleData = { fillStyles : this._fillStyles, lineStyles : this._lineStyles, shapeRecords : this._shapeRecords}
	if(useWinding != null || useNonScalingStroke != null || useScalingStroke != null) this._shapeType = 4;
	if(this._shapeType == 3 || this._forceShape3) {
		return format.swf.SWFTag.TShape(id,format.swf.ShapeData.SHDShape3(_rect,_shapeWithStyleData));
	}
	else {
		useWinding = (useWinding == null?false:useWinding);
		useNonScalingStroke = (useNonScalingStroke == null?false:useNonScalingStroke);
		useScalingStroke = (useScalingStroke == null?false:useScalingStroke);
		return format.swf.SWFTag.TShape(id,format.swf.ShapeData.SHDShape4({ shapeBounds : _rect2, edgeBounds : _rect, useWinding : useWinding, useNonScalingStroke : useNonScalingStroke, useScalingStroke : useScalingStroke, shapes : _shapeWithStyleData}));
	}
}
be.haxer.hxswfml.HxGraphix.prototype.hexToRgba = function(color,alpha) {
	if(alpha < 0) alpha = 0.0;
	if(alpha > 1) alpha = 1.0;
	if(color > 16777215) color = 16777215;
	return { r : (color & 16711680) >> 16, g : (color & 65280) >> 8, b : (color & 255), a : Math.round(alpha * 255)}
}
be.haxer.hxswfml.HxGraphix.prototype.initBounds = function(x,y) {
	var midLine = (this._lineStyles[this._lineStyles.length - 1] == null?0:this._lineStyles[this._lineStyles.length - 1].width / 40);
	if(Math.POSITIVE_INFINITY == this._xMin) this._xMin = x;
	this._xMin2 = x - midLine;
	if(Math.POSITIVE_INFINITY == this._xMax) this._xMax = x;
	this._xMax2 = x + midLine;
	if(Math.POSITIVE_INFINITY == this._yMin) this._yMin = y;
	this._yMin2 = y - midLine;
	if(Math.POSITIVE_INFINITY == this._yMax) this._yMax = y;
	this._yMax2 = y + midLine;
	this._boundsInitialized = true;
}
be.haxer.hxswfml.HxGraphix.prototype.lineStyle = function(width,color,alpha,pixelHinting,scaleMode,caps,joints,miterLimit,noClose) {
	if(miterLimit == null) miterLimit = 255;
	if(alpha == null) alpha = 1.0;
	if(color == null) color = 0;
	if(width == null) width = 1.0;
	this._stateLineStyle = true;
	if(width > 255.0) width = 255.0;
	if(width <= 0.0) width = 0.05;
	if(pixelHinting == null && scaleMode == null && caps == null && noClose == null && this._shapeType == 3 || this._forceShape3) {
		this._lineStyles.push({ width : Math.round(this.toFloat5(width) * 20), data : format.swf.LineStyleData.LSRGBA(this.hexToRgba(color,alpha))});
	}
	else {
		this._lineStyles.push({ width : Math.round(this.toFloat5(width) * 20), data : format.swf.LineStyleData.LS2(this.lineStyle2(color,alpha,pixelHinting,scaleMode,caps,joints,miterLimit,noClose))});
	}
	var _shapeChangeRec = { moveTo : null, fillStyle0 : (this._stateFillStyle?{ idx : this._fillStyles.length}:null), fillStyle1 : null, lineStyle : { idx : this._lineStyles.length}, newStyles : null}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRChange(_shapeChangeRec));
}
be.haxer.hxswfml.HxGraphix.prototype.lineStyle2 = function(color,alpha,pixelHinting,scaleMode,caps,joints,miterLimit,noClose) {
	if(miterLimit == null) miterLimit = 255;
	if(alpha == null) alpha = 1.0;
	if(color == null) color = 0;
	this._shapeType = 4;
	var pixelHinting1 = (pixelHinting == null?false:pixelHinting);
	var scaleMode1 = (scaleMode == null?"":scaleMode.toLowerCase());
	var caps1 = (caps == null?"":caps.toLowerCase());
	var joints1 = (joints == null?"":joints.toLowerCase());
	var cap = (caps1 == "none"?format.swf.LineCapStyle.LCNone:(caps1 == "round"?format.swf.LineCapStyle.LCRound:(caps1 == "square"?format.swf.LineCapStyle.LCSquare:format.swf.LineCapStyle.LCRound)));
	return { startCap : cap, join : (joints1 == "round"?format.swf.LineJoinStyle.LJRound:(joints1 == "bevel"?format.swf.LineJoinStyle.LJBevel:(joints1 == "miter"?format.swf.LineJoinStyle.LJMiter(miterLimit):format.swf.LineJoinStyle.LJRound))), fill : format.swf.LS2Fill.LS2FColor(this.hexToRgba(color,alpha)), noHScale : (scaleMode1 == "none" || scaleMode1 == "horizontal"?true:false), noVScale : (scaleMode1 == "none" || scaleMode1 == "vertical"?true:false), pixelHinting : pixelHinting1, noClose : noClose, endCap : cap}
}
be.haxer.hxswfml.HxGraphix.prototype.lineTo = function(x,y) {
	if(!this._boundsInitialized) this.initBounds(0,0);
	var x1 = this.toFloat5(x);
	var y1 = this.toFloat5(y);
	var dx = x1 - this._lastX;
	var dy = y1 - this._lastY;
	if(dx == 0 && dy == 0) return;
	this._lastX = x1;
	this._lastY = y1;
	var midLine = (this._lineStyles[this._lineStyles.length - 1] == null?0:this._lineStyles[this._lineStyles.length - 1].width / 40);
	if(x1 < this._xMin) {
		this._xMin = x1;
		this._xMin2 = x1 - midLine;
	}
	if(x1 > this._xMax) {
		this._xMax = x1;
		this._xMax2 = x1 + midLine;
	}
	if(y1 < this._yMin) {
		this._yMin = y1;
		this._yMin2 = y1 - midLine;
	}
	if(y1 > this._yMax) {
		this._yMax = y1;
		this._yMax2 = y1 + midLine;
	}
	this._shapeRecords.push(format.swf.ShapeRecord.SHREdge(Math.round(dx * 20),Math.round(dy * 20)));
}
be.haxer.hxswfml.HxGraphix.prototype.moveTo = function(x,y) {
	var x1 = this.toFloat5(x);
	var y1 = this.toFloat5(y);
	if(!this._boundsInitialized) this.initBounds(x1,y1);
	if(x1 == this._lastX && y1 == this._lastY) return;
	this._lastX = x1;
	this._lastY = y1;
	var midLine = (this._lineStyles[this._lineStyles.length - 1] == null?0:this._lineStyles[this._lineStyles.length - 1].width / 40);
	if(x1 < this._xMin) {
		this._xMin = x1;
		this._xMin2 = x1 - midLine;
	}
	if(x1 > this._xMax) {
		this._xMax = x1;
		this._xMax2 = x1 + midLine;
	}
	if(y1 < this._yMin) {
		this._yMin = y1;
		this._yMin2 = y1 - midLine;
	}
	if(y1 > this._yMax) {
		this._yMax = y1;
		this._yMax2 = y1 + midLine;
	}
	var _shapeChangeRec = { moveTo : { dx : Math.round(x1 * 20), dy : Math.round(y1 * 20)}, fillStyle0 : (this._stateFillStyle?{ idx : this._fillStyles.length}:null), fillStyle1 : null, lineStyle : (this._stateLineStyle?{ idx : this._lineStyles.length}:null), newStyles : null}
	this._shapeRecords.push(format.swf.ShapeRecord.SHRChange(_shapeChangeRec));
}
be.haxer.hxswfml.HxGraphix.prototype.toFloat5 = function($float) {
	var temp1 = Math.round($float * 1000);
	var diff = temp1 % 50;
	var temp2 = (diff < 25?temp1 - diff:temp1 + (50 - diff));
	var temp3 = temp2 / 1000;
	return temp3;
}
be.haxer.hxswfml.HxGraphix.prototype.__class__ = be.haxer.hxswfml.HxGraphix;
haxe.Int32 = function() { }
haxe.Int32.__name__ = ["haxe","Int32"];
haxe.Int32.make = function(a,b) {
	return (a << 16) | b;
}
haxe.Int32.ofInt = function(x) {
	return x;
}
haxe.Int32.toInt = function(x) {
	if((((x) >> 30) & 1) != ((x) >>> 31)) throw "Overflow " + x;
	return (x) & -1;
}
haxe.Int32.toNativeInt = function(x) {
	return x;
}
haxe.Int32.add = function(a,b) {
	return (a) + (b);
}
haxe.Int32.sub = function(a,b) {
	return (a) - (b);
}
haxe.Int32.mul = function(a,b) {
	return (a) * (b);
}
haxe.Int32.div = function(a,b) {
	return Std["int"]((a) / (b));
}
haxe.Int32.mod = function(a,b) {
	return (a) % (b);
}
haxe.Int32.shl = function(a,b) {
	return (a) << b;
}
haxe.Int32.shr = function(a,b) {
	return (a) >> b;
}
haxe.Int32.ushr = function(a,b) {
	return (a) >>> b;
}
haxe.Int32.and = function(a,b) {
	return (a) & (b);
}
haxe.Int32.or = function(a,b) {
	return (a) | (b);
}
haxe.Int32.xor = function(a,b) {
	return (a) ^ (b);
}
haxe.Int32.neg = function(a) {
	return -(a);
}
haxe.Int32.complement = function(a) {
	return ~(a);
}
haxe.Int32.compare = function(a,b) {
	return a - b;
}
haxe.Int32.prototype.__class__ = haxe.Int32;
js.Lib = function() { }
js.Lib.__name__ = ["js","Lib"];
js.Lib.isIE = null;
js.Lib.isOpera = null;
js.Lib.document = null;
js.Lib.window = null;
js.Lib.alert = function(v) {
	alert(js.Boot.__string_rec(v,""));
}
js.Lib.eval = function(code) {
	return eval(code);
}
js.Lib.setErrorHandler = function(f) {
	js.Lib.onerror = f;
}
js.Lib.prototype.__class__ = js.Lib;
format.tools.BitsOutput = function(o) { if( o === $_ ) return; {
	this.o = o;
	this.nbits = 0;
	this.bits = 0;
}}
format.tools.BitsOutput.__name__ = ["format","tools","BitsOutput"];
format.tools.BitsOutput.prototype.bits = null;
format.tools.BitsOutput.prototype.flush = function() {
	if(this.nbits > 0) {
		this.writeBits(8 - this.nbits,0);
		this.nbits = 0;
	}
}
format.tools.BitsOutput.prototype.nbits = null;
format.tools.BitsOutput.prototype.o = null;
format.tools.BitsOutput.prototype.writeBit = function(flag) {
	this.bits <<= 1;
	if(flag) this.bits |= 1;
	this.nbits++;
	if(this.nbits == 8) {
		this.nbits = 0;
		this.o.writeByte(this.bits & 255);
	}
}
format.tools.BitsOutput.prototype.writeBits = function(n,v) {
	v = (v & ((1 << n) - 1));
	if(n + this.nbits >= 32) {
		if(n >= 31) throw "Bits error";
		var n2 = 32 - this.nbits - 1;
		var n3 = n - n2;
		this.writeBits(n2,v >>> n3);
		this.writeBits(n3,v & ((1 << n3) - 1));
		return;
	}
	if(n < 0) throw "Bits error";
	this.bits = ((this.bits << n) | v);
	this.nbits += n;
	while(this.nbits >= 8) {
		this.nbits -= 8;
		this.o.writeByte((this.bits >>> this.nbits) & 255);
	}
}
format.tools.BitsOutput.prototype.__class__ = format.tools.BitsOutput;
StringTools = function() { }
StringTools.__name__ = ["StringTools"];
StringTools.urlEncode = function(s) {
	return encodeURIComponent(s);
}
StringTools.urlDecode = function(s) {
	return decodeURIComponent(s.split("+").join(" "));
}
StringTools.htmlEscape = function(s) {
	return s.split("&").join("&amp;").split("<").join("&lt;").split(">").join("&gt;");
}
StringTools.htmlUnescape = function(s) {
	return s.split("&gt;").join(">").split("&lt;").join("<").split("&amp;").join("&");
}
StringTools.startsWith = function(s,start) {
	return (s.length >= start.length && s.substr(0,start.length) == start);
}
StringTools.endsWith = function(s,end) {
	var elen = end.length;
	var slen = s.length;
	return (slen >= elen && s.substr(slen - elen,elen) == end);
}
StringTools.isSpace = function(s,pos) {
	var c = s.charCodeAt(pos);
	return (c >= 9 && c <= 13) || c == 32;
}
StringTools.ltrim = function(s) {
	var l = s.length;
	var r = 0;
	while(r < l && StringTools.isSpace(s,r)) {
		r++;
	}
	if(r > 0) return s.substr(r,l - r);
	else return s;
}
StringTools.rtrim = function(s) {
	var l = s.length;
	var r = 0;
	while(r < l && StringTools.isSpace(s,l - r - 1)) {
		r++;
	}
	if(r > 0) {
		return s.substr(0,l - r);
	}
	else {
		return s;
	}
}
StringTools.trim = function(s) {
	return StringTools.ltrim(StringTools.rtrim(s));
}
StringTools.rpad = function(s,c,l) {
	var sl = s.length;
	var cl = c.length;
	while(sl < l) {
		if(l - sl < cl) {
			s += c.substr(0,l - sl);
			sl = l;
		}
		else {
			s += c;
			sl += cl;
		}
	}
	return s;
}
StringTools.lpad = function(s,c,l) {
	var ns = "";
	var sl = s.length;
	if(sl >= l) return s;
	var cl = c.length;
	while(sl < l) {
		if(l - sl < cl) {
			ns += c.substr(0,l - sl);
			sl = l;
		}
		else {
			ns += c;
			sl += cl;
		}
	}
	return ns + s;
}
StringTools.replace = function(s,sub,by) {
	return s.split(sub).join(by);
}
StringTools.hex = function(n,digits) {
	var neg = false;
	if(n < 0) {
		neg = true;
		n = -n;
	}
	var s = n.toString(16);
	s = s.toUpperCase();
	if(digits != null) while(s.length < digits) s = "0" + s;
	if(neg) s = "-" + s;
	return s;
}
StringTools.prototype.__class__ = StringTools;
$_ = {}
js.Boot.__res = {}
js.Boot.__init();
{
	Math.NaN = Number["NaN"];
	Math.NEGATIVE_INFINITY = Number["NEGATIVE_INFINITY"];
	Math.POSITIVE_INFINITY = Number["POSITIVE_INFINITY"];
	Math.isFinite = function(i) {
		return isFinite(i);
	}
	Math.isNaN = function(i) {
		return isNaN(i);
	}
	Math.__name__ = ["Math"];
}
{
	Xml = js.JsXml__;
	Xml.__name__ = ["Xml"];
	Xml.Element = "element";
	Xml.PCData = "pcdata";
	Xml.CData = "cdata";
	Xml.Comment = "comment";
	Xml.DocType = "doctype";
	Xml.Prolog = "prolog";
	Xml.Document = "document";
}
{
	String.prototype.__class__ = String;
	String.__name__ = ["String"];
	Array.prototype.__class__ = Array;
	Array.__name__ = ["Array"];
	Int = { __name__ : ["Int"]}
	Dynamic = { __name__ : ["Dynamic"]}
	Float = Number;
	Float.__name__ = ["Float"];
	Bool = { __ename__ : ["Bool"]}
	Class = { __name__ : ["Class"]}
	Enum = { }
	Void = { __ename__ : ["Void"]}
}
{
	js.Lib.document = document;
	js.Lib.window = window;
	onerror = function(msg,url,line) {
		var f = js.Lib.onerror;
		if( f == null )
			return false;
		return f(msg,[url+":"+line]);
	}
}
{
	Date.now = function() {
		return new Date();
	}
	Date.fromTime = function(t) {
		var d = new Date();
		d["setTime"](t);
		return d;
	}
	Date.fromString = function(s) {
		switch(s.length) {
		case 8:{
			var k = s.split(":");
			var d = new Date();
			d["setTime"](0);
			d["setUTCHours"](k[0]);
			d["setUTCMinutes"](k[1]);
			d["setUTCSeconds"](k[2]);
			return d;
		}break;
		case 10:{
			var k = s.split("-");
			return new Date(k[0],k[1] - 1,k[2],0,0,0);
		}break;
		case 19:{
			var k = s.split(" ");
			var y = k[0].split("-");
			var t = k[1].split(":");
			return new Date(y[0],y[1] - 1,y[2],t[0],t[1],t[2]);
		}break;
		default:{
			throw "Invalid date format : " + s;
		}break;
		}
	}
	Date.prototype["toString"] = function() {
		var date = this;
		var m = date.getMonth() + 1;
		var d = date.getDate();
		var h = date.getHours();
		var mi = date.getMinutes();
		var s = date.getSeconds();
		return date.getFullYear() + "-" + ((m < 10?"0" + m:"" + m)) + "-" + ((d < 10?"0" + d:"" + d)) + " " + ((h < 10?"0" + h:"" + h)) + ":" + ((mi < 10?"0" + mi:"" + mi)) + ":" + ((s < 10?"0" + s:"" + s));
	}
	Date.prototype.__class__ = Date;
	Date.__name__ = ["Date"];
}
format.swf.TagId.End = 0;
format.swf.TagId.ShowFrame = 1;
format.swf.TagId.DefineShape = 2;
format.swf.TagId.PlaceObject = 4;
format.swf.TagId.RemoveObject = 5;
format.swf.TagId.DefineBits = 6;
format.swf.TagId.DefineButton = 7;
format.swf.TagId.JPEGTables = 8;
format.swf.TagId.SetBackgroundColor = 9;
format.swf.TagId.DefineFont = 10;
format.swf.TagId.DefineText = 11;
format.swf.TagId.DoAction = 12;
format.swf.TagId.DefineFontInfo = 13;
format.swf.TagId.DefineSound = 14;
format.swf.TagId.StartSound = 15;
format.swf.TagId.DefineButtonSound = 17;
format.swf.TagId.SoundStreamHead = 18;
format.swf.TagId.SoundStreamBlock = 19;
format.swf.TagId.DefineBitsLossless = 20;
format.swf.TagId.DefineBitsJPEG2 = 21;
format.swf.TagId.DefineShape2 = 22;
format.swf.TagId.DefineButtonCxform = 23;
format.swf.TagId.Protect = 24;
format.swf.TagId.PlaceObject2 = 26;
format.swf.TagId.RemoveObject2 = 28;
format.swf.TagId.DefineShape3 = 32;
format.swf.TagId.DefineText2 = 33;
format.swf.TagId.DefineButton2 = 34;
format.swf.TagId.DefineBitsJPEG3 = 35;
format.swf.TagId.DefineBitsLossless2 = 36;
format.swf.TagId.DefineEditText = 37;
format.swf.TagId.DefineSprite = 39;
format.swf.TagId.FrameLabel = 43;
format.swf.TagId.SoundStreamHead2 = 45;
format.swf.TagId.DefineMorphShape = 46;
format.swf.TagId.DefineFont2 = 48;
format.swf.TagId.ExportAssets = 56;
format.swf.TagId.ImportAssets = 57;
format.swf.TagId.EnableDebugger = 58;
format.swf.TagId.DoInitAction = 59;
format.swf.TagId.DefineVideoStream = 60;
format.swf.TagId.VideoFrame = 61;
format.swf.TagId.DefineFontInfo2 = 62;
format.swf.TagId.EnableDebugger2 = 64;
format.swf.TagId.ScriptLimits = 65;
format.swf.TagId.SetTabIndex = 66;
format.swf.TagId.FileAttributes = 69;
format.swf.TagId.PlaceObject3 = 70;
format.swf.TagId.ImportAssets2 = 71;
format.swf.TagId.RawABC = 72;
format.swf.TagId.DefineFontAlignZones = 73;
format.swf.TagId.CSMTextSettings = 74;
format.swf.TagId.DefineFont3 = 75;
format.swf.TagId.SymbolClass = 76;
format.swf.TagId.Metadata = 77;
format.swf.TagId.DefineScalingGrid = 78;
format.swf.TagId.DoABC = 82;
format.swf.TagId.DefineShape4 = 83;
format.swf.TagId.DefineMorphShape2 = 84;
format.swf.TagId.DefineSceneAndFrameLabelData = 86;
format.swf.TagId.DefineBinaryData = 87;
format.swf.TagId.DefineFontName = 88;
format.swf.TagId.StartSound2 = 89;
format.swf.TagId.DefineBitsJPEG4 = 90;
format.swf.TagId.DefineFont4 = 91;
format.swf.FillStyleTypeId.Solid = 0;
format.swf.FillStyleTypeId.LinearGradient = 16;
format.swf.FillStyleTypeId.RadialGradient = 18;
format.swf.FillStyleTypeId.FocalRadialGradient = 19;
format.swf.FillStyleTypeId.RepeatingBitmap = 64;
format.swf.FillStyleTypeId.ClippedBitmap = 65;
format.swf.FillStyleTypeId.NonSmoothedRepeatingBitmap = 66;
format.swf.FillStyleTypeId.NonSmoothedClippedBitmap = 67;
format.tools._InflateImpl.Window.SIZE = 32768;
format.tools._InflateImpl.Window.BUFSIZE = 65536;
format.tools.InflateImpl.LEN_EXTRA_BITS_TBL = [0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0,-1,-1];
format.tools.InflateImpl.LEN_BASE_VAL_TBL = [3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,115,131,163,195,227,258];
format.tools.InflateImpl.DIST_EXTRA_BITS_TBL = [0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13,-1,-1];
format.tools.InflateImpl.DIST_BASE_VAL_TBL = [1,2,3,4,5,7,9,13,17,25,33,49,65,97,129,193,257,385,513,769,1025,1537,2049,3073,4097,6145,8193,12289,16385,24577];
format.tools.InflateImpl.CODE_LENGTHS_POS = [16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15];
format.tools.InflateImpl.FIXED_HUFFMAN = null;
format.abc.OpReader.bytePos = 0;
format.mp3.MPEG.V1 = 3;
format.mp3.MPEG.V2 = 2;
format.mp3.MPEG.V25 = 0;
format.mp3.MPEG.Reserved = 1;
format.mp3.MPEG.V1_Bitrates = [[format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_40,format.mp3.Bitrate.BR_48,format.mp3.Bitrate.BR_56,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_80,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_112,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_192,format.mp3.Bitrate.BR_224,format.mp3.Bitrate.BR_256,format.mp3.Bitrate.BR_320,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_48,format.mp3.Bitrate.BR_56,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_80,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_112,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_192,format.mp3.Bitrate.BR_224,format.mp3.Bitrate.BR_256,format.mp3.Bitrate.BR_320,format.mp3.Bitrate.BR_384,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_192,format.mp3.Bitrate.BR_224,format.mp3.Bitrate.BR_256,format.mp3.Bitrate.BR_288,format.mp3.Bitrate.BR_320,format.mp3.Bitrate.BR_352,format.mp3.Bitrate.BR_384,format.mp3.Bitrate.BR_416,format.mp3.Bitrate.BR_448,format.mp3.Bitrate.BR_Bad]];
format.mp3.MPEG.V2_Bitrates = [[format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_8,format.mp3.Bitrate.BR_16,format.mp3.Bitrate.BR_24,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_40,format.mp3.Bitrate.BR_48,format.mp3.Bitrate.BR_56,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_80,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_112,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_144,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_8,format.mp3.Bitrate.BR_16,format.mp3.Bitrate.BR_24,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_40,format.mp3.Bitrate.BR_48,format.mp3.Bitrate.BR_56,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_80,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_112,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_144,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_Bad],[format.mp3.Bitrate.BR_Free,format.mp3.Bitrate.BR_32,format.mp3.Bitrate.BR_48,format.mp3.Bitrate.BR_56,format.mp3.Bitrate.BR_64,format.mp3.Bitrate.BR_80,format.mp3.Bitrate.BR_96,format.mp3.Bitrate.BR_112,format.mp3.Bitrate.BR_128,format.mp3.Bitrate.BR_144,format.mp3.Bitrate.BR_160,format.mp3.Bitrate.BR_176,format.mp3.Bitrate.BR_192,format.mp3.Bitrate.BR_224,format.mp3.Bitrate.BR_256,format.mp3.Bitrate.BR_Bad]];
format.mp3.MPEG.SamplingRates = [[format.mp3.SamplingRate.SR_11025,format.mp3.SamplingRate.SR_12000,format.mp3.SamplingRate.SR_8000,format.mp3.SamplingRate.SR_Bad],[format.mp3.SamplingRate.SR_Bad,format.mp3.SamplingRate.SR_Bad,format.mp3.SamplingRate.SR_Bad,format.mp3.SamplingRate.SR_Bad],[format.mp3.SamplingRate.SR_22050,format.mp3.SamplingRate.SR_24000,format.mp3.SamplingRate.SR_12000,format.mp3.SamplingRate.SR_Bad],[format.mp3.SamplingRate.SR_44100,format.mp3.SamplingRate.SR_48000,format.mp3.SamplingRate.SR_32000,format.mp3.SamplingRate.SR_Bad]];
format.mp3.CLayer.LReserved = 0;
format.mp3.CLayer.LLayer3 = 1;
format.mp3.CLayer.LLayer2 = 2;
format.mp3.CLayer.LLayer1 = 3;
format.mp3.CChannelMode.CStereo = 0;
format.mp3.CChannelMode.CJointStereo = 1;
format.mp3.CChannelMode.CDualChannel = 2;
format.mp3.CChannelMode.CMono = 3;
format.mp3.CEmphasis.ENone = 0;
format.mp3.CEmphasis.EMs50_15 = 1;
format.mp3.CEmphasis.EReserved = 2;
format.mp3.CEmphasis.ECCIT_J17 = 3;
js.JsXml__.enode = new EReg("^<([a-zA-Z0-9:_-]+)","");
js.JsXml__.ecdata = new EReg("^<!\\[CDATA\\[","i");
js.JsXml__.edoctype = new EReg("^<!DOCTYPE","i");
js.JsXml__.eend = new EReg("^</([a-zA-Z0-9:_-]+)>","");
js.JsXml__.epcdata = new EReg("^[^<]+","");
js.JsXml__.ecomment = new EReg("^<!--","");
js.JsXml__.eprolog = new EReg("^<\\?[^\\?]+\\?>","");
js.JsXml__.eattribute = new EReg("^\\s*([a-zA-Z0-9:_-]+)\\s*=\\s*([\"'])([^\\2]*?)\\2","");
js.JsXml__.eclose = new EReg("^[ \\r\\n\\t]*(>|(/>))","");
js.JsXml__.ecdata_end = new EReg("\\]\\]>","");
js.JsXml__.edoctype_elt = new EReg("[\\[|\\]>]","");
js.JsXml__.ecomment_end = new EReg("-->","");
format.mp3.Writer.WRITE_ID3V2 = true;
format.mp3.Writer.DONT_WRITE_ID3V2 = false;
format.tools.CRC32.POLYNOM = -306674912;
format.zip.Writer.CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE = 46;
format.zip.Writer.LOCAL_FILE_HEADER_FIELDS_SIZE = 30;
js.Lib.onerror = null;
