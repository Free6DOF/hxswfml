#include <hxObject.h>

#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
namespace haxe{
namespace io{

Error Error_obj::Blocked;

Error  Error_obj::Custom(Dynamic e)
	{ return CreateEnum<Error_obj >(STRING(L"Custom",6),3,DynamicArray(0,1).Add(e)); }

Error Error_obj::OutsideBounds;

Error Error_obj::Overflow;

DEFINE_CREATE_ENUM(Error_obj)

int Error_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"Blocked",7)) return 0;
	if (inName==STRING(L"Custom",6)) return 3;
	if (inName==STRING(L"OutsideBounds",13)) return 2;
	if (inName==STRING(L"Overflow",8)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Error_obj,Custom,return)

int Error_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"Blocked",7)) return 0;
	if (inName==STRING(L"Custom",6)) return 1;
	if (inName==STRING(L"OutsideBounds",13)) return 0;
	if (inName==STRING(L"Overflow",8)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Error_obj::__Field(const String &inName)
{
	if (inName==STRING(L"Blocked",7)) return Blocked;
	if (inName==STRING(L"Custom",6)) return Custom_dyn();
	if (inName==STRING(L"OutsideBounds",13)) return OutsideBounds;
	if (inName==STRING(L"Overflow",8)) return Overflow;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"Blocked",7),
	STRING(L"Custom",6),
	STRING(L"OutsideBounds",13),
	STRING(L"Overflow",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Error_obj::Blocked);
	MarkMember(Error_obj::OutsideBounds);
	MarkMember(Error_obj::Overflow);
};

static String sMemberFields[] = { String(null()) };
Class Error_obj::__mClass;

Dynamic __Create_Error_obj() { return new Error_obj; }

void Error_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"haxe.io.Error",13), TCanCast<Error_obj >,sStaticFields,sMemberFields,
	&__Create_Error_obj, &__Create,
	&super::__SGetClass(), &CreateError_obj, sMarkStatics);
}

void Error_obj::__boot()
{
Static(Blocked) = CreateEnum<Error_obj >(STRING(L"Blocked",7),0);
Static(OutsideBounds) = CreateEnum<Error_obj >(STRING(L"OutsideBounds",13),2);
Static(Overflow) = CreateEnum<Error_obj >(STRING(L"Overflow",8),1);
}


} // end namespace haxe
} // end namespace io
