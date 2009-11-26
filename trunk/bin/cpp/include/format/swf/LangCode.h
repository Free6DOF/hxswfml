#ifndef INCLUDED_format_swf_LangCode
#define INCLUDED_format_swf_LangCode

#include <hxObject.h>

DECLARE_CLASS2(format,swf,LangCode)
namespace format{
namespace swf{


class LangCode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef LangCode_obj OBJ_;

	public:
		LangCode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.LangCode",19); }
		String __ToString() const { return STRING(L"LangCode.",9) + tag; }

		static LangCode LCJapanese;
		static LangCode LCKorean;
		static LangCode LCLatin;
		static LangCode LCNone;
		static LangCode LCSimplifiedChinese;
		static LangCode LCTraditionalChinese;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_LangCode */ 
