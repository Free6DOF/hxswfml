#include <hxObject.h>

#ifndef INCLUDED_format_tools_BitsInput
#include <format/tools/BitsInput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace tools{

Void BitsInput_obj::__construct(haxe::io::Input i)
{
{
	this->i = i;
	this->nbits = 0;
	this->bits = 0;
}
;
	return null();
}

BitsInput_obj::~BitsInput_obj() { }

Dynamic BitsInput_obj::__CreateEmpty() { return  new BitsInput_obj; }
hxObjectPtr<BitsInput_obj > BitsInput_obj::__new(haxe::io::Input i)
{  hxObjectPtr<BitsInput_obj > result = new BitsInput_obj();
	result->__construct(i);
	return result;}

Dynamic BitsInput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<BitsInput_obj > result = new BitsInput_obj();
	result->__construct(inArgs[0]);
	return result;}

int BitsInput_obj::readBits( int n){
	if (this->nbits >= n){
		int c = this->nbits - n;
		int k = int((hxUShr(this->bits,c))) & int(((int(1) << int(n)) - 1));
		this->nbits = c;
		return k;
	}
	int k = this->i->readByte();
	if (this->nbits >= 24){
		if (n >= 31)
			hxThrow (STRING(L"Bits error",10));
		int c = 8 + this->nbits - n;
		int d = int(this->bits) & int(((int(1) << int(this->nbits)) - 1));
		d = int((int(d) << int((8 - c)))) | int((int(k) << int(c)));
		this->bits = k;
		this->nbits = c;
		return d;
	}
	this->bits = int((int(this->bits) << int(8))) | int(k);
	hxAddEq(this->nbits,8);
	return this->readBits(n);
}


DEFINE_DYNAMIC_FUNC1(BitsInput_obj,readBits,return )

bool BitsInput_obj::read( ){
	if (this->nbits == 0){
		this->bits = this->i->readByte();
		this->nbits = 8;
	}
	this->nbits--;
	return (int((hxUShr(this->bits,this->nbits))) & int(1)) == 1;
}


DEFINE_DYNAMIC_FUNC0(BitsInput_obj,read,return )

Void BitsInput_obj::reset( ){
{
		this->nbits = 0;
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(BitsInput_obj,reset,(void))


BitsInput_obj::BitsInput_obj()
{
	InitMember(i);
	InitMember(nbits);
	InitMember(bits);
}

void BitsInput_obj::__Mark()
{
	MarkMember(i);
	MarkMember(nbits);
	MarkMember(bits);
}

Dynamic BitsInput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { return i; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { return nbits; }
		if (!memcmp(inName.__s,L"reset",sizeof(wchar_t)*5) ) { return reset_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"readBits",sizeof(wchar_t)*8) ) { return readBits_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_i = __hxcpp_field_to_id("i");
static int __id_nbits = __hxcpp_field_to_id("nbits");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_readBits = __hxcpp_field_to_id("readBits");
static int __id_read = __hxcpp_field_to_id("read");
static int __id_reset = __hxcpp_field_to_id("reset");


Dynamic BitsInput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_i) return i;
	if (inFieldID==__id_nbits) return nbits;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_readBits) return readBits_dyn();
	if (inFieldID==__id_read) return read_dyn();
	if (inFieldID==__id_reset) return reset_dyn();
	return super::__IField(inFieldID);
}

Dynamic BitsInput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { i=inValue.Cast<haxe::io::Input >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<int >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { nbits=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void BitsInput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"i",1));
	outFields->push(STRING(L"nbits",5));
	outFields->push(STRING(L"bits",4));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"i",1),
	STRING(L"nbits",5),
	STRING(L"bits",4),
	STRING(L"readBits",8),
	STRING(L"read",4),
	STRING(L"reset",5),
	String(null()) };

static void sMarkStatics() {
};

Class BitsInput_obj::__mClass;

void BitsInput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.BitsInput",22), TCanCast<BitsInput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void BitsInput_obj::__boot()
{
}

} // end namespace format
} // end namespace tools
