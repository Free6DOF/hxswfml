#ifndef INCLUDED_format_tools_Inflate
#define INCLUDED_format_tools_Inflate

#include <hxObject.h>

DECLARE_CLASS2(format,tools,Inflate)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace tools{


class Inflate_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Inflate_obj OBJ_;

	protected:
		Inflate_obj();
		Void __construct();

	public:
		static hxObjectPtr<Inflate_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Inflate_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Inflate",7); }

		static haxe::io::Bytes run( haxe::io::Bytes bytes);
		static Dynamic run_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_Inflate */ 
