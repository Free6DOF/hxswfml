#ifndef INCLUDED_format_tools_Huffman
#define INCLUDED_format_tools_Huffman

#include <hxObject.h>

DECLARE_CLASS2(format,tools,Huffman)
namespace format{
namespace tools{


class Huffman_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef Huffman_obj OBJ_;

	public:
		Huffman_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.tools.Huffman",20); }
		String __ToString() const { return STRING(L"Huffman.",8) + tag; }

		static Huffman Found(int i);
		static Dynamic Found_dyn();
		static Huffman NeedBit(format::tools::Huffman left,format::tools::Huffman right);
		static Dynamic NeedBit_dyn();
		static Huffman NeedBits(int n,Array<format::tools::Huffman > table);
		static Dynamic NeedBits_dyn();
};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_Huffman */ 
