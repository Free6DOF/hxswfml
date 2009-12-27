package be.haxer.hxswfml;
import format.swf.Data;
import format.abc.Data;
import haxe.io.BytesInput;
#if neko
import neko.io.File;
#elseif cpp
import cpp.io.File;
#end
/**
 * ...
 * @author Jan J. Flanders
 */
class Hxvml 
{
	var abcFile:ABCData;
	var xml:String ;
	var indentLevel:Int;
	var functionClosures:Array<String>;
	var className:String;

	public function new ()
	{
		
	}
	public function abc2xml(fileName:String):String
	{
		var xmll = '<abcfiles>\n';
		if (StringTools.endsWith(fileName, '.abc'))
		{
			xmll+= abcToXml(File.getBytes(fileName)/*, ctx*/);
		}
		else if (StringTools.endsWith(fileName, '.swf'))
		{
			var swf = File.getBytes(fileName);
			var swfBytesInput = new BytesInput(swf);
			var swfReader = new format.swf.Reader(swfBytesInput);
			var header = swfReader.readHeader();
			var tags : Array<SWFTag> = swfReader.readTagList();
			swfBytesInput.close();
			for (tag in tags)
			{
				switch (tag)
				{
					case TActionScript3(data, ctx):
						xmll+= abcToXml(data/*, ctx*/);
					default:
				}
			}
		}
		return xmll+'</abcfiles>';
	}
	private function abcToXml(data/*, ctx*/):String
	{
		var abcReader = new format.abc.Reader(new haxe.io.BytesInput(data));
		abcFile = abcReader.read();
		functionClosures = new Array();
		indentLevel = 1;
		xml = indent()+"<abcfile>\n";
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
			var _ns = getNamespace(_class.namespace);
			var _sealed = _class.isSealed;
			var _final = _class.isFinal;
			var _interface = _class.isInterface;
			//find init of this class/script
			var script_init=null;
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
				xml += indent() + '<init';
				xml += ' name="' + clName + '"';
				if(stargsStr!="")
					xml += ' args="' + cutComma(stargsStr) + '"';
				xml += ' return="' + ret + '"';
				xml += parseMethodExtra(script_init.extra);

				for (f in abcFile.functions)
				{
					if (Type.enumEq(getMethod(f.type), script_init))
					{
						if (f.locals.length != 0)
							xml += ' locals="' + parseLocals(f.locals)+'"';
							
						xml+=' >\n';
						decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
						xml += indent() + '</init>\n';
						break;
					}
				}
			}
			xml += indent() + '<class ';
			xml += ' name="' + clName + '"';
			if(_extends!=null && _extends!="")	
				xml += ' extends="' + _extends + '"';
			if(__implements!="")	
				xml += ' implements="' + cutComma(__implements) + '"';
			//if(_ns!=null && _ns!="")
				//xml += ' ns="' + _ns + '"';
			if(_sealed)
				xml += ' sealed="' + _sealed + '"';
			if(_final)
				xml += ' final="' + _final + '"';
			if(_interface)
				xml += ' interface="' + _interface +'"';
			xml+='>\n';
			//-------------------------------------------------------------
			// instance vars
			indentLevel++;
			for (field in _class.fields)
			{
				switch(field.kind) 
				{
					case FVar(type, value, const):
						var _type = getName(type);
						var _value = getValue(value);
						var _const = const;
						xml += indent() + '<var name="' +getFieldName(field.name) + '"' ;
						if(_type!=null && _type!="*" && _type!="")
							xml += ' type="' + _type + '"';
						if(_value !="")
							xml += ' value="' + _value + '"';
						if(_const)
							xml += ' const="' + _const + '"';
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
					case FVar(type, value, const):
						var _type = getName(type);
						var _value = getValue(value);
						var _const = const;
						xml += indent() + '<var name="' +getFieldName(field.name) + '"' ;
						if(_type!=null && _type!="*" && _type!="")
							xml += ' type="' + _type + '"';
						if(_value !="")
							xml += ' value="' + _value + '"';
						if(_const)
							xml += ' const="' + _const + '"';
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
			xml += indent() + '<function';
			xml += ' name="' + clName + '"';
			xml += ' args="' + cutComma(cargsStr) + '"';
			xml += ' return="' + returnType + '"';
			xml += parseMethodExtra(cst.extra);
			for (f in abcFile.functions)
				if (Type.enumEq(f.type, _class.constructor))
				{
					if (f.locals.length != 0)
						xml += ' locals="' + parseLocals(f.locals)+'"';
						
					xml+=' >\n';
					decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
					break;
				}
			if (_interface)
				xml+=' >\n' + indent() +'</function>\n\n';
			else
				xml += indent() + '</function>\n\n';
			//-------------------------------------------------------------
			// static constructor
			var st = getMethod(_class.statics);
			var stargsStr = '';
			for (a in st.args)
				stargsStr += getName(a) + ',';
			var ret = getName(st.ret);
			xml += indent() + '<function';
			xml += ' name="' + getName(_class.name) + '"';
			xml += ' static="true"';
			if(stargsStr!="")
				xml += ' args="' + cutComma(stargsStr) + '"';
			xml += ' return="' + ret + '"';
			xml += parseMethodExtra(st.extra);
			for (f in abcFile.functions)
			{
				if (Type.enumEq(getMethod(f.type), st))
				{
					if (f.locals.length != 0)
						xml += ' locals="' + parseLocals(f.locals)+'"';
						
					xml+=' >\n';
					decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
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
					case FMethod(type, k, isFinal, isOverride):
						var _m = getMethod(type);
						
						var _args = '';
						for (a in _m.args)
							_args += getName(a) + ',';
						var _ret = getName(_m.ret);
						var _k = switch(k) { case KNormal:'normal'; case KSetter:'setter'; case KGetter:'getter';};
						var _name = getFieldName(field.name);
						xml += indent() + '<function';
						xml += ' name="' + _name + '"';
						if(isOverride)
							xml += ' override="'+isOverride+'"';
						if(isFinal)
							xml += ' final="'+isFinal+'"';
						if (_k != 'normal')
							xml += ' kind="' + _k + '"';
						xml += ' args="' + cutComma(_args) +'"';
						xml += ' return="' + _ret +'"';
						xml += parseMethodExtra(_m.extra);
						hasMethodBody = false;
						for (f in abcFile.functions)
						{
							if (Type.enumEq(f.type, type))
							{
								hasMethodBody = true;
								if (f.locals.length != 0)
									xml += ' locals="' + parseLocals(f.locals)+'"';
									
								xml+=' >\n';
								decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
								break;
							}
						}
						if (!hasMethodBody)
							xml+=' >\n';
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
						
						xml += indent() + '<function ';
						xml += ' name="' + _name +'"';
						xml += ' static="true"';
						if(isOverride)
							xml += ' override="'+isOverride+'"';
						if(isFinal)
							xml += ' final="'+isFinal+'"';
						if (_k != 'normal')
							xml += ' kind="' + _k + '"';
						xml += ' args="' + cutComma(_args) +'"';
						xml += ' return="' + _ret +'"';
						xml += parseMethodExtra(_m.extra);
						hasMethodBody = false;
						for (f in abcFile.functions)
						{
							if (Type.enumEq(f.type, type))
							{
								hasMethodBody = true;
								if (f.locals.length != 0)
									xml += ' locals="' + parseLocals(f.locals)+'"';
									
								xml+=' >\n';
								decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(f.code)), f);
								break;
							}
						}
						if (!hasMethodBody)
							xml+=' >\n';
						xml += indent() +'</function>\n\n';
					default:
				}
			}
			indentLevel--;
			xml += indent() + '</class>\n';
			xml += indent() + '<!--_________________________________________________________________-->\n';
		}
		//-------------------------------------------------------------
		// function closures
		for (i in functionClosures)
		{
				xml += i;
		}
		indentLevel--;
		xml += indent() + '</abcfile>\n';
		return xml;
	}
	private function decodeToXML(ops:Array<OpCode>, f)
	{
		indentLevel++;
		for (op in ops)
		{
			xml += indent()+
			switch(op)
			{
				case	OBreakPoint, ONop, OThrow, ODxNsLate, OPushWith, OPopScope, OForIn, OHasNext, ONull, OUndefined, OForEach, OTrue, OFalse, ONaN, OPop, 
						ODup, OSwap, OScope, ONewBlock, ORetVoid, ORet, OToString, OGetGlobalScope, OInstanceOf, OToXml, OToXmlAttr, OToInt, OToUInt, OToNumber, OToBool, OToObject, OCheckIsXml, OAsAny, OAsString, OAsObject, OTypeof, OThis, 
						OSetThis, OTimestamp:
						'<' + Type.enumConstructor(op) +' />\n';
	
				case	ODxNs(v), ODebugFile(v) :
						'<' + Type.enumConstructor(op) +' v="' + getString(v) + '" />\n';
						
				case	OString(v):
						'<' + Type.enumConstructor(op) +' v="' + StringTools.urlEncode(getString(v)) + '" />\n';
												
				case	OIntRef(v), OUIntRef(v) :
						'<' + Type.enumConstructor(op) +' v="' + getInt(v) + '" />\n';
												
				case	OFloat(v):
						'<' + Type.enumConstructor(op) +' v="' + getFloat(v) + '" />\n';
												
				case	ONamespace(v):
						'<' + Type.enumConstructor(op) +' v="' + getNamespace(v) + '" />\n';
												
				case	OClassDef(c):
						'<' + Type.enumConstructor(op) +' c="' + className + '" />\n';
												
				case	OFunction(f):
						'<' + Type.enumConstructor(op) +' f="functionClosure_' + Type.enumParameters(f)[0] + '" />\n' + createFunctionClosure(f);

				case	OGetSuper(v), OSetSuper(v), OGetDescendants(v), OFindPropStrict(v), OFindProp(v), OFindDefinition(v), OGetLex(v), OSetProp(v), OGetProp(v), 
						OInitProp(v), ODeleteProp(v), OCast(v), OAsType(v), OIsType(v):
						'<' + Type.enumConstructor(op) +' p="' + getName(v) + '" />\n';

				case	OCallSuper(p,nargs), OCallProperty(p,nargs), OConstructProperty(p,nargs), OCallPropLex(p,nargs), OCallSuperVoid(p,nargs), OCallPropVoid(p,nargs):
						'<' + Type.enumConstructor(op) +' p="' + getName(p) + '" nargs="'+ nargs+'"/>\n';
												
				case	ORegKill(v), OReg(v), OSetReg(v), OIncrReg(v), ODecrReg(v), OIncrIReg(v), ODecrIReg(v), OSmallInt(v), OInt(v), OGetScope(v), ODebugLine(v), 
						OBreakPointLine(v), OUnknown(v), OCallStack(v), OConstruct(v), OConstructSuper(v), OApplyType(v), OObject(v), OArray(v), 
						OGetSlot(v), OSetSlot(v),OGetGlobalSlot(v), OSetGlobalSlot(v):
						'<' + Type.enumConstructor(op) +' v="' + v + '" />\n';
				
				case	OCatch(v):
						var _try = f.trys[v];
						var start : Int = _try.start;
						var end : Int = _try.end;
						var handle : Int = _try.handle;
						var type : String = getName(_try.type);
						var variable : String = getName(_try.variable);
						'<' + Type.enumConstructor(op) +' v="' + v + '" start="'+start+'" end="'+end+'" handle="'+handle+'" type="'+type+'" variable="'+variable+'" />\n';

				case	OOp(o) :
						'<' + Type.enumConstructor(op) +' op="' + Type.enumConstructor(o)+ '"/>\n';
					
				case	OCallStatic(s, nargs):
						'<' + Type.enumConstructor(op) +' s="' + s+ '" nargs="'+nargs+'"/>\n';
											
				case	OCallMethod(s,nargs):
						 '<' + Type.enumConstructor(op) +' s="' + s + '" nargs="' + nargs + '"/>\n';
						
				case	OLabel:
						 '<!--<' + Type.enumConstructor(op) +'/>-->\n';
						 
				case	OLabel2(landingName):
						 '<OLabel name="'+landingName+'"/>\n';
												
				case	OJump(jump, offset):
						 '<!--<' + Type.enumConstructor(op) +' jump="' + jump + '" offset="' + offset + '"/>-->\n';
						 
				case 	OJump2(jump, landingName, offset):
						if(offset>=0)
							'<' + Type.enumConstructor(jump) +' jump="' + landingName +'"/>\n';
						else if(offset<0)
							'<' + Type.enumConstructor(jump) +' label="' + landingName +'"/>\n';

				case	OJump3( landingName ):
						'<OJump name="' + landingName + '"/>\n';
												
				case	OSwitch(def, deltas):
						'<' + Type.enumConstructor(op) +' def="' + def+ '" deltas="'+deltas+'"/>\n';
												
				case	ONext(r1, r2):
						'<' + Type.enumConstructor(op) +' r1="' + r1+ '" r2="'+r2+'"/>\n';
												
				case	ODebugReg(name, r, line):
						'<' + Type.enumConstructor(op) +' name="' + getString(name)+ '" r="'+r+'" line="' + line+'"/>\n';
				
				default : 
						throw (op + ' Unknown opcode.');
			}
		}
		indentLevel--;
	}
	private function createFunctionClosure(f):String
	{
		var start = xml.length;
		var _m = getMethod(f);
		var _args = '';
		for (a in _m.args)
			_args += getName(a) + ',';
		var _ret = getName(_m.ret);
		var _name = 'functionClosure_' + Type.enumParameters(f)[0];
		xml += indent() + '<function';
		xml += ' name="' + _name+ '"';
		xml += ' kind="KFunction"';
		xml += ' args="' + cutComma(_args) +'"';
		if (_ret!="")
			xml += ' return="' + _ret +'"';
		xml += parseMethodExtra(_m.extra);

		for (_f in abcFile.functions)
			if (Type.enumEq(_f.type, f))
			{
				if (_f.locals.length != 0)
					xml += ' locals="' + parseLocals(_f.locals)+'"';
					
				xml+=' >\n';
				decodeToXML(format.abc.OpReader.decode(new haxe.io.BytesInput(_f.code)), _f);
				xml += indent() +'</function>\n\n';
				break;
			}
		functionClosures.push(xml.substr(start));
		return '';
	}
	private function parseMethodExtra(extra:MethodTypeExtra):String
	{
		if (extra == null)
			return '';
		var out = '';
		if (extra.native)
			out += ' native="' + extra.native+'"';
		if (extra.variableArgs)
			out += ' variableArgs="' + extra.variableArgs+'"';
		if (extra.argumentsDefined)
			out += ' argumentsDefined="' + extra.argumentsDefined+'"';
		if (extra.usesDXNS)
			out += ' usesDXNS="' + extra.usesDXNS+'"';
		if (extra.newBlock)
			out += ' newBlock="' + extra.newBlock+'"';
		if (extra.unused)
			out += ' unused="' + extra.unused+'"';
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
				case FVar( type , value , const ):
					out += getName(l.name) + ":" + getName(type) + ":" + getValue(value)+":"+const+",";
					
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
	private function getString(id:Index<String>):String
	{
		return abcFile.get(abcFile.strings, id);
	}
	private function getInt(id:Index<haxe.Int32>):String
	{
		return cast abcFile.get(abcFile.ints, id);
	}
	private function getUInt(id:Index<haxe.Int32>):String
	{
		return cast abcFile.get(abcFile.uints, id);
	}
	private function getFloat(id:Index<Float>):String
	{
		return cast abcFile.get(abcFile.floats, id);
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
	private function getMethod(id:Index<MethodType>)
	{
		return abcFile.methodTypes[Type.enumParameters(id)[0]];
	}
	private function getClass(id:Index<ClassDef>)
	{
		return abcFile.classes[Type.enumParameters(id)[0]];
	}
	private function cutComma(str:String):String
	{
		if(str.lastIndexOf(',')==str.length-1)
			return str.substr(0, str.length - 1);
		else
			return str;
	}
	private function getValue(value:Value):String
	{
		if (value == null)
			return "";
		return cast switch(value)
		{
			case VNull: "";
			case VString(v):getString(v);
			case VInt(v): getInt(v);
			case VUInt(v): getUInt(v);
			case VFloat(v):getFloat(v);
			case VBool(v): Std.string(v);
			case VNamespace(kind, ns): kind + getNamespace(ns);
		}
	}
	private function getAnyAttribute(element, arr:Array<String>):String
	{
		for (i in 0...arr.length)
		{
			if (element.get(arr[i]) != null)
			return element.get(arr[i]);
		}
		return "";
	}
}