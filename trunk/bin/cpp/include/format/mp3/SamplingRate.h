#ifndef INCLUDED_format_mp3_SamplingRate
#define INCLUDED_format_mp3_SamplingRate

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,SamplingRate)
namespace format{
namespace mp3{


class SamplingRate_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SamplingRate_obj OBJ_;

	public:
		SamplingRate_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.mp3.SamplingRate",23); }
		String __ToString() const { return STRING(L"SamplingRate.",13) + tag; }

		static SamplingRate SR_11025;
		static SamplingRate SR_12000;
		static SamplingRate SR_22050;
		static SamplingRate SR_24000;
		static SamplingRate SR_32000;
		static SamplingRate SR_44100;
		static SamplingRate SR_48000;
		static SamplingRate SR_8000;
		static SamplingRate SR_Bad;
};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_SamplingRate */ 