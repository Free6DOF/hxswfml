#ifndef INCLUDED_format_abc_MethodKind
#define INCLUDED_format_abc_MethodKind

#include <hxObject.h>

DECLARE_CLASS2(format,abc,MethodKind)
namespace format{
namespace abc{


class MethodKind_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef MethodKind_obj OBJ_;

	public:
		MethodKind_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.MethodKind",21); }
		String __ToString() const { return STRING(L"MethodKind.",11) + tag; }

		static MethodKind KGetter;
		static MethodKind KNormal;
		static MethodKind KSetter;
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_MethodKind */ 
