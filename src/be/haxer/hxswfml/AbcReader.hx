package be.haxer.hxswfml;
import format.swf.Data;
import format.abc.Data;
import haxe.io.BytesInput;

#if php
import php.io.File;
import php.FileSystem;
#elseif neko
import neko.io.File;
import neko.FileSystem;
#elseif cpp
import cpp.Lib;
import cpp.io.File;
import cpp.FileSystem;
#elseif flash
import flash.display.MovieClip;
#end
/**
 * ...
 * @author Jan J. Flanders
 */
class AbcReader
{
	var abcFile:ABCData;
	var xml:String ;
	var indentLevel:Int;
	var functionClosures:Array<String>;
	var functionClosuresBodies:Array<Dynamic>;
	var className:String;
	public var sourceInfo:Bool;
	public var debugInfo:Bool;
	var jumpInfo:Bool;
	var debugLines:Array<String>;
	var debugFile:String;
	var debugFileName:String;
	var lastJump:String;
	var lastLabel:String;
	var abcReader_import:AbcReader;
	var functionParseIndex:Int;
	var currentFunctionName:String;
	var abcId:Int;

	public function new ()
	{
		#if (swc || air)
		Xml.parse("");//for swc
		new flash.Boot(new MovieClip());//for swc
		#end
		debugFile = "";
		sourceInfo = false;
		debugInfo = false;
		jumpInfo = false;
		functionParseIndex = 0;
		abcId = 0;
	}
	public function abc2xml(fileName:String, _swf=null):String
	{
		var lastStamp = Date.now().getTime();
		var xml_out = '<abcfiles>\n';
		if (StringTools.endsWith(fileName, '.abc'))
		{
			xml_out+= abcToXml(getBytes(fileName, _swf), null);
		}
		else if (StringTools.endsWith(fileName, '.swf'))
		{
			var swf = getBytes(fileName, _swf);
			var swfBytesInput = new BytesInput(swf);
			var swfReader = new format.swf.Reader(swfBytesInput);
			var header = swfReader.readHeader();
			var tags : Array<SWFTag> = swfReader.readTagList();
			swfBytesInput.close();
			var index=0;
			for (tag in tags)
			{
				switch (tag)
				{
					case TActionScript3(data, ctx):
						xml_out+= abcToXml(data, ctx);
					default:
				}
			}
		}
		trace('total time = ' + (Date.now().getTime() - lastStamp));
		return xml_out+'</abcfiles>';
	}
	private function getBytes(fileName:String, swf=null)
	{
		#if (flash || js)
		return haxe.io.Bytes.ofData(swf);
		#else
		 return File.getBytes(fileName);
		#end
	}
	private function abcToXml(data, infos):String
	{
		var abcReader = new format.abc.Reader(new haxe.io.BytesInput(data));
		abcFile = abcReader.read();
		functionClosures = new Array();
		functionClosuresBodies = new Array();
		indentLevel = 1;
		var name:String=infos!=null?infos.label:"abc-file_" + Std.string(abcId++);
		xml = indent() + '<abcfile name="' + name+ '">\n';
		indentLevel++;
		var hasMethodBody:Bool = false;
		for ( _class in abcFile.classes)
		{
			var clName = getName(_class.name);
			className = clName;
			
			var _extends = getName(_class.superclass);
			var _implements = _class.interfaces;
			var __implements:String = '';
			for (i in _implements)
			{
				__implements += getName(i) + ',';
			}
			var _ns = getNamespace(_class._namespace);
			var _sealed = _class.isSealed;
			var _final = _class.isFinal;
			var _interface = _class.isInterface;
			//find init of this class/script
			var script_init = null;
			for (i in abcFile.inits)
			{
				for (field in i.fields)
				{
					switch(field.kind)
					{
						case FClass(c):
							if ((_class == abcFile.classes[Type.enumParameters(c)[0]]))
							{
								script_init = getMethod(i.method);
								break;
							}
						default:
					}					
				}
			}
			if (script_init != null)
			{
				var stargsStr = '';
				for (a in script_init.args)
					stargsStr += getName(a) + ',';
				var ret = getName(script_init.ret);
				xml += indent() + '<init name="' + clName + '"';
				if(stargsStr!="")
					xml += ' args="' + cutComma(stargsStr) + '"';
				xml += ' return="' + ret + '"';
				xml += parseMethodExtra(script_init.extra);
				currentFunctionName = clName;
				for (f in abcFile.functions)
				{
					if (getMethod(f.type) == script_init)//if (Type.enumEq(getMethod(f.type), script_init))
					{
						if (f.locals.length != 0)
							xml += ' locals="' + parseLocals(f.locals)+'"';
						xml+=' >';
						xml+= '<!-- maxStack="' + f.maxStack + '"';
						xml+= ' nRegs="' + f.nRegs + '"';
						xml+= ' initScope="' + f.initScope + '"';
						xml+= ' maxScope="' + f.maxScope + '" -->';
						xml+= '\n';
						xml += decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
						xml += indent() + '</init>\n';
						break;
					}
				}
			}
			xml += indent() + '<class name="' + clName + '"';

			if(_extends!=null && _extends!="")	
				xml += ' extends="' + _extends + '"';
			if(__implements!="")	
				xml += ' implements="' + cutComma(__implements) + '"';
			//if(_ns!=null && _ns!="")
				//xml += ' ns="' + _ns + '"';
			if(_sealed)
				xml += ' sealed="true"';
			if(_final)
				xml += ' final="true"';
			if(_interface)
				xml += ' interface="true"';
			xml+='>\n';
			//-------------------------------------------------------------
			// instance vars
			indentLevel++;
			for (field in _class.fields)
			{
				switch(field.kind) 
				{
					case FVar(type, value, _const):
						var _type = getName(type);
						var _value = getValue(value);
						var __const = _const;
						xml += indent() + '<var name="' +getFieldName(field.name) + '"' ;
						if(_type!=null && _type!="*" && _type!="")
							xml += ' type="' + _type + '"';
						if(_value !="")
							xml += ' value="' + _value + '"';
						if(__const)
							xml += ' const="' + 'true' + '"';
						xml += '/>\n';
					default:
				}
			}
			//-------------------------------------------------------------
			// static vars
			for (field in _class.staticFields)
			{
				switch(field.kind) 
				{
					case FVar(type, value, _const):
						var _type = getName(type);
						var _value = getValue(value);
						var __const = _const;
						xml += indent() + '<var name="' +getFieldName(field.name) + '"' ;
						if(_type!=null && _type!="*" && _type!="")
							xml += ' type="' + _type + '"';
						if(_value !="")
							xml += ' value="' + _value + '"';
						if(__const)
							xml += ' const="' + 'true' + '"';
						xml += ' static="true"';
						xml += '/>\n';
					default:
				}
			}
			//-------------------------------------------------------------
			// instance constructor
			var cst = getMethod(_class.constructor);
			var cargsStr = '';
			for (a in cst.args)
				cargsStr += getName(a) + ',';
			var returnType = getName(cst.ret);
			//}
			xml += indent() + '<function name="' + clName + '"';
			xml += ' args="' + cutComma(cargsStr) + '"';
			xml += ' return="' + returnType + '"';
			xml += parseMethodExtra(cst.extra);
			currentFunctionName = clName;
			for (f in abcFile.functions)
			{
				if (Type.enumEq(f.type, _class.constructor))//if (f.type==_class.constructor)//
				{
					if (f.locals.length != 0)
						xml += ' locals="' + parseLocals(f.locals)+'"';
					xml+=' >';
					xml+= '<!-- maxStack="' + f.maxStack + '"';
					xml+= ' nRegs="' + f.nRegs + '"';
					xml+= ' initScope="' + f.initScope + '"';
					xml+= ' maxScope="' + f.maxScope + '" -->';
					xml+= '\n';
					xml+=decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
					break;
				}
			}
			if (_interface)
			{
				xml += ' >\n' + indent() +'</function>\n\n';
			}
			else
			{
				xml += indent() + '</function>\n\n';
			}
			//-------------------------------------------------------------
			// static constructor
			var st = getMethod(_class.statics);
			var stargsStr = '';
			for (a in st.args)
				stargsStr += getName(a) + ',';
			var ret = getName(st.ret);
			xml += indent() + '<function name="' + getName(_class.name) + '"';
			xml += ' static="true"';
			if(stargsStr!="")
				xml += ' args="' + cutComma(stargsStr) + '"';
			xml += ' return="' + ret + '"';
			xml += parseMethodExtra(st.extra);
			currentFunctionName = clName;
			for (f in abcFile.functions)
			{
				if (getMethod(f.type)==st)//if (Type.enumEq(getMethod(f.type), st))
				{
					if (f.locals.length != 0)
						xml += ' locals="' + parseLocals(f.locals)+'"';				
					xml+=' >';
					xml+= '<!-- maxStack="' + f.maxStack + '"';
					xml+= ' nRegs="' + f.nRegs + '"';
					xml+= ' initScope="' + f.initScope + '"';
					xml+= ' maxScope="' + f.maxScope + '" -->';
					xml+= '\n';
					xml+=decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
					break;
				}
			}
			xml += indent() + '</function>\n\n';
			//-------------------------------------------------------------
			// instance methods
			for (field in _class.fields)
			{
				switch(field.kind) 
				{
					case FMethod(methodType, k, isFinal, isOverride):
						var _m = getMethod(methodType);
						var _args = '';
						for (a in _m.args)
							_args += getName(a) + ',';
						var _ret = getName(_m.ret);
						var _k = switch(k) { case KNormal:'normal'; case KSetter:'setter'; case KGetter:'getter';};
						var _name = getFieldName(field.name);
						xml += indent() + '<function name="' + _name + '"';
						if(isOverride)
							xml += ' override="'+isOverride+'"';
						if(isFinal)
							xml += ' final="'+'true'+'"';
						if (_k != 'normal')
							xml += ' kind="' + _k + '"';
						xml += ' args="' + cutComma(_args) +'"';
						xml += ' return="' + _ret +'"';
						xml += parseMethodExtra(_m.extra);
						hasMethodBody = false;
						currentFunctionName = _name;
						for (f in abcFile.functions)
						{
							if (Type.enumEq(f.type, methodType))//if (f.type==methodType)
							{
								hasMethodBody = true;
								if (f.locals.length != 0)
									xml += ' locals="' + parseLocals(f.locals)+'"';
								xml+=' >';
								xml+= '<!-- maxStack="' + f.maxStack + '"';
								xml+= ' nRegs="' + f.nRegs + '"';
								xml+= ' initScope="' + f.initScope + '"';
								xml+= ' maxScope="' + f.maxScope + '" -->';
								xml+= '\n';
								xml+= decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
								break;
							}
						}
						if (!hasMethodBody)
							xml += ' >\n';
						xml += indent() +'</function>\n\n';
					default:
				}
			}
			//-------------------------------------------------------------
			// static methods
			for (field in _class.staticFields)
			{
				switch(field.kind) 
				{
					case FMethod(type, k, isFinal, isOverride):
					
						var _m = getMethod(type);
						var _args = '';
						for (a in _m.args)
							_args += getName(a) + ',';
						var _ret = getName(_m.ret);
						var _k = switch(k) { case KNormal:'normal'; case KSetter:'setter'; case KGetter:'getter';};
						var _name = getFieldName(field.name);
						xml += indent() + '<function name="' + _name +'"';
						xml += ' static="true"';
						if(isOverride)
							xml += ' override="'+isOverride+'"';
						if(isFinal)
							xml += ' final="'+'true'+'"';
						if (_k != 'normal')
							xml += ' kind="' + _k + '"';
						xml += ' args="' + cutComma(_args) +'"';
						xml += ' return="' + _ret +'"';
						xml += parseMethodExtra(_m.extra);
						hasMethodBody = false;
						currentFunctionName = _name;
						for (f in abcFile.functions)
						{
							if (Type.enumEq(f.type, type))
							{
								hasMethodBody = true;
								if (f.locals.length != 0)
									xml += ' locals="' + parseLocals(f.locals)+'"';
								xml+=' >';
								xml+= '<!-- maxStack="' + f.maxStack + '"';
								xml+= ' nRegs="' + f.nRegs + '"';
								xml+= ' initScope="' + f.initScope + '"';
								xml+= ' maxScope="' + f.maxScope + '" -->';
								xml+= '\n';
								xml+=decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
								break;
							}
						}
						if (!hasMethodBody)
							xml += ' >\n';
						xml += indent() +'</function>\n\n';
					default:
				}
			}
			indentLevel--;
			xml += indent() + '</class>\n';
			//xml += indent() + '<!--_________________________________________________________________-->\n';
		}
		//-------------------------------------------------------------
		// function closures
		var temp:Array<String> = [];
		while(functionClosuresBodies.length>0)
		{
				temp.push(createFunctionClosure(functionClosuresBodies.shift()));
		}
		temp.reverse();
		xml += temp.join('');
		indentLevel--;
		xml += indent() + '</abcfile>\n';
		return xml;
	}
	private function decodeToXML(ops:Array<OpCode>, f)
	{
		indentLevel++;
		//var strs:Array<String> = [];
		var buf = new StringBuf();//new StringBuilder();//
		for (op in ops)
		{
			switch(op)
			{
				
				case	OBreakPoint, ONop, OThrow, ODxNsLate, OPushWith, OPopScope, OForIn, OHasNext, ONull, OUndefined, OForEach, OTrue, OFalse, ONaN, OPop, ODup, OSwap, 
						OScope, ONewBlock, ORetVoid, ORet, OToString, OGetGlobalScope, OInstanceOf, OToXml, OToXmlAttr, OToInt, OToUInt, OToNumber, OToBool, OToObject, 
						OCheckIsXml, OAsAny, OAsString, OAsObject, OTypeof, OThis, OSetThis, OTimestamp:
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' />\n');
						
				case	ODxNs(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(getString(v));
						buf.add('" />\n');
						
				case	OString(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(urlEncode(getString(v)));
						buf.add('" />\n');
												
				case	OIntRef(v), OUIntRef(v) :
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op)); 
						buf.add(' v="');
						buf.add(getInt(v));
						buf.add('" />\n');
												
				case	OFloat(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(getFloat(v));
						buf.add('" />\n');
												
				case	ONamespace(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(getNamespace(v));
						buf.add('" />\n');
												
				case	OClassDef(c):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(className);
						buf.add('" />\n');
												
				case	OFunction(f):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="function__');
						buf.add(Type.enumParameters(f)[0] + '"');
						buf.add(' />\n');
						functionClosuresBodies.push(f);

				case	OGetSuper(v), OSetSuper(v), OGetDescendants(v), OFindPropStrict(v), OFindProp(v), OFindDefinition(v), OGetLex(v), OSetProp(v), OGetProp(v), 
						OInitProp(v), ODeleteProp(v), OCast(v), OAsType(v), OIsType(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(getName(v));
						buf.add('" />\n');

				case	OCallSuper(p,nargs), OCallProperty(p,nargs), OConstructProperty(p,nargs), OCallPropLex(p,nargs), OCallSuperVoid(p,nargs), OCallPropVoid(p,nargs):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op)); 
						buf.add(' v="');
						buf.add(getName(p));
						buf.add('" nargs="');
						buf.add(nargs);
						buf.add('" />\n');
		
				case	ORegKill(v), OReg(v), OSetReg(v), OIncrReg(v), ODecrReg(v), OIncrIReg(v), ODecrIReg(v), OSmallInt(v), OInt(v), OGetScope(v), 
						OBreakPointLine(v), OUnknown(v), OCallStack(v), OConstruct(v), OConstructSuper(v), OApplyType(v), OObject(v), OArray(v), 
						OGetSlot(v), OSetSlot(v),OGetGlobalSlot(v), OSetGlobalSlot(v):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(v);
						buf.add('" />\n');
				
				case	OCatch(v):
						var _try_:TryCatch = f.trys[v];
						var start : Int = _try_.start;
						var end : Int = _try_.end;
						var handle : Int = _try_.handle;
						var type : String = getName(_try_.type);
						var variable : String = getName(_try_.variable);
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add( v );
						buf.add('" start="' );
						buf.add(start );
						buf.add('" end="' );
						buf.add(end );
						buf.add('" handle="' );
						buf.add(handle );
						buf.add('" type="' );
						buf.add(type );
						buf.add('" variable="' );
						buf.add(variable);
						buf.add('" />\n');

				case	OOp(o) :
						buf.add(indent());
						buf.add('<');
						//buf.add(Type.enumConstructor(op));
						//buf.add(' v="' );
						buf.add( Type.enumConstructor(o));
						//buf.add('" />\n');
						buf.add(' />\n');
					
				case	OCallStatic(s, nargs):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(s);
						buf.add('" nargs="');
						buf.add(nargs);
						buf.add('" />\n');
											
				case	OCallMethod(s,nargs):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add( s );
						buf.add( '" nargs="' );
						buf.add( nargs );
						buf.add('" />\n');
						
				case	OLabel:
						//lastLabel = '<!--<' + Type.enumConstructor(op) +'/>-->';
						//"";
						 
				case	OLabel2(landingName):
						buf.add(indent());
						buf.add('<OLabel name="');
						buf.add(landingName);
						buf.add('"/>\n');
						if (jumpInfo)
						{
							buf.add('<!-- ');
							buf.add(landingName);
							buf.add(' -->\n');
						}
												
				case	OJump(jump, offset):
						//lastJump = '<!--<' + Type.enumConstructor(op) +' jump="' + jump + '" offset="' + offset + '"/>-->';
						// "";
						 
				case 	OJump2(jump, landingName, offset):
						if (offset >= 0)
						{
							buf.add(indent());
							buf.add('<');
							buf.add(Type.enumConstructor(jump));
							buf.add(' jump="');
							buf.add( landingName);
							buf.add('" offset="' );
							buf.add( offset );
							buf.add('" />\n');
						}
						else if (offset < 0)
						{
							buf.add(indent());
							buf.add('<');
							buf.add(Type.enumConstructor(jump));
							buf.add(' label="' );
							buf.add( landingName );
							buf.add('" offset="' );
							buf.add( offset );
							buf.add('" />\n');
						}
							
				case	OJump3( landingName ):
						buf.add(indent());
						buf.add('<OJump name="');
						buf.add(landingName );
						buf.add('"/>\n');
						if (jumpInfo)
						{
							buf.add('<!-- ');
							buf.add(landingName );
							buf.add(' -->\n');
						}
												
				case	OSwitch(def, deltas):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' default="' );
						buf.add( def );
						buf.add( '" deltas="' );
						buf.add( deltas);
						buf.add('" />\n');
												
				case	ONext(r1, r2):
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v1="' );
						buf.add( r1 );
						buf.add( '" v2="');
						buf.add( r2 );
						buf.add('" />\n');
						
				case	ODebugFile(v) :
							var name = getString(v);
							if(debugLines==null || name!=debugFile)
							{
								debugFile = name;
								debugFileName = fileToLines(name);
							}
						buf.add(indent());
						buf.add('<');
						buf.add(Type.enumConstructor(op));
						buf.add(' v="');
						buf.add(debugFileName );
						buf.add('" />\n');
						
				case	ODebugLine(v): 
						var line:String;
						if (!sourceInfo || debugFileName == "")
						{
							line = "";
						}
						else
						{
							line = '<!--  ' + v + ')' + debugLines[(v - 1)] + '-->';
							
						}
						if (!debugInfo)
						{
							if (line != "")
							{
								buf.add(line + '\n');
							}
						}
						else
						{
							buf.add(indent());
							buf.add('<' );
							buf.add( Type.enumConstructor(op) );
							buf.add(' v="' );
							buf.add( v );
							buf.add( '" />\n' );
							buf.add(line);
							buf.add( '\n');
						}

				case	ODebugReg(name, r, line):
						if (debugInfo)
						{
							buf.add(indent());
							buf.add('<'  );
							buf.add(Type.enumConstructor(op) );
							buf.add(' name="' );
							buf.add( getString(name));
							buf.add( '" r="');
							buf.add(r);
							buf.add('" line="' );
							buf.add( line);
							buf.add('"/>\n');
						}
				
				default : 
						throw (op + ' Unknown opcode.');
						
			}
		}
		indentLevel--;
		return buf.toString();
	}
	private function createFunctionClosure(f):String
	{
		var out:String = '';
		var _m = getMethod(f);
		var _args = '';
		for (a in _m.args)
			_args += getName(a) + ',';
		var _ret = getName(_m.ret);
		var _name = 'function__' + Type.enumParameters(f)[0];
		out += indent() + '<function f="'+_name+'" name="'+ _name +'" kind="KFunction" args="' + cutComma(_args) +'"';
		if (_ret != "")
			out += ' return="' + _ret +'"';
		out += parseMethodExtra(_m.extra);
		currentFunctionName = _name;
		for (_f in abcFile.functions)
			if (Type.enumEq(_f.type, f))
			{
				if (_f.locals.length != 0)
					out += ' locals="' + parseLocals(_f.locals) + '"';
				out += ' >';
				out += '<!-- maxStack="' + _f.maxStack + '"';
				out += ' nRegs="' + _f.nRegs + '"';
				out += ' initScope="' + _f.initScope + '"';
				out += ' maxScope="' + _f.maxScope + '" -->';
				out += '\n';
				out += decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(_f.code)), _f);
				out += indent() +'</function>\n';
				break;
			}
		return out;
	}
	private function parseMethodExtra(extra:MethodTypeExtra):String
	{
		if (extra == null)
			return '';
		var out = '';
		if (extra.native)
			out += ' native="true"';
		if (extra.variableArgs)
			out += ' variableArgs="true"';
		if (extra.argumentsDefined)
			out += ' argumentsDefined="true"';
		if (extra.usesDXNS)
			out += ' usesDXNS="true"';
		if (extra.newBlock)
			out += ' newBlock="true"';
		if (extra.unused)
			out += ' unused="true"';
		if (extra.debugName != null && getString(extra.debugName) !="")
			out += ' debugName="' + getString(extra.debugName) + '"';
		if (extra.defaultParameters != null)
		{
			var str = '';
			for(i in 0...extra.defaultParameters.length)
				str += 'null,';
			out += ' defaultParameters="' + cutComma(str)+'"';
		}
		return out;
	}
	private function parseLocals(locals:Array<Field>):String
	{
		var out = "";
		for (l in locals)
		{
			switch(l.kind)
			{
				case FVar( type , value , _const ):
					var con:String;
					if (_const)
						con = 'true';
					else
						con = 'false';
					out += getName(l.name) + ":" + getName(type) + ":" + getValue(value)+":"+con+",";
					
				case FMethod( type , k , isFinal, isOverride ): out += "FMethod";
					
				case FClass( c  ):out += "FClass";
					
				case FFunction( f  ):out += "FFunction";
			}
		}
		return cutComma(out);
	}
	private function indent():String
	{
		var str:String = '';
		for (i in 0...indentLevel)
		{
			str += '\t';
		}
		return str;
	}
	inline private function getString(id:Index<String>):String
	{
		return abcFile.get(abcFile.strings, id);
	}
	inline private function getInt(id:Index<haxe.Int32>):String
	{
		return cast abcFile.get(abcFile.ints, id);
	}
	inline private function getUInt(id:Index<haxe.Int32>):String
	{
		return cast abcFile.get(abcFile.uints, id);
	}
	inline private function getFloat(id:Index<Float>):String
	{
		return cast abcFile.get(abcFile.floats, id);
	}
	inline private function getMethod(id:Index<MethodType>)
	{
		return abcFile.methodTypes[Type.enumParameters(id)[0]];
	}
	inline private function getClass(id:Index<ClassDef>)
	{
		return abcFile.classes[Type.enumParameters(id)[0]];
	}
	private function getNamespace(id:Index<Namespace>):String
	{
		if (id == null)
			return"";
		else
		{
			var ns:Namespace = abcFile.get(abcFile.namespaces, id);
			var name:Index<String> = Type.enumParameters(ns)[0];
			var _name:String = getString(name);
			if (_name == null)
				return "";
			return (_name != "")? _name + "." : _name;
		}
	}
	private function getName(id:IName):String
	{
		if (id == null)
		{
			return '*';
		}
		else
		{
			var name = abcFile.get(abcFile.names, id);
			return getNameType(name);
		}
	}
	private function getNameType(name:Name):String
	{
		var __namespace = '';
		var __name = '';
		switch (name)
		{
			case NName(name, ns):
				__name = getString(name);
				__namespace = getNamespace(ns);
					
			case NMulti( name, nset ):
				__name = getString(name);
				//__namespace = "(nset=" + Type.enumParameters(nset)[0] + ")-TODO";
					
			case NRuntime( name):
				__name = getString(name);
				
			case NRuntimeLate:
				__name = "#arrayProp";
					
			case NMultiLate( nset):
				__name = "#arrayProp";
					
			case NAttrib( n ):
				__name = getNameType(n);
				
			case NParams( n , params ):
				__name+= getName(n)+' params:';
				for(i in params)
					 __name+= getName(i) + ',';
		}
		return __namespace + cutComma(__name);
	}
	private function getFieldName(id:IName):String
	{
		return getName(id);
	}
	private function cutComma(str:String):String
	{
		if(str.lastIndexOf(',')==str.length-1)
			return str.substr(0, str.length - 1);
		else
			return str;
	}
	private function getValue(value:Null<Value>):String
	{
		var out = '';
		if (value == null)
			out = "";
		else
		out = switch(value)
		{
			case VNull: "";
			case VString(v):urlEncode(getString(v));
			case VInt(v): getInt(v);
			case VUInt(v): getUInt(v);
			case VFloat(v):getFloat(v);
			case VBool(v): (v==true)? 'true':'false';
			case VNamespace(kind, ns): kind + getNamespace(ns);
		}
		return out;
	}
	private function fileToLines(fileName:String):String
	{
		debugFileName = fileName.split(String.fromCharCode(92)).join("/").split(';;').join("/");
		debugLines=[];
		#if (flash || js)
		sourceInfo = false;
		#else
		if(sourceInfo)
		{
			if (FileSystem.exists(debugFileName))
			{
				var str = File.getContent(debugFileName);
				str = lineSplitter(str);
				debugLines = str.split("\n");
				for(i in 0...debugLines.length)
				{
					debugLines[i] = lineSplitter(debugLines[i]).split("\n").join("");
				}
			}
			else
			{
				//trace(debugFileName +' cannot be found.');
			}
		}
		#end
		return debugFileName=='<null>'?"":debugFileName;
	}
	private function urlEncode(str:String):String
	{
		return str.split('"').join('&quot;').split('<').join('&lt;');
	}
	private function lineSplitter(str:String):String
	{
		var out= str.split("\r\n").join("\n");
		return out.split("\r").join("\n");
	}
}