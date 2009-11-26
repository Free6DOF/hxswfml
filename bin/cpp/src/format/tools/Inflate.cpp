#include <hxObject.h>

#ifndef INCLUDED_format_tools_Inflate
#include <format/tools/Inflate.h>
#endif
#ifndef INCLUDED_format_tools_InflateImpl
#include <format/tools/InflateImpl.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesInput
#include <haxe/io/BytesInput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace tools{

Void Inflate_obj::__construct()
{
	return null();
}

Inflate_obj::~Inflate_obj() { }

Dynamic Inflate_obj::__CreateEmpty() { return  new Inflate_obj; }
hxObjectPtr<Inflate_obj > Inflate_obj::__new()
{  hxObjectPtr<Inflate_obj > result = new Inflate_obj();
	result->__construct();
	return result;}

Dynamic Inflate_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Inflate_obj > result = new Inflate_obj();
	result->__construct();
	return result;}

haxe::io::Bytes Inflate_obj::run( haxe::io::Bytes bytes){
	return format::tools::InflateImpl_obj::run(haxe::io::BytesInput_obj::__new(bytes,null(),null()),null());
}


STATIC_DEFINE_DYNAMIC_FUNC1(Inflate_obj,run,return )


Inflate_obj::Inflate_obj()
{
}

void Inflate_obj::__Mark()
{
}

Dynamic Inflate_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"run",sizeof(wchar_t)*3) ) { return run_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_run = __hxcpp_field_to_id("run");


Dynamic Inflate_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_run) return run_dyn();
	return super::__IField(inFieldID);
}

Dynamic Inflate_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Inflate_obj::__GetFields(Array<String> &outFields)
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

Class Inflate_obj::__mClass;

void Inflate_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.Inflate",20), TCanCast<Inflate_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Inflate_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
