#ifndef INCLUDED_format_abc_Namespace
#define INCLUDED_format_abc_Namespace

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Namespace)
namespace format{
namespace abc{


class Namespace_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Namespace_obj OBJ_;

	public:
		Namespace_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.Namespace",20); }
		String __ToString() const { return STRING(L"Namespace.",10) + tag; }

		static Namespace NExplicit(format::abc::Index ns);
		static Dynamic NExplicit_dyn();
		static Namespace NInternal(format::abc::Index ns);
		static Dynamic NInternal_dyn();
		static Namespace NNamespace(format::abc::Index ns);
		static Dynamic NNamespace_dyn();
		static Namespace NPrivate(format::abc::Index ns);
		static Dynamic NPrivate_dyn();
		static Namespace NProtected(format::abc::Index ns);
		static Dynamic NProtected_dyn();
		static Namespace NPublic(format::abc::Index ns);
		static Dynamic NPublic_dyn();
		static Namespace NStaticProtected(format::abc::Index ns);
		static Dynamic NStaticProtected_dyn();
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Namespace */ 
