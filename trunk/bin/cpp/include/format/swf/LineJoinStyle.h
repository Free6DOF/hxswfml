#ifndef INCLUDED_format_swf_LineJoinStyle
#define INCLUDED_format_swf_LineJoinStyle

#include <hxObject.h>

DECLARE_CLASS2(format,swf,LineJoinStyle)
namespace format{
namespace swf{


class LineJoinStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef LineJoinStyle_obj OBJ_;

	public:
		LineJoinStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.LineJoinStyle",24); }
		String __ToString() const { return STRING(L"LineJoinStyle.",14) + tag; }

		static LineJoinStyle LJBevel;
		static LineJoinStyle LJMiter(int limitFactor);
		static Dynamic LJMiter_dyn();
		static LineJoinStyle LJRound;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_LineJoinStyle */ 
