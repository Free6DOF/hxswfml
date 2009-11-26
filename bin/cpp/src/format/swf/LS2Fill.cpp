#include <hxObject.h>

#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
#ifndef INCLUDED_format_swf_LS2Fill
#include <format/swf/LS2Fill.h>
#endif
namespace format{
namespace swf{

LS2Fill  LS2Fill_obj::LS2FColor(Dynamic color)
	{ return CreateEnum<LS2Fill_obj >(STRING(L"LS2FColor",9),0,DynamicArray(0,1).Add(color)); }

LS2Fill  LS2Fill_obj::LS2FStyle(format::swf::FillStyle style)
	{ return CreateEnum<LS2Fill_obj >(STRING(L"LS2FStyle",9),1,DynamicArray(0,1).Add(style)); }

DEFINE_CREATE_ENUM(LS2Fill_obj)

int LS2Fill_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"LS2FColor",9)) return 0;
	if (inName==STRING(L"LS2FStyle",9)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(LS2Fill_obj,LS2FColor,return)

STATIC_DEFINE_DYNAMIC_FUNC1(LS2Fill_obj,LS2FStyle,return)

int LS2Fill_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"LS2FColor",9)) return 1;
	if (inName==STRING(L"LS2FStyle",9)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic LS2Fill_obj::__Field(const String &inName)
{
	if (inName==STRING(L"LS2FColor",9)) return LS2FColor_dyn();
	if (inName==STRING(L"LS2FStyle",9)) return LS2FStyle_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"LS2FColor",9),
	STRING(L"LS2FStyle",9),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class LS2Fill_obj::__mClass;

Dynamic __Create_LS2Fill_obj() { return new LS2Fill_obj; }

void LS2Fill_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.LS2Fill",18), TCanCast<LS2Fill_obj >,sStaticFields,sMemberFields,
	&__Create_LS2Fill_obj, &__Create,
	&super::__SGetClass(), &CreateLS2Fill_obj, sMarkStatics);
}

void LS2Fill_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
