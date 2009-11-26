#ifndef INCLUDED_format_swf_Tools
#define INCLUDED_format_swf_Tools

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(format,swf,Tools)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace swf{


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

		static int signExtend( int v,int nbits);
		static Dynamic signExtend_dyn();

		static double floatFixedBits( int i,int nbits);
		static Dynamic floatFixedBits_dyn();

		static double floatFixed( cpp::CppInt32__ i);
		static Dynamic floatFixed_dyn();

		static double floatFixed8( int i);
		static Dynamic floatFixed8_dyn();

		static int toFixed8( double f);
		static Dynamic toFixed8_dyn();

		static int toFixed16( double f);
		static Dynamic toFixed16_dyn();

		static int minBits( Array<int > values);
		static Dynamic minBits_dyn();

		static String hex( haxe::io::Bytes b,Dynamic max);
		static Dynamic hex_dyn();

		static String bin( haxe::io::Bytes b,Dynamic maxBytes);
		static Dynamic bin_dyn();

		static String dumpTag( format::swf::SWFTag t,Dynamic max);
		static Dynamic dumpTag_dyn();

};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Tools */ 
