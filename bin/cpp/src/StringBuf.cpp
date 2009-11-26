#include <hxObject.h>

#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif

Void StringBuf_obj::__construct()
{
{
	this->b = STRING(L"",0);
}
;
	return null();
}

StringBuf_obj::~StringBuf_obj() { }

Dynamic StringBuf_obj::__CreateEmpty() { return  new StringBuf_obj; }
hxObjectPtr<StringBuf_obj > StringBuf_obj::__new()
{  hxObjectPtr<StringBuf_obj > result = new StringBuf_obj();
	result->__construct();
	return result;}

Dynamic StringBuf_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<StringBuf_obj > result = new StringBuf_obj();
	result->__construct();
	return result;}

Void StringBuf_obj::add( Dynamic x){
{
		hxAddEq(this->b,x);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(StringBuf_obj,add,(void))

Void StringBuf_obj::addSub( String s,int pos,Dynamic len){
{
		hxAddEq(this->b,s.substr(pos,len));
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(StringBuf_obj,addSub,(void))

Void StringBuf_obj::addChar( int c){
{
		hxAddEq(this->b,String::fromCharCode(c));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(StringBuf_obj,addChar,(void))

String StringBuf_obj::toString( ){
	return this->b;
}


DEFINE_DYNAMIC_FUNC0(StringBuf_obj,toString,return )


StringBuf_obj::StringBuf_obj()
{
	InitMember(b);
}

void StringBuf_obj::__Mark()
{
	MarkMember(b);
}

Dynamic StringBuf_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { return b; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"add",sizeof(wchar_t)*3) ) { return add_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"addSub",sizeof(wchar_t)*6) ) { return addSub_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"addChar",sizeof(wchar_t)*7) ) { return addChar_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_add = __hxcpp_field_to_id("add");
static int __id_addSub = __hxcpp_field_to_id("addSub");
static int __id_addChar = __hxcpp_field_to_id("addChar");
static int __id_toString = __hxcpp_field_to_id("toString");
static int __id_b = __hxcpp_field_to_id("b");


Dynamic StringBuf_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_add) return add_dyn();
	if (inFieldID==__id_addSub) return addSub_dyn();
	if (inFieldID==__id_addChar) return addChar_dyn();
	if (inFieldID==__id_toString) return toString_dyn();
	if (inFieldID==__id_b) return b;
	return super::__IField(inFieldID);
}

Dynamic StringBuf_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { b=inValue.Cast<String >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void StringBuf_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"b",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"add",3),
	STRING(L"addSub",6),
	STRING(L"addChar",7),
	STRING(L"toString",8),
	STRING(L"b",1),
	String(null()) };

static void sMarkStatics() {
};

Class StringBuf_obj::__mClass;

void StringBuf_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"StringBuf",9), TCanCast<StringBuf_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void StringBuf_obj::__boot()
{
}

