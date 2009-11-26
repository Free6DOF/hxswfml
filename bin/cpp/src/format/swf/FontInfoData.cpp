#include <hxObject.h>

#ifndef INCLUDED_format_swf_FontInfoData
#include <format/swf/FontInfoData.h>
#endif
#ifndef INCLUDED_format_swf_LangCode
#include <format/swf/LangCode.h>
#endif
namespace format{
namespace swf{

FontInfoData  FontInfoData_obj::FIDFont1(bool shiftJIS,bool isANSI,bool hasWideCodes,Dynamic data)
	{ return CreateEnum<FontInfoData_obj >(STRING(L"FIDFont1",8),0,DynamicArray(0,4).Add(shiftJIS).Add(isANSI).Add(hasWideCodes).Add(data)); }

FontInfoData  FontInfoData_obj::FIDFont2(format::swf::LangCode language,Dynamic data)
	{ return CreateEnum<FontInfoData_obj >(STRING(L"FIDFont2",8),1,DynamicArray(0,2).Add(language).Add(data)); }

DEFINE_CREATE_ENUM(FontInfoData_obj)

int FontInfoData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FIDFont1",8)) return 0;
	if (inName==STRING(L"FIDFont2",8)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC4(FontInfoData_obj,FIDFont1,return)

STATIC_DEFINE_DYNAMIC_FUNC2(FontInfoData_obj,FIDFont2,return)

int FontInfoData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FIDFont1",8)) return 4;
	if (inName==STRING(L"FIDFont2",8)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic FontInfoData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FIDFont1",8)) return FIDFont1_dyn();
	if (inName==STRING(L"FIDFont2",8)) return FIDFont2_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FIDFont1",8),
	STRING(L"FIDFont2",8),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class FontInfoData_obj::__mClass;

Dynamic __Create_FontInfoData_obj() { return new FontInfoData_obj; }

void FontInfoData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.FontInfoData",23), TCanCast<FontInfoData_obj >,sStaticFields,sMemberFields,
	&__Create_FontInfoData_obj, &__Create,
	&super::__SGetClass(), &CreateFontInfoData_obj, sMarkStatics);
}

void FontInfoData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
