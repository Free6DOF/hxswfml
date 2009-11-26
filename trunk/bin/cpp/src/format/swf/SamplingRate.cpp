#include <hxObject.h>

#ifndef INCLUDED_format_swf_SamplingRate
#include <format/swf/SamplingRate.h>
#endif
namespace format{
namespace swf{

SamplingRate SamplingRate_obj::SR_11025;

SamplingRate SamplingRate_obj::SR_12000;

SamplingRate SamplingRate_obj::SR_22050;

SamplingRate SamplingRate_obj::SR_24000;

SamplingRate SamplingRate_obj::SR_32000;

SamplingRate SamplingRate_obj::SR_44100;

SamplingRate SamplingRate_obj::SR_48000;

SamplingRate SamplingRate_obj::SR_8000;

SamplingRate SamplingRate_obj::SR_Bad;

DEFINE_CREATE_ENUM(SamplingRate_obj)

int SamplingRate_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SR_11025",8)) return 1;
	if (inName==STRING(L"SR_12000",8)) return 2;
	if (inName==STRING(L"SR_22050",8)) return 3;
	if (inName==STRING(L"SR_24000",8)) return 4;
	if (inName==STRING(L"SR_32000",8)) return 5;
	if (inName==STRING(L"SR_44100",8)) return 6;
	if (inName==STRING(L"SR_48000",8)) return 7;
	if (inName==STRING(L"SR_8000",7)) return 0;
	if (inName==STRING(L"SR_Bad",6)) return 8;
	return super::__FindIndex(inName);
}

int SamplingRate_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SR_11025",8)) return 0;
	if (inName==STRING(L"SR_12000",8)) return 0;
	if (inName==STRING(L"SR_22050",8)) return 0;
	if (inName==STRING(L"SR_24000",8)) return 0;
	if (inName==STRING(L"SR_32000",8)) return 0;
	if (inName==STRING(L"SR_44100",8)) return 0;
	if (inName==STRING(L"SR_48000",8)) return 0;
	if (inName==STRING(L"SR_8000",7)) return 0;
	if (inName==STRING(L"SR_Bad",6)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic SamplingRate_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SR_11025",8)) return SR_11025;
	if (inName==STRING(L"SR_12000",8)) return SR_12000;
	if (inName==STRING(L"SR_22050",8)) return SR_22050;
	if (inName==STRING(L"SR_24000",8)) return SR_24000;
	if (inName==STRING(L"SR_32000",8)) return SR_32000;
	if (inName==STRING(L"SR_44100",8)) return SR_44100;
	if (inName==STRING(L"SR_48000",8)) return SR_48000;
	if (inName==STRING(L"SR_8000",7)) return SR_8000;
	if (inName==STRING(L"SR_Bad",6)) return SR_Bad;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SR_11025",8),
	STRING(L"SR_12000",8),
	STRING(L"SR_22050",8),
	STRING(L"SR_24000",8),
	STRING(L"SR_32000",8),
	STRING(L"SR_44100",8),
	STRING(L"SR_48000",8),
	STRING(L"SR_8000",7),
	STRING(L"SR_Bad",6),
	String(null()) };

static void sMarkStatics() {
	MarkMember(SamplingRate_obj::SR_11025);
	MarkMember(SamplingRate_obj::SR_12000);
	MarkMember(SamplingRate_obj::SR_22050);
	MarkMember(SamplingRate_obj::SR_24000);
	MarkMember(SamplingRate_obj::SR_32000);
	MarkMember(SamplingRate_obj::SR_44100);
	MarkMember(SamplingRate_obj::SR_48000);
	MarkMember(SamplingRate_obj::SR_8000);
	MarkMember(SamplingRate_obj::SR_Bad);
};

static String sMemberFields[] = { String(null()) };
Class SamplingRate_obj::__mClass;

Dynamic __Create_SamplingRate_obj() { return new SamplingRate_obj; }

void SamplingRate_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SamplingRate",23), TCanCast<SamplingRate_obj >,sStaticFields,sMemberFields,
	&__Create_SamplingRate_obj, &__Create,
	&super::__SGetClass(), &CreateSamplingRate_obj, sMarkStatics);
}

void SamplingRate_obj::__boot()
{
Static(SR_11025) = CreateEnum<SamplingRate_obj >(STRING(L"SR_11025",8),1);
Static(SR_12000) = CreateEnum<SamplingRate_obj >(STRING(L"SR_12000",8),2);
Static(SR_22050) = CreateEnum<SamplingRate_obj >(STRING(L"SR_22050",8),3);
Static(SR_24000) = CreateEnum<SamplingRate_obj >(STRING(L"SR_24000",8),4);
Static(SR_32000) = CreateEnum<SamplingRate_obj >(STRING(L"SR_32000",8),5);
Static(SR_44100) = CreateEnum<SamplingRate_obj >(STRING(L"SR_44100",8),6);
Static(SR_48000) = CreateEnum<SamplingRate_obj >(STRING(L"SR_48000",8),7);
Static(SR_8000) = CreateEnum<SamplingRate_obj >(STRING(L"SR_8000",7),0);
Static(SR_Bad) = CreateEnum<SamplingRate_obj >(STRING(L"SR_Bad",6),8);
}


} // end namespace format
} // end namespace swf
