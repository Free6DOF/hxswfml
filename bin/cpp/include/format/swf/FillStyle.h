#ifndef INCLUDED_format_swf_FillStyle
#define INCLUDED_format_swf_FillStyle

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FillStyle)
namespace format{
namespace swf{


class FillStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FillStyle_obj OBJ_;

	public:
		FillStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.FillStyle",20); }
		String __ToString() const { return STRING(L"FillStyle.",10) + tag; }

		static FillStyle FSBitmap(int cid,Dynamic mat,bool repeat,bool smooth);
		static Dynamic FSBitmap_dyn();
		static FillStyle FSFocalGradient(Dynamic mat,Dynamic grad);
		static Dynamic FSFocalGradient_dyn();
		static FillStyle FSLinearGradient(Dynamic mat,Dynamic grad);
		static Dynamic FSLinearGradient_dyn();
		static FillStyle FSRadialGradient(Dynamic mat,Dynamic grad);
		static Dynamic FSRadialGradient_dyn();
		static FillStyle FSSolid(Dynamic rgb);
		static Dynamic FSSolid_dyn();
		static FillStyle FSSolidAlpha(Dynamic rgb);
		static Dynamic FSSolidAlpha_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_FillStyle */ 
