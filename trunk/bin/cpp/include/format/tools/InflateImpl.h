#ifndef INCLUDED_format_tools_InflateImpl
#define INCLUDED_format_tools_InflateImpl

#include <hxObject.h>

DECLARE_CLASS2(format,tools,HuffTools)
DECLARE_CLASS2(format,tools,Huffman)
DECLARE_CLASS2(format,tools,InflateImpl)
DECLARE_CLASS3(format,tools,_InflateImpl,State)
DECLARE_CLASS3(format,tools,_InflateImpl,Window)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace tools{


class InflateImpl_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef InflateImpl_obj OBJ_;

	protected:
		InflateImpl_obj();
		Void __construct(haxe::io::Input i,Dynamic __o_header);

	public:
		static hxObjectPtr<InflateImpl_obj > __new(haxe::io::Input i,Dynamic __o_header);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~InflateImpl_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"InflateImpl",11); }

		int nbits;
		int bits;
		format::tools::_InflateImpl::State state;
		bool final;
		format::tools::Huffman huffman;
		format::tools::Huffman huffdist;
		format::tools::HuffTools htools;
		int len;
		int dist;
		int needed;
		haxe::io::Bytes output;
		int outpos;
		haxe::io::Input input;
		Array<int > lengths;
		format::tools::_InflateImpl::Window window;
		virtual format::tools::Huffman buildFixedHuffman( );
		Dynamic buildFixedHuffman_dyn();

		virtual int readBytes( haxe::io::Bytes b,int pos,int len);
		Dynamic readBytes_dyn();

		virtual int getBits( int n);
		Dynamic getBits_dyn();

		virtual bool getBit( );
		Dynamic getBit_dyn();

		virtual int getRevBits( int n);
		Dynamic getRevBits_dyn();

		virtual Void resetBits( );
		Dynamic resetBits_dyn();

		virtual Void addBytes( haxe::io::Bytes b,int p,int len);
		Dynamic addBytes_dyn();

		virtual Void addByte( int b);
		Dynamic addByte_dyn();

		virtual Void addDistOne( int n);
		Dynamic addDistOne_dyn();

		virtual Void addDist( int d,int len);
		Dynamic addDist_dyn();

		virtual int applyHuffman( format::tools::Huffman h);
		Dynamic applyHuffman_dyn();

		virtual Void inflateLengths( Array<int > a,int max);
		Dynamic inflateLengths_dyn();

		virtual bool inflateLoop( );
		Dynamic inflateLoop_dyn();

		static Array<int > LEN_EXTRA_BITS_TBL;
		static Array<int > LEN_BASE_VAL_TBL;
		static Array<int > DIST_EXTRA_BITS_TBL;
		static Array<int > DIST_BASE_VAL_TBL;
		static Array<int > CODE_LENGTHS_POS;
		static format::tools::Huffman FIXED_HUFFMAN;
		static haxe::io::Bytes run( haxe::io::Input i,Dynamic bufsize);
		static Dynamic run_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_InflateImpl */ 
