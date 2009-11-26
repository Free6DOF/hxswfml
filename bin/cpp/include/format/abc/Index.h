#ifndef INCLUDED_format_abc_Index
#define INCLUDED_format_abc_Index

#include <hxObject.h>

DECLARE_CLASS2(format,abc,Index)
namespace format{
namespace abc{


class Index_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Index_obj OBJ_;

	public:
		Index_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.abc.Index",16); }
		String __ToString() const { return STRING(L"Index.",6) + tag; }

		static Index Idx(int v);
		static Dynamic Idx_dyn();
};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Index */ 
