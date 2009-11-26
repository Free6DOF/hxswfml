#include <hxObject.h>

#ifndef INCLUDED_format_swf_LineStyleData
#include <format/swf/LineStyleData.h>
#endif
namespace format{
namespace swf{

LineStyleData  LineStyleData_obj::LS2(Dynamic data)
	{ return CreateEnum<LineStyleData_obj >(STRING(L"LS2",3),2,DynamicArray(0,1).Add(data)); }

LineStyleData  LineStyleData_obj::LSRGB(Dynamic rgb)
	{ return CreateEnum<LineStyleData_obj >(STRING(L"LSRGB",5),0,DynamicArray(0,1).Add(rgb)); }

LineStyleData  LineStyleData_obj::LSRGBA(Dynamic rgba)
	{ return CreateEnum<LineStyleData_obj >(STRING(L"LSRGBA",6),1,DynamicArray(0,1).Add(rgba)); }

DEFINE_CREATE_ENUM(LineStyleData_obj)

int LineStyleData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"LS2",3)) return 2;
	if (inName==STRING(L"LSRGB",5)) return 0;
	if (inName==STRING(L"LSRGBA",6)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(LineStyleData_obj,LS2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(LineStyleData_obj,LSRGB,return)

STATIC_DEFINE_DYNAMIC_FUNC1(LineStyleData_obj,LSRGBA,return)

int LineStyleData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"LS2",3)) return 1;
	if (inName==STRING(L"LSRGB",5)) return 1;
	if (inName==STRING(L"LSRGBA",6)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic LineStyleData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"LS2",3)) return LS2_dyn();
	if (inName==STRING(L"LSRGB",5)) return LSRGB_dyn();
	if (inName==STRING(L"LSRGBA",6)) return LSRGBA_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"LS2",3),
	STRING(L"LSRGB",5),
	STRING(L"LSRGBA",6),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class LineStyleData_obj::__mClass;

Dynamic __Create_LineStyleData_obj() { return new LineStyleData_obj; }

void LineStyleData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.LineStyleData",24), TCanCast<LineStyleData_obj >,sStaticFields,sMemberFields,
	&__Create_LineStyleData_obj, &__Create,
	&super::__SGetClass(), &CreateLineStyleData_obj, sMarkStatics);
}

void LineStyleData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
