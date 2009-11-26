#ifndef INCLUDED_format_swf_ShapeRecord
#define INCLUDED_format_swf_ShapeRecord

#include <hxObject.h>

DECLARE_CLASS2(format,swf,ShapeRecord)
namespace format{
namespace swf{


class ShapeRecord_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ShapeRecord_obj OBJ_;

	public:
		ShapeRecord_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.ShapeRecord",22); }
		String __ToString() const { return STRING(L"ShapeRecord.",12) + tag; }

		static ShapeRecord SHRChange(Dynamic data);
		static Dynamic SHRChange_dyn();
		static ShapeRecord SHRCurvedEdge(int cdx,int cdy,int adx,int ady);
		static Dynamic SHRCurvedEdge_dyn();
		static ShapeRecord SHREdge(int dx,int dy);
		static Dynamic SHREdge_dyn();
		static ShapeRecord SHREnd;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_ShapeRecord */ 
