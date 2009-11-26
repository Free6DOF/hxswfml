#include <hxObject.h>

#ifndef INCLUDED_format_mp3_FrameType
#include <format/mp3/FrameType.h>
#endif
namespace format{
namespace mp3{

FrameType FrameType_obj::FT_MP3;

FrameType FrameType_obj::FT_NONE;

DEFINE_CREATE_ENUM(FrameType_obj)

int FrameType_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FT_MP3",6)) return 0;
	if (inName==STRING(L"FT_NONE",7)) return 1;
	return super::__FindIndex(inName);
}

int FrameType_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FT_MP3",6)) return 0;
	if (inName==STRING(L"FT_NONE",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic FrameType_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FT_MP3",6)) return FT_MP3;
	if (inName==STRING(L"FT_NONE",7)) return FT_NONE;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FT_MP3",6),
	STRING(L"FT_NONE",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(FrameType_obj::FT_MP3);
	MarkMember(FrameType_obj::FT_NONE);
};

static String sMemberFields[] = { String(null()) };
Class FrameType_obj::__mClass;

Dynamic __Create_FrameType_obj() { return new FrameType_obj; }

void FrameType_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.mp3.FrameType",20), TCanCast<FrameType_obj >,sStaticFields,sMemberFields,
	&__Create_FrameType_obj, &__Create,
	&super::__SGetClass(), &CreateFrameType_obj, sMarkStatics);
}

void FrameType_obj::__boot()
{
Static(FT_MP3) = CreateEnum<FrameType_obj >(STRING(L"FT_MP3",6),0);
Static(FT_NONE) = CreateEnum<FrameType_obj >(STRING(L"FT_NONE",7),1);
}


} // end namespace format
} // end namespace mp3
