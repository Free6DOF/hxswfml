#ifndef INCLUDED_format_swf_ColorModel
#define INCLUDED_format_swf_ColorModel

#include <hxObject.h>

DECLARE_CLASS2(format,swf,ColorModel)
namespace format{
namespace swf{


class ColorModel_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ColorModel_obj OBJ_;

	public:
		ColorModel_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.ColorModel",21); }
		String __ToString() const { return STRING(L"ColorModel.",11) + tag; }

		static ColorModel CM15Bits;
		static ColorModel CM24Bits;
		static ColorModel CM32Bits;
		static ColorModel CM8Bits(int ncolors);
		static Dynamic CM8Bits_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_ColorModel */ 
