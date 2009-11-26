#ifndef INCLUDED_format_swf_BlendMode
#define INCLUDED_format_swf_BlendMode

#include <hxObject.h>

DECLARE_CLASS2(format,swf,BlendMode)
namespace format{
namespace swf{


class BlendMode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef BlendMode_obj OBJ_;

	public:
		BlendMode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.BlendMode",20); }
		String __ToString() const { return STRING(L"BlendMode.",10) + tag; }

		static BlendMode BAdd;
		static BlendMode BAlpha;
		static BlendMode BDarken;
		static BlendMode BDifference;
		static BlendMode BErase;
		static BlendMode BHardLight;
		static BlendMode BInvert;
		static BlendMode BLayer;
		static BlendMode BLighten;
		static BlendMode BMultiply;
		static BlendMode BNormal;
		static BlendMode BOverlay;
		static BlendMode BScreen;
		static BlendMode BSubtract;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_BlendMode */ 
