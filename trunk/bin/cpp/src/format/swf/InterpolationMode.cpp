#include <hxObject.h>

#ifndef INCLUDED_format_swf_InterpolationMode
#include <format/swf/InterpolationMode.h>
#endif
namespace format{
namespace swf{

InterpolationMode InterpolationMode_obj::IMLinearRGB;

InterpolationMode InterpolationMode_obj::IMNormalRGB;

InterpolationMode InterpolationMode_obj::IMReserved1;

InterpolationMode InterpolationMode_obj::IMReserved2;

DEFINE_CREATE_ENUM(InterpolationMode_obj)

int InterpolationMode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"IMLinearRGB",11)) return 1;
	if (inName==STRING(L"IMNormalRGB",11)) return 0;
	if (inName==STRING(L"IMReserved1",11)) return 2;
	if (inName==STRING(L"IMReserved2",11)) return 3;
	return super::__FindIndex(inName);
}

int InterpolationMode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"IMLinearRGB",11)) return 0;
	if (inName==STRING(L"IMNormalRGB",11)) return 0;
	if (inName==STRING(L"IMReserved1",11)) return 0;
	if (inName==STRING(L"IMReserved2",11)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic InterpolationMode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"IMLinearRGB",11)) return IMLinearRGB;
	if (inName==STRING(L"IMNormalRGB",11)) return IMNormalRGB;
	if (inName==STRING(L"IMReserved1",11)) return IMReserved1;
	if (inName==STRING(L"IMReserved2",11)) return IMReserved2;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"IMLinearRGB",11),
	STRING(L"IMNormalRGB",11),
	STRING(L"IMReserved1",11),
	STRING(L"IMReserved2",11),
	String(null()) };

static void sMarkStatics() {
	MarkMember(InterpolationMode_obj::IMLinearRGB);
	MarkMember(InterpolationMode_obj::IMNormalRGB);
	MarkMember(InterpolationMode_obj::IMReserved1);
	MarkMember(InterpolationMode_obj::IMReserved2);
};

static String sMemberFields[] = { String(null()) };
Class InterpolationMode_obj::__mClass;

Dynamic __Create_InterpolationMode_obj() { return new InterpolationMode_obj; }

void InterpolationMode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.InterpolationMode",28), TCanCast<InterpolationMode_obj >,sStaticFields,sMemberFields,
	&__Create_InterpolationMode_obj, &__Create,
	&super::__SGetClass(), &CreateInterpolationMode_obj, sMarkStatics);
}

void InterpolationMode_obj::__boot()
{
Static(IMLinearRGB) = CreateEnum<InterpolationMode_obj >(STRING(L"IMLinearRGB",11),1);
Static(IMNormalRGB) = CreateEnum<InterpolationMode_obj >(STRING(L"IMNormalRGB",11),0);
Static(IMReserved1) = CreateEnum<InterpolationMode_obj >(STRING(L"IMReserved1",11),2);
Static(IMReserved2) = CreateEnum<InterpolationMode_obj >(STRING(L"IMReserved2",11),3);
}


} // end namespace format
} // end namespace swf
