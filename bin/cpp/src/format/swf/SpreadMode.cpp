#include <hxObject.h>

#ifndef INCLUDED_format_swf_SpreadMode
#include <format/swf/SpreadMode.h>
#endif
namespace format{
namespace swf{

SpreadMode SpreadMode_obj::SMPad;

SpreadMode SpreadMode_obj::SMReflect;

SpreadMode SpreadMode_obj::SMRepeat;

SpreadMode SpreadMode_obj::SMReserved;

DEFINE_CREATE_ENUM(SpreadMode_obj)

int SpreadMode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SMPad",5)) return 0;
	if (inName==STRING(L"SMReflect",9)) return 1;
	if (inName==STRING(L"SMRepeat",8)) return 2;
	if (inName==STRING(L"SMReserved",10)) return 3;
	return super::__FindIndex(inName);
}

int SpreadMode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SMPad",5)) return 0;
	if (inName==STRING(L"SMReflect",9)) return 0;
	if (inName==STRING(L"SMRepeat",8)) return 0;
	if (inName==STRING(L"SMReserved",10)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic SpreadMode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SMPad",5)) return SMPad;
	if (inName==STRING(L"SMReflect",9)) return SMReflect;
	if (inName==STRING(L"SMRepeat",8)) return SMRepeat;
	if (inName==STRING(L"SMReserved",10)) return SMReserved;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SMPad",5),
	STRING(L"SMReflect",9),
	STRING(L"SMRepeat",8),
	STRING(L"SMReserved",10),
	String(null()) };

static void sMarkStatics() {
	MarkMember(SpreadMode_obj::SMPad);
	MarkMember(SpreadMode_obj::SMReflect);
	MarkMember(SpreadMode_obj::SMRepeat);
	MarkMember(SpreadMode_obj::SMReserved);
};

static String sMemberFields[] = { String(null()) };
Class SpreadMode_obj::__mClass;

Dynamic __Create_SpreadMode_obj() { return new SpreadMode_obj; }

void SpreadMode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SpreadMode",21), TCanCast<SpreadMode_obj >,sStaticFields,sMemberFields,
	&__Create_SpreadMode_obj, &__Create,
	&super::__SGetClass(), &CreateSpreadMode_obj, sMarkStatics);
}

void SpreadMode_obj::__boot()
{
Static(SMPad) = CreateEnum<SpreadMode_obj >(STRING(L"SMPad",5),0);
Static(SMReflect) = CreateEnum<SpreadMode_obj >(STRING(L"SMReflect",9),1);
Static(SMRepeat) = CreateEnum<SpreadMode_obj >(STRING(L"SMRepeat",8),2);
Static(SMReserved) = CreateEnum<SpreadMode_obj >(STRING(L"SMReserved",10),3);
}


} // end namespace format
} // end namespace swf
