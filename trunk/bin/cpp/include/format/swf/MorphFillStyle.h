#ifndef INCLUDED_format_swf_MorphFillStyle
#define INCLUDED_format_swf_MorphFillStyle

#include <hxObject.h>

DECLARE_CLASS2(format,swf,MorphFillStyle)
namespace format{
namespace swf{


class MorphFillStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef MorphFillStyle_obj OBJ_;

	public:
		MorphFillStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.MorphFillStyle",25); }
		String __ToString() const { return STRING(L"MorphFillStyle.",15) + tag; }

		static MorphFillStyle MFSBitmap(int cid,Dynamic startMatrix,Dynamic endMatrix,bool repeat,bool smooth);
		static Dynamic MFSBitmap_dyn();
		static MorphFillStyle MFSLinearGradient(Dynamic startMatrix,Dynamic endMatrix,Array<Dynamic > gradients);
		static Dynamic MFSLinearGradient_dyn();
		static MorphFillStyle MFSRadialGradient(Dynamic startMatrix,Dynamic endMatrix,Array<Dynamic > gradients);
		static Dynamic MFSRadialGradient_dyn();
		static MorphFillStyle MFSSolid(Dynamic startColor,Dynamic endColor);
		static Dynamic MFSSolid_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_MorphFillStyle */ 
