#ifndef INCLUDED_format_swf_Emphasis
#define INCLUDED_format_swf_Emphasis

#include <hxObject.h>

DECLARE_CLASS2(format,swf,Emphasis)
namespace format{
namespace swf{


class Emphasis_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Emphasis_obj OBJ_;

	public:
		Emphasis_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.Emphasis",19); }
		String __ToString() const { return STRING(L"Emphasis.",9) + tag; }

		static Emphasis CCIT_J17;
		static Emphasis InvalidEmphasis;
		static Emphasis Ms50_15;
		static Emphasis NoEmphasis;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Emphasis */ 
