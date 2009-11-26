#ifndef INCLUDED_format_swf_LS2Fill
#define INCLUDED_format_swf_LS2Fill

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FillStyle)
DECLARE_CLASS2(format,swf,LS2Fill)
namespace format{
namespace swf{


class LS2Fill_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef LS2Fill_obj OBJ_;

	public:
		LS2Fill_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.LS2Fill",18); }
		String __ToString() const { return STRING(L"LS2Fill.",8) + tag; }

		static LS2Fill LS2FColor(Dynamic color);
		static Dynamic LS2FColor_dyn();
		static LS2Fill LS2FStyle(format::swf::FillStyle style);
		static Dynamic LS2FStyle_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_LS2Fill */ 
