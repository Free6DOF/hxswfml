#include <hxObject.h>

#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_JumpStyle
#include <format/abc/JumpStyle.h>
#endif
#ifndef INCLUDED_format_abc_OpCode
#include <format/abc/OpCode.h>
#endif
#ifndef INCLUDED_format_abc_Operation
#include <format/abc/Operation.h>
#endif
namespace format{
namespace abc{

OpCode  OpCode_obj::OApplyType(int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OApplyType",10),50,DynamicArray(0,1).Add(nargs)); }

OpCode  OpCode_obj::OArray(int nvalues)
	{ return CreateEnum<OpCode_obj >(STRING(L"OArray",6),52,DynamicArray(0,1).Add(nvalues)); }

OpCode OpCode_obj::OAsAny;

OpCode OpCode_obj::OAsObject;

OpCode OpCode_obj::OAsString;

OpCode  OpCode_obj::OAsType(format::abc::Index t)
	{ return CreateEnum<OpCode_obj >(STRING(L"OAsType",7),85,DynamicArray(0,1).Add(t)); }

OpCode OpCode_obj::OBreakPoint;

OpCode  OpCode_obj::OBreakPointLine(int n)
	{ return CreateEnum<OpCode_obj >(STRING(L"OBreakPointLine",15),99,DynamicArray(0,1).Add(n)); }

OpCode  OpCode_obj::OCallMethod(int slot,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallMethod",11),39,DynamicArray(0,2).Add(slot).Add(nargs)); }

OpCode  OpCode_obj::OCallPropLex(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallPropLex",12),47,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OCallPropVoid(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallPropVoid",13),49,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OCallProperty(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallProperty",13),42,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OCallStack(int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallStack",10),37,DynamicArray(0,1).Add(nargs)); }

OpCode  OpCode_obj::OCallStatic(format::abc::Index meth,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallStatic",11),40,DynamicArray(0,2).Add(meth).Add(nargs)); }

OpCode  OpCode_obj::OCallSuper(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallSuper",10),41,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OCallSuperVoid(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCallSuperVoid",14),48,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OCast(format::abc::Index t)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCast",5),82,DynamicArray(0,1).Add(t)); }

OpCode  OpCode_obj::OCatch(int c)
	{ return CreateEnum<OpCode_obj >(STRING(L"OCatch",6),56,DynamicArray(0,1).Add(c)); }

OpCode OpCode_obj::OCheckIsXml;

OpCode  OpCode_obj::OClassDef(format::abc::Index c)
	{ return CreateEnum<OpCode_obj >(STRING(L"OClassDef",9),54,DynamicArray(0,1).Add(c)); }

OpCode  OpCode_obj::OConstruct(int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OConstruct",10),38,DynamicArray(0,1).Add(nargs)); }

OpCode  OpCode_obj::OConstructProperty(format::abc::Index name,int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OConstructProperty",18),46,DynamicArray(0,2).Add(name).Add(nargs)); }

OpCode  OpCode_obj::OConstructSuper(int nargs)
	{ return CreateEnum<OpCode_obj >(STRING(L"OConstructSuper",15),45,DynamicArray(0,1).Add(nargs)); }

OpCode  OpCode_obj::ODebugFile(format::abc::Index file)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODebugFile",10),98,DynamicArray(0,1).Add(file)); }

OpCode  OpCode_obj::ODebugLine(int line)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODebugLine",10),97,DynamicArray(0,1).Add(line)); }

OpCode  OpCode_obj::ODebugReg(format::abc::Index name,int r,int line)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODebugReg",9),96,DynamicArray(0,3).Add(name).Add(r).Add(line)); }

OpCode  OpCode_obj::ODecrIReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODecrIReg",9),93,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::ODecrReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODecrReg",8),88,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::ODeleteProp(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODeleteProp",11),68,DynamicArray(0,1).Add(p)); }

OpCode OpCode_obj::ODup;

OpCode  OpCode_obj::ODxNs(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"ODxNs",5),5,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::ODxNsLate;

OpCode OpCode_obj::OFalse;

OpCode  OpCode_obj::OFindDefinition(format::abc::Index d)
	{ return CreateEnum<OpCode_obj >(STRING(L"OFindDefinition",15),59,DynamicArray(0,1).Add(d)); }

OpCode  OpCode_obj::OFindProp(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OFindProp",9),58,DynamicArray(0,1).Add(p)); }

OpCode  OpCode_obj::OFindPropStrict(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OFindPropStrict",15),57,DynamicArray(0,1).Add(p)); }

OpCode  OpCode_obj::OFloat(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OFloat",6),32,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::OForEach;

OpCode OpCode_obj::OForIn;

OpCode  OpCode_obj::OFunction(format::abc::Index f)
	{ return CreateEnum<OpCode_obj >(STRING(L"OFunction",9),36,DynamicArray(0,1).Add(f)); }

OpCode  OpCode_obj::OGetDescendants(format::abc::Index c)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetDescendants",15),55,DynamicArray(0,1).Add(c)); }

OpCode OpCode_obj::OGetGlobalScope;

OpCode  OpCode_obj::OGetGlobalSlot(int s)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetGlobalSlot",14),71,DynamicArray(0,1).Add(s)); }

OpCode  OpCode_obj::OGetLex(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetLex",7),60,DynamicArray(0,1).Add(p)); }

OpCode  OpCode_obj::OGetProp(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetProp",8),66,DynamicArray(0,1).Add(p)); }

OpCode  OpCode_obj::OGetScope(int n)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetScope",9),65,DynamicArray(0,1).Add(n)); }

OpCode  OpCode_obj::OGetSlot(int s)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetSlot",8),69,DynamicArray(0,1).Add(s)); }

OpCode  OpCode_obj::OGetSuper(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OGetSuper",9),3,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::OHasNext;

OpCode  OpCode_obj::OIncrIReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"OIncrIReg",9),92,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::OIncrReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"OIncrReg",8),87,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::OInitProp(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OInitProp",9),67,DynamicArray(0,1).Add(p)); }

OpCode OpCode_obj::OInstanceOf;

OpCode  OpCode_obj::OInt(int v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OInt",4),22,DynamicArray(0,1).Add(v)); }

OpCode  OpCode_obj::OIntRef(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OIntRef",7),30,DynamicArray(0,1).Add(v)); }

OpCode  OpCode_obj::OIsType(format::abc::Index t)
	{ return CreateEnum<OpCode_obj >(STRING(L"OIsType",7),91,DynamicArray(0,1).Add(t)); }

OpCode  OpCode_obj::OJump(format::abc::JumpStyle j,int delta)
	{ return CreateEnum<OpCode_obj >(STRING(L"OJump",5),10,DynamicArray(0,2).Add(j).Add(delta)); }

OpCode  OpCode_obj::OJump2(format::abc::JumpStyle j,String landingName,int delta)
	{ return CreateEnum<OpCode_obj >(STRING(L"OJump2",6),11,DynamicArray(0,3).Add(j).Add(landingName).Add(delta)); }

OpCode  OpCode_obj::OJump3(String landingName)
	{ return CreateEnum<OpCode_obj >(STRING(L"OJump3",6),12,DynamicArray(0,1).Add(landingName)); }

OpCode OpCode_obj::OLabel;

OpCode  OpCode_obj::OLabel2(String name)
	{ return CreateEnum<OpCode_obj >(STRING(L"OLabel2",7),9,DynamicArray(0,1).Add(name)); }

OpCode OpCode_obj::ONaN;

OpCode  OpCode_obj::ONamespace(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"ONamespace",10),34,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::ONewBlock;

OpCode  OpCode_obj::ONext(int r1,int r2)
	{ return CreateEnum<OpCode_obj >(STRING(L"ONext",5),35,DynamicArray(0,2).Add(r1).Add(r2)); }

OpCode OpCode_obj::ONop;

OpCode OpCode_obj::ONull;

OpCode  OpCode_obj::OObject(int nfields)
	{ return CreateEnum<OpCode_obj >(STRING(L"OObject",7),51,DynamicArray(0,1).Add(nfields)); }

OpCode  OpCode_obj::OOp(format::abc::Operation op)
	{ return CreateEnum<OpCode_obj >(STRING(L"OOp",3),101,DynamicArray(0,1).Add(op)); }

OpCode OpCode_obj::OPop;

OpCode OpCode_obj::OPopScope;

OpCode OpCode_obj::OPushWith;

OpCode  OpCode_obj::OReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"OReg",4),62,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::ORegKill(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"ORegKill",8),7,DynamicArray(0,1).Add(r)); }

OpCode OpCode_obj::ORet;

OpCode OpCode_obj::ORetVoid;

OpCode OpCode_obj::OScope;

OpCode  OpCode_obj::OSetGlobalSlot(int s)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSetGlobalSlot",14),72,DynamicArray(0,1).Add(s)); }

OpCode  OpCode_obj::OSetProp(format::abc::Index p)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSetProp",8),61,DynamicArray(0,1).Add(p)); }

OpCode  OpCode_obj::OSetReg(int r)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSetReg",7),63,DynamicArray(0,1).Add(r)); }

OpCode  OpCode_obj::OSetSlot(int s)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSetSlot",8),70,DynamicArray(0,1).Add(s)); }

OpCode  OpCode_obj::OSetSuper(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSetSuper",9),4,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::OSetThis;

OpCode  OpCode_obj::OSmallInt(int v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSmallInt",9),21,DynamicArray(0,1).Add(v)); }

OpCode  OpCode_obj::OString(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OString",7),29,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::OSwap;

OpCode  OpCode_obj::OSwitch(int def,Array<int > deltas)
	{ return CreateEnum<OpCode_obj >(STRING(L"OSwitch",7),13,DynamicArray(0,2).Add(def).Add(deltas)); }

OpCode OpCode_obj::OThis;

OpCode OpCode_obj::OThrow;

OpCode OpCode_obj::OTimestamp;

OpCode OpCode_obj::OToBool;

OpCode OpCode_obj::OToInt;

OpCode OpCode_obj::OToNumber;

OpCode OpCode_obj::OToObject;

OpCode OpCode_obj::OToString;

OpCode OpCode_obj::OToUInt;

OpCode OpCode_obj::OToXml;

OpCode OpCode_obj::OToXmlAttr;

OpCode OpCode_obj::OTrue;

OpCode OpCode_obj::OTypeof;

OpCode  OpCode_obj::OUIntRef(format::abc::Index v)
	{ return CreateEnum<OpCode_obj >(STRING(L"OUIntRef",8),31,DynamicArray(0,1).Add(v)); }

OpCode OpCode_obj::OUndefined;

OpCode  OpCode_obj::OUnknown(int byte)
	{ return CreateEnum<OpCode_obj >(STRING(L"OUnknown",8),102,DynamicArray(0,1).Add(byte)); }

DEFINE_CREATE_ENUM(OpCode_obj)

int OpCode_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"OApplyType",10)) return 50;
	if (inName==STRING(L"OArray",6)) return 52;
	if (inName==STRING(L"OAsAny",6)) return 83;
	if (inName==STRING(L"OAsObject",9)) return 86;
	if (inName==STRING(L"OAsString",9)) return 84;
	if (inName==STRING(L"OAsType",7)) return 85;
	if (inName==STRING(L"OBreakPoint",11)) return 0;
	if (inName==STRING(L"OBreakPointLine",15)) return 99;
	if (inName==STRING(L"OCallMethod",11)) return 39;
	if (inName==STRING(L"OCallPropLex",12)) return 47;
	if (inName==STRING(L"OCallPropVoid",13)) return 49;
	if (inName==STRING(L"OCallProperty",13)) return 42;
	if (inName==STRING(L"OCallStack",10)) return 37;
	if (inName==STRING(L"OCallStatic",11)) return 40;
	if (inName==STRING(L"OCallSuper",10)) return 41;
	if (inName==STRING(L"OCallSuperVoid",14)) return 48;
	if (inName==STRING(L"OCast",5)) return 82;
	if (inName==STRING(L"OCatch",6)) return 56;
	if (inName==STRING(L"OCheckIsXml",11)) return 81;
	if (inName==STRING(L"OClassDef",9)) return 54;
	if (inName==STRING(L"OConstruct",10)) return 38;
	if (inName==STRING(L"OConstructProperty",18)) return 46;
	if (inName==STRING(L"OConstructSuper",15)) return 45;
	if (inName==STRING(L"ODebugFile",10)) return 98;
	if (inName==STRING(L"ODebugLine",10)) return 97;
	if (inName==STRING(L"ODebugReg",9)) return 96;
	if (inName==STRING(L"ODecrIReg",9)) return 93;
	if (inName==STRING(L"ODecrReg",8)) return 88;
	if (inName==STRING(L"ODeleteProp",11)) return 68;
	if (inName==STRING(L"ODup",4)) return 27;
	if (inName==STRING(L"ODxNs",5)) return 5;
	if (inName==STRING(L"ODxNsLate",9)) return 6;
	if (inName==STRING(L"OFalse",6)) return 24;
	if (inName==STRING(L"OFindDefinition",15)) return 59;
	if (inName==STRING(L"OFindProp",9)) return 58;
	if (inName==STRING(L"OFindPropStrict",15)) return 57;
	if (inName==STRING(L"OFloat",6)) return 32;
	if (inName==STRING(L"OForEach",8)) return 20;
	if (inName==STRING(L"OForIn",6)) return 16;
	if (inName==STRING(L"OFunction",9)) return 36;
	if (inName==STRING(L"OGetDescendants",15)) return 55;
	if (inName==STRING(L"OGetGlobalScope",15)) return 64;
	if (inName==STRING(L"OGetGlobalSlot",14)) return 71;
	if (inName==STRING(L"OGetLex",7)) return 60;
	if (inName==STRING(L"OGetProp",8)) return 66;
	if (inName==STRING(L"OGetScope",9)) return 65;
	if (inName==STRING(L"OGetSlot",8)) return 69;
	if (inName==STRING(L"OGetSuper",9)) return 3;
	if (inName==STRING(L"OHasNext",8)) return 17;
	if (inName==STRING(L"OIncrIReg",9)) return 92;
	if (inName==STRING(L"OIncrReg",8)) return 87;
	if (inName==STRING(L"OInitProp",9)) return 67;
	if (inName==STRING(L"OInstanceOf",11)) return 90;
	if (inName==STRING(L"OInt",4)) return 22;
	if (inName==STRING(L"OIntRef",7)) return 30;
	if (inName==STRING(L"OIsType",7)) return 91;
	if (inName==STRING(L"OJump",5)) return 10;
	if (inName==STRING(L"OJump2",6)) return 11;
	if (inName==STRING(L"OJump3",6)) return 12;
	if (inName==STRING(L"OLabel",6)) return 8;
	if (inName==STRING(L"OLabel2",7)) return 9;
	if (inName==STRING(L"ONaN",4)) return 25;
	if (inName==STRING(L"ONamespace",10)) return 34;
	if (inName==STRING(L"ONewBlock",9)) return 53;
	if (inName==STRING(L"ONext",5)) return 35;
	if (inName==STRING(L"ONop",4)) return 1;
	if (inName==STRING(L"ONull",5)) return 18;
	if (inName==STRING(L"OObject",7)) return 51;
	if (inName==STRING(L"OOp",3)) return 101;
	if (inName==STRING(L"OPop",4)) return 26;
	if (inName==STRING(L"OPopScope",9)) return 15;
	if (inName==STRING(L"OPushWith",9)) return 14;
	if (inName==STRING(L"OReg",4)) return 62;
	if (inName==STRING(L"ORegKill",8)) return 7;
	if (inName==STRING(L"ORet",4)) return 44;
	if (inName==STRING(L"ORetVoid",8)) return 43;
	if (inName==STRING(L"OScope",6)) return 33;
	if (inName==STRING(L"OSetGlobalSlot",14)) return 72;
	if (inName==STRING(L"OSetProp",8)) return 61;
	if (inName==STRING(L"OSetReg",7)) return 63;
	if (inName==STRING(L"OSetSlot",8)) return 70;
	if (inName==STRING(L"OSetSuper",9)) return 4;
	if (inName==STRING(L"OSetThis",8)) return 95;
	if (inName==STRING(L"OSmallInt",9)) return 21;
	if (inName==STRING(L"OString",7)) return 29;
	if (inName==STRING(L"OSwap",5)) return 28;
	if (inName==STRING(L"OSwitch",7)) return 13;
	if (inName==STRING(L"OThis",5)) return 94;
	if (inName==STRING(L"OThrow",6)) return 2;
	if (inName==STRING(L"OTimestamp",10)) return 100;
	if (inName==STRING(L"OToBool",7)) return 79;
	if (inName==STRING(L"OToInt",6)) return 76;
	if (inName==STRING(L"OToNumber",9)) return 78;
	if (inName==STRING(L"OToObject",9)) return 80;
	if (inName==STRING(L"OToString",9)) return 73;
	if (inName==STRING(L"OToUInt",7)) return 77;
	if (inName==STRING(L"OToXml",6)) return 74;
	if (inName==STRING(L"OToXmlAttr",10)) return 75;
	if (inName==STRING(L"OTrue",5)) return 23;
	if (inName==STRING(L"OTypeof",7)) return 89;
	if (inName==STRING(L"OUIntRef",8)) return 31;
	if (inName==STRING(L"OUndefined",10)) return 19;
	if (inName==STRING(L"OUnknown",8)) return 102;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OApplyType,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OArray,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OAsType,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OBreakPointLine,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallMethod,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallPropLex,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallPropVoid,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallProperty,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OCallStack,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallStatic,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallSuper,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OCallSuperVoid,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OCast,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OCatch,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OClassDef,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OConstruct,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OConstructProperty,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OConstructSuper,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODebugFile,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODebugLine,return)

STATIC_DEFINE_DYNAMIC_FUNC3(OpCode_obj,ODebugReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODecrIReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODecrReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODeleteProp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ODxNs,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OFindDefinition,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OFindProp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OFindPropStrict,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OFloat,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OFunction,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetDescendants,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetGlobalSlot,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetLex,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetProp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetScope,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetSlot,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OGetSuper,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OIncrIReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OIncrReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OInitProp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OInt,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OIntRef,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OIsType,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OJump,return)

STATIC_DEFINE_DYNAMIC_FUNC3(OpCode_obj,OJump2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OJump3,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OLabel2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ONamespace,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,ONext,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OObject,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OOp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,ORegKill,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSetGlobalSlot,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSetProp,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSetReg,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSetSlot,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSetSuper,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OSmallInt,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OString,return)

STATIC_DEFINE_DYNAMIC_FUNC2(OpCode_obj,OSwitch,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OUIntRef,return)

STATIC_DEFINE_DYNAMIC_FUNC1(OpCode_obj,OUnknown,return)

int OpCode_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"OApplyType",10)) return 1;
	if (inName==STRING(L"OArray",6)) return 1;
	if (inName==STRING(L"OAsAny",6)) return 0;
	if (inName==STRING(L"OAsObject",9)) return 0;
	if (inName==STRING(L"OAsString",9)) return 0;
	if (inName==STRING(L"OAsType",7)) return 1;
	if (inName==STRING(L"OBreakPoint",11)) return 0;
	if (inName==STRING(L"OBreakPointLine",15)) return 1;
	if (inName==STRING(L"OCallMethod",11)) return 2;
	if (inName==STRING(L"OCallPropLex",12)) return 2;
	if (inName==STRING(L"OCallPropVoid",13)) return 2;
	if (inName==STRING(L"OCallProperty",13)) return 2;
	if (inName==STRING(L"OCallStack",10)) return 1;
	if (inName==STRING(L"OCallStatic",11)) return 2;
	if (inName==STRING(L"OCallSuper",10)) return 2;
	if (inName==STRING(L"OCallSuperVoid",14)) return 2;
	if (inName==STRING(L"OCast",5)) return 1;
	if (inName==STRING(L"OCatch",6)) return 1;
	if (inName==STRING(L"OCheckIsXml",11)) return 0;
	if (inName==STRING(L"OClassDef",9)) return 1;
	if (inName==STRING(L"OConstruct",10)) return 1;
	if (inName==STRING(L"OConstructProperty",18)) return 2;
	if (inName==STRING(L"OConstructSuper",15)) return 1;
	if (inName==STRING(L"ODebugFile",10)) return 1;
	if (inName==STRING(L"ODebugLine",10)) return 1;
	if (inName==STRING(L"ODebugReg",9)) return 3;
	if (inName==STRING(L"ODecrIReg",9)) return 1;
	if (inName==STRING(L"ODecrReg",8)) return 1;
	if (inName==STRING(L"ODeleteProp",11)) return 1;
	if (inName==STRING(L"ODup",4)) return 0;
	if (inName==STRING(L"ODxNs",5)) return 1;
	if (inName==STRING(L"ODxNsLate",9)) return 0;
	if (inName==STRING(L"OFalse",6)) return 0;
	if (inName==STRING(L"OFindDefinition",15)) return 1;
	if (inName==STRING(L"OFindProp",9)) return 1;
	if (inName==STRING(L"OFindPropStrict",15)) return 1;
	if (inName==STRING(L"OFloat",6)) return 1;
	if (inName==STRING(L"OForEach",8)) return 0;
	if (inName==STRING(L"OForIn",6)) return 0;
	if (inName==STRING(L"OFunction",9)) return 1;
	if (inName==STRING(L"OGetDescendants",15)) return 1;
	if (inName==STRING(L"OGetGlobalScope",15)) return 0;
	if (inName==STRING(L"OGetGlobalSlot",14)) return 1;
	if (inName==STRING(L"OGetLex",7)) return 1;
	if (inName==STRING(L"OGetProp",8)) return 1;
	if (inName==STRING(L"OGetScope",9)) return 1;
	if (inName==STRING(L"OGetSlot",8)) return 1;
	if (inName==STRING(L"OGetSuper",9)) return 1;
	if (inName==STRING(L"OHasNext",8)) return 0;
	if (inName==STRING(L"OIncrIReg",9)) return 1;
	if (inName==STRING(L"OIncrReg",8)) return 1;
	if (inName==STRING(L"OInitProp",9)) return 1;
	if (inName==STRING(L"OInstanceOf",11)) return 0;
	if (inName==STRING(L"OInt",4)) return 1;
	if (inName==STRING(L"OIntRef",7)) return 1;
	if (inName==STRING(L"OIsType",7)) return 1;
	if (inName==STRING(L"OJump",5)) return 2;
	if (inName==STRING(L"OJump2",6)) return 3;
	if (inName==STRING(L"OJump3",6)) return 1;
	if (inName==STRING(L"OLabel",6)) return 0;
	if (inName==STRING(L"OLabel2",7)) return 1;
	if (inName==STRING(L"ONaN",4)) return 0;
	if (inName==STRING(L"ONamespace",10)) return 1;
	if (inName==STRING(L"ONewBlock",9)) return 0;
	if (inName==STRING(L"ONext",5)) return 2;
	if (inName==STRING(L"ONop",4)) return 0;
	if (inName==STRING(L"ONull",5)) return 0;
	if (inName==STRING(L"OObject",7)) return 1;
	if (inName==STRING(L"OOp",3)) return 1;
	if (inName==STRING(L"OPop",4)) return 0;
	if (inName==STRING(L"OPopScope",9)) return 0;
	if (inName==STRING(L"OPushWith",9)) return 0;
	if (inName==STRING(L"OReg",4)) return 1;
	if (inName==STRING(L"ORegKill",8)) return 1;
	if (inName==STRING(L"ORet",4)) return 0;
	if (inName==STRING(L"ORetVoid",8)) return 0;
	if (inName==STRING(L"OScope",6)) return 0;
	if (inName==STRING(L"OSetGlobalSlot",14)) return 1;
	if (inName==STRING(L"OSetProp",8)) return 1;
	if (inName==STRING(L"OSetReg",7)) return 1;
	if (inName==STRING(L"OSetSlot",8)) return 1;
	if (inName==STRING(L"OSetSuper",9)) return 1;
	if (inName==STRING(L"OSetThis",8)) return 0;
	if (inName==STRING(L"OSmallInt",9)) return 1;
	if (inName==STRING(L"OString",7)) return 1;
	if (inName==STRING(L"OSwap",5)) return 0;
	if (inName==STRING(L"OSwitch",7)) return 2;
	if (inName==STRING(L"OThis",5)) return 0;
	if (inName==STRING(L"OThrow",6)) return 0;
	if (inName==STRING(L"OTimestamp",10)) return 0;
	if (inName==STRING(L"OToBool",7)) return 0;
	if (inName==STRING(L"OToInt",6)) return 0;
	if (inName==STRING(L"OToNumber",9)) return 0;
	if (inName==STRING(L"OToObject",9)) return 0;
	if (inName==STRING(L"OToString",9)) return 0;
	if (inName==STRING(L"OToUInt",7)) return 0;
	if (inName==STRING(L"OToXml",6)) return 0;
	if (inName==STRING(L"OToXmlAttr",10)) return 0;
	if (inName==STRING(L"OTrue",5)) return 0;
	if (inName==STRING(L"OTypeof",7)) return 0;
	if (inName==STRING(L"OUIntRef",8)) return 1;
	if (inName==STRING(L"OUndefined",10)) return 0;
	if (inName==STRING(L"OUnknown",8)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic OpCode_obj::__Field(const String &inName)
{
	if (inName==STRING(L"OApplyType",10)) return OApplyType_dyn();
	if (inName==STRING(L"OArray",6)) return OArray_dyn();
	if (inName==STRING(L"OAsAny",6)) return OAsAny;
	if (inName==STRING(L"OAsObject",9)) return OAsObject;
	if (inName==STRING(L"OAsString",9)) return OAsString;
	if (inName==STRING(L"OAsType",7)) return OAsType_dyn();
	if (inName==STRING(L"OBreakPoint",11)) return OBreakPoint;
	if (inName==STRING(L"OBreakPointLine",15)) return OBreakPointLine_dyn();
	if (inName==STRING(L"OCallMethod",11)) return OCallMethod_dyn();
	if (inName==STRING(L"OCallPropLex",12)) return OCallPropLex_dyn();
	if (inName==STRING(L"OCallPropVoid",13)) return OCallPropVoid_dyn();
	if (inName==STRING(L"OCallProperty",13)) return OCallProperty_dyn();
	if (inName==STRING(L"OCallStack",10)) return OCallStack_dyn();
	if (inName==STRING(L"OCallStatic",11)) return OCallStatic_dyn();
	if (inName==STRING(L"OCallSuper",10)) return OCallSuper_dyn();
	if (inName==STRING(L"OCallSuperVoid",14)) return OCallSuperVoid_dyn();
	if (inName==STRING(L"OCast",5)) return OCast_dyn();
	if (inName==STRING(L"OCatch",6)) return OCatch_dyn();
	if (inName==STRING(L"OCheckIsXml",11)) return OCheckIsXml;
	if (inName==STRING(L"OClassDef",9)) return OClassDef_dyn();
	if (inName==STRING(L"OConstruct",10)) return OConstruct_dyn();
	if (inName==STRING(L"OConstructProperty",18)) return OConstructProperty_dyn();
	if (inName==STRING(L"OConstructSuper",15)) return OConstructSuper_dyn();
	if (inName==STRING(L"ODebugFile",10)) return ODebugFile_dyn();
	if (inName==STRING(L"ODebugLine",10)) return ODebugLine_dyn();
	if (inName==STRING(L"ODebugReg",9)) return ODebugReg_dyn();
	if (inName==STRING(L"ODecrIReg",9)) return ODecrIReg_dyn();
	if (inName==STRING(L"ODecrReg",8)) return ODecrReg_dyn();
	if (inName==STRING(L"ODeleteProp",11)) return ODeleteProp_dyn();
	if (inName==STRING(L"ODup",4)) return ODup;
	if (inName==STRING(L"ODxNs",5)) return ODxNs_dyn();
	if (inName==STRING(L"ODxNsLate",9)) return ODxNsLate;
	if (inName==STRING(L"OFalse",6)) return OFalse;
	if (inName==STRING(L"OFindDefinition",15)) return OFindDefinition_dyn();
	if (inName==STRING(L"OFindProp",9)) return OFindProp_dyn();
	if (inName==STRING(L"OFindPropStrict",15)) return OFindPropStrict_dyn();
	if (inName==STRING(L"OFloat",6)) return OFloat_dyn();
	if (inName==STRING(L"OForEach",8)) return OForEach;
	if (inName==STRING(L"OForIn",6)) return OForIn;
	if (inName==STRING(L"OFunction",9)) return OFunction_dyn();
	if (inName==STRING(L"OGetDescendants",15)) return OGetDescendants_dyn();
	if (inName==STRING(L"OGetGlobalScope",15)) return OGetGlobalScope;
	if (inName==STRING(L"OGetGlobalSlot",14)) return OGetGlobalSlot_dyn();
	if (inName==STRING(L"OGetLex",7)) return OGetLex_dyn();
	if (inName==STRING(L"OGetProp",8)) return OGetProp_dyn();
	if (inName==STRING(L"OGetScope",9)) return OGetScope_dyn();
	if (inName==STRING(L"OGetSlot",8)) return OGetSlot_dyn();
	if (inName==STRING(L"OGetSuper",9)) return OGetSuper_dyn();
	if (inName==STRING(L"OHasNext",8)) return OHasNext;
	if (inName==STRING(L"OIncrIReg",9)) return OIncrIReg_dyn();
	if (inName==STRING(L"OIncrReg",8)) return OIncrReg_dyn();
	if (inName==STRING(L"OInitProp",9)) return OInitProp_dyn();
	if (inName==STRING(L"OInstanceOf",11)) return OInstanceOf;
	if (inName==STRING(L"OInt",4)) return OInt_dyn();
	if (inName==STRING(L"OIntRef",7)) return OIntRef_dyn();
	if (inName==STRING(L"OIsType",7)) return OIsType_dyn();
	if (inName==STRING(L"OJump",5)) return OJump_dyn();
	if (inName==STRING(L"OJump2",6)) return OJump2_dyn();
	if (inName==STRING(L"OJump3",6)) return OJump3_dyn();
	if (inName==STRING(L"OLabel",6)) return OLabel;
	if (inName==STRING(L"OLabel2",7)) return OLabel2_dyn();
	if (inName==STRING(L"ONaN",4)) return ONaN;
	if (inName==STRING(L"ONamespace",10)) return ONamespace_dyn();
	if (inName==STRING(L"ONewBlock",9)) return ONewBlock;
	if (inName==STRING(L"ONext",5)) return ONext_dyn();
	if (inName==STRING(L"ONop",4)) return ONop;
	if (inName==STRING(L"ONull",5)) return ONull;
	if (inName==STRING(L"OObject",7)) return OObject_dyn();
	if (inName==STRING(L"OOp",3)) return OOp_dyn();
	if (inName==STRING(L"OPop",4)) return OPop;
	if (inName==STRING(L"OPopScope",9)) return OPopScope;
	if (inName==STRING(L"OPushWith",9)) return OPushWith;
	if (inName==STRING(L"OReg",4)) return OReg_dyn();
	if (inName==STRING(L"ORegKill",8)) return ORegKill_dyn();
	if (inName==STRING(L"ORet",4)) return ORet;
	if (inName==STRING(L"ORetVoid",8)) return ORetVoid;
	if (inName==STRING(L"OScope",6)) return OScope;
	if (inName==STRING(L"OSetGlobalSlot",14)) return OSetGlobalSlot_dyn();
	if (inName==STRING(L"OSetProp",8)) return OSetProp_dyn();
	if (inName==STRING(L"OSetReg",7)) return OSetReg_dyn();
	if (inName==STRING(L"OSetSlot",8)) return OSetSlot_dyn();
	if (inName==STRING(L"OSetSuper",9)) return OSetSuper_dyn();
	if (inName==STRING(L"OSetThis",8)) return OSetThis;
	if (inName==STRING(L"OSmallInt",9)) return OSmallInt_dyn();
	if (inName==STRING(L"OString",7)) return OString_dyn();
	if (inName==STRING(L"OSwap",5)) return OSwap;
	if (inName==STRING(L"OSwitch",7)) return OSwitch_dyn();
	if (inName==STRING(L"OThis",5)) return OThis;
	if (inName==STRING(L"OThrow",6)) return OThrow;
	if (inName==STRING(L"OTimestamp",10)) return OTimestamp;
	if (inName==STRING(L"OToBool",7)) return OToBool;
	if (inName==STRING(L"OToInt",6)) return OToInt;
	if (inName==STRING(L"OToNumber",9)) return OToNumber;
	if (inName==STRING(L"OToObject",9)) return OToObject;
	if (inName==STRING(L"OToString",9)) return OToString;
	if (inName==STRING(L"OToUInt",7)) return OToUInt;
	if (inName==STRING(L"OToXml",6)) return OToXml;
	if (inName==STRING(L"OToXmlAttr",10)) return OToXmlAttr;
	if (inName==STRING(L"OTrue",5)) return OTrue;
	if (inName==STRING(L"OTypeof",7)) return OTypeof;
	if (inName==STRING(L"OUIntRef",8)) return OUIntRef_dyn();
	if (inName==STRING(L"OUndefined",10)) return OUndefined;
	if (inName==STRING(L"OUnknown",8)) return OUnknown_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"OApplyType",10),
	STRING(L"OArray",6),
	STRING(L"OAsAny",6),
	STRING(L"OAsObject",9),
	STRING(L"OAsString",9),
	STRING(L"OAsType",7),
	STRING(L"OBreakPoint",11),
	STRING(L"OBreakPointLine",15),
	STRING(L"OCallMethod",11),
	STRING(L"OCallPropLex",12),
	STRING(L"OCallPropVoid",13),
	STRING(L"OCallProperty",13),
	STRING(L"OCallStack",10),
	STRING(L"OCallStatic",11),
	STRING(L"OCallSuper",10),
	STRING(L"OCallSuperVoid",14),
	STRING(L"OCast",5),
	STRING(L"OCatch",6),
	STRING(L"OCheckIsXml",11),
	STRING(L"OClassDef",9),
	STRING(L"OConstruct",10),
	STRING(L"OConstructProperty",18),
	STRING(L"OConstructSuper",15),
	STRING(L"ODebugFile",10),
	STRING(L"ODebugLine",10),
	STRING(L"ODebugReg",9),
	STRING(L"ODecrIReg",9),
	STRING(L"ODecrReg",8),
	STRING(L"ODeleteProp",11),
	STRING(L"ODup",4),
	STRING(L"ODxNs",5),
	STRING(L"ODxNsLate",9),
	STRING(L"OFalse",6),
	STRING(L"OFindDefinition",15),
	STRING(L"OFindProp",9),
	STRING(L"OFindPropStrict",15),
	STRING(L"OFloat",6),
	STRING(L"OForEach",8),
	STRING(L"OForIn",6),
	STRING(L"OFunction",9),
	STRING(L"OGetDescendants",15),
	STRING(L"OGetGlobalScope",15),
	STRING(L"OGetGlobalSlot",14),
	STRING(L"OGetLex",7),
	STRING(L"OGetProp",8),
	STRING(L"OGetScope",9),
	STRING(L"OGetSlot",8),
	STRING(L"OGetSuper",9),
	STRING(L"OHasNext",8),
	STRING(L"OIncrIReg",9),
	STRING(L"OIncrReg",8),
	STRING(L"OInitProp",9),
	STRING(L"OInstanceOf",11),
	STRING(L"OInt",4),
	STRING(L"OIntRef",7),
	STRING(L"OIsType",7),
	STRING(L"OJump",5),
	STRING(L"OJump2",6),
	STRING(L"OJump3",6),
	STRING(L"OLabel",6),
	STRING(L"OLabel2",7),
	STRING(L"ONaN",4),
	STRING(L"ONamespace",10),
	STRING(L"ONewBlock",9),
	STRING(L"ONext",5),
	STRING(L"ONop",4),
	STRING(L"ONull",5),
	STRING(L"OObject",7),
	STRING(L"OOp",3),
	STRING(L"OPop",4),
	STRING(L"OPopScope",9),
	STRING(L"OPushWith",9),
	STRING(L"OReg",4),
	STRING(L"ORegKill",8),
	STRING(L"ORet",4),
	STRING(L"ORetVoid",8),
	STRING(L"OScope",6),
	STRING(L"OSetGlobalSlot",14),
	STRING(L"OSetProp",8),
	STRING(L"OSetReg",7),
	STRING(L"OSetSlot",8),
	STRING(L"OSetSuper",9),
	STRING(L"OSetThis",8),
	STRING(L"OSmallInt",9),
	STRING(L"OString",7),
	STRING(L"OSwap",5),
	STRING(L"OSwitch",7),
	STRING(L"OThis",5),
	STRING(L"OThrow",6),
	STRING(L"OTimestamp",10),
	STRING(L"OToBool",7),
	STRING(L"OToInt",6),
	STRING(L"OToNumber",9),
	STRING(L"OToObject",9),
	STRING(L"OToString",9),
	STRING(L"OToUInt",7),
	STRING(L"OToXml",6),
	STRING(L"OToXmlAttr",10),
	STRING(L"OTrue",5),
	STRING(L"OTypeof",7),
	STRING(L"OUIntRef",8),
	STRING(L"OUndefined",10),
	STRING(L"OUnknown",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(OpCode_obj::OAsAny);
	MarkMember(OpCode_obj::OAsObject);
	MarkMember(OpCode_obj::OAsString);
	MarkMember(OpCode_obj::OBreakPoint);
	MarkMember(OpCode_obj::OCheckIsXml);
	MarkMember(OpCode_obj::ODup);
	MarkMember(OpCode_obj::ODxNsLate);
	MarkMember(OpCode_obj::OFalse);
	MarkMember(OpCode_obj::OForEach);
	MarkMember(OpCode_obj::OForIn);
	MarkMember(OpCode_obj::OGetGlobalScope);
	MarkMember(OpCode_obj::OHasNext);
	MarkMember(OpCode_obj::OInstanceOf);
	MarkMember(OpCode_obj::OLabel);
	MarkMember(OpCode_obj::ONaN);
	MarkMember(OpCode_obj::ONewBlock);
	MarkMember(OpCode_obj::ONop);
	MarkMember(OpCode_obj::ONull);
	MarkMember(OpCode_obj::OPop);
	MarkMember(OpCode_obj::OPopScope);
	MarkMember(OpCode_obj::OPushWith);
	MarkMember(OpCode_obj::ORet);
	MarkMember(OpCode_obj::ORetVoid);
	MarkMember(OpCode_obj::OScope);
	MarkMember(OpCode_obj::OSetThis);
	MarkMember(OpCode_obj::OSwap);
	MarkMember(OpCode_obj::OThis);
	MarkMember(OpCode_obj::OThrow);
	MarkMember(OpCode_obj::OTimestamp);
	MarkMember(OpCode_obj::OToBool);
	MarkMember(OpCode_obj::OToInt);
	MarkMember(OpCode_obj::OToNumber);
	MarkMember(OpCode_obj::OToObject);
	MarkMember(OpCode_obj::OToString);
	MarkMember(OpCode_obj::OToUInt);
	MarkMember(OpCode_obj::OToXml);
	MarkMember(OpCode_obj::OToXmlAttr);
	MarkMember(OpCode_obj::OTrue);
	MarkMember(OpCode_obj::OTypeof);
	MarkMember(OpCode_obj::OUndefined);
};

static String sMemberFields[] = { String(null()) };
Class OpCode_obj::__mClass;

Dynamic __Create_OpCode_obj() { return new OpCode_obj; }

void OpCode_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.abc.OpCode",17), TCanCast<OpCode_obj >,sStaticFields,sMemberFields,
	&__Create_OpCode_obj, &__Create,
	&super::__SGetClass(), &CreateOpCode_obj, sMarkStatics);
}

void OpCode_obj::__boot()
{
Static(OAsAny) = CreateEnum<OpCode_obj >(STRING(L"OAsAny",6),83);
Static(OAsObject) = CreateEnum<OpCode_obj >(STRING(L"OAsObject",9),86);
Static(OAsString) = CreateEnum<OpCode_obj >(STRING(L"OAsString",9),84);
Static(OBreakPoint) = CreateEnum<OpCode_obj >(STRING(L"OBreakPoint",11),0);
Static(OCheckIsXml) = CreateEnum<OpCode_obj >(STRING(L"OCheckIsXml",11),81);
Static(ODup) = CreateEnum<OpCode_obj >(STRING(L"ODup",4),27);
Static(ODxNsLate) = CreateEnum<OpCode_obj >(STRING(L"ODxNsLate",9),6);
Static(OFalse) = CreateEnum<OpCode_obj >(STRING(L"OFalse",6),24);
Static(OForEach) = CreateEnum<OpCode_obj >(STRING(L"OForEach",8),20);
Static(OForIn) = CreateEnum<OpCode_obj >(STRING(L"OForIn",6),16);
Static(OGetGlobalScope) = CreateEnum<OpCode_obj >(STRING(L"OGetGlobalScope",15),64);
Static(OHasNext) = CreateEnum<OpCode_obj >(STRING(L"OHasNext",8),17);
Static(OInstanceOf) = CreateEnum<OpCode_obj >(STRING(L"OInstanceOf",11),90);
Static(OLabel) = CreateEnum<OpCode_obj >(STRING(L"OLabel",6),8);
Static(ONaN) = CreateEnum<OpCode_obj >(STRING(L"ONaN",4),25);
Static(ONewBlock) = CreateEnum<OpCode_obj >(STRING(L"ONewBlock",9),53);
Static(ONop) = CreateEnum<OpCode_obj >(STRING(L"ONop",4),1);
Static(ONull) = CreateEnum<OpCode_obj >(STRING(L"ONull",5),18);
Static(OPop) = CreateEnum<OpCode_obj >(STRING(L"OPop",4),26);
Static(OPopScope) = CreateEnum<OpCode_obj >(STRING(L"OPopScope",9),15);
Static(OPushWith) = CreateEnum<OpCode_obj >(STRING(L"OPushWith",9),14);
Static(ORet) = CreateEnum<OpCode_obj >(STRING(L"ORet",4),44);
Static(ORetVoid) = CreateEnum<OpCode_obj >(STRING(L"ORetVoid",8),43);
Static(OScope) = CreateEnum<OpCode_obj >(STRING(L"OScope",6),33);
Static(OSetThis) = CreateEnum<OpCode_obj >(STRING(L"OSetThis",8),95);
Static(OSwap) = CreateEnum<OpCode_obj >(STRING(L"OSwap",5),28);
Static(OThis) = CreateEnum<OpCode_obj >(STRING(L"OThis",5),94);
Static(OThrow) = CreateEnum<OpCode_obj >(STRING(L"OThrow",6),2);
Static(OTimestamp) = CreateEnum<OpCode_obj >(STRING(L"OTimestamp",10),100);
Static(OToBool) = CreateEnum<OpCode_obj >(STRING(L"OToBool",7),79);
Static(OToInt) = CreateEnum<OpCode_obj >(STRING(L"OToInt",6),76);
Static(OToNumber) = CreateEnum<OpCode_obj >(STRING(L"OToNumber",9),78);
Static(OToObject) = CreateEnum<OpCode_obj >(STRING(L"OToObject",9),80);
Static(OToString) = CreateEnum<OpCode_obj >(STRING(L"OToString",9),73);
Static(OToUInt) = CreateEnum<OpCode_obj >(STRING(L"OToUInt",7),77);
Static(OToXml) = CreateEnum<OpCode_obj >(STRING(L"OToXml",6),74);
Static(OToXmlAttr) = CreateEnum<OpCode_obj >(STRING(L"OToXmlAttr",10),75);
Static(OTrue) = CreateEnum<OpCode_obj >(STRING(L"OTrue",5),23);
Static(OTypeof) = CreateEnum<OpCode_obj >(STRING(L"OTypeof",7),89);
Static(OUndefined) = CreateEnum<OpCode_obj >(STRING(L"OUndefined",10),19);
}


} // end namespace format
} // end namespace abc
