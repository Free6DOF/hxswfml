#include <hxObject.h>

#ifndef INCLUDED_ValueType
#include <ValueType.h>
#endif

ValueType ValueType_obj::TBool;

ValueType  ValueType_obj::TClass(Class c)
	{ return CreateEnum<ValueType_obj >(STRING(L"TClass",6),6,DynamicArray(0,1).Add(c)); }

ValueType  ValueType_obj::TEnum(Enum e)
	{ return CreateEnum<ValueType_obj >(STRING(L"TEnum",5),7,DynamicArray(0,1).Add(e)); }

ValueType ValueType_obj::TFloat;

ValueType ValueType_obj::TFunction;

ValueType ValueType_obj::TInt;

ValueType ValueType_obj::TNull;

ValueType ValueType_obj::TObject;

ValueType ValueType_obj::TUnknown;

DEFINE_CREATE_ENUM(ValueType_obj)

int ValueType_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"TBool",5)) return 3;
	if (inName==STRING(L"TClass",6)) return 6;
	if (inName==STRING(L"TEnum",5)) return 7;
	if (inName==STRING(L"TFloat",6)) return 2;
	if (inName==STRING(L"TFunction",9)) return 5;
	if (inName==STRING(L"TInt",4)) return 1;
	if (inName==STRING(L"TNull",5)) return 0;
	if (inName==STRING(L"TObject",7)) return 4;
	if (inName==STRING(L"TUnknown",8)) return 8;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(ValueType_obj,TClass,return)

STATIC_DEFINE_DYNAMIC_FUNC1(ValueType_obj,TEnum,return)

int ValueType_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"TBool",5)) return 0;
	if (inName==STRING(L"TClass",6)) return 1;
	if (inName==STRING(L"TEnum",5)) return 1;
	if (inName==STRING(L"TFloat",6)) return 0;
	if (inName==STRING(L"TFunction",9)) return 0;
	if (inName==STRING(L"TInt",4)) return 0;
	if (inName==STRING(L"TNull",5)) return 0;
	if (inName==STRING(L"TObject",7)) return 0;
	if (inName==STRING(L"TUnknown",8)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic ValueType_obj::__Field(const String &inName)
{
	if (inName==STRING(L"TBool",5)) return TBool;
	if (inName==STRING(L"TClass",6)) return TClass_dyn();
	if (inName==STRING(L"TEnum",5)) return TEnum_dyn();
	if (inName==STRING(L"TFloat",6)) return TFloat;
	if (inName==STRING(L"TFunction",9)) return TFunction;
	if (inName==STRING(L"TInt",4)) return TInt;
	if (inName==STRING(L"TNull",5)) return TNull;
	if (inName==STRING(L"TObject",7)) return TObject;
	if (inName==STRING(L"TUnknown",8)) return TUnknown;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"TBool",5),
	STRING(L"TClass",6),
	STRING(L"TEnum",5),
	STRING(L"TFloat",6),
	STRING(L"TFunction",9),
	STRING(L"TInt",4),
	STRING(L"TNull",5),
	STRING(L"TObject",7),
	STRING(L"TUnknown",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(ValueType_obj::TBool);
	MarkMember(ValueType_obj::TFloat);
	MarkMember(ValueType_obj::TFunction);
	MarkMember(ValueType_obj::TInt);
	MarkMember(ValueType_obj::TNull);
	MarkMember(ValueType_obj::TObject);
	MarkMember(ValueType_obj::TUnknown);
};

static String sMemberFields[] = { String(null()) };
Class ValueType_obj::__mClass;

Dynamic __Create_ValueType_obj() { return new ValueType_obj; }

void ValueType_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"ValueType",9), TCanCast<ValueType_obj >,sStaticFields,sMemberFields,
	&__Create_ValueType_obj, &__Create,
	&super::__SGetClass(), &CreateValueType_obj, sMarkStatics);
}

void ValueType_obj::__boot()
{
Static(TBool) = CreateEnum<ValueType_obj >(STRING(L"TBool",5),3);
Static(TFloat) = CreateEnum<ValueType_obj >(STRING(L"TFloat",6),2);
Static(TFunction) = CreateEnum<ValueType_obj >(STRING(L"TFunction",9),5);
Static(TInt) = CreateEnum<ValueType_obj >(STRING(L"TInt",4),1);
Static(TNull) = CreateEnum<ValueType_obj >(STRING(L"TNull",5),0);
Static(TObject) = CreateEnum<ValueType_obj >(STRING(L"TObject",7),4);
Static(TUnknown) = CreateEnum<ValueType_obj >(STRING(L"TUnknown",8),8);
}


