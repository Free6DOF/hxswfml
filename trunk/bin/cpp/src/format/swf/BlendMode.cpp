#include <hxObject.h>

#ifndef INCLUDED_format_swf_BlendMode
#include <format/swf/BlendMode.h>
#endif
namespace format{
namespace swf{

BlendMode BlendMode_obj::BAdd;

BlendMode BlendMode_obj::BAlpha;

BlendMode BlendMode_obj::BDarken;

BlendMode BlendMode_obj::BDifference;

BlendMode BlendMode_obj::BErase;

BlendMode BlendMode_obj::BHardLight;

BlendMode BlendMode_obj::BInvert;

BlendMode BlendMode_obj::BLayer;

BlendMode BlendMode_obj::BLighten;

BlendMode BlendMode_obj::BMultiply;

BlendMode BlendMode_obj::BNormal;

BlendMode BlendMode_obj::BOverlay;

BlendMode BlendMode_obj::BScreen;

BlendMode BlendMode_obj::BSubtract;

DEFINE_CREATE_ENUM(BlendMode_obj)

int BlendMode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"BAdd",4)) return 6;
	if (inName==STRING(L"BAlpha",6)) return 10;
	if (inName==STRING(L"BDarken",7)) return 5;
	if (inName==STRING(L"BDifference",11)) return 8;
	if (inName==STRING(L"BErase",6)) return 11;
	if (inName==STRING(L"BHardLight",10)) return 13;
	if (inName==STRING(L"BInvert",7)) return 9;
	if (inName==STRING(L"BLayer",6)) return 1;
	if (inName==STRING(L"BLighten",8)) return 4;
	if (inName==STRING(L"BMultiply",9)) return 2;
	if (inName==STRING(L"BNormal",7)) return 0;
	if (inName==STRING(L"BOverlay",8)) return 12;
	if (inName==STRING(L"BScreen",7)) return 3;
	if (inName==STRING(L"BSubtract",9)) return 7;
	return super::__FindIndex(inName);
}

int BlendMode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"BAdd",4)) return 0;
	if (inName==STRING(L"BAlpha",6)) return 0;
	if (inName==STRING(L"BDarken",7)) return 0;
	if (inName==STRING(L"BDifference",11)) return 0;
	if (inName==STRING(L"BErase",6)) return 0;
	if (inName==STRING(L"BHardLight",10)) return 0;
	if (inName==STRING(L"BInvert",7)) return 0;
	if (inName==STRING(L"BLayer",6)) return 0;
	if (inName==STRING(L"BLighten",8)) return 0;
	if (inName==STRING(L"BMultiply",9)) return 0;
	if (inName==STRING(L"BNormal",7)) return 0;
	if (inName==STRING(L"BOverlay",8)) return 0;
	if (inName==STRING(L"BScreen",7)) return 0;
	if (inName==STRING(L"BSubtract",9)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic BlendMode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"BAdd",4)) return BAdd;
	if (inName==STRING(L"BAlpha",6)) return BAlpha;
	if (inName==STRING(L"BDarken",7)) return BDarken;
	if (inName==STRING(L"BDifference",11)) return BDifference;
	if (inName==STRING(L"BErase",6)) return BErase;
	if (inName==STRING(L"BHardLight",10)) return BHardLight;
	if (inName==STRING(L"BInvert",7)) return BInvert;
	if (inName==STRING(L"BLayer",6)) return BLayer;
	if (inName==STRING(L"BLighten",8)) return BLighten;
	if (inName==STRING(L"BMultiply",9)) return BMultiply;
	if (inName==STRING(L"BNormal",7)) return BNormal;
	if (inName==STRING(L"BOverlay",8)) return BOverlay;
	if (inName==STRING(L"BScreen",7)) return BScreen;
	if (inName==STRING(L"BSubtract",9)) return BSubtract;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"BAdd",4),
	STRING(L"BAlpha",6),
	STRING(L"BDarken",7),
	STRING(L"BDifference",11),
	STRING(L"BErase",6),
	STRING(L"BHardLight",10),
	STRING(L"BInvert",7),
	STRING(L"BLayer",6),
	STRING(L"BLighten",8),
	STRING(L"BMultiply",9),
	STRING(L"BNormal",7),
	STRING(L"BOverlay",8),
	STRING(L"BScreen",7),
	STRING(L"BSubtract",9),
	String(null()) };

static void sMarkStatics() {
	MarkMember(BlendMode_obj::BAdd);
	MarkMember(BlendMode_obj::BAlpha);
	MarkMember(BlendMode_obj::BDarken);
	MarkMember(BlendMode_obj::BDifference);
	MarkMember(BlendMode_obj::BErase);
	MarkMember(BlendMode_obj::BHardLight);
	MarkMember(BlendMode_obj::BInvert);
	MarkMember(BlendMode_obj::BLayer);
	MarkMember(BlendMode_obj::BLighten);
	MarkMember(BlendMode_obj::BMultiply);
	MarkMember(BlendMode_obj::BNormal);
	MarkMember(BlendMode_obj::BOverlay);
	MarkMember(BlendMode_obj::BScreen);
	MarkMember(BlendMode_obj::BSubtract);
};

static String sMemberFields[] = { String(null()) };
Class BlendMode_obj::__mClass;

Dynamic __Create_BlendMode_obj() { return new BlendMode_obj; }

void BlendMode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.BlendMode",20), TCanCast<BlendMode_obj >,sStaticFields,sMemberFields,
	&__Create_BlendMode_obj, &__Create,
	&super::__SGetClass(), &CreateBlendMode_obj, sMarkStatics);
}

void BlendMode_obj::__boot()
{
Static(BAdd) = CreateEnum<BlendMode_obj >(STRING(L"BAdd",4),6);
Static(BAlpha) = CreateEnum<BlendMode_obj >(STRING(L"BAlpha",6),10);
Static(BDarken) = CreateEnum<BlendMode_obj >(STRING(L"BDarken",7),5);
Static(BDifference) = CreateEnum<BlendMode_obj >(STRING(L"BDifference",11),8);
Static(BErase) = CreateEnum<BlendMode_obj >(STRING(L"BErase",6),11);
Static(BHardLight) = CreateEnum<BlendMode_obj >(STRING(L"BHardLight",10),13);
Static(BInvert) = CreateEnum<BlendMode_obj >(STRING(L"BInvert",7),9);
Static(BLayer) = CreateEnum<BlendMode_obj >(STRING(L"BLayer",6),1);
Static(BLighten) = CreateEnum<BlendMode_obj >(STRING(L"BLighten",8),4);
Static(BMultiply) = CreateEnum<BlendMode_obj >(STRING(L"BMultiply",9),2);
Static(BNormal) = CreateEnum<BlendMode_obj >(STRING(L"BNormal",7),0);
Static(BOverlay) = CreateEnum<BlendMode_obj >(STRING(L"BOverlay",8),12);
Static(BScreen) = CreateEnum<BlendMode_obj >(STRING(L"BScreen",7),3);
Static(BSubtract) = CreateEnum<BlendMode_obj >(STRING(L"BSubtract",9),7);
}


} // end namespace format
} // end namespace swf
