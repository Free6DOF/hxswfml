#ifndef INCLUDED_format_tools_Adler32
#define INCLUDED_format_tools_Adler32

#include <hxObject.h>

DECLARE_CLASS2(format,tools,Adler32)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace tools{


class Adler32_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Adler32_obj OBJ_;

	protected:
		Adler32_obj();
		Void __construct();

	public:
		static hxObjectPtr<Adler32_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Adler32_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Adler32",7); }

		int a1;
		int a2;
		virtual Void update( haxe::io::Bytes b,int pos,int len);
		Dynamic update_dyn();

		virtual bool equals( format::tools::Adler32 a);
		Dynamic equals_dyn();

		static format::tools::Adler32 read( haxe::io::Input i);
		static Dynamic read_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_Adler32 */ 
