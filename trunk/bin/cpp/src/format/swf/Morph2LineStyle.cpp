#include <hxObject.h>

#ifndef INCLUDED_format_swf_Morph2LineStyle
#include <format/swf/Morph2LineStyle.h>
#endif
#ifndef INCLUDED_format_swf_MorphFillStyle
#include <format/swf/MorphFillStyle.h>
#endif
namespace format{
namespace swf{

Morph2LineStyle  Morph2LineStyle_obj::M2LSFill(format::swf::MorphFillStyle fill,Dynamic data)
	{ return CreateEnum<Morph2LineStyle_obj >(STRING(L"M2LSFill",8),1,DynamicArray(0,2).Add(fill).Add(data)); }

Morph2LineStyle  Morph2LineStyle_obj::M2LSNoFill(Dynamic startColor,Dynamic endColor,Dynamic data)
	{ return CreateEnum<Morph2LineStyle_obj >(STRING(L"M2LSNoFill",10),0,DynamicArray(0,3).Add(startColor).Add(endColor).Add(data)); }

DEFINE_CREATE_ENUM(Morph2LineStyle_obj)

int Morph2LineStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"M2LSFill",8)) return 1;
	if (inName==STRING(L"M2LSNoFill",10)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(Morph2LineStyle_obj,M2LSFill,return)

STATIC_DEFINE_DYNAMIC_FUNC3(Morph2LineStyle_obj,M2LSNoFill,return)

int Morph2LineStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"M2LSFill",8)) return 2;
	if (inName==STRING(L"M2LSNoFill",10)) return 3;
	return super::__FindArgCount(inName);
}

Dynamic Morph2LineStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"M2LSFill",8)) return M2LSFill_dyn();
	if (inName==STRING(L"M2LSNoFill",10)) return M2LSNoFill_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"M2LSFill",8),
	STRING(L"M2LSNoFill",10),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class Morph2LineStyle_obj::__mClass;

Dynamic __Create_Morph2LineStyle_obj() { return new Morph2LineStyle_obj; }

void Morph2LineStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.Morph2LineStyle",26), TCanCast<Morph2LineStyle_obj >,sStaticFields,sMemberFields,
	&__Create_Morph2LineStyle_obj, &__Create,
	&super::__SGetClass(), &CreateMorph2LineStyle_obj, sMarkStatics);
}

void Morph2LineStyle_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
