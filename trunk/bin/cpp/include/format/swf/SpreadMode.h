#ifndef INCLUDED_format_swf_SpreadMode
#define INCLUDED_format_swf_SpreadMode

#include <hxObject.h>

DECLARE_CLASS2(format,swf,SpreadMode)
namespace format{
namespace swf{


class SpreadMode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SpreadMode_obj OBJ_;

	public:
		SpreadMode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.SpreadMode",21); }
		String __ToString() const { return STRING(L"SpreadMode.",11) + tag; }

		static SpreadMode SMPad;
		static SpreadMode SMReflect;
		static SpreadMode SMRepeat;
		static SpreadMode SMReserved;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_SpreadMode */ 
