#include <hxObject.h>

#ifndef INCLUDED_format_abc_FieldKind
#include <format/abc/FieldKind.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_MethodKind
#include <format/abc/MethodKind.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
namespace format{
namespace abc{

FieldKind  FieldKind_obj::FClass(format::abc::Index c)
	{ return CreateEnum<FieldKind_obj >(STRING(L"FClass",6),2,DynamicArray(0,1).Add(c)); }

FieldKind  FieldKind_obj::FFunction(format::abc::Index f)
	{ return CreateEnum<FieldKind_obj >(STRING(L"FFunction",9),3,DynamicArray(0,1).Add(f)); }

FieldKind  FieldKind_obj::FMethod(format::abc::Index type,format::abc::MethodKind k,Dynamic isOverride,Dynamic isFinal)
	{ return CreateEnum<FieldKind_obj >(STRING(L"FMethod",7),1,DynamicArray(0,4).Add(type).Add(k).Add(isOverride).Add(isFinal)); }

FieldKind  FieldKind_obj::FVar(format::abc::Index type,format::abc::Value value,Dynamic _const)
	{ return CreateEnum<FieldKind_obj >(STRING(L"FVar",4),0,DynamicArray(0,3).Add(type).Add(value).Add(_const)); }

DEFINE_CREATE_ENUM(FieldKind_obj)

int FieldKind_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"FClass",6)) return 2;
	if (inName==STRING(L"FFunction",9)) return 3;
	if (inName==STRING(L"FMethod",7)) return 1;
	if (inName==STRING(L"FVar",4)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(FieldKind_obj,FClass,return)

STATIC_DEFINE_DYNAMIC_FUNC1(FieldKind_obj,FFunction,return)

STATIC_DEFINE_DYNAMIC_FUNC4(FieldKind_obj,FMethod,return)

STATIC_DEFINE_DYNAMIC_FUNC3(FieldKind_obj,FVar,return)

int FieldKind_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"FClass",6)) return 1;
	if (inName==STRING(L"FFunction",9)) return 1;
	if (inName==STRING(L"FMethod",7)) return 4;
	if (inName==STRING(L"FVar",4)) return 3;
	return super::__FindArgCount(inName);
}

Dynamic FieldKind_obj::__Field(const String &inName)
{
	if (inName==STRING(L"FClass",6)) return FClass_dyn();
	if (inName==STRING(L"FFunction",9)) return FFunction_dyn();
	if (inName==STRING(L"FMethod",7)) return FMethod_dyn();
	if (inName==STRING(L"FVar",4)) return FVar_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"FClass",6),
	STRING(L"FFunction",9),
	STRING(L"FMethod",7),
	STRING(L"FVar",4),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class FieldKind_obj::__mClass;

Dynamic __Create_FieldKind_obj() { return new FieldKind_obj; }

void FieldKind_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.FieldKind",20), TCanCast<FieldKind_obj >,sStaticFields,sMemberFields,
	&__Create_FieldKind_obj, &__Create,
	&super::__SGetClass(), &CreateFieldKind_obj, sMarkStatics);
}

void FieldKind_obj::__boot()
{
}


} // end namespace format
} // end namespace abc
