#ifndef INCLUDED_format_swf_ShapeData
#define INCLUDED_format_swf_ShapeData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,ShapeData)
namespace format{
namespace swf{


class ShapeData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ShapeData_obj OBJ_;

	public:
		ShapeData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.ShapeData",20); }
		String __ToString() const { return STRING(L"ShapeData.",10) + tag; }

		static ShapeData SHDShape1(Dynamic bounds,Dynamic shapes);
		static Dynamic SHDShape1_dyn();
		static ShapeData SHDShape2(Dynamic bounds,Dynamic shapes);
		static Dynamic SHDShape2_dyn();
		static ShapeData SHDShape3(Dynamic bounds,Dynamic shapes);
		static Dynamic SHDShape3_dyn();
		static ShapeData SHDShape4(Dynamic data);
		static Dynamic SHDShape4_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_ShapeData */ 
