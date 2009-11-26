#ifndef INCLUDED_format_mp3_Writer
#define INCLUDED_format_mp3_Writer

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,Writer)
DECLARE_CLASS2(format,tools,BitsOutput)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace mp3{


class Writer_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Writer_obj OBJ_;

	protected:
		Writer_obj();
		Void __construct(haxe::io::Output output);

	public:
		static hxObjectPtr<Writer_obj > __new(haxe::io::Output output);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Writer_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Writer",6); }

		haxe::io::Output o;
		format::tools::BitsOutput bits;
		virtual Void write( Dynamic mp3,Dynamic writeId3v2);
		Dynamic write_dyn();

		virtual Void writeID3v2( Dynamic id3v2);
		Dynamic writeID3v2_dyn();

		virtual Void writeFrame( Dynamic f);
		Dynamic writeFrame_dyn();

		static bool WRITE_ID3V2;
		static bool DONT_WRITE_ID3V2;
};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_Writer */ 
