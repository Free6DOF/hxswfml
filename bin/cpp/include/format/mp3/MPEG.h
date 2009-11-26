#ifndef INCLUDED_format_mp3_MPEG
#define INCLUDED_format_mp3_MPEG

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,Bitrate)
DECLARE_CLASS2(format,mp3,Layer)
DECLARE_CLASS2(format,mp3,MPEG)
DECLARE_CLASS2(format,mp3,MPEGVersion)
DECLARE_CLASS2(format,mp3,SamplingRate)
namespace format{
namespace mp3{


class MPEG_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef MPEG_obj OBJ_;

	protected:
		MPEG_obj();
		Void __construct();

	public:
		static hxObjectPtr<MPEG_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~MPEG_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"MPEG",4); }

		static int V1;
		static int V2;
		static int V25;
		static int Reserved;
		static int enum2Num( format::mp3::MPEGVersion m);
		static Dynamic enum2Num_dyn();

		static format::mp3::MPEGVersion num2Enum( int m);
		static Dynamic num2Enum_dyn();

		static Array<Array<format::mp3::Bitrate > > V1_Bitrates;
		static Array<Array<format::mp3::Bitrate > > V2_Bitrates;
		static Array<Array<format::mp3::SamplingRate > > SamplingRates;
		static format::mp3::SamplingRate srNum2Enum( int sr);
		static Dynamic srNum2Enum_dyn();

		static int srEnum2Num( format::mp3::SamplingRate sr);
		static Dynamic srEnum2Num_dyn();

		static int getBitrateIdx( format::mp3::Bitrate br,format::mp3::MPEGVersion mpeg,format::mp3::Layer layer);
		static Dynamic getBitrateIdx_dyn();

		static int getSamplingRateIdx( format::mp3::SamplingRate sr,format::mp3::MPEGVersion mpeg);
		static Dynamic getSamplingRateIdx_dyn();

		static int bitrateEnum2Num( format::mp3::Bitrate br);
		static Dynamic bitrateEnum2Num_dyn();

		static format::mp3::Bitrate bitrateNum2Enum( int br);
		static Dynamic bitrateNum2Enum_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_MPEG */ 
