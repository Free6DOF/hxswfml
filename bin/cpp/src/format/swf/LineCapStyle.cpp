#include <hxObject.h>

#ifndef INCLUDED_format_swf_LineCapStyle
#include <format/swf/LineCapStyle.h>
#endif
namespace format{
namespace swf{

LineCapStyle LineCapStyle_obj::LCNone;

LineCapStyle LineCapStyle_obj::LCRound;

LineCapStyle LineCapStyle_obj::LCSquare;

DEFINE_CREATE_ENUM(LineCapStyle_obj)

int LineCapStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"LCNone",6)) return 1;
	if (inName==STRING(L"LCRound",7)) return 0;
	if (inName==STRING(L"LCSquare",8)) return 2;
	return super::__FindIndex(inName);
}

int LineCapStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"LCNone",6)) return 0;
	if (inName==STRING(L"LCRound",7)) return 0;
	if (inName==STRING(L"LCSquare",8)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic LineCapStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"LCNone",6)) return LCNone;
	if (inName==STRING(L"LCRound",7)) return LCRound;
	if (inName==STRING(L"LCSquare",8)) return LCSquare;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"LCNone",6),
	STRING(L"LCRound",7),
	STRING(L"LCSquare",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(LineCapStyle_obj::LCNone);
	MarkMember(LineCapStyle_obj::LCRound);
	MarkMember(LineCapStyle_obj::LCSquare);
};

static String sMemberFields[] = { String(null()) };
Class LineCapStyle_obj::__mClass;

Dynamic __Create_LineCapStyle_obj() { return new LineCapStyle_obj; }

void LineCapStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.LineCapStyle",23), TCanCast<LineCapStyle_obj >,sStaticFields,sMemberFields,
	&__Create_LineCapStyle_obj, &__Create,
	&super::__SGetClass(), &CreateLineCapStyle_obj, sMarkStatics);
}

void LineCapStyle_obj::__boot()
{
Static(LCNone) = CreateEnum<LineCapStyle_obj >(STRING(L"LCNone",6),1);
Static(LCRound) = CreateEnum<LineCapStyle_obj >(STRING(L"LCRound",7),0);
Static(LCSquare) = CreateEnum<LineCapStyle_obj >(STRING(L"LCSquare",8),2);
}


} // end namespace format
} // end namespace swf
