#ifndef INCLUDED_format_swf_LineCapStyle
#define INCLUDED_format_swf_LineCapStyle

#include <hxObject.h>

DECLARE_CLASS2(format,swf,LineCapStyle)
namespace format{
namespace swf{


class LineCapStyle_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef LineCapStyle_obj OBJ_;

	public:
		LineCapStyle_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.LineCapStyle",23); }
		String __ToString() const { return STRING(L"LineCapStyle.",13) + tag; }

		static LineCapStyle LCNone;
		static LineCapStyle LCRound;
		static LineCapStyle LCSquare;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_LineCapStyle */ 
