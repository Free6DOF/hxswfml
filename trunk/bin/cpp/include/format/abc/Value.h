#ifndef INCLUDED_format_abc_Value
#define INCLUDED_format_abc_Value

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Value)
namespace format{
namespace abc{


class Value_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Value_obj OBJ_;

	public:
		Value_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.Value",16); }
		String __ToString() const { return STRING(L"Value.",6) + tag; }

		static Value VBool(bool b);
		static Dynamic VBool_dyn();
		static Value VFloat(format::abc::Index f);
		static Dynamic VFloat_dyn();
		static Value VInt(format::abc::Index i);
		static Dynamic VInt_dyn();
		static Value VNamespace(int kind,format::abc::Index ns);
		static Dynamic VNamespace_dyn();
		static Value VNull;
		static Value VString(format::abc::Index i);
		static Dynamic VString_dyn();
		static Value VUInt(format::abc::Index i);
		static Dynamic VUInt_dyn();
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Value */ 
