#include <hxObject.h>

#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
namespace format{
namespace swf{

FillStyle  FillStyle_obj::FSBitmap(int cid,Dynamic mat,bool repeat,bool smooth)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSBitmap",8),5,DynamicArray(0,4).Add(cid).Add(mat).Add(repeat).Add(smooth)); }

FillStyle  FillStyle_obj::FSFocalGradient(Dynamic mat,Dynamic grad)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSFocalGradient",15),4,DynamicArray(0,2).Add(mat).Add(grad)); }

FillStyle  FillStyle_obj::FSLinearGradient(Dynamic mat,Dynamic grad)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSLinearGradient",16),2,DynamicArray(0,2).Add(mat).Add(grad)); }

FillStyle  FillStyle_obj::FSRadialGradient(Dynamic mat,Dynamic grad)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSRadialGradient",16),3,DynamicArray(0,2).Add(mat).Add(grad)); }

FillStyle  FillStyle_obj::FSSolid(Dynamic rgb)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSSolid",7),0,DynamicArray(0,1).Add(rgb)); }

FillStyle  FillStyle_obj::FSSolidAlpha(Dynamic rgb)
	{ return CreateEnum<FillStyle_obj >(STRING(L"FSSolidAlpha",12),1,DynamicArray(0,1).Add(rgb)); }

DEFINE_CREATE_ENUM(FillStyle_obj)

int FillStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FSBitmap",8)) return 5;
	if (inName==STRING(L"FSFocalGradient",15)) return 4;
	if (inName==STRING(L"FSLinearGradient",16)) return 2;
	if (inName==STRING(L"FSRadialGradient",16)) return 3;
	if (inName==STRING(L"FSSolid",7)) return 0;
	if (inName==STRING(L"FSSolidAlpha",12)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC4(FillStyle_obj,FSBitmap,return)

STATIC_DEFINE_DYNAMIC_FUNC2(FillStyle_obj,FSFocalGradient,return)

STATIC_DEFINE_DYNAMIC_FUNC2(FillStyle_obj,FSLinearGradient,return)

STATIC_DEFINE_DYNAMIC_FUNC2(FillStyle_obj,FSRadialGradient,return)

STATIC_DEFINE_DYNAMIC_FUNC1(FillStyle_obj,FSSolid,return)

STATIC_DEFINE_DYNAMIC_FUNC1(FillStyle_obj,FSSolidAlpha,return)

int FillStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FSBitmap",8)) return 4;
	if (inName==STRING(L"FSFocalGradient",15)) return 2;
	if (inName==STRING(L"FSLinearGradient",16)) return 2;
	if (inName==STRING(L"FSRadialGradient",16)) return 2;
	if (inName==STRING(L"FSSolid",7)) return 1;
	if (inName==STRING(L"FSSolidAlpha",12)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic FillStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FSBitmap",8)) return FSBitmap_dyn();
	if (inName==STRING(L"FSFocalGradient",15)) return FSFocalGradient_dyn();
	if (inName==STRING(L"FSLinearGradient",16)) return FSLinearGradient_dyn();
	if (inName==STRING(L"FSRadialGradient",16)) return FSRadialGradient_dyn();
	if (inName==STRING(L"FSSolid",7)) return FSSolid_dyn();
	if (inName==STRING(L"FSSolidAlpha",12)) return FSSolidAlpha_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FSBitmap",8),
	STRING(L"FSFocalGradient",15),
	STRING(L"FSLinearGradient",16),
	STRING(L"FSRadialGradient",16),
	STRING(L"FSSolid",7),
	STRING(L"FSSolidAlpha",12),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class FillStyle_obj::__mClass;

Dynamic __Create_FillStyle_obj() { return new FillStyle_obj; }

void FillStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.FillStyle",20), TCanCast<FillStyle_obj >,sStaticFields,sMemberFields,
	&__Create_FillStyle_obj, &__Create,
	&super::__SGetClass(), &CreateFillStyle_obj, sMarkStatics);
}

void FillStyle_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
