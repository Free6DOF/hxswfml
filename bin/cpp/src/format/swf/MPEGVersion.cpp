#include <hxObject.h>

#ifndef INCLUDED_format_swf_MPEGVersion
#include <format/swf/MPEGVersion.h>
#endif
namespace format{
namespace swf{

MPEGVersion MPEGVersion_obj::MPEG_Reserved;

MPEGVersion MPEGVersion_obj::MPEG_V1;

MPEGVersion MPEGVersion_obj::MPEG_V2;

MPEGVersion MPEGVersion_obj::MPEG_V25;

DEFINE_CREATE_ENUM(MPEGVersion_obj)

int MPEGVersion_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"MPEG_Reserved",13)) return 3;
	if (inName==STRING(L"MPEG_V1",7)) return 0;
	if (inName==STRING(L"MPEG_V2",7)) return 1;
	if (inName==STRING(L"MPEG_V25",8)) return 2;
	return super::__FindIndex(inName);
}

int MPEGVersion_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"MPEG_Reserved",13)) return 0;
	if (inName==STRING(L"MPEG_V1",7)) return 0;
	if (inName==STRING(L"MPEG_V2",7)) return 0;
	if (inName==STRING(L"MPEG_V25",8)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic MPEGVersion_obj::__Field(const String &inName)
{
	if (inName==STRING(L"MPEG_Reserved",13)) return MPEG_Reserved;
	if (inName==STRING(L"MPEG_V1",7)) return MPEG_V1;
	if (inName==STRING(L"MPEG_V2",7)) return MPEG_V2;
	if (inName==STRING(L"MPEG_V25",8)) return MPEG_V25;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"MPEG_Reserved",13),
	STRING(L"MPEG_V1",7),
	STRING(L"MPEG_V2",7),
	STRING(L"MPEG_V25",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(MPEGVersion_obj::MPEG_Reserved);
	MarkMember(MPEGVersion_obj::MPEG_V1);
	MarkMember(MPEGVersion_obj::MPEG_V2);
	MarkMember(MPEGVersion_obj::MPEG_V25);
};

static String sMemberFields[] = { String(null()) };
Class MPEGVersion_obj::__mClass;

Dynamic __Create_MPEGVersion_obj() { return new MPEGVersion_obj; }

void MPEGVersion_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.MPEGVersion",22), TCanCast<MPEGVersion_obj >,sStaticFields,sMemberFields,
	&__Create_MPEGVersion_obj, &__Create,
	&super::__SGetClass(), &CreateMPEGVersion_obj, sMarkStatics);
}

void MPEGVersion_obj::__boot()
{
Static(MPEG_Reserved) = CreateEnum<MPEGVersion_obj >(STRING(L"MPEG_Reserved",13),3);
Static(MPEG_V1) = CreateEnum<MPEGVersion_obj >(STRING(L"MPEG_V1",7),0);
Static(MPEG_V2) = CreateEnum<MPEGVersion_obj >(STRING(L"MPEG_V2",7),1);
Static(MPEG_V25) = CreateEnum<MPEGVersion_obj >(STRING(L"MPEG_V25",8),2);
}


} // end namespace format
} // end namespace swf
