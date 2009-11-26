#ifndef INCLUDED_format_zip_ExtraField
#define INCLUDED_format_zip_ExtraField

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,zip,ExtraField)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace zip{


class ExtraField_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ExtraField_obj OBJ_;

	public:
		ExtraField_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.zip.ExtraField",21); }
		String __ToString() const { return STRING(L"ExtraField.",11) + tag; }

		static ExtraField FInfoZipUnicodePath(String name,cpp::CppInt32__ crc);
		static Dynamic FInfoZipUnicodePath_dyn();
		static ExtraField FUnknown(int tag,haxe::io::Bytes bytes);
		static Dynamic FUnknown_dyn();
};

} // end namespace format
} // end namespace zip

#endif /* INCLUDED_format_zip_ExtraField */ 
