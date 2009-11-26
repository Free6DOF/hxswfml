#include <hxObject.h>

#ifndef INCLUDED_format_swf_SoundFormat
#include <format/swf/SoundFormat.h>
#endif
namespace format{
namespace swf{

SoundFormat SoundFormat_obj::SFADPCM;

SoundFormat SoundFormat_obj::SFLittleEndianUncompressed;

SoundFormat SoundFormat_obj::SFMP3;

SoundFormat SoundFormat_obj::SFNativeEndianUncompressed;

SoundFormat SoundFormat_obj::SFNellymoser;

SoundFormat SoundFormat_obj::SFNellymoser16k;

SoundFormat SoundFormat_obj::SFNellymoser8k;

SoundFormat SoundFormat_obj::SFSpeex;

DEFINE_CREATE_ENUM(SoundFormat_obj)

int SoundFormat_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SFADPCM",7)) return 1;
	if (inName==STRING(L"SFLittleEndianUncompressed",26)) return 3;
	if (inName==STRING(L"SFMP3",5)) return 2;
	if (inName==STRING(L"SFNativeEndianUncompressed",26)) return 0;
	if (inName==STRING(L"SFNellymoser",12)) return 6;
	if (inName==STRING(L"SFNellymoser16k",15)) return 4;
	if (inName==STRING(L"SFNellymoser8k",14)) return 5;
	if (inName==STRING(L"SFSpeex",7)) return 7;
	return super::__FindIndex(inName);
}

int SoundFormat_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SFADPCM",7)) return 0;
	if (inName==STRING(L"SFLittleEndianUncompressed",26)) return 0;
	if (inName==STRING(L"SFMP3",5)) return 0;
	if (inName==STRING(L"SFNativeEndianUncompressed",26)) return 0;
	if (inName==STRING(L"SFNellymoser",12)) return 0;
	if (inName==STRING(L"SFNellymoser16k",15)) return 0;
	if (inName==STRING(L"SFNellymoser8k",14)) return 0;
	if (inName==STRING(L"SFSpeex",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic SoundFormat_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SFADPCM",7)) return SFADPCM;
	if (inName==STRING(L"SFLittleEndianUncompressed",26)) return SFLittleEndianUncompressed;
	if (inName==STRING(L"SFMP3",5)) return SFMP3;
	if (inName==STRING(L"SFNativeEndianUncompressed",26)) return SFNativeEndianUncompressed;
	if (inName==STRING(L"SFNellymoser",12)) return SFNellymoser;
	if (inName==STRING(L"SFNellymoser16k",15)) return SFNellymoser16k;
	if (inName==STRING(L"SFNellymoser8k",14)) return SFNellymoser8k;
	if (inName==STRING(L"SFSpeex",7)) return SFSpeex;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SFADPCM",7),
	STRING(L"SFLittleEndianUncompressed",26),
	STRING(L"SFMP3",5),
	STRING(L"SFNativeEndianUncompressed",26),
	STRING(L"SFNellymoser",12),
	STRING(L"SFNellymoser16k",15),
	STRING(L"SFNellymoser8k",14),
	STRING(L"SFSpeex",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(SoundFormat_obj::SFADPCM);
	MarkMember(SoundFormat_obj::SFLittleEndianUncompressed);
	MarkMember(SoundFormat_obj::SFMP3);
	MarkMember(SoundFormat_obj::SFNativeEndianUncompressed);
	MarkMember(SoundFormat_obj::SFNellymoser);
	MarkMember(SoundFormat_obj::SFNellymoser16k);
	MarkMember(SoundFormat_obj::SFNellymoser8k);
	MarkMember(SoundFormat_obj::SFSpeex);
};

static String sMemberFields[] = { String(null()) };
Class SoundFormat_obj::__mClass;

Dynamic __Create_SoundFormat_obj() { return new SoundFormat_obj; }

void SoundFormat_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SoundFormat",22), TCanCast<SoundFormat_obj >,sStaticFields,sMemberFields,
	&__Create_SoundFormat_obj, &__Create,
	&super::__SGetClass(), &CreateSoundFormat_obj, sMarkStatics);
}

void SoundFormat_obj::__boot()
{
Static(SFADPCM) = CreateEnum<SoundFormat_obj >(STRING(L"SFADPCM",7),1);
Static(SFLittleEndianUncompressed) = CreateEnum<SoundFormat_obj >(STRING(L"SFLittleEndianUncompressed",26),3);
Static(SFMP3) = CreateEnum<SoundFormat_obj >(STRING(L"SFMP3",5),2);
Static(SFNativeEndianUncompressed) = CreateEnum<SoundFormat_obj >(STRING(L"SFNativeEndianUncompressed",26),0);
Static(SFNellymoser) = CreateEnum<SoundFormat_obj >(STRING(L"SFNellymoser",12),6);
Static(SFNellymoser16k) = CreateEnum<SoundFormat_obj >(STRING(L"SFNellymoser16k",15),4);
Static(SFNellymoser8k) = CreateEnum<SoundFormat_obj >(STRING(L"SFNellymoser8k",14),5);
Static(SFSpeex) = CreateEnum<SoundFormat_obj >(STRING(L"SFSpeex",7),7);
}


} // end namespace format
} // end namespace swf
