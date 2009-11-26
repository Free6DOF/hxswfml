#include <hxObject.h>

#ifndef INCLUDED_format_swf_VideoData
#include <format/swf/VideoData.h>
#endif
namespace format{
namespace swf{

VideoData VideoData_obj::H263videoPacket;

VideoData VideoData_obj::SCREENV2videoPacket;

VideoData VideoData_obj::SCREENvideoPacket;

VideoData VideoData_obj::VP6SWFALPHAvideoPacket;

VideoData VideoData_obj::VP6SWFvideoPacket;

DEFINE_CREATE_ENUM(VideoData_obj)

int VideoData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"H263videoPacket",15)) return 0;
	if (inName==STRING(L"SCREENV2videoPacket",19)) return 4;
	if (inName==STRING(L"SCREENvideoPacket",17)) return 1;
	if (inName==STRING(L"VP6SWFALPHAvideoPacket",22)) return 3;
	if (inName==STRING(L"VP6SWFvideoPacket",17)) return 2;
	return super::__FindIndex(inName);
}

int VideoData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"H263videoPacket",15)) return 0;
	if (inName==STRING(L"SCREENV2videoPacket",19)) return 0;
	if (inName==STRING(L"SCREENvideoPacket",17)) return 0;
	if (inName==STRING(L"VP6SWFALPHAvideoPacket",22)) return 0;
	if (inName==STRING(L"VP6SWFvideoPacket",17)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic VideoData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"H263videoPacket",15)) return H263videoPacket;
	if (inName==STRING(L"SCREENV2videoPacket",19)) return SCREENV2videoPacket;
	if (inName==STRING(L"SCREENvideoPacket",17)) return SCREENvideoPacket;
	if (inName==STRING(L"VP6SWFALPHAvideoPacket",22)) return VP6SWFALPHAvideoPacket;
	if (inName==STRING(L"VP6SWFvideoPacket",17)) return VP6SWFvideoPacket;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"H263videoPacket",15),
	STRING(L"SCREENV2videoPacket",19),
	STRING(L"SCREENvideoPacket",17),
	STRING(L"VP6SWFALPHAvideoPacket",22),
	STRING(L"VP6SWFvideoPacket",17),
	String(null()) };

static void sMarkStatics() {
	MarkMember(VideoData_obj::H263videoPacket);
	MarkMember(VideoData_obj::SCREENV2videoPacket);
	MarkMember(VideoData_obj::SCREENvideoPacket);
	MarkMember(VideoData_obj::VP6SWFALPHAvideoPacket);
	MarkMember(VideoData_obj::VP6SWFvideoPacket);
};

static String sMemberFields[] = { String(null()) };
Class VideoData_obj::__mClass;

Dynamic __Create_VideoData_obj() { return new VideoData_obj; }

void VideoData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.VideoData",20), TCanCast<VideoData_obj >,sStaticFields,sMemberFields,
	&__Create_VideoData_obj, &__Create,
	&super::__SGetClass(), &CreateVideoData_obj, sMarkStatics);
}

void VideoData_obj::__boot()
{
Static(H263videoPacket) = CreateEnum<VideoData_obj >(STRING(L"H263videoPacket",15),0);
Static(SCREENV2videoPacket) = CreateEnum<VideoData_obj >(STRING(L"SCREENV2videoPacket",19),4);
Static(SCREENvideoPacket) = CreateEnum<VideoData_obj >(STRING(L"SCREENvideoPacket",17),1);
Static(VP6SWFALPHAvideoPacket) = CreateEnum<VideoData_obj >(STRING(L"VP6SWFALPHAvideoPacket",22),3);
Static(VP6SWFvideoPacket) = CreateEnum<VideoData_obj >(STRING(L"VP6SWFvideoPacket",17),2);
}


} // end namespace format
} // end namespace swf
