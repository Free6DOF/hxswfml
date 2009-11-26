#include <hxObject.h>

#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_Name
#include <format/abc/Name.h>
#endif
namespace format{
namespace abc{

Name  Name_obj::NAttrib(format::abc::Name n)
	{ return CreateEnum<Name_obj >(STRING(L"NAttrib",7),5,DynamicArray(0,1).Add(n)); }

Name  Name_obj::NMulti(format::abc::Index name,format::abc::Index ns)
	{ return CreateEnum<Name_obj >(STRING(L"NMulti",6),1,DynamicArray(0,2).Add(name).Add(ns)); }

Name  Name_obj::NMultiLate(format::abc::Index nset)
	{ return CreateEnum<Name_obj >(STRING(L"NMultiLate",10),4,DynamicArray(0,1).Add(nset)); }

Name  Name_obj::NName(format::abc::Index name,format::abc::Index ns)
	{ return CreateEnum<Name_obj >(STRING(L"NName",5),0,DynamicArray(0,2).Add(name).Add(ns)); }

Name  Name_obj::NParams(format::abc::Index n,Array<format::abc::Index > params)
	{ return CreateEnum<Name_obj >(STRING(L"NParams",7),6,DynamicArray(0,2).Add(n).Add(params)); }

Name  Name_obj::NRuntime(format::abc::Index name)
	{ return CreateEnum<Name_obj >(STRING(L"NRuntime",8),2,DynamicArray(0,1).Add(name)); }

Name Name_obj::NRuntimeLate;

DEFINE_CREATE_ENUM(Name_obj)

int Name_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"NAttrib",7)) return 5;
	if (inName==STRING(L"NMulti",6)) return 1;
	if (inName==STRING(L"NMultiLate",10)) return 4;
	if (inName==STRING(L"NName",5)) return 0;
	if (inName==STRING(L"NParams",7)) return 6;
	if (inName==STRING(L"NRuntime",8)) return 2;
	if (inName==STRING(L"NRuntimeLate",12)) return 3;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Name_obj,NAttrib,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Name_obj,NMulti,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Name_obj,NMultiLate,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Name_obj,NName,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Name_obj,NParams,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Name_obj,NRuntime,return)

int Name_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"NAttrib",7)) return 1;
	if (inName==STRING(L"NMulti",6)) return 2;
	if (inName==STRING(L"NMultiLate",10)) return 1;
	if (inName==STRING(L"NName",5)) return 2;
	if (inName==STRING(L"NParams",7)) return 2;
	if (inName==STRING(L"NRuntime",8)) return 1;
	if (inName==STRING(L"NRuntimeLate",12)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Name_obj::__Field(const String &inName)
{
	if (inName==STRING(L"NAttrib",7)) return NAttrib_dyn();
	if (inName==STRING(L"NMulti",6)) return NMulti_dyn();
	if (inName==STRING(L"NMultiLate",10)) return NMultiLate_dyn();
	if (inName==STRING(L"NName",5)) return NName_dyn();
	if (inName==STRING(L"NParams",7)) return NParams_dyn();
	if (inName==STRING(L"NRuntime",8)) return NRuntime_dyn();
	if (inName==STRING(L"NRuntimeLate",12)) return NRuntimeLate;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"NAttrib",7),
	STRING(L"NMulti",6),
	STRING(L"NMultiLate",10),
	STRING(L"NName",5),
	STRING(L"NParams",7),
	STRING(L"NRuntime",8),
	STRING(L"NRuntimeLate",12),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Name_obj::NRuntimeLate);
};

static String sMemberFields[] = { String(null()) };
Class Name_obj::__mClass;

Dynamic __Create_Name_obj() { return new Name_obj; }

void Name_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.Name",15), TCanCast<Name_obj >,sStaticFields,sMemberFields,
	&__Create_Name_obj, &__Create,
	&super::__SGetClass(), &CreateName_obj, sMarkStatics);
}

void Name_obj::__boot()
{
Static(NRuntimeLate) = CreateEnum<Name_obj >(STRING(L"NRuntimeLate",12),3);
}


} // end namespace format
} // end namespace abc
