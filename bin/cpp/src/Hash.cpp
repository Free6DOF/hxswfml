#include <hxObject.h>

#ifndef INCLUDED_Hash
#include <Hash.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif

Void Hash_obj::__construct()
{
{
	this->h = hxAnon_obj::Create();
}
;
	return null();
}

Hash_obj::~Hash_obj() { }

Dynamic Hash_obj::__CreateEmpty() { return  new Hash_obj; }
hxObjectPtr<Hash_obj > Hash_obj::__new()
{  hxObjectPtr<Hash_obj > result = new Hash_obj();
	result->__construct();
	return result;}

Dynamic Hash_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Hash_obj > result = new Hash_obj();
	result->__construct();
	return result;}

Void Hash_obj::set( String key,Dynamic value){
{
		this->h->__SetField(key,value);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Hash_obj,set,(void))

Dynamic Hash_obj::get( String key){
	return this->h->__Field(key);
}


DEFINE_DYNAMIC_FUNC1(Hash_obj,get,return )

bool Hash_obj::exists( String key){
	return this->h->__Field(key) != null();
}


DEFINE_DYNAMIC_FUNC1(Hash_obj,exists,return )

bool Hash_obj::remove( String key){
	return ::__hx_anon_remove(this->h,key);
}


DEFINE_DYNAMIC_FUNC1(Hash_obj,remove,return )

Dynamic Hash_obj::keys( ){
	Array<String > a = Array_obj<String >::__new();
	this->h->__GetFields(a);
	return a->iterator();
}


DEFINE_DYNAMIC_FUNC0(Hash_obj,keys,return )

Dynamic Hash_obj::iterator( ){
	Array<String > a = Array_obj<String >::__new();
	this->h->__GetFields(a);
	Array<Dynamic > it = Array_obj<Dynamic >::__new().Add(a->iterator());

	BEGIN_LOCAL_FUNC1(_Function_1,Array<Dynamic >,it)
	bool run(){
{
			return it[0]->__Field(STRING(L"hasNext",7))();
		}
		return null();
	}
	END_LOCAL_FUNC0(return)


	BEGIN_LOCAL_FUNC2(_Function_2,Dynamic,h,Array<Dynamic >,it)
	Dynamic run(){
{
			return h->__Field(it[0]->__Field(STRING(L"next",4))());
		}
		return null();
	}
	END_LOCAL_FUNC0(return)

	return hxAnon_obj::Create()->Add( STRING(L"hasNext",7) ,  Dynamic(new _Function_1(it)))->Add( STRING(L"next",4) ,  Dynamic(new _Function_2(h,it)));
}


DEFINE_DYNAMIC_FUNC0(Hash_obj,iterator,return )

String Hash_obj::toString( ){
	StringBuf s = StringBuf_obj::__new();
	hxAddEq(s->b,STRING(L"{",1));
	Dynamic it = this->keys();
	for(Dynamic __it = it;  __it->__Field(STRING(L"hasNext",7))(); ){
String i = __it->__Field(STRING(L"next",4))();
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


DEFINE_DYNAMIC_FUNC0(Hash_obj,toString,return )


Hash_obj::Hash_obj()
{
	InitMember(h);
}

void Hash_obj::__Mark()
{
	MarkMember(h);
}

Dynamic Hash_obj::__Field(const String &inName)
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


Dynamic Hash_obj::__IField(int inFieldID)
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

Dynamic Hash_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"h",sizeof(wchar_t)*1) ) { h=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Hash_obj::__GetFields(Array<String> &outFields)
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

Class Hash_obj::__mClass;

void Hash_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"Hash",4), TCanCast<Hash_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Hash_obj::__boot()
{
}

