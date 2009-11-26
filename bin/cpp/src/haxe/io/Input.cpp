#include <hxObject.h>

#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_Eof
#include <haxe/io/Eof.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace haxe{
namespace io{

Void Input_obj::__construct()
{
	return null();
}

Input_obj::~Input_obj() { }

Dynamic Input_obj::__CreateEmpty() { return  new Input_obj; }
hxObjectPtr<Input_obj > Input_obj::__new()
{  hxObjectPtr<Input_obj > result = new Input_obj();
	result->__construct();
	return result;}

Dynamic Input_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Input_obj > result = new Input_obj();
	result->__construct();
	return result;}

int Input_obj::readByte( ){
	hxThrow (STRING(L"Not implemented",15));
	return 0;
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readByte,return )

int Input_obj::readBytes( haxe::io::Bytes s,int pos,int len){
	int k = len;
	Array<unsigned char > b = s->b;
	if (bool(pos < 0) || bool(bool(len < 0) || bool(pos + len > s->length)))
		hxThrow (haxe::io::Error_obj::OutsideBounds);
	while(k > 0){
		b[pos] = this->readByte();
		pos++;
		k--;
	}
	return len;
}


DEFINE_DYNAMIC_FUNC3(Input_obj,readBytes,return )

Void Input_obj::close( ){
{
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Input_obj,close,(void))

bool Input_obj::setEndian( bool b){
	this->bigEndian = b;
	return b;
}


DEFINE_DYNAMIC_FUNC1(Input_obj,setEndian,return )

haxe::io::Bytes Input_obj::readAll( Dynamic bufsize){
	if (bufsize == null())
		bufsize = 16384;
	haxe::io::Bytes buf = haxe::io::Bytes_obj::alloc(bufsize);
	haxe::io::BytesBuffer total = haxe::io::BytesBuffer_obj::__new();
	try{
		while(true){
			int len = this->readBytes(buf,0,bufsize);
			if (len == 0)
				hxThrow (haxe::io::Error_obj::Blocked);
			{
				if (bool(len < 0) || bool(len > buf->length))
					hxThrow (haxe::io::Error_obj::OutsideBounds);
				Array<unsigned char > b1 = total->b;
				Array<unsigned char > b2 = buf->b;
				{
					int _g1 = 0;
					int _g2 = len;
					while(_g1 < _g2){
						int i = _g1++;
						total->b->push(b2->__get(i));
					}
				}
			}
		}
	}
	catch(Dynamic __e){
		if (__e.IsClass<haxe::io::Eof >() ){
			haxe::io::Eof e = __e;{
			}
		}
		else throw(__e);
	}
	return total->getBytes();
}


DEFINE_DYNAMIC_FUNC1(Input_obj,readAll,return )

Void Input_obj::readFullBytes( haxe::io::Bytes s,int pos,int len){
{
		while(len > 0){
			int k = this->readBytes(s,pos,len);
			hxAddEq(pos,k);
			hxSubEq(len,k);
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Input_obj,readFullBytes,(void))

haxe::io::Bytes Input_obj::read( int nbytes){
	haxe::io::Bytes s = haxe::io::Bytes_obj::alloc(nbytes);
	int p = 0;
	while(nbytes > 0){
		int k = this->readBytes(s,p,nbytes);
		if (k == 0)
			hxThrow (haxe::io::Error_obj::Blocked);
		hxAddEq(p,k);
		hxSubEq(nbytes,k);
	}
	return s;
}


DEFINE_DYNAMIC_FUNC1(Input_obj,read,return )

String Input_obj::readUntil( int end){
	StringBuf buf = StringBuf_obj::__new();
	int last;
	while((last = this->readByte()) != end)hxAddEq(buf->b,String::fromCharCode(last));
	return buf->b;
}


DEFINE_DYNAMIC_FUNC1(Input_obj,readUntil,return )

String Input_obj::readLine( ){
	StringBuf buf = StringBuf_obj::__new();
	int last;
	String s;
	try{
		while((last = this->readByte()) != 10)hxAddEq(buf->b,String::fromCharCode(last));
		s = buf->b;
		if (s.charCodeAt(s.length - 1) == 13)
			s = s.substr(0,-1);
	}
	catch(Dynamic __e){
		if (__e.IsClass<haxe::io::Eof >() ){
			haxe::io::Eof e = __e;{
				s = buf->b;
				if (s.length == 0)
					hxThrow ((e));
			}
		}
		else throw(__e);
	}
	return s;
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readLine,return )

double Input_obj::readFloat( ){
	return haxe::io::Input_obj::_float_of_bytes(this->read(4)->b,this->bigEndian);
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readFloat,return )

double Input_obj::readDouble( ){
	return haxe::io::Input_obj::_double_of_bytes(this->read(8)->b,this->bigEndian);
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readDouble,return )

int Input_obj::readInt8( ){
	int n = this->readByte();
	if (n >= 128)
		return n - 256;
	return n;
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readInt8,return )

int Input_obj::readInt16( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	int n = this->bigEndian ? int( int(ch2) | int((int(ch1) << int(8))) ) : int( int(ch1) | int((int(ch2) << int(8))) );
	if (int(n) & int(32768) != 0)
		return n - 65536;
	return n;
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readInt16,return )

int Input_obj::readUInt16( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	return this->bigEndian ? int( int(ch2) | int((int(ch1) << int(8))) ) : int( int(ch1) | int((int(ch2) << int(8))) );
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readUInt16,return )

int Input_obj::readInt24( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	int ch3 = this->readByte();
	int n = this->bigEndian ? int( int(int(ch3) | int((int(ch2) << int(8)))) | int((int(ch1) << int(16))) ) : int( int(int(ch1) | int((int(ch2) << int(8)))) | int((int(ch3) << int(16))) );
	if (int(n) & int(8388608) != 0)
		return n - 16777216;
	return n;
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readInt24,return )

int Input_obj::readUInt24( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	int ch3 = this->readByte();
	return this->bigEndian ? int( int(int(ch3) | int((int(ch2) << int(8)))) | int((int(ch1) << int(16))) ) : int( int(int(ch1) | int((int(ch2) << int(8)))) | int((int(ch3) << int(16))) );
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readUInt24,return )

int Input_obj::readInt31( ){
	int ch1;
	int ch2;
	int ch3;
	int ch4;
	if (this->bigEndian){
		ch4 = this->readByte();
		ch3 = this->readByte();
		ch2 = this->readByte();
		ch1 = this->readByte();
	}
	else{
		ch1 = this->readByte();
		ch2 = this->readByte();
		ch3 = this->readByte();
		ch4 = this->readByte();
	}
	if (((int(ch4) & int(128)) == 0) != ((int(ch4) & int(64)) == 0))
		hxThrow (haxe::io::Error_obj::Overflow);
	return int(int(int(ch1) | int((int(ch2) << int(8)))) | int((int(ch3) << int(16)))) | int((int(ch4) << int(24)));
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readInt31,return )

int Input_obj::readUInt30( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	int ch3 = this->readByte();
	int ch4 = this->readByte();
	if ((this->bigEndian ? int( ch1 ) : int( ch4 )) >= 64)
		hxThrow (haxe::io::Error_obj::Overflow);
	return this->bigEndian ? int( int(int(int(ch4) | int((int(ch3) << int(8)))) | int((int(ch2) << int(16)))) | int((int(ch1) << int(24))) ) : int( int(int(int(ch1) | int((int(ch2) << int(8)))) | int((int(ch3) << int(16)))) | int((int(ch4) << int(24))) );
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readUInt30,return )

cpp::CppInt32__ Input_obj::readInt32( ){
	int ch1 = this->readByte();
	int ch2 = this->readByte();
	int ch3 = this->readByte();
	int ch4 = this->readByte();
	return this->bigEndian ? cpp::CppInt32__( cpp::CppInt32___obj::make(int((int(ch1) << int(8))) | int(ch2),int((int(ch3) << int(8))) | int(ch4)) ) : cpp::CppInt32__( cpp::CppInt32___obj::make(int((int(ch4) << int(8))) | int(ch3),int((int(ch2) << int(8))) | int(ch1)) );
}


DEFINE_DYNAMIC_FUNC0(Input_obj,readInt32,return )

String Input_obj::readString( int len){
	haxe::io::Bytes b = haxe::io::Bytes_obj::alloc(len);
	this->readFullBytes(b,0,len);
	return b->toString();
}


DEFINE_DYNAMIC_FUNC1(Input_obj,readString,return )

Dynamic Input_obj::_float_of_bytes;

Dynamic Input_obj::_double_of_bytes;


Input_obj::Input_obj()
{
	InitMember(bigEndian);
}

void Input_obj::__Mark()
{
	MarkMember(bigEndian);
}

Dynamic Input_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"close",sizeof(wchar_t)*5) ) { return close_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"readAll",sizeof(wchar_t)*7) ) { return readAll_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"readByte",sizeof(wchar_t)*8) ) { return readByte_dyn(); }
		if (!memcmp(inName.__s,L"readLine",sizeof(wchar_t)*8) ) { return readLine_dyn(); }
		if (!memcmp(inName.__s,L"readInt8",sizeof(wchar_t)*8) ) { return readInt8_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"bigEndian",sizeof(wchar_t)*9) ) { return bigEndian; }
		if (!memcmp(inName.__s,L"readBytes",sizeof(wchar_t)*9) ) { return readBytes_dyn(); }
		if (!memcmp(inName.__s,L"setEndian",sizeof(wchar_t)*9) ) { return setEndian_dyn(); }
		if (!memcmp(inName.__s,L"readUntil",sizeof(wchar_t)*9) ) { return readUntil_dyn(); }
		if (!memcmp(inName.__s,L"readFloat",sizeof(wchar_t)*9) ) { return readFloat_dyn(); }
		if (!memcmp(inName.__s,L"readInt16",sizeof(wchar_t)*9) ) { return readInt16_dyn(); }
		if (!memcmp(inName.__s,L"readInt24",sizeof(wchar_t)*9) ) { return readInt24_dyn(); }
		if (!memcmp(inName.__s,L"readInt31",sizeof(wchar_t)*9) ) { return readInt31_dyn(); }
		if (!memcmp(inName.__s,L"readInt32",sizeof(wchar_t)*9) ) { return readInt32_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"readDouble",sizeof(wchar_t)*10) ) { return readDouble_dyn(); }
		if (!memcmp(inName.__s,L"readUInt16",sizeof(wchar_t)*10) ) { return readUInt16_dyn(); }
		if (!memcmp(inName.__s,L"readUInt24",sizeof(wchar_t)*10) ) { return readUInt24_dyn(); }
		if (!memcmp(inName.__s,L"readUInt30",sizeof(wchar_t)*10) ) { return readUInt30_dyn(); }
		if (!memcmp(inName.__s,L"readString",sizeof(wchar_t)*10) ) { return readString_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"readFullBytes",sizeof(wchar_t)*13) ) { return readFullBytes_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"_float_of_bytes",sizeof(wchar_t)*15) ) { return _float_of_bytes; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"_double_of_bytes",sizeof(wchar_t)*16) ) { return _double_of_bytes; }
	}
	return super::__Field(inName);
}

static int __id__float_of_bytes = __hxcpp_field_to_id("_float_of_bytes");
static int __id__double_of_bytes = __hxcpp_field_to_id("_double_of_bytes");
static int __id_bigEndian = __hxcpp_field_to_id("bigEndian");
static int __id_readByte = __hxcpp_field_to_id("readByte");
static int __id_readBytes = __hxcpp_field_to_id("readBytes");
static int __id_close = __hxcpp_field_to_id("close");
static int __id_setEndian = __hxcpp_field_to_id("setEndian");
static int __id_readAll = __hxcpp_field_to_id("readAll");
static int __id_readFullBytes = __hxcpp_field_to_id("readFullBytes");
static int __id_read = __hxcpp_field_to_id("read");
static int __id_readUntil = __hxcpp_field_to_id("readUntil");
static int __id_readLine = __hxcpp_field_to_id("readLine");
static int __id_readFloat = __hxcpp_field_to_id("readFloat");
static int __id_readDouble = __hxcpp_field_to_id("readDouble");
static int __id_readInt8 = __hxcpp_field_to_id("readInt8");
static int __id_readInt16 = __hxcpp_field_to_id("readInt16");
static int __id_readUInt16 = __hxcpp_field_to_id("readUInt16");
static int __id_readInt24 = __hxcpp_field_to_id("readInt24");
static int __id_readUInt24 = __hxcpp_field_to_id("readUInt24");
static int __id_readInt31 = __hxcpp_field_to_id("readInt31");
static int __id_readUInt30 = __hxcpp_field_to_id("readUInt30");
static int __id_readInt32 = __hxcpp_field_to_id("readInt32");
static int __id_readString = __hxcpp_field_to_id("readString");


Dynamic Input_obj::__IField(int inFieldID)
{
	if (inFieldID==__id__float_of_bytes) return _float_of_bytes;
	if (inFieldID==__id__double_of_bytes) return _double_of_bytes;
	if (inFieldID==__id_bigEndian) return bigEndian;
	if (inFieldID==__id_readByte) return readByte_dyn();
	if (inFieldID==__id_readBytes) return readBytes_dyn();
	if (inFieldID==__id_close) return close_dyn();
	if (inFieldID==__id_setEndian) return setEndian_dyn();
	if (inFieldID==__id_readAll) return readAll_dyn();
	if (inFieldID==__id_readFullBytes) return readFullBytes_dyn();
	if (inFieldID==__id_read) return read_dyn();
	if (inFieldID==__id_readUntil) return readUntil_dyn();
	if (inFieldID==__id_readLine) return readLine_dyn();
	if (inFieldID==__id_readFloat) return readFloat_dyn();
	if (inFieldID==__id_readDouble) return readDouble_dyn();
	if (inFieldID==__id_readInt8) return readInt8_dyn();
	if (inFieldID==__id_readInt16) return readInt16_dyn();
	if (inFieldID==__id_readUInt16) return readUInt16_dyn();
	if (inFieldID==__id_readInt24) return readInt24_dyn();
	if (inFieldID==__id_readUInt24) return readUInt24_dyn();
	if (inFieldID==__id_readInt31) return readInt31_dyn();
	if (inFieldID==__id_readUInt30) return readUInt30_dyn();
	if (inFieldID==__id_readInt32) return readInt32_dyn();
	if (inFieldID==__id_readString) return readString_dyn();
	return super::__IField(inFieldID);
}

Dynamic Input_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 9:
		if (!memcmp(inName.__s,L"bigEndian",sizeof(wchar_t)*9) ) { bigEndian=inValue.Cast<bool >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"_float_of_bytes",sizeof(wchar_t)*15) ) { _float_of_bytes=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"_double_of_bytes",sizeof(wchar_t)*16) ) { _double_of_bytes=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Input_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"bigEndian",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"_float_of_bytes",15),
	STRING(L"_double_of_bytes",16),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"bigEndian",9),
	STRING(L"readByte",8),
	STRING(L"readBytes",9),
	STRING(L"close",5),
	STRING(L"setEndian",9),
	STRING(L"readAll",7),
	STRING(L"readFullBytes",13),
	STRING(L"read",4),
	STRING(L"readUntil",9),
	STRING(L"readLine",8),
	STRING(L"readFloat",9),
	STRING(L"readDouble",10),
	STRING(L"readInt8",8),
	STRING(L"readInt16",9),
	STRING(L"readUInt16",10),
	STRING(L"readInt24",9),
	STRING(L"readUInt24",10),
	STRING(L"readInt31",9),
	STRING(L"readUInt30",10),
	STRING(L"readInt32",9),
	STRING(L"readString",10),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Input_obj::_float_of_bytes);
	MarkMember(Input_obj::_double_of_bytes);
};

Class Input_obj::__mClass;

void Input_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"haxe.io.Input",13), TCanCast<Input_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Input_obj::__boot()
{
	Static(_float_of_bytes) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"float_of_bytes",14),2);
	Static(_double_of_bytes) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"double_of_bytes",15),2);
}

} // end namespace haxe
} // end namespace io
