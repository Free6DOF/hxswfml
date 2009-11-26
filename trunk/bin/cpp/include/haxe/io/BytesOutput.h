#ifndef INCLUDED_haxe_io_BytesOutput
#define INCLUDED_haxe_io_BytesOutput

#include <hxObject.h>

#include <haxe/io/Output.h>
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,BytesBuffer)
DECLARE_CLASS2(haxe,io,BytesOutput)
DECLARE_CLASS2(haxe,io,Output)
namespace haxe{
namespace io{


class BytesOutput_obj : public haxe::io::Output_obj
{
	public:
		typedef haxe::io::Output_obj super;
		typedef BytesOutput_obj OBJ_;

	protected:
		BytesOutput_obj();
		Void __construct();

	public:
		static hxObjectPtr<BytesOutput_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~BytesOutput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"BytesOutput",11); }

		haxe::io::BytesBuffer b;
		virtual Void writeByte( int c);
		Dynamic writeByte_dyn();

		virtual int writeBytes( haxe::io::Bytes buf,int pos,int len);
		Dynamic writeBytes_dyn();

		virtual haxe::io::Bytes getBytes( );
		Dynamic getBytes_dyn();

};

} // end namespace haxe
} // end namespace io

#endif /* INCLUDED_haxe_io_BytesOutput */ 
