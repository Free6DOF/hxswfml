#include <hxObject.h>

#ifndef INCLUDED_format_tools_Adler32
#include <format/tools/Adler32.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace tools{

Void Adler32_obj::__construct()
{
{
	this->a1 = 1;
	this->a2 = 0;
}
;
	return null();
}

Adler32_obj::~Adler32_obj() { }

Dynamic Adler32_obj::__CreateEmpty() { return  new Adler32_obj; }
hxObjectPtr<Adler32_obj > Adler32_obj::__new()
{  hxObjectPtr<Adler32_obj > result = new Adler32_obj();
	result->__construct();
	return result;}

Dynamic Adler32_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Adler32_obj > result = new Adler32_obj();
	result->__construct();
	return result;}

Void Adler32_obj::update( haxe::io::Bytes b,int pos,int len){
{
		int a1 = this->a1;
		int a2 = this->a2;
		{
			int _g1 = pos;
			int _g = pos + len;
			while(_g1 < _g){
				int p = _g1++;
				int c = b->b->__get(p);
				a1 = hxMod((a1 + c),65521);
				a2 = hxMod((a2 + a1),65521);
			}
		}
		this->a1 = a1;
		this->a2 = a2;
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Adler32_obj,update,(void))

bool Adler32_obj::equals( format::tools::Adler32 a){
	return bool(a->a1 == this->a1) && bool(a->a2 == this->a2);
}


DEFINE_DYNAMIC_FUNC1(Adler32_obj,equals,return )

format::tools::Adler32 Adler32_obj::read( haxe::io::Input i){
	format::tools::Adler32 a = format::tools::Adler32_obj::__new();
	int a2a = i->readByte();
	int a2b = i->readByte();
	int a1a = i->readByte();
	int a1b = i->readByte();
	a->a1 = int((int(a1a) << int(8))) | int(a1b);
	a->a2 = int((int(a2a) << int(8))) | int(a2b);
	return a;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Adler32_obj,read,return )


Adler32_obj::Adler32_obj()
{
	InitMember(a1);
	InitMember(a2);
}

void Adler32_obj::__Mark()
{
	MarkMember(a1);
	MarkMember(a2);
}

Dynamic Adler32_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 2:
		if (!memcmp(inName.__s,L"a1",sizeof(wchar_t)*2) ) { return a1; }
		if (!memcmp(inName.__s,L"a2",sizeof(wchar_t)*2) ) { return a2; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"update",sizeof(wchar_t)*6) ) { return update_dyn(); }
		if (!memcmp(inName.__s,L"equals",sizeof(wchar_t)*6) ) { return equals_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_read = __hxcpp_field_to_id("read");
static int __id_a1 = __hxcpp_field_to_id("a1");
static int __id_a2 = __hxcpp_field_to_id("a2");
static int __id_update = __hxcpp_field_to_id("update");
static int __id_equals = __hxcpp_field_to_id("equals");


Dynamic Adler32_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_read) return read_dyn();
	if (inFieldID==__id_a1) return a1;
	if (inFieldID==__id_a2) return a2;
	if (inFieldID==__id_update) return update_dyn();
	if (inFieldID==__id_equals) return equals_dyn();
	return super::__IField(inFieldID);
}

Dynamic Adler32_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 2:
		if (!memcmp(inName.__s,L"a1",sizeof(wchar_t)*2) ) { a1=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"a2",sizeof(wchar_t)*2) ) { a2=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Adler32_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"a1",2));
	outFields->push(STRING(L"a2",2));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"read",4),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"a1",2),
	STRING(L"a2",2),
	STRING(L"update",6),
	STRING(L"equals",6),
	String(null()) };

static void sMarkStatics() {
};

Class Adler32_obj::__mClass;

void Adler32_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.Adler32",20), TCanCast<Adler32_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Adler32_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
