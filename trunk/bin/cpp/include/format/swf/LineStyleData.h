#ifndef INCLUDED_format_swf_LineStyleData
#define INCLUDED_format_swf_LineStyleData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,LineStyleData)
namespace format{
namespace swf{


class LineStyleData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef LineStyleData_obj OBJ_;

	public:
		LineStyleData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.LineStyleData",24); }
		String __ToString() const { return STRING(L"LineStyleData.",14) + tag; }

		static LineStyleData LS2(Dynamic data);
		static Dynamic LS2_dyn();
		static LineStyleData LSRGB(Dynamic rgb);
		static Dynamic LSRGB_dyn();
		static LineStyleData LSRGBA(Dynamic rgba);
		static Dynamic LSRGBA_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_LineStyleData */ 
