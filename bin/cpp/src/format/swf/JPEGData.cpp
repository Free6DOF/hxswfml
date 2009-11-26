#include <hxObject.h>

#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace swf{

JPEGData  JPEGData_obj::JDJPEG1(haxe::io::Bytes data)
	{ return CreateEnum<JPEGData_obj >(STRING(L"JDJPEG1",7),0,DynamicArray(0,1).Add(data)); }

JPEGData  JPEGData_obj::JDJPEG2(haxe::io::Bytes data)
	{ return CreateEnum<JPEGData_obj >(STRING(L"JDJPEG2",7),1,DynamicArray(0,1).Add(data)); }

JPEGData  JPEGData_obj::JDJPEG3(haxe::io::Bytes data,haxe::io::Bytes mask)
	{ return CreateEnum<JPEGData_obj >(STRING(L"JDJPEG3",7),2,DynamicArray(0,2).Add(data).Add(mask)); }

DEFINE_CREATE_ENUM(JPEGData_obj)

int JPEGData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"JDJPEG1",7)) return 0;
	if (inName==STRING(L"JDJPEG2",7)) return 1;
	if (inName==STRING(L"JDJPEG3",7)) return 2;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(JPEGData_obj,JDJPEG1,return)

STATIC_DEFINE_DYNAMIC_FUNC1(JPEGData_obj,JDJPEG2,return)

STATIC_DEFINE_DYNAMIC_FUNC2(JPEGData_obj,JDJPEG3,return)

int JPEGData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"JDJPEG1",7)) return 1;
	if (inName==STRING(L"JDJPEG2",7)) return 1;
	if (inName==STRING(L"JDJPEG3",7)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic JPEGData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"JDJPEG1",7)) return JDJPEG1_dyn();
	if (inName==STRING(L"JDJPEG2",7)) return JDJPEG2_dyn();
	if (inName==STRING(L"JDJPEG3",7)) return JDJPEG3_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"JDJPEG1",7),
	STRING(L"JDJPEG2",7),
	STRING(L"JDJPEG3",7),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class JPEGData_obj::__mClass;

Dynamic __Create_JPEGData_obj() { return new JPEGData_obj; }

void JPEGData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.JPEGData",19), TCanCast<JPEGData_obj >,sStaticFields,sMemberFields,
	&__Create_JPEGData_obj, &__Create,
	&super::__SGetClass(), &CreateJPEGData_obj, sMarkStatics);
}

void JPEGData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
