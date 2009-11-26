#ifndef INCLUDED_format_tools_BitsInput
#define INCLUDED_format_tools_BitsInput

#include <hxObject.h>

DECLARE_CLASS2(format,tools,BitsInput)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace tools{


class BitsInput_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef BitsInput_obj OBJ_;

	protected:
		BitsInput_obj();
		Void __construct(haxe::io::Input i);

	public:
		static hxObjectPtr<BitsInput_obj > __new(haxe::io::Input i);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~BitsInput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"BitsInput",9); }

		haxe::io::Input i;
		int nbits;
		int bits;
		virtual int readBits( int n);
		Dynamic readBits_dyn();

		virtual bool read( );
		Dynamic read_dyn();

		virtual Void reset( );
		Dynamic reset_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_BitsInput */ 
