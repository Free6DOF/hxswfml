#ifndef INCLUDED_format_swf_Morph2LineStyle
#define INCLUDED_format_swf_Morph2LineStyle

#include <hxObject.h>

DECLARE_CLASS2(format,swf,Morph2LineStyle)
DECLARE_CLASS2(format,swf,MorphFillStyle)
namespace format{
namespace swf{


class Morph2LineStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Morph2LineStyle_obj OBJ_;

	public:
		Morph2LineStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.Morph2LineStyle",26); }
		String __ToString() const { return STRING(L"Morph2LineStyle.",16) + tag; }

		static Morph2LineStyle M2LSFill(format::swf::MorphFillStyle fill,Dynamic data);
		static Dynamic M2LSFill_dyn();
		static Morph2LineStyle M2LSNoFill(Dynamic startColor,Dynamic endColor,Dynamic data);
		static Dynamic M2LSNoFill_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Morph2LineStyle */ 
