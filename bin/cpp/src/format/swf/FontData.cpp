#include <hxObject.h>

#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
namespace format{
namespace swf{

FontData  FontData_obj::FDFont1(Dynamic data)
	{ return CreateEnum<FontData_obj >(STRING(L"FDFont1",7),0,DynamicArray(0,1).Add(data)); }

FontData  FontData_obj::FDFont2(bool hasWideChars,Dynamic data)
	{ return CreateEnum<FontData_obj >(STRING(L"FDFont2",7),1,DynamicArray(0,2).Add(hasWideChars).Add(data)); }

FontData  FontData_obj::FDFont3(Dynamic data)
	{ return CreateEnum<FontData_obj >(STRING(L"FDFont3",7),2,DynamicArray(0,1).Add(data)); }

DEFINE_CREATE_ENUM(FontData_obj)

int FontData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FDFont1",7)) return 0;
	if (inName==STRING(L"FDFont2",7)) return 1;
	if (inName==STRING(L"FDFont3",7)) return 2;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(FontData_obj,FDFont1,return)

STATIC_DEFINE_DYNAMIC_FUNC2(FontData_obj,FDFont2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(FontData_obj,FDFont3,return)

int FontData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FDFont1",7)) return 1;
	if (inName==STRING(L"FDFont2",7)) return 2;
	if (inName==STRING(L"FDFont3",7)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic FontData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FDFont1",7)) return FDFont1_dyn();
	if (inName==STRING(L"FDFont2",7)) return FDFont2_dyn();
	if (inName==STRING(L"FDFont3",7)) return FDFont3_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FDFont1",7),
	STRING(L"FDFont2",7),
	STRING(L"FDFont3",7),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class FontData_obj::__mClass;

Dynamic __Create_FontData_obj() { return new FontData_obj; }

void FontData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.FontData",19), TCanCast<FontData_obj >,sStaticFields,sMemberFields,
	&__Create_FontData_obj, &__Create,
	&super::__SGetClass(), &CreateFontData_obj, sMarkStatics);
}

void FontData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
