#ifndef INCLUDED_format_mp3_Tools
#define INCLUDED_format_mp3_Tools

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,Bitrate)
DECLARE_CLASS2(format,mp3,SamplingRate)
DECLARE_CLASS2(format,mp3,Tools)
namespace format{
namespace mp3{


class Tools_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Tools_obj OBJ_;

	protected:
		Tools_obj();
		Void __construct();

	public:
		static hxObjectPtr<Tools_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Tools_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Tools",5); }

		static format::mp3::Bitrate getBitrate( int mpegVersion,int layerIdx,int bitrateIdx);
		static Dynamic getBitrate_dyn();

		static format::mp3::SamplingRate getSamplingRate( int mpegVersion,int samplingRateIdx);
		static Dynamic getSamplingRate_dyn();

		static bool isInvalidFrameHeader( Dynamic hdr);
		static Dynamic isInvalidFrameHeader_dyn();

		static int getSampleDataSize( int mpegVersion,int bitrate,int samplingRate,bool isPadded,bool hasCrc);
		static Dynamic getSampleDataSize_dyn();

		static int getSampleDataSizeHdr( Dynamic hdr);
		static Dynamic getSampleDataSizeHdr_dyn();

		static int getSampleCount( int mpegVersion);
		static Dynamic getSampleCount_dyn();

		static int getSampleCountHdr( Dynamic hdr);
		static Dynamic getSampleCountHdr_dyn();

		static String getFrameInfo( Dynamic fr);
		static Dynamic getFrameInfo_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_Tools */ 
