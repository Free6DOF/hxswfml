#include <hxObject.h>

#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_Namespace
#include <format/abc/Namespace.h>
#endif
namespace format{
namespace abc{

Namespace  Namespace_obj::NExplicit(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NExplicit",9),5,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NInternal(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NInternal",9),3,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NNamespace(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NNamespace",10),1,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NPrivate(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NPrivate",8),0,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NProtected(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NProtected",10),4,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NPublic(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NPublic",7),2,DynamicArray(0,1).Add(ns)); }

Namespace  Namespace_obj::NStaticProtected(format::abc::Index ns)
	{ return CreateEnum<Namespace_obj >(STRING(L"NStaticProtected",16),6,DynamicArray(0,1).Add(ns)); }

DEFINE_CREATE_ENUM(Namespace_obj)

int Namespace_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"NExplicit",9)) return 5;
	if (inName==STRING(L"NInternal",9)) return 3;
	if (inName==STRING(L"NNamespace",10)) return 1;
	if (inName==STRING(L"NPrivate",8)) return 0;
	if (inName==STRING(L"NProtected",10)) return 4;
	if (inName==STRING(L"NPublic",7)) return 2;
	if (inName==STRING(L"NStaticProtected",16)) return 6;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NExplicit,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NInternal,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NNamespace,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NPrivate,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NProtected,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NPublic,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Namespace_obj,NStaticProtected,return)

int Namespace_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"NExplicit",9)) return 1;
	if (inName==STRING(L"NInternal",9)) return 1;
	if (inName==STRING(L"NNamespace",10)) return 1;
	if (inName==STRING(L"NPrivate",8)) return 1;
	if (inName==STRING(L"NProtected",10)) return 1;
	if (inName==STRING(L"NPublic",7)) return 1;
	if (inName==STRING(L"NStaticProtected",16)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic Namespace_obj::__Field(const String &inName)
{
	if (inName==STRING(L"NExplicit",9)) return NExplicit_dyn();
	if (inName==STRING(L"NInternal",9)) return NInternal_dyn();
	if (inName==STRING(L"NNamespace",10)) return NNamespace_dyn();
	if (inName==STRING(L"NPrivate",8)) return NPrivate_dyn();
	if (inName==STRING(L"NProtected",10)) return NProtected_dyn();
	if (inName==STRING(L"NPublic",7)) return NPublic_dyn();
	if (inName==STRING(L"NStaticProtected",16)) return NStaticProtected_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"NExplicit",9),
	STRING(L"NInternal",9),
	STRING(L"NNamespace",10),
	STRING(L"NPrivate",8),
	STRING(L"NProtected",10),
	STRING(L"NPublic",7),
	STRING(L"NStaticProtected",16),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class Namespace_obj::__mClass;

Dynamic __Create_Namespace_obj() { return new Namespace_obj; }

void Namespace_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.Namespace",20), TCanCast<Namespace_obj >,sStaticFields,sMemberFields,
	&__Create_Namespace_obj, &__Create,
	&super::__SGetClass(), &CreateNamespace_obj, sMarkStatics);
}

void Namespace_obj::__boot()
{
}


} // end namespace format
} // end namespace abc
