#include <hxObject.h>

#ifndef INCLUDED_format_abc_JumpStyle
#include <format/abc/JumpStyle.h>
#endif
namespace format{
namespace abc{

JumpStyle JumpStyle_obj::JAlways;

JumpStyle JumpStyle_obj::JEq;

JumpStyle JumpStyle_obj::JFalse;

JumpStyle JumpStyle_obj::JGt;

JumpStyle JumpStyle_obj::JGte;

JumpStyle JumpStyle_obj::JLt;

JumpStyle JumpStyle_obj::JLte;

JumpStyle JumpStyle_obj::JNeq;

JumpStyle JumpStyle_obj::JNotGt;

JumpStyle JumpStyle_obj::JNotGte;

JumpStyle JumpStyle_obj::JNotLt;

JumpStyle JumpStyle_obj::JNotLte;

JumpStyle JumpStyle_obj::JPhysEq;

JumpStyle JumpStyle_obj::JPhysNeq;

JumpStyle JumpStyle_obj::JTrue;

DEFINE_CREATE_ENUM(JumpStyle_obj)

int JumpStyle_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"JAlways",7)) return 4;
	if (inName==STRING(L"JEq",3)) return 7;
	if (inName==STRING(L"JFalse",6)) return 6;
	if (inName==STRING(L"JGt",3)) return 11;
	if (inName==STRING(L"JGte",4)) return 12;
	if (inName==STRING(L"JLt",3)) return 9;
	if (inName==STRING(L"JLte",4)) return 10;
	if (inName==STRING(L"JNeq",4)) return 8;
	if (inName==STRING(L"JNotGt",6)) return 2;
	if (inName==STRING(L"JNotGte",7)) return 3;
	if (inName==STRING(L"JNotLt",6)) return 0;
	if (inName==STRING(L"JNotLte",7)) return 1;
	if (inName==STRING(L"JPhysEq",7)) return 13;
	if (inName==STRING(L"JPhysNeq",8)) return 14;
	if (inName==STRING(L"JTrue",5)) return 5;
	return super::__FindIndex(inName);
}

int JumpStyle_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"JAlways",7)) return 0;
	if (inName==STRING(L"JEq",3)) return 0;
	if (inName==STRING(L"JFalse",6)) return 0;
	if (inName==STRING(L"JGt",3)) return 0;
	if (inName==STRING(L"JGte",4)) return 0;
	if (inName==STRING(L"JLt",3)) return 0;
	if (inName==STRING(L"JLte",4)) return 0;
	if (inName==STRING(L"JNeq",4)) return 0;
	if (inName==STRING(L"JNotGt",6)) return 0;
	if (inName==STRING(L"JNotGte",7)) return 0;
	if (inName==STRING(L"JNotLt",6)) return 0;
	if (inName==STRING(L"JNotLte",7)) return 0;
	if (inName==STRING(L"JPhysEq",7)) return 0;
	if (inName==STRING(L"JPhysNeq",8)) return 0;
	if (inName==STRING(L"JTrue",5)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic JumpStyle_obj::__Field(const String &inName)
{
	if (inName==STRING(L"JAlways",7)) return JAlways;
	if (inName==STRING(L"JEq",3)) return JEq;
	if (inName==STRING(L"JFalse",6)) return JFalse;
	if (inName==STRING(L"JGt",3)) return JGt;
	if (inName==STRING(L"JGte",4)) return JGte;
	if (inName==STRING(L"JLt",3)) return JLt;
	if (inName==STRING(L"JLte",4)) return JLte;
	if (inName==STRING(L"JNeq",4)) return JNeq;
	if (inName==STRING(L"JNotGt",6)) return JNotGt;
	if (inName==STRING(L"JNotGte",7)) return JNotGte;
	if (inName==STRING(L"JNotLt",6)) return JNotLt;
	if (inName==STRING(L"JNotLte",7)) return JNotLte;
	if (inName==STRING(L"JPhysEq",7)) return JPhysEq;
	if (inName==STRING(L"JPhysNeq",8)) return JPhysNeq;
	if (inName==STRING(L"JTrue",5)) return JTrue;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"JAlways",7),
	STRING(L"JEq",3),
	STRING(L"JFalse",6),
	STRING(L"JGt",3),
	STRING(L"JGte",4),
	STRING(L"JLt",3),
	STRING(L"JLte",4),
	STRING(L"JNeq",4),
	STRING(L"JNotGt",6),
	STRING(L"JNotGte",7),
	STRING(L"JNotLt",6),
	STRING(L"JNotLte",7),
	STRING(L"JPhysEq",7),
	STRING(L"JPhysNeq",8),
	STRING(L"JTrue",5),
	String(null()) };

static void sMarkStatics() {
	MarkMember(JumpStyle_obj::JAlways);
	MarkMember(JumpStyle_obj::JEq);
	MarkMember(JumpStyle_obj::JFalse);
	MarkMember(JumpStyle_obj::JGt);
	MarkMember(JumpStyle_obj::JGte);
	MarkMember(JumpStyle_obj::JLt);
	MarkMember(JumpStyle_obj::JLte);
	MarkMember(JumpStyle_obj::JNeq);
	MarkMember(JumpStyle_obj::JNotGt);
	MarkMember(JumpStyle_obj::JNotGte);
	MarkMember(JumpStyle_obj::JNotLt);
	MarkMember(JumpStyle_obj::JNotLte);
	MarkMember(JumpStyle_obj::JPhysEq);
	MarkMember(JumpStyle_obj::JPhysNeq);
	MarkMember(JumpStyle_obj::JTrue);
};

static String sMemberFields[] = { String(null()) };
Class JumpStyle_obj::__mClass;

Dynamic __Create_JumpStyle_obj() { return new JumpStyle_obj; }

void JumpStyle_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.JumpStyle",20), TCanCast<JumpStyle_obj >,sStaticFields,sMemberFields,
	&__Create_JumpStyle_obj, &__Create,
	&super::__SGetClass(), &CreateJumpStyle_obj, sMarkStatics);
}

void JumpStyle_obj::__boot()
{
Static(JAlways) = CreateEnum<JumpStyle_obj >(STRING(L"JAlways",7),4);
Static(JEq) = CreateEnum<JumpStyle_obj >(STRING(L"JEq",3),7);
Static(JFalse) = CreateEnum<JumpStyle_obj >(STRING(L"JFalse",6),6);
Static(JGt) = CreateEnum<JumpStyle_obj >(STRING(L"JGt",3),11);
Static(JGte) = CreateEnum<JumpStyle_obj >(STRING(L"JGte",4),12);
Static(JLt) = CreateEnum<JumpStyle_obj >(STRING(L"JLt",3),9);
Static(JLte) = CreateEnum<JumpStyle_obj >(STRING(L"JLte",4),10);
Static(JNeq) = CreateEnum<JumpStyle_obj >(STRING(L"JNeq",4),8);
Static(JNotGt) = CreateEnum<JumpStyle_obj >(STRING(L"JNotGt",6),2);
Static(JNotGte) = CreateEnum<JumpStyle_obj >(STRING(L"JNotGte",7),3);
Static(JNotLt) = CreateEnum<JumpStyle_obj >(STRING(L"JNotLt",6),0);
Static(JNotLte) = CreateEnum<JumpStyle_obj >(STRING(L"JNotLte",7),1);
Static(JPhysEq) = CreateEnum<JumpStyle_obj >(STRING(L"JPhysEq",7),13);
Static(JPhysNeq) = CreateEnum<JumpStyle_obj >(STRING(L"JPhysNeq",8),14);
Static(JTrue) = CreateEnum<JumpStyle_obj >(STRING(L"JTrue",5),5);
}


} // end namespace format
} // end namespace abc
