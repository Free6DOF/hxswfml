#include <hxObject.h>

#ifndef INCLUDED_format_swf_SoundRate
#include <format/swf/SoundRate.h>
#endif
namespace format{
namespace swf{

SoundRate SoundRate_obj::SR11k;

SoundRate SoundRate_obj::SR22k;

SoundRate SoundRate_obj::SR44k;

SoundRate SoundRate_obj::SR5k;

DEFINE_CREATE_ENUM(SoundRate_obj)

int SoundRate_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SR11k",5)) return 1;
	if (inName==STRING(L"SR22k",5)) return 2;
	if (inName==STRING(L"SR44k",5)) return 3;
	if (inName==STRING(L"SR5k",4)) return 0;
	return super::__FindIndex(inName);
}

int SoundRate_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SR11k",5)) return 0;
	if (inName==STRING(L"SR22k",5)) return 0;
	if (inName==STRING(L"SR44k",5)) return 0;
	if (inName==STRING(L"SR5k",4)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic SoundRate_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SR11k",5)) return SR11k;
	if (inName==STRING(L"SR22k",5)) return SR22k;
	if (inName==STRING(L"SR44k",5)) return SR44k;
	if (inName==STRING(L"SR5k",4)) return SR5k;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SR11k",5),
	STRING(L"SR22k",5),
	STRING(L"SR44k",5),
	STRING(L"SR5k",4),
	String(null()) };

static void sMarkStatics() {
	MarkMember(SoundRate_obj::SR11k);
	MarkMember(SoundRate_obj::SR22k);
	MarkMember(SoundRate_obj::SR44k);
	MarkMember(SoundRate_obj::SR5k);
};

static String sMemberFields[] = { String(null()) };
Class SoundRate_obj::__mClass;

Dynamic __Create_SoundRate_obj() { return new SoundRate_obj; }

void SoundRate_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SoundRate",20), TCanCast<SoundRate_obj >,sStaticFields,sMemberFields,
	&__Create_SoundRate_obj, &__Create,
	&super::__SGetClass(), &CreateSoundRate_obj, sMarkStatics);
}

void SoundRate_obj::__boot()
{
Static(SR11k) = CreateEnum<SoundRate_obj >(STRING(L"SR11k",5),1);
Static(SR22k) = CreateEnum<SoundRate_obj >(STRING(L"SR22k",5),2);
Static(SR44k) = CreateEnum<SoundRate_obj >(STRING(L"SR44k",5),3);
Static(SR5k) = CreateEnum<SoundRate_obj >(STRING(L"SR5k",4),0);
}


} // end namespace format
} // end namespace swf
