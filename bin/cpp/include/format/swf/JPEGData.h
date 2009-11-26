#ifndef INCLUDED_format_swf_JPEGData
#define INCLUDED_format_swf_JPEGData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,JPEGData)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace swf{


class JPEGData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef JPEGData_obj OBJ_;

	public:
		JPEGData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.JPEGData",19); }
		String __ToString() const { return STRING(L"JPEGData.",9) + tag; }

		static JPEGData JDJPEG1(haxe::io::Bytes data);
		static Dynamic JDJPEG1_dyn();
		static JPEGData JDJPEG2(haxe::io::Bytes data);
		static Dynamic JDJPEG2_dyn();
		static JPEGData JDJPEG3(haxe::io::Bytes data,haxe::io::Bytes mask);
		static Dynamic JDJPEG3_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_JPEGData */ 
