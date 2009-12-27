#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_abc_ABCData
#include <format/abc/ABCData.h>
#endif
#ifndef INCLUDED_format_abc_FieldKind
#include <format/abc/FieldKind.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
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
#ifndef INCLUDED_format_abc_OpReader
#include <format/abc/OpReader.h>
#endif
#ifndef INCLUDED_format_abc_Reader
#include <format/abc/Reader.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace abc{

Void Reader_obj::__construct(haxe::io::Input i)
{
{
	this->i = i;
	this->opr = format::abc::OpReader_obj::__new(i);
}
;
	return null();
}

Reader_obj::~Reader_obj() { }

Dynamic Reader_obj::__CreateEmpty() { return  new Reader_obj; }
hxObjectPtr<Reader_obj > Reader_obj::__new(haxe::io::Input i)
{  hxObjectPtr<Reader_obj > result = new Reader_obj();
	result->__construct(i);
	return result;}

Dynamic Reader_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Reader_obj > result = new Reader_obj();
	result->__construct(inArgs[0]);
	return result;}

int Reader_obj::readInt( ){
	return this->opr->readInt();
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readInt,return )

format::abc::Index Reader_obj::readIndex( ){
	return format::abc::Index_obj::Idx(this->opr->readInt());
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readIndex,return )

format::abc::Index Reader_obj::readIndexOpt( ){
	int i = this->opr->readInt();
	return (i == 0) ? format::abc::Index( null() ) : format::abc::Index( format::abc::Index_obj::Idx(i) );
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readIndexOpt,return )

Array<Dynamic > Reader_obj::readList( Dynamic f){
	Array<Dynamic > a = Array_obj<Dynamic >::__new();
	int n = this->opr->readInt();
	if (n == 0)
		return a;
	{
		int _g1 = 0;
		int _g = n - 1;
		while(_g1 < _g){
			int i = _g1++;
			a->push(f());
		}
	}
	return a;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readList,return )

Array<Dynamic > Reader_obj::readList2( Dynamic f){
	Array<Dynamic > a = Array_obj<Dynamic >::__new();
	int n = this->opr->readInt();
	{
		int _g = 0;
		while(_g < n){
			int i = _g++;
			a->push(f());
		}
	}
	return a;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readList2,return )

String Reader_obj::readString( ){
	return this->i->readString(this->opr->readInt());
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readString,return )

format::abc::Namespace Reader_obj::readNamespace( ){
	int k = this->i->readByte();
	format::abc::Index p = format::abc::Index_obj::Idx(this->opr->readInt());
	struct _Function_1{
		static format::abc::Namespace Block( int &k,format::abc::Index &p)/* DEF (not block)(ret intern) */{
			switch( (int)(k)){
				case 5: {
					return format::abc::Namespace_obj::NPrivate(p);
				}
				break;
				case 8: {
					return format::abc::Namespace_obj::NNamespace(p);
				}
				break;
				case 22: {
					return format::abc::Namespace_obj::NPublic(p);
				}
				break;
				case 23: {
					return format::abc::Namespace_obj::NInternal(p);
				}
				break;
				case 24: {
					return format::abc::Namespace_obj::NProtected(p);
				}
				break;
				case 25: {
					return format::abc::Namespace_obj::NExplicit(p);
				}
				break;
				case 26: {
					return format::abc::Namespace_obj::NStaticProtected(p);
				}
				break;
				default: {
					return hxThrow (STRING(L"assert",6));
				}
			}
		}
	};
	return _Function_1::Block(k,p);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readNamespace,return )

Array<format::abc::Index > Reader_obj::readNsSet( ){
	Array<format::abc::Index > a = Array_obj<format::abc::Index >::__new();
	{
		int _g1 = 0;
		int _g = this->i->readByte();
		while(_g1 < _g){
			int n = _g1++;
			a->push(format::abc::Index_obj::Idx(this->opr->readInt()));
		}
	}
	return a;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readNsSet,return )

format::abc::Name Reader_obj::readName( Dynamic __o_k){
int k = __o_k.Default(-1);
{
		if (k == -1)
			k = this->i->readByte();
		struct _Function_1{
			static format::abc::Name Block( int &k,format::abc::Reader_obj *__this)/* DEF (not block)(ret intern) */{
				switch( (int)(k)){
					case 7: {
						format::abc::Index ns = format::abc::Index_obj::Idx(__this->opr->readInt());
						format::abc::Index id = format::abc::Index_obj::Idx(__this->opr->readInt());
						return format::abc::Name_obj::NName(id,ns);
					}
					break;
					case 9: {
						format::abc::Index id = format::abc::Index_obj::Idx(__this->opr->readInt());
						format::abc::Index ns = format::abc::Index_obj::Idx(__this->opr->readInt());
						return format::abc::Name_obj::NMulti(id,ns);
					}
					break;
					case 13: {
						return format::abc::Name_obj::NAttrib(__this->readName(7));
					}
					break;
					case 14: {
						return format::abc::Name_obj::NAttrib(__this->readName(9));
					}
					break;
					case 15: {
						return format::abc::Name_obj::NRuntime(format::abc::Index_obj::Idx(__this->opr->readInt()));
					}
					break;
					case 16: {
						return format::abc::Name_obj::NRuntimeLate;
					}
					break;
					case 18: {
						return format::abc::Name_obj::NAttrib(__this->readName(17));
					}
					break;
					case 27: {
						return format::abc::Name_obj::NMultiLate(format::abc::Index_obj::Idx(__this->opr->readInt()));
					}
					break;
					case 28: {
						return format::abc::Name_obj::NAttrib(__this->readName(27));
					}
					break;
					case 29: {
						format::abc::Index id = format::abc::Index_obj::Idx(__this->opr->readInt());
						Array<format::abc::Index > params = __this->readList2(__this->readIndex_dyn());
						return format::abc::Name_obj::NParams(id,params);
					}
					break;
					default: {
						return hxThrow (STRING(L"assert",6));
					}
				}
			}
		};
		return _Function_1::Block(k,this);
	}
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readName,return )

format::abc::Value Reader_obj::readValue( bool extra){
	int idx = this->opr->readInt();
	if (idx == 0){
		if (bool(extra) && bool(this->i->readByte() != 0))
			hxThrow (STRING(L"assert",6));
		return null();
	}
	int n = this->i->readByte();
	struct _Function_1{
		static format::abc::Value Block( int &n,int &idx)/* DEF (not block)(ret intern) */{
			switch( (int)(n)){
				case 1: {
					return format::abc::Value_obj::VString(format::abc::Index_obj::Idx(idx));
				}
				break;
				case 3: {
					return format::abc::Value_obj::VInt(format::abc::Index_obj::Idx(idx));
				}
				break;
				case 4: {
					return format::abc::Value_obj::VUInt(format::abc::Index_obj::Idx(idx));
				}
				break;
				case 6: {
					return format::abc::Value_obj::VFloat(format::abc::Index_obj::Idx(idx));
				}
				break;
				case 5: case 8: case 22: case 23: case 24: case 25: case 26: {
					return format::abc::Value_obj::VNamespace(n,format::abc::Index_obj::Idx(idx));
				}
				break;
				case 10: {
					if (idx != 10)
						hxThrow (STRING(L"assert",6));
					return format::abc::Value_obj::VBool(false);
				}
				break;
				case 11: {
					if (idx != 11)
						hxThrow (STRING(L"assert",6));
					return format::abc::Value_obj::VBool(true);
				}
				break;
				case 12: {
					if (idx != 12)
						hxThrow (STRING(L"assert",6));
					return format::abc::Value_obj::VNull;
				}
				break;
				default: {
					return hxThrow (STRING(L"assert",6));
				}
			}
		}
	};
	return _Function_1::Block(n,idx);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readValue,return )

Dynamic Reader_obj::readMethodType( ){
	int nargs = this->i->readByte();
	format::abc::Index tret = this->readIndexOpt();
	Array<format::abc::Index > targs = Array_obj<format::abc::Index >::__new();
	{
		int _g = 0;
		while(_g < nargs){
			int i = _g++;
			targs->push(this->readIndexOpt());
		}
	}
	format::abc::Index dname = this->readIndexOpt();
	int flags = this->i->readByte();
	if (bool(flags == 0) && bool(dname == null()))
		return hxAnon_obj::Create()->Add( STRING(L"args",4) , targs)->Add( STRING(L"ret",3) , tret)->Add( STRING(L"extra",5) , null());
	Array<format::abc::Value > dparams = null();
	Array<format::abc::Index > pnames = null();

	BEGIN_LOCAL_FUNC0(_Function_1)
	Dynamic run(Dynamic $t1,bool $t2){
{
			Array<bool > a1 = Array_obj<bool >::__new().Add($t2);
			Array<Dynamic > f = Array_obj<Dynamic >::__new().Add($t1);

			BEGIN_LOCAL_FUNC2(_Function_2,Array<Dynamic >,f,Array<bool >,a1)
			format::abc::Value run(){
				return f->__get(0)(a1->__get(0));
				return null();
			}
			END_LOCAL_FUNC0(return)

			return  Dynamic(new _Function_2(f,a1));
		}
		return null();
	}
	END_LOCAL_FUNC2(return)

	if ((int(flags) & int(8)) != 0)
		dparams = this->readList2( Dynamic(new _Function_1())(this->readValue_dyn(),true));
	if ((int(flags) & int(128)) != 0){
		pnames = Array_obj<format::abc::Index >::__new();
		{
			int _g = 0;
			while(_g < nargs){
				int i = _g++;
				pnames->push(this->readIndexOpt());
			}
		}
	}
	return hxAnon_obj::Create()->Add( STRING(L"args",4) , targs)->Add( STRING(L"ret",3) , tret)->Add( STRING(L"extra",5) , hxAnon_obj::Create()->Add( STRING(L"native",6) , (int(flags) & int(32)) != 0)->Add( STRING(L"variableArgs",12) , (int(flags) & int(4)) != 0)->Add( STRING(L"argumentsDefined",16) , (int(flags) & int(1)) != 0)->Add( STRING(L"usesDXNS",8) , (int(flags) & int(64)) != 0)->Add( STRING(L"newBlock",8) , (int(flags) & int(2)) != 0)->Add( STRING(L"unused",6) , (int(flags) & int(16)) != 0)->Add( STRING(L"debugName",9) , dname)->Add( STRING(L"defaultParameters",17) , dparams)->Add( STRING(L"paramNames",10) , pnames));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMethodType,return )

Dynamic Reader_obj::readMetadata( ){
	format::abc::Index name = format::abc::Index_obj::Idx(this->opr->readInt());
	Array<format::abc::Index > data = this->readList2(this->readIndexOpt_dyn());
	Array<Dynamic > a = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < data->length){
			format::abc::Index i = data->__get(_g);
			++_g;
			a->push(hxAnon_obj::Create()->Add( STRING(L"n",1) , i)->Add( STRING(L"v",1) , format::abc::Index_obj::Idx(this->opr->readInt())));
		}
	}
	return hxAnon_obj::Create()->Add( STRING(L"name",4) , name)->Add( STRING(L"data",4) , a);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMetadata,return )

Dynamic Reader_obj::readField( ){
	format::abc::Index name = format::abc::Index_obj::Idx(this->opr->readInt());
	int kind = this->i->readByte();
	int slot = this->opr->readInt();
	format::abc::FieldKind f;
	switch( (int)(int(kind) & int(15))){
		case 0: case 6: {
			format::abc::Index t = this->readIndexOpt();
			format::abc::Value v = this->readValue(false);
			f = format::abc::FieldKind_obj::FVar(t,v,kind == 6);
		}
		break;
		case 1: case 2: case 3: {
			format::abc::Index mt = format::abc::Index_obj::Idx(this->opr->readInt());
			bool final = int(kind) & int(16) != 0;
			bool over = int(kind) & int(32) != 0;
			struct _Function_1{
				static format::abc::MethodKind Block( int &kind)/* DEF (not block)(ret intern) */{
					switch( (int)(int(kind) & int(15))){
						case 1: {
							return format::abc::MethodKind_obj::KNormal;
						}
						break;
						case 2: {
							return format::abc::MethodKind_obj::KGetter;
						}
						break;
						case 3: {
							return format::abc::MethodKind_obj::KSetter;
						}
						break;
						default: {
							return hxThrow (STRING(L"assert",6));
						}
					}
				}
			};
			format::abc::MethodKind kind1 = _Function_1::Block(kind);
			f = format::abc::FieldKind_obj::FMethod(mt,kind1,final,over);
		}
		break;
		case 4: {
			f = format::abc::FieldKind_obj::FClass(format::abc::Index_obj::Idx(this->opr->readInt()));
		}
		break;
		case 5: {
			f = format::abc::FieldKind_obj::FFunction(format::abc::Index_obj::Idx(this->opr->readInt()));
		}
		break;
		default: {
			hxThrow (STRING(L"assert",6));
		}
	}
	Array<format::abc::Index > metas = null();
	if ((int(kind) & int(64)) != 0)
		metas = this->readList2(this->readIndex_dyn());
	return hxAnon_obj::Create()->Add( STRING(L"name",4) , name)->Add( STRING(L"slot",4) , slot)->Add( STRING(L"kind",4) , f)->Add( STRING(L"metadatas",9) , metas);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readField,return )

Dynamic Reader_obj::readClass( ){
	format::abc::Index name = format::abc::Index_obj::Idx(this->opr->readInt());
	format::abc::Index csuper = this->readIndexOpt();
	int flags = this->i->readByte();
	format::abc::Index ns = null();
	if ((int(flags) & int(8)) != 0)
		ns = format::abc::Index_obj::Idx(this->opr->readInt());
	Array<format::abc::Index > interfs = this->readList2(this->readIndex_dyn());
	format::abc::Index construct = format::abc::Index_obj::Idx(this->opr->readInt());
	Array<Dynamic > fields = this->readList2(this->readField_dyn());
	return hxAnon_obj::Create()->Add( STRING(L"name",4) , name)->Add( STRING(L"superclass",10) , csuper)->Add( STRING(L"interfaces",10) , interfs)->Add( STRING(L"constructor",11) , construct)->Add( STRING(L"fields",6) , fields)->Add( STRING(L"namespace",9) , ns)->Add( STRING(L"isSealed",8) , (int(flags) & int(1)) != 0)->Add( STRING(L"isFinal",7) , (int(flags) & int(2)) != 0)->Add( STRING(L"isInterface",11) , (int(flags) & int(4)) != 0)->Add( STRING(L"statics",7) , null())->Add( STRING(L"staticFields",12) , null());
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readClass,return )

Dynamic Reader_obj::readInit( ){
	return hxAnon_obj::Create()->Add( STRING(L"method",6) , format::abc::Index_obj::Idx(this->opr->readInt()))->Add( STRING(L"fields",6) , this->readList2(this->readField_dyn()));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readInit,return )

Dynamic Reader_obj::readTryCatch( ){
	return hxAnon_obj::Create()->Add( STRING(L"start",5) , this->opr->readInt())->Add( STRING(L"end",3) , this->opr->readInt())->Add( STRING(L"handle",6) , this->opr->readInt())->Add( STRING(L"type",4) , this->readIndexOpt())->Add( STRING(L"variable",8) , this->readIndexOpt());
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readTryCatch,return )

Dynamic Reader_obj::readFunction( ){
	format::abc::Index t = format::abc::Index_obj::Idx(this->opr->readInt());
	int ss = this->opr->readInt();
	int nregs = this->opr->readInt();
	int init_scope = this->opr->readInt();
	int max_scope = this->opr->readInt();
	haxe::io::Bytes code = this->i->read(this->opr->readInt());
	Array<Dynamic > trys = this->readList2(this->readTryCatch_dyn());
	Array<Dynamic > locals = this->readList2(this->readField_dyn());
	return hxAnon_obj::Create()->Add( STRING(L"type",4) , t)->Add( STRING(L"maxStack",8) , ss)->Add( STRING(L"nRegs",5) , nregs)->Add( STRING(L"initScope",9) , init_scope)->Add( STRING(L"maxScope",8) , max_scope)->Add( STRING(L"code",4) , code)->Add( STRING(L"trys",4) , trys)->Add( STRING(L"locals",6) , locals);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFunction,return )

format::abc::ABCData Reader_obj::read( ){
	if (this->i->readUInt30() != 3014672)
		hxThrow (STRING(L"invalid header",14));
	format::abc::ABCData data = format::abc::ABCData_obj::__new();
	data->ints = this->readList(this->opr->readInt32_dyn());
	data->uints = this->readList(this->opr->readInt32_dyn());
	data->floats = this->readList(this->i->readDouble_dyn());
	data->strings = this->readList(this->readString_dyn());
	data->namespaces = this->readList(this->readNamespace_dyn());
	data->nssets = this->readList(this->readNsSet_dyn());

	BEGIN_LOCAL_FUNC0(_Function_1)
	Dynamic run(Dynamic $t1,int $t2){
{
			Array<int > a1 = Array_obj<int >::__new().Add($t2);
			Array<Dynamic > f = Array_obj<Dynamic >::__new().Add($t1);

			BEGIN_LOCAL_FUNC2(_Function_2,Array<Dynamic >,f,Array<int >,a1)
			format::abc::Name run(){
				return f->__get(0)(a1->__get(0));
				return null();
			}
			END_LOCAL_FUNC0(return)

			return  Dynamic(new _Function_2(f,a1));
		}
		return null();
	}
	END_LOCAL_FUNC2(return)

	data->names = this->readList( Dynamic(new _Function_1())(this->readName_dyn(),-1));
	data->methodTypes = this->readList2(this->readMethodType_dyn());
	data->metadatas = this->readList2(this->readMetadata_dyn());
	data->classes = this->readList2(this->readClass_dyn());
	{
		int _g = 0;
		Array<Dynamic > _g1 = data->classes;
		while(_g < _g1->length){
			Dynamic c = _g1->__get(_g);
			++_g;
			c.FieldRef(STRING(L"statics",7)) = format::abc::Index_obj::Idx(this->opr->readInt());
			c.FieldRef(STRING(L"staticFields",12)) = this->readList2(this->readField_dyn());
		}
	}
	data->inits = this->readList2(this->readInit_dyn());
	data->functions = this->readList2(this->readFunction_dyn());
	return data;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,read,return )


Reader_obj::Reader_obj()
{
	InitMember(i);
	InitMember(opr);
}

void Reader_obj::__Mark()
{
	MarkMember(i);
	MarkMember(opr);
}

Dynamic Reader_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { return i; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"opr",sizeof(wchar_t)*3) ) { return opr; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"readInt",sizeof(wchar_t)*7) ) { return readInt_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"readList",sizeof(wchar_t)*8) ) { return readList_dyn(); }
		if (!memcmp(inName.__s,L"readName",sizeof(wchar_t)*8) ) { return readName_dyn(); }
		if (!memcmp(inName.__s,L"readInit",sizeof(wchar_t)*8) ) { return readInit_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"readIndex",sizeof(wchar_t)*9) ) { return readIndex_dyn(); }
		if (!memcmp(inName.__s,L"readList2",sizeof(wchar_t)*9) ) { return readList2_dyn(); }
		if (!memcmp(inName.__s,L"readNsSet",sizeof(wchar_t)*9) ) { return readNsSet_dyn(); }
		if (!memcmp(inName.__s,L"readValue",sizeof(wchar_t)*9) ) { return readValue_dyn(); }
		if (!memcmp(inName.__s,L"readField",sizeof(wchar_t)*9) ) { return readField_dyn(); }
		if (!memcmp(inName.__s,L"readClass",sizeof(wchar_t)*9) ) { return readClass_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"readString",sizeof(wchar_t)*10) ) { return readString_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"readIndexOpt",sizeof(wchar_t)*12) ) { return readIndexOpt_dyn(); }
		if (!memcmp(inName.__s,L"readMetadata",sizeof(wchar_t)*12) ) { return readMetadata_dyn(); }
		if (!memcmp(inName.__s,L"readTryCatch",sizeof(wchar_t)*12) ) { return readTryCatch_dyn(); }
		if (!memcmp(inName.__s,L"readFunction",sizeof(wchar_t)*12) ) { return readFunction_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"readNamespace",sizeof(wchar_t)*13) ) { return readNamespace_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"readMethodType",sizeof(wchar_t)*14) ) { return readMethodType_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_i = __hxcpp_field_to_id("i");
static int __id_opr = __hxcpp_field_to_id("opr");
static int __id_readInt = __hxcpp_field_to_id("readInt");
static int __id_readIndex = __hxcpp_field_to_id("readIndex");
static int __id_readIndexOpt = __hxcpp_field_to_id("readIndexOpt");
static int __id_readList = __hxcpp_field_to_id("readList");
static int __id_readList2 = __hxcpp_field_to_id("readList2");
static int __id_readString = __hxcpp_field_to_id("readString");
static int __id_readNamespace = __hxcpp_field_to_id("readNamespace");
static int __id_readNsSet = __hxcpp_field_to_id("readNsSet");
static int __id_readName = __hxcpp_field_to_id("readName");
static int __id_readValue = __hxcpp_field_to_id("readValue");
static int __id_readMethodType = __hxcpp_field_to_id("readMethodType");
static int __id_readMetadata = __hxcpp_field_to_id("readMetadata");
static int __id_readField = __hxcpp_field_to_id("readField");
static int __id_readClass = __hxcpp_field_to_id("readClass");
static int __id_readInit = __hxcpp_field_to_id("readInit");
static int __id_readTryCatch = __hxcpp_field_to_id("readTryCatch");
static int __id_readFunction = __hxcpp_field_to_id("readFunction");
static int __id_read = __hxcpp_field_to_id("read");


Dynamic Reader_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_i) return i;
	if (inFieldID==__id_opr) return opr;
	if (inFieldID==__id_readInt) return readInt_dyn();
	if (inFieldID==__id_readIndex) return readIndex_dyn();
	if (inFieldID==__id_readIndexOpt) return readIndexOpt_dyn();
	if (inFieldID==__id_readList) return readList_dyn();
	if (inFieldID==__id_readList2) return readList2_dyn();
	if (inFieldID==__id_readString) return readString_dyn();
	if (inFieldID==__id_readNamespace) return readNamespace_dyn();
	if (inFieldID==__id_readNsSet) return readNsSet_dyn();
	if (inFieldID==__id_readName) return readName_dyn();
	if (inFieldID==__id_readValue) return readValue_dyn();
	if (inFieldID==__id_readMethodType) return readMethodType_dyn();
	if (inFieldID==__id_readMetadata) return readMetadata_dyn();
	if (inFieldID==__id_readField) return readField_dyn();
	if (inFieldID==__id_readClass) return readClass_dyn();
	if (inFieldID==__id_readInit) return readInit_dyn();
	if (inFieldID==__id_readTryCatch) return readTryCatch_dyn();
	if (inFieldID==__id_readFunction) return readFunction_dyn();
	if (inFieldID==__id_read) return read_dyn();
	return super::__IField(inFieldID);
}

Dynamic Reader_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { i=inValue.Cast<haxe::io::Input >();return inValue; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"opr",sizeof(wchar_t)*3) ) { opr=inValue.Cast<format::abc::OpReader >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Reader_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"i",1));
	outFields->push(STRING(L"opr",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"i",1),
	STRING(L"opr",3),
	STRING(L"readInt",7),
	STRING(L"readIndex",9),
	STRING(L"readIndexOpt",12),
	STRING(L"readList",8),
	STRING(L"readList2",9),
	STRING(L"readString",10),
	STRING(L"readNamespace",13),
	STRING(L"readNsSet",9),
	STRING(L"readName",8),
	STRING(L"readValue",9),
	STRING(L"readMethodType",14),
	STRING(L"readMetadata",12),
	STRING(L"readField",9),
	STRING(L"readClass",9),
	STRING(L"readInit",8),
	STRING(L"readTryCatch",12),
	STRING(L"readFunction",12),
	STRING(L"read",4),
	String(null()) };

static void sMarkStatics() {
};

Class Reader_obj::__mClass;

void Reader_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.Reader",17), TCanCast<Reader_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Reader_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
