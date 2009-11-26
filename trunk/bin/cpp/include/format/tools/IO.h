#ifndef INCLUDED_format_tools_IO
#define INCLUDED_format_tools_IO

#include <hxObject.h>

DECLARE_CLASS2(format,tools,IO)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace tools{


class IO_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef IO_obj OBJ_;

	protected:
		IO_obj();
		Void __construct();

	public:
		static hxObjectPtr<IO_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~IO_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"IO",2); }

		static Void copy( haxe::io::Input i,haxe::io::Output o,haxe::io::Bytes buf,int size);
		static Dynamic copy_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_IO */ 
