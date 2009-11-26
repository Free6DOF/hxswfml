#ifndef INCLUDED_format_abc_FieldKind
#define INCLUDED_format_abc_FieldKind

#include <hxObject.h>

DECLARE_CLASS2(format,abc,FieldKind)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,MethodKind)
DECLARE_CLASS2(format,abc,Value)
namespace format{
namespace abc{


class FieldKind_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FieldKind_obj OBJ_;

	public:
		FieldKind_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.FieldKind",20); }
		String __ToString() const { return STRING(L"FieldKind.",10) + tag; }

		static FieldKind FClass(format::abc::Index c);
		static Dynamic FClass_dyn();
		static FieldKind FFunction(format::abc::Index f);
		static Dynamic FFunction_dyn();
		static FieldKind FMethod(format::abc::Index type,format::abc::MethodKind k,Dynamic isOverride,Dynamic isFinal);
		static Dynamic FMethod_dyn();
		static FieldKind FVar(format::abc::Index type,format::abc::Value value,Dynamic _const);
		static Dynamic FVar_dyn();
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_FieldKind */ 
