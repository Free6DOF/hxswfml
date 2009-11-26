#include <hxObject.h>

#ifndef INCLUDED_Reflect
#include <Reflect.h>
#endif

Void Reflect_obj::__construct()
{
	return null();
}

Reflect_obj::~Reflect_obj() { }

Dynamic Reflect_obj::__CreateEmpty() { return  new Reflect_obj; }
hxObjectPtr<Reflect_obj > Reflect_obj::__new()
{  hxObjectPtr<Reflect_obj > result = new Reflect_obj();
	result->__construct();
	return result;}

Dynamic Reflect_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Reflect_obj > result = new Reflect_obj();
	result->__construct();
	return result;}

bool Reflect_obj::hasField( Dynamic o,String field){
	return bool(o != null()) && bool(o->__HasField(field));
}


STATIC_DEFINE_DYNAMIC_FUNC2(Reflect_obj,hasField,return )

Dynamic Reflect_obj::field( Dynamic o,String field){
	return o->__Field(field);
}


STATIC_DEFINE_DYNAMIC_FUNC2(Reflect_obj,field,return )

Void Reflect_obj::setField( Dynamic o,String field,Dynamic value){
{
		o->__SetField(field,value);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC3(Reflect_obj,setField,(void))

Dynamic Reflect_obj::callMethod( Dynamic o,Dynamic func,Array<Dynamic > args){
	String s = func;
	return o->__Field(s)->__Run(args);
}


STATIC_DEFINE_DYNAMIC_FUNC3(Reflect_obj,callMethod,return )

Array<String > Reflect_obj::fields( Dynamic o){
	if (o == null())
		return Array_obj<String >::__new();
	Array<String > a = Array_obj<String >::__new();
	o->__GetFields(a);
	return a;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Reflect_obj,fields,return )

bool Reflect_obj::isFunction( Dynamic f){
	return bool(f != null()) && bool(f->__GetType() == ::vtFunction);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Reflect_obj,isFunction,return )

int Reflect_obj::compare( Dynamic a,Dynamic b){
	return (a == b) ? int( 0 ) : int( (((a) > (b)) ? int( 1 ) : int( -1 )) );
}


STATIC_DEFINE_DYNAMIC_FUNC2(Reflect_obj,compare,return )

bool Reflect_obj::compareMethods( Dynamic f1,Dynamic f2){
	if (f1 == f2)
		return true;
	if (bool(!Reflect_obj::isFunction(f1)) || bool(!Reflect_obj::isFunction(f2)))
		return false;
	return ::__hxcpp_same_closure(f1,f2);
}


STATIC_DEFINE_DYNAMIC_FUNC2(Reflect_obj,compareMethods,return )

bool Reflect_obj::isObject( Dynamic v){
	if (v == null())
		return false;
	int t = v->__GetType();
	return bool(t == ::vtObject) || bool(t == ::vtClass);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Reflect_obj,isObject,return )

bool Reflect_obj::deleteField( Dynamic o,String f){
	return false;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Reflect_obj,deleteField,return )

Dynamic Reflect_obj::copy( Dynamic o){
	Dynamic o2 = hxAnon_obj::Create();
	{
		int _g = 0;
		Array<String > _g1 = Reflect_obj::fields(o);
		while(_g < _g1->length){
			String f = _g1->__get(_g);
			++_g;
			o2->__SetField(f,o->__Field(f));
		}
	}
	return o2;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Reflect_obj,copy,return )

Dynamic Reflect_obj::makeVarArgs( Dynamic f){
	return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Reflect_obj,makeVarArgs,return )


Reflect_obj::Reflect_obj()
{
}

void Reflect_obj::__Mark()
{
}

Dynamic Reflect_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"copy",sizeof(wchar_t)*4) ) { return copy_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"field",sizeof(wchar_t)*5) ) { return field_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"fields",sizeof(wchar_t)*6) ) { return fields_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"compare",sizeof(wchar_t)*7) ) { return compare_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"hasField",sizeof(wchar_t)*8) ) { return hasField_dyn(); }
		if (!memcmp(inName.__s,L"setField",sizeof(wchar_t)*8) ) { return setField_dyn(); }
		if (!memcmp(inName.__s,L"isObject",sizeof(wchar_t)*8) ) { return isObject_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"callMethod",sizeof(wchar_t)*10) ) { return callMethod_dyn(); }
		if (!memcmp(inName.__s,L"isFunction",sizeof(wchar_t)*10) ) { return isFunction_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"deleteField",sizeof(wchar_t)*11) ) { return deleteField_dyn(); }
		if (!memcmp(inName.__s,L"makeVarArgs",sizeof(wchar_t)*11) ) { return makeVarArgs_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"compareMethods",sizeof(wchar_t)*14) ) { return compareMethods_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_hasField = __hxcpp_field_to_id("hasField");
static int __id_field = __hxcpp_field_to_id("field");
static int __id_setField = __hxcpp_field_to_id("setField");
static int __id_callMethod = __hxcpp_field_to_id("callMethod");
static int __id_fields = __hxcpp_field_to_id("fields");
static int __id_isFunction = __hxcpp_field_to_id("isFunction");
static int __id_compare = __hxcpp_field_to_id("compare");
static int __id_compareMethods = __hxcpp_field_to_id("compareMethods");
static int __id_isObject = __hxcpp_field_to_id("isObject");
static int __id_deleteField = __hxcpp_field_to_id("deleteField");
static int __id_copy = __hxcpp_field_to_id("copy");
static int __id_makeVarArgs = __hxcpp_field_to_id("makeVarArgs");


Dynamic Reflect_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_hasField) return hasField_dyn();
	if (inFieldID==__id_field) return field_dyn();
	if (inFieldID==__id_setField) return setField_dyn();
	if (inFieldID==__id_callMethod) return callMethod_dyn();
	if (inFieldID==__id_fields) return fields_dyn();
	if (inFieldID==__id_isFunction) return isFunction_dyn();
	if (inFieldID==__id_compare) return compare_dyn();
	if (inFieldID==__id_compareMethods) return compareMethods_dyn();
	if (inFieldID==__id_isObject) return isObject_dyn();
	if (inFieldID==__id_deleteField) return deleteField_dyn();
	if (inFieldID==__id_copy) return copy_dyn();
	if (inFieldID==__id_makeVarArgs) return makeVarArgs_dyn();
	return super::__IField(inFieldID);
}

Dynamic Reflect_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Reflect_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"hasField",8),
	STRING(L"field",5),
	STRING(L"setField",8),
	STRING(L"callMethod",10),
	STRING(L"fields",6),
	STRING(L"isFunction",10),
	STRING(L"compare",7),
	STRING(L"compareMethods",14),
	STRING(L"isObject",8),
	STRING(L"deleteField",11),
	STRING(L"copy",4),
	STRING(L"makeVarArgs",11),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Reflect_obj::__mClass;

void Reflect_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"Reflect",7), TCanCast<Reflect_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Reflect_obj::__boot()
{
}

