#include <hxObject.h>

#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
namespace format{
namespace abc{

Index  Index_obj::Idx(int v)
	{ return CreateEnum<Index_obj >(STRING(L"Idx",3),0,DynamicArray(0,1).Add(v)); }

DEFINE_CREATE_ENUM(Index_obj)

int Index_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"Idx",3)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Index_obj,Idx,return)

int Index_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"Idx",3)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic Index_obj::__Field(const String &inName)
{
	if (inName==STRING(L"Idx",3)) return Idx_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"Idx",3),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class Index_obj::__mClass;

Dynamic __Create_Index_obj() { return new Index_obj; }

void Index_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.Index",16), TCanCast<Index_obj >,sStaticFields,sMemberFields,
	&__Create_Index_obj, &__Create,
	&super::__SGetClass(), &CreateIndex_obj, sMarkStatics);
}

void Index_obj::__boot()
{
}


} // end namespace format
} // end namespace abc
