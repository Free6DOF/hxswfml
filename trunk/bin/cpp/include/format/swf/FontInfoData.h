#ifndef INCLUDED_format_swf_FontInfoData
#define INCLUDED_format_swf_FontInfoData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FontInfoData)
DECLARE_CLASS2(format,swf,LangCode)
namespace format{
namespace swf{


class FontInfoData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FontInfoData_obj OBJ_;

	public:
		FontInfoData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.FontInfoData",23); }
		String __ToString() const { return STRING(L"FontInfoData.",13) + tag; }

		static FontInfoData FIDFont1(bool shiftJIS,bool isANSI,bool hasWideCodes,Dynamic data);
		static Dynamic FIDFont1_dyn();
		static FontInfoData FIDFont2(format::swf::LangCode language,Dynamic data);
		static Dynamic FIDFont2_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_FontInfoData */ 
