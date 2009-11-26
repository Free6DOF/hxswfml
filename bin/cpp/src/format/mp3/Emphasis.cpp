#include <hxObject.h>

#ifndef INCLUDED_format_mp3_Emphasis
#include <format/mp3/Emphasis.h>
#endif
namespace format{
namespace mp3{

Emphasis Emphasis_obj::CCIT_J17;

Emphasis Emphasis_obj::InvalidEmphasis;

Emphasis Emphasis_obj::Ms50_15;

Emphasis Emphasis_obj::NoEmphasis;

DEFINE_CREATE_ENUM(Emphasis_obj)

int Emphasis_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"CCIT_J17",8)) return 2;
	if (inName==STRING(L"InvalidEmphasis",15)) return 3;
	if (inName==STRING(L"Ms50_15",7)) return 1;
	if (inName==STRING(L"NoEmphasis",10)) return 0;
	return super::__FindIndex(inName);
}

int Emphasis_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"CCIT_J17",8)) return 0;
	if (inName==STRING(L"InvalidEmphasis",15)) return 0;
	if (inName==STRING(L"Ms50_15",7)) return 0;
	if (inName==STRING(L"NoEmphasis",10)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Emphasis_obj::__Field(const String &inName)
{
	if (inName==STRING(L"CCIT_J17",8)) return CCIT_J17;
	if (inName==STRING(L"InvalidEmphasis",15)) return InvalidEmphasis;
	if (inName==STRING(L"Ms50_15",7)) return Ms50_15;
	if (inName==STRING(L"NoEmphasis",10)) return NoEmphasis;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"CCIT_J17",8),
	STRING(L"InvalidEmphasis",15),
	STRING(L"Ms50_15",7),
	STRING(L"NoEmphasis",10),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Emphasis_obj::CCIT_J17);
	MarkMember(Emphasis_obj::InvalidEmphasis);
	MarkMember(Emphasis_obj::Ms50_15);
	MarkMember(Emphasis_obj::NoEmphasis);
};

static String sMemberFields[] = { String(null()) };
Class Emphasis_obj::__mClass;

Dynamic __Create_Emphasis_obj() { return new Emphasis_obj; }

void Emphasis_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.mp3.Emphasis",19), TCanCast<Emphasis_obj >,sStaticFields,sMemberFields,
	&__Create_Emphasis_obj, &__Create,
	&super::__SGetClass(), &CreateEmphasis_obj, sMarkStatics);
}

void Emphasis_obj::__boot()
{
Static(CCIT_J17) = CreateEnum<Emphasis_obj >(STRING(L"CCIT_J17",8),2);
Static(InvalidEmphasis) = CreateEnum<Emphasis_obj >(STRING(L"InvalidEmphasis",15),3);
Static(Ms50_15) = CreateEnum<Emphasis_obj >(STRING(L"Ms50_15",7),1);
Static(NoEmphasis) = CreateEnum<Emphasis_obj >(STRING(L"NoEmphasis",10),0);
}


} // end namespace format
} // end namespace mp3
