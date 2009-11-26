#ifndef INCLUDED_format_tools_Deflate
#define INCLUDED_format_tools_Deflate

#include <hxObject.h>

DECLARE_CLASS2(format,tools,Deflate)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace tools{


class Deflate_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Deflate_obj OBJ_;

	protected:
		Deflate_obj();
		Void __construct();

	public:
		static hxObjectPtr<Deflate_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Deflate_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Deflate",7); }

		static haxe::io::Bytes run( haxe::io::Bytes b);
		static Dynamic run_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_Deflate */ 
