#ifndef INCLUDED_format_mp3_CLayer
#define INCLUDED_format_mp3_CLayer

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,CLayer)
DECLARE_CLASS2(format,mp3,Layer)
namespace format{
namespace mp3{


class CLayer_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CLayer_obj OBJ_;

	protected:
		CLayer_obj();
		Void __construct();

	public:
		static hxObjectPtr<CLayer_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CLayer_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"CLayer",6); }

		static int LReserved;
		static int LLayer3;
		static int LLayer2;
		static int LLayer1;
		static int enum2Num( format::mp3::Layer l);
		static Dynamic enum2Num_dyn();

		static format::mp3::Layer num2Enum( int l);
		static Dynamic num2Enum_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_CLayer */ 
