#ifndef INCLUDED_format_tools__InflateImpl_Window
#define INCLUDED_format_tools__InflateImpl_Window

#include <hxObject.h>

DECLARE_CLASS2(format,tools,Adler32)
DECLARE_CLASS3(format,tools,_InflateImpl,Window)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace tools{
namespace _InflateImpl{


class Window_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Window_obj OBJ_;

	protected:
		Window_obj();
		Void __construct();

	public:
		static hxObjectPtr<Window_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Window_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Window",6); }

		haxe::io::Bytes buffer;
		int pos;
		format::tools::Adler32 crc;
		virtual Void slide( );
		Dynamic slide_dyn();

		virtual Void addBytes( haxe::io::Bytes b,int p,int len);
		Dynamic addBytes_dyn();

		virtual Void addByte( int c);
		Dynamic addByte_dyn();

		virtual int getLastChar( );
		Dynamic getLastChar_dyn();

		virtual int available( );
		Dynamic available_dyn();

		virtual format::tools::Adler32 checksum( );
		Dynamic checksum_dyn();

		static int SIZE;
		static int BUFSIZE;
};

} // end namespace format
} // end namespace tools
} // end namespace _InflateImpl

#endif /* INCLUDED_format_tools__InflateImpl_Window */ 
