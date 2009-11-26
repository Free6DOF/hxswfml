#ifndef INCLUDED_format_swf_FontData
#define INCLUDED_format_swf_FontData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FontData)
namespace format{
namespace swf{


class FontData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FontData_obj OBJ_;

	public:
		FontData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.FontData",19); }
		String __ToString() const { return STRING(L"FontData.",9) + tag; }

		static FontData FDFont1(Dynamic data);
		static Dynamic FDFont1_dyn();
		static FontData FDFont2(bool hasWideChars,Dynamic data);
		static Dynamic FDFont2_dyn();
		static FontData FDFont3(Dynamic data);
		static Dynamic FDFont3_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_FontData */ 
