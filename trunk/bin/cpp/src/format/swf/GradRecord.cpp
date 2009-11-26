#include <hxObject.h>

#ifndef INCLUDED_format_swf_GradRecord
#include <format/swf/GradRecord.h>
#endif
namespace format{
namespace swf{

GradRecord  GradRecord_obj::GRRGB(int pos,Dynamic col)
	{ return CreateEnum<GradRecord_obj >(STRING(L"GRRGB",5),0,DynamicArray(0,2).Add(pos).Add(col)); }

GradRecord  GradRecord_obj::GRRGBA(int pos,Dynamic col)
	{ return CreateEnum<GradRecord_obj >(STRING(L"GRRGBA",6),1,DynamicArray(0,2).Add(pos).Add(col)); }

DEFINE_CREATE_ENUM(GradRecord_obj)

int GradRecord_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"GRRGB",5)) return 0;
	if (inName==STRING(L"GRRGBA",6)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(GradRecord_obj,GRRGB,return)

STATIC_DEFINE_DYNAMIC_FUNC2(GradRecord_obj,GRRGBA,return)

int GradRecord_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"GRRGB",5)) return 2;
	if (inName==STRING(L"GRRGBA",6)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic GradRecord_obj::__Field(const String &inName)
{
	if (inName==STRING(L"GRRGB",5)) return GRRGB_dyn();
	if (inName==STRING(L"GRRGBA",6)) return GRRGBA_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"GRRGB",5),
	STRING(L"GRRGBA",6),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class GradRecord_obj::__mClass;

Dynamic __Create_GradRecord_obj() { return new GradRecord_obj; }

void GradRecord_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.GradRecord",21), TCanCast<GradRecord_obj >,sStaticFields,sMemberFields,
	&__Create_GradRecord_obj, &__Create,
	&super::__SGetClass(), &CreateGradRecord_obj, sMarkStatics);
}

void GradRecord_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
