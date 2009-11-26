#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_zip_ExtraField
#include <format/zip/ExtraField.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace zip{

ExtraField  ExtraField_obj::FInfoZipUnicodePath(String name,cpp::CppInt32__ crc)
	{ return CreateEnum<ExtraField_obj >(STRING(L"FInfoZipUnicodePath",19),1,DynamicArray(0,2).Add(name).Add(crc)); }

ExtraField  ExtraField_obj::FUnknown(int tag,haxe::io::Bytes bytes)
	{ return CreateEnum<ExtraField_obj >(STRING(L"FUnknown",8),0,DynamicArray(0,2).Add(tag).Add(bytes)); }

DEFINE_CREATE_ENUM(ExtraField_obj)

int ExtraField_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FInfoZipUnicodePath",19)) return 1;
	if (inName==STRING(L"FUnknown",8)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(ExtraField_obj,FInfoZipUnicodePath,return)

STATIC_DEFINE_DYNAMIC_FUNC2(ExtraField_obj,FUnknown,return)

int ExtraField_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FInfoZipUnicodePath",19)) return 2;
	if (inName==STRING(L"FUnknown",8)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic ExtraField_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FInfoZipUnicodePath",19)) return FInfoZipUnicodePath_dyn();
	if (inName==STRING(L"FUnknown",8)) return FUnknown_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FInfoZipUnicodePath",19),
	STRING(L"FUnknown",8),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class ExtraField_obj::__mClass;

Dynamic __Create_ExtraField_obj() { return new ExtraField_obj; }

void ExtraField_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.zip.ExtraField",21), TCanCast<ExtraField_obj >,sStaticFields,sMemberFields,
	&__Create_ExtraField_obj, &__Create,
	&super::__SGetClass(), &CreateExtraField_obj, sMarkStatics);
}

void ExtraField_obj::__boot()
{
}


} // end namespace format
} // end namespace zip
