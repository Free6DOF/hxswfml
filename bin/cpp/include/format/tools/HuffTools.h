#ifndef INCLUDED_format_tools_HuffTools
#define INCLUDED_format_tools_HuffTools

#include <hxObject.h>

DECLARE_CLASS0(IntHash)
DECLARE_CLASS2(format,tools,HuffTools)
DECLARE_CLASS2(format,tools,Huffman)
namespace format{
namespace tools{


class HuffTools_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef HuffTools_obj OBJ_;

	protected:
		HuffTools_obj();
		Void __construct();

	public:
		static hxObjectPtr<HuffTools_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~HuffTools_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"HuffTools",9); }

		virtual int treeDepth( format::tools::Huffman t);
		Dynamic treeDepth_dyn();

		virtual format::tools::Huffman treeCompress( format::tools::Huffman t);
		Dynamic treeCompress_dyn();

		virtual Void treeWalk( Array<format::tools::Huffman > table,int p,int cd,int d,format::tools::Huffman t);
		Dynamic treeWalk_dyn();

		virtual format::tools::Huffman treeMake( IntHash bits,int maxbits,int v,int len);
		Dynamic treeMake_dyn();

		virtual format::tools::Huffman make( Array<int > lengths,int pos,int nlengths,int maxbits);
		Dynamic make_dyn();

};

} // end namespace format
} // end namespace tools

#endif /* INCLUDED_format_tools_HuffTools */ 
