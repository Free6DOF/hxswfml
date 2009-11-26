#ifndef INCLUDED_format_swf_Layer
#define INCLUDED_format_swf_Layer

#include <hxObject.h>

DECLARE_CLASS2(format,swf,Layer)
namespace format{
namespace swf{


class Layer_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Layer_obj OBJ_;

	public:
		Layer_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.Layer",16); }
		String __ToString() const { return STRING(L"Layer.",6) + tag; }

		static Layer Layer1;
		static Layer Layer2;
		static Layer Layer3;
		static Layer LayerReserved;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Layer */ 
