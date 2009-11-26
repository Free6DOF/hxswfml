#ifndef INCLUDED_format_swf_MorphShapeData
#define INCLUDED_format_swf_MorphShapeData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,MorphShapeData)
namespace format{
namespace swf{


class MorphShapeData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef MorphShapeData_obj OBJ_;

	public:
		MorphShapeData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.MorphShapeData",25); }
		String __ToString() const { return STRING(L"MorphShapeData.",15) + tag; }

		static MorphShapeData MSDShape1(Dynamic data);
		static Dynamic MSDShape1_dyn();
		static MorphShapeData MSDShape2(Dynamic data);
		static Dynamic MSDShape2_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_MorphShapeData */ 
