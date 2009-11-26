#include <hxObject.h>

#ifndef INCLUDED_format_tools_BitsOutput
#include <format/tools/BitsOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace tools{

Void BitsOutput_obj::__construct(haxe::io::Output o)
{
{
	this->o = o;
	this->nbits = 0;
	this->bits = 0;
}
;
	return null();
}

BitsOutput_obj::~BitsOutput_obj() { }

Dynamic BitsOutput_obj::__CreateEmpty() { return  new BitsOutput_obj; }
hxObjectPtr<BitsOutput_obj > BitsOutput_obj::__new(haxe::io::Output o)
{  hxObjectPtr<BitsOutput_obj > result = new BitsOutput_obj();
	result->__construct(o);
	return result;}

Dynamic BitsOutput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<BitsOutput_obj > result = new BitsOutput_obj();
	result->__construct(inArgs[0]);
	return result;}

Void BitsOutput_obj::writeBits( int n,int v){
{
		v = int(v) & int(((int(1) << int(n)) - 1));
		if (n + this->nbits >= 32){
			if (n >= 31)
				hxThrow (STRING(L"Bits error",10));
			int n2 = 32 - this->nbits - 1;
			int n3 = n - n2;
			this->writeBits(n2,hxUShr(v,n3));
			this->writeBits(n3,int(v) & int(((int(1) << int(n3)) - 1)));
			return null();
		}
		if (n < 0)
			hxThrow (STRING(L"Bits error",10));
		this->bits = int((int(this->bits) << int(n))) | int(v);
		hxAddEq(this->nbits,n);
		while(this->nbits >= 8){
			hxSubEq(this->nbits,8);
			this->o->writeByte(int((hxUShr(this->bits,this->nbits))) & int(255));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(BitsOutput_obj,writeBits,(void))

Void BitsOutput_obj::writeBit( bool flag){
{
		hxShlEq(this->bits,1);
		if (flag)
			hxOrEq(this->bits,1);
		this->nbits++;
		if (this->nbits == 8){
			this->nbits = 0;
			this->o->writeByte(int(this->bits) & int(255));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(BitsOutput_obj,writeBit,(void))

Void BitsOutput_obj::flush( ){
{
		if (this->nbits > 0){
			this->writeBits(8 - this->nbits,0);
			this->nbits = 0;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(BitsOutput_obj,flush,(void))


BitsOutput_obj::BitsOutput_obj()
{
	InitMember(o);
	InitMember(nbits);
	InitMember(bits);
}

void BitsOutput_obj::__Mark()
{
	MarkMember(o);
	MarkMember(nbits);
	MarkMember(bits);
}

Dynamic BitsOutput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { return nbits; }
		if (!memcmp(inName.__s,L"flush",sizeof(wchar_t)*5) ) { return flush_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"writeBit",sizeof(wchar_t)*8) ) { return writeBit_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeBits",sizeof(wchar_t)*9) ) { return writeBits_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_o = __hxcpp_field_to_id("o");
static int __id_nbits = __hxcpp_field_to_id("nbits");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_writeBits = __hxcpp_field_to_id("writeBits");
static int __id_writeBit = __hxcpp_field_to_id("writeBit");
static int __id_flush = __hxcpp_field_to_id("flush");


Dynamic BitsOutput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_nbits) return nbits;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_writeBits) return writeBits_dyn();
	if (inFieldID==__id_writeBit) return writeBit_dyn();
	if (inFieldID==__id_flush) return flush_dyn();
	return super::__IField(inFieldID);
}

Dynamic BitsOutput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::Output >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<int >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { nbits=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void BitsOutput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"o",1));
	outFields->push(STRING(L"nbits",5));
	outFields->push(STRING(L"bits",4));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"o",1),
	STRING(L"nbits",5),
	STRING(L"bits",4),
	STRING(L"writeBits",9),
	STRING(L"writeBit",8),
	STRING(L"flush",5),
	String(null()) };

static void sMarkStatics() {
};

Class BitsOutput_obj::__mClass;

void BitsOutput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.BitsOutput",23), TCanCast<BitsOutput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void BitsOutput_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
