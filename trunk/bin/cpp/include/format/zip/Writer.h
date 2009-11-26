#ifndef INCLUDED_format_zip_Writer
#define INCLUDED_format_zip_Writer

#include <hxObject.h>

DECLARE_CLASS0(List)
DECLARE_CLASS1(cpp,CppDate__)
DECLARE_CLASS2(format,zip,Writer)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace zip{


class Writer_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Writer_obj OBJ_;

	protected:
		Writer_obj();
		Void __construct(haxe::io::Output o);

	public:
		static hxObjectPtr<Writer_obj > __new(haxe::io::Output o);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Writer_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Writer",6); }

		haxe::io::Output o;
		List files;
		virtual Void writeZipDate( cpp::CppDate__ date);
		Dynamic writeZipDate_dyn();

		virtual Void writeEntryHeader( Dynamic f);
		Dynamic writeEntryHeader_dyn();

		virtual Void writeEntryData( Dynamic e,haxe::io::Bytes buf,haxe::io::Input data);
		Dynamic writeEntryData_dyn();

		virtual Void writeData( List files);
		Dynamic writeData_dyn();

		virtual Void writeCDR( );
		Dynamic writeCDR_dyn();

		static int CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE;
		static int LOCAL_FILE_HEADER_FIELDS_SIZE;
};

} // end namespace format
} // end namespace zip

#endif /* INCLUDED_format_zip_Writer */ 
