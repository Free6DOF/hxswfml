#ifndef INCLUDED_format_mp3_Reader
#define INCLUDED_format_mp3_Reader

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,FrameType)
DECLARE_CLASS2(format,mp3,Reader)
DECLARE_CLASS2(format,tools,BitsInput)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace mp3{


class Reader_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Reader_obj OBJ_;

	protected:
		Reader_obj();
		Void __construct(haxe::io::Input i);

	public:
		static hxObjectPtr<Reader_obj > __new(haxe::io::Input i);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Reader_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Reader",6); }

		haxe::io::Input i;
		format::tools::BitsInput bits;
		int version;
		int samples;
		int sampleSize;
		bool any_read;
		haxe::io::Bytes id3v2_data;
		int id3v2_version;
		int id3v2_flags;
		virtual Void skipID3v2( );
		Dynamic skipID3v2_dyn();

		virtual format::mp3::FrameType seekFrame( );
		Dynamic seekFrame_dyn();

		virtual Array<Dynamic > readFrames( );
		Dynamic readFrames_dyn();

		virtual Dynamic readFrameHeader( );
		Dynamic readFrameHeader_dyn();

		virtual Dynamic readFrame( );
		Dynamic readFrame_dyn();

		virtual Dynamic read( );
		Dynamic read_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_Reader */ 
