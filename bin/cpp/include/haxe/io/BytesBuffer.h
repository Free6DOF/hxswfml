#ifndef INCLUDED_haxe_io_BytesBuffer
#define INCLUDED_haxe_io_BytesBuffer

#include <hxObject.h>

DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,BytesBuffer)
namespace haxe{
namespace io{


class BytesBuffer_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef BytesBuffer_obj OBJ_;

	protected:
		BytesBuffer_obj();
		Void __construct();

	public:
		static hxObjectPtr<BytesBuffer_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~BytesBuffer_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"BytesBuffer",11); }

		Array<unsigned char > b;
		virtual Void addByte( int byte);
		Dynamic addByte_dyn();

		virtual Void add( haxe::io::Bytes src);
		Dynamic add_dyn();

		virtual Void addBytes( haxe::io::Bytes src,int pos,int len);
		Dynamic addBytes_dyn();

		virtual haxe::io::Bytes getBytes( );
		Dynamic getBytes_dyn();

};

} // end namespace haxe
} // end namespace io

#endif /* INCLUDED_haxe_io_BytesBuffer */ 
