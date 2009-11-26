#include <hxObject.h>

#ifndef INCLUDED_IntHash
#include <IntHash.h>
#endif
#ifndef INCLUDED_format_tools_HuffTools
#include <format/tools/HuffTools.h>
#endif
#ifndef INCLUDED_format_tools_Huffman
#include <format/tools/Huffman.h>
#endif
namespace format{
namespace tools{

Void HuffTools_obj::__construct()
{
{
}
;
	return null();
}

HuffTools_obj::~HuffTools_obj() { }

Dynamic HuffTools_obj::__CreateEmpty() { return  new HuffTools_obj; }
hxObjectPtr<HuffTools_obj > HuffTools_obj::__new()
{  hxObjectPtr<HuffTools_obj > result = new HuffTools_obj();
	result->__construct();
	return result;}

Dynamic HuffTools_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<HuffTools_obj > result = new HuffTools_obj();
	result->__construct();
	return result;}

int HuffTools_obj::treeDepth( format::tools::Huffman t){
	struct _Function_1{
		static int Block( format::tools::Huffman &t,format::tools::HuffTools_obj *__this)/* DEF (not block)(ret intern) */{
			format::tools::Huffman _switch_1 = (t);
			switch((_switch_1)->GetIndex()){
				case 0: {
{
						return 0;
					}
				}
				break;
				case 2: {
{
						return hxThrow (STRING(L"assert",6));
					}
				}
				break;
				case 1: {
					format::tools::Huffman b = _switch_1->__Param(1);
					format::tools::Huffman a = _switch_1->__Param(0);
{
						int da = __this->treeDepth(a);
						int db = __this->treeDepth(b);
						return 1 + ((da < db) ? int( da ) : int( db ));
					}
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(t,this);
}


DEFINE_DYNAMIC_FUNC1(HuffTools_obj,treeDepth,return )

format::tools::Huffman HuffTools_obj::treeCompress( format::tools::Huffman t){
	int d = this->treeDepth(t);
	if (d == 0)
		return t;
	struct _Function_1{
		static format::tools::Huffman Block( format::tools::Huffman &t,format::tools::HuffTools_obj *__this)/* DEF (not block)(ret intern) */{
			format::tools::Huffman _switch_2 = (t);
			switch((_switch_2)->GetIndex()){
				case 1: {
					format::tools::Huffman b = _switch_2->__Param(1);
					format::tools::Huffman a = _switch_2->__Param(0);
{
						return format::tools::Huffman_obj::NeedBit(__this->treeCompress(a),__this->treeCompress(b));
					}
				}
				break;
				default: {
					return hxThrow (STRING(L"assert",6));
				}
			}
		}
	};
	if (d == 1)
		return _Function_1::Block(t,this);
	int size = int(1) << int(d);
	Array<format::tools::Huffman > table = Array_obj<format::tools::Huffman >::__new();
	{
		int _g = 0;
		while(_g < size){
			int i = _g++;
			table->push(format::tools::Huffman_obj::Found(-1));
		}
	}
	this->treeWalk(table,0,0,d,t);
	return format::tools::Huffman_obj::NeedBits(d,table);
}


DEFINE_DYNAMIC_FUNC1(HuffTools_obj,treeCompress,return )

Void HuffTools_obj::treeWalk( Array<format::tools::Huffman > table,int p,int cd,int d,format::tools::Huffman t){
{
		format::tools::Huffman _switch_3 = (t);
		switch((_switch_3)->GetIndex()){
			case 1: {
				format::tools::Huffman b = _switch_3->__Param(1);
				format::tools::Huffman a = _switch_3->__Param(0);
{
					if (d > 0){
						this->treeWalk(table,p,cd + 1,d - 1,a);
						this->treeWalk(table,int(p) | int((int(1) << int(cd))),cd + 1,d - 1,b);
					}
					else
						table[p] = this->treeCompress(t);
;
				}
			}
			break;
			default: {
				table[p] = this->treeCompress(t);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC5(HuffTools_obj,treeWalk,(void))

format::tools::Huffman HuffTools_obj::treeMake( IntHash bits,int maxbits,int v,int len){
	if (len > maxbits)
		hxThrow (STRING(L"Invalid huffman",15));
	int idx = int((int(v) << int(5))) | int(len);
	if (bits->exists(idx))
		return format::tools::Huffman_obj::Found(bits->get(idx));
	hxShlEq(v,1);
	hxAddEq(len,1);
	return format::tools::Huffman_obj::NeedBit(this->treeMake(bits,maxbits,v,len),this->treeMake(bits,maxbits,int(v) | int(1),len));
}


DEFINE_DYNAMIC_FUNC4(HuffTools_obj,treeMake,return )

format::tools::Huffman HuffTools_obj::make( Array<int > lengths,int pos,int nlengths,int maxbits){
	Array<int > counts = Array_obj<int >::__new();
	Array<int > tmp = Array_obj<int >::__new();
	if (maxbits > 32)
		hxThrow (STRING(L"Invalid huffman",15));
	{
		int _g = 0;
		while(_g < maxbits){
			int i = _g++;
			counts->push(0);
			tmp->push(0);
		}
	}
	{
		int _g = 0;
		while(_g < nlengths){
			int i = _g++;
			int p = lengths->__get(i + pos);
			if (p >= maxbits)
				hxThrow (STRING(L"Invalid huffman",15));
			counts[p]++;
		}
	}
	int code = 0;
	{
		int _g1 = 1;
		int _g = maxbits - 1;
		while(_g1 < _g){
			int i = _g1++;
			code = int((code + counts->__get(i))) << int(1);
			tmp[i] = code;
		}
	}
	IntHash bits = IntHash_obj::__new();
	{
		int _g = 0;
		while(_g < nlengths){
			int i = _g++;
			int l = lengths->__get(i + pos);
			if (l != 0){
				int n = tmp->__get(l - 1);
				tmp[l - 1] = n + 1;
				bits->set(int((int(n) << int(5))) | int(l),i);
			}
		}
	}
	return this->treeCompress(format::tools::Huffman_obj::NeedBit(this->treeMake(bits,maxbits,0,1),this->treeMake(bits,maxbits,1,1)));
}


DEFINE_DYNAMIC_FUNC4(HuffTools_obj,make,return )


HuffTools_obj::HuffTools_obj()
{
}

void HuffTools_obj::__Mark()
{
}

Dynamic HuffTools_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"make",sizeof(wchar_t)*4) ) { return make_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"treeWalk",sizeof(wchar_t)*8) ) { return treeWalk_dyn(); }
		if (!memcmp(inName.__s,L"treeMake",sizeof(wchar_t)*8) ) { return treeMake_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"treeDepth",sizeof(wchar_t)*9) ) { return treeDepth_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"treeCompress",sizeof(wchar_t)*12) ) { return treeCompress_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_treeDepth = __hxcpp_field_to_id("treeDepth");
static int __id_treeCompress = __hxcpp_field_to_id("treeCompress");
static int __id_treeWalk = __hxcpp_field_to_id("treeWalk");
static int __id_treeMake = __hxcpp_field_to_id("treeMake");
static int __id_make = __hxcpp_field_to_id("make");


Dynamic HuffTools_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_treeDepth) return treeDepth_dyn();
	if (inFieldID==__id_treeCompress) return treeCompress_dyn();
	if (inFieldID==__id_treeWalk) return treeWalk_dyn();
	if (inFieldID==__id_treeMake) return treeMake_dyn();
	if (inFieldID==__id_make) return make_dyn();
	return super::__IField(inFieldID);
}

Dynamic HuffTools_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void HuffTools_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"treeDepth",9),
	STRING(L"treeCompress",12),
	STRING(L"treeWalk",8),
	STRING(L"treeMake",8),
	STRING(L"make",4),
	String(null()) };

static void sMarkStatics() {
};

Class HuffTools_obj::__mClass;

void HuffTools_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.HuffTools",22), TCanCast<HuffTools_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void HuffTools_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
