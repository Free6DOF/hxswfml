#include <hxObject.h>

#ifndef INCLUDED_format_tools_IO
#include <format/tools/IO.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace tools{

Void IO_obj::__construct()
{
	return null();
}

IO_obj::~IO_obj() { }

Dynamic IO_obj::__CreateEmpty() { return  new IO_obj; }
hxObjectPtr<IO_obj > IO_obj::__new()
{  hxObjectPtr<IO_obj > result = new IO_obj();
	result->__construct();
	return result;}

Dynamic IO_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<IO_obj > result = new IO_obj();
	result->__construct();
	return result;}

Void IO_obj::copy( haxe::io::Input i,haxe::io::Output o,haxe::io::Bytes buf,int size){
{
		int bufsize = buf->length;
		while(size > 0){
			int n = i->readBytes(buf,0,size > bufsize ? int( bufsize ) : int( size ));
			hxSubEq(size,n);
			o->writeFullBytes(buf,0,n);
		}
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC4(IO_obj,copy,(void))


IO_obj::IO_obj()
{
}

void IO_obj::__Mark()
{
}

Dynamic IO_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"copy",sizeof(wchar_t)*4) ) { return copy_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_copy = __hxcpp_field_to_id("copy");


Dynamic IO_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_copy) return copy_dyn();
	return super::__IField(inFieldID);
}

Dynamic IO_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void IO_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"copy",4),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class IO_obj::__mClass;

void IO_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.IO",15), TCanCast<IO_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void IO_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
