#ifndef INCLUDED_format_tools_BitsOutput
#define INCLUDED_format_tools_BitsOutput

#include <hxObject.h>

DECLARE_CLASS2(format,tools,BitsOutput)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace tools{


class BitsOutput_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef BitsOutput_obj OBJ_;

	protected:
		BitsOutput_obj();
		Void __construct(haxe::io::Output o);

	public:
		static hxObjectPtr<BitsOutput_obj > __new(haxe::io::Output o);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~BitsOutput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"BitsOutput",10); }

		haxe::io::Output o;
		int nbits;
		int bits;
		virtual Void writeBits( int n,int v);
		Dynamic writeBits_dyn();

		virtual Void writeBit( bool flag);
		Dynamic writeBit_dyn();

		virtual Void flush( );
		Dynamic flush_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_BitsOutput */ 
