#ifndef INCLUDED_format_swf_Bitrate
#define INCLUDED_format_swf_Bitrate

#include <hxObject.h>

DECLARE_CLASS2(format,swf,Bitrate)
namespace format{
namespace swf{


class Bitrate_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Bitrate_obj OBJ_;

	public:
		Bitrate_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.Bitrate",18); }
		String __ToString() const { return STRING(L"Bitrate.",8) + tag; }

		static Bitrate BR_112;
		static Bitrate BR_128;
		static Bitrate BR_144;
		static Bitrate BR_16;
		static Bitrate BR_160;
		static Bitrate BR_176;
		static Bitrate BR_192;
		static Bitrate BR_224;
		static Bitrate BR_24;
		static Bitrate BR_256;
		static Bitrate BR_288;
		static Bitrate BR_32;
		static Bitrate BR_320;
		static Bitrate BR_352;
		static Bitrate BR_384;
		static Bitrate BR_40;
		static Bitrate BR_416;
		static Bitrate BR_448;
		static Bitrate BR_48;
		static Bitrate BR_56;
		static Bitrate BR_64;
		static Bitrate BR_8;
		static Bitrate BR_80;
		static Bitrate BR_96;
		static Bitrate BR_Bad;
		static Bitrate BR_Free;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Bitrate */ 
