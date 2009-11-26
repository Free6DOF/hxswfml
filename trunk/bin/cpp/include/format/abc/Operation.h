#ifndef INCLUDED_format_abc_Operation
#define INCLUDED_format_abc_Operation

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Operation)
namespace format{
namespace abc{


class Operation_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Operation_obj OBJ_;

	public:
		Operation_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.Operation",20); }
		String __ToString() const { return STRING(L"Operation.",10) + tag; }

		static Operation OpAdd;
		static Operation OpAnd;
		static Operation OpAs;
		static Operation OpBitNot;
		static Operation OpDecr;
		static Operation OpDiv;
		static Operation OpEq;
		static Operation OpGt;
		static Operation OpGte;
		static Operation OpIAdd;
		static Operation OpIDecr;
		static Operation OpIIncr;
		static Operation OpIMul;
		static Operation OpINeg;
		static Operation OpISub;
		static Operation OpIn;
		static Operation OpIncr;
		static Operation OpIs;
		static Operation OpLt;
		static Operation OpLte;
		static Operation OpMemGet16;
		static Operation OpMemGet32;
		static Operation OpMemGet8;
		static Operation OpMemGetDouble;
		static Operation OpMemGetFloat;
		static Operation OpMemSet16;
		static Operation OpMemSet32;
		static Operation OpMemSet8;
		static Operation OpMemSetDouble;
		static Operation OpMemSetFloat;
		static Operation OpMod;
		static Operation OpMul;
		static Operation OpNeg;
		static Operation OpNot;
		static Operation OpOr;
		static Operation OpPhysEq;
		static Operation OpShl;
		static Operation OpShr;
		static Operation OpSign1;
		static Operation OpSign16;
		static Operation OpSign8;
		static Operation OpSub;
		static Operation OpUShr;
		static Operation OpXor;
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Operation */ 
