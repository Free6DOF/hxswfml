#include <hxObject.h>

#ifndef INCLUDED_format_swf_ChannelMode
#include <format/swf/ChannelMode.h>
#endif
namespace format{
namespace swf{

ChannelMode ChannelMode_obj::DualChannel;

ChannelMode ChannelMode_obj::JointStereo;

ChannelMode ChannelMode_obj::Mono;

ChannelMode ChannelMode_obj::Stereo;

DEFINE_CREATE_ENUM(ChannelMode_obj)

int ChannelMode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"DualChannel",11)) return 2;
	if (inName==STRING(L"JointStereo",11)) return 1;
	if (inName==STRING(L"Mono",4)) return 3;
	if (inName==STRING(L"Stereo",6)) return 0;
	return super::__FindIndex(inName);
}

int ChannelMode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"DualChannel",11)) return 0;
	if (inName==STRING(L"JointStereo",11)) return 0;
	if (inName==STRING(L"Mono",4)) return 0;
	if (inName==STRING(L"Stereo",6)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic ChannelMode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"DualChannel",11)) return DualChannel;
	if (inName==STRING(L"JointStereo",11)) return JointStereo;
	if (inName==STRING(L"Mono",4)) return Mono;
	if (inName==STRING(L"Stereo",6)) return Stereo;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"DualChannel",11),
	STRING(L"JointStereo",11),
	STRING(L"Mono",4),
	STRING(L"Stereo",6),
	String(null()) };

static void sMarkStatics() {
	MarkMember(ChannelMode_obj::DualChannel);
	MarkMember(ChannelMode_obj::JointStereo);
	MarkMember(ChannelMode_obj::Mono);
	MarkMember(ChannelMode_obj::Stereo);
};

static String sMemberFields[] = { String(null()) };
Class ChannelMode_obj::__mClass;

Dynamic __Create_ChannelMode_obj() { return new ChannelMode_obj; }

void ChannelMode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.ChannelMode",22), TCanCast<ChannelMode_obj >,sStaticFields,sMemberFields,
	&__Create_ChannelMode_obj, &__Create,
	&super::__SGetClass(), &CreateChannelMode_obj, sMarkStatics);
}

void ChannelMode_obj::__boot()
{
Static(DualChannel) = CreateEnum<ChannelMode_obj >(STRING(L"DualChannel",11),2);
Static(JointStereo) = CreateEnum<ChannelMode_obj >(STRING(L"JointStereo",11),1);
Static(Mono) = CreateEnum<ChannelMode_obj >(STRING(L"Mono",4),3);
Static(Stereo) = CreateEnum<ChannelMode_obj >(STRING(L"Stereo",6),0);
}


} // end namespace format
} // end namespace swf
