#ifndef INCLUDED_format_mp3_CEmphasis
#define INCLUDED_format_mp3_CEmphasis

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,CEmphasis)
DECLARE_CLASS2(format,mp3,Emphasis)
namespace format{
namespace mp3{


class CEmphasis_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CEmphasis_obj OBJ_;

	protected:
		CEmphasis_obj();
		Void __construct();

	public:
		static hxObjectPtr<CEmphasis_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CEmphasis_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"CEmphasis",9); }

		static int ENone;
		static int EMs50_15;
		static int EReserved;
		static int ECCIT_J17;
		static int enum2Num( format::mp3::Emphasis c);
		static Dynamic enum2Num_dyn();

		static format::mp3::Emphasis num2Enum( int c);
		static Dynamic num2Enum_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_CEmphasis */ 
