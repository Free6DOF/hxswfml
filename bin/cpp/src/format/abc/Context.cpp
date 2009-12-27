#include <hxObject.h>

#ifndef INCLUDED_Hash
#include <Hash.h>
#endif
#ifndef INCLUDED_List
#include <List.h>
#endif
#ifndef INCLUDED_Type
#include <Type.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
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
#ifndef INCLUDED_format_abc_Name
#include <format/abc/Name.h>
#endif
#ifndef INCLUDED_format_abc_Namespace
#include <format/abc/Namespace.h>
#endif
#ifndef INCLUDED_format_abc_OpCode
#include <format/abc/OpCode.h>
#endif
#ifndef INCLUDED_format_abc_OpWriter
#include <format/abc/OpWriter.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
#ifndef INCLUDED_format_abc__Context_NullOutput
#include <format/abc/_Context/NullOutput.h>
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
namespace format{
namespace abc{

Void Context_obj::__construct()
{
{
	this->classSupers = List_obj::__new();
	this->bytepos = format::abc::_Context::NullOutput_obj::__new();
	this->opw = format::abc::OpWriter_obj::__new(this->bytepos);
	this->hstrings = Hash_obj::__new();
	this->data = format::abc::ABCData_obj::__new();
	this->data->ints = Array_obj<cpp::CppInt32__ >::__new();
	this->data->uints = Array_obj<cpp::CppInt32__ >::__new();
	this->data->floats = Array_obj<double >::__new();
	this->data->strings = Array_obj<String >::__new();
	this->data->namespaces = Array_obj<format::abc::Namespace >::__new();
	this->data->nssets = Array_obj<Array<format::abc::Index > >::__new();
	this->data->metadatas = Array_obj<Dynamic >::__new();
	this->data->methodTypes = Array_obj<Dynamic >::__new();
	this->data->names = Array_obj<format::abc::Name >::__new();
	this->data->classes = Array_obj<Dynamic >::__new();
	this->data->functions = Array_obj<Dynamic >::__new();
	this->emptyString = this->string(STRING(L"",0));
	this->nsPublic = this->namespace(format::abc::Namespace_obj::NPublic(this->emptyString));
	this->arrayProp = this->name(format::abc::Name_obj::NMultiLate(this->nsset(Array_obj<format::abc::Index >::__new().Add(this->nsPublic))));
	this->classes = Array_obj<Dynamic >::__new();
	this->data->inits = Array_obj<Dynamic >::__new();
}
;
	return null();
}

Context_obj::~Context_obj() { }

Dynamic Context_obj::__CreateEmpty() { return  new Context_obj; }
hxObjectPtr<Context_obj > Context_obj::__new()
{  hxObjectPtr<Context_obj > result = new Context_obj();
	result->__construct();
	return result;}

Dynamic Context_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Context_obj > result = new Context_obj();
	result->__construct();
	return result;}

format::abc::Index Context_obj::toInt( cpp::CppInt32__ i){
	return this->lookup(this->data->ints,i,hxClassOf<cpp::CppInt32__ >());
}


DEFINE_DYNAMIC_FUNC1(Context_obj,toInt,return )

format::abc::Index Context_obj::uint( cpp::CppInt32__ i){
	return this->lookup(this->data->uints,i,null());
}


DEFINE_DYNAMIC_FUNC1(Context_obj,uint,return )

format::abc::Index Context_obj::_float( double f){
	return this->lookup(this->data->floats,f,null());
}


DEFINE_DYNAMIC_FUNC1(Context_obj,_float,return )

format::abc::Index Context_obj::string( String s){
	Dynamic n = this->hstrings->get(s);
	if (n == null()){
		this->data->strings->push(s);
		n = this->data->strings->length;
		this->hstrings->set(s,n);
	}
	return format::abc::Index_obj::Idx(n);
}


DEFINE_DYNAMIC_FUNC1(Context_obj,string,return )

format::abc::Index Context_obj::namespace( format::abc::Namespace n){
	return this->elookup(this->data->namespaces,n);
}


DEFINE_DYNAMIC_FUNC1(Context_obj,namespace,return )

format::abc::Index Context_obj::nsset( Array<format::abc::Index > ns){
	{
		int _g1 = 0;
		int _g = this->data->nssets->length;
		while(_g1 < _g){
			int i = _g1++;
			Array<format::abc::Index > s = this->data->nssets->__get(i);
			if (s->length != ns->length)
				continue;
			bool ok = true;
			{
				int _g3 = 0;
				int _g2 = s->length;
				while(_g3 < _g2){
					int j = _g3++;
					if (!Type_obj::enumEq(s->__get(j),ns->__get(j))){
						ok = false;
						break;
					}
				}
			}
			if (ok)
				return format::abc::Index_obj::Idx(i + 1);
		}
	}
	this->data->nssets->push(ns);
	return format::abc::Index_obj::Idx(this->data->nssets->length);
}


DEFINE_DYNAMIC_FUNC1(Context_obj,nsset,return )

format::abc::Index Context_obj::name( format::abc::Name n){
	return this->elookup(this->data->names,n);
}


DEFINE_DYNAMIC_FUNC1(Context_obj,name,return )

format::abc::Index Context_obj::getClass( Dynamic n){
	{
		int _g1 = 0;
		int _g = this->data->classes->length;
		while(_g1 < _g){
			int i = _g1++;
			if (this->data->classes->__get(i) == n)
				return format::abc::Index_obj::Idx(i);
		}
	}
	hxThrow ((STRING(L"unknown class: ",15) + n));
}


DEFINE_DYNAMIC_FUNC1(Context_obj,getClass,return )

format::abc::Index Context_obj::type( String path){
	if (bool(path != null()) && bool(path.indexOf(STRING(L" params:",8),null()) != -1))
		return this->typeParams(path);
	if (path == STRING(L"*",1))
		return null();
	Array<String > patharr = path.split(STRING(L".",1));
	String cname = patharr->pop();
	String ns = patharr->join(STRING(L".",1));
	format::abc::Index pid = this->string(ns);
	format::abc::Index nameid = this->string(cname);
	format::abc::Index pid1 = this->namespace(format::abc::Namespace_obj::NPublic(pid));
	format::abc::Index tid = this->name(format::abc::Name_obj::NName(nameid,pid1));
	return tid;
}


DEFINE_DYNAMIC_FUNC1(Context_obj,type,return )

format::abc::Index Context_obj::typeParams( String path){
	if (path == STRING(L"*",1))
		return null();
	Array<String > parts = path.split(STRING(L" params:",8));
	String _path = parts->__get(0);
	format::abc::Index __path = this->type(_path);
	Array<String > _params = parts[1].split(STRING(L",",1));
	Array<format::abc::Index > __params = Array_obj<format::abc::Index >::__new();
	{
		int _g1 = 0;
		int _g = _params->length;
		while(_g1 < _g){
			int i = _g1++;
			__params->push(this->type(_params->__get(i)));
		}
	}
	format::abc::Index tid = this->name(format::abc::Name_obj::NParams(__path,__params));
	return tid;
}


DEFINE_DYNAMIC_FUNC1(Context_obj,typeParams,return )

format::abc::Index Context_obj::property( String pname,format::abc::Index ns){
	format::abc::Index tid;
	if (pname.indexOf(STRING(L".",1),null()) != -1){
		tid = this->type(pname);
	}
	else{
		format::abc::Index pid = this->string(STRING(L"",0));
		format::abc::Index nameid = this->string(pname);
		format::abc::Index pid1 = ns == null() ? format::abc::Index( this->namespace(format::abc::Namespace_obj::NPublic(pid)) ) : format::abc::Index( ns );
		tid = this->name(format::abc::Name_obj::NName(nameid,pid1));
	}
	return tid;
}


DEFINE_DYNAMIC_FUNC2(Context_obj,property,return )

format::abc::Index Context_obj::methodType( Dynamic m){
	this->data->methodTypes->push(m);
	return format::abc::Index_obj::Idx(this->data->methodTypes->length - 1);
}


DEFINE_DYNAMIC_FUNC1(Context_obj,methodType,return )

format::abc::Index Context_obj::lookup( Array<Dynamic > arr,Dynamic n,Class type){
	if (type == hxClassOf<cpp::CppInt32__ >()){
		{
			int _g1 = 0;
			int _g = arr->length;
			while(_g1 < _g){
				int i = _g1++;
				if (cpp::CppInt32___obj::compare(arr->__get(i),cpp::CppInt32___obj::ofInt(n)) == 0)
					return format::abc::Index_obj::Idx(i + 1);
			}
		}
	}
	else{
		{
			int _g1 = 0;
			int _g = arr->length;
			while(_g1 < _g){
				int i = _g1++;
				if (arr->__get(i) == n)
					return format::abc::Index_obj::Idx(i + 1);
			}
		}
	}
	arr->push(n);
	return format::abc::Index_obj::Idx(arr->length);
}


DEFINE_DYNAMIC_FUNC3(Context_obj,lookup,return )

format::abc::Index Context_obj::elookup( Array<Dynamic > arr,Dynamic n){
	{
		int _g1 = 0;
		int _g = arr->length;
		while(_g1 < _g){
			int i = _g1++;
			if (Type_obj::enumEq(arr->__get(i),n))
				return format::abc::Index_obj::Idx(i + 1);
		}
	}
	arr->push(n);
	return format::abc::Index_obj::Idx(arr->length);
}


DEFINE_DYNAMIC_FUNC2(Context_obj,elookup,return )

format::abc::ABCData Context_obj::getData( ){
	return this->data;
}


DEFINE_DYNAMIC_FUNC0(Context_obj,getData,return )

format::abc::Index Context_obj::beginInterfaceFunction( Array<format::abc::Index > args,format::abc::Index ret,Dynamic extra){
	this->endFunction();
	Dynamic f = hxAnon_obj::Create()->Add( STRING(L"type",4) , this->methodType(hxAnon_obj::Create()->Add( STRING(L"args",4) , args)->Add( STRING(L"ret",3) , ret)->Add( STRING(L"extra",5) , extra)))->Add( STRING(L"nRegs",5) , args->length + 1)->Add( STRING(L"initScope",9) , 0)->Add( STRING(L"maxScope",8) , 0)->Add( STRING(L"maxStack",8) , 0)->Add( STRING(L"code",4) , null())->Add( STRING(L"trys",4) , Array_obj<Dynamic >::__new())->Add( STRING(L"locals",6) , Array_obj<Dynamic >::__new());
	this->curFunction = hxAnon_obj::Create()->Add( STRING(L"f",1) , f)->Add( STRING(L"ops",3) , Array_obj<format::abc::OpCode >::__new());
	return format::abc::Index_obj::Idx(this->data->methodTypes->length - 1);
}


DEFINE_DYNAMIC_FUNC3(Context_obj,beginInterfaceFunction,return )

format::abc::Index Context_obj::beginFunction( Array<format::abc::Index > args,format::abc::Index ret,Dynamic extra){
	this->endFunction();
	Dynamic f = hxAnon_obj::Create()->Add( STRING(L"type",4) , this->methodType(hxAnon_obj::Create()->Add( STRING(L"args",4) , args)->Add( STRING(L"ret",3) , ret)->Add( STRING(L"extra",5) , extra)))->Add( STRING(L"nRegs",5) , args->length + 1)->Add( STRING(L"initScope",9) , 0)->Add( STRING(L"maxScope",8) , 0)->Add( STRING(L"maxStack",8) , 0)->Add( STRING(L"code",4) , null())->Add( STRING(L"trys",4) , Array_obj<Dynamic >::__new())->Add( STRING(L"locals",6) , Array_obj<Dynamic >::__new());
	this->curFunction = hxAnon_obj::Create()->Add( STRING(L"f",1) , f)->Add( STRING(L"ops",3) , Array_obj<format::abc::OpCode >::__new());
	this->data->functions->push(f);
	this->registers = Array_obj<bool >::__new();
	{
		int _g1 = 0;
		int _g = f->__Field(STRING(L"nRegs",5)).Cast<int >();
		while(_g1 < _g){
			int x = _g1++;
			this->registers->push(true);
		}
	}
	return format::abc::Index_obj::Idx(this->data->functions->length - 1);
}


DEFINE_DYNAMIC_FUNC3(Context_obj,beginFunction,return )

Void Context_obj::endFunction( ){
{
		if (this->curFunction == null())
			return null();
		haxe::io::Output old = this->opw->o;
		haxe::io::BytesOutput bytes = haxe::io::BytesOutput_obj::__new();
		this->opw->o = bytes;
		{
			int _g = 0;
			Array<format::abc::OpCode > _g1 = this->curFunction->__Field(STRING(L"ops",3)).Cast<Array<format::abc::OpCode > >();
			while(_g < _g1->length){
				format::abc::OpCode op = _g1->__get(_g);
				++_g;
				this->opw->write(op);
			}
		}
		this->curFunction->__Field(STRING(L"f",1)).FieldRef(STRING(L"code",4)) = bytes->getBytes();
		this->opw->o = old;
		this->curFunction = null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Context_obj,endFunction,(void))

int Context_obj::allocRegister( ){
	{
		int _g1 = 0;
		int _g = this->registers->length;
		while(_g1 < _g){
			int i = _g1++;
			if (!this->registers[i]){
				this->registers[i] = true;
				return i;
			}
		}
	}
	this->registers->push(true);
	this->curFunction->__Field(STRING(L"f",1)).FieldRef(STRING(L"nRegs",5))++;
	return this->registers->length - 1;
}


DEFINE_DYNAMIC_FUNC0(Context_obj,allocRegister,return )

Void Context_obj::freeRegister( int i){
{
		this->registers[i] = false;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Context_obj,freeRegister,(void))

Dynamic Context_obj::beginClass( String path,Dynamic isInterface){
	this->classSupers = List_obj::__new();
	if (!isInterface){
		this->beginFunction(Array_obj<format::abc::Index >::__new(),null(),null());
	}
	else{
		this->beginInterfaceFunction(Array_obj<format::abc::Index >::__new(),null(),null());
	}
	this->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OThis).Add(format::abc::OpCode_obj::OScope));
	this->init = this->curFunction;
	this->init->__Field(STRING(L"f",1)).FieldRef(STRING(L"maxStack",8)) = 2;
	this->init->__Field(STRING(L"f",1)).FieldRef(STRING(L"maxScope",8)) = 2;
	Dynamic script = hxAnon_obj::Create()->Add( STRING(L"method",6) , this->init->__Field(STRING(L"f",1))->__Field(STRING(L"type",4)).Cast<format::abc::Index >())->Add( STRING(L"fields",6) , Array_obj<Dynamic >::__new());
	this->data->inits->push(script);
	this->classes = script->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >();
	this->endClass(null());
	format::abc::Index tpath = this->type(path);
	this->fieldSlot = 1;
	this->curClass = hxAnon_obj::Create()->Add( STRING(L"name",4) , tpath)->Add( STRING(L"superclass",10) , this->type(STRING(L"Object",6)))->Add( STRING(L"interfaces",10) , Array_obj<format::abc::Index >::__new())->Add( STRING(L"isSealed",8) , false)->Add( STRING(L"isInterface",11) , false)->Add( STRING(L"isFinal",7) , false)->Add( STRING(L"namespace",9) , null())->Add( STRING(L"constructor",11) , null())->Add( STRING(L"statics",7) , null())->Add( STRING(L"fields",6) , Array_obj<Dynamic >::__new())->Add( STRING(L"staticFields",12) , Array_obj<Dynamic >::__new());
	this->data->classes->push(this->curClass);
	this->classes->push(hxAnon_obj::Create()->Add( STRING(L"name",4) , tpath)->Add( STRING(L"slot",4) , this->classes->length + 1)->Add( STRING(L"kind",4) , format::abc::FieldKind_obj::FClass(format::abc::Index_obj::Idx(this->data->classes->length - 1)))->Add( STRING(L"metadatas",9) , null()));
	this->curFunction = null();
	return this->curClass;
}


DEFINE_DYNAMIC_FUNC2(Context_obj,beginClass,return )

Void Context_obj::endClass( Dynamic __o_makeInit){
bool makeInit = __o_makeInit.Default(true);
{
		if (this->curClass == null())
			return null();
		this->endFunction();
		if (makeInit){
			this->curFunction = this->init;
			this->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OGetGlobalScope).Add(format::abc::OpCode_obj::OGetLex(this->type(STRING(L"Object",6)))));
			for(Dynamic __it = this->classSupers->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
format::abc::Index sup = __it->__Field(STRING(L"next",4))();
				this->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OScope).Add(format::abc::OpCode_obj::OGetLex(sup)));
			}
			this->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OScope).Add(format::abc::OpCode_obj::OGetLex(this->curClass->__Field(STRING(L"superclass",10)).Cast<format::abc::Index >())).Add(format::abc::OpCode_obj::OClassDef(format::abc::Index_obj::Idx(this->data->classes->length - 1))).Add(format::abc::OpCode_obj::OPopScope));
			for(Dynamic __it = this->classSupers->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
format::abc::Index sup = __it->__Field(STRING(L"next",4))();
				this->op(format::abc::OpCode_obj::OPopScope);
			}
			this->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OInitProp(this->curClass->__Field(STRING(L"name",4)).Cast<format::abc::Index >())));
			hxAddEq(this->curFunction->__Field(STRING(L"f",1)).FieldRef(STRING(L"maxScope",8)),this->classSupers->length);
			this->op(format::abc::OpCode_obj::ORetVoid);
			this->endFunction();
		}
		else{
			this->curFunction = this->init;
			this->op(format::abc::OpCode_obj::ORetVoid);
			this->endFunction();
		}
		if (this->curClass->__Field(STRING(L"statics",7)).Cast<format::abc::Index >() == null()){
			this->beginFunction(Array_obj<format::abc::Index >::__new(),null(),null());
			format::abc::Index st = this->curFunction->__Field(STRING(L"f",1))->__Field(STRING(L"type",4)).Cast<format::abc::Index >();
			this->curClass.FieldRef(STRING(L"statics",7)) = st;
			this->curFunction->__Field(STRING(L"f",1)).FieldRef(STRING(L"maxStack",8)) = 1;
			this->curFunction->__Field(STRING(L"f",1)).FieldRef(STRING(L"maxScope",8)) = 1;
			this->op(format::abc::OpCode_obj::OThis);
			this->op(format::abc::OpCode_obj::OScope);
			this->op(format::abc::OpCode_obj::ORetVoid);
			this->endFunction();
		}
		this->curFunction = null();
		this->curClass = null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Context_obj,endClass,(void))

Void Context_obj::addClassSuper( String sup){
{
		if (this->curClass == null())
			return null();
		this->classSupers->add(this->type(sup));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Context_obj,addClassSuper,(void))

Dynamic Context_obj::beginInterfaceMethod( String mname,Array<format::abc::Index > targs,format::abc::Index tret,Dynamic isStatic,Dynamic isOverride,Dynamic isFinal,Dynamic willAddLater,format::abc::MethodKind kind,Dynamic extra,format::abc::Index ns){
	haxe::Log_obj::trace(STRING(L"beginInterfaceMethod mname: ",28) + mname,hxAnon_obj::Create()->Add( STRING(L"fileName",8) , STRING(L"Context.hx",10))->Add( STRING(L"lineNumber",10) , 419)->Add( STRING(L"className",9) , STRING(L"format.abc.Context",18))->Add( STRING(L"methodName",10) , STRING(L"beginInterfaceMethod",20)));
	format::abc::Index m = this->beginInterfaceFunction(targs,tret,extra);
	if (willAddLater != true){
		Array<Dynamic > fl = isStatic ? Array<Dynamic >( this->curClass->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >() ) : Array<Dynamic >( this->curClass->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >() );
		fl->push(hxAnon_obj::Create()->Add( STRING(L"name",4) , this->property(mname,ns))->Add( STRING(L"slot",4) , fl->length + 1)->Add( STRING(L"kind",4) , format::abc::FieldKind_obj::FMethod(this->curFunction->__Field(STRING(L"f",1))->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),kind,isFinal,isOverride))->Add( STRING(L"metadatas",9) , null()));
	}
	return this->curFunction->__Field(STRING(L"f",1));
}


DEFINE_DYNAMIC_FUNC10(Context_obj,beginInterfaceMethod,return )

Dynamic Context_obj::beginMethod( String mname,Array<format::abc::Index > targs,format::abc::Index tret,Dynamic isStatic,Dynamic isOverride,Dynamic isFinal,Dynamic willAddLater,format::abc::MethodKind kind,Dynamic extra,format::abc::Index ns){
	format::abc::Index m = this->beginFunction(targs,tret,extra);
	if (willAddLater != true){
		Array<Dynamic > fl = isStatic ? Array<Dynamic >( this->curClass->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >() ) : Array<Dynamic >( this->curClass->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >() );
		fl->push(hxAnon_obj::Create()->Add( STRING(L"name",4) , this->property(mname,ns))->Add( STRING(L"slot",4) , fl->length + 1)->Add( STRING(L"kind",4) , format::abc::FieldKind_obj::FMethod(this->curFunction->__Field(STRING(L"f",1))->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),kind,isFinal,isOverride))->Add( STRING(L"metadatas",9) , null()));
	}
	return this->curFunction->__Field(STRING(L"f",1));
}


DEFINE_DYNAMIC_FUNC10(Context_obj,beginMethod,return )

Void Context_obj::endMethod( ){
{
		this->endFunction();
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Context_obj,endMethod,(void))

int Context_obj::defineField( String fname,format::abc::Index t,Dynamic isStatic,format::abc::Value value,Dynamic const,format::abc::Index ns){
	Array<Dynamic > fl = isStatic ? Array<Dynamic >( this->curClass->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >() ) : Array<Dynamic >( this->curClass->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >() );
	int slot = this->fieldSlot++;
	format::abc::FieldKind kind = format::abc::FieldKind_obj::FVar(t,null(),null());
	if (value != null()){
		kind = format::abc::FieldKind_obj::FVar(t,value,null());
		if (const)
			kind = format::abc::FieldKind_obj::FVar(t,value,const);
	}
	fl->push(hxAnon_obj::Create()->Add( STRING(L"name",4) , this->property(fname,ns))->Add( STRING(L"slot",4) , fl->length + 1)->Add( STRING(L"kind",4) , kind)->Add( STRING(L"metadatas",9) , null()));
	return fl->length;
}


DEFINE_DYNAMIC_FUNC6(Context_obj,defineField,return )

Void Context_obj::op( format::abc::OpCode o){
{
		this->curFunction->__Field(STRING(L"ops",3)).Cast<Array<format::abc::OpCode > >()->push(o);
		this->opw->write(o);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Context_obj,op,(void))

Void Context_obj::ops( Array<format::abc::OpCode > ops){
{
		{
			int _g = 0;
			while(_g < ops->length){
				format::abc::OpCode o = ops->__get(_g);
				++_g;
				this->op(o);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Context_obj,ops,(void))

Dynamic Context_obj::backwardJump( ){
	Array<int > start = Array_obj<int >::__new().Add(this->bytepos->n);
	Array<format::abc::Context > me = Array_obj<format::abc::Context >::__new().Add(this);
	this->op(format::abc::OpCode_obj::OLabel);

	BEGIN_LOCAL_FUNC2(_Function_1,Array<format::abc::Context >,me,Array<int >,start)
	Void run(format::abc::JumpStyle jcond){
{
			me[0]->op(format::abc::OpCode_obj::OJump(jcond,start->__get(0) - me[0]->bytepos->n - 4));
		}
		return null();
	}
	END_LOCAL_FUNC1((void))

	return  Dynamic(new _Function_1(me,start));
}


DEFINE_DYNAMIC_FUNC0(Context_obj,backwardJump,return )

Dynamic Context_obj::jump( format::abc::JumpStyle $t1){
	Array<format::abc::JumpStyle > jcond = Array_obj<format::abc::JumpStyle >::__new().Add($t1);
	Array<Array<format::abc::OpCode > > ops = Array_obj<Array<format::abc::OpCode > >::__new().Add(this->curFunction->__Field(STRING(L"ops",3)).Cast<Array<format::abc::OpCode > >());
	Array<int > pos = Array_obj<int >::__new().Add(ops[0]->length);
	this->op(format::abc::OpCode_obj::OJump(format::abc::JumpStyle_obj::JTrue,-1));
	Array<int > start = Array_obj<int >::__new().Add(this->bytepos->n);
	Array<format::abc::Context > me = Array_obj<format::abc::Context >::__new().Add(this);

	BEGIN_LOCAL_FUNC5(_Function_1,Array<Array<format::abc::OpCode > >,ops,Array<int >,pos,Array<format::abc::JumpStyle >,jcond,Array<format::abc::Context >,me,Array<int >,start)
	Void run(){
{
			ops->__get(0)[pos->__get(0)] = format::abc::OpCode_obj::OJump(jcond->__get(0),me[0]->bytepos->n - start->__get(0));
		}
		return null();
	}
	END_LOCAL_FUNC0((void))

	return  Dynamic(new _Function_1(ops,pos,jcond,me,start));
}


DEFINE_DYNAMIC_FUNC1(Context_obj,jump,return )

Void Context_obj::finalize( ){
{
		this->endClass(null());
		this->curFunction = this->init;
		this->op(format::abc::OpCode_obj::ORetVoid);
		this->endFunction();
		this->curClass = null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Context_obj,finalize,(void))


Context_obj::Context_obj()
{
	InitMember(data);
	InitMember(hstrings);
	InitMember(curClass);
	InitMember(curFunction);
	InitMember(classes);
	InitMember(init);
	InitMember(fieldSlot);
	InitMember(registers);
	InitMember(bytepos);
	InitMember(opw);
	InitMember(classSupers);
	InitMember(emptyString);
	InitMember(nsPublic);
	InitMember(arrayProp);
}

void Context_obj::__Mark()
{
	MarkMember(data);
	MarkMember(hstrings);
	MarkMember(curClass);
	MarkMember(curFunction);
	MarkMember(classes);
	MarkMember(init);
	MarkMember(fieldSlot);
	MarkMember(registers);
	MarkMember(bytepos);
	MarkMember(opw);
	MarkMember(classSupers);
	MarkMember(emptyString);
	MarkMember(nsPublic);
	MarkMember(arrayProp);
}

Dynamic Context_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 2:
		if (!memcmp(inName.__s,L"op",sizeof(wchar_t)*2) ) { return op_dyn(); }
		break;
	case 3:
		if (!memcmp(inName.__s,L"opw",sizeof(wchar_t)*3) ) { return opw; }
		if (!memcmp(inName.__s,L"int",sizeof(wchar_t)*3) ) { return toInt_dyn(); }
		if (!memcmp(inName.__s,L"ops",sizeof(wchar_t)*3) ) { return ops_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"data",sizeof(wchar_t)*4) ) { return data; }
		if (!memcmp(inName.__s,L"init",sizeof(wchar_t)*4) ) { return init; }
		if (!memcmp(inName.__s,L"uint",sizeof(wchar_t)*4) ) { return uint_dyn(); }
		if (!memcmp(inName.__s,L"name",sizeof(wchar_t)*4) ) { return name_dyn(); }
		if (!memcmp(inName.__s,L"type",sizeof(wchar_t)*4) ) { return type_dyn(); }
		if (!memcmp(inName.__s,L"jump",sizeof(wchar_t)*4) ) { return jump_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"float",sizeof(wchar_t)*5) ) { return _float_dyn(); }
		if (!memcmp(inName.__s,L"nsset",sizeof(wchar_t)*5) ) { return nsset_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"string",sizeof(wchar_t)*6) ) { return string_dyn(); }
		if (!memcmp(inName.__s,L"lookup",sizeof(wchar_t)*6) ) { return lookup_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"classes",sizeof(wchar_t)*7) ) { return classes; }
		if (!memcmp(inName.__s,L"bytepos",sizeof(wchar_t)*7) ) { return bytepos; }
		if (!memcmp(inName.__s,L"elookup",sizeof(wchar_t)*7) ) { return elookup_dyn(); }
		if (!memcmp(inName.__s,L"getData",sizeof(wchar_t)*7) ) { return getData_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"hstrings",sizeof(wchar_t)*8) ) { return hstrings; }
		if (!memcmp(inName.__s,L"curClass",sizeof(wchar_t)*8) ) { return curClass; }
		if (!memcmp(inName.__s,L"nsPublic",sizeof(wchar_t)*8) ) { return nsPublic; }
		if (!memcmp(inName.__s,L"getClass",sizeof(wchar_t)*8) ) { return getClass_dyn(); }
		if (!memcmp(inName.__s,L"property",sizeof(wchar_t)*8) ) { return property_dyn(); }
		if (!memcmp(inName.__s,L"endClass",sizeof(wchar_t)*8) ) { return endClass_dyn(); }
		if (!memcmp(inName.__s,L"finalize",sizeof(wchar_t)*8) ) { return finalize_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"fieldSlot",sizeof(wchar_t)*9) ) { return fieldSlot; }
		if (!memcmp(inName.__s,L"registers",sizeof(wchar_t)*9) ) { return registers; }
		if (!memcmp(inName.__s,L"arrayProp",sizeof(wchar_t)*9) ) { return arrayProp; }
		if (!memcmp(inName.__s,L"namespace",sizeof(wchar_t)*9) ) { return namespace_dyn(); }
		if (!memcmp(inName.__s,L"endMethod",sizeof(wchar_t)*9) ) { return endMethod_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"typeParams",sizeof(wchar_t)*10) ) { return typeParams_dyn(); }
		if (!memcmp(inName.__s,L"methodType",sizeof(wchar_t)*10) ) { return methodType_dyn(); }
		if (!memcmp(inName.__s,L"beginClass",sizeof(wchar_t)*10) ) { return beginClass_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"curFunction",sizeof(wchar_t)*11) ) { return curFunction; }
		if (!memcmp(inName.__s,L"classSupers",sizeof(wchar_t)*11) ) { return classSupers; }
		if (!memcmp(inName.__s,L"emptyString",sizeof(wchar_t)*11) ) { return emptyString; }
		if (!memcmp(inName.__s,L"endFunction",sizeof(wchar_t)*11) ) { return endFunction_dyn(); }
		if (!memcmp(inName.__s,L"beginMethod",sizeof(wchar_t)*11) ) { return beginMethod_dyn(); }
		if (!memcmp(inName.__s,L"defineField",sizeof(wchar_t)*11) ) { return defineField_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"freeRegister",sizeof(wchar_t)*12) ) { return freeRegister_dyn(); }
		if (!memcmp(inName.__s,L"backwardJump",sizeof(wchar_t)*12) ) { return backwardJump_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"beginFunction",sizeof(wchar_t)*13) ) { return beginFunction_dyn(); }
		if (!memcmp(inName.__s,L"allocRegister",sizeof(wchar_t)*13) ) { return allocRegister_dyn(); }
		if (!memcmp(inName.__s,L"addClassSuper",sizeof(wchar_t)*13) ) { return addClassSuper_dyn(); }
		break;
	case 20:
		if (!memcmp(inName.__s,L"beginInterfaceMethod",sizeof(wchar_t)*20) ) { return beginInterfaceMethod_dyn(); }
		break;
	case 22:
		if (!memcmp(inName.__s,L"beginInterfaceFunction",sizeof(wchar_t)*22) ) { return beginInterfaceFunction_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_data = __hxcpp_field_to_id("data");
static int __id_hstrings = __hxcpp_field_to_id("hstrings");
static int __id_curClass = __hxcpp_field_to_id("curClass");
static int __id_curFunction = __hxcpp_field_to_id("curFunction");
static int __id_classes = __hxcpp_field_to_id("classes");
static int __id_init = __hxcpp_field_to_id("init");
static int __id_fieldSlot = __hxcpp_field_to_id("fieldSlot");
static int __id_registers = __hxcpp_field_to_id("registers");
static int __id_bytepos = __hxcpp_field_to_id("bytepos");
static int __id_opw = __hxcpp_field_to_id("opw");
static int __id_classSupers = __hxcpp_field_to_id("classSupers");
static int __id_emptyString = __hxcpp_field_to_id("emptyString");
static int __id_nsPublic = __hxcpp_field_to_id("nsPublic");
static int __id_arrayProp = __hxcpp_field_to_id("arrayProp");
static int __id_toInt = __hxcpp_field_to_id("int");
static int __id_uint = __hxcpp_field_to_id("uint");
static int __id__float = __hxcpp_field_to_id("float");
static int __id_string = __hxcpp_field_to_id("string");
static int __id_namespace = __hxcpp_field_to_id("namespace");
static int __id_nsset = __hxcpp_field_to_id("nsset");
static int __id_name = __hxcpp_field_to_id("name");
static int __id_getClass = __hxcpp_field_to_id("getClass");
static int __id_type = __hxcpp_field_to_id("type");
static int __id_typeParams = __hxcpp_field_to_id("typeParams");
static int __id_property = __hxcpp_field_to_id("property");
static int __id_methodType = __hxcpp_field_to_id("methodType");
static int __id_lookup = __hxcpp_field_to_id("lookup");
static int __id_elookup = __hxcpp_field_to_id("elookup");
static int __id_getData = __hxcpp_field_to_id("getData");
static int __id_beginInterfaceFunction = __hxcpp_field_to_id("beginInterfaceFunction");
static int __id_beginFunction = __hxcpp_field_to_id("beginFunction");
static int __id_endFunction = __hxcpp_field_to_id("endFunction");
static int __id_allocRegister = __hxcpp_field_to_id("allocRegister");
static int __id_freeRegister = __hxcpp_field_to_id("freeRegister");
static int __id_beginClass = __hxcpp_field_to_id("beginClass");
static int __id_endClass = __hxcpp_field_to_id("endClass");
static int __id_addClassSuper = __hxcpp_field_to_id("addClassSuper");
static int __id_beginInterfaceMethod = __hxcpp_field_to_id("beginInterfaceMethod");
static int __id_beginMethod = __hxcpp_field_to_id("beginMethod");
static int __id_endMethod = __hxcpp_field_to_id("endMethod");
static int __id_defineField = __hxcpp_field_to_id("defineField");
static int __id_op = __hxcpp_field_to_id("op");
static int __id_ops = __hxcpp_field_to_id("ops");
static int __id_backwardJump = __hxcpp_field_to_id("backwardJump");
static int __id_jump = __hxcpp_field_to_id("jump");
static int __id_finalize = __hxcpp_field_to_id("finalize");


Dynamic Context_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_data) return data;
	if (inFieldID==__id_hstrings) return hstrings;
	if (inFieldID==__id_curClass) return curClass;
	if (inFieldID==__id_curFunction) return curFunction;
	if (inFieldID==__id_classes) return classes;
	if (inFieldID==__id_init) return init;
	if (inFieldID==__id_fieldSlot) return fieldSlot;
	if (inFieldID==__id_registers) return registers;
	if (inFieldID==__id_bytepos) return bytepos;
	if (inFieldID==__id_opw) return opw;
	if (inFieldID==__id_classSupers) return classSupers;
	if (inFieldID==__id_emptyString) return emptyString;
	if (inFieldID==__id_nsPublic) return nsPublic;
	if (inFieldID==__id_arrayProp) return arrayProp;
	if (inFieldID==__id_toInt) return toInt_dyn();
	if (inFieldID==__id_uint) return uint_dyn();
	if (inFieldID==__id__float) return _float_dyn();
	if (inFieldID==__id_string) return string_dyn();
	if (inFieldID==__id_namespace) return namespace_dyn();
	if (inFieldID==__id_nsset) return nsset_dyn();
	if (inFieldID==__id_name) return name_dyn();
	if (inFieldID==__id_getClass) return getClass_dyn();
	if (inFieldID==__id_type) return type_dyn();
	if (inFieldID==__id_typeParams) return typeParams_dyn();
	if (inFieldID==__id_property) return property_dyn();
	if (inFieldID==__id_methodType) return methodType_dyn();
	if (inFieldID==__id_lookup) return lookup_dyn();
	if (inFieldID==__id_elookup) return elookup_dyn();
	if (inFieldID==__id_getData) return getData_dyn();
	if (inFieldID==__id_beginInterfaceFunction) return beginInterfaceFunction_dyn();
	if (inFieldID==__id_beginFunction) return beginFunction_dyn();
	if (inFieldID==__id_endFunction) return endFunction_dyn();
	if (inFieldID==__id_allocRegister) return allocRegister_dyn();
	if (inFieldID==__id_freeRegister) return freeRegister_dyn();
	if (inFieldID==__id_beginClass) return beginClass_dyn();
	if (inFieldID==__id_endClass) return endClass_dyn();
	if (inFieldID==__id_addClassSuper) return addClassSuper_dyn();
	if (inFieldID==__id_beginInterfaceMethod) return beginInterfaceMethod_dyn();
	if (inFieldID==__id_beginMethod) return beginMethod_dyn();
	if (inFieldID==__id_endMethod) return endMethod_dyn();
	if (inFieldID==__id_defineField) return defineField_dyn();
	if (inFieldID==__id_op) return op_dyn();
	if (inFieldID==__id_ops) return ops_dyn();
	if (inFieldID==__id_backwardJump) return backwardJump_dyn();
	if (inFieldID==__id_jump) return jump_dyn();
	if (inFieldID==__id_finalize) return finalize_dyn();
	return super::__IField(inFieldID);
}

Dynamic Context_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"opw",sizeof(wchar_t)*3) ) { opw=inValue.Cast<format::abc::OpWriter >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"data",sizeof(wchar_t)*4) ) { data=inValue.Cast<format::abc::ABCData >();return inValue; }
		if (!memcmp(inName.__s,L"init",sizeof(wchar_t)*4) ) { init=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"classes",sizeof(wchar_t)*7) ) { classes=inValue.Cast<Array<Dynamic > >();return inValue; }
		if (!memcmp(inName.__s,L"bytepos",sizeof(wchar_t)*7) ) { bytepos=inValue.Cast<format::abc::_Context::NullOutput >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"hstrings",sizeof(wchar_t)*8) ) { hstrings=inValue.Cast<Hash >();return inValue; }
		if (!memcmp(inName.__s,L"curClass",sizeof(wchar_t)*8) ) { curClass=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"nsPublic",sizeof(wchar_t)*8) ) { nsPublic=inValue.Cast<format::abc::Index >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"fieldSlot",sizeof(wchar_t)*9) ) { fieldSlot=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"registers",sizeof(wchar_t)*9) ) { registers=inValue.Cast<Array<bool > >();return inValue; }
		if (!memcmp(inName.__s,L"arrayProp",sizeof(wchar_t)*9) ) { arrayProp=inValue.Cast<format::abc::Index >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"curFunction",sizeof(wchar_t)*11) ) { curFunction=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"classSupers",sizeof(wchar_t)*11) ) { classSupers=inValue.Cast<List >();return inValue; }
		if (!memcmp(inName.__s,L"emptyString",sizeof(wchar_t)*11) ) { emptyString=inValue.Cast<format::abc::Index >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Context_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"data",4));
	outFields->push(STRING(L"hstrings",8));
	outFields->push(STRING(L"curClass",8));
	outFields->push(STRING(L"curFunction",11));
	outFields->push(STRING(L"classes",7));
	outFields->push(STRING(L"init",4));
	outFields->push(STRING(L"fieldSlot",9));
	outFields->push(STRING(L"registers",9));
	outFields->push(STRING(L"bytepos",7));
	outFields->push(STRING(L"opw",3));
	outFields->push(STRING(L"classSupers",11));
	outFields->push(STRING(L"emptyString",11));
	outFields->push(STRING(L"nsPublic",8));
	outFields->push(STRING(L"arrayProp",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"data",4),
	STRING(L"hstrings",8),
	STRING(L"curClass",8),
	STRING(L"curFunction",11),
	STRING(L"classes",7),
	STRING(L"init",4),
	STRING(L"fieldSlot",9),
	STRING(L"registers",9),
	STRING(L"bytepos",7),
	STRING(L"opw",3),
	STRING(L"classSupers",11),
	STRING(L"emptyString",11),
	STRING(L"nsPublic",8),
	STRING(L"arrayProp",9),
	STRING(L"int",3),
	STRING(L"uint",4),
	STRING(L"float",5),
	STRING(L"string",6),
	STRING(L"namespace",9),
	STRING(L"nsset",5),
	STRING(L"name",4),
	STRING(L"getClass",8),
	STRING(L"type",4),
	STRING(L"typeParams",10),
	STRING(L"property",8),
	STRING(L"methodType",10),
	STRING(L"lookup",6),
	STRING(L"elookup",7),
	STRING(L"getData",7),
	STRING(L"beginInterfaceFunction",22),
	STRING(L"beginFunction",13),
	STRING(L"endFunction",11),
	STRING(L"allocRegister",13),
	STRING(L"freeRegister",12),
	STRING(L"beginClass",10),
	STRING(L"endClass",8),
	STRING(L"addClassSuper",13),
	STRING(L"beginInterfaceMethod",20),
	STRING(L"beginMethod",11),
	STRING(L"endMethod",9),
	STRING(L"defineField",11),
	STRING(L"op",2),
	STRING(L"ops",3),
	STRING(L"backwardJump",12),
	STRING(L"jump",4),
	STRING(L"finalize",8),
	String(null()) };

static void sMarkStatics() {
};

Class Context_obj::__mClass;

void Context_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.Context",18), TCanCast<Context_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Context_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
