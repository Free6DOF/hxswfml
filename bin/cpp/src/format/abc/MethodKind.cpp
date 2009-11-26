#include <hxObject.h>

#ifndef INCLUDED_format_abc_MethodKind
#include <format/abc/MethodKind.h>
#endif
namespace format{
namespace abc{

MethodKind MethodKind_obj::KGetter;

MethodKind MethodKind_obj::KNormal;

MethodKind MethodKind_obj::KSetter;

DEFINE_CREATE_ENUM(MethodKind_obj)

int MethodKind_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"KGetter",7)) return 1;
	if (inName==STRING(L"KNormal",7)) return 0;
	if (inName==STRING(L"KSetter",7)) return 2;
	return super::__FindIndex(inName);
}

int MethodKind_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"KGetter",7)) return 0;
	if (inName==STRING(L"KNormal",7)) return 0;
	if (inName==STRING(L"KSetter",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic MethodKind_obj::__Field(const String &inName)
{
	if (inName==STRING(L"KGetter",7)) return KGetter;
	if (inName==STRING(L"KNormal",7)) return KNormal;
	if (inName==STRING(L"KSetter",7)) return KSetter;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"KGetter",7),
	STRING(L"KNormal",7),
	STRING(L"KSetter",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(MethodKind_obj::KGetter);
	MarkMember(MethodKind_obj::KNormal);
	MarkMember(MethodKind_obj::KSetter);
};

static String sMemberFields[] = { String(null()) };
Class MethodKind_obj::__mClass;

Dynamic __Create_MethodKind_obj() { return new MethodKind_obj; }

void MethodKind_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.MethodKind",21), TCanCast<MethodKind_obj >,sStaticFields,sMemberFields,
	&__Create_MethodKind_obj, &__Create,
	&super::__SGetClass(), &CreateMethodKind_obj, sMarkStatics);
}

void MethodKind_obj::__boot()
{
Static(KGetter) = CreateEnum<MethodKind_obj >(STRING(L"KGetter",7),1);
Static(KNormal) = CreateEnum<MethodKind_obj >(STRING(L"KNormal",7),0);
Static(KSetter) = CreateEnum<MethodKind_obj >(STRING(L"KSetter",7),2);
}


} // end namespace format
} // end namespace abc
