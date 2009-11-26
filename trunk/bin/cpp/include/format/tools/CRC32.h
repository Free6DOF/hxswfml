#ifndef INCLUDED_format_tools_CRC32
#define INCLUDED_format_tools_CRC32

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,tools,CRC32)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace tools{


class CRC32_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CRC32_obj OBJ_;

	protected:
		CRC32_obj();
		Void __construct();

	public:
		static hxObjectPtr<CRC32_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CRC32_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"CRC32",5); }

		cpp::CppInt32__ crc;
		virtual Void run( haxe::io::Bytes b);
		Dynamic run_dyn();

		virtual Void byte( int b);
		Dynamic byte_dyn();

		virtual cpp::CppInt32__ get( );
		Dynamic get_dyn();

		static cpp::CppInt32__ POLYNOM;
		static cpp::CppInt32__ encode( haxe::io::Bytes b);
		static Dynamic encode_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_CRC32 */ 
