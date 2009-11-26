#include <hxObject.h>

#ifndef INCLUDED_format_swf_MorphShapeData
#include <format/swf/MorphShapeData.h>
#endif
namespace format{
namespace swf{

MorphShapeData  MorphShapeData_obj::MSDShape1(Dynamic data)
	{ return CreateEnum<MorphShapeData_obj >(STRING(L"MSDShape1",9),0,DynamicArray(0,1).Add(data)); }

MorphShapeData  MorphShapeData_obj::MSDShape2(Dynamic data)
	{ return CreateEnum<MorphShapeData_obj >(STRING(L"MSDShape2",9),1,DynamicArray(0,1).Add(data)); }

DEFINE_CREATE_ENUM(MorphShapeData_obj)

int MorphShapeData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"MSDShape1",9)) return 0;
	if (inName==STRING(L"MSDShape2",9)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(MorphShapeData_obj,MSDShape1,return)

STATIC_DEFINE_DYNAMIC_FUNC1(MorphShapeData_obj,MSDShape2,return)

int MorphShapeData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"MSDShape1",9)) return 1;
	if (inName==STRING(L"MSDShape2",9)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic MorphShapeData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"MSDShape1",9)) return MSDShape1_dyn();
	if (inName==STRING(L"MSDShape2",9)) return MSDShape2_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"MSDShape1",9),
	STRING(L"MSDShape2",9),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class MorphShapeData_obj::__mClass;

Dynamic __Create_MorphShapeData_obj() { return new MorphShapeData_obj; }

void MorphShapeData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.MorphShapeData",25), TCanCast<MorphShapeData_obj >,sStaticFields,sMemberFields,
	&__Create_MorphShapeData_obj, &__Create,
	&super::__SGetClass(), &CreateMorphShapeData_obj, sMarkStatics);
}

void MorphShapeData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
