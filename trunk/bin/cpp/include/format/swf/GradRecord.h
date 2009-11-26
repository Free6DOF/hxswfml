#ifndef INCLUDED_format_swf_GradRecord
#define INCLUDED_format_swf_GradRecord

#include <hxObject.h>

DECLARE_CLASS2(format,swf,GradRecord)
namespace format{
namespace swf{


class GradRecord_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef GradRecord_obj OBJ_;

	public:
		GradRecord_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.GradRecord",21); }
		String __ToString() const { return STRING(L"GradRecord.",11) + tag; }

		static GradRecord GRRGB(int pos,Dynamic col);
		static Dynamic GRRGB_dyn();
		static GradRecord GRRGBA(int pos,Dynamic col);
		static Dynamic GRRGBA_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_GradRecord */ 
