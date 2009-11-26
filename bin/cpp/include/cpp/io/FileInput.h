#ifndef INCLUDED_cpp_io_FileInput
#define INCLUDED_cpp_io_FileInput

#include <hxObject.h>

#include <haxe/io/Input.h>
DECLARE_CLASS2(cpp,io,FileInput)
DECLARE_CLASS2(cpp,io,FileSeek)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace cpp{
namespace io{


class FileInput_obj : public haxe::io::Input_obj
{
	public:
		typedef haxe::io::Input_obj super;
		typedef FileInput_obj OBJ_;

	protected:
		FileInput_obj();
		Void __construct(Dynamic f);

	public:
		static hxObjectPtr<FileInput_obj > __new(Dynamic f);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~FileInput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"FileInput",9); }

		Dynamic __f;
		virtual int readByte( );
		Dynamic readByte_dyn();

		virtual int readBytes( haxe::io::Bytes s,int p,int l);
		Dynamic readBytes_dyn();

		virtual Void close( );
		Dynamic close_dyn();

		virtual Void seek( int p,cpp::io::FileSeek pos);
		Dynamic seek_dyn();

		virtual int tell( );
		Dynamic tell_dyn();

		virtual bool eof( );
		Dynamic eof_dyn();

		static Dynamic file_eof;
	Dynamic &file_eof_dyn() { return file_eof;}
		static Dynamic file_read;
	Dynamic &file_read_dyn() { return file_read;}
		static Dynamic file_read_char;
	Dynamic &file_read_char_dyn() { return file_read_char;}
		static Dynamic file_close;
	Dynamic &file_close_dyn() { return file_close;}
		static Dynamic file_seek;
	Dynamic &file_seek_dyn() { return file_seek;}
		static Dynamic file_tell;
	Dynamic &file_tell_dyn() { return file_tell;}
};

} // end namespace cpp
} // end namespace io

#endif /* INCLUDED_cpp_io_FileInput */ 
