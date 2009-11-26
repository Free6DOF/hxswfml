#include <hxObject.h>

#ifndef INCLUDED_format_swf_MorphFillStyle
#include <format/swf/MorphFillStyle.h>
#endif
namespace format{
namespace swf{

MorphFillStyle  MorphFillStyle_obj::MFSBitmap(int cid,Dynamic startMatrix,Dynamic endMatrix,bool repeat,bool smooth)
	{ return CreateEnum<MorphFillStyle_obj >(STRING(L"MFSBitmap",9),3,DynamicArray(0,5).Add(cid).Add(startMatrix).Add(endMatrix).Add(repeat).Add(smooth)); }

MorphFillStyle  MorphFillStyle_obj::MFSLinearGradient(Dynamic startMatrix,Dynamic endMatrix,Array<Dynamic > gradients)
	{ return CreateEnum<MorphFillStyle_obj >(STRING(L"MFSLinearGradient",17),1,DynamicArray(0,3).Add(startMatrix).Add(endMatrix).Add(gradients)); }

MorphFillStyle  MorphFillStyle_obj::MFSRadialGradient(Dynamic startMatrix,Dynamic endMatrix,Array<Dynamic > gradients)
	{ return CreateEnum<MorphFillStyle_obj >(STRING(L"MFSRadialGradient",17),2,DynamicArray(0,3).Add(startMatrix).Add(endMatrix).Add(gradients)); }

MorphFillStyle  MorphFillStyle_obj::MFSSolid(Dynamic startColor,Dynamic endColor)
	{ return CreateEnum<MorphFillStyle_obj >(STRING(L"MFSSolid",8),0,DynamicArray(0,2).Add(startColor).Add(endColor)); }

DEFINE_CREATE_ENUM(MorphFillStyle_obj)

int MorphFillStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"MFSBitmap",9)) return 3;
	if (inName==STRING(L"MFSLinearGradient",17)) return 1;
	if (inName==STRING(L"MFSRadialGradient",17)) return 2;
	if (inName==STRING(L"MFSSolid",8)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC5(MorphFillStyle_obj,MFSBitmap,return)

STATIC_DEFINE_DYNAMIC_FUNC3(MorphFillStyle_obj,MFSLinearGradient,return)

STATIC_DEFINE_DYNAMIC_FUNC3(MorphFillStyle_obj,MFSRadialGradient,return)

STATIC_DEFINE_DYNAMIC_FUNC2(MorphFillStyle_obj,MFSSolid,return)

int MorphFillStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"MFSBitmap",9)) return 5;
	if (inName==STRING(L"MFSLinearGradient",17)) return 3;
	if (inName==STRING(L"MFSRadialGradient",17)) return 3;
	if (inName==STRING(L"MFSSolid",8)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic MorphFillStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"MFSBitmap",9)) return MFSBitmap_dyn();
	if (inName==STRING(L"MFSLinearGradient",17)) return MFSLinearGradient_dyn();
	if (inName==STRING(L"MFSRadialGradient",17)) return MFSRadialGradient_dyn();
	if (inName==STRING(L"MFSSolid",8)) return MFSSolid_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"MFSBitmap",9),
	STRING(L"MFSLinearGradient",17),
	STRING(L"MFSRadialGradient",17),
	STRING(L"MFSSolid",8),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class MorphFillStyle_obj::__mClass;

Dynamic __Create_MorphFillStyle_obj() { return new MorphFillStyle_obj; }

void MorphFillStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.MorphFillStyle",25), TCanCast<MorphFillStyle_obj >,sStaticFields,sMemberFields,
	&__Create_MorphFillStyle_obj, &__Create,
	&super::__SGetClass(), &CreateMorphFillStyle_obj, sMarkStatics);
}

void MorphFillStyle_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
