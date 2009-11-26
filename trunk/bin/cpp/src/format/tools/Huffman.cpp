#include <hxObject.h>

#ifndef INCLUDED_format_tools_Huffman
#include <format/tools/Huffman.h>
#endif
namespace format{
namespace tools{

Huffman  Huffman_obj::Found(int i)
	{ return CreateEnum<Huffman_obj >(STRING(L"Found",5),0,DynamicArray(0,1).Add(i)); }

Huffman  Huffman_obj::NeedBit(format::tools::Huffman left,format::tools::Huffman right)
	{ return CreateEnum<Huffman_obj >(STRING(L"NeedBit",7),1,DynamicArray(0,2).Add(left).Add(right)); }

Huffman  Huffman_obj::NeedBits(int n,Array<format::tools::Huffman > table)
	{ return CreateEnum<Huffman_obj >(STRING(L"NeedBits",8),2,DynamicArray(0,2).Add(n).Add(table)); }

DEFINE_CREATE_ENUM(Huffman_obj)

int Huffman_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"Found",5)) return 0;
	if (inName==STRING(L"NeedBit",7)) return 1;
	if (inName==STRING(L"NeedBits",8)) return 2;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(Huffman_obj,Found,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Huffman_obj,NeedBit,return)

STATIC_DEFINE_DYNAMIC_FUNC2(Huffman_obj,NeedBits,return)

int Huffman_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"Found",5)) return 1;
	if (inName==STRING(L"NeedBit",7)) return 2;
	if (inName==STRING(L"NeedBits",8)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic Huffman_obj::__Field(const String &inName)
{
	if (inName==STRING(L"Found",5)) return Found_dyn();
	if (inName==STRING(L"NeedBit",7)) return NeedBit_dyn();
	if (inName==STRING(L"NeedBits",8)) return NeedBits_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"Found",5),
	STRING(L"NeedBit",7),
	STRING(L"NeedBits",8),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class Huffman_obj::__mClass;

Dynamic __Create_Huffman_obj() { return new Huffman_obj; }

void Huffman_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.tools.Huffman",20), TCanCast<Huffman_obj >,sStaticFields,sMemberFields,
	&__Create_Huffman_obj, &__Create,
	&super::__SGetClass(), &CreateHuffman_obj, sMarkStatics);
}

void Huffman_obj::__boot()
{
}


} // end namespace format
} // end namespace tools
