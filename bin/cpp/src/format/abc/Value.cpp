#include <hxObject.h>

#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
namespace format{
namespace abc{

Value  Value_obj::VBool(bool b)
	{ return CreateEnum<Value_obj >(STRING(L"VBool",5),1,DynamicArray(0,1).Add(b)); }

Value  Value_obj::VFloat(format::abc::Index f)
	{ return CreateEnum<Value_obj >(STRING(L"VFloat",6),5,DynamicArray(0,1).Add(f)); }

Value  Value_obj::VInt(format::abc::Index i)
	{ return CreateEnum<Value_obj >(STRING(L"VInt",4),3,DynamicArray(0,1).Add(i)); }

Value  Value_obj::VNamespace(int kind,format::abc::Index ns)
	{ return CreateEnum<Value_obj >(STRING(L"VNamespace",10),6,DynamicArray(0,2).Add(kind).Add(ns)); }

Value Value_obj::VNull;

Value  Value_obj::VString(format::abc::Index i)
	{ return CreateEnum<Value_obj >(STRING(L"VString",7),2,DynamicArray(0,1).Add(i)); }

Value  Value_obj::VUInt(format::abc::Index i)
	{ return CreateEnum<Value_obj >(STRING(L"VUInt",5),4,DynamicArray(0,1).Add(i)); }

DEFINE_CREATE_ENUM(Value_obj)

int Value_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"VBool",5)) return 1;
	if (inName==STRING(L"VFloat",6)) return 5;
	if (inName==STRING(L"VInt",4)) return 3;
	if (inName==STRING(L"VNamespace",10)) return 6;
	if (inName==STRING(L"VNull",5)) return 0;
	if (inName==STRING(L"VString",7)) return 2;
	if (inName==STRING(L"VUInt",5)) return 4;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Value_obj,VBool,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Value_obj,VFloat,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Value_obj,VInt,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Value_obj,VNamespace,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Value_obj,VString,return)

STATIC_DEFINE_DYNAMIC_FUNC1(Value_obj,VUInt,return)

int Value_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"VBool",5)) return 1;
	if (inName==STRING(L"VFloat",6)) return 1;
	if (inName==STRING(L"VInt",4)) return 1;
	if (inName==STRING(L"VNamespace",10)) return 2;
	if (inName==STRING(L"VNull",5)) return 0;
	if (inName==STRING(L"VString",7)) return 1;
	if (inName==STRING(L"VUInt",5)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic Value_obj::__Field(const String &inName)
{
	if (inName==STRING(L"VBool",5)) return VBool_dyn();
	if (inName==STRING(L"VFloat",6)) return VFloat_dyn();
	if (inName==STRING(L"VInt",4)) return VInt_dyn();
	if (inName==STRING(L"VNamespace",10)) return VNamespace_dyn();
	if (inName==STRING(L"VNull",5)) return VNull;
	if (inName==STRING(L"VString",7)) return VString_dyn();
	if (inName==STRING(L"VUInt",5)) return VUInt_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"VBool",5),
	STRING(L"VFloat",6),
	STRING(L"VInt",4),
	STRING(L"VNamespace",10),
	STRING(L"VNull",5),
	STRING(L"VString",7),
	STRING(L"VUInt",5),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Value_obj::VNull);
};

static String sMemberFields[] = { String(null()) };
Class Value_obj::__mClass;

Dynamic __Create_Value_obj() { return new Value_obj; }

void Value_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.Value",16), TCanCast<Value_obj >,sStaticFields,sMemberFields,
	&__Create_Value_obj, &__Create,
	&super::__SGetClass(), &CreateValue_obj, sMarkStatics);
}

void Value_obj::__boot()
{
Static(VNull) = CreateEnum<Value_obj >(STRING(L"VNull",5),0);
}


} // end namespace format
} // end namespace abc
