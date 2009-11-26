#include <hxObject.h>

#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
namespace format{
namespace swf{

ShapeData  ShapeData_obj::SHDShape1(Dynamic bounds,Dynamic shapes)
	{ return CreateEnum<ShapeData_obj >(STRING(L"SHDShape1",9),0,DynamicArray(0,2).Add(bounds).Add(shapes)); }

ShapeData  ShapeData_obj::SHDShape2(Dynamic bounds,Dynamic shapes)
	{ return CreateEnum<ShapeData_obj >(STRING(L"SHDShape2",9),1,DynamicArray(0,2).Add(bounds).Add(shapes)); }

ShapeData  ShapeData_obj::SHDShape3(Dynamic bounds,Dynamic shapes)
	{ return CreateEnum<ShapeData_obj >(STRING(L"SHDShape3",9),2,DynamicArray(0,2).Add(bounds).Add(shapes)); }

ShapeData  ShapeData_obj::SHDShape4(Dynamic data)
	{ return CreateEnum<ShapeData_obj >(STRING(L"SHDShape4",9),3,DynamicArray(0,1).Add(data)); }

DEFINE_CREATE_ENUM(ShapeData_obj)

int ShapeData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SHDShape1",9)) return 0;
	if (inName==STRING(L"SHDShape2",9)) return 1;
	if (inName==STRING(L"SHDShape3",9)) return 2;
	if (inName==STRING(L"SHDShape4",9)) return 3;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(ShapeData_obj,SHDShape1,return)

STATIC_DEFINE_DYNAMIC_FUNC2(ShapeData_obj,SHDShape2,return)

STATIC_DEFINE_DYNAMIC_FUNC2(ShapeData_obj,SHDShape3,return)

STATIC_DEFINE_DYNAMIC_FUNC1(ShapeData_obj,SHDShape4,return)

int ShapeData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SHDShape1",9)) return 2;
	if (inName==STRING(L"SHDShape2",9)) return 2;
	if (inName==STRING(L"SHDShape3",9)) return 2;
	if (inName==STRING(L"SHDShape4",9)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic ShapeData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SHDShape1",9)) return SHDShape1_dyn();
	if (inName==STRING(L"SHDShape2",9)) return SHDShape2_dyn();
	if (inName==STRING(L"SHDShape3",9)) return SHDShape3_dyn();
	if (inName==STRING(L"SHDShape4",9)) return SHDShape4_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SHDShape1",9),
	STRING(L"SHDShape2",9),
	STRING(L"SHDShape3",9),
	STRING(L"SHDShape4",9),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class ShapeData_obj::__mClass;

Dynamic __Create_ShapeData_obj() { return new ShapeData_obj; }

void ShapeData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.ShapeData",20), TCanCast<ShapeData_obj >,sStaticFields,sMemberFields,
	&__Create_ShapeData_obj, &__Create,
	&super::__SGetClass(), &CreateShapeData_obj, sMarkStatics);
}

void ShapeData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
