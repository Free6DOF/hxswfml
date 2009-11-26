#ifndef INCLUDED_format_abc_Name
#define INCLUDED_format_abc_Name

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Name)
namespace format{
namespace abc{


class Name_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Name_obj OBJ_;

	public:
		Name_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.Name",15); }
		String __ToString() const { return STRING(L"Name.",5) + tag; }

		static Name NAttrib(format::abc::Name n);
		static Dynamic NAttrib_dyn();
		static Name NMulti(format::abc::Index name,format::abc::Index ns);
		static Dynamic NMulti_dyn();
		static Name NMultiLate(format::abc::Index nset);
		static Dynamic NMultiLate_dyn();
		static Name NName(format::abc::Index name,format::abc::Index ns);
		static Dynamic NName_dyn();
		static Name NParams(format::abc::Index n,Array<format::abc::Index > params);
		static Dynamic NParams_dyn();
		static Name NRuntime(format::abc::Index name);
		static Dynamic NRuntime_dyn();
		static Name NRuntimeLate;
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Name */ 
