#ifndef INCLUDED_format_swf_InterpolationMode
#define INCLUDED_format_swf_InterpolationMode

#include <hxObject.h>

DECLARE_CLASS2(format,swf,InterpolationMode)
namespace format{
namespace swf{


class InterpolationMode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef InterpolationMode_obj OBJ_;

	public:
		InterpolationMode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.InterpolationMode",28); }
		String __ToString() const { return STRING(L"InterpolationMode.",18) + tag; }

		static InterpolationMode IMLinearRGB;
		static InterpolationMode IMNormalRGB;
		static InterpolationMode IMReserved1;
		static InterpolationMode IMReserved2;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_InterpolationMode */ 
