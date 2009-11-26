#ifndef INCLUDED_format_swf_SoundRate
#define INCLUDED_format_swf_SoundRate

#include <hxObject.h>

DECLARE_CLASS2(format,swf,SoundRate)
namespace format{
namespace swf{


class SoundRate_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SoundRate_obj OBJ_;

	public:
		SoundRate_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.SoundRate",20); }
		String __ToString() const { return STRING(L"SoundRate.",10) + tag; }

		static SoundRate SR11k;
		static SoundRate SR22k;
		static SoundRate SR44k;
		static SoundRate SR5k;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_SoundRate */ 
