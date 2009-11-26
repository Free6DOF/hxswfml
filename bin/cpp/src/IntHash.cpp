#include <hxObject.h>

#ifndef INCLUDED_IntHash
#include <IntHash.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif

Void IntHash_obj::__construct()
{
{
	this->h = ::CreateIntHash();
}
;
	return null();
}

IntHash_obj::~IntHash_obj() { }

Dynamic IntHash_obj::__CreateEmpty() { return  new IntHash_obj; }
hxObjectPtr<IntHash_obj > IntHash_obj::__new()
{  hxObjectPtr<IntHash_obj > result = new IntHash_obj();
	result->__construct();
	return result;}

Dynamic IntHash_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<IntHash_obj > result = new IntHash_obj();
	result->__construct();
	return result;}

Void IntHash_obj::set( int key,Dynamic value){
{
		::__int_hash_set(this->h,key,value);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(IntHash_obj,set,(void))

Dynamic IntHash_obj::get( int key){
	return ::__int_hash_get(this->h,key);
}


DEFINE_DYNAMIC_FUNC1(IntHash_obj,get,return )

bool IntHash_obj::exists( int key){
	return ::__int_hash_exists(this->h,key);
}


DEFINE_DYNAMIC_FUNC1(IntHash_obj,exists,return )

bool IntHash_obj::remove( int key){
	return ::__int_hash_remove(this->h,key);
}


DEFINE_DYNAMIC_FUNC1(IntHash_obj,remove,return )

Dynamic IntHash_obj::keys( ){
	Array<int > a = ::__int_hash_keys(this->h);
	return a->iterator();
}


DEFINE_DYNAMIC_FUNC0(IntHash_obj,keys,return )

Dynamic IntHash_obj::iterator( ){
	Array<Dynamic > a = ::__int_hash_values(this->h);
	return a->iterator();
}


DEFINE_DYNAMIC_FUNC0(IntHash_obj,iterator,return )

String IntHash_obj::toString( ){
	StringBuf s = StringBuf_obj::__new();
	hxAddEq(s->b,STRING(L"{",1));
	Dynamic it = this->keys();
	for(Dynamic __it = it;  __it->__Field(STRING(L"hasNext",7))(); ){
int i = __it->__Field(STRING(L"next",4))();
		{
			hxAddEq(s->b,i);
			hxAddEq(s->b,STRING(L" => ",4));
			hxAddEq(s->b,Std_obj::string(this->get(i)));
			if (it->__Field(STRING(L"hasNext",7))())
				hxAddEq(s->b,STRING(L", ",2));
		}
;
	}
	hxAddEq(s->b,STRING(L"}",1));
	return s->b;
}


DEFINE_DYNAMIC_FUNC0(IntHash_obj,toString,return )


IntHash_obj::IntHash_obj()
{
	InitMember(h);
}

void IntHash_obj::__Mark()
{
	MarkMember(h);
}

Dynamic IntHash_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"h",sizeof(wchar_t)*1) ) { return h; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"set",sizeof(wchar_t)*3) ) { return set_dyn(); }
		if (!memcmp(inName.__s,L"get",sizeof(wchar_t)*3) ) { return get_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"keys",sizeof(wchar_t)*4) ) { return keys_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"exists",sizeof(wchar_t)*6) ) { return exists_dyn(); }
		if (!memcmp(inName.__s,L"remove",sizeof(wchar_t)*6) ) { return remove_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"iterator",sizeof(wchar_t)*8) ) { return iterator_dyn(); }
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_h = __hxcpp_field_to_id("h");
static int __id_set = __hxcpp_field_to_id("set");
static int __id_get = __hxcpp_field_to_id("get");
static int __id_exists = __hxcpp_field_to_id("exists");
static int __id_remove = __hxcpp_field_to_id("remove");
static int __id_keys = __hxcpp_field_to_id("keys");
static int __id_iterator = __hxcpp_field_to_id("iterator");
static int __id_toString = __hxcpp_field_to_id("toString");


Dynamic IntHash_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_h) return h;
	if (inFieldID==__id_set) return set_dyn();
	if (inFieldID==__id_get) return get_dyn();
	if (inFieldID==__id_exists) return exists_dyn();
	if (inFieldID==__id_remove) return remove_dyn();
	if (inFieldID==__id_keys) return keys_dyn();
	if (inFieldID==__id_iterator) return iterator_dyn();
	if (inFieldID==__id_toString) return toString_dyn();
	return super::__IField(inFieldID);
}

Dynamic IntHash_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"h",sizeof(wchar_t)*1) ) { h=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void IntHash_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"h",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"h",1),
	STRING(L"set",3),
	STRING(L"get",3),
	STRING(L"exists",6),
	STRING(L"remove",6),
	STRING(L"keys",4),
	STRING(L"iterator",8),
	STRING(L"toString",8),
	String(null()) };

static void sMarkStatics() {
};

Class IntHash_obj::__mClass;

void IntHash_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"IntHash",7), TCanCast<IntHash_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void IntHash_obj::__boot()
{
}

