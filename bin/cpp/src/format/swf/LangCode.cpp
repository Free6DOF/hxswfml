#include <hxObject.h>

#ifndef INCLUDED_format_swf_LangCode
#include <format/swf/LangCode.h>
#endif
namespace format{
namespace swf{

LangCode LangCode_obj::LCJapanese;

LangCode LangCode_obj::LCKorean;

LangCode LangCode_obj::LCLatin;

LangCode LangCode_obj::LCNone;

LangCode LangCode_obj::LCSimplifiedChinese;

LangCode LangCode_obj::LCTraditionalChinese;

DEFINE_CREATE_ENUM(LangCode_obj)

int LangCode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"LCJapanese",10)) return 2;
	if (inName==STRING(L"LCKorean",8)) return 3;
	if (inName==STRING(L"LCLatin",7)) return 1;
	if (inName==STRING(L"LCNone",6)) return 0;
	if (inName==STRING(L"LCSimplifiedChinese",19)) return 4;
	if (inName==STRING(L"LCTraditionalChinese",20)) return 5;
	return super::__FindIndex(inName);
}

int LangCode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"LCJapanese",10)) return 0;
	if (inName==STRING(L"LCKorean",8)) return 0;
	if (inName==STRING(L"LCLatin",7)) return 0;
	if (inName==STRING(L"LCNone",6)) return 0;
	if (inName==STRING(L"LCSimplifiedChinese",19)) return 0;
	if (inName==STRING(L"LCTraditionalChinese",20)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic LangCode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"LCJapanese",10)) return LCJapanese;
	if (inName==STRING(L"LCKorean",8)) return LCKorean;
	if (inName==STRING(L"LCLatin",7)) return LCLatin;
	if (inName==STRING(L"LCNone",6)) return LCNone;
	if (inName==STRING(L"LCSimplifiedChinese",19)) return LCSimplifiedChinese;
	if (inName==STRING(L"LCTraditionalChinese",20)) return LCTraditionalChinese;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"LCJapanese",10),
	STRING(L"LCKorean",8),
	STRING(L"LCLatin",7),
	STRING(L"LCNone",6),
	STRING(L"LCSimplifiedChinese",19),
	STRING(L"LCTraditionalChinese",20),
	String(null()) };

static void sMarkStatics() {
	MarkMember(LangCode_obj::LCJapanese);
	MarkMember(LangCode_obj::LCKorean);
	MarkMember(LangCode_obj::LCLatin);
	MarkMember(LangCode_obj::LCNone);
	MarkMember(LangCode_obj::LCSimplifiedChinese);
	MarkMember(LangCode_obj::LCTraditionalChinese);
};

static String sMemberFields[] = { String(null()) };
Class LangCode_obj::__mClass;

Dynamic __Create_LangCode_obj() { return new LangCode_obj; }

void LangCode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.LangCode",19), TCanCast<LangCode_obj >,sStaticFields,sMemberFields,
	&__Create_LangCode_obj, &__Create,
	&super::__SGetClass(), &CreateLangCode_obj, sMarkStatics);
}

void LangCode_obj::__boot()
{
Static(LCJapanese) = CreateEnum<LangCode_obj >(STRING(L"LCJapanese",10),2);
Static(LCKorean) = CreateEnum<LangCode_obj >(STRING(L"LCKorean",8),3);
Static(LCLatin) = CreateEnum<LangCode_obj >(STRING(L"LCLatin",7),1);
Static(LCNone) = CreateEnum<LangCode_obj >(STRING(L"LCNone",6),0);
Static(LCSimplifiedChinese) = CreateEnum<LangCode_obj >(STRING(L"LCSimplifiedChinese",19),4);
Static(LCTraditionalChinese) = CreateEnum<LangCode_obj >(STRING(L"LCTraditionalChinese",20),5);
}


} // end namespace format
} // end namespace swf
