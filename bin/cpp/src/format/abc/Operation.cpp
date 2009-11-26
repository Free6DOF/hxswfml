#include <hxObject.h>

#ifndef INCLUDED_format_abc_Operation
#include <format/abc/Operation.h>
#endif
namespace format{
namespace abc{

Operation Operation_obj::OpAdd;

Operation Operation_obj::OpAnd;

Operation Operation_obj::OpAs;

Operation Operation_obj::OpBitNot;

Operation Operation_obj::OpDecr;

Operation Operation_obj::OpDiv;

Operation Operation_obj::OpEq;

Operation Operation_obj::OpGt;

Operation Operation_obj::OpGte;

Operation Operation_obj::OpIAdd;

Operation Operation_obj::OpIDecr;

Operation Operation_obj::OpIIncr;

Operation Operation_obj::OpIMul;

Operation Operation_obj::OpINeg;

Operation Operation_obj::OpISub;

Operation Operation_obj::OpIn;

Operation Operation_obj::OpIncr;

Operation Operation_obj::OpIs;

Operation Operation_obj::OpLt;

Operation Operation_obj::OpLte;

Operation Operation_obj::OpMemGet16;

Operation Operation_obj::OpMemGet32;

Operation Operation_obj::OpMemGet8;

Operation Operation_obj::OpMemGetDouble;

Operation Operation_obj::OpMemGetFloat;

Operation Operation_obj::OpMemSet16;

Operation Operation_obj::OpMemSet32;

Operation Operation_obj::OpMemSet8;

Operation Operation_obj::OpMemSetDouble;

Operation Operation_obj::OpMemSetFloat;

Operation Operation_obj::OpMod;

Operation Operation_obj::OpMul;

Operation Operation_obj::OpNeg;

Operation Operation_obj::OpNot;

Operation Operation_obj::OpOr;

Operation Operation_obj::OpPhysEq;

Operation Operation_obj::OpShl;

Operation Operation_obj::OpShr;

Operation Operation_obj::OpSign1;

Operation Operation_obj::OpSign16;

Operation Operation_obj::OpSign8;

Operation Operation_obj::OpSub;

Operation Operation_obj::OpUShr;

Operation Operation_obj::OpXor;

DEFINE_CREATE_ENUM(Operation_obj)

int Operation_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"OpAdd",5)) return 6;
	if (inName==STRING(L"OpAnd",5)) return 14;
	if (inName==STRING(L"OpAs",4)) return 0;
	if (inName==STRING(L"OpBitNot",8)) return 5;
	if (inName==STRING(L"OpDecr",6)) return 3;
	if (inName==STRING(L"OpDiv",5)) return 9;
	if (inName==STRING(L"OpEq",4)) return 17;
	if (inName==STRING(L"OpGt",4)) return 21;
	if (inName==STRING(L"OpGte",5)) return 22;
	if (inName==STRING(L"OpIAdd",6)) return 28;
	if (inName==STRING(L"OpIDecr",7)) return 26;
	if (inName==STRING(L"OpIIncr",7)) return 25;
	if (inName==STRING(L"OpIMul",6)) return 30;
	if (inName==STRING(L"OpINeg",6)) return 27;
	if (inName==STRING(L"OpISub",6)) return 29;
	if (inName==STRING(L"OpIn",4)) return 24;
	if (inName==STRING(L"OpIncr",6)) return 2;
	if (inName==STRING(L"OpIs",4)) return 23;
	if (inName==STRING(L"OpLt",4)) return 19;
	if (inName==STRING(L"OpLte",5)) return 20;
	if (inName==STRING(L"OpMemGet16",10)) return 32;
	if (inName==STRING(L"OpMemGet32",10)) return 33;
	if (inName==STRING(L"OpMemGet8",9)) return 31;
	if (inName==STRING(L"OpMemGetDouble",14)) return 35;
	if (inName==STRING(L"OpMemGetFloat",13)) return 34;
	if (inName==STRING(L"OpMemSet16",10)) return 37;
	if (inName==STRING(L"OpMemSet32",10)) return 38;
	if (inName==STRING(L"OpMemSet8",9)) return 36;
	if (inName==STRING(L"OpMemSetDouble",14)) return 40;
	if (inName==STRING(L"OpMemSetFloat",13)) return 39;
	if (inName==STRING(L"OpMod",5)) return 10;
	if (inName==STRING(L"OpMul",5)) return 8;
	if (inName==STRING(L"OpNeg",5)) return 1;
	if (inName==STRING(L"OpNot",5)) return 4;
	if (inName==STRING(L"OpOr",4)) return 15;
	if (inName==STRING(L"OpPhysEq",8)) return 18;
	if (inName==STRING(L"OpShl",5)) return 11;
	if (inName==STRING(L"OpShr",5)) return 12;
	if (inName==STRING(L"OpSign1",7)) return 41;
	if (inName==STRING(L"OpSign16",8)) return 43;
	if (inName==STRING(L"OpSign8",7)) return 42;
	if (inName==STRING(L"OpSub",5)) return 7;
	if (inName==STRING(L"OpUShr",6)) return 13;
	if (inName==STRING(L"OpXor",5)) return 16;
	return super::__FindIndex(inName);
}

int Operation_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"OpAdd",5)) return 0;
	if (inName==STRING(L"OpAnd",5)) return 0;
	if (inName==STRING(L"OpAs",4)) return 0;
	if (inName==STRING(L"OpBitNot",8)) return 0;
	if (inName==STRING(L"OpDecr",6)) return 0;
	if (inName==STRING(L"OpDiv",5)) return 0;
	if (inName==STRING(L"OpEq",4)) return 0;
	if (inName==STRING(L"OpGt",4)) return 0;
	if (inName==STRING(L"OpGte",5)) return 0;
	if (inName==STRING(L"OpIAdd",6)) return 0;
	if (inName==STRING(L"OpIDecr",7)) return 0;
	if (inName==STRING(L"OpIIncr",7)) return 0;
	if (inName==STRING(L"OpIMul",6)) return 0;
	if (inName==STRING(L"OpINeg",6)) return 0;
	if (inName==STRING(L"OpISub",6)) return 0;
	if (inName==STRING(L"OpIn",4)) return 0;
	if (inName==STRING(L"OpIncr",6)) return 0;
	if (inName==STRING(L"OpIs",4)) return 0;
	if (inName==STRING(L"OpLt",4)) return 0;
	if (inName==STRING(L"OpLte",5)) return 0;
	if (inName==STRING(L"OpMemGet16",10)) return 0;
	if (inName==STRING(L"OpMemGet32",10)) return 0;
	if (inName==STRING(L"OpMemGet8",9)) return 0;
	if (inName==STRING(L"OpMemGetDouble",14)) return 0;
	if (inName==STRING(L"OpMemGetFloat",13)) return 0;
	if (inName==STRING(L"OpMemSet16",10)) return 0;
	if (inName==STRING(L"OpMemSet32",10)) return 0;
	if (inName==STRING(L"OpMemSet8",9)) return 0;
	if (inName==STRING(L"OpMemSetDouble",14)) return 0;
	if (inName==STRING(L"OpMemSetFloat",13)) return 0;
	if (inName==STRING(L"OpMod",5)) return 0;
	if (inName==STRING(L"OpMul",5)) return 0;
	if (inName==STRING(L"OpNeg",5)) return 0;
	if (inName==STRING(L"OpNot",5)) return 0;
	if (inName==STRING(L"OpOr",4)) return 0;
	if (inName==STRING(L"OpPhysEq",8)) return 0;
	if (inName==STRING(L"OpShl",5)) return 0;
	if (inName==STRING(L"OpShr",5)) return 0;
	if (inName==STRING(L"OpSign1",7)) return 0;
	if (inName==STRING(L"OpSign16",8)) return 0;
	if (inName==STRING(L"OpSign8",7)) return 0;
	if (inName==STRING(L"OpSub",5)) return 0;
	if (inName==STRING(L"OpUShr",6)) return 0;
	if (inName==STRING(L"OpXor",5)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Operation_obj::__Field(const String &inName)
{
	if (inName==STRING(L"OpAdd",5)) return OpAdd;
	if (inName==STRING(L"OpAnd",5)) return OpAnd;
	if (inName==STRING(L"OpAs",4)) return OpAs;
	if (inName==STRING(L"OpBitNot",8)) return OpBitNot;
	if (inName==STRING(L"OpDecr",6)) return OpDecr;
	if (inName==STRING(L"OpDiv",5)) return OpDiv;
	if (inName==STRING(L"OpEq",4)) return OpEq;
	if (inName==STRING(L"OpGt",4)) return OpGt;
	if (inName==STRING(L"OpGte",5)) return OpGte;
	if (inName==STRING(L"OpIAdd",6)) return OpIAdd;
	if (inName==STRING(L"OpIDecr",7)) return OpIDecr;
	if (inName==STRING(L"OpIIncr",7)) return OpIIncr;
	if (inName==STRING(L"OpIMul",6)) return OpIMul;
	if (inName==STRING(L"OpINeg",6)) return OpINeg;
	if (inName==STRING(L"OpISub",6)) return OpISub;
	if (inName==STRING(L"OpIn",4)) return OpIn;
	if (inName==STRING(L"OpIncr",6)) return OpIncr;
	if (inName==STRING(L"OpIs",4)) return OpIs;
	if (inName==STRING(L"OpLt",4)) return OpLt;
	if (inName==STRING(L"OpLte",5)) return OpLte;
	if (inName==STRING(L"OpMemGet16",10)) return OpMemGet16;
	if (inName==STRING(L"OpMemGet32",10)) return OpMemGet32;
	if (inName==STRING(L"OpMemGet8",9)) return OpMemGet8;
	if (inName==STRING(L"OpMemGetDouble",14)) return OpMemGetDouble;
	if (inName==STRING(L"OpMemGetFloat",13)) return OpMemGetFloat;
	if (inName==STRING(L"OpMemSet16",10)) return OpMemSet16;
	if (inName==STRING(L"OpMemSet32",10)) return OpMemSet32;
	if (inName==STRING(L"OpMemSet8",9)) return OpMemSet8;
	if (inName==STRING(L"OpMemSetDouble",14)) return OpMemSetDouble;
	if (inName==STRING(L"OpMemSetFloat",13)) return OpMemSetFloat;
	if (inName==STRING(L"OpMod",5)) return OpMod;
	if (inName==STRING(L"OpMul",5)) return OpMul;
	if (inName==STRING(L"OpNeg",5)) return OpNeg;
	if (inName==STRING(L"OpNot",5)) return OpNot;
	if (inName==STRING(L"OpOr",4)) return OpOr;
	if (inName==STRING(L"OpPhysEq",8)) return OpPhysEq;
	if (inName==STRING(L"OpShl",5)) return OpShl;
	if (inName==STRING(L"OpShr",5)) return OpShr;
	if (inName==STRING(L"OpSign1",7)) return OpSign1;
	if (inName==STRING(L"OpSign16",8)) return OpSign16;
	if (inName==STRING(L"OpSign8",7)) return OpSign8;
	if (inName==STRING(L"OpSub",5)) return OpSub;
	if (inName==STRING(L"OpUShr",6)) return OpUShr;
	if (inName==STRING(L"OpXor",5)) return OpXor;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"OpAdd",5),
	STRING(L"OpAnd",5),
	STRING(L"OpAs",4),
	STRING(L"OpBitNot",8),
	STRING(L"OpDecr",6),
	STRING(L"OpDiv",5),
	STRING(L"OpEq",4),
	STRING(L"OpGt",4),
	STRING(L"OpGte",5),
	STRING(L"OpIAdd",6),
	STRING(L"OpIDecr",7),
	STRING(L"OpIIncr",7),
	STRING(L"OpIMul",6),
	STRING(L"OpINeg",6),
	STRING(L"OpISub",6),
	STRING(L"OpIn",4),
	STRING(L"OpIncr",6),
	STRING(L"OpIs",4),
	STRING(L"OpLt",4),
	STRING(L"OpLte",5),
	STRING(L"OpMemGet16",10),
	STRING(L"OpMemGet32",10),
	STRING(L"OpMemGet8",9),
	STRING(L"OpMemGetDouble",14),
	STRING(L"OpMemGetFloat",13),
	STRING(L"OpMemSet16",10),
	STRING(L"OpMemSet32",10),
	STRING(L"OpMemSet8",9),
	STRING(L"OpMemSetDouble",14),
	STRING(L"OpMemSetFloat",13),
	STRING(L"OpMod",5),
	STRING(L"OpMul",5),
	STRING(L"OpNeg",5),
	STRING(L"OpNot",5),
	STRING(L"OpOr",4),
	STRING(L"OpPhysEq",8),
	STRING(L"OpShl",5),
	STRING(L"OpShr",5),
	STRING(L"OpSign1",7),
	STRING(L"OpSign16",8),
	STRING(L"OpSign8",7),
	STRING(L"OpSub",5),
	STRING(L"OpUShr",6),
	STRING(L"OpXor",5),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Operation_obj::OpAdd);
	MarkMember(Operation_obj::OpAnd);
	MarkMember(Operation_obj::OpAs);
	MarkMember(Operation_obj::OpBitNot);
	MarkMember(Operation_obj::OpDecr);
	MarkMember(Operation_obj::OpDiv);
	MarkMember(Operation_obj::OpEq);
	MarkMember(Operation_obj::OpGt);
	MarkMember(Operation_obj::OpGte);
	MarkMember(Operation_obj::OpIAdd);
	MarkMember(Operation_obj::OpIDecr);
	MarkMember(Operation_obj::OpIIncr);
	MarkMember(Operation_obj::OpIMul);
	MarkMember(Operation_obj::OpINeg);
	MarkMember(Operation_obj::OpISub);
	MarkMember(Operation_obj::OpIn);
	MarkMember(Operation_obj::OpIncr);
	MarkMember(Operation_obj::OpIs);
	MarkMember(Operation_obj::OpLt);
	MarkMember(Operation_obj::OpLte);
	MarkMember(Operation_obj::OpMemGet16);
	MarkMember(Operation_obj::OpMemGet32);
	MarkMember(Operation_obj::OpMemGet8);
	MarkMember(Operation_obj::OpMemGetDouble);
	MarkMember(Operation_obj::OpMemGetFloat);
	MarkMember(Operation_obj::OpMemSet16);
	MarkMember(Operation_obj::OpMemSet32);
	MarkMember(Operation_obj::OpMemSet8);
	MarkMember(Operation_obj::OpMemSetDouble);
	MarkMember(Operation_obj::OpMemSetFloat);
	MarkMember(Operation_obj::OpMod);
	MarkMember(Operation_obj::OpMul);
	MarkMember(Operation_obj::OpNeg);
	MarkMember(Operation_obj::OpNot);
	MarkMember(Operation_obj::OpOr);
	MarkMember(Operation_obj::OpPhysEq);
	MarkMember(Operation_obj::OpShl);
	MarkMember(Operation_obj::OpShr);
	MarkMember(Operation_obj::OpSign1);
	MarkMember(Operation_obj::OpSign16);
	MarkMember(Operation_obj::OpSign8);
	MarkMember(Operation_obj::OpSub);
	MarkMember(Operation_obj::OpUShr);
	MarkMember(Operation_obj::OpXor);
};

static String sMemberFields[] = { String(null()) };
Class Operation_obj::__mClass;

Dynamic __Create_Operation_obj() { return new Operation_obj; }

void Operation_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.Operation",20), TCanCast<Operation_obj >,sStaticFields,sMemberFields,
	&__Create_Operation_obj, &__Create,
	&super::__SGetClass(), &CreateOperation_obj, sMarkStatics);
}

void Operation_obj::__boot()
{
Static(OpAdd) = CreateEnum<Operation_obj >(STRING(L"OpAdd",5),6);
Static(OpAnd) = CreateEnum<Operation_obj >(STRING(L"OpAnd",5),14);
Static(OpAs) = CreateEnum<Operation_obj >(STRING(L"OpAs",4),0);
Static(OpBitNot) = CreateEnum<Operation_obj >(STRING(L"OpBitNot",8),5);
Static(OpDecr) = CreateEnum<Operation_obj >(STRING(L"OpDecr",6),3);
Static(OpDiv) = CreateEnum<Operation_obj >(STRING(L"OpDiv",5),9);
Static(OpEq) = CreateEnum<Operation_obj >(STRING(L"OpEq",4),17);
Static(OpGt) = CreateEnum<Operation_obj >(STRING(L"OpGt",4),21);
Static(OpGte) = CreateEnum<Operation_obj >(STRING(L"OpGte",5),22);
Static(OpIAdd) = CreateEnum<Operation_obj >(STRING(L"OpIAdd",6),28);
Static(OpIDecr) = CreateEnum<Operation_obj >(STRING(L"OpIDecr",7),26);
Static(OpIIncr) = CreateEnum<Operation_obj >(STRING(L"OpIIncr",7),25);
Static(OpIMul) = CreateEnum<Operation_obj >(STRING(L"OpIMul",6),30);
Static(OpINeg) = CreateEnum<Operation_obj >(STRING(L"OpINeg",6),27);
Static(OpISub) = CreateEnum<Operation_obj >(STRING(L"OpISub",6),29);
Static(OpIn) = CreateEnum<Operation_obj >(STRING(L"OpIn",4),24);
Static(OpIncr) = CreateEnum<Operation_obj >(STRING(L"OpIncr",6),2);
Static(OpIs) = CreateEnum<Operation_obj >(STRING(L"OpIs",4),23);
Static(OpLt) = CreateEnum<Operation_obj >(STRING(L"OpLt",4),19);
Static(OpLte) = CreateEnum<Operation_obj >(STRING(L"OpLte",5),20);
Static(OpMemGet16) = CreateEnum<Operation_obj >(STRING(L"OpMemGet16",10),32);
Static(OpMemGet32) = CreateEnum<Operation_obj >(STRING(L"OpMemGet32",10),33);
Static(OpMemGet8) = CreateEnum<Operation_obj >(STRING(L"OpMemGet8",9),31);
Static(OpMemGetDouble) = CreateEnum<Operation_obj >(STRING(L"OpMemGetDouble",14),35);
Static(OpMemGetFloat) = CreateEnum<Operation_obj >(STRING(L"OpMemGetFloat",13),34);
Static(OpMemSet16) = CreateEnum<Operation_obj >(STRING(L"OpMemSet16",10),37);
Static(OpMemSet32) = CreateEnum<Operation_obj >(STRING(L"OpMemSet32",10),38);
Static(OpMemSet8) = CreateEnum<Operation_obj >(STRING(L"OpMemSet8",9),36);
Static(OpMemSetDouble) = CreateEnum<Operation_obj >(STRING(L"OpMemSetDouble",14),40);
Static(OpMemSetFloat) = CreateEnum<Operation_obj >(STRING(L"OpMemSetFloat",13),39);
Static(OpMod) = CreateEnum<Operation_obj >(STRING(L"OpMod",5),10);
Static(OpMul) = CreateEnum<Operation_obj >(STRING(L"OpMul",5),8);
Static(OpNeg) = CreateEnum<Operation_obj >(STRING(L"OpNeg",5),1);
Static(OpNot) = CreateEnum<Operation_obj >(STRING(L"OpNot",5),4);
Static(OpOr) = CreateEnum<Operation_obj >(STRING(L"OpOr",4),15);
Static(OpPhysEq) = CreateEnum<Operation_obj >(STRING(L"OpPhysEq",8),18);
Static(OpShl) = CreateEnum<Operation_obj >(STRING(L"OpShl",5),11);
Static(OpShr) = CreateEnum<Operation_obj >(STRING(L"OpShr",5),12);
Static(OpSign1) = CreateEnum<Operation_obj >(STRING(L"OpSign1",7),41);
Static(OpSign16) = CreateEnum<Operation_obj >(STRING(L"OpSign16",8),43);
Static(OpSign8) = CreateEnum<Operation_obj >(STRING(L"OpSign8",7),42);
Static(OpSub) = CreateEnum<Operation_obj >(STRING(L"OpSub",5),7);
Static(OpUShr) = CreateEnum<Operation_obj >(STRING(L"OpUShr",6),13);
Static(OpXor) = CreateEnum<Operation_obj >(STRING(L"OpXor",5),16);
}


} // end namespace format
} // end namespace abc
