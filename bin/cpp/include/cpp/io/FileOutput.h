#ifndef INCLUDED_cpp_io_FileOutput
#define INCLUDED_cpp_io_FileOutput

#include <hxObject.h>

#include <haxe/io/Output.h>
DECLARE_CLASS2(cpp,io,FileOutput)
DECLARE_CLASS2(cpp,io,FileSeek)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Output)
namespace cpp{
namespace io{


class FileOutput_obj : public haxe::io::Output_obj
{
	public:
		typedef haxe::io::Output_obj super;
		typedef FileOutput_obj OBJ_;

	protected:
		FileOutput_obj();
		Void __construct(Dynamic f);

	public:
		static hxObjectPtr<FileOutput_obj > __new(Dynamic f);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~FileOutput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"FileOutput",10); }

		Dynamic __f;
		virtual Void writeByte( int c);
		Dynamic writeByte_dyn();

		virtual int writeBytes( haxe::io::Bytes s,int p,int l);
		Dynamic writeBytes_dyn();

		virtual Void flush( );
		Dynamic flush_dyn();

		virtual Void close( );
		Dynamic close_dyn();

		virtual Void seek( int p,cpp::io::FileSeek pos);
		Dynamic seek_dyn();

		virtual int tell( );
		Dynamic tell_dyn();

		static Dynamic file_close;
	Dynamic &file_close_dyn() { return file_close;}
		static Dynamic file_seek;
	Dynamic &file_seek_dyn() { return file_seek;}
		static Dynamic file_tell;
	Dynamic &file_tell_dyn() { return file_tell;}
		static Dynamic file_flush;
	Dynamic &file_flush_dyn() { return file_flush;}
		static Dynamic file_write;
	Dynamic &file_write_dyn() { return file_write;}
		static Dynamic file_write_char;
	Dynamic &file_write_char_dyn() { return file_write_char;}
};

} // end namespace cpp
} // end namespace io

#endif /* INCLUDED_cpp_io_FileOutput */ 
