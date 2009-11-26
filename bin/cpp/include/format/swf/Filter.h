#ifndef INCLUDED_format_swf_Filter
#define INCLUDED_format_swf_Filter

#include <hxObject.h>

DECLARE_CLASS2(format,swf,Filter)
namespace format{
namespace swf{


class Filter_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Filter_obj OBJ_;

	public:
		Filter_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.Filter",17); }
		String __ToString() const { return STRING(L"Filter.",7) + tag; }

		static Filter FBevel(Dynamic data);
		static Dynamic FBevel_dyn();
		static Filter FBlur(Dynamic data);
		static Dynamic FBlur_dyn();
		static Filter FColorMatrix(Array<double > data);
		static Dynamic FColorMatrix_dyn();
		static Filter FDropShadow(Dynamic data);
		static Dynamic FDropShadow_dyn();
		static Filter FGlow(Dynamic data);
		static Dynamic FGlow_dyn();
		static Filter FGradientBevel(Dynamic data);
		static Dynamic FGradientBevel_dyn();
		static Filter FGradientGlow(Dynamic data);
		static Dynamic FGradientGlow_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Filter */ 
