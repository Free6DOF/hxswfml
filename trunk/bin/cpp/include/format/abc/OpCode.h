#ifndef INCLUDED_format_abc_OpCode
#define INCLUDED_format_abc_OpCode

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,JumpStyle)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,abc,Operation)
namespace format{
namespace abc{


class OpCode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef OpCode_obj OBJ_;

	public:
		OpCode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.OpCode",17); }
		String __ToString() const { return STRING(L"OpCode.",7) + tag; }

		static OpCode OApplyType(int nargs);
		static Dynamic OApplyType_dyn();
		static OpCode OArray(int nvalues);
		static Dynamic OArray_dyn();
		static OpCode OAsAny;
		static OpCode OAsObject;
		static OpCode OAsString;
		static OpCode OAsType(format::abc::Index t);
		static Dynamic OAsType_dyn();
		static OpCode OBreakPoint;
		static OpCode OBreakPointLine(int n);
		static Dynamic OBreakPointLine_dyn();
		static OpCode OCallMethod(int slot,int nargs);
		static Dynamic OCallMethod_dyn();
		static OpCode OCallPropLex(format::abc::Index name,int nargs);
		static Dynamic OCallPropLex_dyn();
		static OpCode OCallPropVoid(format::abc::Index name,int nargs);
		static Dynamic OCallPropVoid_dyn();
		static OpCode OCallProperty(format::abc::Index name,int nargs);
		static Dynamic OCallProperty_dyn();
		static OpCode OCallStack(int nargs);
		static Dynamic OCallStack_dyn();
		static OpCode OCallStatic(format::abc::Index meth,int nargs);
		static Dynamic OCallStatic_dyn();
		static OpCode OCallSuper(format::abc::Index name,int nargs);
		static Dynamic OCallSuper_dyn();
		static OpCode OCallSuperVoid(format::abc::Index name,int nargs);
		static Dynamic OCallSuperVoid_dyn();
		static OpCode OCast(format::abc::Index t);
		static Dynamic OCast_dyn();
		static OpCode OCatch(int c);
		static Dynamic OCatch_dyn();
		static OpCode OCheckIsXml;
		static OpCode OClassDef(format::abc::Index c);
		static Dynamic OClassDef_dyn();
		static OpCode OConstruct(int nargs);
		static Dynamic OConstruct_dyn();
		static OpCode OConstructProperty(format::abc::Index name,int nargs);
		static Dynamic OConstructProperty_dyn();
		static OpCode OConstructSuper(int nargs);
		static Dynamic OConstructSuper_dyn();
		static OpCode ODebugFile(format::abc::Index file);
		static Dynamic ODebugFile_dyn();
		static OpCode ODebugLine(int line);
		static Dynamic ODebugLine_dyn();
		static OpCode ODebugReg(format::abc::Index name,int r,int line);
		static Dynamic ODebugReg_dyn();
		static OpCode ODecrIReg(int r);
		static Dynamic ODecrIReg_dyn();
		static OpCode ODecrReg(int r);
		static Dynamic ODecrReg_dyn();
		static OpCode ODeleteProp(format::abc::Index p);
		static Dynamic ODeleteProp_dyn();
		static OpCode ODup;
		static OpCode ODxNs(format::abc::Index v);
		static Dynamic ODxNs_dyn();
		static OpCode ODxNsLate;
		static OpCode OFalse;
		static OpCode OFindDefinition(format::abc::Index d);
		static Dynamic OFindDefinition_dyn();
		static OpCode OFindProp(format::abc::Index p);
		static Dynamic OFindProp_dyn();
		static OpCode OFindPropStrict(format::abc::Index p);
		static Dynamic OFindPropStrict_dyn();
		static OpCode OFloat(format::abc::Index v);
		static Dynamic OFloat_dyn();
		static OpCode OForEach;
		static OpCode OForIn;
		static OpCode OFunction(format::abc::Index f);
		static Dynamic OFunction_dyn();
		static OpCode OGetDescendants(format::abc::Index c);
		static Dynamic OGetDescendants_dyn();
		static OpCode OGetGlobalScope;
		static OpCode OGetLex(format::abc::Index p);
		static Dynamic OGetLex_dyn();
		static OpCode OGetProp(format::abc::Index p);
		static Dynamic OGetProp_dyn();
		static OpCode OGetScope(int n);
		static Dynamic OGetScope_dyn();
		static OpCode OGetSlot(int s);
		static Dynamic OGetSlot_dyn();
		static OpCode OGetSuper(format::abc::Index v);
		static Dynamic OGetSuper_dyn();
		static OpCode OHasNext;
		static OpCode OIncrIReg(int r);
		static Dynamic OIncrIReg_dyn();
		static OpCode OIncrReg(int r);
		static Dynamic OIncrReg_dyn();
		static OpCode OInitProp(format::abc::Index p);
		static Dynamic OInitProp_dyn();
		static OpCode OInstanceOf;
		static OpCode OInt(int v);
		static Dynamic OInt_dyn();
		static OpCode OIntRef(format::abc::Index v);
		static Dynamic OIntRef_dyn();
		static OpCode OIsType(format::abc::Index t);
		static Dynamic OIsType_dyn();
		static OpCode OJump(format::abc::JumpStyle j,int delta);
		static Dynamic OJump_dyn();
		static OpCode OLabel;
		static OpCode ONaN;
		static OpCode ONamespace(format::abc::Index v);
		static Dynamic ONamespace_dyn();
		static OpCode ONewBlock;
		static OpCode ONext(int r1,int r2);
		static Dynamic ONext_dyn();
		static OpCode ONop;
		static OpCode ONull;
		static OpCode OObject(int nfields);
		static Dynamic OObject_dyn();
		static OpCode OOp(format::abc::Operation op);
		static Dynamic OOp_dyn();
		static OpCode OPop;
		static OpCode OPopScope;
		static OpCode OPushWith;
		static OpCode OReg(int r);
		static Dynamic OReg_dyn();
		static OpCode ORegKill(int r);
		static Dynamic ORegKill_dyn();
		static OpCode ORet;
		static OpCode ORetVoid;
		static OpCode OScope;
		static OpCode OSetProp(format::abc::Index p);
		static Dynamic OSetProp_dyn();
		static OpCode OSetReg(int r);
		static Dynamic OSetReg_dyn();
		static OpCode OSetSlot(int s);
		static Dynamic OSetSlot_dyn();
		static OpCode OSetSuper(format::abc::Index v);
		static Dynamic OSetSuper_dyn();
		static OpCode OSetThis;
		static OpCode OSmallInt(int v);
		static Dynamic OSmallInt_dyn();
		static OpCode OString(format::abc::Index v);
		static Dynamic OString_dyn();
		static OpCode OSwap;
		static OpCode OSwitch(int def,Array<int > deltas);
		static Dynamic OSwitch_dyn();
		static OpCode OThis;
		static OpCode OThrow;
		static OpCode OTimestamp;
		static OpCode OToBool;
		static OpCode OToInt;
		static OpCode OToNumber;
		static OpCode OToObject;
		static OpCode OToString;
		static OpCode OToUInt;
		static OpCode OToXml;
		static OpCode OToXmlAttr;
		static OpCode OTrue;
		static OpCode OTypeof;
		static OpCode OUIntRef(format::abc::Index v);
		static Dynamic OUIntRef_dyn();
		static OpCode OUndefined;
		static OpCode OUnknown(int byte);
		static Dynamic OUnknown_dyn();
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_OpCode */ 
