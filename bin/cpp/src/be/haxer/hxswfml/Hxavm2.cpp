#include <hxObject.h>

#ifndef INCLUDED_Hash
#include <Hash.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringTools
#include <StringTools.h>
#endif
#ifndef INCLUDED_Type
#include <Type.h>
#endif
#ifndef INCLUDED_be_haxer_hxswfml_Hxavm2
#include <be/haxer/hxswfml/Hxavm2.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_cpp_CppXml__
#include <cpp/CppXml__.h>
#endif
#ifndef INCLUDED_format_abc_ABCData
#include <format/abc/ABCData.h>
#endif
#ifndef INCLUDED_format_abc_Context
#include <format/abc/Context.h>
#endif
#ifndef INCLUDED_format_abc_FieldKind
#include <format/abc/FieldKind.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_JumpStyle
#include <format/abc/JumpStyle.h>
#endif
#ifndef INCLUDED_format_abc_MethodKind
#include <format/abc/MethodKind.h>
#endif
#ifndef INCLUDED_format_abc_Namespace
#include <format/abc/Namespace.h>
#endif
#ifndef INCLUDED_format_abc_OpCode
#include <format/abc/OpCode.h>
#endif
#ifndef INCLUDED_format_abc_Operation
#include <format/abc/Operation.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
#ifndef INCLUDED_format_abc_Writer
#include <format/abc/Writer.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_haxe_Log
#include <haxe/Log.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesOutput
#include <haxe/io/BytesOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace be{
namespace haxer{
namespace hxswfml{

Void Hxavm2_obj::__construct()
{
{
	this->throwsErrors = false;
	this->log = true;
}
;
	return null();
}

Hxavm2_obj::~Hxavm2_obj() { }

Dynamic Hxavm2_obj::__CreateEmpty() { return  new Hxavm2_obj; }
hxObjectPtr<Hxavm2_obj > Hxavm2_obj::__new()
{  hxObjectPtr<Hxavm2_obj > result = new Hxavm2_obj();
	result->__construct();
	return result;}

Dynamic Hxavm2_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Hxavm2_obj > result = new Hxavm2_obj();
	result->__construct();
	return result;}

Array<format::swf::SWFTag > Hxavm2_obj::xml2abc( String xml){
	Array<format::swf::SWFTag > swfTags = Array_obj<format::swf::SWFTag >::__new();
	cpp::CppXml__ abcfiles = cpp::CppXml___obj::parse(xml)->firstElement();
	if (abcfiles->getNodeName().toLowerCase() == STRING(L"abcfile",7)){
		swfTags->push(this->xmlToabc(abcfiles));
	}
	else{
		for(Dynamic __it = abcfiles->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ abcfile = __it->__Field(STRING(L"next",4))();
			{
				swfTags->push(this->xmlToabc(abcfile));
			}
;
		}
	}
	return swfTags;
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,xml2abc,return )

format::swf::SWFTag Hxavm2_obj::xmlToabc( cpp::CppXml__ xml){
	cpp::CppXml__ ctx_xml = xml;
	this->ctx = format::abc::Context_obj::__new();
	this->jumps = Hash_obj::__new();
	this->labels = Hash_obj::__new();
	this->curClassName = STRING(L"",0);
	Array<format::abc::OpCode > statics = Array_obj<format::abc::OpCode >::__new();
	this->imports = Hash_obj::__new();
	this->functionClosures = Hash_obj::__new();
	this->inits = Hash_obj::__new();
	this->classDefs = Hash_obj::__new();
	format::abc::Context ctx = this->ctx;
	for(Dynamic __it = ctx_xml->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ _classNode = __it->__Field(STRING(L"next",4))();
		{
			String _switch_1 = (_classNode->getNodeName());
			if (  ( _switch_1==STRING(L"function",8))){
				this->createFunction(_classNode,STRING(L"function",8),null());
			}
			else  {
			}
;
;
		}
;
	}
	for(Dynamic __it = ctx_xml->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ _classNode = __it->__Field(STRING(L"next",4))();
		{
			String _switch_2 = (_classNode->getNodeName().toLowerCase());
			if (  ( _switch_2==STRING(L"function",8))){
			}
			else if (  ( _switch_2==STRING(L"init",4))){
			}
			else if (  ( _switch_2==STRING(L"import",6))){
				String n = _classNode->get(STRING(L"class",5));
				String cn = n.split(STRING(L".",1))->pop();
				this->imports->set(cn,n);
			}
			else if (  ( _switch_2==STRING(L"class",5)) ||  ( _switch_2==STRING(L"interface",9))){
				this->className = _classNode->get(STRING(L"name",4));
				Dynamic cl = ctx->beginClass(this->className,_classNode->get(STRING(L"interface",9)) == STRING(L"true",4));
				this->curClass = cl;
				this->classDefs->set(this->className,ctx->getClass(cl));
				this->curClassName = this->className.split(STRING(L".",1))->pop();
				if (_classNode->get(STRING(L"implements",10)) != null()){
					cl.FieldRef(STRING(L"interfaces",10)) = Array_obj<format::abc::Index >::__new();
					{
						int _g = 0;
						Array<String > _g1 = _classNode->get(STRING(L"implements",10)).split(STRING(L",",1));
						while(_g < _g1->length){
							String i = _g1->__get(_g);
							++_g;
							cl->__Field(STRING(L"interfaces",10)).Cast<Array<format::abc::Index > >()->push(ctx->type(this->getImport(i)));
						}
					}
				}
				cl.FieldRef(STRING(L"isFinal",7)) = _classNode->get(STRING(L"final",5)) == STRING(L"true",4);
				cl.FieldRef(STRING(L"isInterface",11)) = _classNode->get(STRING(L"interface",9)) == STRING(L"true",4);
				cl.FieldRef(STRING(L"isSealed",8)) = _classNode->get(STRING(L"sealed",6)) == STRING(L"true",4);
				String _extends = _classNode->get(STRING(L"extends",7));
				if (_extends != null()){
					cl.FieldRef(STRING(L"superclass",10)) = ctx->type(this->getImport(_extends));
					ctx->addClassSuper(this->getImport(_extends));
				}
				for(Dynamic __it = _classNode->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ member = __it->__Field(STRING(L"next",4))();
					{
						String _switch_3 = (member->getNodeName());
						if (  ( _switch_3==STRING(L"field",5)) ||  ( _switch_3==STRING(L"var",3))){
							String name = member->get(STRING(L"name",4));
							String type = member->get(STRING(L"type",4));
							if (bool(type == null()) || bool(type == STRING(L"",0)))
								type = STRING(L"*",1);
							bool isStatic = member->get(STRING(L"static",6)) == STRING(L"true",4);
							String value = member->get(STRING(L"value",5));
							bool const = member->get(STRING(L"const",5)) == STRING(L"true",4);
							format::abc::Index ns = this->namespaceType(member->get(STRING(L"ns",2)));
							struct _Function_1{
								static format::abc::Value Block( format::abc::Context &ctx,String &value,String &type)/* DEF (not block)(ret intern) */{
									String _switch_4 = (type);
									if (  ( _switch_4==STRING(L"String",6))){
										return format::abc::Value_obj::VString(ctx->string(value));
									}
									else if (  ( _switch_4==STRING(L"int",3))){
										return format::abc::Value_obj::VInt(ctx->toInt(cpp::CppInt32___obj::ofInt(Std_obj::parseInt(value))));
									}
									else if (  ( _switch_4==STRING(L"uint",4))){
										return format::abc::Value_obj::VUInt(ctx->uint(cpp::CppInt32___obj::ofInt(Std_obj::parseInt(value))));
									}
									else if (  ( _switch_4==STRING(L"Number",6))){
										return format::abc::Value_obj::VFloat(ctx->_float(Std_obj::parseFloat(value)));
									}
									else if (  ( _switch_4==STRING(L"Boolean",7))){
										return format::abc::Value_obj::VBool(value == STRING(L"true",4));
									}
									else  {
										return null();
									}
;
;
								}
							};
							format::abc::Value _value = (value == null()) ? format::abc::Value( null() ) : format::abc::Value( _Function_1::Block(ctx,value,type) );
							ctx->defineField(name,ctx->type(this->getImport(type)),isStatic,_value,const,ns);
						}
						else if (  ( _switch_3==STRING(L"method",6)) ||  ( _switch_3==STRING(L"function",8))){
							this->createFunction(member,STRING(L"method",6),cl->__Field(STRING(L"isInterface",11)).Cast<bool >());
						}
						else  {
							hxThrow ((member->getNodeName() + STRING(L" Must be <method/> or <var/>.",29)));
						}
;
;
					}
;
				}
				for(Dynamic __it = ctx_xml->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ _classNode1 = __it->__Field(STRING(L"next",4))();
					{
						String _switch_5 = (_classNode1->getNodeName());
						if (  ( _switch_5==STRING(L"init",4))){
							if (_classNode1->get(STRING(L"name",4)) == this->className)
								this->createFunction(_classNode1,STRING(L"init",4),null());
						}
						else  {
						}
;
;
					}
;
				}
				if (this->inits->exists(this->className)){
					ctx->getData()->inits[ctx->getData()->inits->length - 1].FieldRef(STRING(L"method",6)) = this->inits->get(this->className).Cast<format::abc::Index >();
					ctx->endClass(false);
				}
				else{
					ctx->endClass(null());
				}
			}
			else  {
				hxThrow ((STRING(L"<",1) + _classNode->getNodeName() + STRING(L"> Must be <function>, <init>, <import> or <class [<var>], [<method>]>.",70)));
			}
;
;
		}
;
	}
	format::abc::ABCData abcFile = ctx->getData();
	haxe::io::BytesOutput abcOutput = haxe::io::BytesOutput_obj::__new();
	format::abc::Writer_obj::write(abcOutput,abcFile);
	return format::swf::SWFTag_obj::TActionScript3(abcOutput->getBytes(),hxAnon_obj::Create()->Add( STRING(L"id",2) , 1)->Add( STRING(L"label",5) , this->className));
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,xmlToabc,return )

Dynamic Hxavm2_obj::createFunction( cpp::CppXml__ node,String functionType,Dynamic __o_isInterface){
bool isInterface = __o_isInterface.Default(false);
{
		this->maxStack = 0;
		this->currentStack = 0;
		this->maxScopeStack = 0;
		this->currentScopeStack = 0;
		Array<format::abc::Index > args = Array_obj<format::abc::Index >::__new();
		String _args = node->get(STRING(L"args",4));
		if (bool(_args == null()) || bool(_args == STRING(L"",0)))
			args = Array_obj<format::abc::Index >::__new();
		else{
			int _g = 0;
			Array<String > _g1 = _args.split(STRING(L",",1));
			while(_g < _g1->length){
				String i = _g1->__get(_g);
				++_g;
				args->push(this->ctx->type(this->getImport(i)));
			}
		}
		format::abc::Index _return = (bool(node->get(STRING(L"return",6)) == STRING(L"",0)) || bool(node->get(STRING(L"return",6)) == null())) ? format::abc::Index( this->ctx->type(STRING(L"*",1)) ) : format::abc::Index( this->ctx->type(this->getImport(node->get(STRING(L"return",6)))) );
		Array<format::abc::Value > _defaultParameters = null();
		String defaultParameters = node->get(STRING(L"defaultParameters",17));
		if (defaultParameters != null()){
			Array<String > values = defaultParameters.split(STRING(L",",1));
			_defaultParameters = Array_obj<format::abc::Value >::__new();
			{
				int _g = 0;
				while(_g < values->length){
					String v = values->__get(_g);
					++_g;
					_defaultParameters->push(null());
				}
			}
		}
		Dynamic extra = hxAnon_obj::Create()->Add( STRING(L"native",6) , node->get(STRING(L"native",6)) == STRING(L"true",4))->Add( STRING(L"variableArgs",12) , node->get(STRING(L"variableArgs",12)) == STRING(L"true",4))->Add( STRING(L"argumentsDefined",16) , node->get(STRING(L"argumentsDefined",16)) == STRING(L"true",4))->Add( STRING(L"usesDXNS",8) , node->get(STRING(L"usesDXNS",8)) == STRING(L"true",4))->Add( STRING(L"newBlock",8) , node->get(STRING(L"newBlock",8)) == STRING(L"true",4))->Add( STRING(L"unused",6) , node->get(STRING(L"unused",6)) == STRING(L"true",4))->Add( STRING(L"debugName",9) , this->ctx->string(node->get(STRING(L"debugName",9)) == null() ? String( STRING(L"",0) ) : String( node->get(STRING(L"debugName",9)) )))->Add( STRING(L"defaultParameters",17) , _defaultParameters)->Add( STRING(L"paramNames",10) , null());
		format::abc::Index ns = this->namespaceType(node->get(STRING(L"ns",2)));
		Dynamic f = null();
		if (functionType == STRING(L"function",8)){
			this->ctx->beginFunction(args,_return,extra);
			f = this->ctx->curFunction->__Field(STRING(L"f",1));
			String name = node->get(STRING(L"name",4));
			this->functionClosures->set(name,f->__Field(STRING(L"type",4)).Cast<format::abc::Index >());
		}
		else
			if (functionType == STRING(L"method",6)){
			bool _static = node->get(STRING(L"static",6)) == STRING(L"true",4);
			bool _override = node->get(STRING(L"override",8)) == STRING(L"true",4);
			bool _final = node->get(STRING(L"final",5)) == STRING(L"true",4);
			bool _later = node->get(STRING(L"later",5)) == STRING(L"true",4);
			struct _Function_1{
				static format::abc::MethodKind Block( cpp::CppXml__ &node)/* DEF (not block)(ret intern) */{
					String _switch_6 = (node->get(STRING(L"kind",4)));
					if (  ( _switch_6==STRING(L"normal",6))){
						return format::abc::MethodKind_obj::KNormal;
					}
					else if (  ( _switch_6==STRING(L"set",3)) ||  ( _switch_6==STRING(L"setter",6))){
						return format::abc::MethodKind_obj::KSetter;
					}
					else if (  ( _switch_6==STRING(L"get",3)) ||  ( _switch_6==STRING(L"getter",6))){
						return format::abc::MethodKind_obj::KGetter;
					}
					else  {
						return format::abc::MethodKind_obj::KNormal;
					}
;
;
				}
			};
			format::abc::MethodKind kind = _Function_1::Block(node);
			if (node->get(STRING(L"name",4)) == this->className){
				if (_static == true){
					this->ctx->beginFunction(args,_return,extra);
					f = this->ctx->curFunction->__Field(STRING(L"f",1));
					this->curClass.FieldRef(STRING(L"statics",7)) = f->__Field(STRING(L"type",4)).Cast<format::abc::Index >();
				}
				else{
					if (isInterface){
						f = this->ctx->beginInterfaceMethod(this->getImport(node->get(STRING(L"name",4))),args,_return,_static,_override,_final,true,kind,extra,ns);
						this->curClass.FieldRef(STRING(L"constructor",11)) = f->__Field(STRING(L"type",4)).Cast<format::abc::Index >();
						return f;
					}
					else{
						f = this->ctx->beginMethod(this->getImport(node->get(STRING(L"name",4))),args,_return,_static,_override,_final,true,kind,extra,ns);
						this->curClass.FieldRef(STRING(L"constructor",11)) = f->__Field(STRING(L"type",4)).Cast<format::abc::Index >();
					}
				}
			}
			else{
				if (isInterface){
					Dynamic f1 = this->ctx->beginInterfaceMethod(this->getImport(node->get(STRING(L"name",4))),args,_return,_static,_override,_final,_later,kind,extra,ns);
					return f1;
				}
				else
					f = this->ctx->beginMethod(this->getImport(node->get(STRING(L"name",4))),args,_return,_static,_override,_final,_later,kind,extra,ns);
;
			}
		}
		else
			if (functionType == STRING(L"init",4)){
			this->ctx->beginFunction(args,_return,extra);
			f = this->ctx->curFunction->__Field(STRING(L"f",1));
			String name = this->getImport(node->get(STRING(L"name",4)));
			this->inits->set(name,f->__Field(STRING(L"type",4)).Cast<format::abc::Index >());
		}
;
;
;
		if (node->get(STRING(L"locals",6)) != null()){
			Array<Dynamic > locals = this->parseLocals(node->get(STRING(L"locals",6)));
			if (locals->length != 0)
				f.FieldRef(STRING(L"locals",6)) = locals;
		}
		bool result = this->writeCodeBlock(node,f);
		if (node->get(STRING(L"maxStack",8)) != null())
			f.FieldRef(STRING(L"maxStack",8)) = Std_obj::parseInt(node->get(STRING(L"maxStack",8)));
		else
			f.FieldRef(STRING(L"maxStack",8)) = this->maxStack + f->__Field(STRING(L"trys",4)).Cast<Array<Dynamic > >()->length;
;
		if (node->get(STRING(L"maxScope",8)) != null())
			f.FieldRef(STRING(L"maxScope",8)) = Std_obj::parseInt(node->get(STRING(L"maxScope",8)));
		else
			f.FieldRef(STRING(L"maxScope",8)) = this->maxScopeStack;
;
		if (this->currentStack > 0)
			this->nonEmptyStack(node->get(STRING(L"name",4)));
		return f;
	}
}


DEFINE_DYNAMIC_FUNC3(Hxavm2_obj,createFunction,return )

bool Hxavm2_obj::writeCodeBlock( cpp::CppXml__ member,Dynamic f){
	if (this->log)
		this->logStack(STRING(L"------------------------------------------------\ncurrent class= ",64) + this->className + STRING(L", method= ",10) + member->get(STRING(L"name",4)) + STRING(L"\ncurrentStack= ",15) + this->currentStack + STRING(L", maxStack= ",12) + this->maxStack + STRING(L"\ncurrentScopeStack= ",20) + this->currentScopeStack + STRING(L", maxScopeStack= ",17) + this->maxScopeStack + STRING(L"\n\n",2));
	for(Dynamic __it = member->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ o = __it->__Field(STRING(L"next",4))();
		{
			struct _Function_1{
				static format::abc::OpCode Block( be::haxer::hxswfml::Hxavm2_obj *__this,cpp::CppXml__ &o,Dynamic &f)/* DEF (not block)(ret intern) */{
					String _switch_7 = (o->getNodeName());
					if (  ( _switch_7==STRING(L"OBreakPoint",11)) ||  ( _switch_7==STRING(L"ONop",4)) ||  ( _switch_7==STRING(L"OThrow",6)) ||  ( _switch_7==STRING(L"ODxNsLate",9)) ||  ( _switch_7==STRING(L"OPushWith",9)) ||  ( _switch_7==STRING(L"OPopScope",9)) ||  ( _switch_7==STRING(L"OForIn",6)) ||  ( _switch_7==STRING(L"OHasNext",8)) ||  ( _switch_7==STRING(L"ONull",5)) ||  ( _switch_7==STRING(L"OUndefined",10)) ||  ( _switch_7==STRING(L"OForEach",8)) ||  ( _switch_7==STRING(L"OTrue",5)) ||  ( _switch_7==STRING(L"OFalse",6)) ||  ( _switch_7==STRING(L"ONaN",4)) ||  ( _switch_7==STRING(L"OPop",4)) ||  ( _switch_7==STRING(L"ODup",4)) ||  ( _switch_7==STRING(L"OSwap",5)) ||  ( _switch_7==STRING(L"OScope",6)) ||  ( _switch_7==STRING(L"ONewBlock",9)) ||  ( _switch_7==STRING(L"ORetVoid",8)) ||  ( _switch_7==STRING(L"ORet",4)) ||  ( _switch_7==STRING(L"OToString",9)) ||  ( _switch_7==STRING(L"OGetGlobalScope",15)) ||  ( _switch_7==STRING(L"OInstanceOf",11)) ||  ( _switch_7==STRING(L"OToXml",6)) ||  ( _switch_7==STRING(L"OToXmlAttr",10)) ||  ( _switch_7==STRING(L"OToInt",6)) ||  ( _switch_7==STRING(L"OToUInt",7)) ||  ( _switch_7==STRING(L"OToNumber",9)) ||  ( _switch_7==STRING(L"OToBool",7)) ||  ( _switch_7==STRING(L"OToObject",9)) ||  ( _switch_7==STRING(L"OCheckIsXml",11)) ||  ( _switch_7==STRING(L"OAsAny",6)) ||  ( _switch_7==STRING(L"OAsString",9)) ||  ( _switch_7==STRING(L"OAsObject",9)) ||  ( _switch_7==STRING(L"OTypeof",7)) ||  ( _switch_7==STRING(L"OThis",5)) ||  ( _switch_7==STRING(L"OSetThis",8)) ||  ( _switch_7==STRING(L"OTimestamp",10))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),null());
					}
					else if (  ( _switch_7==STRING(L"ODxNs",5)) ||  ( _switch_7==STRING(L"ODebugFile",10))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->string(__this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"v",1)).Add(STRING(L"file",4))))));
					}
					else if (  ( _switch_7==STRING(L"OString",7))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->string(StringTools_obj::urlDecode(__this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"v",1)).Add(STRING(L"file",4)))))));
					}
					else if (  ( _switch_7==STRING(L"OIntRef",7)) ||  ( _switch_7==STRING(L"OUIntRef",8))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->toInt(cpp::CppInt32___obj::ofInt(Std_obj::parseInt(o->get(STRING(L"v",1)))))));
					}
					else if (  ( _switch_7==STRING(L"OFloat",6))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->_float(Std_obj::parseFloat(o->get(STRING(L"v",1))))));
					}
					else if (  ( _switch_7==STRING(L"ONamespace",10))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->type(o->get(STRING(L"v",1)))));
					}
					else if (  ( _switch_7==STRING(L"OClassDef",9))){
						return !__this->classDefs->exists(o->get(STRING(L"c",1))) ? format::abc::OpCode( hxThrow (o->get(STRING(L"c",1)) + STRING(L" must be created as class before referencing it here.",53)) ) : format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->classDefs->get(o->get(STRING(L"c",1))).Cast<format::abc::Index >())) );
					}
					else if (  ( _switch_7==STRING(L"OFunction",9))){
						return !__this->functionClosures->exists(o->get(STRING(L"f",1))) ? format::abc::OpCode( hxThrow (o->get(STRING(L"f",1)) + STRING(L" must be created as function (closure) before referencing it here.",66)) ) : format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->functionClosures->get(o->get(STRING(L"f",1))).Cast<format::abc::Index >())) );
					}
					else if (  ( _switch_7==STRING(L"OGetSuper",9)) ||  ( _switch_7==STRING(L"OSetSuper",9)) ||  ( _switch_7==STRING(L"OGetDescendants",15)) ||  ( _switch_7==STRING(L"OFindPropStrict",15)) ||  ( _switch_7==STRING(L"OFindProp",9)) ||  ( _switch_7==STRING(L"OFindDefinition",15)) ||  ( _switch_7==STRING(L"OGetLex",7)) ||  ( _switch_7==STRING(L"OSetProp",8)) ||  ( _switch_7==STRING(L"OGetProp",8)) ||  ( _switch_7==STRING(L"OInitProp",9)) ||  ( _switch_7==STRING(L"ODeleteProp",11)) ||  ( _switch_7==STRING(L"OCast",5)) ||  ( _switch_7==STRING(L"OAsType",7)) ||  ( _switch_7==STRING(L"OIsType",7))){
						String v = __this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"v",1)).Add(STRING(L"c",1)).Add(STRING(L"cast",4)).Add(STRING(L"p",1)).Add(STRING(L"d",1)).Add(STRING(L"t",1)));
						return v == STRING(L"#arrayProp",10) ? format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->arrayProp)) ) : format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<format::abc::Index >::__new().Add(__this->ctx->type(__this->getImport(v)))) );
					}
					else if (  ( _switch_7==STRING(L"OCallSuper",10)) ||  ( _switch_7==STRING(L"OCallProperty",13)) ||  ( _switch_7==STRING(L"OConstructProperty",18)) ||  ( _switch_7==STRING(L"OCallPropLex",12)) ||  ( _switch_7==STRING(L"OCallSuperVoid",14)) ||  ( _switch_7==STRING(L"OCallPropVoid",13))){
						String p = __this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"type",4)).Add(STRING(L"name",4)).Add(STRING(L"p",1)));
						Dynamic nargs = Std_obj::parseInt(o->get(STRING(L"nargs",5)));
						return p == STRING(L"#arrayProp",10) ? format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(__this->ctx->arrayProp).Add(nargs)) ) : format::abc::OpCode( Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(__this->ctx->type(__this->getImport(p))).Add(nargs)) );
					}
					else if (  ( _switch_7==STRING(L"ORegKill",8)) ||  ( _switch_7==STRING(L"OReg",4)) ||  ( _switch_7==STRING(L"OIncrReg",8)) ||  ( _switch_7==STRING(L"ODecrReg",8)) ||  ( _switch_7==STRING(L"OIncrIReg",9)) ||  ( _switch_7==STRING(L"ODecrIReg",9)) ||  ( _switch_7==STRING(L"OSmallInt",9)) ||  ( _switch_7==STRING(L"OInt",4)) ||  ( _switch_7==STRING(L"OGetScope",9)) ||  ( _switch_7==STRING(L"ODebugLine",10)) ||  ( _switch_7==STRING(L"OBreakPointLine",15)) ||  ( _switch_7==STRING(L"OUnknown",8)) ||  ( _switch_7==STRING(L"OCallStack",10)) ||  ( _switch_7==STRING(L"OConstruct",10)) ||  ( _switch_7==STRING(L"OConstructSuper",15)) ||  ( _switch_7==STRING(L"OApplyType",10)) ||  ( _switch_7==STRING(L"OObject",7)) ||  ( _switch_7==STRING(L"OArray",6)) ||  ( _switch_7==STRING(L"OGetSlot",8)) ||  ( _switch_7==STRING(L"OSetSlot",8)) ||  ( _switch_7==STRING(L"OGetGlobalSlot",14)) ||  ( _switch_7==STRING(L"OSetGlobalSlot",14))){
						Dynamic v = Std_obj::parseInt(__this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"c",1)).Add(STRING(L"r",1)).Add(STRING(L"v",1)).Add(STRING(L"n",1)).Add(STRING(L"s",1)).Add(STRING(L"line",4)).Add(STRING(L"byte",4)).Add(STRING(L"nargs",5)).Add(STRING(L"nfields",7)).Add(STRING(L"nvalues",7))));
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(v));
					}
					else if (  ( _switch_7==STRING(L"OCatch",6))){
						Dynamic _try = hxAnon_obj::Create()->Add( STRING(L"start",5) , Std_obj::parseInt(o->get(STRING(L"start",5))))->Add( STRING(L"end",3) , Std_obj::parseInt(o->get(STRING(L"end",3))))->Add( STRING(L"handle",6) , Std_obj::parseInt(o->get(STRING(L"handle",6))))->Add( STRING(L"type",4) , __this->ctx->type(__this->getImport(o->get(STRING(L"type",4)))))->Add( STRING(L"variable",8) , __this->ctx->type(__this->getImport(o->get(STRING(L"variable",8)))));
						f->__Field(STRING(L"trys",4))->__Field(STRING(L"push",4))(_try);
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<int >::__new().Add(f->__Field(STRING(L"trys",4))->__Field(STRING(L"length",6)).Cast<int >() - 1));
					}
					else if (  ( _switch_7==STRING(L"OSetReg",7))){
						__this->ctx->allocRegister();
						Dynamic v = Std_obj::parseInt(__this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"r",1)).Add(STRING(L"v",1))));
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(v));
					}
					else if (  ( _switch_7==STRING(L"OpAs",4)) ||  ( _switch_7==STRING(L"OpNeg",5)) ||  ( _switch_7==STRING(L"OpIncr",6)) ||  ( _switch_7==STRING(L"OpDecr",6)) ||  ( _switch_7==STRING(L"OpNot",5)) ||  ( _switch_7==STRING(L"OpBitNot",8)) ||  ( _switch_7==STRING(L"OpAdd",5)) ||  ( _switch_7==STRING(L"OpSub",5)) ||  ( _switch_7==STRING(L"OpMul",5)) ||  ( _switch_7==STRING(L"OpDiv",5)) ||  ( _switch_7==STRING(L"OpMod",5)) ||  ( _switch_7==STRING(L"OpShl",5)) ||  ( _switch_7==STRING(L"OpShr",5)) ||  ( _switch_7==STRING(L"OpUShr",6)) ||  ( _switch_7==STRING(L"OpAnd",5)) ||  ( _switch_7==STRING(L"OpOr",4)) ||  ( _switch_7==STRING(L"OpXor",5)) ||  ( _switch_7==STRING(L"OpEq",4)) ||  ( _switch_7==STRING(L"OpPhysEq",8)) ||  ( _switch_7==STRING(L"OpLt",4)) ||  ( _switch_7==STRING(L"OpLte",5)) ||  ( _switch_7==STRING(L"OpGt",4)) ||  ( _switch_7==STRING(L"OpGte",5)) ||  ( _switch_7==STRING(L"OpIs",4)) ||  ( _switch_7==STRING(L"OpIn",4)) ||  ( _switch_7==STRING(L"OpIIncr",7)) ||  ( _switch_7==STRING(L"OpIDecr",7)) ||  ( _switch_7==STRING(L"OpINeg",6)) ||  ( _switch_7==STRING(L"OpIAdd",6)) ||  ( _switch_7==STRING(L"OpISub",6)) ||  ( _switch_7==STRING(L"OpIMul",6)) ||  ( _switch_7==STRING(L"OpMemGet8",9)) ||  ( _switch_7==STRING(L"OpMemGet16",10)) ||  ( _switch_7==STRING(L"OpMemGet32",10)) ||  ( _switch_7==STRING(L"OpMemGetFloat",13)) ||  ( _switch_7==STRING(L"OpMemGetDouble",14)) ||  ( _switch_7==STRING(L"OpMemSet8",9)) ||  ( _switch_7==STRING(L"OpMemSet16",10)) ||  ( _switch_7==STRING(L"OpMemSet32",10)) ||  ( _switch_7==STRING(L"OpMemSetFloat",13)) ||  ( _switch_7==STRING(L"OpMemSetDouble",14)) ||  ( _switch_7==STRING(L"OpSign1",7)) ||  ( _switch_7==STRING(L"OpSign8",7)) ||  ( _switch_7==STRING(L"OpSign16",8))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),STRING(L"OOp",3),Array_obj<format::abc::Operation >::__new().Add(Type_obj::createEnum(hxClassOf<format::abc::Operation >(),o->getNodeName(),null())));
					}
					else if (  ( _switch_7==STRING(L"OOp",3))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),STRING(L"OOp",3),Array_obj<format::abc::Operation >::__new().Add(Type_obj::createEnum(hxClassOf<format::abc::Operation >(),__this->getAnyAttribute(o,Array_obj<String >::__new().Add(STRING(L"type",4)).Add(STRING(L"op",2)).Add(STRING(L"args",4))),null())));
					}
					else if (  ( _switch_7==STRING(L"OCallStatic",11))){
						format::abc::Index meth = format::abc::Index_obj::Idx(Std_obj::parseInt(o->get(STRING(L"meth",4))));
						Dynamic nargs = Std_obj::parseInt(o->get(STRING(L"nargs",5)));
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(meth).Add(nargs));
					}
					else if (  ( _switch_7==STRING(L"OCallMethod",11))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(Std_obj::parseInt(o->get(STRING(L"s",1)))).Add(Std_obj::parseInt(o->get(STRING(L"nargs",5)))));
					}
					else if (  ( _switch_7==STRING(L"OJump",5))){
						String jumpName = o->get(STRING(L"name",4));
						struct _Function_2{
							static format::abc::OpCode Block( be::haxer::hxswfml::Hxavm2_obj *__this,String &jumpName)/* DEF (ret block)(not intern) */{
								__this->jumps->get(jumpName)();
								if (__this->log)
									__this->logStack(STRING(L"OJump name=",11) + jumpName);
								return null();
							}
						};
						struct _Function_3{
							static format::abc::OpCode Block( cpp::CppXml__ &o)/* DEF (ret block)(not intern) */{
								format::abc::JumpStyle j = Type_obj::createEnum(hxClassOf<format::abc::JumpStyle >(),o->get(STRING(L"jump",4)),Array_obj<Dynamic >::__new());
								Dynamic offset = Std_obj::parseInt(o->get(STRING(L"offset",6)));
								return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(j).Add(offset));
							}
						};
						return jumpName != null() ? format::abc::OpCode( _Function_2::Block(__this,jumpName) ) : format::abc::OpCode( _Function_3::Block(o) );
					}
					else if (  ( _switch_7==STRING(L"JNotLt",6)) ||  ( _switch_7==STRING(L"JNotLte",7)) ||  ( _switch_7==STRING(L"JNotGt",6)) ||  ( _switch_7==STRING(L"JNotGte",7)) ||  ( _switch_7==STRING(L"JAlways",7)) ||  ( _switch_7==STRING(L"JTrue",5)) ||  ( _switch_7==STRING(L"JFalse",6)) ||  ( _switch_7==STRING(L"JEq",3)) ||  ( _switch_7==STRING(L"JNeq",4)) ||  ( _switch_7==STRING(L"JLt",3)) ||  ( _switch_7==STRING(L"JLte",4)) ||  ( _switch_7==STRING(L"JGt",3)) ||  ( _switch_7==STRING(L"JGte",4)) ||  ( _switch_7==STRING(L"JPhysEq",7)) ||  ( _switch_7==STRING(L"JPhysNeq",8))){
						format::abc::JumpStyle jump = Type_obj::createEnum(hxClassOf<format::abc::JumpStyle >(),o->getNodeName(),null());
						String jumpName = o->get(STRING(L"jump",4));
						String labelName = o->get(STRING(L"label",5));
						if (jumpName != null())
							__this->jumps->set(jumpName,__this->ctx->jump(jump));
						else
							if (labelName != null())
							__this->labels->get(labelName)(jump);
;
						__this->updateStacks(format::abc::OpCode_obj::OJump(jump,0));
						return null();
					}
					else if (  ( _switch_7==STRING(L"OLabel",6))){
						struct _Function_2{
							static format::abc::OpCode Block( be::haxer::hxswfml::Hxavm2_obj *__this,cpp::CppXml__ &o)/* DEF (ret block)(not intern) */{
								if (__this->log)
									__this->logStack(STRING(L"OLabel name=",12) + o->get(STRING(L"name",4)));
								__this->updateStacks(format::abc::OpCode_obj::OLabel);
								__this->labels->set(o->get(STRING(L"name",4)),__this->ctx->backwardJump());
								return null();
							}
						};
						struct _Function_3{
							static format::abc::OpCode Block( cpp::CppXml__ &o)/* DEF (ret block)(not intern) */{
								return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new());
							}
						};
						return o->get(STRING(L"name",4)) != null() ? format::abc::OpCode( _Function_2::Block(__this,o) ) : format::abc::OpCode( _Function_3::Block(o) );
					}
					else if (  ( _switch_7==STRING(L"OSwitch",7))){
						Array<String > arr = o->get(STRING(L"deltas",6)).split(STRING(L",",1));
						Array<int > deltas = Array_obj<int >::__new();
						{
							int _g = 0;
							while(_g < arr->length){
								String i = arr->__get(_g);
								++_g;
								deltas->push(Std_obj::parseInt(i));
							}
						}
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(Std_obj::parseInt(o->get(STRING(L"def",3)))).Add(deltas));
					}
					else if (  ( _switch_7==STRING(L"ONext",5))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(Std_obj::parseInt(o->get(STRING(L"r1",2)))).Add(Std_obj::parseInt(o->get(STRING(L"r2",2)))));
					}
					else if (  ( _switch_7==STRING(L"ODebugReg",9))){
						return Type_obj::createEnum(hxClassOf<format::abc::OpCode >(),o->getNodeName(),Array_obj<Dynamic >::__new().Add(__this->ctx->string(o->get(STRING(L"name",4)))).Add(Std_obj::parseInt(o->get(STRING(L"r",1)))).Add(Std_obj::parseInt(o->get(STRING(L"line",4)))));
					}
					else  {
						return hxThrow ((o->getNodeName() + STRING(L" Unknown opcode.",16)));
					}
;
;
				}
			};
			format::abc::OpCode op = _Function_1::Block(this,o,f);
			if (op != null()){
				this->updateStacks(op);
				this->ctx->op(op);
			}
		}
;
	}
	return true;
}


DEFINE_DYNAMIC_FUNC2(Hxavm2_obj,writeCodeBlock,return )

String Hxavm2_obj::abc2xml( Dynamic abc){
	return STRING(L"",0);
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,abc2xml,return )

String Hxavm2_obj::getImport( String name){
	if (this->imports->exists(name))
		return this->imports->get(name).Cast<String >();
	return name;
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,getImport,return )

format::abc::Index Hxavm2_obj::namespaceType( String ns){
	struct _Function_1{
		static format::abc::Namespace Block( String &ns,be::haxer::hxswfml::Hxavm2_obj *__this)/* DEF (not block)(ret intern) */{
			String _switch_8 = (ns);
			if (  ( _switch_8==STRING(L"public",6))){
				return format::abc::Namespace_obj::NPublic(__this->ctx->string(STRING(L"",0)));
			}
			else if (  ( _switch_8==STRING(L"private",7))){
				return format::abc::Namespace_obj::NPrivate(__this->ctx->string(STRING(L"*",1)));
			}
			else if (  ( _switch_8==STRING(L"protected",9))){
				return format::abc::Namespace_obj::NProtected(__this->ctx->string(__this->curClassName));
			}
			else if (  ( _switch_8==STRING(L"internal",8))){
				return format::abc::Namespace_obj::NInternal(__this->ctx->string(STRING(L"",0)));
			}
			else if (  ( _switch_8==STRING(L"namespace",9))){
				return format::abc::Namespace_obj::NNamespace(__this->ctx->string(__this->curClassName));
			}
			else if (  ( _switch_8==STRING(L"explicit",8))){
				return format::abc::Namespace_obj::NExplicit(__this->ctx->string(STRING(L"",0)));
			}
			else if (  ( _switch_8==STRING(L"staticProtected",15))){
				return format::abc::Namespace_obj::NStaticProtected(__this->ctx->string(__this->curClassName));
			}
			else  {
				return format::abc::Namespace_obj::NPublic(__this->ctx->string(STRING(L"",0)));
			}
;
;
		}
	};
	return this->ctx->namespace(_Function_1::Block(ns,this));
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,namespaceType,return )

String Hxavm2_obj::getAnyAttribute( Dynamic element,Array<String > arr){
	{
		int _g1 = 0;
		int _g = arr->length;
		while(_g1 < _g){
			int i = _g1++;
			if (element->__Field(STRING(L"get",3))(arr->__get(i)) != null())
				return element->__Field(STRING(L"get",3))(arr->__get(i));
		}
	}
	hxThrow ((STRING(L"Missing attribute on element. Valid attributes are:",51) + arr->toString()));
}


DEFINE_DYNAMIC_FUNC2(Hxavm2_obj,getAnyAttribute,return )

Array<Dynamic > Hxavm2_obj::parseLocals( String locals){
	Array<String > locs = locals.split(STRING(L",",1));
	Array<Dynamic > out = Array_obj<Dynamic >::__new();
	int index = 1;
	{
		int _g = 0;
		while(_g < locs->length){
			String l = locs->__get(_g);
			++_g;
			Array<String > props = l.split(STRING(L":",1));
			out->push(hxAnon_obj::Create()->Add( STRING(L"name",4) , this->ctx->type(this->getImport(props->__get(0))))->Add( STRING(L"slot",4) , index)->Add( STRING(L"kind",4) , this->parseFieldKind(l))->Add( STRING(L"metadatas",9) , null()));
			index++;
		}
	}
	return out;
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,parseLocals,return )

format::abc::FieldKind Hxavm2_obj::parseFieldKind( String fld){
	return format::abc::FieldKind_obj::FVar(null(),null(),null());
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,parseFieldKind,return )

Void Hxavm2_obj::nonEmptyStack( String fname){
{
		String msg = STRING(L"!Possible error: Function ",26) + fname + STRING(L" did not end with empty stack. current stack: ",46) + this->currentStack;
		if (this->throwsErrors)
			hxThrow ((msg));
		if (this->log)
			this->logStack(msg);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,nonEmptyStack,(void))

Void Hxavm2_obj::stackError( format::abc::OpCode op,int type){
{
		Enum o = Type_obj::getEnum(op);
		String msg = type == 0 ? String( STRING(L"!Possible error: stack underflow: ",34) + op ) : String( STRING(L"!Possible error: stack overflow: ",33) + op );
		if (this->throwsErrors)
			hxThrow ((msg));
		if (this->log)
			this->logStack(msg);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Hxavm2_obj,stackError,(void))

Void Hxavm2_obj::scopeStackError( format::abc::OpCode op,int type){
{
		Enum o = Type_obj::getEnum(op);
		String msg = type == 0 ? String( STRING(L"!Possible error: scopeStack underflow: ",39) + op ) : String( STRING(L"!Possible error: scopeStack overflow: ",38) + op );
		if (this->throwsErrors)
			hxThrow ((msg));
		if (this->log)
			this->logStack(msg);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Hxavm2_obj,scopeStackError,(void))

Void Hxavm2_obj::logStack( Dynamic msg){
{
		haxe::Log_obj::trace(msg,hxAnon_obj::Create()->Add( STRING(L"fileName",8) , STRING(L"Hxavm2.hx",9))->Add( STRING(L"lineNumber",10) , 564)->Add( STRING(L"className",9) , STRING(L"be.haxer.hxswfml.Hxavm2",23))->Add( STRING(L"methodName",10) , STRING(L"logStack",8)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,logStack,(void))

Void Hxavm2_obj::updateStacks( format::abc::OpCode opc){
{
		if (this->log)
			this->logStack(opc);
		format::abc::OpCode _switch_9 = (opc);
		switch((_switch_9)->GetIndex()){
			case 0: {
			}
			break;
			case 1: {
			}
			break;
			case 2: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
			}
			break;
			case 3: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					++this->currentStack;
				}
			}
			break;
			case 4: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,2)) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 5: {
				format::abc::Index i = _switch_9->__Param(0);
{
				}
			}
			break;
			case 6: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
			}
			break;
			case 7: {
				int r = _switch_9->__Param(0);
{
				}
			}
			break;
			case 8: {
			}
			break;
			case 9: {
				String name = _switch_9->__Param(0);
{
				}
			}
			break;
			case 10: {
				int delta = _switch_9->__Param(1);
				format::abc::JumpStyle j = _switch_9->__Param(0);
{
					format::abc::JumpStyle _switch_10 = (j);
					switch((_switch_10)->GetIndex()){
						case 4: {
						}
						break;
						case 5: case 6: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
						}
						break;
						case 0: case 1: case 2: case 3: case 7: case 8: case 9: case 10: case 11: case 12: case 13: case 14: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
						}
						break;
					}
				}
			}
			break;
			case 11: {
				int offset = _switch_9->__Param(2);
				String landingName = _switch_9->__Param(1);
				format::abc::JumpStyle j = _switch_9->__Param(0);
{
				}
			}
			break;
			case 12: {
				String landingName = _switch_9->__Param(0);
{
				}
			}
			break;
			case 13: {
				Array<int > deltas = _switch_9->__Param(1);
				int def = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 14: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->maxScopeStack++;
			}
			break;
			case 15: {
				if (--this->currentScopeStack < 0)
					this->scopeStackError(opc,0);
			}
			break;
			case 16: {
				if ((hxSubEq(this->currentStack,2)) < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 17: {
				if ((hxSubEq(this->currentStack,2)) < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 18: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 19: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 20: {
				if ((hxSubEq(this->currentStack,2)) < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 21: {
				int v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 22: {
				int v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 23: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 24: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 25: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 26: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
			}
			break;
			case 27: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 28: {
				if ((hxSubEq(this->currentStack,2)) < 0)
					this->stackError(opc,0);
				hxAddEq(this->currentStack,2);
			}
			break;
			case 29: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 30: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 31: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 32: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 33: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentScopeStack++;
				this->maxScopeStack++;
			}
			break;
			case 34: {
				format::abc::Index v = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 35: {
				int r2 = _switch_9->__Param(1);
				int r1 = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 36: {
				format::abc::Index f = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 37: {
				int n = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 2))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 38: {
				int n = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 39: {
				int n = _switch_9->__Param(1);
				int s = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 40: {
				int n = _switch_9->__Param(1);
				format::abc::Index m = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 41: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 42: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 43: {
			}
			break;
			case 44: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
			}
			break;
			case 45: {
				int n = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 46: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 47: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 48: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 49: {
				int n = _switch_9->__Param(1);
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n + 1))) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 50: {
				int n = _switch_9->__Param(0);
{
				}
			}
			break;
			case 51: {
				int n = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,(n * 2))) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 52: {
				int n = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,n)) < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 53: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 54: {
				format::abc::Index c = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 55: {
				format::abc::Index i = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 56: {
				int c = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 57: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 58: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 59: {
				format::abc::Index d = _switch_9->__Param(0);
{
				}
			}
			break;
			case 60: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 61: {
				format::abc::Index p = _switch_9->__Param(0);
{
					int popCount = 2;
					if (p == this->ctx->arrayProp)
						popCount = 3;
					if ((hxSubEq(this->currentStack,popCount)) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 62: {
				int r = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
					switch( (int)(r)){
						case 0: {
						}
						break;
						case 1: {
						}
						break;
						case 2: {
						}
						break;
						case 3: {
						}
						break;
						default: {
						}
					}
				}
			}
			break;
			case 63: {
				int r = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					switch( (int)(r)){
						case 0: {
						}
						break;
						case 1: {
						}
						break;
						case 2: {
						}
						break;
						case 3: {
						}
						break;
						default: {
						}
					}
				}
			}
			break;
			case 64: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 65: {
				int n = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 66: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if (p == this->ctx->arrayProp)
						if (--this->currentStack < 0)
						this->stackError(opc,0);
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 67: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,2)) < 0){
						this->stackError(opc,0);
					}
				}
			}
			break;
			case 68: {
				format::abc::Index p = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 69: {
				int s = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 70: {
				int s = _switch_9->__Param(0);
{
					if ((hxSubEq(this->currentStack,2)) < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 71: {
				int s = _switch_9->__Param(0);
{
					if (++this->currentStack > this->maxStack)
						this->maxStack++;
				}
			}
			break;
			case 72: {
				int s = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
				}
			}
			break;
			case 73: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 74: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 75: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 76: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 77: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 78: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 79: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 80: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 81: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 82: {
				format::abc::Index t = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 83: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 84: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 85: {
				format::abc::Index t = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 86: {
			}
			break;
			case 87: {
				int r = _switch_9->__Param(0);
{
				}
			}
			break;
			case 88: {
				int r = _switch_9->__Param(0);
{
				}
			}
			break;
			case 89: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 90: {
				if ((hxSubEq(this->currentStack,2)) < 0)
					this->stackError(opc,0);
				this->currentStack++;
			}
			break;
			case 91: {
				format::abc::Index t = _switch_9->__Param(0);
{
					if (--this->currentStack < 0)
						this->stackError(opc,0);
					this->currentStack++;
				}
			}
			break;
			case 92: {
				int r = _switch_9->__Param(0);
{
				}
			}
			break;
			case 93: {
				int r = _switch_9->__Param(0);
{
				}
			}
			break;
			case 94: {
				if (++this->currentStack > this->maxStack)
					this->maxStack++;
			}
			break;
			case 95: {
				if (--this->currentStack < 0)
					this->stackError(opc,0);
			}
			break;
			case 96: {
				int line = _switch_9->__Param(2);
				int r = _switch_9->__Param(1);
				format::abc::Index name = _switch_9->__Param(0);
{
				}
			}
			break;
			case 97: {
				int line = _switch_9->__Param(0);
{
				}
			}
			break;
			case 98: {
				format::abc::Index file = _switch_9->__Param(0);
{
				}
			}
			break;
			case 99: {
				int n = _switch_9->__Param(0);
{
				}
			}
			break;
			case 100: {
			}
			break;
			case 101: {
				format::abc::Operation op = _switch_9->__Param(0);
{
					format::abc::Operation _switch_11 = (op);
					switch((_switch_11)->GetIndex()){
						case 0: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 1: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 2: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 3: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 4: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 5: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 6: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 7: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 8: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 9: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 10: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 11: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 12: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 13: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 14: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 15: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 16: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 17: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 18: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 19: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 20: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 21: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 22: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 23: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 24: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 25: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 26: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 27: {
							if (--this->currentStack < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 28: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 29: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 30: {
							if ((hxSubEq(this->currentStack,2)) < 0)
								this->stackError(opc,0);
							this->currentStack++;
						}
						break;
						case 31: {
						}
						break;
						case 32: {
						}
						break;
						case 33: {
						}
						break;
						case 34: {
						}
						break;
						case 35: {
						}
						break;
						case 36: {
						}
						break;
						case 37: {
						}
						break;
						case 38: {
						}
						break;
						case 39: {
						}
						break;
						case 40: {
						}
						break;
						case 41: {
						}
						break;
						case 42: {
						}
						break;
						case 43: {
						}
						break;
					}
				}
			}
			break;
			case 102: {
				int byte = _switch_9->__Param(0);
{
				}
			}
			break;
		}
		if (this->log)
			this->logStack(STRING(L"currentStack= ",14) + this->currentStack + STRING(L", maxStack= ",12) + this->maxStack + STRING(L"\ncurrentScopeStack= ",20) + this->currentScopeStack + STRING(L", maxScopeStack= ",17) + this->maxScopeStack + STRING(L"\n\n",2));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Hxavm2_obj,updateStacks,(void))


Hxavm2_obj::Hxavm2_obj()
{
	InitMember(log);
	InitMember(throwsErrors);
	InitMember(name);
	InitMember(ctx);
	InitMember(className);
	InitMember(curClassName);
	InitMember(curClass);
	InitMember(maxStack);
	InitMember(maxScopeStack);
	InitMember(currentStack);
	InitMember(currentScopeStack);
	InitMember(imports);
	InitMember(functionClosures);
	InitMember(inits);
	InitMember(classDefs);
	InitMember(jumps);
	InitMember(labels);
}

void Hxavm2_obj::__Mark()
{
	MarkMember(log);
	MarkMember(throwsErrors);
	MarkMember(name);
	MarkMember(ctx);
	MarkMember(className);
	MarkMember(curClassName);
	MarkMember(curClass);
	MarkMember(maxStack);
	MarkMember(maxScopeStack);
	MarkMember(currentStack);
	MarkMember(currentScopeStack);
	MarkMember(imports);
	MarkMember(functionClosures);
	MarkMember(inits);
	MarkMember(classDefs);
	MarkMember(jumps);
	MarkMember(labels);
}

Dynamic Hxavm2_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"log",sizeof(wchar_t)*3) ) { return log; }
		if (!memcmp(inName.__s,L"ctx",sizeof(wchar_t)*3) ) { return ctx; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"name",sizeof(wchar_t)*4) ) { return name; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"inits",sizeof(wchar_t)*5) ) { return inits; }
		if (!memcmp(inName.__s,L"jumps",sizeof(wchar_t)*5) ) { return jumps; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"labels",sizeof(wchar_t)*6) ) { return labels; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"imports",sizeof(wchar_t)*7) ) { return imports; }
		if (!memcmp(inName.__s,L"xml2abc",sizeof(wchar_t)*7) ) { return xml2abc_dyn(); }
		if (!memcmp(inName.__s,L"abc2xml",sizeof(wchar_t)*7) ) { return abc2xml_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"curClass",sizeof(wchar_t)*8) ) { return curClass; }
		if (!memcmp(inName.__s,L"maxStack",sizeof(wchar_t)*8) ) { return maxStack; }
		if (!memcmp(inName.__s,L"xmlToabc",sizeof(wchar_t)*8) ) { return xmlToabc_dyn(); }
		if (!memcmp(inName.__s,L"logStack",sizeof(wchar_t)*8) ) { return logStack_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"className",sizeof(wchar_t)*9) ) { return className; }
		if (!memcmp(inName.__s,L"classDefs",sizeof(wchar_t)*9) ) { return classDefs; }
		if (!memcmp(inName.__s,L"getImport",sizeof(wchar_t)*9) ) { return getImport_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"stackError",sizeof(wchar_t)*10) ) { return stackError_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"parseLocals",sizeof(wchar_t)*11) ) { return parseLocals_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"throwsErrors",sizeof(wchar_t)*12) ) { return throwsErrors; }
		if (!memcmp(inName.__s,L"curClassName",sizeof(wchar_t)*12) ) { return curClassName; }
		if (!memcmp(inName.__s,L"currentStack",sizeof(wchar_t)*12) ) { return currentStack; }
		if (!memcmp(inName.__s,L"updateStacks",sizeof(wchar_t)*12) ) { return updateStacks_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"maxScopeStack",sizeof(wchar_t)*13) ) { return maxScopeStack; }
		if (!memcmp(inName.__s,L"namespaceType",sizeof(wchar_t)*13) ) { return namespaceType_dyn(); }
		if (!memcmp(inName.__s,L"nonEmptyStack",sizeof(wchar_t)*13) ) { return nonEmptyStack_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"createFunction",sizeof(wchar_t)*14) ) { return createFunction_dyn(); }
		if (!memcmp(inName.__s,L"writeCodeBlock",sizeof(wchar_t)*14) ) { return writeCodeBlock_dyn(); }
		if (!memcmp(inName.__s,L"parseFieldKind",sizeof(wchar_t)*14) ) { return parseFieldKind_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"getAnyAttribute",sizeof(wchar_t)*15) ) { return getAnyAttribute_dyn(); }
		if (!memcmp(inName.__s,L"scopeStackError",sizeof(wchar_t)*15) ) { return scopeStackError_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"functionClosures",sizeof(wchar_t)*16) ) { return functionClosures; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"currentScopeStack",sizeof(wchar_t)*17) ) { return currentScopeStack; }
	}
	return super::__Field(inName);
}

static int __id_log = __hxcpp_field_to_id("log");
static int __id_throwsErrors = __hxcpp_field_to_id("throwsErrors");
static int __id_name = __hxcpp_field_to_id("name");
static int __id_ctx = __hxcpp_field_to_id("ctx");
static int __id_className = __hxcpp_field_to_id("className");
static int __id_curClassName = __hxcpp_field_to_id("curClassName");
static int __id_curClass = __hxcpp_field_to_id("curClass");
static int __id_maxStack = __hxcpp_field_to_id("maxStack");
static int __id_maxScopeStack = __hxcpp_field_to_id("maxScopeStack");
static int __id_currentStack = __hxcpp_field_to_id("currentStack");
static int __id_currentScopeStack = __hxcpp_field_to_id("currentScopeStack");
static int __id_imports = __hxcpp_field_to_id("imports");
static int __id_functionClosures = __hxcpp_field_to_id("functionClosures");
static int __id_inits = __hxcpp_field_to_id("inits");
static int __id_classDefs = __hxcpp_field_to_id("classDefs");
static int __id_jumps = __hxcpp_field_to_id("jumps");
static int __id_labels = __hxcpp_field_to_id("labels");
static int __id_xml2abc = __hxcpp_field_to_id("xml2abc");
static int __id_xmlToabc = __hxcpp_field_to_id("xmlToabc");
static int __id_createFunction = __hxcpp_field_to_id("createFunction");
static int __id_writeCodeBlock = __hxcpp_field_to_id("writeCodeBlock");
static int __id_abc2xml = __hxcpp_field_to_id("abc2xml");
static int __id_getImport = __hxcpp_field_to_id("getImport");
static int __id_namespaceType = __hxcpp_field_to_id("namespaceType");
static int __id_getAnyAttribute = __hxcpp_field_to_id("getAnyAttribute");
static int __id_parseLocals = __hxcpp_field_to_id("parseLocals");
static int __id_parseFieldKind = __hxcpp_field_to_id("parseFieldKind");
static int __id_nonEmptyStack = __hxcpp_field_to_id("nonEmptyStack");
static int __id_stackError = __hxcpp_field_to_id("stackError");
static int __id_scopeStackError = __hxcpp_field_to_id("scopeStackError");
static int __id_logStack = __hxcpp_field_to_id("logStack");
static int __id_updateStacks = __hxcpp_field_to_id("updateStacks");


Dynamic Hxavm2_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_log) return log;
	if (inFieldID==__id_throwsErrors) return throwsErrors;
	if (inFieldID==__id_name) return name;
	if (inFieldID==__id_ctx) return ctx;
	if (inFieldID==__id_className) return className;
	if (inFieldID==__id_curClassName) return curClassName;
	if (inFieldID==__id_curClass) return curClass;
	if (inFieldID==__id_maxStack) return maxStack;
	if (inFieldID==__id_maxScopeStack) return maxScopeStack;
	if (inFieldID==__id_currentStack) return currentStack;
	if (inFieldID==__id_currentScopeStack) return currentScopeStack;
	if (inFieldID==__id_imports) return imports;
	if (inFieldID==__id_functionClosures) return functionClosures;
	if (inFieldID==__id_inits) return inits;
	if (inFieldID==__id_classDefs) return classDefs;
	if (inFieldID==__id_jumps) return jumps;
	if (inFieldID==__id_labels) return labels;
	if (inFieldID==__id_xml2abc) return xml2abc_dyn();
	if (inFieldID==__id_xmlToabc) return xmlToabc_dyn();
	if (inFieldID==__id_createFunction) return createFunction_dyn();
	if (inFieldID==__id_writeCodeBlock) return writeCodeBlock_dyn();
	if (inFieldID==__id_abc2xml) return abc2xml_dyn();
	if (inFieldID==__id_getImport) return getImport_dyn();
	if (inFieldID==__id_namespaceType) return namespaceType_dyn();
	if (inFieldID==__id_getAnyAttribute) return getAnyAttribute_dyn();
	if (inFieldID==__id_parseLocals) return parseLocals_dyn();
	if (inFieldID==__id_parseFieldKind) return parseFieldKind_dyn();
	if (inFieldID==__id_nonEmptyStack) return nonEmptyStack_dyn();
	if (inFieldID==__id_stackError) return stackError_dyn();
	if (inFieldID==__id_scopeStackError) return scopeStackError_dyn();
	if (inFieldID==__id_logStack) return logStack_dyn();
	if (inFieldID==__id_updateStacks) return updateStacks_dyn();
	return super::__IField(inFieldID);
}

Dynamic Hxavm2_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"log",sizeof(wchar_t)*3) ) { log=inValue.Cast<bool >();return inValue; }
		if (!memcmp(inName.__s,L"ctx",sizeof(wchar_t)*3) ) { ctx=inValue.Cast<format::abc::Context >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"name",sizeof(wchar_t)*4) ) { name=inValue.Cast<String >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"inits",sizeof(wchar_t)*5) ) { inits=inValue.Cast<Hash >();return inValue; }
		if (!memcmp(inName.__s,L"jumps",sizeof(wchar_t)*5) ) { jumps=inValue.Cast<Hash >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"labels",sizeof(wchar_t)*6) ) { labels=inValue.Cast<Hash >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"imports",sizeof(wchar_t)*7) ) { imports=inValue.Cast<Hash >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"curClass",sizeof(wchar_t)*8) ) { curClass=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"maxStack",sizeof(wchar_t)*8) ) { maxStack=inValue.Cast<int >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"className",sizeof(wchar_t)*9) ) { className=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"classDefs",sizeof(wchar_t)*9) ) { classDefs=inValue.Cast<Hash >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"throwsErrors",sizeof(wchar_t)*12) ) { throwsErrors=inValue.Cast<bool >();return inValue; }
		if (!memcmp(inName.__s,L"curClassName",sizeof(wchar_t)*12) ) { curClassName=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"currentStack",sizeof(wchar_t)*12) ) { currentStack=inValue.Cast<int >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"maxScopeStack",sizeof(wchar_t)*13) ) { maxScopeStack=inValue.Cast<int >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"functionClosures",sizeof(wchar_t)*16) ) { functionClosures=inValue.Cast<Hash >();return inValue; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"currentScopeStack",sizeof(wchar_t)*17) ) { currentScopeStack=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Hxavm2_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"log",3));
	outFields->push(STRING(L"throwsErrors",12));
	outFields->push(STRING(L"name",4));
	outFields->push(STRING(L"ctx",3));
	outFields->push(STRING(L"className",9));
	outFields->push(STRING(L"curClassName",12));
	outFields->push(STRING(L"curClass",8));
	outFields->push(STRING(L"maxStack",8));
	outFields->push(STRING(L"maxScopeStack",13));
	outFields->push(STRING(L"currentStack",12));
	outFields->push(STRING(L"currentScopeStack",17));
	outFields->push(STRING(L"imports",7));
	outFields->push(STRING(L"functionClosures",16));
	outFields->push(STRING(L"inits",5));
	outFields->push(STRING(L"classDefs",9));
	outFields->push(STRING(L"jumps",5));
	outFields->push(STRING(L"labels",6));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"log",3),
	STRING(L"throwsErrors",12),
	STRING(L"name",4),
	STRING(L"ctx",3),
	STRING(L"className",9),
	STRING(L"curClassName",12),
	STRING(L"curClass",8),
	STRING(L"maxStack",8),
	STRING(L"maxScopeStack",13),
	STRING(L"currentStack",12),
	STRING(L"currentScopeStack",17),
	STRING(L"imports",7),
	STRING(L"functionClosures",16),
	STRING(L"inits",5),
	STRING(L"classDefs",9),
	STRING(L"jumps",5),
	STRING(L"labels",6),
	STRING(L"xml2abc",7),
	STRING(L"xmlToabc",8),
	STRING(L"createFunction",14),
	STRING(L"writeCodeBlock",14),
	STRING(L"abc2xml",7),
	STRING(L"getImport",9),
	STRING(L"namespaceType",13),
	STRING(L"getAnyAttribute",15),
	STRING(L"parseLocals",11),
	STRING(L"parseFieldKind",14),
	STRING(L"nonEmptyStack",13),
	STRING(L"stackError",10),
	STRING(L"scopeStackError",15),
	STRING(L"logStack",8),
	STRING(L"updateStacks",12),
	String(null()) };

static void sMarkStatics() {
};

Class Hxavm2_obj::__mClass;

void Hxavm2_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"be.haxer.hxswfml.Hxavm2",23), TCanCast<Hxavm2_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Hxavm2_obj::__boot()
{
}

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml
