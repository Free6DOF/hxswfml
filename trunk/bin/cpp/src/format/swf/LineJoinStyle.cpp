#include <hxObject.h>

#ifndef INCLUDED_format_swf_LineJoinStyle
#include <format/swf/LineJoinStyle.h>
#endif
namespace format{
namespace swf{

LineJoinStyle LineJoinStyle_obj::LJBevel;

LineJoinStyle  LineJoinStyle_obj::LJMiter(int limitFactor)
	{ return CreateEnum<LineJoinStyle_obj >(STRING(L"LJMiter",7),2,DynamicArray(0,1).Add(limitFactor)); }

LineJoinStyle LineJoinStyle_obj::LJRound;

DEFINE_CREATE_ENUM(LineJoinStyle_obj)

int LineJoinStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"LJBevel",7)) return 1;
	if (inName==STRING(L"LJMiter",7)) return 2;
	if (inName==STRING(L"LJRound",7)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(LineJoinStyle_obj,LJMiter,return)

int LineJoinStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"LJBevel",7)) return 0;
	if (inName==STRING(L"LJMiter",7)) return 1;
	if (inName==STRING(L"LJRound",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic LineJoinStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"LJBevel",7)) return LJBevel;
	if (inName==STRING(L"LJMiter",7)) return LJMiter_dyn();
	if (inName==STRING(L"LJRound",7)) return LJRound;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"LJBevel",7),
	STRING(L"LJMiter",7),
	STRING(L"LJRound",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(LineJoinStyle_obj::LJBevel);
	MarkMember(LineJoinStyle_obj::LJRound);
};

static String sMemberFields[] = { String(null()) };
Class LineJoinStyle_obj::__mClass;

Dynamic __Create_LineJoinStyle_obj() { return new LineJoinStyle_obj; }

void LineJoinStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.LineJoinStyle",24), TCanCast<LineJoinStyle_obj >,sStaticFields,sMemberFields,
	&__Create_LineJoinStyle_obj, &__Create,
	&super::__SGetClass(), &CreateLineJoinStyle_obj, sMarkStatics);
}

void LineJoinStyle_obj::__boot()
{
Static(LJBevel) = CreateEnum<LineJoinStyle_obj >(STRING(L"LJBevel",7),1);
Static(LJRound) = CreateEnum<LineJoinStyle_obj >(STRING(L"LJRound",7),0);
}


} // end namespace format
} // end namespace swf
