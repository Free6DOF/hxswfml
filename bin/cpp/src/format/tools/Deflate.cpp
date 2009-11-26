#include <hxObject.h>

#ifndef INCLUDED_format_tools_Deflate
#include <format/tools/Deflate.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace tools{

Void Deflate_obj::__construct()
{
	return null();
}

Deflate_obj::~Deflate_obj() { }

Dynamic Deflate_obj::__CreateEmpty() { return  new Deflate_obj; }
hxObjectPtr<Deflate_obj > Deflate_obj::__new()
{  hxObjectPtr<Deflate_obj > result = new Deflate_obj();
	result->__construct();
	return result;}

Dynamic Deflate_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Deflate_obj > result = new Deflate_obj();
	result->__construct();
	return result;}

haxe::io::Bytes Deflate_obj::run( haxe::io::Bytes b){
	hxThrow (STRING(L"Deflate is not supported on this platform",41));
	return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Deflate_obj,run,return )


Deflate_obj::Deflate_obj()
{
}

void Deflate_obj::__Mark()
{
}

Dynamic Deflate_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"run",sizeof(wchar_t)*3) ) { return run_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_run = __hxcpp_field_to_id("run");


Dynamic Deflate_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_run) return run_dyn();
	return super::__IField(inFieldID);
}

Dynamic Deflate_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Deflate_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"run",3),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Deflate_obj::__mClass;

void Deflate_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.Deflate",20), TCanCast<Deflate_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Deflate_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
