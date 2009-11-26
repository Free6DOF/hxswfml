#ifndef INCLUDED_format_mp3_Layer
#define INCLUDED_format_mp3_Layer

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,Layer)
namespace format{
namespace mp3{


class Layer_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Layer_obj OBJ_;

	public:
		Layer_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.mp3.Layer",16); }
		String __ToString() const { return STRING(L"Layer.",6) + tag; }

		static Layer Layer1;
		static Layer Layer2;
		static Layer Layer3;
		static Layer LayerReserved;
};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_Layer */ 
