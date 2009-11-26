#ifndef INCLUDED_haxe_io_Input
#define INCLUDED_haxe_io_Input

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace haxe{
namespace io{


class Input_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Input_obj OBJ_;

	protected:
		Input_obj();
		Void __construct();

	public:
		static hxObjectPtr<Input_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Input_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Input",5); }

		bool bigEndian;
		virtual int readByte( );
		Dynamic readByte_dyn();

		virtual int readBytes( haxe::io::Bytes s,int pos,int len);
		Dynamic readBytes_dyn();

		virtual Void close( );
		Dynamic close_dyn();

		virtual bool setEndian( bool b);
		Dynamic setEndian_dyn();

		virtual haxe::io::Bytes readAll( Dynamic bufsize);
		Dynamic readAll_dyn();

		virtual Void readFullBytes( haxe::io::Bytes s,int pos,int len);
		Dynamic readFullBytes_dyn();

		virtual haxe::io::Bytes read( int nbytes);
		Dynamic read_dyn();

		virtual String readUntil( int end);
		Dynamic readUntil_dyn();

		virtual String readLine( );
		Dynamic readLine_dyn();

		virtual double readFloat( );
		Dynamic readFloat_dyn();

		virtual double readDouble( );
		Dynamic readDouble_dyn();

		virtual int readInt8( );
		Dynamic readInt8_dyn();

		virtual int readInt16( );
		Dynamic readInt16_dyn();

		virtual int readUInt16( );
		Dynamic readUInt16_dyn();

		virtual int readInt24( );
		Dynamic readInt24_dyn();

		virtual int readUInt24( );
		Dynamic readUInt24_dyn();

		virtual int readInt31( );
		Dynamic readInt31_dyn();

		virtual int readUInt30( );
		Dynamic readUInt30_dyn();

		virtual cpp::CppInt32__ readInt32( );
		Dynamic readInt32_dyn();

		virtual String readString( int len);
		Dynamic readString_dyn();

		static Dynamic _float_of_bytes;
	Dynamic &_float_of_bytes_dyn() { return _float_of_bytes;}
		static Dynamic _double_of_bytes;
	Dynamic &_double_of_bytes_dyn() { return _double_of_bytes;}
};

} // end namespace haxe
} // end namespace io

#endif /* INCLUDED_haxe_io_Input */ 
