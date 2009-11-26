#include <hxObject.h>

#ifndef INCLUDED_format_swf_ColorModel
#include <format/swf/ColorModel.h>
#endif
namespace format{
namespace swf{

ColorModel ColorModel_obj::CM15Bits;

ColorModel ColorModel_obj::CM24Bits;

ColorModel ColorModel_obj::CM32Bits;

ColorModel  ColorModel_obj::CM8Bits(int ncolors)
	{ return CreateEnum<ColorModel_obj >(STRING(L"CM8Bits",7),0,DynamicArray(0,1).Add(ncolors)); }

DEFINE_CREATE_ENUM(ColorModel_obj)

int ColorModel_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"CM15Bits",8)) return 1;
	if (inName==STRING(L"CM24Bits",8)) return 2;
	if (inName==STRING(L"CM32Bits",8)) return 3;
	if (inName==STRING(L"CM8Bits",7)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(ColorModel_obj,CM8Bits,return)

int ColorModel_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"CM15Bits",8)) return 0;
	if (inName==STRING(L"CM24Bits",8)) return 0;
	if (inName==STRING(L"CM32Bits",8)) return 0;
	if (inName==STRING(L"CM8Bits",7)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic ColorModel_obj::__Field(const String &inName)
{
	if (inName==STRING(L"CM15Bits",8)) return CM15Bits;
	if (inName==STRING(L"CM24Bits",8)) return CM24Bits;
	if (inName==STRING(L"CM32Bits",8)) return CM32Bits;
	if (inName==STRING(L"CM8Bits",7)) return CM8Bits_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"CM15Bits",8),
	STRING(L"CM24Bits",8),
	STRING(L"CM32Bits",8),
	STRING(L"CM8Bits",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(ColorModel_obj::CM15Bits);
	MarkMember(ColorModel_obj::CM24Bits);
	MarkMember(ColorModel_obj::CM32Bits);
};

static String sMemberFields[] = { String(null()) };
Class ColorModel_obj::__mClass;

Dynamic __Create_ColorModel_obj() { return new ColorModel_obj; }

void ColorModel_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.ColorModel",21), TCanCast<ColorModel_obj >,sStaticFields,sMemberFields,
	&__Create_ColorModel_obj, &__Create,
	&super::__SGetClass(), &CreateColorModel_obj, sMarkStatics);
}

void ColorModel_obj::__boot()
{
Static(CM15Bits) = CreateEnum<ColorModel_obj >(STRING(L"CM15Bits",8),1);
Static(CM24Bits) = CreateEnum<ColorModel_obj >(STRING(L"CM24Bits",8),2);
Static(CM32Bits) = CreateEnum<ColorModel_obj >(STRING(L"CM32Bits",8),3);
}


} // end namespace format
} // end namespace swf
