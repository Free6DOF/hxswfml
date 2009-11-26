#include <hxObject.h>

#ifndef INCLUDED_format_swf_Filter
#include <format/swf/Filter.h>
#endif
namespace format{
namespace swf{

Filter  Filter_obj::FBevel(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FBevel",6),3,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FBlur(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FBlur",5),1,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FColorMatrix(Array<double > data)
	{ return CreateEnum<Filter_obj >(STRING(L"FColorMatrix",12),5,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FDropShadow(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FDropShadow",11),0,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FGlow(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FGlow",5),2,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FGradientBevel(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FGradientBevel",14),6,DynamicArray(0,1).Add(data)); }

Filter  Filter_obj::FGradientGlow(Dynamic data)
	{ return CreateEnum<Filter_obj >(STRING(L"FGradientGlow",13),4,DynamicArray(0,1).Add(data)); }

DEFINE_CREATE_ENUM(Filter_obj)

int Filter_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FBevel",6)) return 3;
	if (inName==STRING(L"FBlur",5)) return 1;
	if (inName==STRING(L"FColorMatrix",12)) return 5;
	if (inName==STRING(L"FDropShadow",11)) return 0;
	if (inName==STRING(L"FGlow",5)) return 2;
	if (inName==STRING(L"FGradientBevel",14)) return 6;
	if (inName==STRING(L"FGradientGlow",13)) return 4;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FBevel,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FBlur,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FColorMatrix,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FDropShadow,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FGlow,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FGradientBevel,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Filter_obj,FGradientGlow,return)

int Filter_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FBevel",6)) return 1;
	if (inName==STRING(L"FBlur",5)) return 1;
	if (inName==STRING(L"FColorMatrix",12)) return 1;
	if (inName==STRING(L"FDropShadow",11)) return 1;
	if (inName==STRING(L"FGlow",5)) return 1;
	if (inName==STRING(L"FGradientBevel",14)) return 1;
	if (inName==STRING(L"FGradientGlow",13)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic Filter_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FBevel",6)) return FBevel_dyn();
	if (inName==STRING(L"FBlur",5)) return FBlur_dyn();
	if (inName==STRING(L"FColorMatrix",12)) return FColorMatrix_dyn();
	if (inName==STRING(L"FDropShadow",11)) return FDropShadow_dyn();
	if (inName==STRING(L"FGlow",5)) return FGlow_dyn();
	if (inName==STRING(L"FGradientBevel",14)) return FGradientBevel_dyn();
	if (inName==STRING(L"FGradientGlow",13)) return FGradientGlow_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FBevel",6),
	STRING(L"FBlur",5),
	STRING(L"FColorMatrix",12),
	STRING(L"FDropShadow",11),
	STRING(L"FGlow",5),
	STRING(L"FGradientBevel",14),
	STRING(L"FGradientGlow",13),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class Filter_obj::__mClass;

Dynamic __Create_Filter_obj() { return new Filter_obj; }

void Filter_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.Filter",17), TCanCast<Filter_obj >,sStaticFields,sMemberFields,
	&__Create_Filter_obj, &__Create,
	&super::__SGetClass(), &CreateFilter_obj, sMarkStatics);
}

void Filter_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
